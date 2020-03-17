<?php


class Review extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ReviewModel');
	}

	/**
	 * Loads and  displays specified review
	 *
	 * @param $id id of review to display
	 */
	public function review($id)
	{
		$data['title'] = "Game Review - All Reviews";
		//we have additional css on the review page
		$data['additional_css'] = array('application/css/review.css');

		if(isset($this->session->userdata['is_logged_in']))
		{
			$data['is_logged_in'] = $this->session->userdata['is_logged_in'];
			$data['username'] = $this->session->userdata['username'];
		}

		//this is a very quick way of checking for injection via uri with number based urls - imo
		if(is_numeric($id))
		{
			$review = $this->ReviewModel->getReviewWithId($id);
			if(isset($review->ID))
			{
				$data['review'] = $review;

				//only add the vue script if the page has comments enabled
				if(isset($review->GameComments_YN) && $review->GameComments_YN == "Y")
				{
					$data['additional_scripts'] = array(base_url('application/scripts/vue/review_vue.js'));
				}

				$this->load->view('pages/review', $data);
			}
			else
			{
				//review does not exist
				$data['heading'] = "404 - Does not exist";
				$data['message'] = "The review you are looking for does not exist >:(";
				$this->load->view('errors/html/error_404');
			}
		}
		else
		{
			//review id is not numeric
			$data['heading'] = "Oops! You broke it!";
			$data['message'] = "IDs are numeric only!";
			$this->load->view('errors/html/error_general', $data);
		}


	}

}
