<?php
class Card_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function ls(){
        
        $this->db->select('*');
        $this->db->from('o2o_card');
        $this->db->where('accounts', 'balance');
        $this->db->where('is_online_sales', 'yes');
        $this->db->where('type', 'shop');
        $this->db->order_by('cardid', 'desc');
        $query = $this->db->get();
        return $query->result_array();
        
    }
    
    public function one($cardid)
    {
        $this->db->select('*');
        $this->db->from('o2o_card');
        $this->db->where('cardid', $cardid);
        $query = $this->db->get();
        return $query->row_array();
        
    }
    
}    