<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$this->load->service('coupon_service');
		
		$countOn = $this->coupon_service->countMy($this->user['uuid'], 'on');
		$countUsed = $this->coupon_service->countMy($this->user['uuid'], 'used');
		$countExpired = $this->coupon_service->countMy($this->user['uuid'], 'expired');
		
		$data = array();
		$data['countOn'] = $countOn['data'];
		$data['countUsed'] = $countUsed['data'];
		$data['countExpired'] = $countExpired['data'];
		
		$this->load->view('glob/header.php');
		$this->load->view('coupon/index.php', $data);
		$this->load->view('glob/footer.php');
	}

	public function getList()
	{
		$state = $this->input->post('state', true);
		
		$this->load->service('coupon_service');
		$coupon = $this->coupon_service->lsMy($this->user['uuid'], $state);
		
		$data = array();
		$data['coupon'] = $coupon['data'];
		
		$this->load->view('coupon/list.php', $data);
		 
	}


}