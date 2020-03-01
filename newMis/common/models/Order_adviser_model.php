<?php
class Order_adviser_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function oneByOrderCode($code)
	{
		$field = "
				s_employees_manage.id AS adviser_id,
				s_employees_manage.coding,
				s_employees_manage.name,
				s_employees_manage.nickname,
				s_employees_manage.sid,
				s_employees_manage.position,
				s_employees_manage.status,
				s_employees_manage.phone,
				s_employees_manage.photos
				";
		$this->db->select($field);
		$this->db->from('s_order_adviser');
		$this->db->join('s_employees_manage', 's_employees_manage.id = s_order_adviser.adviser_id', 'inner');
		$this->db->where('s_order_adviser.order_code', $code);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	

	public function lsByOrderCode($code)
	{
		$field = "
				s_employees_manage.id AS adviser_id,
				s_employees_manage.coding,
				s_employees_manage.name,
				s_employees_manage.nickname,
				s_employees_manage.sid,
				s_employees_manage.position,
				s_employees_manage.status,
				s_employees_manage.phone,
				s_employees_manage.photos
				";
		$this->db->select($field);
		$this->db->from('s_order_adviser');
		$this->db->join('s_employees_manage', 's_employees_manage.id = s_order_adviser.adviser_id', 'inner');
		$this->db->where('s_order_adviser.order_code', $code);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
}