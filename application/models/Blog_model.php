<?php

class Blog_model extends CI_Model
{
	private const TABLE = "blogs";

	public function getAll()
	{
		return $this->db
			->select('blogs.*, u.name as writer')
			->join('users u', 'blogs.id_user = u.id')
			->order_by('created_at desc')
			->get($this::TABLE)->result_object();
	}

	public function get($id)
	{
		return $this->db
			->select('blogs.*, u.name as writer')
			->join('users u', 'blogs.id_user = u.id')
			->get_where($this::TABLE, ['blogs.id' => $id])->row_object();
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
			->select('blogs.*, u.name as writer')
			->from($this::TABLE)
			->join('users u', 'blogs.id_user = u.id')
			->like('title', $data)
			->get()
			->result_object();
	}
}
