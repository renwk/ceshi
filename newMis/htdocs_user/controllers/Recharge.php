<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recharge extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$exceptIbCard = true;
		$this->load->service('card_service');
		$card = $this->card_service->lsMy($this->user['uuid'], 'normal', 'balance', $exceptIbCard);
		
		$data  = array();
		$data['card'] = $card['data'];
		
		$this->load->view('glob/header.php');
		$this->load->view('recharge/index', $data);
		$this->load->view('glob/footer.php');

	}
	
	
	public function actionCheckToPay()
	{
		$password = $this->input->post('password');
		
		$this->load->service('user_service');
		$check = $this->user_service->checkTransactionPassword($this->user['uuid'], $password);
		if($check['msg'] !== 'success') {
			exit('密码输入错误');
		}
		exit('success');
	}
	
	public function pay($mycardid)
	{
		//添加充值订单
		$this->load->service('event_order_service');
		$add = $this->event_order_service->rechargeMycard($this->user['userid'], $this->user['uuid'], $this->wechat['openid'], $mycardid);
		
		
		if( $add['msg'] !== 'success' || empty($add['data']['jsApiParameters']) ) {
			exit('error_pay');
		}
		
		$data['jsApiParameters'] = $add['data']['jsApiParameters'];
		
		$this->load->view('glob/header.php');
		$this->load->view('recharge/pay', $data);
		
		
	}
	
	
	
	
	public function storeList()
	{
		
		$latitude = $this->input->post('latitude', true);
		$longitude = $this->input->post('longitude', true);
		
		$this->load->service('store_service');
		$list = $this->store_service->lsByPosition($latitude, $longitude);
		
		$data = array();
		$data['store'] = $list['data'];
		
		$this->load->view('recharge/storeList', $data);
		
	}
	
	
}
