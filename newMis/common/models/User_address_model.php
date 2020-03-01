<?php
class User_address_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function lsByUuid($uuid)
    {
        
        $this->db->select('*');
        $this->db->from('u_user_address');
        $this->db->where('uuid', $uuid);
        $this->db->where('is_delete', 'no');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
        
    }
    
    public function add($uuid, $name, $mobile, $address, $isDefault)
    {
        
        $data = array(
            'uuid' => $uuid,
            'receiver_name' => $name,
            'receiver_mobile' => $mobile,
            'address' => $address,
            'is_default' => $isDefault,
            'create_time' => time()
        );
        return $this->db->insert('u_user_address', $data);
    }
    
    public function updateDefaultNo($uuid)
    {
        $data = array(
            'is_default' => 'no',
        );    
        $this->db->where('uuid', $uuid);
        return $this->db->update('u_user_address', $data);
    }
    
    public function oneByUuidAndId($uuid, $id)
    {
        
        $this->db->select('*');
        $this->db->from('u_user_address');
        $this->db->where('uuid', $uuid);
        $this->db->where('is_delete', 'no');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
        
    }
    
    public function update($uuid, $id, $name, $mobile, $address, $isDefault)
    {
        
        $data = array(
            'receiver_name' => $name,
            'receiver_mobile' => $mobile,
            'address' => $address,
            'is_default' => $isDefault,
            'update_time' => time()
        );
        $this->db->where('uuid', $uuid);
        $this->db->where('id', $id);
        return $this->db->update('u_user_address', $data);
    }
    
    
    public function delete($uuid, $addressId)
    {
        $data = array(
            'is_delete' => 'yes',
            'update_time' => time()
        ); 
        
        $this->db->where('uuid', $uuid);
        $this->db->where('id', $addressId);
        return $this->db->update('u_user_address', $data);
        
    }
    
    public function oneDefaultByUuid($uuid)
    {
        
        $this->db->select('*');
        $this->db->from('u_user_address');
        $this->db->where('uuid', $uuid);
        $this->db->where('is_delete', 'no');
        $this->db->where('is_default', 'yes');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row_array();
        
    }
    
    public function oneLastByUuid($uuid)
    {
        
        $this->db->select('*');
        $this->db->from('u_user_address');
        $this->db->where('uuid', $uuid);
        $this->db->where('is_delete', 'no');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row_array();
        
    }
    
}    