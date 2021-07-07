<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('auth');
		$this->load->model('Auth_model', 'auth');
		$this->load->model('Configuration_model', 'configuration');
	}

	public function login()
	{
		$data['config_web'] = $this->configuration->getConfig();
		$this->load->view('templates/auth/header', $data);
		$this->load->view('auth/login', $data);
		$this->load->view('templates/auth/footer');
	}

	public function check_login()
	{
		$user = [
			'email' => $this->input->post('email', true),
			'password' => $this->input->post('password', true),
		];

		$isLogin = $this->auth->check($user);

		if ($isLogin) {
			if (password_verify($user['password'], $isLogin->password)) {
				$loggedin = [
					'login' => true,
					'id' => $isLogin->id,
					'username' => $isLogin->username,
					'role' => $isLogin->role,
				];
				$this->session->set_userdata($loggedin);
				$this->session->set_flashdata('message', '<div class="alert alert-success">Sukses melakukan login</div>');

				create_log(
					"Telah login user dengan id ".$isLogin->id,
					"login",
					$isLogin->id,
					"User ".$isLogin->username,
					"1"
				);

				redirect('admin/dashboard');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Password salah.</div>');

				create_log(
					"Telah login user dengan id ".$isLogin->id,
					"login",
					$isLogin->id,
					"User ".$this->input->post('email', true),
					"0"
				);

				redirect('admin/auth/login');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Username / Email tidak ditemukan.</div>');

			create_log(
				"Telah login user dengan username / email ".$this->input->post('email', true),
				"login",
				"0",
				"User ".$this->input->post('email', true),
				"0"
			);

			redirect('admin/auth/login');
		}
	}

	public function logout()
	{
		create_log(
			"Telah logout user dengan id ".getCurrentIdUser(),
			"logout",
			getCurrentIdUser(),
			"User ".getCurrentUser()->username,
			"1"
		);
		session_destroy();
		redirect('admin/auth/login');
	}
}
