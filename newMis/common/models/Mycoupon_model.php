<?php
class Mycoupon_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function countMy($uuid, $status = 'all')
	{
		$this->db->from('o2o_mycoupon');
		$this->db->join('o2o_coupon', 'o2o_mycoupon.couponid = o2o_coupon.couponid', 'inner');
		$this->db->where('o2o_mycoupon.uid', $uuid);
		$this->db->where_in('o2o_coupon.usetype', array('COUPON_GENERAL', 'COUPON_STORE', 'COUPON_OFFLINE'));
		if ( $status == 'used' ) {
			$this->db->where('o2o_mycoupon.state', 'COUPON_USE');
		} elseif ( $status == 'on' ) {
			$this->db->where('o2o_mycoupon.state', 'COUPON_ON');
		} elseif ( $status === 'expired' ) {
			$this->db->where('o2o_mycoupon.state', 'COUPON_EXPIRED');
		} else {
			$stateArray = array('COUPON_ON', 'COUPON_USE', 'COUPON_EXPIRED');
			$this->db->where_in('o2o_mycoupon.state',  $stateArray);
		}
		return $this->db->count_all_results();
	}
	
	public function lsMy($uuid, $status = 'all')
	{
		$field = "
				o2o_coupon.couponid,
				o2o_coupon.money,
				o2o_coupon.couponname,
				o2o_coupon.explain,
				o2o_coupon.usetype,
				o2o_mycoupon.mycouponid,
				o2o_mycoupon.couponcode,
				o2o_mycoupon.expiratime,
				o2o_mycoupon.state,
				o2o_mycoupon.uid
		";
		$this->db->select($field);
		$this->db->from('o2o_mycoupon');
		$this->db->join('o2o_coupon', 'o2o_mycoupon.couponid = o2o_coupon.couponid', 'inner');
		$this->db->where('o2o_mycoupon.uid', $uuid);
		$this->db->where_in('o2o_coupon.usetype', array('COUPON_GENERAL', 'COUPON_STORE', 'COUPON_OFFLINE'));
		if ( $status == 'used' ) {
			$this->db->where('o2o_mycoupon.state', 'COUPON_USE');
		} elseif ( $status == 'on' ) {
			$this->db->where('o2o_mycoupon.state', 'COUPON_ON');
		} elseif ( $status === 'expired' ) {
			$this->db->where('o2o_mycoupon.state', 'COUPON_EXPIRED');
		} else {
			$stateArray = array('COUPON_ON', 'COUPON_USE', 'COUPON_EXPIRED');
			$this->db->where_in('o2o_mycoupon.state',  $stateArray);
		}
		$this->db->order_by('o2o_mycoupon.mycouponid', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	

	public function oneById($id)
	{
		$field = "
				my.couponid,
				my.mycouponid,
				my.expiratime AS etime,
				my.state AS coupon_state,
				c.couponname,
				c.money,
				c.usetype AS coupon_type,
				c.beautician_id,
				c.explain,
				c.isaddup,
				c.store_id
				";
		$this->db->select($field);
		$this->db->from('o2o_mycoupon AS my');
		$this->db->join('o2o_coupon AS c',  'my.couponid = c.couponid', 'inner');
		$this->db->where('my.mycouponid', $id);
		$query = $this->db->get();
		return $query->row_array();
	
	}
	
	
	
}