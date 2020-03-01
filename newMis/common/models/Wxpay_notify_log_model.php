<?php
class Wxpay_notify_log_model extends CI_Model{
	
	public function add($data){
		
		$data = array(
			'return_code' => $data['return_code'],
			'return_msg' => isset($data['return_msg']) ? $data['return_msg'] : '',
			'result_code' => $data['result_code'],
			'openid' => $data['openid'],
			'total_fee' => $data['total_fee'],
			'cash_fee' => $data['cash_fee'],
			'transaction_id' => $data['transaction_id'],
			'out_trade_no' => $data['out_trade_no'],
			'vars' => serialize($data),
			'state' => 'init',
			'create_time' => time()									
		);
		$this->db->insert('u_wxpay_notify_log', $data);
		return $this->db->insert_id();
	}
	
	
	public function updateState($id, $toState, $errorMsg = '')
	{
		$data = array(
			'state' => $toState,
			'error_msg' => $errorMsg,
			'run_time' => time()		
		);
		$this->db->where('id', $id);
		return $this->db->update('u_wxpay_notify_log', $data);	
	}
	
	
	public function oneHandle()
	{
		
		$this->db->select('*');
		$this->db->from('u_wxpay_notify_log');
		$this->db->where('state', 'init');
		$this->db->where('return_code', 'SUCCESS');
		$this->db->where('result_code', 'SUCCESS');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get();
		return $query->row_array();
		
	}
	
	
}