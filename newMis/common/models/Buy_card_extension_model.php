<?php

class Buy_card_extension_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function add($uuid, $mycardid, $cardid, $ucardOrderId, $getWay, $addressId)
    {
        
        $data = array(
            'uuid' => $uuid,
            'cardid' => $cardid,
            'mycardid' => $mycardid,
            'ucard_order_id' => $ucardOrderId,
            'get_way' => $getWay,
            'address_id' => $addressId,
            'get_code' => makeVerifyCode(),
            'create_time' => time()
        );
        
        return $this->db->insert('u_buy_card_extension', $data);
        
    }
    
    public function oneByOrderid($ucardOrderId)
    {
        $field = "
            u_buy_card_extension.id,
            u_buy_card_extension.get_way,
            u_buy_card_extension.state,
            u_buy_card_extension.express_company,
            u_buy_card_extension.express_number,
            u_buy_card_extension.get_code,    
            u_user_address.province_id,
            u_user_address.city_id,
            u_user_address.area_id,
            u_user_address.receiver_name,
            u_user_address.receiver_mobile,
            u_user_address.address,
        ";
        $this->db->select($field);
        $this->db->from('u_buy_card_extension');
        $this->db->join('u_user_address', 'u_buy_card_extension.address_id = u_user_address.id', 'left');
        $this->db->where('u_buy_card_extension.ucard_order_id', $ucardOrderId);
        $query = $this->db->get();
        return $query->row_array();
    }
}