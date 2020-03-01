<?php

class Collect_service extends MY_Service{
	
	protected $typeArray = array('store', 'beautician', 'adviser');
	
	public function __construct()
	{
		$this->load->model('collect_model');
		parent::__construct();
	}
	/**
	     * 获取我的收藏
	     * @param $uuid 
	     * @param string or array array获取多个type
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function ls($uuid, $type)
	{
		if( empty($uuid) ) {
			return returnMsg('error_uuid');
		}
		
		if( $type === 'beauticianAndConsultant' ) {
			$type = array('beautician', 'adviser');
		}elseif( $type === 'store' ) {
			$type = 'store';			
		}else{
			return returnMsg('error_type');
		}
		
		
		$collect = $this->collect_model->ls($uuid, $type);
		if ( !empty( $collect )  ) {
			$this->load->model('store_model');
			$this->load->model('beautician_model');
			$this->load->model('employees_manage_model');
			$this->load->library('photo');
			
			foreach ($collect as $k => $v) {
					    	
				if( $v['type'] === 'store' ) {
					$store = $this->store_model->one($v['relation_id']);
					if( empty($store) ) {
						continue;
					}
					
					$collect[$k]['name']       = $store['sname'];
					$collect[$k]['address']   = $store['adress'];
					$collect[$k]['mobile']     = $store['telephone'];
					$collect[$k]['photo']      = $this->photo->makeUrl( $store['slistimgnew']  );
				}elseif( $v['type'] === 'beautician' ) {
					$beautician = $this->beautician_model->one($v['relation_id']);
					if( empty($beautician) ) {
						continue;
					}
					
					$collect[$k]['name'] = $beautician['nickname'];
					$collect[$k]['store_name'] = $beautician['sname'];
					$collect[$k]['photo'] =  $this->photo->makeUrl( $beautician['photonew'] );
				} elseif( $v['type'] === 'adviser' ) {
					$consultant = $this->employees_manage_model->one($v['relation_id']);
					if( empty($consultant) ) {
						continue;
					}
					
					$collect[$k]['name'] = $consultant['nickname'];
					$collect[$k]['store_name'] = $consultant['sname'];
					$collect[$k]['photo'] =  $this->photo->makeUrl( $consultant['photos'] );
				}			    	
			}
		}
		return returnMsg('success', $collect);
	}
	
	public function add($uuid, $id, $type)
	{
		if( empty($uuid) ) {
			return returnMsg('error_uuid');
		}
		if( !isId($id) ) {
			return returnMsg('error_id');
		}
		if( !in_array($type, $this->typeArray) ) {
			return returnMsg('error_type');
		}
		
		$this->load->model('collect_model');
		
		$one = $this->collect_model->one($uuid, $id, $type);
		if( $one ) {
			return returnMsg('already_exists');
		}
		$add = $this->collect_model->add($uuid, $id, $type);
		if( !$add ) {
			return returnMsg('error_add');
		}
		return returnMsg('success');
		
	}
	
	public function delete($uuid, $relationId, $type)
	{
		if( empty($uuid) ) {
			return returnMsg('error_uuid');
		}
		if( !isId($relationId) ) {
			return returnMsg('error_id');
		}
		if( !in_array($type, $this->typeArray) ) {
			return returnMsg('error_type');
		}
		
		$this->load->model('collect_model');
		
		$one = $this->collect_model->one($uuid, $relationId, $type);
		if( !$one ) {
			return returnMsg('error_not_exists');
		}
		
		$delete = $this->collect_model->delete($uuid, $relationId, $type);
		if( !$delete ) {
			return returnMsg('error_delete');
		}
		return returnMsg('success');
		
	}
	
	
	public function deleteById($uuid, $id) {
		
		if( empty($uuid) ) {
			return returnMsg('error_uuid');
		}
		if( !isId($id) ) {
			return returnMsg('error_id');
		}
		$this->load->model('collect_model');
		
		$delete = $this->collect_model->deleteById($uuid, $id);
		if( !$delete ) {
			return returnMsg('error_delete');
		}
		return returnMsg('success');
		
	}
	
	
}	