<?php
class Store_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function one($storeId)
	{
		$field = "
				storeid,
				sid,
				sname,
				intro,
				adress,
				telephone,
				adressinfo,
				slistimgnew,
                brand
				";
		$this->db->select($field);
		$this->db->from('	o2o_store');
		$this->db->where('storeid', $storeId);
		$query = $this->db->get();
		return $query->row_array();	
	}
	
	public function oneByCode($code)
	{
		$field = "
				storeid,
				sid,
				sname,
				intro,
				adress,
				telephone,
				adressinfo,
				slistimgnew,
                brand
				";
		$this->db->select($field);
		$this->db->from('o2o_store');
		$this->db->where('sid', $code);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function lsOnline()
	{
		$field = "*";
		$this->db->select($field);
		$this->db->from('	o2o_store');
		$this->db->where('state = 1');
		$this->db->order_by('storeid', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	
}	