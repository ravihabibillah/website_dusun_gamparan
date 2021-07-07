<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');
		isLogin();
		$this->load->model('Gallery_model', 'gallery');
		$this->load->model('Configuration_model', 'configuration');
	}

	public function index()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Manajemen Galeri";
		$data['auth'] = getCurrentUser();

		$data['galleries'] = $this->gallery->getAll();

		if (empty($_FILES['image']['tmp_name'])) {
			$this->form_validation->set_rules('image', 'Foto', 'required|trim');
		}
		$this->form_validation->set_rules('title', 'Judul', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('gallery/index', $data);
			$this->load->view('templates/dashboard/footer');
		} else {
			$img_upload = doUploadImage('galleries/images');

			if (!$img_upload['result']) {
				$this->session->set_flashdata('img_message', $img_upload['message']);
			} else {
				$img_name = $img_upload['data'];
			}

			# check if message failed 
			if ($this->session->flashdata('img_message')) {
				redirect('admin/gallery');
			}

			$gallery = [
				'title' => $this->input->post('title', true),
				'image' => $img_name
			];

			$message = setMessage($this->gallery->insert($gallery), "Menambahkan");
			$this->session->set_flashdata('message', $message['message']);

			create_log(
				"Menambahkan foto ke galeri dengan nama file ".$img_name,
				"insert",
				getCurrentIdUser(),
				"Gallery",
				$message['result'] ? "1" : "0"
			);

			redirect('admin/gallery');
		}
	}

	public function delete($id)
	{
		$gallery = $this->gallery->get($id);
		deleteFile("galleries/images", $gallery->image);

		$message = setMessage($this->gallery->destroy($id), "menghapus");
		$this->session->set_flashdata('message', $message['message']);

		create_log(
			"Menghapus foto galeri dengan judul ".$gallery->title,
			"delete",
			getCurrentIdUser(),
			"Gallery",
			$message['result'] ? "1" : "0"
		);

		redirect("admin/gallery");
	}
}
