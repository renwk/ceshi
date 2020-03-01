<?php
class Running_account_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function add($userid, $uuid, $flag, $changeMoney, $relationId)
    {
        $data = array(
            'user_id' => $userid,
            'uuid' => $uuid,
            'flag' => $flag,
            'change_money' => $changeMoney,
            'relation_id' => $relationId,
            'create_time' => time()
        );
        
        return $this->db->insert('u_running_account', $data);
    }
    
}    