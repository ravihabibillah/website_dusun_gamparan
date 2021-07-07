<?php

class Auth_model extends CI_Model
{
	private const TABLE = 'users';

	public function check($user)
	{
		$where = [
			'email' => $user['email'],
			'username' => $user['email']
     	];

		return $this->db->select('users.*')
			->from($this::TABLE)
			->or_where($where)
			->get()
			->row_object();
	}
}
