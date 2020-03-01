<?php
/**
     * `会员卡相关
     * @param 
     * @return return_type
     * @author liujing<liukai5455@163.com>
     */
class Card_service extends MY_Service{
	protected $giveIbExpiredSecond;
	public function __construct()
	{
		$this->load->model('mycard_model');
		$this->giveIbExpiredSecond = 3600*72;//72小时
		parent::__construct();
	}
	
	public function countMy($uuid, $state = 'all', $account = 'all', $exceptIbCard = false)
	{
		if( !$uuid ) {
			return returnMsg('error_uuid');
		}
		
		$count = $this->mycard_model->countMy($uuid, $state, $account, $exceptIbCard);
		
		return returnMsg('success', $count);
		
	}
	public function lsMy($uuid, $state = 'all', $account = 'all', $exceptIbCard = false)
	{
		if( !$uuid ) {
			return returnMsg('error_uuid');
		}
		$list = $this->mycard_model->lsMy($uuid, $state, $account, $exceptIbCard);
		$returnArray = array();
		if( !empty($list) ) {
			$this->load->model('member_discount_model');
			$this->load->model('mycourse_model');
			$openArray = array();
			$initArray = array();
			$frozenArray = array();
			$expiredArray = array();
			$closedArray  =array();
			foreach ($list as $key => &$val) {
				
				//获取服务折扣
				$serviceDiscountEasy = $this->member_discount_model->serviceDiscountEasy($val['cardid']);
				$val['serviceDiscountEasy'] = $serviceDiscountEasy ? $serviceDiscountEasy['discount'] : 100;
				
				$serviceDiscountIspa = $this->member_discount_model->serviceDiscountIspa($val['cardid']);
				$val['serviceDiscountIspa'] = $serviceDiscountIspa ? $serviceDiscountIspa['discount'] : 100;
				//常规金卡 疗程卡 获取次数
				if( $val['accounts'] !== 'balance' ) {
					$mycourse = $this->mycourse_model->oneByMycardid($val['mycardid']);
					$val['total_nums'] = $mycourse ? $mycourse['total'] : 0;
					$val['use_nums'] = $mycourse ? $mycourse['used_times'] : 0;
					$val['left_nums'] = $list[$key]['total_nums'] - $list[$key]['use_nums'];
				}
				
				//排序 按照 正常、待开卡、冻结，过期，停用的顺序显示。
				if( $val['status'] == 1 ) {
					$openArray[$key] = $val;
				}elseif( $val['status'] == 0 ) {
					$initArray[$key] = $val;
				}elseif( $val['status'] ==  2) {
					$frozenArray[$key] = $val;
				}elseif( $val['status'] == 6) {
					$expiredArray[$key] = $val;
				}elseif( $val['status'] == 3 ) {
					$closedArray[$key] = $val;
				}else{
					
				}
			}
			
			$returnArray = array_merge($openArray, $initArray, $frozenArray, $expiredArray, $closedArray);
			
		}
		return returnMsg('success', $returnArray);
	}
	
	
	public function one($uuid, $mycardid)
	{
		if( !isId($mycardid) || empty($uuid) ) {
			return returnMsg('error_params');
		}
		
		$card = $this->mycard_model->oneByMycardid($mycardid);
		
		if( $card['uid'] !== $uuid ) {
			return returnMsg('error_uid');
		}
		
		//获取服务折扣
		$this->load->model('member_discount_model');
		$serviceDiscountEasy = $this->member_discount_model->serviceDiscountEasy($card['cardid']);
		$card['serviceDiscountEasy'] = $serviceDiscountEasy ? $serviceDiscountEasy['discount'] : 100;
		
		$serviceDiscountIspa = $this->member_discount_model->serviceDiscountIspa($card['cardid']);
		$card['serviceDiscountIspa'] = $serviceDiscountIspa ? $serviceDiscountIspa['discount'] : 100;
		
		return returnMsg('success', $card);
	}
	
