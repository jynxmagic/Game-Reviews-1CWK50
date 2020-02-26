<?php


class CommentModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getAllCommentsForReview($id)
	{
		$query = $this->db->get_where('gamescomments', array('ReviewID' => $id));
		$result = $query->result();
		return $result;
	}

	public function insertCommentToReview($comment, $reviewid, $userid)
	{

		$insert_data = array(
			'UserID' => $userid,
			'ReviewID' => $reviewid,
			'UserComment' => $comment
		);

		$this->db->insert('gamescomments', $insert_data);
	}
}
