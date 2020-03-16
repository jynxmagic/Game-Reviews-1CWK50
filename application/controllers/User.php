<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/***
 * @Class User
 * @extends CI_Controller
 * @author chris carr
 * @since 23/02/2020
 */
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'security'));
		$this->load->library('form_validation');
		$this->load->model('UserModel');
	}

	/**
	 * Displays the Login page
	 */
	public function login()
	{
		$data['title'] = "Game Review - Login";

		if(isset($this->session->userdata['is_logged_in']))
		{
			$data['is_logged_in'] = $this->session->userdata['is_logged_in'];
			$data['username'] = $this->session->userdata['username'];
		}

		$this->load->view("pages/login", $data);
	}

	/**
	 * Displays the register page
	 */
	public function register()
	{
		$data['title'] = "Game Review - register";
		if(isset($this->session->userdata['is_logged_in']))
		{
			$data['is_logged_in'] = $this->session->userdata['is_logged_in'];
			$data['username'] = $this->session->userdata['username'];
		}
		$this->load->view("pages/register", $data);
	}

	/**
	 * Log user out and redirect to referrer
	 */
	public function logout()
	{
		$this->load->library('session');
		$this->load->library('user_agent');

		//unset session data
		if(isset($this->session->userdata['is_logged_in']))
		{
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('is_logged_in');
		}


		//redirect to whence you came
		redirect($this->agent->referrer());
	}

	/**
	 * Loads Account of username and shows page
	 *
	 * @param $username
	 */
	public function view($username)
	{
		$username = xss_clean($username);
		$data['title'] = "Game Reviews - Account $username";
		if(isset($this->session->userdata['is_logged_in']))
		{
			$data['is_logged_in'] = $this->session->userdata['is_logged_in'];
			$data['username'] = $this->session->userdata['username'];
		}


		$user = $this->getUserByUsername($username);

		if($user !== FALSE)
		{
			$data['user'] = $user;
			$data['additional_scripts'] = array(base_url('application/scripts/vue/account_vue.js'));
			$this->load->view('pages/account', $data);
		}
		else
		{
			$data['heading'] = "404 - Could not find user";
			$data['message'] = "$username does not exist >:(";
			$this->load->view('errors/html/error_404', $data);
		}
	}

	/**
	 * @param $username
	 * returns a JSON response containing the user data
	 */
	public function getUserJsonByUsername($username)
	{
		$user = $this->getUserByUsername($username);

		echo json_encode($user);
	}

	/**
	 * updates the isAdmin property of specific user to supplied value
	 *
	 * @param $username username of user to update
	 * @param $is_admin value to update is_admin to
	 */
	public function updateIsAdmin($username, $is_admin)
	{
		$this->UserModel->updateIsAdmin($username, $is_admin);
	}

	/**
	 * Perform the register action
	 */
	public function do_register()
	{
		$isValid = $this->isValidPostData();

		if($isValid)
		{
			#get post data
			$data = array(
				'username' => xss_clean($this->input->post('username')),
				'password' => xss_clean($this->input->post('password'))
			);

			#create user
			$this->UserModel->createUser($data);

			#log user in
			$this->session->set_userdata(array(
				'is_logged_in' => true,
				'username' => $data['username']
			));

			#go home
			redirect('/');

		}
		else
		{
			# errorful data. let user know and show validation error (helper on view file)
			$data['error'] = "Couldn't register";

			$this->load->view('pages/register', $data);
		}


	}

	/***
	 * Called to perform the login action.
	 *
	 * @uri login/do-login
	 * @post username, password
	 */
	public function do_login()
	{
		##VALIDATION
		# user_guide/libraries/form_validation.html

		$validInput = $this->isValidPostData();

		if (!$validInput)
		{
			#validation failed
			$this->load->view('pages/login');
		}
		else
		{
			##VALIDATION SUCCESSFUL

			#GET POST
			#user_guide/libraries/input.html
			$data = array(
				'username' => xss_clean($this->input->post('username')),
			    'password' => xss_clean($this->input->post('password')) #xss filtering (cross site scripting)
			);
			$user = $this->getUserByUsername($data['username']);

			if($user !== FALSE)
			{
				#user exists
				if($this->validateUserPassword($data['password'], $user->UserPassword))
				{
					#password correct
					#login
					$this->setLoginSessionData($user);

					//go home
					redirect('/');
				}
				else
				{
					#invalid passsword, return to login page
					$data['error'] = 'Incorrect Password';
					$this->load->view('pages/login', $data);
				}
			}
			else
			{
				#invalid username
				$data['error'] = 'Username does not exist.';
				$this->load->view('pages/login', $data);
			}
		}
	}


	/**
	 * Validates post data
	 *
	 * @return bool true if post data valid
	 */
	private function isValidPostData()
	{
		$this->form_validation->set_rules('username', 'Username',
			array(
				'required',
				'trim',
				'minlength[5]',
				'maxlength[5]',
				array('valid_username', array($this->UserModel, 'isValidUsername')) /** callback function for verification which checks for valid user. see user_guide/libraries/form_validation.html#callable-use-anything-as-a-rule */
			),
			array(
				'required'      => 'You have not provided %s.',
				)
		);

		$this->form_validation->set_message('valid_username', "The username you have entered already exists."); /* create an error message for our custom error */

		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[16]');

		return $this->form_validation->run();
	}

	/**
	 * logs in the user
	 * @param $user user to set the data about
	 */
	private function setLoginSessionData($user)
	{
		$this->load->library('session');
		$session_data = array(
			'username' => $user->UserName,
			'is_logged_in' => true
		);
		$this->session->set_userdata($session_data);
	}

	/**
	 * get user in database by username
	 * @param $username to search
	 * @return bool user if found, or false
	 */
	public function getUserByUsername($username)
	{
		$user = $this->UserModel->getUserByUsername($username);

		if($user != null && isset($user->UserName) && isset($user->UserPassword))
		{
			return $user;
		}
		else
		{
			return false;
		}
	}

	/**
	 * returns true if password matches
	 * @param $password_plaintext
	 * @param $hashed_password
	 * @return bool
	 */
	private function validateUserPassword($password_plaintext, $hashed_password)
	{
		if(password_verify($password_plaintext, $hashed_password))
		{
			return true;
		}
		return false;
	}
}
