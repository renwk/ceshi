<?php
class User_service extends MY_Service{
	
	const MOST_RETRY_TIMES = 3;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	/**
	     * 获取用户相关信息
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function one($uuid)
	{
		if( empty($uuid) ) {
			return returnMsg('error_uuid');
		}
		
		$this->load->model('users_model');
		$user = $this->users_model->oneByUid($uuid);
		if( !$user ) {
			return returnMsg('error_user');
		}

		$return = array();
		//用户信息
		$return['userinfo'] = $user;
		
		//用户储值卡余额（爱币）
		$this->load->model('mycard_model');
		$balance = $this->mycard_model->balance($uuid);
		$return['balance'] = $balance ? $balance['total_money'] : 0;
		//用户会员卡总数
		$cardCount = $this->mycard_model->countMy($uuid, 'except_expired');
		$return['cardNums'] = $cardCount;
		//用户优惠券总数
		$this->load->model('mycoupon_model');
		$couponCount = $this->mycoupon_model->countMy($uuid, 'on');
		$return['couponNums'] = $couponCount;
		
		return returnMsg('success', $return); 
	}
	
	
	/**
	     * 登录
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function login($mobile, $code)
	{

		if( !defined('SMS_MINUTES_EXPIRE') ) {
			return returnMsg('error_defined');
		}
		if( !isMobile($mobile) ) {
			return returnMsg('error_mobile');
		}
		if( !isVerifycode($code) ) {
			return returnMsg('error_code');
		}
		
		//获取短信验证码
		$this->load->model('sms_model');
		$oneLast = $this->sms_model->oneLast($mobile, 'login');
		if ( empty($oneLast) ) {
			return returnMsg('error_sms_one');
		}
		if( $oneLast['retry'] >= self::MOST_RETRY_TIMES ) {
			return returnMsg('error_most_retry_times');
		}
		if( time() > $oneLast['create_time'] + SMS_MINUTES_EXPIRE*60 ) {
			return returnMsg('error_expire');
		}
		if( $oneLast['code'] != $code ) {
			$this->sms_model->retryOneMore($oneLast['id']);
			return returnMsg('error_code');
		}
		if( $oneLast['used'] != 0) {
			return returnMsg('error_used');
		}
		//修改结果
		$this->sms_model->used($oneLast['id']);

        //检查用户注册情况
        $this->load->model('users_model');
        $user = $this->users_model->oneByMobile($mobile);

        if (!$user) {
            //没有用户 生成一个用户
            $uid = makeUuid();
            $userId = $this->users_model->createUser($mobile, $uid);
            if (!$userId) {
                return returnMsg('error_create_user');
            }

            $user['userid'] = $userId;
            $user['uid'] = $uid;
        }else{
            if( $user['is_invite_user'] != 1 ) {
                return returnMsg('error_not_invite_user');
            }
            
        }
		
		
		//登录 写入session
		$this->load->service('session_service');
		$userSession = array(
				'userid' => $user['userid'],
				'uuid' => $user['uid'],
                'role' => '1'
		);
		$this->session_service->setUserSession($userSession);
	
		return returnMsg('success', $userSession);
		
	}
	
	public function wechatLogin()
	{
		$openid =  $this->input->get('openid', true);
		
		if( $openid ) {
			
			$this->load->service('session_service');
			$this->load->model('login_wechat_model');
			$one = $this->login_wechat_model->oneByOpenid($openid);
			if( !$one ) {
				$nickname     =  $this->input->get('nickname', true);
				$sex 		      =  $this->input->get('sex', true);
				$language      =  $this->input->get('language', true);
				$city              =  $this->input->get('city', true);
				$province      =  $this->input->get('province', true);
				$country       =  $this->input->get('country', true);
				$headimgurl =  $this->input->get('headimgurl', true);
				$add = $this->login_wechat_model->add($openid, $nickname, $sex, $language, $city, $province, $country, $headimgurl);
				if( !$add ) {
					return returnMsg('error_add');
				}
			}else{
				if(  $one['uid'] && $one['userid'] ) {
					$sessionUser = array(
						'userid' => $one['userid'],
						'uuid' => $one['uid']
					);
					$this->session_service->setUserSession($sessionUser);
				} 
			}
			$sessionWechat = array(
				'openid' => $openid
			);
			
			$this->session_service->setWechatSession($sessionWechat);
			return returnMsg('success', $sessionWechat);
		}else{
			//去获取openid
			$url  = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$baseUrl = urlencode($url);
			$url = 'http://m.ispa.cn/oauth/oauth.php?scope=snsapi_userinfo&state=' . $baseUrl;
			Header("Location: $url");
			exit();
		}
	}


    public function wechatShopLogin()
    {
        $openid =  $this->input->get('openid', true);

        if( $openid ) {

            $this->load->service('session_service');
            $this->load->model('employees_associate_model');
            $one = $this->employees_associate_model->oneByOpenid($openid);
            if( !$one ) {
                $nickname     =  $this->input->get('nickname', true);
                $sex 		      =  $this->input->get('sex', true);
                $language      =  $this->input->get('language', true);
                $city              =  $this->input->get('city', true);
                $province      =  $this->input->get('province', true);
                $country       =  $this->input->get('country', true);
                $headimgurl =  $this->input->get('headimgurl', true);
                $add = $this->employees_associate_model->add($openid, $nickname, $sex, $language, $city, $province, $country, $headimgurl);
                if( !$add ) {
                    return returnMsg('error_add');
                }
            }else{
                if(  $one['uid'] && $one['id'] ) {
                    $sessionUser = array(
                        'iduser' => $one['id'],
                        'iduu' => $one['uid'],
                        'role' => $one['role']
                    );
                    $this->session_service->setUserSession($sessionUser);
                }
            }
            $sessionWechat = array(
                'openidshop' => $openid
            );

            $this->session_service->setWechatSession($sessionWechat);
            return returnMsg('success', $sessionWechat);
        }else{
            //去获取openid
            $url  = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $baseUrl = urlencode($url);
            $url = 'http://m.ispa.cn/oauth/oauth.php?scope=snsapi_userinfo&state=' . $baseUrl;
            Header("Location: $url");
            exit();
        }
    }

	public function searchLogin($openid){
        //获取短信验证码
        $this->load->model('employees_associate_model');
        $employeeinfo = $this->employees_associate_model->oneByOpenid($openid);
        if(empty($employeeinfo['mobile'])){
            return returnMsg('error_empty');
        }
        //登录 写入session
        $this->load->service('session_service');
        $userSession = array(
            'userid' => $employeeinfo['id'],
            'uuid' => $employeeinfo['uid'],
            'role' => $employeeinfo['role']
        );
        $this->session_service->setUserSession($userSession);
        return returnMsg('success',$employeeinfo);
    }

	public function shopLogin($mobile, $code,$openid = null,$appopenid=null){


        if( !defined('SMS_MINUTES_EXPIRE') ) {
            return returnMsg('error_defined');
        }
        if( !isMobile($mobile) ) {
            return returnMsg('error_mobile');
        }
        if( !isVerifycode($code) ) {
            return returnMsg('error_code');
        }

        //获取短信验证码
        $this->load->model('sms_model');
        $oneLast = $this->sms_model->oneLast($mobile, 'login');
        if ( empty($oneLast) ) {
            return returnMsg('error_sms_one');
        }
        if( $oneLast['retry'] >= self::MOST_RETRY_TIMES ) {
            return returnMsg('error_most_retry_times');
        }
        if( time() > $oneLast['create_time'] + SMS_MINUTES_EXPIRE*60 ) {
            return returnMsg('error_expire');
        }
        if( $oneLast['code'] != $code ) {
            $this->sms_model->retryOneMore($oneLast['id']);
            return returnMsg('error_code');
        }
        if( $oneLast['used'] != 0) {
            return returnMsg('error_used');
        }
        //修改结果
        $this->sms_model->used($oneLast['id']);
        $res = 1;
        $data = array();

        //检查用户注册情况
        $this->load->model('employees_associate_model');
        $data = $this->employees_associate_model->getOne($mobile);
        if(!empty($openid)){
            $openid_data = $this->employees_associate_model->oneByOpenid($openid);
            $data['openid'] = $openid;

        }else if(!empty($appopenid)){
            $openid_data = $this->employees_associate_model->oneByAppopenid($appopenid);
            $data['appopenid'] = $appopenid;
            if($openid_data['openid'] || $openid_data['appopenid']){
                $data['type'] = "upapp";
            }
        }else{
            exit('微信登录失败,请重新绑定');
        }


        if(!$data || empty($openid_data['mobile'])){
            $this->load->model('employees_manage_model');
            $consultant = $this->employees_manage_model->oneByMobile($mobile);
            if (count($consultant)<1 ||$consultant['position'] == 2) {
                $manager = $consultant;
                if (!$manager) {
                    $this->load->model('beautician_model');
                    $beautician = $this->beautician_model->oneByMobile($mobile);
                    if (!$beautician) {
                        $this->load->model('admin_model');
                        $admin = $this->admin_model->oneByMobile($mobile);
                        if (!$admin) {
                            return returnMsg('error_user_not_exists');
                        } else {
                            $data['role'] = 'operator';
                            $data['uid'] = $admin['aid'];
                        }
                    } else {
                        $data['role'] = 'beautician';
                        $data['uid'] = $beautician['bid'];
                    }
                } else {
                    $data['role'] = 'manage';
                    $data['uid'] = $manager['id'];

                }
            } else {
                $data['role'] = 'consultant';
                $data['uid'] = $consultant['id'];
            }
            $data['mobile'] = $mobile;
            $data['status'] = 1;
        }

        //登录 写入session
        $this->load->service('session_service');
        $userSession = array(
            'iduu' => $data['uid'],
            'role' => $data['role']
        );
        $this->session_service->setUserSession($userSession);

        return returnMsg('success', $data);
    }
    /**
     * 匹配用户信息
     * @param $openid
     * @return array
     * @author rwk
     */
    public function getUserInfo($openid){
        $this->load->model('employees_associate_model');
        $employee = $this->employees_associate_model->searchOne($openid);
        $mobile = $employee['mobile'];

        $monthBegin=mktime(8,0,0,date('m'),1,date('Y'));
        if($employee['role'] == 'consultant' || $employee['role'] == 'manage'){ //顾问 经理
            $this->load->model('employees_manage_model');
            $consultant = $this->employees_manage_model->oneByMobile($mobile);
            $this->load->service('performance_service');
            $employee['info'] = $consultant;

        }elseif ($employee['role'] == 'beautician'){//理疗师
            $this->load->model('beautician_model');
            $beautician = $this->beautician_model->oneByMobile($mobile);
            $this->load->service('performance_service');
            $employee['info'] = $beautician;

        }elseif ($employee['role'] == 'operator'){//用户
            $this->load->model('admin_model');
            $employee['userinfo'] = $this->admin_model->oneByMobile($mobile);

        }
        return $employee;
    }
    public function getAppUserInfo($openid){
        $this->load->model('employees_associate_model');
        $employee = $this->employees_associate_model->oneByAppopenid($openid);
        $mobile = $employee['mobile'];

        $monthBegin=mktime(8,0,0,date('m'),1,date('Y'));
        if($employee['role'] == 'consultant' || $employee['role'] == 'manage'){ //顾问 经理
            $this->load->model('employees_manage_model');
            $consultant = $this->employees_manage_model->oneByMobile($mobile);
            $this->load->service('performance_service');
            $employee['info'] = $consultant;

        }elseif ($employee['role'] == 'beautician'){//理疗师
            $this->load->model('beautician_model');
            $beautician = $this->beautician_model->oneByMobile($mobile);
            $this->load->service('performance_service');
            $employee['info'] = $beautician;

        }elseif ($employee['role'] == 'operator'){//用户
            $this->load->model('admin_model');
            $employee['userinfo'] = $this->admin_model->oneByMobile($mobile);

        }
        return $employee;
    }
    /**
     * 用户信息
     * @param  $openid,$type
     * @return array
     * @author rwk
     */
    public function getInfo($openid,$type){
        $this->load->model('employees_associate_model');
        if($type == 'app'){
            $employee = $this->employees_associate_model->oneByAppopenid($openid);
        }else{
            $employee = $this->employees_associate_model->searchOne($openid);
        }
        $mobile = $employee['mobile'];
        $monthBegin=mktime(8,0,0,date('m'),1,date('Y'));
        if($employee['role'] == 'consultant' || $employee['role'] == 'manage'){ //顾问 经理
            $this->load->model('employees_manage_model');
            $consultant = $this->employees_manage_model->oneByMobile($mobile);

            $employee['info'] = $consultant;

        }elseif ($employee['role'] == 'beautician'){//理疗师
            $this->load->model('beautician_model');
            $beautician = $this->beautician_model->oneByMobile($mobile);
            if($type =='info'|| $type=='app'){
                $employee['level'] = $this->beautician_model->getlevel($beautician['bid'],$monthBegin-28800);//级别
            }
            $btime = $this->beautician_model->requestBidHoursSort($beautician['bid']);
            if ($btime) {
                $total = $btime['actual_time'] + $btime['initial_time'] + $btime['thrown_time']+$btime['clock_time']+$btime['add_bell_time']+$btime['overtime'];
                $beautician['detail1'] = number_format($total / 60, 2, '.', '');
            }else{
                $beautician['detail1'] = 0;
            }
            $employee['info'] = $beautician;

        }elseif ($employee['role'] == 'operator'){//用户
            $this->load->model('admin_model');
            $employee['info'] = $this->admin_model->oneByMobile($mobile);
            $employee['info']['photo'] = "";
//            p($employee);die;

        }
        return $employee;
    }
	/**
	     * 设置交易密码
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function setTransPwd($uuid, $verifyCode, $password, $checkPassword)
	{
		
		if( !defined('SMS_MINUTES_EXPIRE') ) {
			return returnMsg('error_defined');
		}
		if( !$uuid ) {
			return returnMsg('error_uuid');
		}
		if( !isVerifycode($verifyCode) ) {
			return returnMsg('error_code');
		}
		if( !isTransPwd($password) ) {
			return returnMsg('error_password');
		}
		if( $password !== $checkPassword ) {
			return returnMsg('error_checkPwd');
		}
		
		//检查用户注册情况
		$this->load->model('users_model');
		$user = $this->users_model->oneByUid($uuid);
		if( !$user ) {
			return returnMsg('error_user_not_exists');
		}
		$mobile = $user['mobile'];
		if( !isMobile($mobile) ) {
			return returnMsg('error_mobile');
		}
		//获取短信验证码
		$this->load->model('sms_model');
		$oneLast = $this->sms_model->oneLast($mobile, 'transactionPassword');
		if ( empty($oneLast) ) {
			return returnMsg('error_sms_one');
		}
		if( $oneLast['retry'] >= self::MOST_RETRY_TIMES ) {
			return returnMsg('error_most_retry_times');
		}
		if( time() > $oneLast['create_time'] + SMS_MINUTES_EXPIRE*60 ) {
			return returnMsg('error_expire');
		}
		if( $oneLast['code'] != $verifyCode ) {
			$this->sms_model->retryOneMore($oneLast['id']);
			return returnMsg('error_code');
		}
		if( $oneLast['used'] != 0) {
			return returnMsg('error_used');
		}
		$this->sms_model->used($oneLast['id']);
		$set = $this->users_model->setTransPwd($uuid, $password);
		if( !$set ) {
			return returnMsg('error_set_transPwd');
		}
		return returnMsg('success');
	}


	
	
	public function oneWechatByOpenid($openid)
	{
		if( empty($openid) ) {
			return returnMsg('error_openid');
		}
		$this->load->model('login_wechat_model');
		$one = $this->login_wechat_model->oneByOpenid($openid);
		
		if( empty($one) ) {
			return returnMsg('error_one');
		}
		
		return returnMsg('success', $one);
	}
    public function upWechatByOpenid($data){
        if( empty($data['openid']) ) {
            return returnMsg('error_openid');
        }
        $this->load->model('login_wechat_model');
        $one = $this->login_wechat_model->oneByOpenid($data['openid']);
        if( empty($one) ) {
            $res = $this->login_wechat_model->add($data['openid'], $data['nickname'], $data['sex'], $data['language'], $data['city'], $data['province'], $data['country'], $data['headimgurl']);
        }else{
            $res = $this->login_wechat_model->changedata($data['openid'],$data);
        }
        if($res){
            return returnMsg('success', $data);
        }else{
            return returnMsg('error', $one);
        }
    }
    public function oneShopWechatByOpenid($openid,$type=null)
    {
        if( empty($openid) ) {
            return returnMsg('error_openid');
        }
        $this->load->model('employees_associate_model');
        if($type == 'app'){
            $one = $this->employees_associate_model->oneByAppopenid($openid);
        }else{
            $one = $this->employees_associate_model->oneByOpenid($openid);
        }
        $sessionUser = array(
            'iduser' => $one['id'],
            'iduu' => $one['uid'],
            'role' => $one['role']
        );
        $this->session_service->setUserSession($sessionUser);
        if( empty($one) ) {
            return returnMsg('error_one');
        }

        return returnMsg('success', $one);
    }

	public function oneWechatById($id)
	{
		if( !isId($id) ) {
			return returnMsg('error_openid');
		}
		$this->load->model('login_wechat_model');
		$one = $this->login_wechat_model->oneById($id);
		return returnMsg('success', $one);
	}
	
	public function oneWechatByUid($uid)
	{
		if( !$uid ) {
			return returnMsg('error_uid');
		}
		$this->load->model('login_wechat_model');
		$one = $this->login_wechat_model->oneByUid($uid);
		return returnMsg('success', $one);
	}
	
	public function wechatBindUser($openid, $userid, $uuid)
	{
		if( empty($openid) || !isId($userid) || empty($uuid) ) {
			return returnMsg('error_param');
		}

		$this->load->model('login_wechat_model');
		$bindUser = $this->login_wechat_model->bindUser($openid, $userid, $uuid);
		if( !$bindUser ) {
			return returnMsg('error_binduser');
		}
		return returnMsg('success');
	}
    public function shopWechatBindUser($openid, $uid, $role,$mobile)
    {
        if( empty($openid) || empty($uid) || empty($uid) || empty($mobile) ) {
            return returnMsg('error_param');
        }
        $this->load->model('employees_associate_model');
        $bindUser = $this->employees_associate_model->bindUser($openid, $uid, $role,$mobile);
        if( !$bindUser ) {
            return returnMsg('error_binduser');
        }
        return returnMsg('success');
    }
    public function appWechatBindUser($appopenid, $uid, $role,$mobile,$type)
    {
        if( empty($appopenid) || empty($uid) || empty($uid) || empty($mobile) ) {
            return returnMsg('error_param');
        }
        $this->load->model('employees_associate_model');
        if($type == 'add'){
            $bindUser = $this->employees_associate_model->addbindUser($appopenid, $uid, $role,$mobile);
        }else if($type == 'updapp'){
            $bindUser = $this->employees_associate_model->upUserByAppopenid($appopenid, $uid, $role,$mobile);
        }else{
            $bindUser = $this->employees_associate_model->appbindUser($appopenid, $uid, $role,$mobile);
        }
        if( !$bindUser ) {
            return returnMsg('error_binduser');
        }
        return returnMsg('success');
    }
	
	public function checkTransactionPassword($uuid, $password)
	{
		if( empty($uuid)  || empty($password) ) {
			return returnMsg('error_params');
		}
		
		$this->load->model('users_model');
		$user = $this->users_model->oneByUid($uuid);
		if( !$user ) {
			return returnMsg('error_user');
		}
		
		if( $user['transaction_password'] !== md5($password) ) {
			return returnMsg('error_password');
		}
		return returnMsg('success');
	}
	
	
	/**
	 * 获取我的地址
	 * @param
	 * @return return_type
	 * @author Leo<liukai5455@163.com>
	 */
	
	
	public function lsMyAddress($uuid)
	{
	    if( !$uuid ) {
	        return returnMsg('error_uuid');
	    }
	    
	    $this->load->model('user_address_model');
	    $address = $this->user_address_model->lsByUuid($uuid);
	    return returnMsg('success', $address);
	    
	}
	
	
	
