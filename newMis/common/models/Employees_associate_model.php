<?php
class Employees_associate_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getOne($mobile){
        $field = "
				em.id,
				em.uid,
				em.mobile,
				em.role,
				em.openid,
				em.create_time,
				em.nickname,
				em.sex,
				em.language,
				em.city,
				em.province,
				em.country,
				em.headimgurl,
				";
        $this->db->select($field);
        $this->db->from('	s_employees_associate as em');
        $this->db->where('em.mobile =', $mobile);
        $this->db->where('em.status = ',1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function oneByOpenid($openid)
    {
        $field = "*";
        $this->db->select($field);
        $this->db->from('s_employees_associate');
        $this->db->where('openid', $openid);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function oneByAppopenid($appopenid){
        $field = "*";
        $this->db->select($field);
        $this->db->from('s_employees_associate');
        $this->db->where('appopenid', $appopenid);
        $this->db->where('`status` = ',1);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function searchOne($openid){
        $field = "
				em.id,
				em.uid,
				em.mobile,
				em.role,
				em.openid,
				em.create_time,
                em.nickname,
				em.sex,
				em.language,
				em.city,
				em.province,
				em.country,
				em.headimgurl,
				";
        $this->db->select($field);
        $this->db->from('	s_employees_associate as em');
        $this->db->where('em.openid', $openid);
        $this->db->where('em.`status` = ',1);
        $query = $this->db->get();
//        echo $this->db->last_query();
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
            'create_time' => time(),
            'status' => 1
        );
        return $this->db->insert('s_employees_associate', $data);
    }
    public function bindUser($openid, $uid, $role,$mobile){
        $data = array(
            'uid' => $uid,
            'role' => $role,
            'mobile'=>$mobile
        );
        $this->db->where('openid', $openid);
        return	$this->db->update('s_employees_associate', $data);

    }
    public function appbindUser($appopenid, $uid, $role,$mobile){
        $data = array(
            'uid' => $uid,
            'role' => $role,
            'appopenid'=>$appopenid,
            'create_time'=>time()
        );
        $this->db->where('mobile', $mobile);
        return	$this->db->update('s_employees_associate', $data);

    }
    public function upUserByAppopenid($appopenid, $uid=null, $role=null,$mobile=null){
        $data = array(
            'uid' => $uid,
            'role' => $role,
            'mobile'=>$mobile,
            'create_time'=>time()
        );
        $this->db->where('appopenid', $appopenid);
        return	$this->db->update('s_employees_associate', $data);

    }

    public function addbindUser($appopenid, $uid, $role,$mobile){
        $data = array(
            'uid' => $uid,
            'role' => $role,
            'appopenid'=>$appopenid,
            'mobile'=>$mobile,
            'status'=>1,
            'create_time'=>time()
        );
        return	$this->db->insert('s_employees_associate', $data);

    }
}