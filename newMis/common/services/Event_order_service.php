<?php

class Event_order_service extends MY_Service{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function buyCard($userid, $uuid, $openid, $cardid)
    {
        
        if( !isId($userid) ) {
            return returnMsg('error_userid');
        }
        if( !$uuid ) {
            return returnMsg('error_uuid');
        }
        if( !$openid ) {
            return returnMsg('error_openid');
        }
        if( !isId($cardid) ) {
            return returnMsg('error_cardid');
        }
        
        $this->load->model('card_model');
        $card = $this->card_model->one($cardid);
        if( !$card ) {
            return returnMsg('error_card');
        } 
        if( $card['is_online_sales'] != 'yes' || $card['type'] != 'shop' || $card['accounts'] != 'balance' ) {
            return returnMsg('error_card');
        }
        
        $cardType = $card['cardid'];
        $validityDay = $card['validity_day'];	
        $ucardNo = '';
        $sid = '5830c100_1d5a_7fd0_a9d4_459222c331a2';//泰美好总部的storeid 定死了	
        $fullMoney = $card['money'] * 100;
        $trueMoney = $card['money'] * 100;//实付金额 可能有折扣 如果有折扣就乘以折扣系数
        $orderCode = makeOrderCode();
        
        $this->db->trans_start();
        
        //生成一张待支付的我的卡
        $this->load->model('mycard_model');
        $mycardid = $this->mycard_model->transactionAdd($card['cardid'], $uuid, $card['money'],  time()+$card['validity_day']*3600*24, $sid);
        
        //生成一个购卡订单
        $this->load->model('ucard_order_model');
        $ucardOrderId = $this->ucard_order_model->add($uuid, $cardType, $mycardid, 'buy', $ucardNo, $validityDay, round($fullMoney/100, 2), round($trueMoney/100, 2), round($trueMoney/100, 2), $sid);
        
        //写入事件表
        $this->load->model('event_order_model');
        $eventOrderId = $this->event_order_model->add($orderCode, 'buy');
        $trueMoney = 1;
        
        $this->load->model('event_buy_card_model');
        $add = $this->event_buy_card_model->add($eventOrderId, $userid, $uuid, $mycardid, $ucardOrderId, $fullMoney, $trueMoney);
        
        $complete = $this->db->trans_complete();
        if( !$complete ) {
            return returnMsg('error_add');
        }
        
        //微信支付 jsapi参数生成
        $this->load->service('wechat_jsapi_pay_service');
        
        $unifiedOrder = $this->wechat_jsapi_pay_service->unifiedOrder($openid, '储值卡购买', $orderCode, $trueMoney);
        
        if( $unifiedOrder['msg'] !== 'success' || empty($unifiedOrder['data']['jsApiParameters']) ) {
            return returnMsg( 'error_unifiedOrder' );
        }
        
        $return = array(
            'jsApiParameters' => $unifiedOrder['data']['jsApiParameters'],
            'mycardid' => $mycardid,
            'ucardOrderId' => $ucardOrderId
        );
        
        return  returnMsg('success', $return);
        
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
        
        
        //写入事件表
        $this->load->model('event_order_model');
        $eventOrderId = $this->event_order_model->add($orderCode, 'recharge');
        $trueMoney = 1;
        
        $this->load->model('event_recharge_mycard_model');
        $add = $this->event_recharge_mycard_model->add($eventOrderId, $userId, $uuid, $mycardId, $ucardOrderId, $fullMoney, $trueMoney);
        
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
        
        $this->load->model('event_order_model');
        $eventOrder = $this->event_order_model->oneByCode($oneLog['out_trade_no']);
        
        if( empty($eventOrder) ) {
            $this->wxpay_notify_log_model->updateState($oneLog['id'], 'error', '查询不到该笔订单');
            return returnMsg('error_empty_order');
        }
        
