<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');
		isLogin();
		$this->load->model('About_model', 'about');
		$this->load->model('Configuration_model', 'configuration');
	}

	public function index()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Memperbaharui Tentang Kami";
		$data['auth'] = getCurrentUser();

		$data['about'] = $this->about->getAll() == null ? null : $this->about->getAll()[0];

		$this->form_validation->set_rules('about', 'Tentang Kami', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('about/edit', $data);
			$this->load->view('templates/dashboard/footer');
		} else {
			if ($data['about'] == null) {
				$about = [
					'about' => $this->input->post('about', true)
				];

				$message = setMessage($this->about->insert($about), "Menambahkan");
				$this->session->set_flashdata('message', $message['message']);

				create_log(
					"Membuat Tentang Kami",
					"insert",
					getCurrentIdUser(),
					"About",
					$message['result'] ? "1" : "0"
				);
			} else {
				$about = [
					'about' => $this->input->post('about', true),
					'updated_at' => date('Y-m-d H:i:s', time())
				];

				$message = setMessage($this->about->update($about, $data['about']->id), "Memperbaharui");
				$this->session->set_flashdata('message', $message['message']);

				create_log(
					"Mengubah Tentang Kami",
					"update",
					getCurrentIdUser(),
					"About",
					$message['result'] ? "1" : "0"
				);
			}

			redirect('admin/about');
		}
	}
}
