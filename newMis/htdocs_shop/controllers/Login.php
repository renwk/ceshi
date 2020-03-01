<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $wechat = array();
        $openid = $this->wechat['openidshop'];
        $this->load->service('user_service');
        $wechat = $this->user_service->oneShopWechatByOpenid($openid);
        $data['wechat'] = $wechat['data'];

        $info = $this->user_service->searchLogin($openid);
        if($info['msg']=='success'){
            redirect('index/index');
        }else{
            $this->load->view('glob/header.php');
            $this->load->view('login/login.php', $data);
            $this->load->view('glob/footer.php');
        }
    }

    public function actionGetVerifycode()
    {
        $mobile = $this->input->post('mobile', true);

        $this->load->service('user_service');

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
        $openid = $this->wechat['openidshop'];
        $this->load->service('user_service');
        $login = $this->user_service->shopLogin($mobile, $code,$openid);
        switch ($login['msg']) {
            case 'success':
                $bindResult = $this->user_service->shopWechatBindUser($openid, $login['data']['uid'], $login['data']['role'],$login['data']['mobile']);
                if( $bindResult['msg'] !== 'success' ) {
                    exit('登录失败，请重新尝试!！');
                }
//                exit('success');
                exit(json_encode(returnMsg('success')));
                break;
            case 'error_user_not_exists':
                exit(json_encode(returnMsg('手机号未注册')));
                break;
            case 'error_code':
                exit(json_encode(returnMsg('验证码错误')));
                break;
            case 'error_mobile':
                exit(json_encode(returnMsg('手机号错误')));
                break;
            case 'error_used':
                exit(json_encode(returnMsg('验证码已被使用，请重新获取')));
                break;
            case 'error_most_retry_times':
                exit(json_encode(returnMsg('验证码已失效，请重新获取')));
                break;
            case 'error_sms_one':
                exit(json_encode(returnMsg('未获取验证码，请先获取验证码')));
                break;
            case 'error_expire':
                exit(json_encode(returnMsg('验证码已过期，请重新获取')));
                break;
            default:
                exit(json_encode(returnMsg('网络错误，请稍后再试')));
                break;
        }

    }
}