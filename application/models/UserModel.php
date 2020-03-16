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
	 * @param $data username & password
	 */
	public function createUser($data)
	{
		$username = $data['username'];
		$hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
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
	 * @param $username username to search for
	 */
	public function getUserByUsername($username)
	{
		if(isset($username))
		{
			$query = $this->db->get_where('users', array('UserName' => $username));
			$result = $query->first_row();
			return $result;
		}
	}

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
	 * callback function for username verification by codeigniter to check if the username is valid
	 * @param $username
	 * @return bool
	 */
	public function isValidUsername($username)
	{
		//if username already exists it is invalid
		$user = $this->getUserByUsername($username);
		if(isset($user->UserName)) return false;
		return true;
	}
}