        if( $eventOrder['action'] === 'buy' ) {
            
          
            return $this->buyCardNotify($eventOrder['id'], $oneLog);
            
            
        }elseif( $eventOrder['action'] === 'recharge' ) {
            
            return $this->rechargeMycardNotify($eventOrder['id'], $oneLog);
            
            
        }else{
            
            $this->wxpay_notify_log_model->updateState($oneLog['id'], 'error', '订单action错误');
            return returnMsg('error_action');
            
        }
        
        
                
        
        
    }
    
    
    protected function buyCardNotify($orderId, $oneLog)
    {
        
        $this->db->trans_start();
        
        
        $this->load->model('event_buy_card_model');
        $this->load->model('wxpay_notify_log_model');
        
        $orderOne = $this->event_buy_card_model->oneForUpdate($orderId);
        
        if( !$orderOne ) {
            
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
            $this->event_buy_card_model->updateState($orderOne['id'], 'error');
            $this->wxpay_notify_log_model->updateState($oneLog['id'], 'error', '订单金额核对错误');
            $this->db->trans_complete();
            return returnMsg('error_order_money');
        }
        
        $this->load->model('mycard_model');
        $mycard = $this->mycard_model->oneByMycardid($orderOne['mycard_id']);
        if( empty($mycard) ) {
            $this->event_buy_card_model->updateState($orderOne['id'], 'error');
            $this->wxpay_notify_log_model->updateState($oneLog['id'], 'error', '查询不到对应储值卡');
            $this->db->trans_complete();
            return returnMsg('error_mycard');
        }
        
        
        //修改我的卡状态和消费记录
        $this->load->model('mycard_model');
        $this->mycard_model->transactionUpdateCompleteForBuyCard($orderOne['mycard_id'], $mycard['money']);
        
        //修改购卡订单状态
        $this->load->model('ucard_order_model');
        $this->ucard_order_model->updateComplete($orderOne['ucard_order_id']);
        
        //增加流水
        $this->load->model('running_account_model');
        $this->running_account_model->add($orderOne['user_id'], $orderOne['uuid'], 'buy', $mycard['money'], $orderOne['id']);
        
        //完成
        
        $this->wxpay_notify_log_model->updateState($oneLog['id'], 'done');
        $this->event_buy_card_model->updateState($orderOne['id'], 'done');
        $complete = $this->db->trans_complete();
        
        if( !$complete ) {
            $this->event_buy_card_model->updateState($orderOne['id'], 'error');
            $this->wxpay_notify_log_model->updateState($oneLog['id'], 'error', '流程处理错误');
            return returnMsg('error_not_complete');
        }
        //发送提货码 门店自提发送提货码
        $this->load->model('buy_card_extension_model');
        $extension = $this->buy_card_extension_model->oneByOrderid($orderOne['ucard_order_id']);
        if( $extension && $extension['get_way'] == 'shop' ) {
            $code = $extension['get_code'];
            $this->load->service('sms_service');
            $this->sms_service->sendProductCodeMsg($extension['uuid']);
        }
        
        return returnMsg('continue');
        
    }
    
    
    
    protected function rechargeMycardNotify($orderId, $oneLog)
    {
        
        
        $this->db->trans_start();
        
        $this->load->model('event_recharge_mycard_model');
        $this->load->model('wxpay_notify_log_model');
        
        $orderOne = $this->event_recharge_mycard_model->oneForUpdate($orderId);
        
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
        
        //增加流水
        $this->load->model('running_account_model');
        $this->running_account_model->add($orderOne['user_id'], $orderOne['uuid'], 'recharge', $mycard['money'], $orderOne['id']);
        
        //完成
        $this->wxpay_notify_log_model->updateState($oneLog['id'], 'done');
        $this->event_recharge_mycard_model->updateState($orderOne['id'], 'done');
        $complete = $this->db->trans_complete();
       
        if( !$complete ) {
            $this->event_recharge_mycard_model->updateState($orderOne['id'], 'error');
            $this->wxpay_notify_log_model->updateState($oneLog['id'], 'error', '流程处理错误');
            return returnMsg('error_not_complete');
        }
        
        return returnMsg('continue');
        
    }
    
    
    
    
    
    
    
    //回调添加日志
    public function addWxPayNotifyLog($data)
    {
        if( !$data || !is_array($data) ) {
            return returnMsg('error_data');
        }
        $this->load->model('wxpay_notify_log_model');
        $add = $this->wxpay_notify_log_model->add($data);
        
        if( !$add ) {
            return returnMsg('error_add');
        }
        return returnMsg('success', array('id' => $add));
    }
    //回调修改日志状态
    public function updateWxPayNotifyLogState($id, $toState, $errorMsg = '')
    {
        if( !isId($id) ) {
            return returnMsg('error_id');
        }
        if( empty($toState) ) {
            return returnMsg('error_state');
        }
        $this->load->model('wxpay_notify_log_model');
        return $this->wxpay_notify_log_model->updateState($id, $toState, $errorMsg);
    }
    
    
    
    
    
    
}   