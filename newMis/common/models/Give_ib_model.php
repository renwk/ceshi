<?php
class Give_ib_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	

	public function transactionGiveIb($uuid, $mycardid, $giveInfo, $expiredTime)
	{
		$time = time();
		$ibTotal =  array_sum( array_column($giveInfo, 'ib') );
		
		$giveData = array(
			'mycardid' => $mycardid,
			'expired_time' => $expiredTime,
			'create_time' => $time,
			'ib_all' => $ibTotal,
			'ib_left' => $ibTotal,
			'uid' => $uuid,	
			'state' => 'open'					
		);
		
		$this->db->insert('u_give_ib', $giveData);
		
		$giveId = $this->db->insert_id();
		
		$giveInfoData = array();
		foreach ($giveInfo as $k => $v) {
			
			$temp = array(
				'give_id' => $giveId,
				'accept_mobile' => $v['mobile'],
				'accept_ib' => $v['ib'],
				'state'	 => 'init'		
			);
			$giveInfoData[$k] = $temp;
			
		}
		
		$this->db->insert_batch('u_give_ib_info', $giveInfoData);
		return $giveId;
		
	}
	
	public function one($id)
	{
		$this->db->select('*');
		$this->db->from('u_give_ib');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function transactionGetIb($giveId, $acceptMobile, $acceptIb)
	{
		$updateIbStr = 'ib_left - '.$acceptIb; 
		$this->db->where('id', $giveId);
		$this->db->set('ib_left', $updateIbStr , FALSE);
		$updateOne = $this->db->update('u_give_ib');
		
		$this->db->where('give_id', $giveId);
		$this->db->where('accept_mobile', $acceptMobile);
		$data = array(
			'accept_time' => time(),
			'state' => 'done'	
		);
		$updateTwo = $this->db->update('u_give_ib_info', $data);
		return $updateOne && $updateTwo;
	}
	
	public function oneExpired()
	{
		$time = time();
		$sql = "
				SELECT
					*
				FROM
					u_give_ib
				WHERE
					state = 'open'
				AND
					(expired_time <= {$time} OR ib_left <= 0)
				LIMIT 1
				";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	public function closed($id)
	{
		$data = array(
			'state' => 'closed'
		);
		$this->db->where('state', 'open');
		$this->db->where('id', $id);
		return $this->db->update('u_give_ib', $data);
		
	}
	
	public function transactionExpired($giveId)
	{
		
		$this->db->trans_start();
		$data = array(
				'state' => 'expired'
		);
		$this->db->where('state', 'open');
		$this->db->where('id', $giveId);
		$this->db->update('u_give_ib', $data);
		
		$data2 = array(
			'state' => 'expired'
		);
		$this->db->where('state', 'init');		
		$this->db->where('give_id', $giveId);
		$this->db->update('u_give_ib_info', $data2);
		return $this->db->trans_complete();
		
	}
	
	
	
}