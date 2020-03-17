<?php


class Chat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}


	/**
	 * Checks to see if the node server is online. If node server is only it returns the response data "true"
	 */
	public function checkServerStatus()
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, USER_CONFIGURATION['node_server']['ip'].':'.USER_CONFIGURATION['node_server']['port']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);

		echo $result;
	}
}
