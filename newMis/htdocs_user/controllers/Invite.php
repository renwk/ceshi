<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invite extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		
		$this->load->service('user_service');
		$wechat = $this->user_service->oneWechatByOpenid($this->wechat['openid']);
		
		$this->load->service('wechat_api_service');
		$param = $this->wechat_api_service->getJssdkParams();
	
		$data = array();
		$data['wechat']  = $wechat['data'];
		$data['jsSdkParams'] = $param['data'];
		$data['login_wechat_id'] = $wechat['data']['id'];
		
		$this->load->view('glob/header.php');
		$this->load->view('invite/index', $data);
		$this->load->view('glob/footer.php');
		
	}
	
	public function templateA($loginWechatId){
		$this->load->service('user_service');
		$wechat = $this->user_service->oneWechatById($loginWechatId);
		
		$data = array();
		$data['wechat']  = $wechat['data'];
		
		$this->load->view('glob/header.php');
		$this->load->view('invite/templateA', $data);
		$this->load->view('glob/footer.php');
		
	}
	
	public function templateB($loginWechatId){
		$this->load->service('user_service');
		$wechat = $this->user_service->oneWechatById($loginWechatId);
		
		$data = array();
		$data['wechat']  = $wechat['data'];
		
		$this->load->view('glob/header.php');
		$this->load->view('invite/templateB', $data);
		$this->load->view('glob/footer.php');
		
	}
	
	
}
