<?php
class Settlement_record_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	
	public function lsByOid($oid)
	{
		$field = "
				paytype,
				money,
				ext_info
				";
		$this->db->select($field);
		$this->db->from('s_settlement_record');
		$this->db->where('oid', $oid);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
}