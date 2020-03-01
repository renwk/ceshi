<?php
/**
     * 优惠券相关
     * @param 
     * @return return_type
     * @author liujing<liukai5455@163.com>
     */
class Coupon_service extends MY_Service{
	
	public function __construct()
	{
		$this->load->model('mycoupon_model');
		parent::__construct();
	}
	
	public function countMy($uuid, $state = 'all')
	{
		if( !$uuid ) {
			return returnMsg('error_uuid');
		}
		
		$count = $this->mycoupon_model->countMy($uuid, $state);
		
		return returnMsg('success', $count);
		
	}
	
	public function lsMy($uuid, $state = 'all')
	{
		if( !$uuid ) {
			return returnMsg('error_uuid');
		}
		$myconpon = $this->mycoupon_model->lsMy($uuid, strtolower($state) );
		
		if( !empty($myconpon) ) {
			
			foreach ($myconpon as $k => $v) {
				//过期前3天 提示即将过期
				$myconpon[$k]['expired_notice'] =  ( $v['expiratime'] - time() ) < 3*24*3600 ?	true : false;
				
			}
			
		}
		
		return returnMsg('success', $myconpon);
	}
	
	
	
}