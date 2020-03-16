<?php


class ReviewModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function reviewCount($slug = "")
	{
		if($slug != "") $this->db->where('slug', $slug);

		return $this->db->count_all_results('activereviews', TRUE);
	}

	public function getLatest6Reviews($start_pos = 0, $q = "") //todo query search string
	{
		$this->db->order_by('ID', 'DESC');

		$query = $this->db->limit(6, $start_pos)->from('activereviews');

		if($q != "")
		{
			$this->db->where('slug', $q);
		}

		$this->db->join('users', 'users.UID = activereviews.UserID');


		return $this->db->get()->result();
	}

	public function getReviewWithId($id)
	{
		$this->db->from('activereviews');
		$this->db->where('ID', $id);
		$this->db->join('users', 'users.UID = activereviews.UserID');
		$result = $this->db->get()->first_row();
		return $result;
	}

	public function getDistinctSlugs()
	{
		$this->db->select(array('GameName','slug'));
		$this->db->distinct();
		$this->db->from('activereviews');
		return $this->db->get()->result();
	}
}
