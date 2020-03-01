<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$this->load->service('session_service');
		$this->session_service->clearUserSession();
		$this->session_service->clearWechatSession();
		echo '退出成功';	
	}
}	