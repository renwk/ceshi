<?php
class LoginAuth {
	private $CI;
	public function __construct()
	{
		$this->CI = &get_instance();
	}
	//权限认证
	public function auth()
	{
		if( is_cli() ){
			return false;
		}
		
		$this->CI->load->helper('url');
		//邀请分享出去的模板和退出不进行微信登录
		if ( preg_match("/logout.*|invite\/template.*/i", uri_string() ) ) {
			return false;
		}
		//微信支付回调地址 不进行验证
		if(  preg_match("/WxpayCallback.*/i", uri_string() )   ) {
			return false;
		}
		
		
		if( !isWechat() ) {
			exit('请在微信浏览器中打开！');
		}
		
		$this->CI->load->service('session_service');
		$this->CI->load->service('user_service');
		
		$sessionWechat = $this->CI->session_service->getWechatSession();
		
		if( empty($sessionWechat) ) {
			
			$wechatLogin = $this->CI->user_service->wechatLogin();
			
			if( $wechatLogin['msg'] !== 'success' ) {
				exit('微信登录失败，请重新尝试！');
			}else{
				$url  = rtrim($_SERVER['REQUEST_URI'], '/');
				redirect($url);
			}
			
		}
		
		$openid = $sessionWechat['openid'];
		$wechat = $this->CI->user_service->oneWechatByOpenid($openid);
		
		if(   $wechat['msg'] !== 'success'  || empty($wechat['data'])  ) {
			exit('微信登录失败，请重新尝试！');
		}
		
		//如果是分享出去领取爱币的页面  和绑定手机领取爱币方法 不去验证手机号
		if(  preg_match("/acceptIb.*|actionBindMobileAndGetIb*|actionGetIbSendCode*/i", uri_string() ) ) {
			return false;
		} 
		
		//未验证手机号 去验证
		if( !preg_match("/login.*/i", uri_string() )  && empty( $wechat['data']['uid'] )   )
		{
			redirect('login/index');
		}
		
		//已验证手机号 跳转首页
		if( preg_match("/login.*/i", uri_string() )  &&   $wechat['data']['uid']  ) {
			redirect('index/index');
		}
		
     }
	


}