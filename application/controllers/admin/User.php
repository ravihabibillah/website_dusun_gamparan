<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');
		isLogin();
		$this->load->model('User_model', 'user');
		$this->load->model('Dashboard_model', 'dashboard');
		$this->load->model('Configuration_model', 'configuration');
	}

	public function index()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Manajemen Akun";
		$data['auth'] = getCurrentUser();

		$data['users_data'] = $this->user->getAll();

		$this->load->view('templates/dashboard/header', $data);
		if ($data['auth']->role <> 1) {
			$this->load->view('user/forbid');
		} else {
			$this->load->view('user/index', $data);
		}
		$this->load->view('templates/dashboard/footer');
	}

	public function create()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Menambahkan Akun";
		$data['auth'] = getCurrentUser();

		if ($data['auth']->role <> 1) {
			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('user/forbid');
			$this->load->view('templates/dashboard/footer');
		} else {
			if (empty($_FILES['image']['tmp_name'])) {
				$this->form_validation->set_rules('image', 'Image', 'required|trim');
			}

			$this->form_validation->set_rules('name', 'Nama', 'required|trim|alpha',
									array(
											'alpha'	=> 'Hanya karakter alfabet yang diperbolehkan!'
									));
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]',
									array(
											'valid_email'	=> 'Silakan masukkan email yang valid! cth: email@email.com',
											'is_unique'		=> 'Email %s sudah terdaftar!'
									));
			$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|is_unique[users.username]|alpha_numeric',
									array(
											'min_length'	=> 'Silakan masukkan username minimal 4 karakter!',
											'is_unique'		=> 'Username %s sudah terdaftar!',
											'alpha_numeric'	=> 'Hanya karakter alfabet dan numeric yang diperbolehkan!'
									));
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]',
									array(
											'min_length'	=> 'Silakan masukkan password minimal 4 karakter!'
									));
			$this->form_validation->set_rules('role', 'Role', 'required|trim');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('templates/dashboard/header', $data);
				$this->load->view('user/create');
				$this->load->view('templates/dashboard/footer');
			} else {
				$img_upload = doUploadImage('user/' . $this->input->post('username', true) . '/images');

				if (!$img_upload['result']) {
					$this->session->set_flashdata('img_message', $img_upload['message']);
				} else {
					$img_name = $img_upload['data'];
				}

				# check if message failed 
				if ($this->session->flashdata('img_message')) {
					redirect('admin/user/create');
				}

				$user = [
					'name' => $this->input->post('name', true),
					'email' => $this->input->post('email', true),
					'username' => $this->input->post('username', true),
					'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
					'role' => $this->input->post('role', true),
					'image' => $img_name,
					'created_at' => date('Y-m-d H:i:s', time())
				];

				$message = setMessage($this->user->insert($user), "Menambahkan");
				$this->session->set_flashdata('message', $message['message']);

				create_log(
					"Membuat user dengan username ".$this->input->post('username', true). " dan email ".$this->input->post('email', true),
					"insert",
					getCurrentIdUser(),
					"User ".$this->input->post('username', true),
					$message['result'] ? "1" : "0"
				);

				if (!$message['result']) {
					redirect('admin/user/create');
				} else {
					redirect('admin/user');
				}
			}
		}
	}

	public function edit($id)
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Memperbaharui Akun";
		$data['auth'] = getCurrentUser();

		$data['user'] = $this->user->get($id);
		if ($data['auth']->role <> 1) {
			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('user/forbid');
			$this->load->view('templates/dashboard/footer');
		} else {
			$this->form_validation->set_rules('name', 'Nama', 'required|trim|alpha',
									array(
											'alpha'	=> 'Hanya karakter alfabet yang diperbolehkan!'
									));
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_edit_check_email['.$id.']',
									array(
											'valid_email'	=> 'Silakan masukkan email yang valid! cth: email@email.com'
									));
			$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|callback_edit_check_username['.$id.']|alpha_numeric',
									array(
											'min_length'	=> 'Silakan masukkan username minimal 4 karakter!',
											'alpha_numeric'	=> 'Hanya karakter alfabet dan numeric yang diperbolehkan!'
									));
			$this->form_validation->set_rules('password', 'Password', 'trim|min_length[4]',
									array(
											'min_length'	=> 'Silakan masukkan password minimal 4 karakter!'
									));

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('templates/dashboard/header', $data);
				$this->load->view('user/edit', $data);
				$this->load->view('templates/dashboard/footer');
			} else {
				if (!empty($_FILES['image']['tmp_name'])) {
					$img_upload = doUploadImage('user/' . $this->input->post('username', true) . '/images');
					deleteFile("user/" . $data['user']->username . "/images", $this->input->post('image_hidden', true));

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
					redirect('admin/user/edit/' . $id);
				}

				if ($this->input->post('username', true) != $data['users']->username) {
					renameFolderUser($data['user']->username, $this->input->post('username', true));
				}

				$password = $this->input->post('password', true) == "" ? $data['user']->password : password_hash($this->input->post('password', true), PASSWORD_DEFAULT);

				$user_id = $this->input->post('user_id');
				$user = [
					'name' => $this->input->post('name', true),
					'email' => $this->input->post('email', true),
					'username' => $this->input->post('username', true),
					'password' => $password,
					'role' => $this->input->post('role', true),
					'image' => $img_name,
					'updated_at' => date('Y-m-d H:i:s', time())
				];

				$message = setMessage($this->user->update($user, $user_id), "memperbaharui");
				$this->session->set_flashdata('message', $message['message']);

				create_log(
					"Mengubah user dengan id ".$this->input->post('user_id', true),
					"update",
					getCurrentIdUser(),
					"User ".$data['user']->username,
					$message['result'] ? "1" : "0"
				);

				if (!$message['result']) {
					redirect('admin/user/edit/' . $id);
				} else {
					redirect('admin/user');
				}
			}
		}
	}

	public function delete($id)
	{
		$data['auth'] = getCurrentUser();
		if ($data['auth']->role <> '1') {
			$data['config_web'] = $this->configuration->getConfig();
			$data['title'] = "Memperbaharui Akun";

			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('user/forbid');
			$this->load->view('templates/dashboard/footer');
		} else {
			$user = $this->user->get($id);
			deleteFolderWithFiles("user/" . $user->username);

			$message = setMessage($this->user->destroy($id), "menghapus");
			$this->session->set_flashdata('message', $message['message']);

			create_log(
				"Menghapus user dengan username ".$user->username. " dan email ".$user->email,
				"delete",
				getCurrentIdUser(),
				"User ".$user->username,
				$message['result'] ? "1" : "0"
			);

			redirect("admin/user");
		}
	}

	public function search()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Pencarian Akun";
		$data['auth'] = getCurrentUser();

		$data['users_data'] = $this->user->getAll();

		$this->load->view('templates/dashboard/header', $data);
		if ($data['auth']->role <> 1) {
			$this->load->view('user/forbid');
		} else {
			if (isset($_GET['q'])) {
				$data['search'] = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
				$data['result'] = $this->user->find($data['search']);

				$this->load->view('user/search', $data);
			} else {
				$this->load->view('user/index');
			}
		}
		$this->load->view('templates/dashboard/footer');
	}

	public function setting()
	{
		$id = getCurrentIdUser();
		$data['config_web'] = $this->configuration->getConfig();
		$data['title'] = "Manajemen Akun";
		$data['auth'] = getCurrentUser();

		$data['users'] = $this->user->get($id);

		$this->form_validation->set_rules('name', 'Nama', 'required|trim|alpha',
								array(
										'alpha'	=> 'Hanya karakter alfabet yang diperbolehkan!'
								));
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_edit_check_email['.$id.']',
								array(
										'valid_email'	=> 'Silakan masukkan email yang valid! cth: email@email.com'
								));
		$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|callback_edit_check_username['.$id.']|alpha_numeric',
								array(
										'min_length'	=> 'Silakan masukkan username minimal 4 karakter!',
										'alpha_numeric'	=> 'Hanya karakter alfabet dan numeric yang diperbolehkan!'
								));
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[4]',
								array(
										'min_length'	=> 'Silakan masukkan password minimal 4 karakter!'
								));

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dashboard/header', $data);
			$this->load->view('user/setting', $data);
			$this->load->view('templates/dashboard/footer');
		} else {
			if (!empty($_FILES['image']['name'])) {
				$img_upload = doUploadImage('user/' . $data['users']->username . '/images');
				deleteFile("user/" . $data['users']->username . "/images", $this->input->post('image_hidden', true));
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
				redirect('admin/user/setting/');
			}

			if ($this->input->post('username', true) != $data['users']->username) {
				renameFolderUser($data['users']->username, $this->input->post('username', true));
			}

			$password = $this->input->post('password', true) == "" ? $data['users']->password : password_hash($this->input->post('password', true), PASSWORD_DEFAULT);
			$user = [
				'name' => $this->input->post('name', true),
				'email' => $this->input->post('email', true),
				'username' => $this->input->post('username', true),
				'password' => $password,
				'image' => $img_name,
				'updated_at' => date('Y-m-d H:i:s', time())
			];

			$message = setMessage($this->user->update($user, $id), "memperbaharui");
			$this->session->set_flashdata('message', $message['message']);

			create_log(
				"Mengubah user dengan id ".$id,
				"update",
				getCurrentIdUser(),
				"User ".$data['user']->username,
				$message['result'] ? "1" : "0"
			);

			if (!$message['result']) {
				redirect('admin/user/setting/');
			} else {
				$update_user = [
					'username' => $this->input->post('username', true),
					'image' => $img_name
				];
				$this->session->set_userdata($update_user);
				redirect('admin/user/setting/');
			}
		}
	}

	public function edit_check_username($username, $id)
	{
		$current_username = $this->user->get($id)->username;
		$count = count($this->user->find($username));
		$in_db_username = $count > 0 ? $this->user->find($username)[0]->username : false;

		if ($current_username == $username) {
			return TRUE;
		} else if ($count > 0 && $username == $in_db_username) {
            $this->form_validation->set_message('edit_check_username', 'Username '. $username .' sudah terdaftar!');
            return FALSE;
        } else {
            return TRUE;
        }
	}

	public function edit_check_email($email, $id)
	{
		$current_email = $this->user->get($id)->email;
		$count = count($this->user->find($email));
		$in_db_email = $count > 0 ? $this->user->find($email)[0]->email : false;

		if ($current_email == $email) {
			return TRUE;
		} else if ($count > 0 && $email == $in_db_email) {
            $this->form_validation->set_message('edit_check_email', 'Email '. $email .' sudah terdaftar!');
            return FALSE;
        } else {
            return TRUE;
        }
	}

	public function checkIfExists()
	{
		$data = $this->input->post('data');
		echo count($this->user->find($data)) > 0 ? json_encode(["result" => true]) : json_encode(["result" => false]);
	}
}
