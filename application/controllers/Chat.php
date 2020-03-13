<?php


class Chat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function checkServerStatus()
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, USER_CONFIGURATION['node_server']['ip']);
		curl_setopt($ch, CURLOPT_PORT, USER_CONFIGURATION['node_server']['port']);
		curl_setopt($ch, CURLOPT_LOCALPORT, USER_CONFIGURATION['node_server']['port']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);

		$result = curl_exec($ch);

		curl_close($ch);

		return $result;
	}
}
