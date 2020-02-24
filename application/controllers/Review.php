<?php


class Review extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ReviewModel');
	}

	/**
	 * Paginates & Displays All Reviews
	 */
	public function index()
	{
		$this->load->library('pagination');

		$start_pos = $this->input->get('per_page', TRUE);

		$reviews = $this->ReviewModel->getLatest5Reviews($start_pos);

		$config['base_url'] = base_url('/reviews');
		$config['total_rows'] = $this->ReviewModel->reviewCount();
		$config['per_page'] = 5;
		$config['page_query_string'] = TRUE;

		$this->pagination->initialize($config);


		//data to pass to view
		$data['pagination'] = $this->pagination->create_links();
		$data['reviews'] = $reviews;
		$data['title'] = "Game Review - All Reviews";

		if(isset($this->session->userdata['is_logged_in']))
		{
			$data['is_logged_in'] = $this->session->userdata['is_logged_in'];
			$data['username'] = $this->session->userdata['username'];
		}

		$this->load->view("pages/reviews", $data);
	}

	/**
	 * Loads and  displays specified review
	 *
	 * @param $id id of review to display
	 */
	public function review($id)
	{
		$data['title'] = "Game Review - All Reviews";

		if(isset($this->session->userdata['is_logged_in']))
		{
			$data['is_logged_in'] = $this->session->userdata['is_logged_in'];
			$data['username'] = $this->session->userdata['username'];
		}

		//this is a very quick way of checking for injection via uri with number based urls
		if(is_numeric($id))
		{
			$review = $this->ReviewModel->getReviewWithId($id);
			if(isset($review->ID))
			{
				$data['review'] = $review;
				$this->load->view('pages/review', $data);
			}
			else
			{
				$data['heading'] = "404 - Does not exist";
				$data['message'] = "The review you are looking for does not exist >:(";
				$this->load->view('errors/html/error_404');
			}
		}
		else
		{
			$data['heading'] = "Oops! You broke it!";
			$data['message'] = "IDs are numeric only!";
			$this->load->view('errors/html/error_general', $data);
		}


	}

}
