<?php


class Comments extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getCommentsForReview($reviewId)
	{
		header('Content-Type: application/json', 'Content-Type:%', '200');

		$comments = array(array("UserID" => "babe", "UserComment" => "I'm so cool just like this game :p"), array("UserID" => "babe", "UserComment" => "I'm so cool just like this game :p"));

		echo json_encode($comments);
	}
}