	/**
	 * 添加地址
	 * @param
	 * @return return_type
	 * @author Leo<liukai5455@163.com>
	 */
	public function addAddress($uuid, $name, $mobile, $address, $isDefault)
	{
	    if( !$uuid ) {
	        return returnMsg('error_uuid');
	    }
	    if( !$name ) {
	        return returnMsg('error_name');
	    }
	    if( !isMobile($mobile) ) {
	        return returnMsg('error_mobile');
	    }
	    if( !$address ) {
	        return returnMsg('error_address');
	    }
	    
	    $isDefault = $isDefault === 'yes' ? 'yes' : 'no';
	    
	    $this->load->model('user_address_model');
	    if( $isDefault === 'yes' ) {
	        //只能有一个默认地址 如果添加该地址为默认的话 其他的默认地址改为no
	        $updateDefault = $this->user_address_model->updateDefaultNo($uuid);
	    }
	    
	    $add = $this->user_address_model->add($uuid, $name, $mobile, $address, $isDefault);
	    
	    if( !$add ) {
	        return returnMsg('error_add');
	    }
	    
	    return returnMsg('success');
	}
	
	
	
	/**
	 * 修改地址
	 * @param
	 * @return return_type
	 * @author Leo<liukai5455@163.com>
	 */
	
	public function updateAddress($uuid, $id, $name, $mobile, $address, $isDefault)
	{
	    
	    if( !$uuid ) {
	        return returnMsg('error_uuid');
	    }
	    if( !isId($id) ) {
	        return returnMsg('error_id');
	    }
	    if( !$name ) {
	        return returnMsg('error_name');
	    }
	    if( !isMobile($mobile) ) {
	        return returnMsg('error_mobile');
	    }
	    if( !$address ) {
	        return returnMsg('error_address');
	    }
	    
	    
	    $isDefault = $isDefault === 'yes' ? 'yes' : 'no';
	    
	    $this->load->model('user_address_model');
	    if( $isDefault === 'yes' ) {
	        //只能有一个默认地址 如果该地址为默认的话 其他的默认地址改为no
	        $this->user_address_model->updateDefaultNo($uuid);
	    }
	    
	    $update = $this->user_address_model->update($uuid, $id, $name, $mobile, $address, $isDefault);
	    
	    if( !$update ) {
	        return returnMsg('error_update');
	    }
	    
	    return  returnMsg('success');
	    
	}
	
