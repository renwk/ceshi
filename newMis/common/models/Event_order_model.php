<?php
class Event_order_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function add($orderCode, $action)
    {
       $data = array(
           'order_code' => $orderCode,
           'action' => $action
       );     
       $this->db->insert('u_event_order', $data);
       
       return $this->db->insert_id();
       
    }
    
    public function oneByCode($code)
    {
        
        $this->db->select('*');
        $this->db->from('u_event_order');
        $this->db->where('order_code', $code);
        $query = $this->db->get();
        return $query->row_array();
    
    }
    
    
}