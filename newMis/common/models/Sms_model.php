<?php
class Sms_model extends CI_Model{
	
	/**
	     * 获取手机号从某段时间开始到现在发送短信的总次数
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function countByMobile($mobile, $beginTime)
	{
		$field = "count(*) AS total_nums";
		$this->db->select($field);
		$this->db->from('u_sms');
		$this->db->where('mobile', $mobile);
		$this->db->where('create_time > '.$beginTime);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	/**
	 * 获取ip从某段时间开始到现在发送短信的总次数
	 * @param
	 * @return return_type
	 * @author liujing<liukai5455@163.com>
	 */
	public function countByIp($ip, $beginTime)
	{
		$field = "count(*) AS total_nums";
		$this->db->select($field);
		$this->db->from('u_sms');
		$this->db->where('ip', $ip);
		$this->db->where('create_time > '.$beginTime);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	public function add($mobile, $platform, $code, $msg, $type,  $ip, $isNow, $userId = 0)
	{
		$data = array(
			'mobile' => $mobile,
			'platform' => $platform,
			'code' => $code,
			'msg' => $msg,
			'type' => $type,
			'is_now' => 	$isNow ? 'yes' : 'no',
			'ip' => $ip,
			'user_id' => $userId,
			'create_time' => time()							
		);
		$this->db->insert('u_sms', $data);
		return $this->db->insert_id();
		
	}
	
	
	
	
	
	public function updateState($id, $state, $response)
	{
		
		$data = array(
				'state' => $state,
				'response_msg' => $response
		);
		$this->db->where('id', $id );
		return $this->db->update('u_sms', $data);
		
	}
	
	/**
	     * 获取最后一条短信
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	 public function oneLast($mobile, $type = null)
	 {
	 	$field = "*";
	 	$this->db->select($field);
	 	$this->db->from('u_sms');
	 	$this->db->where('mobile', $mobile);
	 	if( !empty($type) ) {
	 		$this->db->where('type', $type);
	 	}
	 	$this->db->order_by('id', 'desc');
	 	$this->db->limit(1);
	 
	 	$query = $this->db->get();
	 	return $query->row_array();
	 }
	
	 public function retryOneMore($id)
	 {
	 	$this->db->where('id',$id);
	 	$this->db->set('retry','retry + 1', FALSE);
	 	return  $this->db->update('u_sms');
	 }
	 public function used($id)
	 {
	 	$data = array(
	 		'used' => 1
	 	);
	 	$this->db->where('id', $id);
	 	return $this->db->update('u_sms', $data);
	 }
	 
}