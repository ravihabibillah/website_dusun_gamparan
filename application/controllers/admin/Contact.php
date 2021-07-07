<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');
		isLogin();
		$this->load->model('Contact_model', 'contact');
		$this->load->model('Dashboard_model', 'dashboard');
		$this->load->model('Configuration_model', 'configuration');
	}

	public function index()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Manajemen Kontak";
		$data['auth'] = getCurrentUser();

		$data['contacts_data'] = $this->contact->getAll();

		$this->load->view('templates/dashboard/header', $data);
		$this->load->view('contact/index', $data);
		$this->load->view('templates/dashboard/footer');
	}

	public function create()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Menambahkan Kontak";
		$data['auth'] = getCurrentUser();

		$this->form_validation->set_rules('name', 'Nama', 'required|trim');
		$this->form_validation->set_rules('telp', 'No. HP / WhatsApp', 'required|trim|numeric',
								array(
										'numeric'	=> 'Hanya karakter numeric yang diperbolehkan!'
								));
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[contacts.email]',
								array(
										'valid_email'	=> 'Silakan masukkan email yang valid! cth: email@email.com',
										'is_unique'		=> 'Email %s sudah terdaftar!'
								));

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('contact/create');
			$this->load->view('templates/dashboard/footer');
		} else {
			$contact = [
				'name' => $this->input->post('name', true),
				'telp' => $this->input->post('telp', true),
				'email' => $this->input->post('email', true)
			];

			$message = setMessage($this->contact->insert($contact), "Menambahkan");
			$this->session->set_flashdata('message', $message['message']);

			create_log(
				"Membuat kontak dengan nama ".$this->input->post('name', true),
				"insert",
				getCurrentIdUser(),
				"Kontak",
				$message['result'] ? "1" : "0"
			);

			if (!$message['result']) {
				redirect('admin/contact/create');
			} else {
				redirect('admin/contact');
			}
		}
	}

	public function edit($id)
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Memperbaharui Kontak";
		$data['auth'] = getCurrentUser();

		$data['contact'] = $this->contact->get($id);

		$this->form_validation->set_rules('name', 'Nama', 'required|trim');
		$this->form_validation->set_rules('telp', 'No. HP / WhatsApp', 'required|trim|numeric',
								array(
										'numeric'	=> 'Hanya karakter numeric yang diperbolehkan!'
								));
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_edit_check_email['.$id.']',
								array(
										'valid_email'	=> 'Silakan masukkan email yang valid! cth: email@email.com'
								));

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('contact/edit', $data);
			$this->load->view('templates/dashboard/footer');
		} else {
			$contact = [
				'name' => $this->input->post('name', true),
				'telp' => $this->input->post('telp', true),
				'email' => $this->input->post('email', true),
				'updated_at' => date('Y-m-d H:i:s', time())
			];

			$message = setMessage($this->contact->update($contact, $id), "memperbaharui");
			$this->session->set_flashdata('message', $message['message']);

			create_log(
				"Mengubah kontak dengan id ".$this->input->post('user_id', true),
				"update",
				getCurrentIdUser(),
				"Kontak",
				$message['result'] ? "1" : "0"
			);

			if (!$message['result']) {
				redirect('admin/contact/edit/' . $id);
			} else {
				redirect('admin/contact');
			}
		}
	}

	public function delete($id)
	{
		$data['auth'] = getCurrentUser();
		$contact = $this->contact->get($id);

		$message = setMessage($this->contact->destroy($id), "menghapus");
		$this->session->set_flashdata('message', $message['message']);

		create_log(
			"Menghapus kontak dengan nama ".$contact->name,
			"delete",
			getCurrentIdUser(),
			"Kontak",
			$message['result'] ? "1" : "0"
		);

		redirect("admin/contact");
	}

	public function search()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Pencarian Kontak";
		$data['auth'] = getCurrentUser();

		$data['contacts_data'] = $this->contact->getAll();

		$this->load->view('templates/dashboard/header', $data);
		if (isset($_GET['q'])) {
			$data['search'] = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
			$data['result'] = $this->contact->find($data['search']);

			$this->load->view('contact/search', $data);
		} else {
			$this->load->view('contact/index');
		}
		$this->load->view('templates/dashboard/footer');
	}

	public function edit_check_email($email, $id)
	{
		$current_email = $this->contact->get($id)->email;
		$count = count($this->contact->find($email));
		$in_db_email = $count > 0 ? $this->contact->find($email)[0]->email : false;

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
