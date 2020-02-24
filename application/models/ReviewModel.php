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

	public function getLatest5Reviews($start_pos, $q = "") //todo query search string
	{
		$this->db->order_by('ID', 'DESC');

		if($start_pos == "0" || $start_pos == "")
		{
			$query = $this->db->get('activereviews', 5);
		}
		else
		{
			$query = $this->db->get('activereviews', $start_pos, $start_pos+5);
		}

		return $query->result();
	}

	public function getReviewWithId($id)
	{
		$query = $this->db->get('activereviews', array('ID' => $id));

		return $query->first_row();
	}
}
