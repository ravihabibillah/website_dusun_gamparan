<?php

class Log_model extends CI_Model
{
	private const TABLE = "logs";

	public function insert($data)
	{
		return $this->db->insert($this::TABLE, $data);
	}

}
