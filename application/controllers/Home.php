<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        // Consider if it would be best to autoload some of the helpers from here.
        $this->load->helper('url_helper');
        $this->load->helper('html');
        $this->load->helper('cookie');

        // Load in your Models below.
        $this->load->model('HomeModel');
		$this->load->model('ReviewModel');
        // Consider creating new Models for different functionality.
    }

    public function index()
    {
        // Change this to whatever title you wish.
        $data['title']       = 'Games Reviews - Homepage';
		$data['result'] = $this->HomeModel->getGame();
		$data['additional_scripts'] = array(base_url('application/scripts/home.js')); //home page js woo
		if(isset($this->session->userdata['is_logged_in']))
		{
			$data['is_logged_in'] = $this->session->userdata['is_logged_in'];
			$data['username'] = $this->session->userdata['username'];
		}

		$this->load->library('pagination');

		$start_pos = $this->input->get('per_page', TRUE);
		$slug = $this->input->get("slug");

		$reviews = $this->ReviewModel->getLatest6Reviews($start_pos, $slug);

		$config['base_url'] = site_url('/');
		$config['total_rows'] = $this->ReviewModel->reviewCount();
		$config['per_page'] = 6;
		$config['page_query_string'] = TRUE;

		//load pagination with config we just made
		$this->pagination->initialize($config);


		//review data to pass to view
		$data['pagination'] = $this->pagination->create_links();
		$data['reviews'] = $reviews;



        //Load the view and send the data accross.
        $this->load->view('pages/home', $data);
    }

    public function review($slug = NULL)
    {
        //Get the data from the model based on the slug we have.
        //Slugs match on to the knowledge around wildcard routes.
        //More information on slugs can be found here: https://codeigniter.com/user_guide/tutorial/news_section.html
        
    }

    //TODO: Create all other functions as required for further functionality (Comments, User and so on.)
    // Note: You can redirect to a page by using the redirect function as follows:
    /*
        //Redirect Home
        redirect('http://localhost/games-review');
    */
  
}
