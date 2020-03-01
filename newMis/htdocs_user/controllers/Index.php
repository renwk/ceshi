<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		
		$this->load->service('user_service');
		$user = $this->user_service->one($this->user['uuid']);

		$wechat = $this->user_service->oneWechatByOpenid($this->wechat['openid']);
		
		$data = array();
		$data['userinfo'] = $user['data']['userinfo'];
		$data['wechat']  = $wechat['data'];
		$data['balance'] = $user['data']['balance'];
		$data['cardNums'] = $user['data']['cardNums'];
		$data['couponNums'] = $user['data']['couponNums'];


		$this->load->view('glob/header.php');
		$this->load->view('index/index', $data);
		$this->load->view('glob/footer.php');
	}
	
	
	public function actionReadAgreement()
	{
	    
	    $this->load->service('user_service');
	    $this->user_service->readAgreement($this->wechat['openid']);
	    exit('success');
	    
	}
	
}
