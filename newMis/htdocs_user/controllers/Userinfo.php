<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Userinfo extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$this->load->service('user_service');
		$user = $this->user_service->one($this->user['uuid']);
		
		$wechat = $this->user_service->oneWechatByOpenid($this->wechat['openid']);
		
		$data['userinfo'] = $user['data']['userinfo'];
		$data['wechat']  = $wechat['data'];
		
		$this->load->view('glob/header.php');
		$this->load->view('userinfo/index.php', $data);
		$this->load->view('glob/footer.php');
	}

	
	public function transactionPassword()
	{
		
		$this->load->service('user_service');
		$user = $this->user_service->one( $this->user['uuid'] );
		
		$data = array();
		$data['mobile'] = $user['data']['userinfo']['mobile'];
		
		$this->load->view('glob/header.php');
		$this->load->view('userinfo/transactionPassword.php', $data);
		$this->load->view('glob/footer.php');
	}
	
	public function actionGetTransPwdCode()
	{
		
		$this->load->service('sms_service');
 		$sendResult = $this->sms_service->sendTransPwdMsg($this->user['uuid']);
 		switch ($sendResult['msg']) {
 			case 'success':
 				exit('success');
 				break;
 			case 'error_mobile':
 				exit('手机号输入有误，请重新输入');
 				break;
 			case 'error_user_not_exists':
 				exit('手机号不存在');
 				break;
 			case 'error_max_times':
 				exit('发送次数超出限制');
 				break;
 			default:
 				exit('网络错误，请稍后再试');
 				break;
 		}
		
	}
	
	
	public function actionSetTransPwd()
	{
		$code = $this->input->post('code', true);
		$password = $this->input->post('password', true);
		$checkPassword = $this->input->post('check_password', true);

		$this->load->service('user_service');
		$result = $this->user_service->setTransPwd($this->user['uuid'], $code, $password, $checkPassword);
		
		
		switch ($result['msg']) {
			case 'success':
				exit('success');
				break;
 			case 'error_code':
 				exit('验证码错误');
 				break;
 			case 'error_password':
 				exit('支付密码必须为6位的纯数字');
 				break;
 			case 'error_checkPwd':
 				exit('两次密码输入不一致');
 				break;
 			case 'error_user_not_exists':
 				exit('手机号未注册');
 				break;
 			case 'error_mobile':
 				exit('手机号错误');
 				break;
 			case 'error_sms_one':
 				exit('未获取验证码，请先获取验证码');
 				break;
 			case 'error_most_retry_times':
 				exit('验证码已失效，请重新获取');
 				break;
 			case 'error_expire':
 				exit('验证码已过期，请重新获取');
 				break;
 			case 'error_used':
 				exit('验证码已被使用，请重新获取');
 				break;
 			default:
 				echo '网络错误，请稍后再试';
 				break;
		}
		
	}
	
	public function address()
	{
	    $cardid = $this->input->get('cardid', true);
	    
	    $this->load->service('user_service');
	    $address = $this->user_service->lsMyAddress($this->user['uuid']);
	    
	    $data = array();
	    $data['address'] = $address['data'];
	    $data['cardid'] = $cardid;
	    
	    $this->load->view('glob/header.php');
	    $this->load->view('userinfo/address.php', $data);
	    $this->load->view('glob/footer.php');
	    
	}
	
	
	public function addOrEditAddress($id = null)
	{
	    $cardid = $this->input->get('cardid', true);
	    
	    $data = array();
	    $data['cardid'] = $cardid;
	    
	    if( $id ) {
	        
	        $this->load->service('user_service');
	        $address = $this->user_service->oneAddressByUuidAndId($this->user['uuid'], $id);
	        $data['address'] = $address['data'];
	    }
	    
	    $this->load->view('glob/header.php');
	    $this->load->view('userinfo/addOrEditAddress.php', $data);
	    $this->load->view('glob/footer.php');
	    
	}
	
	public function actionAddOrEditAddress()
	{
	    
	    $id = $this->input->post('id', true);
	    $name = $this->input->post('name', true);
	    $mobile = $this->input->post('mobile', true);
	    $address = $this->input->post('address', true);
	    $isDefault = $this->input->post('is_default', true);
	    
	    $this->load->service('user_service');
	    if( isId($id) ) {
	       $result = $this->user_service->updateAddress($this->user['uuid'], $id, $name, $mobile, $address, $isDefault);
	    }else{
	       $result = $this->user_service->addAddress($this->user['uuid'], $name, $mobile, $address, $isDefault);
	    }
	    switch ($result['msg']) {
	        case 'success':
	            exit('success');
	            break;
	        case 'error_mobile':
	            exit('手机号码填写错误');
	            break;
	        case 'error_name':
	            exit('请填写收货人姓名');
	            break;
	        case 'address':
	            exit('请填写详细地址');
	            break;
	        default: 
	            exit('操作失败，请稍后再试！');
	            break;
	    }
	    
	}
	
	public function actionDelAddress()
	{
	    
	    $addressId = $this->input->post('id', true);
	    
	    $this->load->service('user_service');
	    $result = $this->user_service->deleteAddress($this->user['uuid'], $addressId);

	    switch ($result['msg']) {
	        case 'success':
	            exit('success');
	            break;
	        default:
	            exit('操作失败，请稍后再试！');
	            break;
	    }
	    
	}
	
	
	
	
	
}