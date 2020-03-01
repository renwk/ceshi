<?php
class Gift_card_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function oneByOid($oid)
	{
		$field = "
				gift_code AS cardname,
				gift_code AS card_no,
				price,
				cover_charge,
				(price+cover_charge) AS money
				";
		$this->db->select($field);	
		$this->db->from('s_gift_card');
		$this->db->where('oid', $oid);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
}