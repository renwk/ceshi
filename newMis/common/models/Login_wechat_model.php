<?php
class Login_wechat_model extends CI_Model{
	
	
	public function oneByOpenid($openid)
	{
		$field = "*";
		$this->db->select($field);
		$this->db->from('u_login_wechat');
		$this->db->where('openid', $openid);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function add($openid, $nickname, $sex, $language, $city, $province, $country, $headimgurl)
	{
		$data = array(
				'openid' => $openid,
				'nickname' => $nickname,
				'sex' => $sex,
				'language' => $language,
				'city' => $city,
				'province' => $province,
				'country' => $country,
				'headimgurl' => $headimgurl,
				'create_time' => time()
		);
		return $this->db->insert('u_login_wechat', $data);
	}
	public function changedata($openid,$data){
        $this->db->where('openid', $openid);
        return	$this->db->update('u_login_wechat', $data);
    }
	public function bindUser($openid, $userid, $uuid)
	{
		$data = array(
			'userid' => $userid,
			'uid' => $uuid
		);
		$this->db->where('openid', $openid);
		return	$this->db->update('u_login_wechat', $data);		
	}
	
	public function oneByUid($uid)
	{
		
		$field = "*";
		$this->db->select($field);
		$this->db->from('u_login_wechat');
		$this->db->where('uid', $uid);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();
		
	}
	
	public function oneById($id)
	{
		$field = "*";
		$this->db->select($field);
		$this->db->from('u_login_wechat');
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function readAgreement($openid)
	{
	    
	    $data = array(
	        'is_read_agreement' => 1,
	    );
	    $this->db->where('openid', $openid);
	    $this->db->where('is_read_agreement = 0');
	    return	$this->db->update('u_login_wechat', $data);	
	    
	} 	
}