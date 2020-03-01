<?php

class Order_service extends MY_Service{
	//消费订单支付方式
	protected $orderPayType = array(
				1 => '现金',
				2 => 'POS',
				3 => '支票',
				4 => '挂账',
				5 => '现金礼券',
				6 => '免单',
				7 => '赠送',
				8 => '合作',
				9 => '储值',
				10 => '免零',
				11 => '多收零钱',
	);
	
	protected $orderCompleteStatus = 8105;
	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	     * 获取已完成的消费订单
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function cousumptionList($uuid)
	{
		if( empty($uuid) ) {
			return returnMsg('error_uuid');
		}
		
		$this->load->model('order_model');
		$orderList = $this->order_model->lsCousumption($uuid, 'complete');

		if( !empty( $orderList ) ) {
			$this->load->model('order_detail_model');
			foreach ($orderList as $k => $v ) {
				
				$detail = $this->order_detail_model->lsByCode($v['order_code']);
				$orderList[$k]['item'] = $detail;
				
			}	
		}

		return returnMsg('success', $orderList);
	}
	
	/**
	     * 获取充值订单
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function rechargeList($uuid)
	{
		if( empty($uuid) ) {
			return returnMsg('error_uuid');
		}
		
		$this->load->model('ucard_order_model');
		$orderList = $this->ucard_order_model->ls($uuid,  'complete');
		if( !empty( $orderList ) ) {
			$this->load->model('gift_card_model');
			$this->load->model('mycard_model');
			
			foreach ($orderList as $k => $v) {

				if( empty($v['card_type']) ) {
					//礼券卡 
					$giftCard = $this->gift_card_model->oneByOid($v['oid']);
					
					if( empty( $giftCard ) ) {
						continue;
					}
					$orderList[$k]['cardinfo'] = $giftCard;
					$orderList[$k]['card_no'] = $giftCard[0]['card_no']; //卡号 礼券卡使用第一张的显示
				} else {
					
					$mycard = $this->mycard_model->oneByMycardid( $v['ucard_id'] );
					
					if( empty($mycard) ) {
						continue;
					}
					$orderList[$k]['cardinfo'][0] = array(
							'cardname' => $mycard['cardname'],
							'money' => $mycard['money']*100,
					);
					if( $v['cost'] > 0 ) { //如果带手续费的 将手续费明细也补充上
						$orderList[$k]['cardinfo'][1] = array(
								 'cardname' => '手续费',
            				     'money' => $v['cost']*100 
						);
					}
					$orderList[$k]['card_no'] = $mycard['card_no'];
				}
			}
		}

		return returnMsg('success', $orderList);
	}
	
	/**
	     * 获取预约订单
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function appointmentList($uuid,$time=null) {
		if( empty($uuid) ) {
			return returnMsg('error_uuid');
		}
		$this->load->model('order_model');
		if(empty($time)){
            $list = $this->order_model->lsAppointment($uuid);
        }else{
            $list = $this->order_model->appointmentList($uuid,$time);
        }

		if( !empty($list) ) {
			$this->load->model('store_model');
			$this->load->model('order_beautician_model');
			
			foreach ($list as $key => $order) {
				$orderCode = $order['order_code'];
				$storeCode = $order['store_id'];
				
				$store = $this->store_model->oneByCode($storeCode);
				$list[$key]['store'] = $store;
				
				$beauticianList = $this->order_beautician_model->lsByOrderCode($orderCode);
				$list[$key]['beautician'] = $beauticianList;
			}
			
		}
		
		return returnMsg('success', $list);
	}
	
	
	
	
	/**
	     * 获取一个充值订单 
	     * 	没用到 后续用到补全
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function oneRecharge($id, $uuid)
	{
		if( !isId($id) ) {
			return returnMsg('error_id');
		}
		if( empty($uuid) ) {
			return returnMsg('error_uuid');
		}
		
		$this->load->model('ucard_order_model');
		$rechargeOrder = $this->ucard_order_model->one($id);
		if( empty($rechargeOrder) ) {
			return returnMsg('error_order');
		}
		if( $rechargeOrder['userid'] !== $uuid ) {
			return returnMsg('error_uuid');
		}
		
		$storeCode = $rechargeOrder['sid'];
		$this->load->model('store_model');
		$store = $this->store_model->oneByCode($storeCode);
		
		$rechargeOrder['store'] = $store;
		
		$this->load->model('gift_card_model');
		$this->load->model('mycard_model');
		
		if( empty($rechargeOrder['card_type']) ) {
			//礼券卡
			$giftCard = $this->gift_card_model->oneByOid($rechargeOrder['oid']);
				
			if( !empty( $giftCard ) ) {
				$rechargeOrder['cardinfo'] = $giftCard;
				$rechargeOrder['card_no'] = $giftCard[0]['card_no']; //卡号 礼券卡使用第一张的显示
			}
			
		} else {
				
			$mycard = $this->mycard_model->oneByMycardid( $rechargeOrder['ucard_id'] );
				
			if( !empty($mycard) ) {
				
			}
			$rechargeOrder['cardinfo'][0] = array(
					'cardname' => $mycard['cardname'],
					'money' => $mycard['money']*100,
			);
			if( $rechargeOrder['cost'] > 0 ) { //如果带手续费的 将手续费明细也补充上
				$rechargeOrder['cardinfo'][1] = array(
						'cardname' => '手续费',
						'money' => $rechargeOrder['cost']*100
				);
			}
			$rechargeOrder['card_no'] = $mycard['card_no'];
		}
		
		//顾问
		if( $rechargeOrder['consultant_id'] ) {
			
			$idArray =  explode(',', $rechargeOrder['consultant_id']);
			if( !empty($idArray) ) {
				$this->load->model('employees_manage_model');
				$adviser = $this->employees_manage_model->lsByIdArray($idArray);
				$rechargeOrder['adviser'] = $adviser;
			}
		}
		
		//支付方式
		$this->load->model('settlement_record_model');
		$paytypeArray = $this->settlement_record_model->lsByOid($rechargeOrder['oid']);
		
		if(  $paytypeArray ) {
			$paytypeArray = array_map(function($paytype){
				$paytype['paytype'] = $this->orderPayType[$paytype['paytype']] ? $this->orderPayType[$paytype['paytype']] : '其他';
				return $paytype;
			}, $paytypeArray);
		}
		$rechargeOrder['order_paytype'] =  $paytypeArray;
		//优惠券
		if( !empty( $rechargeOrder['gift_coupon'] ) ) {
			$couponArray = json_decode($rechargeOrder['gift_coupon'], true);
			if( !empty($couponArray) ) {
				$this->load->model('coupon_model');
				foreach ( $couponArray AS $key => $cv ) {
					
					$coupon = $this->coupon_model->one($cv['couponid']);
					$couponArray[$key]['coupon_name'] = $coupon ? $coupon['couponname'] : '';
				}
				
				$rechargeOrder['coupon_array'] = $couponArray;
				
			}
			
		}
		
		//获取购卡赠送礼包扩展信息
		$this->load->model('buy_card_extension_model');
		$extension = $this->buy_card_extension_model->oneByOrderid($id);
		$rechargeOrder['buy_card_extension'] = $extension;
		
		return returnMsg('success', $rechargeOrder);
		
	}
	/**
	     * 获取一个消费订单
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	
	public function oneConsumption($id, $uuid)
	{
		if( !isId($id) ) {
			return returnMsg('error_id');
		}
		if( empty($uuid) ) {
			return returnMsg('error_uuid');
		}
		
		$this->load->model('order_model');
		$order = $this->order_model->one($id);
		if( empty($order) ) {
			return returnMsg('error_order');
		}
		if( $order['user_id'] !== $uuid ) {
			return returnMsg('error_uuid');
		}
		
		$this->load->library('photo');
		$this->load->model('collect_model');
		
		$storeCode = $order['store_id'];
		$this->load->model('store_model');
		$store = $this->store_model->oneByCode($storeCode);
		if( $store ) {
			
			//查询是否被收藏
			$collectStore = $this->collect_model->one($uuid, $store['storeid'], 'store');
			$store['is_collect'] = $collectStore ? true : false;
			$store['photo']  =  $this->photo->makeUrl($store['slistimgnew']);
			$order['store']  = $store;
		}
 		
		$orderCode = $order['order_code'];
		$this->load->model('order_adviser_model');
		$adviserList = $this->order_adviser_model->lsByOrderCode($orderCode);
		if( $adviserList ) {
			
			foreach ($adviserList as $ak => $av) {
				$adviserList[$ak]['photo'] =  $this->photo->makeUrl($av['photos']);
				$collectAdviser = $this->collect_model->one($uuid, $av['adviser_id'], 'adviser');
				$adviserList[$ak]['is_collect'] =  $collectAdviser ? true : false;
			}
			
			$order['adviser'] = $adviserList;
			
		} 
		
		$this->load->model('order_beautician_model');
		$beauticianList = $this->order_beautician_model->lsByOrderCode($orderCode);
		if( $beauticianList ) {
			
			foreach ( $beauticianList as $bk => $bv ) {
				$beauticianList[$bk]['photo'] = $this->photo->makeUrl($bv['photonew']);
				$collectBeautician = $this->collect_model->one($uuid, $bv['beauticianid'], 'beautician');
				$beauticianList[$bk]['is_collect'] = $collectBeautician ? true : false;
			}
			
			$order['beautician'] = $beauticianList;
			
		}
		
		//所在房间
		$this->load->model('store_rtime_model');
		$storeRoom = $this->store_rtime_model->lsByOid($orderCode);
		if( $storeRoom ) {
			$order['store_room'] = $storeRoom;
		}
		
		//项目
		$this->load->model('order_detail_model');
		$detail = $this->order_detail_model->lsByCode($orderCode);
		$order['item'] = $detail;
		//优惠券
		$couponId = $order['coupon_code'];
		if( !empty($couponId) ) {
			$this->load->model('mycoupon_model');
			$coupon = $this->mycoupon_model->oneById($couponId);
			$order['coupon'] = $coupon;
		}
		//支付方式
		$this->load->model('settlement_record_model');
		$paytypeArray = $this->settlement_record_model->lsByOid($order['id']);
		
		if(  $paytypeArray ) {
			$paytypeArray = array_map(function($paytype){
				$paytype['paytype'] = $this->orderPayType[$paytype['paytype']] ? $this->orderPayType[$paytype['paytype']] : '其他';
				return $paytype;
			}, $paytypeArray);
		}
		$order['order_paytype'] =  $paytypeArray;
		
		//评价
		$this->load->model('comment_model');	
		$comment = $this->comment_model->oneByUidAndOrderid($uuid, $id);
		$order['comment'] = $comment;
		
		return returnMsg('success', $order);
	}
	
	
	
	/**
	     * 用户消费订单确认
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function confirmOrder($uuid, $id, $password)
	{
		if( empty($uuid) ) {
			return returnMsg('error_uuid');
		}
		if( !isId($id) ) {
			return returnMsg('error_id');
		}
		if( empty($password) ) {
			return returnMsg('error_password');
		}
		
		$this->load->model('users_model');
		$user = $this->users_model->oneByUid($uuid);
		if( !$user ) {
			return returnMsg('error_user');
		}

		$this->load->model('order_model');
		$order = $this->order_model->one($id);
		if( empty($order) ) {
			return returnMsg('error_order');
		}
		if( $order['user_id'] !== $uuid ) {
			return returnMsg('error_order');
		}
		if( $order['status'] != $this->orderCompleteStatus ) {
			return returnMsg('error_order');
		}
		if( $order['confirm_state'] !== 'init' ) {
			return returnMsg('error_order');
		}
		
		if( $user['transaction_password'] !== md5($password) ) {
			return returnMsg('error_password');
		}
		
		$confirm = $this->order_model->confirmOrder($uuid, $id);
		if( !$confirm ) {
			return returnMsg('error_confirm');
		}
		
		return returnMsg('success');
		
		
	}

    /**
     * 预约单展示
     * @param
     * @return return_type
     * @author rwk
     */
	public function bespeakList($bid,$time,$role){
        $etime = $time +86400;
	    if($role == 'beautician'){
            $this->load->model('order_model');
            $bespeak = $this->order_model->beauticianBespeakOrder($bid,$time,$etime);
            $bespeakorder = $this->bespeakInfo($bespeak,$bid,'beautician');
            return $bespeakorder;
        }elseif ($role =='consultant'){
            $this->load->model('order_model');
            $bespeak = $this->order_model->consultantBespeakOrder($bid,$time,$etime);
            $bespeakorder = $this->bespeakInfo($bespeak,$bid,'consultant');
            return $bespeakorder;
        }
    }
    /**
     * 预约单详情
     * @param
     * @return array
     * @author rwk
     */
    public function getbespeakinfo($order_code,$bid = null){
        $this->load->model('order_model');
        $bespeak = $this->order_model->bespeakOrderInfo($order_code);

        $bespeakinfo = $this->bespeakInfo($bespeak,$bid,'info');

        return $bespeakinfo;
    }
    public function bespeakInfo($bespeakorder,$bid,$type){
        $data = array();
        $bids =array();
        if($type != 'info') {
            foreach ($bespeakorder as $key => $val) {
                $day = date('m.d', $val['prestatus_time']);
                $sid_room = explode(',', $val['sid_room']);
                $this->load->model('order_model');
                if ($type == 'beautician') {
                    $bname = $this->order_model->beauticianNameByOrder($val['order_code']);
                } elseif ($type == 'consultant') {
                    $bname = $this->order_model->consultantNameByOrder($val['order_code']);
                }
                $s_name = '';
                foreach ($sid_room as $k => $v) {
                    $sname = $this->order_model->requestBespeakRoom($v);
                    $s_name .= $sname['srname'] . ',';
                }
                if($val['status'] == '-100'){
                    $state['config_description'] = "服务中";
                }else{
                    $state = $this->order_model->getConfigSystem($val['status']);
                }
                $data[$day][$key]['code_id'] = $val['code_id'];
                $data[$day][$key]['y_time'] = date('Y/m/d/H:i', $val['prestatus_time']);
                $data[$day][$key]['ytime'] = date('m.d', $val['prestatus_time']);
                $data[$day][$key]['order_code'] = $val['order_code'];
                $data[$day][$key]['status'] = $val['status'];
                $data[$day][$key]['iusetime'] = round($val['iusetime'] / 60);
                $data[$day][$key]['state'] = $state['config_description'];
                $data[$day][$key]['nickname'] = $val['nickname'];
                $data[$day][$key]['user_id'] = $val['user_id'];
                $data[$day][$key]['userid'] = $val['userid'];
                $data[$day][$key]['mobile'] = $val['mobile'];
                $data[$day][$key]['service_number'] = $val['is_bath'] == 1 ? $val['service_number'] . ' (泡浴)' : $val['service_number'];
                $data[$day][$key]['b_name'] = $bname['bname'];
                $data[$day][$key]['s_name'] = rtrim($s_name, ',');//$s_name;
                $data[$day][$key]['type'] = $type;//角色;
            }
            return $data;
        }elseif ($type =='info'){ //详情
            $sid_room = explode(',', $bespeakorder['sid_room']);
            $this->load->model('order_model');
            $source = $this->getchannel($bespeakorder['source']);
            $source_detail = $this->getchannel($bespeakorder['source_detail']);
            $data['ssource'] = $source['name'];
            $data['ssource_detail'] = $source_detail['name'];
            $bname = $this->order_model->beauticianNameByOrder($bespeakorder['order_code']);
            $aname = $this->order_model->consultantNameByOrder($bespeakorder['order_code']);
            $s_name = '';
            foreach ($sid_room as $k => $v) {
                $sname = $this->order_model->requestBespeakRoom($v);
                $s_name .= $sname['srname'] . ',';
            }
            $state = $this->order_model->getConfigSystem($bespeakorder['status']);
            $data['code_id'] = $bespeakorder['code_id'];
            $data['y_time'] = date('Y/m/d/H:i', $bespeakorder['prestatus_time']);
            $data['ytime'] = date('m.d', $bespeakorder['prestatus_time']);
            $data['order_code'] = $bespeakorder['order_code'];
            $data['status'] = $bespeakorder['status'];
            $data['sex'] = $bespeakorder['sex'];
            $data['iusetime'] = round($bespeakorder['iusetime']/60);
            $data['state'] = $state['config_description'];
            $data['nickname'] = $bespeakorder['nickname'];
            $data['user_id'] = $bespeakorder['user_id'];
            $data['mobile'] = $bespeakorder['mobile'];
            $data['service_number'] = $bespeakorder['is_bath'] == 1 ? $bespeakorder['service_number'].' (泡浴)' : $bespeakorder['service_number'];
            $data['b_name'] = $bname['bname'];
            $data['a_name'] = $aname['bname'];
            $data['s_name'] = rtrim($s_name,',');//$s_name;
            $data['type'] = $type;//角色;
            return $data;
        }
    }
    //会员卡
    public function mycards($userId){
        $this->load->model('order_model');
        $mycards = $this->order_model->myCords($userId);
        return $mycards;
    }
    /**
     * 获取订单列
     * @param
     * @return array
     * @author rwk
     */
    public function orderList($bid,$stime,$role,$sid,$etime,$ordertype,$condition,$userid){

        $orders = array();
        if($role != '0') {
            if ($ordertype == 1) {
                $orders['cashier'] = $this->cashierOrders($bid, $stime, $role, $etime, $condition);//消费订单
            } else if ($ordertype == 2) {
                $orders['charge'] = $this->chargeOrder($bid, $stime, $role, $etime, $condition);//充值订单
            }

        }else if($userid != '0'){
            if ($ordertype == 1) {
                $orders['cashier'] = $this->payDetail($userid,$stime, $etime, $condition);
            } else if ($ordertype == 2) {
                $orders['charge'] = $this->usercharge($userid,$stime, $etime, $condition);
            }
        }else{
            if ($ordertype == 1) {
                $orders['cashier'] = $this->storecashierOrders($sid,$stime,$etime,$condition);//消费订单
            } else if ($ordertype == 2) {
                $orders['charge'] = $this->storechargeOrder($sid,$stime,$etime,$condition);//充值订单
            }
        }
        return $orders;
    }