	/**
	 * 根据id获取个人地址 
	 * @param
	 * @return return_type
	 * @author Leo<liukai5455@163.com>
	 */
	
	public function oneAddressByUuidAndId($uuid, $id)
	{
	    if( !$uuid ) {
	        return returnMsg('error_uuid');
	    }
	    
	    if( !isId($id) ) {
	        return returnMsg('error_id');
	    }
	    
	    $this->load->model('user_address_model');
	    $address = $this->user_address_model->oneByUuidAndId($uuid, $id);
	    if( !$address ) {
	        return returnMsg('error_address');
	    }
	    return returnMsg('success', $address);
	}
	
	
	/**
	 * 删除地址
	 * @param
	 * @return return_type
	 * @author Leo<liukai5455@163.com>
	 */
	
	public function deleteAddress($uuid, $addressId)
	{
	    if( !$uuid ) {
	        return returnMsg('error_uuid');
	    }
	    
	    if( !isId($addressId) ) {
	        return returnMsg('error_id');
	    }
	    
	    $this->load->model('user_address_model');
	    $delete = $this->user_address_model->delete($uuid, $addressId);
	    if( !$delete ) {
	        return returnMsg('error_delete');
	    }
	    
	    return returnMsg('success');
	}
	
	/**
	 * 默认地址
	 * @param
	 * @return return_type
	 * @author Leo<liukai5455@163.com>
	 */
	
