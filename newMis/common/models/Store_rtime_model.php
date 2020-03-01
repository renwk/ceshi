<?php
class Store_rtime_model extends CI_Model{
	

	public function __construct()
	{
		parent::__construct();
	}
	
	public function lsByOid($oid)
	{
		$field = "
				o2o_store_rtime.stime,
				o2o_store_rtime.etime,
				o2o_store_room.srname
				";
		$this->db->select($field);
		$this->db->from('o2o_store_rtime');
		$this->db->join('o2o_store_room', 'o2o_store_rtime.srid = o2o_store_room.srid', 'inner');
		$this->db->where('o2o_store_rtime.oid', $oid);
		$this->db->order_by('o2o_store_rtime.srtid', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	
}