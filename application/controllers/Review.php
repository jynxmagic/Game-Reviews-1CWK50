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

		echo $this->ReviewModel->reviewCount();

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
}
