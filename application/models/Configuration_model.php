<?php

class Configuration_model extends CI_Model
{
	private const TABLE =  "configurations";

	public function getAll()
	{
		return $this->db->get($this::TABLE)->result_object();
	}

	public function getConfig()
	{
		return $this->db->get($this::TABLE)->row_object();
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
}