    /**
     * 服务订单详情
     * @param
     * @return array
     * @author rwk
     */
    public function orderInfo($order_code){
        $this->load->model('order_model');
        $order_info = $this->order_model->getOrderInfoByCode($order_code);

        $source = $this->getchannel($order_info['source']);
        $source_detail = $this->getchannel($order_info['source_detail']);
        $order_info['ssource'] = $source['name'];
        $order_info['ssource_detail']=$source_detail['name'];
        $order_beautician_list = $this->order_model->getBeauticianByOrderList($order_code);
        $recommend_beautician_list = $this->order_model->getRecommendBeautician($order_code);
        $order_beautician = $this->getOrderBeauticianList($order_beautician_list);

        $adviser_list = $this->order_model->getAdviserByOrderList($order_code);
        $order_adviser = $this->handleDataListByOrder($adviser_list);
        $performance = $this->order_model->getPerformance($order_code);
        $adviser_reception = $this->order_model->getOrderConts($order_code);
        foreach ($performance as $k => $v){
            if($v['position'] == 1 ){
                if(!empty($adviser_reception)){
                foreach ($adviser_reception as $kk=>$vv){
                    if($v['bid'] == $vv['adviser_id']){
                        $performance[$k]['reception'] = $vv['reception'];
                    }
                }
                }else{
                    $performance[$k]['reception'] = 0;
                }
            }else{
                $performance[$k]['reception'] = 0;
            }
        }
        $order_playtype = $this->order_model->getOrderPlayByCode($order_info['id']);
        $order_play = $this->handlePlayList($order_playtype);

        $order_room = $this->order_model->getOrderRoomByCode($order_code);

        $order_info['cover_charge'] = !empty($order_info['cover_charge']) ? number_format($order_info['cover_charge'] / 100, 2, '.', '') : '0.00';
        $order_info['tip'] = !empty($order_info['tip']) ? number_format($order_info['tip'] / 100, 2, '.', '') : '0.00';
        $order_info['order_price'] = !empty($order_info['order_price']) ? number_format($order_info['order_price'] / 100, 2, '.', '') : '0.00';
        $order_info['discount_price'] = !empty($order_info['discount_price']) ? number_format($order_info['discount_price'] / 100, 2, '.', '') : '0.00';
        $order_info['actual_price'] = !empty($order_info['actual_price']) ? number_format($order_info['actual_price'] / 100, 2, '.', '') : '0.00';
        $order_info['cope_price'] = (!empty($order_info['actual_price'])) ? number_format(($order_info['actual_price'] - $order_info['discount_price']), 2, '.', '') : '';

        $order_detail_def = $this->order_model->getOrderDetailByCode($order_code);
        $course = array();
        $gift_card = array();
        $member_discount = 0;
        foreach ($order_detail_def as $k => $v) {
            $course[] = $v["course_id"];
            $gift_card[] = $v["gift_card_id"];
            $member_discount += $v["member_discount"];
        }
        $order_detail_check_list = $this->getOrderDetailCheckList($order_detail_def);
        $order_detail_info = $this->order_model->getOrderDetailInfo($order_detail_check_list, $order_info['sid']);
        $order_detail = array();
        $sumtime = 0;
        foreach ($order_detail_info as $key => $val) {
            foreach ($val as $k => $v) {
                foreach ($order_detail_def as $def_key => $def_val) {
                    if ($def_val['item_id'] == $v['id']) {
                        $order_detail[$def_key] = $def_val;
                        $order_detail[$def_key]['price'] =  number_format($v['price'] / 100, 2, '.', '');
                        $order_detail[$def_key]['now_price'] =number_format($def_val['now_price'] / 100, 2, '.', '');
                        $order_detail[$def_key]['time'] = !empty($v['time']) ? ($v['time'] / 60) . '分钟' : '';
                        $sumtime += !empty($v['time']) ? ($v['time'] / 60):0;
                    }
                }
            }
        }
        $data['sumtime'] = $sumtime;
        $data['order_info'] = $order_info;
        $data['order_beautician'] = $order_beautician;
        $data['order_adviser'] = isset($order_adviser[$order_code])?$order_adviser[$order_code]:'';
        $data['order_room'] = $order_room;
        $data['order_play'] = $order_play;
        $data['order_detail'] = $order_detail;
        $data['order_beautician_list'] = $order_beautician_list;
        $data['recommend_beautician_list'] = $recommend_beautician_list;
        $data['performance'] = $performance;
//        p($data);die;
        return $data;
    }
//    来源明细
    public function getchannel($code){
        $this->load->model('order_model');
        $channel = $this->order_model->getchannel($code);
        return $channel;
    }
    public function getOrderDetailCheckList($order_list){
        $re = array();
        foreach ($order_list as $val) {
            $re[$val['type']][] = $val['item_id'];
        }
        return $re;
    }
    private function getOrderBeauticianList($order_beautician_list) {
        $re = '';
        if (!empty($order_beautician_list)) {
            foreach ($order_beautician_list as $val) {
                $re .= $val['nickname'];
                if ($val['service_type'] == 1) {
                    $re .= '(点钟)' . ' ';
                } else {
                    $re .= ' ';
                }
            }
        }
        return $re;
    }

