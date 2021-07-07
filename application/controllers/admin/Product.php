<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');
		isLogin();
		$this->load->model('Product_model', 'product');
		$this->load->model('Configuration_model', 'configuration');
	}

	public function index()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Manajemen Produk Unggulan";
		$data['auth'] = getCurrentUser();

		$data['products_data'] = $this->product->getAll();

		$this->load->view('templates/dashboard/header', $data);
		$this->load->view('product/index', $data);
		$this->load->view('templates/dashboard/footer');
	}

	public function create()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Menambahkan Produk Unggulan";
		$data['auth'] = getCurrentUser();

		if (empty($_FILES['image']['tmp_name'])) {
			$this->form_validation->set_rules('image', 'Gambar', 'required|trim');
		}

		$this->form_validation->set_rules('title', 'Judul', 'required|trim');
		$this->form_validation->set_rules('description', 'Keterangan', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('product/create');
			$this->load->view('templates/dashboard/footer');
		} else {
			$img_upload = doUploadImage('products/images');

			if (!$img_upload['result']) {
				$this->session->set_flashdata('img_message', $img_upload['message']);
			} else {
				$img_name = $img_upload['data'];
			}

			# check if message failed 
			if ($this->session->flashdata('img_message')) {
				redirect('admin/product/create');
			}

			$product = [
				'title' => $this->input->post('title', true),
				'description' => $this->input->post('description', true),
				'image' => $img_name
			];

			$message = setMessage($this->product->insert($product), "Menambahkan");
			$this->session->set_flashdata('message', $message['message']);

			create_log(
				"Membuat produk unggulan dengan judul ".$product->title,
				"insert",
				getCurrentIdUser(),
				"Produk Unggulan",
				$message['result'] ? "1" : "0"
			);

			if (!$message['result']) {
				redirect('admin/product/create');
			} else {
				redirect('admin/product');
			}
		}
	}

	public function edit($id)
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Memperbaharui Produk Unggulan";
		$data['auth'] = getCurrentUser();

		$data['product'] = $this->product->get($id);

		$this->form_validation->set_rules('title', 'Judul', 'required|trim');
		$this->form_validation->set_rules('description', 'Keterangan', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('product/edit', $data);
			$this->load->view('templates/dashboard/footer');
		} else {
			if (!empty($_FILES['image']['tmp_name'])) {
				$img_upload = doUploadImage('product/images');
				deleteFile("product/images", $this->input->post('image_hidden', true));

				// when upload image are failed 
				if (!$img_upload['result']) {
					$this->session->set_flashdata('img_message', $img_upload['message']);
				} else {
					$img_name = $img_upload['data'];
				}
			} else {
				$img_name = $this->input->post('image_hidden', true);
			}

			# check if message failed 
			if ($this->session->flashdata('img_message')) {
				redirect('admin/product/edit/' . $id);
			}

			$product = [
				'title' => $this->input->post('title', true),
				'description' => $this->input->post('description', true),
				'image' => $img_name,
				'updated_at' => date('Y-m-d H:i:s', time())
			];

			$message = setMessage($this->product->update($product, $id), "Memperbaharui");
			$this->session->set_flashdata('message', $message['message']);

			create_log(
				"Mengubah produk unggulan dengan id ".$id,
				"update",
				getCurrentIdUser(),
				"Produk Unggulan",
				$message['result'] ? "1" : "0"
			);

			if (!$message['result']) {
				redirect('admin/product/edit/' . $id);
			} else {
				redirect('admin/product');
			}
		}
	}

	public function delete($id)
	{
		$product = $this->product->get($id);
		deleteFile("product/images", $product->image);

		$message = setMessage($this->product->destroy($id), "menghapus");
		$this->session->set_flashdata('message', $message['message']);

		create_log(
			"Menghapus produk unggalan dengan judul ".$product->title,
			"delete",
			getCurrentIdUser(),
			"Produk Unggulan",
			$message['result'] ? "1" : "0"
		);

		redirect("admin/product");
	}

	public function search()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Pencarian Akun";
		$data['auth'] = getCurrentUser();

		$data['products_data'] = $this->product->getAll();

		$this->load->view('templates/dashboard/header', $data);
		if (isset($_GET['q'])) {
			$data['search'] = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
			$data['result'] = $this->product->find($data['search']);

			$this->load->view('product/search', $data);
		} else {
			$this->load->view('product/index');
		}
		$this->load->view('templates/dashboard/footer');
	}

}
