<?php
class Member_discount_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function serviceDiscountIspa($cardid)
	{
		$field = "
				cardid,
				brandid,
				discount,
				explain
				";
		$this->db->select($field);
		$this->db->from('s_member_discount');
		$this->db->where('type', 8301);
		$this->db->where('brandid', 'ispa');
		$this->db->where('cardid', $cardid);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function serviceDiscountEasy($cardid)
	{
		$field = "
				cardid,
				brandid,
				discount,
				explain
				";
		$this->db->select($field);
		$this->db->from('s_member_discount');
		$this->db->where('type', 8301);
		$this->db->where('brandid', 'easy');
		$this->db->where('cardid', $cardid);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
}