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

	public function getLatest6Reviews($start_pos = 0, $q = "") //todo query search string
	{
		$this->db->order_by('ID', 'DESC');

		$query = $this->db->limit(6, $start_pos)->from('activereviews');

		if($q != "")
		{
			$this->db->where('slug', $q);
		}

	//	show_error($this->db->get_compiled_select(FALSE));

		return $this->db->query($this->db->get_compiled_select())->result();
	}

	public function getReviewWithId($id)
	{
		$query = $this->db->get_where('activereviews', array('ID' => $id));
		$result = $query->first_row();
		return $result;
	}
}
