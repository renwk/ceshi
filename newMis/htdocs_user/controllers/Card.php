<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Card extends MY_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index()
    {
    	$this->load->service('card_service');
    	$card = $this->card_service->lsMy($this->user['uuid'], 'all', 'balance');

    	$data = array();
    	$data['card'] = $card['data'];
    	
        $this->load->view('glob/header.php');
        $this->load->view('card/index.php', $data);
        $this->load->view('glob/footer.php');
    }

    public function getList()
    {
    	
    	$state = $this->input->post('state', true);
    	
    	$this->load->service('card_service');
    	$card = $this->card_service->lsMy($this->user['uuid'], $state, 'balance');

    	$data = array();
    	$data['card'] = $card['data'];
    	
    	$this->load->view('card/list.php', $data);
    }
    
    public function cardInfo()
    {
    	
    	$mycardid = $this->input->post('id', true);
    	$this->load->service('card_service');
    	
    	$card = $this->card_service->one($this->user['uuid'], $mycardid);

    	if( $card['msg'] !== 'success' || empty($card['data']) ) {
    		exit('error_card');
    	}
    	
    	$data = array();
    	$data['card'] = $card['data'];
    	
    	$this->load->view('card/cardinfo.php', $data);
    	
    }
    
    
    public function actionGiveIb()
    {
    	$array = $this->input->post('give_info', true);
    	$mycardid = $this->input->post('mycardid', true);
    	//传过来的是json字符串
    	$giveInfo = json_decode($array, true );
    	
    	$this->load->service('card_service');
    	$result = $this->card_service->transactionGiveIb($this->user['uuid'], $mycardid, $giveInfo);
    	
    	switch ($result['msg']) {
    		case 'success':
    			$response = array('msg' => 'success', 'give_id' => $result['data']['give_id']);
    			break;
    	    case 'error_mobile':
    	    	$response = array('msg' => '手机号码填写有误，请重新填写');
    			break;
    		case 'error_ib':
    			$response = array('msg' => '爱币金额填写有误，请重新填写');
    			break;
    		case 'error_balance_not_enough':
    			$response = array('msg' => '卡内余额不足');
    			break;
    		default:
    			$response = array('msg' => '网络链接错误，请稍后再试');
    			break;
    	}
    	
    	exit(json_encode($response));
    }
    
    public function giveIbInfo($giveId)
    {
    	
    	$data = array();
    	 
    	$this->load->service('card_service');
    	$info = $this->card_service->giveIbInfo($this->user['uuid'], $giveId);
    	
    	$this->load->service('wechat_api_service');
    	$param = $this->wechat_api_service->getJssdkParams();
    	
    	$data['info'] = $info['data']['give_info'];
    	$data['give'] = $info['data']['give'];
    	$data['jsSdkParams'] = $param['data'];
    	
    	$this->load->view('glob/header.php');
    	$this->load->view('card/giveIbInfo.php', $data);
    	$this->load->view('glob/footer.php');
    	
    }
    
    public function acceptIb($giveId)
    {
    	
    	$this->load->service('card_service');
    	$give = $this->card_service->oneGiveIb($giveId);
    	
    	$data = array();
    	
    	$openid = $this->wechat['openid'];
    	
    	$this->load->view('glob/header.php');
    	
    	if( $give['msg'] !== 'success' || empty($give['data']) || $give['data']['give']['state'] !== 'open' ) {
    		$this->load->view('card/acceptIbClosed.php', $data);
    	} else{
    		//赠与信息以及赠与者
    		$data['give'] = $give['data']['give'];
    		$data['sendWechat'] = $give['data']['give_wechat'];
    		//接收者
    		$this->load->service('user_service');
    		$wechat = $this->user_service->oneWechatByOpenid($openid);
    		
    		$data['wechat'] = $wechat['data'];
    		
    		if( empty( $wechat['data']['uid'] ) ) {
    			$this->load->view('card/acceptIbNoMobile.php', $data);
    		}else{
    			//接收者相关信息手机号等
    			$user = $this->user_service->one($wechat['data']['uid']);
    			
    			$this->load->service('card_service');
    			$giveId = $give['data']['give']['id'];
    			$acceptMobile = $user['data']['userinfo']['mobile'];
    			//查询该手机号是否有赠与的爱币
    			$oneGiveinfo = $this->card_service->oneGiveinfoByGiveidAndAcceptmobile($giveId, $acceptMobile);
    			
    			$data['user'] 			= $user['data'];
    			$data['giveInfo']       = $oneGiveinfo['data'];
    			//已领取 或者过期
    			if( !empty($oneGiveinfo['data']) && $oneGiveinfo['data']['state'] !== 'init' ) {
    				$this->load->view('card/acceptIbClosed.php', $data);
    			}else{
    				$this->load->view('card/acceptIb.php', $data);
    			}
    			
    		}
    	}
    	$this->load->view('glob/footer.php');
    	
    }
    
    public function actionGetIb()
    {
    	$giveId = $this->input->post('give_id', true);
    	$this->load->service('card_service');
    	$getIb = $this->card_service->transactionGetIb($this->user['uuid'], $giveId);
    	switch ($getIb['msg']) {
    		case 'success':
    			exit('success');
    			break;
    		case 'error_giveinfo':
    			exit('没有可领取的爱币');
    			break;
    		case 'error_giveinfo_state':
				exit('没有可领取的爱币');
    			break;
    		case 'error_give_state':
    			exit('没有可领取的爱币');
    			break;
    		default:
    			exit('网络链接错误，请稍后再试');
    	}
    }
    
    
    public function actionGetIbSendCode(){
    	
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
    		case 'error_max_times':
    			exit('发送次数超出限制');
    			break;
    		default:
    			exit('网络错误，请稍后再试');
    			break;
    	}
    	
    }
    
    
    public function actionBindMobileAndGetIb()
    {
    	$mobile = $this->input->post('mobile', true);
    	$code    = $this->input->post('code', true);
    	$giveId = $this->input->post('give_id', true);
    	
    	$this->load->service('user_service');
    	$login = $this->user_service->login($mobile, $code);
    	
    	switch ($login['msg']) {
    		case 'success':
    			$bindResult = $this->user_service->wechatBindUser($this->wechat['openid'], $login['data']['userid'], $login['data']['uuid']);
    			if( $bindResult['msg'] !== 'success' ) {
    				exit('领取失败，请重新尝试！');
    			}else{
    				$this->load->service('card_service');
    				$getIb = $this->card_service->transactionGetIb($login['data']['uuid'], $giveId);
    				switch ($getIb['msg']) {
    					case 'success':
    						exit('success');
    						break;
    					case 'error_giveinfo':
    						exit('没有可领取的爱币');
    						break;
    					case 'error_giveinfo_state':
    						exit('没有可领取的爱币');
    						break;
    					case 'error_give_state':
    						exit('没有可领取的爱币');
    						break;
    					default:
    						exit('网络链接错误，请稍后再试');
    				}
    			}
    			break;
    		case 'error_create_user':
    			exit('领取失败，请重新尝试！');
    			break;
    		case 'error_code':
    			exit('验证码错误');
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