	public function transactionGiveIb($uuid, $mycardid, $giveInfo)
	{
		if( !$uuid ) {
			return returnMsg('error_uuid');
		}
		if( !isId($mycardid) ) {
			return returnMsg('error_mycardid');
		}
		if( !is_array($giveInfo) || !$giveInfo ){
			return returnMsg('error_info');
		}

		$card = $this->mycard_model->oneByMycardid($mycardid);
		
		if( $card['uid'] !== $uuid ) {
			return returnMsg('error_uid');
		}
		
		foreach ($giveInfo as $val) {
			if( !isset($val['mobile']) ||  !isMobile( $val['mobile'] ) ) {
				return returnMsg('error_mobile');
			}
			if( !isset($val['ib']) ||  !isFloat( $val['ib'] ) ) {
				return returnMsg('error_ib');
			}
		}
		
		$balance = $card['money_available'];
		
		$ibTotal = array_sum( array_column($giveInfo, 'ib') );
		$changeMoney =  ib2Money($ibTotal);
		if(  !$ibTotal || $changeMoney  > $balance ) {
			return returnMsg('error_balance_not_enough');
		}
		
		$this->load->model('give_ib_model');
		
		
		$this->db->trans_start();
		$expiredTime = time() + $this->giveIbExpiredSecond;
		$giveIbId = $this->give_ib_model->transactionGiveIb($uuid, $mycardid, $giveInfo, $expiredTime);
		$changeBalance = $this->mycard_model->transactionChangeBalance($uuid, $mycardid, $balance,  $changeMoney, 'give');
		$complete = $this->db->trans_complete();
		if ( !$complete ) {
			return returnMsg('error_give_ib');
		}
		
		
		return returnMsg('success', array( 'give_id' => $giveIbId) );
		
	}
	
	
	public function giveIbInfo($uuid, $giveId)
	{
		if( !$uuid ) {
			return returnMsg('error_uuid');
		}
		if( !isId($giveId) ) {
			return returnMsg('error_mycardid');
		}
		
		$this->load->model('give_ib_model');
		$give = $this->give_ib_model->one($giveId);
		
		if( empty($give) || $give['uid'] !== $uuid ) {
			return returnMsg('error_give');
		}
		
		$this->load->model('give_ib_info_model');
		$list = $this->give_ib_info_model->lsByGiveid($giveId);
		
		$return  = array(
			'give' => $give,
			'give_info' => $list	
		);
		return returnMsg('success', $return);
	}
	
	public function oneGiveIb($giveId)
	{
		
		if( !isId($giveId) ) {
			return returnMsg('error_giveid');
		}
		
		$this->load->model('give_ib_model');
		$give = $this->give_ib_model->one($giveId);
		
		if( empty($give) ) {
			return returnMsg('error_give');
		}
		
		$uid = $give['uid'];
		$this->load->model('login_wechat_model');
		$wechat = $this->login_wechat_model->oneByUid($uid);
		
		$return = array(
			'give'      => $give,
			'give_wechat' => $wechat	
		);
		
		return returnMsg('success', $return);
	}
	
	public function oneGiveinfoByGiveidAndAcceptmobile($giveId, $acceptMobile)
	{
	
		if( !isId($giveId) ) {
			return returnMsg('error_giveid');
		}
		
		$this->load->model('give_ib_info_model');
		$giveInfo = $this->give_ib_info_model->oneByGiveIdAndMobile($giveId, $acceptMobile);
		
		if( empty($giveInfo) ) {
			return returnMsg('error_giveinfo');
		}
		return returnMsg('success', $giveInfo);
	}
	
