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
}


