<?php


class CommentModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getAllCommentsForReview($id)
	{
		$this->db->from('gamescomments');
		$this->db->where('ReviewID', $id);
		$this->db->join('users', 'users.UID = gamescomments.UserID');
		$result =$this->db->get()->result();
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
