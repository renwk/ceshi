<?php
class Order_beautician_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function oneByOrderCode($code)
	{
		$field = "
				o2o_beautician.beauticianid,
				o2o_beautician.bid,
				o2o_beautician.nickname,
				o2o_beautician.name,
				o2o_beautician.sid,
				o2o_beautician.phone,
				o2o_beautician.jointime,
				o2o_beautician.intro,
				o2o_beautician.brithday,
				o2o_beautician.photonew
				";
		$this->db->select($field);
		$this->db->from('s_order_beautician');
		$this->db->join('o2o_beautician', 's_order_beautician.bid = o2o_beautician.beauticianid', 'inner');
		$this->db->where('s_order_beautician.order_code', $code);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function lsByOrderCode($code, $serviceType = 1)
	{
		$field = "
				o2o_beautician.beauticianid,
				o2o_beautician.bid,
				o2o_beautician.nickname,
				o2o_beautician.name,
				o2o_beautician.sid,
				o2o_beautician.phone,
				o2o_beautician.jointime,
				o2o_beautician.intro,
				o2o_beautician.brithday,
				o2o_beautician.photonew
				";
		$this->db->select($field);
		$this->db->from('s_order_beautician');
		$this->db->join('o2o_beautician', 's_order_beautician.bid = o2o_beautician.beauticianid', 'inner');
		$this->db->where('s_order_beautician.order_code', $code);
		$this->db->where('s_order_beautician.service_type', $serviceType);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	
	
}