<?php
class Recharge_service extends MY_Service{

	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function rechargeMycard($userId, $uuid, $openid, $mycardId){
		
		if( !isId($userId) ) {
			return returnMsg('error_userid');
		}
		if( !$uuid ) {
			return returnMsg('error_uuid');
		}
		if( !isId( $mycardId ) ) {
			return returnMsg('error_mycardid');
		}
		
		$this->load->model('mycard_model');
		$mycard = $this->mycard_model->oneByMycardid($mycardId);
		if( !$mycard ) {
			return returnMsg('error_mycard');
		}
		if( $mycard['uid'] !== $uuid ) {
			return returnMsg('error_uuid');
		}
		if( $mycard['accounts'] !== 'balance' ) {
			return returnMsg('error_not_balance');
		}
		
		
		$orderCode = makeOrderCode();
		$fullMoney = $mycard['money'] * 100;
		$trueMoney = $mycard['money'] * 100;//实付金额 可能有折扣 如果有折扣就乘以折扣系数
		$ucardNo = $mycard['card_no'];
		$sid = $mycard['sid'];
		$timeValidity = $mycard['validity_day'];	
		$cardType = $mycard['cardid'];
		
		$this->db->trans_start();
		
		$this->load->model('ucard_order_model');
		$ucardOrderId = $this->ucard_order_model->add($uuid, $cardType, $mycardId, 'recharge', $ucardNo, $timeValidity, round($fullMoney/100, 2), round($trueMoney/100, 2), round($trueMoney/100, 2), $sid);
		
		$this->load->model('event_recharge_mycard_model');
		$add = $this->event_recharge_mycard_model->add($userId, $uuid, $mycardId, $ucardOrderId, $orderCode, $fullMoney, $trueMoney);
		
		$complete = $this->db->trans_complete();
		if( !$complete ) {
			return returnMsg('error_add');
		}
		
		//微信支付 jsapi参数生成
		$this->load->service('wechat_jsapi_pay_service');
		
		$unifiedOrder = $this->wechat_jsapi_pay_service->unifiedOrder($openid, '储值卡续费', $orderCode, $trueMoney);
		
		
		if( $unifiedOrder['msg'] !== 'success' || empty($unifiedOrder['data']['jsApiParameters']) ) {
			return returnMsg( 'error_unifiedOrder' );
		}
		
		return $unifiedOrder;
		
	}
	
	
	
	/**
	     * 微信支付通知后台事件处理
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function oneWxpayNotifyLogHandle()
	{
		
		$this->load->model('wxpay_notify_log_model');
		$oneLog = $this->wxpay_notify_log_model->oneHandle();
		if( empty($oneLog) ) {
			
			return returnMsg('block');
		}
		
		$toRunning = $this->wxpay_notify_log_model->updateState($oneLog['id'], 'running');
		if( !$toRunning ) {
			return returnMsg('error_update_toRunning');
		}
		
		$this->db->trans_start();
		
		$this->load->model('event_recharge_mycard_model');
		$orderOne = $this->event_recharge_mycard_model->oneByCodeForUpdate($oneLog['out_trade_no']);
		
		if( empty($orderOne) ) {
			$this->wxpay_notify_log_model->updateState($oneLog['id'], 'error', '查询不到该笔订单');
			$this->db->trans_complete();
			return returnMsg('error_empty_order');
		}
		if( $orderOne['state'] === 'error' ) {
			$this->wxpay_notify_log_model->updateState($oneLog['id'], 'already_error', '订单已处理(error)');
			$this->db->trans_complete();
			return returnMsg('continue');
		}elseif( $orderOne['state'] === 'done' ) {
			$this->wxpay_notify_log_model->updateState($oneLog['id'], 'already_done', '订单已处理(done)');
			$this->db->trans_complete();
			return returnMsg('continue');
		}
		//检查金额
		if( $orderOne['true_money'] != $oneLog['total_fee'] ) {
			$this->event_recharge_mycard_model->updateState($orderOne['id'], 'error');
			$this->wxpay_notify_log_model->updateState($oneLog['id'], 'error', '订单金额核对错误');
			$this->db->trans_complete();
			return returnMsg('error_order_money');
		}
		
		$this->load->model('mycard_model');
		$mycard = $this->mycard_model->oneByMycardid($orderOne['mycard_id']);
		if( empty($mycard) ) {
			$this->event_recharge_mycard_model->updateState($orderOne['id'], 'error');
			$this->wxpay_notify_log_model->updateState($oneLog['id'], 'error', '查询不到对应储值卡');
			$this->db->trans_complete();
			return returnMsg('error_mycard');
		}
		
		$rechargeBalance = $this->mycard_model->transactionChangeBalance($orderOne['uuid'], $orderOne['mycard_id'], $mycard['money_available'], $mycard['money'], 'add');
		if( !$rechargeBalance ) {
			$this->event_recharge_mycard_model->updateState($orderOne['id'], 'error');
			$this->wxpay_notify_log_model->updateState($oneLog['id'], 'error', '会员卡余额增加错误');
			$this->db->trans_complete();
			return returnMsg('error_add_balance');
		}
		
		if( !isId($orderOne['ucard_order_id']) ) {
			$this->event_recharge_mycard_model->updateState($orderOne['id'], 'error');
			$this->wxpay_notify_log_model->updateState($oneLog['id'], 'error', 'ucard_order_id 错误');
			$this->db->trans_complete();
			return returnMsg('error_ucard_order_id');
		}
		
		//修改充值订单状态
		$this->load->model('ucard_order_model');
		$this->ucard_order_model->updateComplete($orderOne['ucard_order_id']);
		
		$this->wxpay_notify_log_model->updateState($oneLog['id'], 'done');
		$this->event_recharge_mycard_model->updateState($orderOne['id'], 'done');
		$complete = $this->db->trans_complete();
		
		return returnMsg('continue');
		
	}
	
	
}	