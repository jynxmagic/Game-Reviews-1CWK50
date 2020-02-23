<?php


class ReviewModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function reviewCount()
	{
		return $this->db->count_all('activereviews');
	}

	public function getLatest5Reviews($start_pos, $q = "")
	{
		$this->db->order_by('ID', 'DESC');
		$query = $this->db->get('activereviews', $start_pos, $start_pos+5);

		return $query->result();
	}
}
