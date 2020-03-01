<?php

class Order_detail_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function lsByCode($orderCode)
	{
		$field = "
					iname,
					actual_price,
				    count
				";
		$this->db->select($field);
		$this->db->from('s_order_detail');
		$this->db->where('order_code', $orderCode);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	
	
	
}	