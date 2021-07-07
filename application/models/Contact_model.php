<?php

class Contact_model extends CI_Model
{
	private const TABLE = "contacts";

	public function getAll()
	{
		return $this->db
			->order_by('created_at asc')
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
			->or_like('telp', $data)
			->or_like('name', $data)
			->or_like('name', strtolower($data))
			->or_like('name', strtoupper($data))
			->get()
			->result_object();
	}
}
