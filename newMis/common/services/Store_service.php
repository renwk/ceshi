<?php
/**
     * `门店相关
     * @param 
     * @return return_type
     * @author liujing<liukai5455@163.com>
     */
class Store_service extends MY_Service{
	
	public function __construct()
	{
		$this->load->model('store_model');
		parent::__construct();
	}
	
	public function lsByPosition($latitude, $longitude, $len = 5, $desc = 'asc')
	{
		if( !isFloat($latitude) || !isFloat($longitude) ) {
			return returnMsg('error_params');
		}
				
		$storeList = $this->store_model->lsOnline();
		
		if( !empty($storeList) ) {
			$this->load->library('photo');
			foreach ( $storeList as $key => $val ) {
				
				if( isFloat($val['slongitude']) && isFloat($val['slatitude'])  ) {
					$length = pointA2BLength($longitude, $latitude, $val['slongitude'], $val['slatitude']);
					$storeList[$key]['length'] = $length;
					$lengthArray[$key] = $length;
					
					$storeList[$key]['photo']      = $this->photo->makeUrl( $val['slistimgnew']  );
					
				} else{
					unset($storeList[$key]);
				}
				
			}
			
			//按距离从近到远排序
			array_multisort($lengthArray,  $desc === 'asc' ? SORT_ASC : SORT_DESC, $storeList);
			
			$storeList = array_slice($storeList, 0, $len);
		}
		
		return returnMsg('success', $storeList);
		
		
	}
	
}