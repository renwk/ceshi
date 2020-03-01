<?php
class Users_model extends CI_Model{
	
	
	public function one($userId)
	{
		$field = "*";
		$this->db->select($field);
		$this->db->from('o2o_users');
		$this->db->where('userid', $userId);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function oneByUid($uuid){
		$field = "*";
		$this->db->select($field);
		$this->db->from('o2o_users');
		$this->db->where('uid', $uuid);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	public function oneByMobile($mobile)
	{
		$field = "*";
		$this->db->select($field);
		$this->db->from('o2o_users');
		$this->db->where('mobile', $mobile);
		$this->db->or_where('backup_mobile1', $mobile);
		$this->db->or_where('backup_mobile2', $mobile);
		$this->db->order_by('userid', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();
		
	}
	
	public function setTransPwd($uuid, $password)
	{
		$data = array(
			'transaction_password' => md5($password)
		);
		$this->db->where('uid', $uuid);
		return $this->db->update('o2o_users', $data);
	}
	
	public function createUser($mobile, $uid)
	{
		
		$data = array(
			'uid' => $uid,
			'mobile' => $mobile,
			'storefront' => '5830c100_1d5a_7fd0_a9d4_459222c331a2',//泰美好总部的storeid 定死了		
		); 
		$this->db->insert('o2o_users', $data);
		return $this->db->insert_id();
	}

    public function getUcardByAdviser($where){ //会员专属顾问

        $sql = "SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`userid`, `a`.`uid`, `a`.`mobile`, `a`.`backup_mobile1`,
 `a`.`backup_mobile2`, `a`.`nickname` `name`, `a`.`sex`, `a`.`country`, `a`.`costmoney`, `a`.`costcount`, `a`.`user_type`,
  `d`.`sname`, `a`.`source`, `a`.`by_consultant` `consultant`, `a`.`bid`, `a`.`state`, `a`.`registtime`, `d`.`sid`,
  max(`o`.`prestatus_time`) as otime
FROM (`o2o_users` `a`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_userinfo` `b` ON `a`.`uid` = `b`.`uid`
LEFT JOIN `o2o_store` `d` ON `a`.`storefront` = `d`.`sid`
LEFT JOIN `s_order` `o` ON  `o`.`user_id` = `a`.`uid`
WHERE `a`.`state` != 2 and user_type = 1 and o.type in ('8602','8603','8604','8605','8606','8607')
and ({$where})
GROUP BY `a`.`uid`
ORDER BY otime DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function addToken($data){
        $this->db->insert('u_token', $data);
        return $this->db->insert_id();
    }

    /**
     * 获取最后一条accesstoken
     * @param
     * @return return_type
     * @author
     */
    public function oneLastToken($type = null)
    {
        $field = "*";
        $this->db->select($field);
        $this->db->from('u_token');
        if( !empty($type) ) {
            $this->db->where('type', $type);
        }
        $this->db->order_by('create_time', 'desc');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row_array();
    }
    public function addFormid($data){
        $this->db->insert('u_formid', $data);
        return $this->db->insert_id();
    }
    public function getformid($openid){
        $field = "*";
        $this->db->select($field);
        $this->db->from('u_formid');
        if( !empty($type) ) {
            $this->db->where('openid', $openid);
        }
        $this->db->order_by('create_time', 'desc');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row_array();
    }
    public function sent($id){
        $data = array(
            'send' => 1
        );
        $this->db->where('id', $id);
        return $this->db->update('u_formid', $data);
    }
    public function gradessent($id){
        $data = array(
            'send' => 1
        );
        $this->db->where('id', $id);
        return $this->db->update('s_beautician_grades', $data);
    }
    public function GradeChange($type,$bid,$time){
        $field = "*";
        $this->db->select($field);
        $this->db->from('s_beautician_grades');
        $this->db->where('type', $type);
        $this->db->where('bid', $bid);
        $this->db->where('create_time', $time);
        $this->db->where('status=',1);
        $this->db->where('sent=',0);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
	
}