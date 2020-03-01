<?php
class Order_questions_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function lsByBrand($brand)
	{
		$this->db->select('*');
		$this->db->from('u_order_questions');
		$this->db->where('brand', $brand);
		$this->db->where('state', 'on');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	
	
}