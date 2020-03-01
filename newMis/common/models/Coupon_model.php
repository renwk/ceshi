<?php
class Coupon_model extends CI_Model{
	
	
	public function one($couponid)
	{
		
		$this->db->select('*');
		$this->db->from('o2o_coupon');
		$this->db->where('couponid', $couponid);
		$query = $this->db->get();
		return $query->row_array();
		
		
	} 
	
	
	
}