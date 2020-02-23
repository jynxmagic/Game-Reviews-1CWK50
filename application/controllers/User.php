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
		$this->load->helper(array('form', 'url', 'security'));
		$this->load->library('form_validation');
		$this->load->model('UserModel');
	//	$this->load->helper('html');
	}

	/**
	 * Displays the Login page
	 */
	public function login()
	{
		$this->load->view("pages/login");
	}

	/**
	 * Displays the register page
	 */
	public function register()
	{
		$this->load->view("pages/register");
	}

	/**
	 * Called to perform the register action
	 */
	public function do_register()
	{
		//TODO validation etc

		$data = array(
			'username' => xss_clean($this->input->post('username')),
			'password' => xss_clean($this->input->post('password'))
		);

		$this->UserModel->createUser($data);

		//go home
		redirect('/');
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

		$validInput = $this->validateLoginInput();

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



	private function validateLoginInput()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[16]',
			array(
				'required'      => 'You have not provided %s.'
			)
		);

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
	private function getUserByUsername($username)
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

	public function logout()
	{

	}
}
