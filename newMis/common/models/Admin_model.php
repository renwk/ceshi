<?php
class Admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function oneByMobile($mobile){
        $field = "
            ad.aid,
            ad.username,
            ad.name as nickname,
            ad.phone,
            s.sname,
            s.sid
            ";
        $this->db->select($field);
        $this->db->from('	o2o_admin as ad');
        $this->db->join('o2o_store as s', 'ad.role_storeid = s.sid', 'inner');
        $this->db->where('ad.phone', $mobile);
        $this->db->where('ad.`status` = ',0);
        $this->db->where('s.`state` = ',1);
        $query = $this->db->get();

        return $query->row_array();

    }

}