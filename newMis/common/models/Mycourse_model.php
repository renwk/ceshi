<?php
class Mycourse_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function oneByMycardid($mycardid)
	{
		$field = "*";
		$this->db->select($field);
		$this->db->from('s_mycourse');
		$this->db->where('ucard_id', $mycardid);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
}