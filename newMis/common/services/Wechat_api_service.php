<?php

/*
 * 微信公众号API相关
 * 
 */

class Wechat_api_service extends MY_Service{
	
	
	
	protected $appId;
	
	protected $appSecret;
	
	protected $requestUrl = 'https://api.weixin.qq.com';//公众号接口请求地址
	
	protected $accessToken;
	protected $apiTicket;
	protected $noncestr;
	protected $sign;
	protected $timestamp;
	
	
	
	protected $templateMsg = array(
		'consumption_order_remind' => array( //消费订单提醒通知模板
			'template_id' 	=> '4v1efuHSzuP_Uc_Q_XLlYwo-VLi1Cu4DQEgwUr3bcAg', //对应的模板id 这个模板id需要到微信公众号后台获取
			'template_content' 	=> array(
				'first' => '消费提醒',
				'keyword1'	=> '2018-07-24 17:57:02', //订单时间
				'keyword2'	=> '门店名称', //门店名称
				'keyword3'  => '服务订单', //订单类型
				'keyword4'  => '100',//订单金额
				'remark'    => '点击查看订单详情'
			)
		), //模板消息
		'appointment_order_remind' => array( //预约订单提醒通知模板
			'template_id' 	=> 'l9VCIU2q--xaReKwWNwb-jqeYmDkMc6uNbEc22OiczA', //对应的模板id 这个模板id需要到微信公众号后台获取
			'template_content' 	=> array(
				'first' => '预约提醒',
				'keyword1'	=> '2018-07-2515:52:56', //预约时间
				'keyword2'	=> '门店名称', //预约门店
				'remark'    => '请您准时前往门店享受服务'
			)
		),
	);
	public function __construct(){
		parent::__construct();
		
		$this->appId = TMH_APP_ID;
		$this->appSecret = TMH_APP_SECRET;
		
		try {
			$this->accessToken = $this->getAccessToken();
			$this->apiTicket	   = $this->getTicket();
		}catch (Exception $e){
			exit($e->getMessage());
		}
		
		
		
		$this->noncestr = $this->createNoncestr();
		$this->timestamp = time();
		$this->sign = $this->createSign();
		
	}
	

	/**
		 * @desc   发送微信模板消息 
		 * @param  $openid 用户openid 
		 * @param  $url 点击详情跳转
		 * @param  $type 根据定义的不同的类型获取不同的模板进行发送
		 * @param  $msg_array = array(
		 * 			'first' => XX,  'keynote1' => xxx, 'keynote2'=>xxx,...'remark'=>xxx 第一个是头 最后一个是尾 
		 * 				
		 * 			) 发送给用户的模板消息
		 * @param $color 文字颜色
		 * @return 
		 * @author liujing<liukai5455@163.com>		
		 */
	public function sendTemplateMsg($openid, $url, $type, $msgArray, $color = '#173177'){
		
		if( !isset( $this->templateMsg[$type]) || !is_array($this->templateMsg[$type]['template_content']) || empty($this->templateMsg[$type]['template_content'])) {
			return   returnMsg('error_type');
		}
		
		if( empty($openid) ) {
			return returnMsg('error_openid');
		}	 
		
		if( !empty($url) && !is_url($url)){
			return returnMsg('error_url');
		}
		
		if( empty($msgArray) || !is_array($msgArray) || count($msgArray) !== count($this->templateMsg[$type]['template_content']) ){
			return returnMsg('error_msg_array');
		}
		
		$msg = array();
		foreach ($this->templateMsg[$type]['template_content'] as $key => $val){
			$msg[$key] = array(
				'value' => $msgArray[$key],
				'color' => $color	
			);
		}
		$data = array(
			'touser' 		=> $openid,
			'template_id'	=> $this->templateMsg[$type]['template_id'],
			'data' 			=>  $msg
		);
		
		if ( !empty($url) ) {
			$data['url'] = $url; 
		}
		
		$data = json_encode($data);
		//https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=ACCESS_TOKEN
		$urlFormat = '%scgi-bin/message/template/send?access_token=%s';
		$url 		= sprintf($urlFormat, $this->requestUrl, $this->accessToken);
		$responseJson = runCurl($url, $data );
		if(!$responseJson){
			return returnMsg('error_response');
		}
		$response = json_decode($responseJson, true);
		if($response['errcode'] === 0 && $response['errmsg'] === 'ok'){
			return returnMsg('success', $response);
		}
		return returnMsg('error_response', $response);
	}
	
	
	/**
		 * @desc   使用公众号openid获取用户基本信息
		 * @param 
		 * @return 
		 * @author liujing<liukai5455@163.com>		
		 */
	public function getUserinfoByOpenid($openId){
		
		//https://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN
		
		if(empty($openId)){
			return  returnMsg('error_openid');
		}
		$urlFormat = '%scgi-bin/user/info?access_token=%s&openid=%s&lang=zh_CN';
		$url 		= sprintf($urlFormat, $this->requestUrl, $this->accessToken, $openId);
		$responseJson = runCurl($url);
		if(!$responseJson){
			return returnMsg('error_response');
		}
		$response = json_decode($responseJson, true);
		if( isset($response['errcode']) || isset($response['errmsg']) ){
			return returnMsg('error_response', $response);
		}
		return returnMsg('success', $response);
	}
	
	
	/**
	     * 获取微信公众号jssdk的参数
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */

