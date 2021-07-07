<?php

class User_model extends CI_Model
{
	private const TABLE = "users";

	public function getAll()
	{
		return $this->db
			->order_by('role desc, created_at asc')
			->get($this::TABLE)->result_object();
	}

	public function get($id)
	{
		return $this->db->get_where($this::TABLE, ['id' => $id])->row_object();
	}

	public function insert($data)
	{
		return $this->db->insert($this::TABLE, $data);
	}

	public function update($data, $id)
	{
		$this->db->update($this::TABLE, $data, ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function destroy($id)
	{
		return $this->db->delete($this::TABLE, ['id' => $id]);
	}

	public function find($data)
	{
		return $this->db
			->select("*")
			->from($this::TABLE)
			->like('email', $data)
			->or_like('username', $data)
			->get()
			->result_object();
	}

	public function getRole($data)
	{
		return $this->db
			->select("role")
			->from($this::TABLE)
			->where('username', $data)
			->or_where('email', $data)
			->get()
			->row_object();
	}
}
