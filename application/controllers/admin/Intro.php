<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Intro extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');
		isLogin();
		$this->load->model('Intro_model', 'intro');
		$this->load->model('Configuration_model', 'configuration');
	}

	public function index()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Memperbaharui Perkenalan";
		$data['auth'] = getCurrentUser();

		$data['intro'] = $this->intro->getAll() == null ? null : $this->intro->getAll()[0];

		$this->form_validation->set_rules('intro', 'Perkenalan', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('intro/edit', $data);
			$this->load->view('templates/dashboard/footer');
		} else {
			if ($data['intro'] == null) {
				$intro = [
					'intro' => $this->input->post('intro', true)
				];

				$message = setMessage($this->intro->insert($intro), "Menambahkan");
				$this->session->set_flashdata('message', $message['message']);

				create_log(
					"Membuat perkenalan",
					"insert",
					getCurrentIdUser(),
					"Intro",
					$message['result'] ? "1" : "0"
				);
			} else {
				$intro = [
					'intro' => $this->input->post('intro', true),
					'keadaan' => $this->input->post('keadaan', true),
					'produk' => $this->input->post('produk', true),
					'komunitas' => $this->input->post('komunitas', true),
					'updated_at' => date('Y-m-d H:i:s', time())
				];

				$message = setMessage($this->intro->update($intro, $data['intro']->id), "Memperbaharui");
				$this->session->set_flashdata('message', $message['message']);

				create_log(
					"Mengubah perkenalan",
					"update",
					getCurrentIdUser(),
					"Intro",
					$message['result'] ? "1" : "0"
				);
			}

			redirect('admin/intro');
		}
	}
}
