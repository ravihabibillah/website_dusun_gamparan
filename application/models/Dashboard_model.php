<?php

class Dashboard_model extends CI_Model
{
	public function getNumRows($table, $query = null)
	{
		if ($query != null) {
			$result = $this->db->query($query);
		} else {
			$result = $this->db->get($table);
		}

		return $result->num_rows();
	}

	public function getTotalArticles()
	{
		return $this->db
			->select("COUNT(*) as hasil")
			->get("blogs")
			->row_object()
			->hasil;
	}

	public function getTotalGalleries()
	{
		return $this->db
			->select("COUNT(*) as hasil")
			->get("galleries")
			->row_object()
			->hasil;
	}

	public function getHistoryUser($id_user)
	{
		return $this->db
			->select('ip, user_agent, created_at, jenis, is_success')
			->where(['id_user' => $id_user, 'EXTRACT(MONTH FROM created_at) = ' => date('n')])
			->where_in('jenis', array('login', 'logout'))
			->order_by('created_at', 'desc')
			->get('logs')
			->result_object();
	}

	public function getHistoryActivity($id_user)
	{
		return $this->db
			->select('keterangan, created_at, jenis, is_success')
			->where(['id_user' => $id_user, 'EXTRACT(MONTH FROM created_at) = ' => date('n')])
			->where_not_in('jenis', array('login', 'logout'))
			->order_by('created_at', 'desc')
			->get('logs')
			->result_object();
	}
}
