<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Configurations extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');
		isLogin();
		$this->load->model('Dashboard_model', 'dashboard');
		$this->load->model('Configuration_model', 'configuration');
	}

	public function index()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Memperbaharui Konfigurasi Web";
		$data['auth'] = getCurrentUser();

		$data['configurations'] = $this->configuration->getConfig();

		$this->form_validation->set_rules('title', 'Judul Web', 'required|trim');
		$this->form_validation->set_rules('short_title', 'Judul Singkat Web', 'required|trim');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		$this->form_validation->set_rules('telp', 'Telp.', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_edit_check_email',
											array(
												'valid_email'	=> 'Silakan masukkan email yang valid! cth: email@email.com'
											));

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('configurations/edit', $data);
			$this->load->view('templates/dashboard/footer');
		} else {
			if (!empty($_FILES['image']['name'])) {
				if (!is_dir('storage/configuration/images')) {
				    mkdir('storage/configuration/images', 0777, TRUE);
			    }
				$img_upload = doUploadImage('configuration/images');
				deleteFile("configuration/images", $this->input->post('image_hidden', true));

				// when upload image are failed 
				if (!$img_upload['result']) {
					$this->session->set_flashdata('img_message', $img_upload['message']);
				} else {
					$img_name = $img_upload['data'];
				}
			} else {
				$img_name = '';
			}

			# check if message failed 
			if ($this->session->flashdata('img_message')) {
				redirect('admin/configurations');
			}

			if ($data['configurations'] == null) {
				$configuration = [
					'title' => $this->input->post('title',  true),
					'short_title' => $this->input->post('short_title',  true),
					'image' => $img_name,
					'address' => $this->input->post('address', true),
					'telp' => $this->input->post('telp', true),
					'email' => $this->input->post('email', true),
					'updated_at' => date('Y-m-d H:i:s', time())
				];

				$message = setMessage($this->configuration->insert($configuration), "Menambahkan");
				$this->session->set_flashdata('message', $message['message']);

				create_log(
					"Membuat configuration",
					"insert",
					getCurrentIdUser(),
					"Configuration",
					$message['result'] ? "1" : "0"
				);
			} else {
				$configuration_id = $this->input->post('configurations_id');
				$configuration = [
					'title' => $this->input->post('title',  true),
					'short_title' => $this->input->post('short_title',  true),
					'image' => $img_name,
					'address' => $this->input->post('address', true),
					'telp' => $this->input->post('telp', true),
					'email' => $this->input->post('email', true),
					'updated_at' => date('Y-m-d H:i:s', time())
				];

				$message = setMessage($this->configuration->update($configuration, $configuration_id), "memperbaharui");
				$this->session->set_flashdata('message', $message['message']);

				create_log(
					"Mengubah configuration",
					"update",
					getCurrentIdUser(),
					"Configuration",
					$message['result'] ? "1" : "0"
				);
			}
			redirect('admin/configurations');
		}
	}

	public function edit_check_email($email)
	{
		$current_email = $this->configuration->getConfig()->email;
		$count = count($current_email);
		$in_db_email = $count > 0 ? $current_email : false;

		if ($current_email == $email) {
			return TRUE;
		} else if ($count > 0 && $email == $in_db_email) {
            $this->form_validation->set_message('edit_check_email', 'Email '. $email .' sudah terdaftar!');
            return FALSE;
        } else {
            return TRUE;
        }
	}
}
