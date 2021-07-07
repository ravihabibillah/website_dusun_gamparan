<?php

function isLogin()
{
	$ci = &get_instance();
	if (!$ci->session->userdata('login')) {
		$loggedin = ['login', 'username', 'id', 'image'];
		$ci->session->unset_userdata($loggedin);
		redirect('admin/auth/login');
	}
}

function getUsername()
{
	$ci = &get_instance();
	return $ci->session->userdata('username');
}

function getCurrentIdUser()
{
	$ci = &get_instance();
	return $ci->session->userdata('id');
}

function getCurrentUser()
{
	$ci = &get_instance();
	$ci->load->model('User_model', 'user');

	$user = $ci->user->get($ci->session->userdata('id'));

	return $user;
}
