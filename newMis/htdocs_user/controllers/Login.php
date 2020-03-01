<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index()
    {
    	$this->load->service('user_service');
    	$wechat = $this->user_service->oneWechatByOpenid($this->wechat['openid']);
    	$data['wechat'] = $wechat['data'];
    	
        $this->load->view('glob/header.php');
        $this->load->view('login/index.php', $data);
        $this->load->view('glob/footer.php');
    }
    
 	public function actionGetVerifycode()
 	{
 		$mobile = $this->input->post('mobile', true);
 		
 		$this->load->service('sms_service');
 		$checkExists = false;
 		$sendResult = $this->sms_service->sendLoginMsg($mobile, $checkExists);
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
 	
 	
 	public function actionLogin()
 	{
 		$mobile = $this->input->post('mobile', true);
 		$code    = $this->input->post('code', true);
 		
 		$this->load->service('user_service');
 		$login = $this->user_service->login($mobile, $code);
 		switch ($login['msg']) {
 			case 'success':
 				$bindResult = $this->user_service->wechatBindUser($this->wechat['openid'], $login['data']['userid'], $login['data']['uuid']);
 				if( $bindResult['msg'] !== 'success' ) {
 					exit('登录失败，请重新尝试！');
 				}
 				exit('success');
 				break;
 			case 'error_user_not_exists':
 				exit('手机号未注册');
 				break;
 			case 'error_code':
 				exit('验证码错误');
 				break;
 			case 'error_not_invite_user':
 			    exit('error_not_invite_user');
 			    exit('非常抱歉，现在是测试时间暂停注册，请谅解。祝您每天泰美好');
 			    break;
 			case 'error_mobile':
 				exit('手机号错误');
 				break;
 			case 'error_used':
 				exit('验证码已被使用，请重新获取');
 				break;
 			case 'error_most_retry_times':
				exit('验证码已失效，请重新获取');
 				break;
 			case 'error_sms_one':
 				exit('未获取验证码，请先获取验证码');
 				break;
 			case 'error_expire':
 				exit('验证码已过期，请重新获取');
 				break;
 			default:
 				echo '网络错误，请稍后再试';
 				break;
 		}
 		
 	}
 	
 	
}
