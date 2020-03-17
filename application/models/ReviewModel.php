<?php


class ReviewModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * Count all current reviews.
	 *
	 * @param string $slug optional, counts all reviews with specified slug.
	 * @return mixed
	 */
	public function reviewCount($slug = "")
	{
		if($slug != "") $this->db->where('slug', $slug);

		return $this->db->count_all_results('activereviews', TRUE);
	}

	/**
	 * Returns the latest reviews as objects.
	 *
	 * @param int $start_pos optional adds LIMIT $start_pos, 6
	 * @param string $q optional adds WHERE slug = $q
	 * @return mixed
	 */
	public function getLatest6Reviews($start_pos = 0, $q = "") //todo query search string
	{
		//"Latest" reviews
		$this->db->order_by('ID', 'DESC');

		//generate query
		$query = $this->db->limit(6, $start_pos)->from('activereviews');

		if($q != "")
		{
			//add where if slug exists
			$this->db->where('slug', $q);
		}

		//join users to get username
		$this->db->join('users', 'users.UID = activereviews.UserID');

		//return result
		return $this->db->get()->result();
	}

	/**
	 * Returns review object with specified ID.
	 * @param $id int
	 * @return mixed
	 */
	public function getReviewWithId($id)
	{
		$this->db->from('activereviews');
		$this->db->where('ID', $id);
		$this->db->join('users', 'users.UID = activereviews.UserID');
		$result = $this->db->get()->first_row();
		return $result;
	}

	/**
	 * Returns a list of all slugs which are unique.
	 *
	 * @return array of Strings
	 */
	public function getDistinctSlugs()
	{
		$this->db->select(array('GameName','slug'));
		$this->db->distinct();
		$this->db->from('activereviews');
		return $this->db->get()->result();
	}
}
