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
		$this->load->model('ReviewModel');
        // Consider creating new Models for different functionality.
    }

    public function index()
    {
        // Change this to whatever title you wish.
        $data['title']       = 'Games Reviews - Homepage';
		$data['result'] = $this->ReviewModel->getLatest6Reviews();
		$data['additional_scripts'] = array(base_url('application/scripts/home.js')); //home page js. for carousel
		if(isset($this->session->userdata['is_logged_in']))
		{
			$data['is_logged_in'] = $this->session->userdata['is_logged_in'];
			$data['username'] = $this->session->userdata['username'];
		}

		##get list of distinct slugs for pagination
		$data['slugs'] = $this->ReviewModel->getDistinctSlugs();



		#user_guide/libraries/pagination.html?highlight=pagination

		$this->load->library('pagination');

		$start_pos = $this->input->get('start_pos', TRUE);
		$slug = $this->input->get("slug", TRUE);

		$reviews = $this->ReviewModel->getLatest6Reviews($start_pos, $slug);


		#user_guide/libraries/pagination.html#customizing-the-pagination
		$config['base_url'] = site_url('/');
		$config['total_rows'] = $this->ReviewModel->reviewCount($slug);
		$config['per_page'] = 6;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'start_pos';
		$config['reuse_query_string'] = TRUE;


		##apply bootstrap style to generated pagination. basically repeated code for the config
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['previous_tag_open'] = '<li class="page-item">';
		$config['previous_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a  class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link'); //applied on a tag
		#maybe it could be done better
		#ref https://getbootstrap.com/docs/4.0/components/pagination/



		//load pagination with config we just made
		$this->pagination->initialize($config);


		//data to pass to view
		$data['pagination'] = $this->pagination->create_links();
		$data['reviews'] = $reviews;



        //Load the view and send the data accross.
        $this->load->view('pages/home', $data);
    }
  
}