	public function oneDefaultAddress($uuid)
	{
	    if( !$uuid ) {
	        return returnMsg('error_uuid');
	    }
	    
	    $this->load->model('user_address_model');
	    $address = $this->user_address_model->oneDefaultByUuid($uuid);
	    if( !$address ) {
	        //如果没有默认地址的话 取最新的那个地址
	        $address = $this->user_address_model->oneLastByUuid($uuid);
	    }
	    
	    return returnMsg('success', $address);
	}
	
	/**
	
	* 阅读用户协议
	
	* @date: Dec 24, 2018 3:10:27 PM
	
	* @param: $openid 
	
	* @return:
	
	* @author: Leo<liukai5455@163.com>
	
	*/
	public function  readAgreement($openid)
	{
	    if( !$openid ) {
	        return returnMsg('error_openid');
	    }
	    
	    $this->load->model('login_wechat_model');
	    $result = $this->login_wechat_model->readAgreement($openid);
	    return returnMsg($result ? 'success' : 'error_update');   
	}

    /**
     * 解除绑定
     * @date:
     * @param: $appopenid
     */
	public function deluser($appopenid){
        $this->load->model('employees_associate_model');
        $res = $this->employees_associate_model->upUserByAppopenid($appopenid);
        return returnMsg($res ? '解绑成功' : '解绑失败');
    }
    public function getStaffBrithday($sid){
        $this->load->model('beautician_model');
	    $beauticians = $this->beautician_model->getBeauticianBySid($sid);

        $md = date('m').'-'.date('d');

        $data=array();
        foreach ($beauticians as $k => $v){
            if(!empty($v['brithday'])){
                $md1 = date("m-d",$v['brithday']);
                if($md == $md1){
                    $data[$k]['nickname'] = $v['nickname'];
                    $data[$k]['brithday'] = $v['brithday'];
                }
            }
        }
        return $data;
    }
    public function getaccesstoken(){
        $this->load->model('users_model');
        $token = $this->users_model->oneLastToken();
        return $token;
    }
    public function addAccessToken($res){

        $this->load->model('users_model');
        $token = $this->users_model->addToken($res);
        return $token;
    }
    public function getformid($openid){
        $this->load->model('users_model');
        $data = $this->users_model->getformid($openid);
        return $data;
    }
    public function addformid($data){
        $this->load->model('users_model');
        $res = $this->users_model->addFormid($data);
        return $res;

    }
    public function sent($id){
        $this->load->model('users_model');
        $res = $this->users_model->sent($id);
        return $res;
    }
    public function gradessent($id){
        $this->load->model('users_model');
        $res = $this->users_model->gradessent($id);
        return $res;
    }
	public function getgradechange($type,$bid,$time){
        if(!empty($bid)){
            $this->load->model('users_model');
            $res = $this->users_model->GradeChange($type,$bid,$time);
            return $res;
        }else{
            return false;
        }

    }
}