	public function transactionGetIb($uuid, $giveId)
	{
		if( !$uuid ) {
			return returnMsg('error_uuid');
		}
       	if( !isId($giveId) ) {
       		return returnMsg('error_giveId');
       	}	
		
       	$this->load->model('give_ib_model');
		$give = $this->give_ib_model->one($giveId);
		if( empty($give) ) {
			return returnMsg('error_give');
		}
		
		$this->load->model('users_model');
		$user = $this->users_model->oneByUid($uuid);
		if( !$user ) {
			return returnMsg('error_user');
		}
		
		$acceptMobile = $user['mobile'];
		$this->load->model('give_ib_info_model');
		$giveInfo = $this->give_ib_info_model->oneByGiveIdAndMobile($giveId, $acceptMobile);
		
		if( empty($giveInfo) ) {
			return returnMsg('error_giveinfo');
		}
		
		//验证状态
		if( $giveInfo['state'] !== 'init' ) {
			return returnMsg('error_giveinfo_state');
		}
	
		if( $give['state'] !== 'open' || $give['ib_left'] <=0 ) {
			return returnMsg('error_give_state');
		}
		
		$acceptMobile = $giveInfo['accept_mobile'];
		$acceptIb        = $giveInfo['accept_ib'];
		
		$this->db->trans_start();
		$giveIbId = $this->give_ib_model->transactionGetIb($giveId, $acceptMobile, $acceptIb);
		
		$mycardId = $this->mycard_model->transactionCreateIbcard($uuid);
		
		$changeBalance = $this->mycard_model->transactionChangeBalance($uuid, $mycardId, 0,  ib2Money($acceptIb), 'get');
		
		$complete = $this->db->trans_complete();
		if ( !$complete ) {
			return returnMsg('error_get_ib');
		}
		return returnMsg('success');
		
       	
	}

	
	public function oneGiveIbExpired()
	{
		$this->load->model('give_ib_model');
		$one = $this->give_ib_model->oneExpired();
		
		if( empty($one) ) {
			return returnMsg('block');
		}
		
		
		if( $one['ib_left'] <=0  ) {
			
			$update = $this->give_ib_model->closed($one['id']);
			if( !$update ) {
				return returnMsg('error_update');
			}
			return returnMsg('continue');
		}
		
		
		if(  $one['expired_time'] <= time()  ) {
			$update = $this->give_ib_model->transactionExpired($one['id']);
			if( !$update ) {
				return returnMsg('error_update');
			}
			return returnMsg('continue');
		}
		
	}
	
	/**
	 * 获取会员卡
	 * 
	 */
	
	public function lsCard()
	{
	    
	    $this->load->model('card_model');
	    $list = $this->card_model->ls();
	    
	    if( !empty($list) ) {
	        
	        $this->load->model('card_explain_model');
	        foreach ($list as &$v){
	            
	           $explain = $this->card_explain_model->lsByCardid($v['cardid']);
	           $v['explain'] = $explain; 
	            
	        }
	        
	    }
	    
	    return returnMsg('success', $list);
	}
	
	public function oneCard($cardid)
	{
	    if( !isId($cardid) ) {
	        return returnMsg('error_cardid');
	    }
	    
	    $this->load->model('card_model');
	    $card = $this->card_model->one($cardid);
	    
	    if( !$card || $card['is_online_sales'] !== 'yes' || $card['type'] !== 'shop' || $card['accounts'] !== 'balance'  ) {
	        return returnMsg('error_card');
	    }
	    
	    return returnMsg('success', $card);
	    
	}
	
	
	public function addBuyCardExtension($uuid, $mycardid, $cardid, $ucardOrderId, $getWay, $addressId)
	{
	    
	    if( !$uuid ) {
	        return returnMsg('error_uuid');
	    }
	    
	    if( !isId( $mycardid ) ) {
	        return returnMsg('error_uuid');
	    }
	    
	    if( !isId( $cardid ) ) {
	        return returnMsg('error_uuid');
	    }
	    
	    if( !isId( $ucardOrderId ) ) {
	        return returnMsg('error_uuid');
	    }
	    
	    if( !isId($addressId) ) {
	        $getWay = 'shop';
	    }
	    
	    if( !in_array($getWay, array('shop', 'express') ) ) {
	        return returnMsg('error_getway');
	    }
	    
	    $this->load->model('buy_card_extension_model');
	    $add = $this->buy_card_extension_model->add($uuid, $mycardid, $cardid, $ucardOrderId, $getWay, $addressId);
	    
	    if( !$add ) {
	        return returnMsg('error_add');
	    }
	    return returnMsg('success');
	    
	}
	
	
}