    public function handlePlayList($order_play) {
        $re = array();
        foreach ($order_play as $key => $val) {
            $re[$key] = $val;
            $re[$key]['paytype'] = $this->getPayType($val['paytype']);
            $re[$key]['ext_info'] = $this->getExtInfo($val['ext_info']);
            $re[$key]['money'] = number_format($val['money'] / 100, 2, '.', '');
        }
        return $re;
    }
    public function getPayType($type) {
        if ($type == '1') {
            $re = '现金';
        } else if ($type == '2') {
            $re = 'POS';
        } else if ($type == '3') {
            $re = '支票';
        } else if ($type == '4') {
            $re = '挂账';
        } else if ($type == '5') {
            $re = '现金礼券';
        } else if ($type == '6') {
            $re = '免单';
        } else if ($type == '7') {
            $re = '赠送';
        } else if ($type == '8') {
            $re = '合作';
        } else if ($type == '9') {
            $re = '储值';
        } else if ($type == '10') {
            $re = '免零';
        } else if ($type == '11') {
            $re = '多收零钱';
        } else {
            $re = '其他';
        }
        return $re;
    }
    public function getExtInfo($info) {//支付类型详情
        $info = json_decode($info, true);
        $re = '';
        if (!empty($info['scattered'])) {
            $pos_type = $this->order_model->getPosType($info['scattered']);
            $info['scattered'] = $pos_type['pay_name']; //pos 机号 1
//$info['serialnum'];//pos 流水号
            $re = '(pos机：' . $info['scattered'] . ' 流水号：' . $info['serialnum'] . ')';
        }

        if (!empty($info['id'])) {
            $card_info = $this->order_model->getMyCardInfo($info['id']);
            $info['id'] = $card_info['ucard_no']; //储值卡 卡号 `
            $re = '(储值卡号：' . $info['id'] . ')';
        }

        if (!empty($info['plat'])) {
            $joinplat = $this->order_model->getConfigSystemList('JOINPLAT'); //合作平台
            $re = '(合作平台：' . $joinplat[$info['plat']] . ' 优惠码：' . $info['coupon'] . ')'; //合作平台
//$info['plat'];//合作 合作方 1
//$info['coupon'];//合作 优惠码
        }

        return $re;
    }

