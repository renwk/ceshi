<?php

class Order_remind_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function oneConsumptionInit()
	{
		$this->db->select('*');
		$this->db->from('u_order_remind');
		$this->db->where('state', 'init');
		$this->db->where('type', 'consumption');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	
	public function oneAppointmentInitBeforeTwoHours()
	{
		$time = time() + 7200;
		$field = "
				u_order_remind.*,
				s_order.store_id,
				s_order.user_id,
				s_order.create_time,
				s_order.start_time
				";
		
		$this->db->select('*');
		$this->db->from('u_order_remind');
		$this->db->join('s_order', 'u_order_remind.order_id = s_order.id', 'inner');
		$this->db->where('u_order_remind.state', 'init');
		$this->db->where('u_order_remind.type', 'appointment');
		$this->db->where('s_order.start_time <= '. $time);
		$this->db->order_by('u_order_remind.id', 'asc');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	
	public function updateStateDoing($id)
	{
		$data = array(
			'state' => 'doing'
		);
		$this->db->where('id', $id);
		$this->db->where('state', 'init');
		return $this->db->update('u_order_remind', $data);
		
	}
	
	public function updateStateDone($id, $response)
	{
		$data = array(
				'state' => 'done',
				'send_time' => time(),
				'response' => $response 
		);
		$this->db->where('id', $id);
		$this->db->where('state', 'doing');
		return $this->db->update('u_order_remind', $data);
	
	}
	
	public function updateStateError($id, $response = null) {
		
		$data = array(
				'state' => 'error',
				'send_time' => time(),
				'response' => $response 
		);
		$this->db->where('id', $id);
		$this->db->where('state', 'doing');
		return $this->db->update('u_order_remind', $data);
	}
	
}	