	public function getJssdkParams()
	{
		return  array ('msg' => 'success', 'data' => array(
				'appid' => $this->appId,
				'timestamp' => $this->timestamp,
				'nonceStr' => $this->noncestr,
				'signature' => $this->sign
		));
	}
	
	

	//获取access token
	protected function getAccessToken()
	{
	
		
		  $key = 'tmh_wechat_access_token';
	
		$this->load->driver('cache');
		$get = $this->cache->file->get($key);
		if ( !empty($get) && isset($get['expire_time']) && $get['expire_time'] > time()  )
		{
			return $get['access_token'];
		}
		
		$urlFormat = '%s/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';
		$url 		       = sprintf($urlFormat, $this->requestUrl, $this->appId, $this->appSecret);
		$response   = runCurl($url);
		if( !$response ) {
			throw new Exception('get token error');
		}
		$responseArray = json_decode($response, true);
		if( !$responseArray || !isset($responseArray['access_token']) || empty($responseArray['access_token']) ) {
			throw new Exception('get token error');
		}
		$data = array(
				'access_token' => $responseArray['access_token'],
				'expire_time' =>   ($responseArray['expires_in']-100)+time(), //过期的时间 提前100秒过期
		);
		$save = $this->cache->file->save($key, $data, 20 * 24 * 3600);
		
		return $responseArray['access_token'];
	}
	
	//获取jsapi ticket
	protected function getTicket()
	{
		
		$key = 'tmh_wechat_ticket';
		$this->load->driver('cache');
		$get = $this->cache->file->get($key);
		if ( !empty($get) && isset($get['expire_time']) && $get['expire_time'] > time()  )
		{
			return $get['ticket'];
		}
		
		$urlFormat = '%s/cgi-bin/ticket/getticket?access_token=%s&type=%s';
		$type 		   = 'jsapi';
		$url 		       = sprintf($urlFormat, $this->requestUrl, $this->accessToken, $type);
		$response   = runCurl($url);
	
		$response = request($url, array() );
		if( !$response ) {
			throw new Exception('get ticket error');
		}
		$responseArray = json_decode($response, true);
		if( !$responseArray || !isset($responseArray['ticket']) || empty($responseArray['ticket']) ) {
			throw new Exception('get ticket error');
		}
		$data = array(
				'ticket' => $responseArray['ticket'],
				'expire_time' =>   ($responseArray['expires_in']-100)+time(), //过期的时间 提前100秒过期
		);
		$this->cache->file->save($key, $data, 20 * 24 * 3600);
		return $responseArray['ticket'];
	}
	
	//生成签名
	protected function createSign()
	{
		$url  = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$param  = array(
				'noncestr'    => $this->noncestr,
				'jsapi_ticket' => $this->apiTicket,
				'timestamp' => $this->timestamp,
				'url'			   => $url
		);
		//步骤1. 对所有待签名参数按照字段名的ASCII 码从小到大排序（字典序）后， 使用URL键值对的格式（即key1=value1&key2=value2…）拼接成字符串string1：
		ksort($param);
		$signStr = $this->toUrlParams($param);
		//步骤2. 对string1进行sha1签名，得到signature：
		$sign = sha1($signStr);
		return $sign;
	}
	
	
	
	//生成随机字符串
	protected function createNoncestr()
	{
		$str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$num = 10;
		$nonceStr = '';
		for( $i = $num; $i > 0; $i--){
			$random = mt_rand(0, strlen($str)-1);
			$nonceStr .= $str[$random];
		}
		return $nonceStr;
	}
	
	protected function toUrlParams($data){
		$buff = "";
		foreach ($data as $k => $v)
		{
			if(strtolower($k) != "sign" && $v != "" && !is_array($v)){
				$buff .= strtolower($k) . "=" . $v . "&";
			}
		}
	
		$buff = trim($buff, "&");
		return $buff;
	}
	
}