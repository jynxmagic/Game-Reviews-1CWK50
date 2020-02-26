<?php


class Comments extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CommentModel');
	}

	public function getCommentsForReview($reviewId)
	{

		header('Content-Type: application/json', 'Content-Type', '200');

		$comments = $this->CommentModel->getAllCommentsForReview($reviewId);

		echo json_encode($comments);
	}
}
