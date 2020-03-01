<?php
class Event_buy_card_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function add($id, $userId, $uuid, $mycardId, $ucardOrderId, $fullMoney, $trueMoney)
    {
        $data = array(
            'id' => $id,
            'user_id' => $userId,
            'uuid' => $uuid,
            'ucard_order_id' => $ucardOrderId,
            'mycard_id' => $mycardId,
            'full_money' => $fullMoney,
            'true_money' => $trueMoney,
            'state' => 'init',
            'create_time' => time()
        );
        
        return $this->db->insert('u_event_buy_card', $data);
    }
    
    public function oneForUpdate($id)
    {
        
        $sql = "
            SELECT
                *
            FROM
                u_event_buy_card
            WHERE
                id = $id
            LIMIT 1 FOR UPDATE
        ";
        $query = $this->db->query($sql);
        return $query->row_array();
        
    }
    
    public function updateState($id, $toState)
    {
        
        $data = array(
            'state' => $toState,
            'run_time' => time()
        );
        $this->db->where('id', $id);
        return $this->db->update('u_event_buy_card', $data);
        
    }
    
}