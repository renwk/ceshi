<?php
class Collect_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function ls($uuid, $type)
	{
		$field = "
					id,
					user_id,
					relation_id,
					type,
					create_time
				";
		$this->db->select($field);
		$this->db->from('u_collect');
		$this->db->where('user_id', $uuid);
		if( is_array($type) ) {
			$this->db->where_in('type', $type);
		}else{
			$this->db->where('type', $type);
		}
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function one($uuid, $relationid, $type)
	{
		$this->db->select('*');
		$this->db->from('u_collect');
		$this->db->where('user_id', 		$uuid);
		$this->db->where('relation_id', $relationid);
		$this->db->where('type',          $type);
		$query = $this->db->get();
		return $query->row_array();
		
	}
	
	
	public function add($uuid, $relationid, $type)
	{
		$data = array(
			'user_id' => $uuid,
			'relation_id' => $relationid,
			'type' => $type,		
			'create_time' => time(),
		);
		return $this->db->insert('u_collect', $data);
	}
	
	
	public function delete($uuid, $relationid, $type)
	{
		$this->db->where('user_id', $uuid);
		$this->db->where('relation_id', $relationid);
		$this->db->where('type', $type);
		return $this->db->delete('u_collect');
	}
	
	public function deleteById($uuid, $id)
	{
		$this->db->where('user_id', $uuid);
		$this->db->where('id', $id);
		return $this->db->delete('u_collect');
	}
	
	
}