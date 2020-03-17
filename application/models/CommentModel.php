<?php


class CommentModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * Gets all comments as object for review with specified id.
	 * @param $id int of review for which comments to gather from
	 * @return array of comments table rows
	 */
	public function getAllCommentsForReview($id)
	{
		$this->db->from('gamescomments');
		$this->db->where('ReviewID', $id);
		$this->db->join('users', 'users.UID = gamescomments.UserID');
		$result =$this->db->get()->result();
		return $result;
	}

	/**
	 * Insert comment into specifed review.
	 * @param $comment String to add, must be escaped
	 * @param $reviewid int reviewId to add comment to
	 * @param $userid int userID of user who posted the comment
	 */
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
