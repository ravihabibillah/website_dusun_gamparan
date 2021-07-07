<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
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
		$data['title'] = "Dashboard";
		$data['auth'] = getCurrentUser();

		$data['history_user'] = $this->dashboard->getHistoryUser(getCurrentIdUser());
		$data['history_activity'] = $this->dashboard->getHistoryActivity(getCurrentIdUser());
		$data['total_articles'] = $this->dashboard->getTotalArticles();
		$data['total_galleries'] = $this->dashboard->getTotalGalleries();

		$this->load->view('templates/dashboard/header', $data);
		$this->load->view('dashboard/home', $data);
		$this->load->view('templates/dashboard/footer', $data);
	}
}
