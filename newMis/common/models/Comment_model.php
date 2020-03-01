<?php
class Comment_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function oneByUidAndOrderid($uuid, $orderid)
	{
		$this->db->select('*');
		$this->db->from('u_comment');
		$this->db->where('uid', $uuid);
		$this->db->where('order_id', $orderid);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function add($uuid, $orderId, $content, $scoreItemsArray, $scoreServiceEnvironment, $scoreServiceAll, $answerArray)
	{
		
		$data = array(
			'order_id' => $orderId,
			'uid' => $uuid,
			'content' => $content,
			'score_items' => json_encode($scoreItemsArray),
			'score_service_environment' => $scoreServiceEnvironment,
			'score_service_all' => $scoreServiceAll,
			'order_questions_answer' => json_encode($answerArray)	,
			'create_time' => time()									
		);
		return $this->db->insert('u_comment', $data);	
	}
	
}