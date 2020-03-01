<?php
class Card_explain_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function lsByCardid($cardid)
    {
        $this->db->select('*');
        $this->db->from('u_card_explain');
        $this->db->where('cardid', $cardid);
        $this->db->order_by('order_weight', 'desc');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    
}