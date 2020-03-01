<?php
class Order_remind_service extends MY_Service{
	

	public function __construct() {
		parent::__construct();
	}
	
	
	
	public function oneConsumptionOrderRemind()
	{
		
		$this->load->model('order_remind_model');
		$one = $this->order_remind_model->oneConsumptionInit();
		if( empty($one) ) {
			return returnMsg('block');
		}
		$id = $one['id'];
		$updateDoing = $this->order_remind_model->updateStateDoing($id);
		if( !$updateDoing ) {
			//log_message('error', 'error_update_order_remind_doing,id:'.$id);
			return returnMsg('error_update_doing');
		}
		//consumption消费单
		//获取推送相关信息
		$this->load->model('order_model');
		$orderId = $one['order_id'];
		$order = $this->order_model->one($orderId);
		if( empty($order) ) {
			return returnMsg('error_order');
		}
		
		$uuid = $order['user_id'];
		$storeCode = $order['store_id'];
		$orderCreateTime = $order['create_time'];
		$orderStartTime = $order['start_time'];
		
		$this->load->model('store_model');
		$store = $this->store_model->oneByCode($storeCode);
		if( empty($store)  ) {
			return returnMsg('error_store');
		}
		
		$this->load->model('login_wechat_model');
		$wechatInfo = $this->login_wechat_model->oneByUid($uuid);
		if( empty($wechatInfo) ) {
			return returnMsg('error_wechat');
		}
		
		$orderDate = date('Y-m-d H:i:s', $orderCreateTime);
		$storeName = $store['sname'];
		$orderMoney = $order['actual_price']/100;
		$openid = $wechatInfo['openid'];
		$url = base_url('runningAccount/consumptionDetail/'.$orderId);
		
		$msgArray = array(
				'first' => '消费提醒',
				'keyword1'	=> $orderDate, //订单时间
				'keyword2'	=> $storeName, //门店名称
				'keyword3'  => '服务订单', //订单类型
				'keyword4'  => $orderMoney,//订单金额
				'remark'    => '点击查看订单详情'
		);
		
		$this->load->service('wechat_api_service');
		$sendResponse = $this->wechat_api_service->sendTemplateMsg($openid, $url, 'consumption_order_remind', $msgArray, '#173177');
		if( $sendResponse['msg'] !== 'success' ) {
			$this->order_remind_model->updateStateError($id, $sendResponse['data'] ? json_encode($sendResponse['data']) : null );
			return returnMsg('error_send_response');
		}
		
		$updateDone = $this->order_remind_model->updateStateDone($id, json_encode($sendResponse['data']) );
		if( !$updateDone ) {
			//log_message('error', 'error_update_order_remind_done,id:'.$id);
			return returnMsg('error_update_done');
		}
		
		return returnMsg('continue');
	}
	
	public function oneAppointmentOrderRemind()
	{
		
		$this->load->model('order_remind_model');
		$one = $this->order_remind_model->oneAppointmentInitBeforeTwoHours();
		
		if( empty($one) ) {
			return returnMsg('block');
		}
		$id = $one['id'];
		$updateDoing = $this->order_remind_model->updateStateDoing($id);
		if( !$updateDoing ) {
			//log_message('error', 'error_update_order_remind_doing,id:'.$id);
			return returnMsg('error_update_doing');
		}
		
		$uuid = $one['user_id'];
		$storeCode = $one['store_id'];
		$orderCreateTime = $one['create_time'];
		$orderStartTime = $one['start_time'];
		
		$this->load->model('store_model');
		$store = $this->store_model->oneByCode($storeCode);
		if( empty($store)  ) {
			return returnMsg('error_store');
		}
		
		$this->load->model('login_wechat_model');
		$wechatInfo = $this->login_wechat_model->oneByUid($uuid);
		if( empty($wechatInfo) ) {
			return returnMsg('error_wechat');
		}
		

		$orderDate = date('Y-m-d H:i:s', $orderStartTime);
		$storeName = $store['sname'];
		$openid = $wechatInfo['openid'];
		

		$msgArray = array(
				'first' => '预约提醒',
				'keyword1'	=> $orderDate, //预约时间
				'keyword2'	=> $storeName, //预约门店
				'remark'    => '请您准时前往门店享受服务'
		);
		
		$this->load->service('wechat_api_service');
		$sendResponse = $this->wechat_api_service->sendTemplateMsg($openid, null, 'appointment_order_remind', $msgArray, '#173177');
		if( $sendResponse['msg'] !== 'success' ) {
			$this->order_remind_model->updateStateError($id, $sendResponse['data'] ? json_encode($sendResponse['data']) : null );
			return returnMsg('error_send_response');
		}
		
		$updateDone = $this->order_remind_model->updateStateDone($id, json_encode($sendResponse['data']) );
		if( !$updateDone ) {
			//log_message('error', 'error_update_order_remind_done,id:'.$id);
			return returnMsg('error_update_done');
		}
		
		return returnMsg('continue');
		
	}
	
}