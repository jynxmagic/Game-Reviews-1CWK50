<?php


class Comments extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CommentModel');
	}


	/**
	 * Get all comments for review with specified ID
	 *
	 * @param $reviewId
	 */
	public function getCommentsForReview($reviewId)
	{

		header('Content-Type: application/json', 'Content-Type', '200');

		$comments = $this->CommentModel->getAllCommentsForReview($reviewId);

		echo json_encode($comments);
	}

	/**
	 * POST comment to review with specified ID.
	 * POST: {comment: "ex."}
	 * @param $reviewId
	 */
	public function postCommentToReview($reviewId)
	{
		//first lets get the post message
		$comment = $this->input->post('comment');

		if(!empty($comment)) //dont post empty comments
		{
			// we need to get the userid of the active user who is posting. lets get that from the user model
			$username = $this->session->userdata['username']; //first get username from session

			$this->load->model('UserModel');

			//get full user obj from model
			$user = $this->UserModel->getUserByUsername($username);

			//if the user exists
			if($user->UID)
			{
				//we have all the data we need, and its been sanitized. lets input the posted data now
				$this->CommentModel->insertCommentToReview($comment, $reviewId, $user->UID);
			}
			else
			{
				set_status_header(500);
			}
		}
		else
		{
			set_status_header(500);
		}
	}
}
