<?php


class Chat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function checkServerStatus()
	{
		$url = substr(base_url(), 0, -1).':1111';
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);

		$result = curl_exec($ch);

		if($result == "")
		{
			echo "false";
			return;
		}

		return $result;
	}
}
