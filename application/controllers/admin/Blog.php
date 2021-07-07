<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');
		isLogin();
		$this->load->model('Blog_model', 'blog');
		$this->load->model('User_model', 'user');
		$this->load->model('Configuration_model', 'configuration');
	}

	public function index()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Manajemen Blog / Artikel";
		$data['auth'] = getCurrentUser();

		$data['blogs_data'] = $this->blog->getAll();

		// simplify content only to read
		foreach ($data['blogs_data'] as $key => $value) {
			$start_p = strpos($value->content, '<p>');
			$end_p = strpos($value->content, '</p>', $start_p);
			$paragraph = substr($value->content, $start_p, $end_p-$start_p);

			if (strlen($paragraph) > 147) {
				$value->content = substr($paragraph, 0, 147)."...</p>";
			} else {
				$value->content = $paragraph."...</p>";
			}
		}

		$this->load->view('templates/dashboard/header', $data);
		$this->load->view('blog/index', $data);
		$this->load->view('templates/dashboard/footer');
	}

	public function create()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Menambahkan Blog / Artikel";
		$data['auth'] = getCurrentUser();

		$this->form_validation->set_rules('title', 'Judul', 'required|trim');
		$this->form_validation->set_rules('content', 'Konten', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('blog/create');
			$this->load->view('templates/dashboard/footer');
		} else {
			$blog = [
				'title' => $this->input->post('title', true),
				'content' => $this->input->post('content', true),
				'id_user' => getCurrentIdUser()
			];

			$message = setMessage($this->blog->insert($blog), "Menambahkan");
			$this->session->set_flashdata('message', $message['message']);

			create_log(
				"Membuat Blog / Artikel dengan judul ".$blog->title,
				"insert",
				getCurrentIdUser(),
				"Blog / Artikel",
				$message['result'] ? "1" : "0"
			);

			if (!$message['result']) {
				redirect('admin/blog/create');
			} else {
				redirect('admin/blog');
			}
		}
	}

	public function edit($id)
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Memperbaharui Blog / Artikel";
		$data['auth'] = getCurrentUser();

		$data['blog'] = $this->blog->get($id);

		$this->form_validation->set_rules('title', 'Judul', 'required|trim');
		$this->form_validation->set_rules('content', 'Konten', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('blog/edit', $data);
			$this->load->view('templates/dashboard/footer');
		} else {
			$blog = [
				'title' => $this->input->post('title', true),
				'content' => $this->input->post('content', true),
				'id_user' => $this->input->post('id_user', true),
				'updated_at' => date('Y-m-d H:i:s', time())
			];

			$message = setMessage($this->blog->update($blog, $id), "Memperbaharui");
			$this->session->set_flashdata('message', $message['message']);

			create_log(
				"Mengubah Blog / Artikel dengan id ".$id,
				"update",
				getCurrentIdUser(),
				"Blog / Artikel",
				$message['result'] ? "1" : "0"
			);

			if (!$message['result']) {
				redirect('admin/blog/edit/' . $id);
			} else {
				redirect('admin/blog');
			}
		}
	}

	public function delete($id)
	{
		$blog = $this->blog->get($id);
		// deleteFolderWithFiles("blogs/".$id);

		$message = setMessage($this->blog->destroy($id), "Menghapus");
		$this->session->set_flashdata('message', $message['message']);

		create_log(
			"Menghapus Blog / Artikel dengan judul ".$blog->title,
			"delete",
			getCurrentIdUser(),
			"Blog / Artikel",
			$message['result'] ? "1" : "0"
		);

		redirect("admin/blog");
	}

	public function search()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Pencarian Akun";
		$data['auth'] = getCurrentUser();

		$data['blogs_data'] = $this->blog->getAll();

		$this->load->view('templates/dashboard/header', $data);
		if (isset($_GET['q'])) {
			$data['search'] = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
			$data['result'] = $this->blog->find($data['search']);

			// simplify content only to read
			foreach ($data['result'] as $key => $value) {
				$start_p = strpos($value->content, '<p>');
				$end_p = strpos($value->content, '</p>', $start_p);
				$paragraph = substr($value->content, $start_p, $end_p-$start_p);

				if (strlen($paragraph) > 147) {
					$value->content = substr($paragraph, 0, 147)."...</p>";
				} else {
					$value->content = $paragraph."...</p>";
				}
			}

			$this->load->view('blog/search', $data);
		} else {
			$this->load->view('blog/index');
		}
		$this->load->view('templates/dashboard/footer');
	}

	public function uploadImage()
	{
		$this->load->library('upload');
		if(isset($_FILES["image"]["name"])){
	        $config['upload_path'] = './storage/blogs/images/';
	        $config['allowed_types'] = "gif|jpg|jpeg|png|jfif|bmp|webp";
	        $this->upload->initialize($config);
	        if(!$this->upload->do_upload('image')){
	            $this->upload->display_errors();
	            return FALSE;
	        }else{
	            $data = $this->upload->data();
	            echo base_url().'storage/blogs/images/'.$data['file_name'];
	        }
	    }
	}

	public function deleteImage()
	{
		$src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if(unlink($file_name))
        {
            echo 'File Delete Successfully';
        }
	}
}
