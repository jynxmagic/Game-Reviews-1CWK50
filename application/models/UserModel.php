<?php
##NOTE. NAMING CONVENTION IS INCORRECT BUT KEPT TO LOOK NORMAL
##SEE: user_guide/general/styleguide.html#class-and-method-naming
/***
 * @Class UserModel
 * @extends CI_Model
 * @author chris carr
 * @since 23/02/2020
 */
class UserModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * Creates a user in the database
	 * @param $data array {username: "", password: ""}. password does not need to be hashed, it's obfuscated within this method.
	 */
	public function createUser($data)
	{
		$username = $data['username'];
		//hash password using default tech
		$hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);

		//hard coded
		$dark_mode = 1;

		$insert_data = array(
			'UserName'	=> $username,
			'UserPassword' => $hashed_password,
			'DarkMode' => $dark_mode
		);

		$this->db->insert('users', $insert_data);
	}

	/**
	 * returns a user based on username
	 *
	 * @param $username string username to search for
	 * @return user
	 */
	public function getUserByUsername($username)
	{
		if(isset($username))
		{
			$query = $this->db->get_where('users', array('UserName' => $username));
			//there should only ever be 1 row
			$result = $query->first_row();
			return $result;
		}
	}


	/**
	 * Updates whether a user is an administrator or not.
	 *
	 * @param $username string username of user to update
	 * @param $is_admin boolean
	 */
	public function updateIsAdmin($username, $is_admin)
	{
		if($is_admin == "true")
		{
			$is_admin = 1;
		}
		else
		{
			$is_admin = 0;
		}
		if(isset($username))
		{
			$this->db->set('isAdmin', $is_admin);
			$this->db->where('UserName', $username);
			$this->db->update('users');
		}
	}


	/**
	 * Updates whether a user has DarkMode styles or not
	 *
	 * @param $username string username of user to update
	 * @param $darkmode boolean
	 */
	public function updateDarkMode($username, $darkmode)
	{
		if($darkmode == "true")
		{
			$darkmode = 1;
		}
		else
		{
			$darkmode = 0;
		}
		if(isset($username))
		{
			$this->db->set('DarkMode', $darkmode);
			$this->db->where('UserName', $username);
			$this->db->update('users');
		}
	}
}


