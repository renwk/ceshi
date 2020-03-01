<?php
class Give_ib_info_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	

	
	public function lsByGiveid($giveId)
	{
		$this->db->select('*');
		$this->db->from('u_give_ib_info');
		$this->db->where('give_id', $giveId);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function oneByGiveIdAndMobile($giveId, $acceptMobile)
	{
		$this->db->select('*');
		$this->db->from('u_give_ib_info');
		$this->db->where('give_id', $giveId);
		$this->db->where('accept_mobile', $acceptMobile);
		$query = $this->db->get();
		return $query->row_array();
	}
	
}