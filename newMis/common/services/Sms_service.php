<?php
class Sms_service extends MY_Service{

	
	private $defAliyunSmsTemplate = array(
        'login' => array(
            'templateCode' => 'SMS_142610061',
            'templateMsg' => '验证码为{code}，请在30分钟内填写。退订回复TD'
        ),
		'transactionPassword' => array(
			'templateCode' => 'SMS_69955750',
			'templateMsg' => '您的验证码是code，验证码于30分钟后过期，请尽快使用。'	
		),
	    'productCode' => array(
	        'templateCode' => 'SMS_146120143',
	        'templateMsg' => '你的提货码为code，提货时请提供提货码。'	
	    ),
	);
	
	private $defSmsType = array(
			'login' => '登录短信',
			'transactionPassword' => '支付密码短信',
	        'productCode' => '购卡提货码'
	);
	
	
	const ALIYUN_SMS_SIGN = '泰美好';
	
	
	const SMS_PLATFORM = 'aliyun'; //短信发送平台
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sms_model');
	}
	
	
	public function sendLoginMsg($mobile, $checkExists = true)
	{
		if(  !defined('ALIYUN_ACCESS_KEY_ID') ||
            !defined('ALIYUN_ACCESS_KEY_SECRET') ||
			 !defined('SMS_MINUTES_BY_IP') ||
		     !defined('SMS_MAX_TIMES_BY_MOBILE') ||
			 !defined('SMS_MINUTES_BY_MOBILE')
		) {
			return returnMsg('error_define');
		}
		if( !isMobile($mobile) ) {
			return returnMsg('error_mobile');
		}

		//检查用户注册情况
		if( $checkExists ) {
			$this->load->model('users_model');
			$user = $this->users_model->oneByMobile($mobile);
			if( !$user ) {
				return returnMsg('error_user_not_exists');
			}
		}
		//检查发送次数限制

		$beginTime = time() - SMS_MINUTES_BY_MOBILE *60;
		$countMobile = $this->sms_model->countByMobile($mobile, $beginTime);
		if( $countMobile['total_nums'] >= SMS_MAX_TIMES_BY_MOBILE ) {
			return returnMsg('error_max_times');
		}
		
		$beginTime = time() - SMS_MINUTES_BY_IP *60;
		$ip = $_SERVER['REMOTE_ADDR'];
		$countIp = $this->sms_model->countByIp($ip, $beginTime);
		if( $countIp['total_nums'] >= SMS_MAX_TIMES_BY_IP ) {
			return returnMsg('error_max_times');
		}
		$type = 'login';
		$isNow = true;
		return $this->addSms($mobile, $type,  $ip, $isNow);
	}
	

	public function sendTransPwdMsg($uuid)
	{
		if(  !defined('SMS_MAX_TIMES_BY_IP') ||
				!defined('SMS_MINUTES_BY_IP') ||
				!defined('SMS_MAX_TIMES_BY_MOBILE') ||
				!defined('SMS_MINUTES_BY_MOBILE')
		) {
			return returnMsg('error_define');
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
		
		//检查发送次数限制
	
		$beginTime = time() - SMS_MINUTES_BY_MOBILE *60;
		$countMobile = $this->sms_model->countByMobile($mobile, $beginTime);
		if( $countMobile['total_nums'] >= SMS_MAX_TIMES_BY_MOBILE ) {
			return returnMsg('error_max_times');
		}
	
		$beginTime = time() - SMS_MINUTES_BY_IP *60;
		$ip = $_SERVER['REMOTE_ADDR'];
		$countIp = $this->sms_model->countByIp($ip, $beginTime);
		if( $countIp['total_nums'] >= SMS_MAX_TIMES_BY_IP ) {
			return returnMsg('error_max_times');
		}
		$type = 'transactionPassword';
		$isNow = true;
		return $this->addSms($mobile, $type,  $ip, $isNow);
	}
	
	public function sendProductCodeMsg($uuid) {
	    
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
	    
	    $type = 'productCode';
	    
	    return $this->addSms($mobile, $type);
	    
	}
	
	
	private function addSms($mobile, $type,  $ip = '', $isNow = true, $userId = 0)
	{
		if( !isMobile($mobile) ) {
			return returnMsg('error_mobile');
		}
		if( empty($type) || !$this->isDefType($type)) {
			return returnMsg('error_type');
		}
		
		switch (self::SMS_PLATFORM) {
		
			case 'aliyun':
				$template = $this->getDefAliyunTemplate($type);
				if( !$template ) {
					return returnMsg('error_type');
				}
				
				
				$code = $template['code'];
				$msg = $template['msg'];
				$templateCode = $template['templateCode'];
				$templateParam = $template['templateParam'];
				
			
				$insert = $this->sms_model->add($mobile, self::SMS_PLATFORM, $code, $msg, $type,  $ip, $isNow, $userId);
				if( !$insert ) {
					return returnMsg('error_add_sms');
				}
				//生产环境并立即发送 不是立即发送的 由后台发送（可在10点-20点之间发送）
				if(  $isNow  && ENVIRONMENT === 'production'  ) {
					$sendResponse = $this->sendAliyunSms($mobile, self::ALIYUN_SMS_SIGN, $templateCode, $templateParam);
					//修改结果
					$state = $sendResponse['msg'] === 'success' ? 'success' : 'error';
					$this->sms_model->updateState($insert, $state, json_encode($sendResponse['data']));
				}
				return returnMsg('success');
				break;
		/*
		 * 
		 * 如果有其他平台 
		 * case '其他平台':
		 * 	code...
		 * break;
		 * 
		 */		
				
				
			default:
				return returnMsg('error_platform');
				break;
		
		}
		

	}
	
	
	
	
	/**
	     * 
	     * @param $mobile
	     *  @param $sign 模板签名 【泰美好】短信前面的签名
	     *  @param $templateCode 阿里短信模板编码
	     *  @param array $templateParam 模板里对应的模板参数, 假如模板中存在变量需要替换则为必填项Array (
        "code" => "12345"
    );
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	
	private  function sendAliyunSms($mobile, $sign, $templateCode, $templateParam = array())
	{
		if( !defined('ALIYUN_ACCESS_KEY_ID') || !defined('ALIYUN_ACCESS_KEY_SECRET') ) {
			return returnMsg('error_error_define'); 	
		 }
		
		 if( !isMobile($mobile) ) {
		 	return returnMsg('error_mobile');
		 }
		 
		if( empty($sign) || empty($templateCode)  ) {
			return returnMsg('error_param');
		}		 
		 
		$params = array ();
		$accessKeyId = ALIYUN_ACCESS_KEY_ID;
		$accessKeySecret = ALIYUN_ACCESS_KEY_SECRET;
		$params["PhoneNumbers"] = $mobile;
		$params["SignName"] = $sign;
		$params["TemplateCode"] = $templateCode;
		$params['TemplateParam'] = $templateParam;
		if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
			$params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
		}
		
		
		$this->load->library('aliyunSms/signaturehelper');
		// 初始化SignatureHelper实例用于设置参数，签名以及发送请求
		// 此处可能会抛出异常，注意catch
		$content =  $this->signaturehelper->request(
				$accessKeyId,
				$accessKeySecret,
				"dysmsapi.aliyuncs.com",
				array_merge($params, array(
						"RegionId" => "cn-hangzhou",
						"Action" => "SendSms",
						"Version" => "2017-05-25",
				))
				// fixme 选填: 启用https
				// ,true
		);
		if( !$content ) {
			return returnMsg('error_empty_response');
		}
		/*
		 RequestId	   String	8906582E-6722	请求ID
		Code	           String	OK	状态码-返回OK代表请求成功,其他错误码详见错误码列表
		Message	   String	请求成功	状态码的描述
		BizId         String	134523^4351232	发送回执ID,可根据该ID查询具体的发送状态
		*/
		if( strtolower($content['Code']) !== 'ok' ) {
			return returnMsg('error_send_error', $content);
		}
	
		return returnMsg('success', $content);
		
	}
	
	private function getDefAliyunTemplate($type)
	{
		
		if( !isset($this->defAliyunSmsTemplate[$type]) ) {
			return false;
		}
		
		$templateCode = $this->defAliyunSmsTemplate[$type]['templateCode'];
		$templateMsg = $this->defAliyunSmsTemplate[$type]['templateMsg'];
		
		if($type === 'login') {
			$code = makeVerifyCode();
			$msg =  str_ireplace('code', $code, $templateMsg);
			$templateParam = array(
				'code' => $code
			);
			
			/**
			 * 如果有其他模板 
			 * 定义 $defAliyunSmsTemplate['其他']
			 * 定义 $defSmsType
			 * elseif( $type === '其他' ) {
			 * 	code
			 * 	组合 code  msg templateParam
			 * }
			 */
			
		} elseif( $type === 'transactionPassword' ){
			$code = makeVerifyCode();
			$msg =  str_ireplace('code', $code, $templateMsg);
			$templateParam = array(
					'code' => $code
			);
		} elseif( $type === 'productCode' ){
		    $code = makeVerifyCode();
		    $msg =  str_ireplace('code', $code, $templateMsg);
		    $templateParam = array(
		        'code' => $code
		    );
		} else {
			$code = 0;
			$msg = $templateMsg;
			$templateParam = array();	
		}
		
		return array(
			'templateCode' => $templateCode,
			'msg' => $msg,
			'code' => $code,
			'templateParam' => $templateParam			
		);
		
	}
	private function isDefType($type)
	{
		return  ( isset($this->defSmsType[$type]) && !empty(  $this->defSmsType[$type] ) ) ? $this->defSmsType[$type] : false;
	}
	
}