    /**
     * 充值订单详情
     * @param
     * @return array
     * @author rwk
     */
    public function chargeOrderInfo($oid){
        $this->load->model('order_model');
        $isType = $this->order_model->getIsType($oid);//礼券卡
        if (empty($isType['card_type'])) {
            $data['order_info'] = $this->order_model->getCardInfo($oid);
            $data['order_info']['exclusive_aid'] = $data['order_info']['by_consultant'];
            $data['order_info']['status'] = $this->orderStatus($data['order_info']['status']);
            $push_bid = !empty($data['order_info']['card_bid']) ? $data['order_info']['bid'] : array();
            $push_cid = !empty($data['order_info']['consultant_id']) ? $data['order_info']['consultant_id'] : array();
            $data['order_beautician'] = $this->order_model->getBidByOrder($push_bid);
            $data['order_adviser'] = $this->order_model->getCidByOrder($push_cid);
            $order_ucard = $this->order_model->getGiftUCardInfo($data['order_info']['oid']);
            $data['order_ucard'] = array();
            $data['order_info']['money_true_true']=0;
            foreach ($order_ucard as $k => $v) {
                $data['order_ucard'][$k]['cardname'] = $v['cardname'];
                $data['order_ucard'][$k]['accounts'] = '礼券卡';
                $data['order_ucard'][$k]['money'] = ($v['price'] + $v['cover_charge']) / 100;
                $data['order_ucard'][$k]['num'] = 1;
                $data['order_ucard'][$k]['cope'] = ($v['price'] + $v['cover_charge']) / 100;
                $data['order_info']['money_true_true'] += ($v['price'] + $v['cover_charge']) / 100;
            }

            //支付信息
            $order_play_def = $this->order_model->getOrderPlayByCode($data['order_info']['oid']);
            $data['order_play'] = $this->handlePlayList($order_play_def);
            $performance = $this->order_model->getPerformance($oid);
            $data['performance'] = $performance;

        }else{
            $order_info = $this->order_model->getUcardOrder($oid);
            $data['order_info'] = $order_info;
            $order_beautician = $this->order_model->getBidByOrder($order_info['bid']);
            $order_adviser= $this->order_model->getCidByOrder($order_info['consultant_id']);
            $data['order_info']['status'] = !empty($order_info['status']) ? $this->orderStatus($order_info['status']) : '';
            $data['order_info']['gift_coupon'] = !empty($order_info['gift_coupon']) ? $this->makeCouponInfo($order_info['gift_coupon']) : '';
            $data['order_info']['accounts'] = !empty($order_info['accounts']) ? $this->getCardType($order_info['accounts']) : '';


            $order_playtype = $this->order_model->getOrderPlayByCode($order_info['oid']);
            $order_play = $this->handlePlayList($order_playtype);
            $data['order_play'] = $order_play;
            $data['order_beautician'] = rtrim($order_beautician,',');
            $data['order_adviser'] = rtrim($order_adviser,',');
            $performance = $this->order_model->getPerformance($oid);
            $data['performance'] = $performance;
        }
        return $data;
    }
    private function getCardType($type = null) {
        $re = '';
        if ($type == 'common') {
            $re = '常规卡';
        } else if ($type == 'balance') {
            $re = '储值卡';
        } else if ($type == 'other'){
            $re = '疗程卡';
        }else{
            $re = '资格卡';
        }
        return $re;
    }
    private function makeCouponInfo($gift_coupon_json = null) {

        $gift_coupon = json_decode($gift_coupon_json, true);
        if (empty($gift_coupon))
            return '';
        $coupon_list = array();

        foreach ($gift_coupon as $val) {
            $coupon_list[] = $val['couponid'];
        }
        $this->load->model('order_model');
        $coupon_info = $this->order_model->getCouponInfo($coupon_list);
        $re = array();

        foreach ($coupon_info as $key => $val) {
            foreach ($gift_coupon as $v) {
                if ($val['couponid'] != $v['couponid'])
                    continue;
                $re[$key]['num'] = $v['num'];
                $re[$key]['couponname'] = $val['couponname'];
            }
        }

        return $re;
    }
    private function orderStatus($status = null) {
        $re = '';
        if ($status == '0') {
            $re = '待支付';
        } else if ($status == '1') {
            $re = '已支付';
        } else if ($status == '2') {
            $re = '已取消';
        } else if ($status == 3) {
            $re = '退款中';
        } else if ($status == 4) {
            $re = '已退款';
        } else {
            $re = '未知';
        }
        return $re;
    }
    public function cashierOrders($bid,$stime,$role,$etime,$condition){

        $this->load->model('order_model');
        $orderlist=array();
        if($role == 'beautician'){
            $orderlist = $this->order_model->beauticianOrder($bid,$stime,$etime,$condition);
        }elseif ($role =='consultant'){
            $orderlist = $this->order_model->consultantOrder($bid,$stime,$etime,$condition);
        }
        $orders = $this->disposeCashierOrder($orderlist);
        return $orders;
    }
    public function disposeCashierOrder($orders){
        $this->load->model('order_model');
        $order_list = $this->handleOrderList($orders);//消费订单

        $beautician_list = array();
        //订单相关美容师列表
        if (!empty($orders)) {
            $beautician_list = $this->order_model->getBeauticianByOrderList($order_list);
            $beautician_list = $this->handleDataListByOrder($beautician_list);
        }
        $adviser_list = array();
        //订单相关顾问列表
        if (!empty($orders)) {
            $adviser_list = $this->order_model->getAdviserByOrderList($order_list);
            $adviser_list = $this->handleDataListByOrder($adviser_list);
        }

        foreach ($orders as $key=>$val){
            $advisers = array();
            $beauticians = array();
            if($val['type'] == 8603) {
                $orders[$key]['s_name'] = "";
                $this->load->model('order_model');
                $server = $this->order_model->getAdviser($val['order_code']);
                $aid = explode(',',trim($server['consultant_id'],'["]'));
                if(!empty($aid)){
                    foreach ($aid as $k =>$v){

                        $res = $this->order_model->requestConsultantName(trim($v,'[\"]'));
                        $advisers[] =$res['nickname'];
                    }
                    $advisers = implode(',',array_unique($advisers));
                }
                $bid = explode(',',trim($server['bid'],'["]'));
                if(!empty($bid)){
                    foreach ($bid as $k =>$v){
                        $ress = $this->order_model->getBeauticianName(trim($v,'[\"]'));
                        $beauticians[] =$ress['nickname'];
                    }
                    $beauticians = implode(',',array_unique($beauticians));

                }

                $orders[$key]['beautician'] = $beauticians;
                $orders[$key]['adviser'] = $advisers;
            }else{
                $s_name = '';
                $sid_room = explode(',',$val['sid_room']);
                foreach ($sid_room as $k => $v) {
                    $sname = $this->order_model->requestBespeakRoom($v);
                    $s_name .= $sname['srname'] . ',';
                }
                $orders[$key]['s_name'] = rtrim($s_name,',');
                $orders[$key]['beautician'] = $beautician_list[$val['order_code']];
                $orders[$key]['adviser'] = $adviser_list[$val['order_code']];
            }
        }
        return $orders;
    }
    public function disposeChargeOrder($orders){
        foreach ($orders as $key =>$val) {
            $Bname='';
            //订单相关美容师列表
            if (!empty($val['bid'])) {
                $bid = explode(',', $val['bid']);
                foreach ($bid as $vv){
                    $res = $this->order_model->requestBeauticianName($vv);
                    $Bname .=$res['nickname'].'、' ;
                }
            }
            $Aname='';
            //订单相关顾问列表
            if (!empty($val['consultant_id'])) {
                $bid = explode(',', $val['consultant_id']);
                foreach ($bid as $vv){
                    $res = $this->order_model->requestConsultantName($vv);
                    $Aname .=$res['nickname'].'、' ;
                }
            }
            $orders[$key]['beautician']=rtrim($Bname,'、');
            $orders[$key]['adviser']=rtrim($Aname,'、');
        }

        return $orders;
    }
    /**
     * 消费订单
     * @param $sid
     * @return array
     * @author rwk
     */
    public function storecashierOrders($sid,$stime,$etime,$condition){
        $this->load->model('order_model');
        $where = "1=1";
        if(!empty($condition)){
            $where = " `a`.`order_code` LIKE '%{$condition}%' or  `a`.`phone` LIKE '%{$condition}%' ";
        }
        $orderlist = $this->order_model->lsCashierbySid($sid,$stime,$etime,$where);
        $orders = $this->disposeCashierOrder($orderlist);
        return $orders;
    }
    /**
     * 充值订单
     * @param $sid
     * @return array
     * @author rwk
     */
    public function storechargeOrder($sid,$stime,$etime,$condition){
        $this->load->model('order_model');
        $where = "1=1";
        if(!empty($condition)){
            $where = " `a`.`oid` LIKE '%{$condition}%' or  `b`.`mobile` LIKE '%{$condition}%' ";
        }
        $chargeorder = $this->order_model->lsChargebySid($sid,$stime,$etime,$where);
        $orders = $this->disposeChargeOrder($chargeorder);
        return $orders;
    }
    //消费记录
    public function payDetail($userid,$stime, $etime, $condition) {
        $this->load->model('userdetail_model');
        $user_detail = $this->userdetail_model->getUserDetail($userid);
        $orderlist = $this->userdetail_model->getOrderByUid($user_detail['uid'],$stime, $etime, $condition);
        $orders = $this->disposeCashierOrder($orderlist);
        return $orders;
    }
    public function chargeOrder($bid,$stime,$role,$etime,$condition){
        $this->load->model('order_model');
        $chargeorder = $this->order_model->chargeOrder($bid,$stime,$role,$etime,$condition);
        $orders = $this->disposeChargeOrder($chargeorder);
        return $orders;
    }
    public function usercharge($userid,$stime, $etime, $condition){
        $this->load->model('order_model');
        $chargeorder = $this->order_model->usercharge($userid,$stime, $etime, $condition);
        $orders = $this->disposeChargeOrder($chargeorder);
        return $orders;
    }
    public function handleOrderList($order_info) {
        $re = array();
        if(count($order_info)>0) {
            foreach ($order_info as $val) {
                $re[] = $val['order_code'];
            }
        }
        return $re;
    }
    public function handleDataListByOrder($data_list) {
        $re = array();
        foreach ($data_list as $val) {
            if (!empty($re[$val['order_code']])) {
                $re[$val['order_code']] .= ' ' . $val['nickname'];
            } else {
                $re[$val['order_code']] = $val['nickname'];
            }
        }
        return $re;
    }



}