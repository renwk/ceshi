<?php
class Mycard_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();	
	}
	//$exceptIbCard 是否去除赠送的爱币卡
	public function countMy($uuid, $status = 'all', $account = 'all', $exceptIbCard = false)
	{
		$this->db->from('o2o_mycard');
		$this->db->join('o2o_card', 'o2o_mycard.cardid = o2o_card.cardid', 'inner');
		$this->db->where('o2o_mycard.uid', $uuid);
		$this->db->where('o2o_mycard.state', 'orderstate_complete');
		$this->db->where('o2o_card.type', 'shop');
		if ( $status == 'normal' ) {
			$this->db->where('o2o_mycard.status = 1');
		} elseif ( $status == 'frozen' ) {
			$this->db->where('o2o_mycard.status = 2');
		} elseif ( $status === 'expired' ) {
			$this->db->where('o2o_mycard.status = 6');
		} elseif ( $status === 'except_expired' ) {
			$statusArray = array(0, 1, 2);
			$this->db->where_in('o2o_mycard.status',  $statusArray);
		} else {
			$statusArray = array(0, 1, 2, 6);
			$this->db->where_in('o2o_mycard.status',  $statusArray);
		}
		
		if( is_array($account) && !empty($account) ) {
			$this->db->where_in('o2o_card.accounts', $account);
		} elseif ( $account !== 'all' ) {
			$this->db->where('o2o_card.accounts', $account);
		}else{
			
		}
		//去除爱币卡
		if( $exceptIbCard ) {
			$this->db->where('o2o_card.cardid <> 2');
		}
		
		return $this->db->count_all_results();
	}
	////$exceptIbCard 是否去除赠送的爱币卡
	public function lsMy($uuid, $status = 'all', $account = 'all', $exceptIbCard = false)
	{
		$field = "
				o2o_mycard.mycardid,
				o2o_mycard.status,
				o2o_mycard.money_available,
				o2o_mycard.time_validity,
				o2o_mycard.ucard_no,
                o2o_mycard.sid,
                o2o_store.store_type,
                o2o_store.sname,
				o2o_card.cardname,
				o2o_card.accounts,
				o2o_card.money,
				o2o_card.validity_day,
				o2o_card.kind,
				o2o_card.policy,
				o2o_mycard.cardid
		";
		$this->db->select($field);
		$this->db->from('o2o_mycard');
		$this->db->join('o2o_card', 'o2o_mycard.cardid = o2o_card.cardid', 'inner');
		$this->db->join('o2o_store', 'o2o_mycard.sid = o2o_store.sid', 'inner');
		$this->db->where('o2o_mycard.uid', $uuid);
		$this->db->where('o2o_mycard.state', 'orderstate_complete');
		$this->db->where('o2o_card.type', 'shop');
		if ( $status == 'normal' ) {
			$this->db->where_in('o2o_mycard.status', array(0, 1));
		} elseif ( $status == 'frozen' ) {
			$this->db->where('o2o_mycard.status = 2');
		} elseif ( $status === 'expired' ) {
			$this->db->where_in('o2o_mycard.status', array(3, 6));
		} else {
			//$statusArray = array(0, 1, 2, 3, 6);
			$statusArray = array(0, 1, 2);
			$this->db->where_in('o2o_mycard.status',  $statusArray);
		}
		
		if( is_array($account) && !empty($account) ) {
			$this->db->where_in('o2o_card.accounts', $account);
		} elseif ( $account !== 'all' ) {
			$this->db->where('o2o_card.accounts', $account);
		}else{
				
		}
		//去除爱币卡
		if( $exceptIbCard ) {
			$this->db->where('o2o_card.cardid <> 2');
		}
		$this->db->order_by('o2o_mycard.time_validity', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	/**
	     * 储值卡余额 包括待开卡+正常状态
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function balance($uuid)
	{
		$field = "SUM(money_available) as total_money";
		$this->db->select($field);
		$this->db->from('o2o_mycard');
		$this->db->join('o2o_card', 'o2o_mycard.cardid = o2o_card.cardid', 'inner');
		$this->db->where('o2o_mycard.uid', $uuid);
		$this->db->where('o2o_mycard.state', 'orderstate_complete');
		$this->db->where_in('o2o_mycard.status', array(0, 1));
		$this->db->where('o2o_card.type', 'shop');
		$this->db->where('o2o_card.accounts', 'balance');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	public function oneByMycardid( $mycardid )
	{
		$field = "
				o2o_card.validity_day,
				o2o_card.kind,
				o2o_card.policy,
				o2o_card.cardname,
				o2o_card.money,
				o2o_card.accounts,
				o2o_mycard.mycardid,
				o2o_mycard.status,
				o2o_mycard.money_available,
				o2o_mycard.time_validity,
				o2o_mycard.ucard_no AS card_no,
				o2o_mycard.cardid,
				o2o_mycard.uid,
				o2o_mycard.sid
				";
		$this->db->select($field);
		$this->db->from('o2o_mycard');
		$this->db->join('o2o_card', 'o2o_mycard.cardid = o2o_card.cardid', 'inner');
		$this->db->where('o2o_mycard.mycardid', $mycardid);
		$query = $this->db->get();
		return $query->row_array();
		
	}
	
	
	public function transactionChangeBalance($uuid, $mycardid, $balance,  $changeMoney, $changeType = 'add')
	{
		
		if( strtolower( $changeType ) === 'add' ) {//增加
			$str = 'money_available +'.$changeMoney;
			$otype = 1;
			$otypedetial = 1;
			$remark = '微信端充值';
			$newBalance = $balance + $changeMoney;
		} elseif(  strtolower( $changeType )  === 'minus' ) { //消费减少
			$str = 'money_available -'.$changeMoney;
			$otype = 2;
			$otypedetial = 2;
			$remark = '微信端消费';
			$newBalance = $balance - $changeMoney;
		} elseif(  strtolower( $changeType )  === 'give' ) { //赠送给别人
			$str = 'money_available -'.$changeMoney;
			$otype = 7;
			$otypedetial = 2;
			$remark = '微信端转赠';
			$newBalance = $balance - $changeMoney;
		}elseif(  strtolower( $changeType )  === 'get' ) { //获取到赠送的
			$str = 'money_available +'.$changeMoney;
			$otype = 1;
			$otypedetial = 1;
			$remark = '微信端得到转赠';
			$newBalance = $balance + $changeMoney;
		}else{
			return false;
		}
		
		$this->db->where('uid', $uuid);
		$this->db->where('mycardid', $mycardid);
		$this->db->set('money_available', $str , FALSE);
		$update = $this->db->update('o2o_mycard');
		
		$insertData = array(
			'mycardid' => $mycardid,
			'costime' => time(),
			'otype' => $otype,
			'otypedetial' => $otypedetial,
			'oldbalance' => $balance,
			'costmoney' => $changeMoney,
			'newbalance' => $newBalance,
			'remark' => $remark						
		);
		$this->db->insert('s_card_cost_log', $insertData);
		return $update;
	}
	
	public function transactionCreateIbcard($uuid)
	{
	
		
		$insertData = array(
			'cardid' => 2, //定死了 爱币使用的储值卡
			'uid' => $uuid,
			'remark' => '收到爱币',
			'datetime' => time(),
			'state' => 'orderstate_complete',
			'status' => 1,
			'time_validity' => time() + 365*86400,
			'create_time' => time(),
		    'sid' => '5830c100_1d5a_7fd0_a9d4_459222c331a2',//泰美好总部的storeid 定死了
		);
		
		$this->db->insert('o2o_mycard', $insertData);
		
		$mycardId = $this->db->insert_id();
		
		return $mycardId;
		
	}
	
	public function transactionAdd($cardid, $uid, $money, $timeValidity, $sid)
	{
	    $data = array(
	        'cardid' => $cardid,
	        'uid' => $uid,
	        'remark' => 'iSpa微信购卡',
	        'state' => 'orderstate_waitpay',
	        'datetime' => time(),
	        'money_available' => $money,
	        'sid' => $sid,
	        'status' => 0,
	        'create_time' => time(),
	        'time_validity' => $timeValidity
	    );
	    
	    $this->db->insert('o2o_mycard', $data);
	    
	    $mycardId = $this->db->insert_id();
	    
	    return $mycardId;
	}
	
	public function transactionUpdateCompleteForBuyCard($mycardid, $money)
	{
	    
	    $data = array(
	        'state' => 'orderstate_complete',
	        'status' => 1,
	        'time_pay' => time(),
	        'time_active' => time()
	    );
	    
	    $this->db->where('mycardid', $mycardid);
	    $this->db->where('state', 'orderstate_waitpay');
	    $this->db->where('status', 0);

	    $update = $this->db->update('o2o_mycard', $data);
	    
	    $insertData = array(
	        'mycardid' => $mycardid,
	        'costime' => time(),
	        'otype' => 1,
	        'otypedetial' => 1,
	        'oldbalance' => 0,
	        'costmoney' => $money,
	        'newbalance' => $money,
	        'remark' => 'ispa微信端购卡'
	    );
	    $insert = $this->db->insert('s_card_cost_log', $insertData);
	    return $update && $insert;
	    
	}
	
	
	
}