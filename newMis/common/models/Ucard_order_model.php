<?php
class Ucard_order_model extends CI_Model{
    protected $allowDisplayDateTime;
    
	public function __construct()
	{
		parent::__construct();	
		$this->allowDisplayDateTime = strtotime('2018-12-20');
	}

	public function ls($uuid, $status)
	{
		
		$field = "
					*
				";
		$this->db->select($field);
		$this->db->from('s_ucard_order');
		$this->db->where('userid', $uuid);
		$this->db->where('create_time >= '.$this->allowDisplayDateTime);
		if( $status === 'complete' ) {
			$this->db->where('status', 1 );
		} else{
			return false;
		}
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	

	public function one($id)
	{
		$this->db->select('*');
		$this->db->from('s_ucard_order');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	public function add($uuid, $cardType, $mycardId, $action, $ucardNo, $timeValidity, $moneyFull, $moneyList, $moneyTrue, $sid)
	{
		
		if( $action === 'buy' ) {
			$type = 0;
			$remark = '通过微信端支付的购买订单';
		} elseif( $action === 'recharge' ) {
			$type = 1;
			$remark = '通过微信端支付的充值订单';
		} else{
			$type = 1;
			$remark = '通过微信端支付的充值订单';
		}
		
		$data = array(
				'userid' => $uuid,
				'card_type' => $cardType,
				'ucard_id' => $mycardId,
				'oid' => time(),
				'type' => $type,
				'ucard_no' => $ucardNo,
				'time_pay' => 0,
				'status' => 0,
				'time_validity' => $timeValidity,
				'money_full' => $moneyFull,
				'money_list' => $moneyList,
				'money_true' => $moneyTrue,
				'remark' => $remark,
		        'origin' => 'wechat',   
				'sid' => $sid,
				'create_time' => time()
		);
		$this->db->insert('s_ucard_order', $data);
		return $this->db->insert_id();
	}
	
	public function updateComplete($id){
		$data = array(
			'time_pay' => time(),
			'status' => 1	 
		);
		$this->db->where('id', $id);
		$this->db->where('status = 0');
		return $this->db->update('s_ucard_order', $data);
	}
	
	
}