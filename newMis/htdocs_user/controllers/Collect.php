<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collect extends MY_Controller {


	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view('glob/header.php');
		$this->load->view('collect/index.php');
		$this->load->view('glob/footer.php');
	}
	
	
	public function getList()
	{
		$type = $this->input->post('type', true);
		
		$this->load->service('collect_service');	
		$collect = $this->collect_service->ls($this->user['uuid'], $type);
		
		$data = array();
		$data['collect'] = $collect['data'];
		
		$this->load->view('collect/list.php', $data);
	}
	
	
	public function addCollect()
	{
		$type = $this->input->post('type');
		$id  = $this->input->post('id');
		
		$this->load->service('order_service');
		
		if( $type === 'consumption' ) {
			$order = $this->order_service->oneConsumption($id, $this->user['uuid']);		
		}elseif($type === 'recharge'){
			//充值订单的收藏取消了
			//$order = $this->order_service->oneRecharge($id, $this->user['uuid']);
			exit('error_type');
		}else{
			exit('error_type');
		}

		if( $order['msg'] !== 'success' || empty($order['data']) ) {
			exit('error_data');
		}
		
		
		$data = array();
		$data['order'] = $order['data'];
		$this->load->view('collect/addCollect.php', $data);
		
	}
	
	
	public function actionCollect()
	{
		$id = $this->input->post('id', true);
		$type = $this->input->post('type', true);
		$action = $this->input->post('action', true);
		
		$this->load->service('collect_service');
		if(  $action === 'add' ) {
			$result = $this->collect_service->add($this->user['uuid'], $id, $type);
		} elseif ( $action === 'delete' ) {
			$result = $this->collect_service->delete($this->user['uuid'], $id, $type);
		}else{
			exit('网络链接错误，请稍后再试');
		}

		if( $result['msg'] !== 'success' ) {
			exit('网络链接错误，请稍后再试');
		}
		exit('success');
		
	}
	
	public function actionDel()
	{
		$id = $this->input->post('id', true);
		$this->load->service('collect_service');
		$result = $this->collect_service->deleteById($this->user['uuid'], $id);
		if( $result['msg'] !== 'success' ) {
			exit('网络链接错误，请稍后再试');
		}
		exit('success');
	}
	
	
}