<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RunningAccount extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		
		$this->load->view('glob/header.php');
		$this->load->view('runningAccount/index');
		$this->load->view('glob/footer.php');

	}
	
	public function getList()
	{
		
		$type = $this->input->post('type', true);
		
		if( $type === 'cousumption' ) {
			$this->load->service('order_service');
			$cousumption = $this->order_service->cousumptionList($this->user['uuid']);
			
			$data = array();
			$data['cousumption'] = $cousumption['data'];
			$data['type'] = 'cousumption';
		}elseif( $type === 'recharge' ) {
			$this->load->service('order_service');
			$recharge = $this->order_service->rechargeList($this->user['uuid']);
			
			$data = array();
			$data['recharge'] = $recharge['data'];
			$data['type'] = 'recharge';
		}else{
			exit('error_type');
		}
		$this->load->view('runningAccount/list', $data);
	}
	
	public function consumptionDetail($orderId)
	{
		$this->load->service('user_service');
		$user = $this->user_service->one($this->user['uuid']);
		
		$this->load->service('order_service');
		$order = $this->order_service->oneConsumption($orderId, $this->user['uuid']);
		
		if(  $order['msg'] !== 'success' || empty($order['data']) ) {
			exit('error_order');
		}
		
		$data = array();
		$data['order'] = $order['data'];
		$data['have_transaction_password'] = empty($user['data']['userinfo']['transaction_password']) ? false : true;
		
		$this->load->view('glob/header.php');
		$this->load->view('runningAccount/consumptionDetail', $data);
		$this->load->view('glob/footer.php');
		
	}
	
	public function rechargeDetail($orderId)
	{
		$data = array();
		
		$this->load->service('order_service');
		$order = $this->order_service->oneRecharge($orderId, $this->user['uuid']);
		
		$data['order'] = $order['data'];
		
		$this->load->view('glob/header.php');
		$this->load->view('runningAccount/rechargeDetail', $data);
		$this->load->view('glob/footer.php');
		
	}
	
	public function actionConfirmOrder()
	{
		$id = $this->input->post('id', true);
		$password = $this->input->post('password', true);
		
		$this->load->service('order_service');
		$result = $this->order_service->confirmOrder($this->user['uuid'], $id, $password);
		
		switch ( $result['msg'] ) {
			case 'success':
				exit('success');
				break;
			case 'error_password':
				exit('支付密码输入错误');
				break;
			default:
				exit('网络链接错误,请稍后再试');
				break;
		}
	}
	
	
}
