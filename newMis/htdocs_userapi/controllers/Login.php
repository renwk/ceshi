<?php
class Login extends MY_Controller
{

    public function __construct()
    {
        include_once "wxBizDataCrypt.php";
        parent::__construct();
    }

    public function actionGetVerifycode()//发送短信
    {
        $mobile = $this->input->post_get('mobile', true);

        $this->load->service('user_service');

        $this->load->service('sms_service');
        $checkExists = false;
        $sendResult = $this->sms_service->sendLoginMsg($mobile, $checkExists);

        switch ($sendResult['msg']) {
            case 'success':
                exit(json_encode( array('status'=>true,'msg'=> 'success','data' => 'success') ,true));
                break;
            case 'error_mobile':
                exit(json_encode( array('status'=>false,'msg'=> '手机号输入有误，请重新输入','data' => array()) ,true));
                break;
            case 'error_user_not_exists':
                exit(json_encode( array('status'=>false,'msg'=> '手机号不存在','data' => array()) ,true));
                break;
            case 'error_max_times':
                exit(json_encode( array('status'=>false,'msg'=> '发送次数超出限制','data' => array()) ,true));
                break;
            default:
                exit(json_encode( array('status'=>false,'msg'=> '网络错误，请稍后再试','data' => array()) ,true));
                break;
        }

    }

    public function login(){
        $appopenid = $this->input->post_get('appopenid');
        $mobile = $this->input->post_get('mobile');
        $code = $this->input->post_get('code');

        $this->load->service('user_service');
        $login = $this->user_service->login($mobile, $code,0,$appopenid);

        switch ($login['msg']) {
            case 'success':
                if(empty($login['data']['openid'])){
                    $bindResult = $this->user_service->wechatBindUser($appopenid,$login['data']['userid'], $login['data']['uuid']);
                    if( $bindResult['msg'] !== 'success' ) {
                        exit(json_encode( array('status'=>false,'msg'=> '登录失败,请重新尝试!!','data' => array()) ,true));
                    }
                }
                exit(json_encode( array('status'=>true,'msg'=> 'success','data' => "success") ,true));
                break;
            case 'error_user_not_exists':
                exit(json_encode( array('status'=>false,'msg'=> '手机号未注册','data' => array()) ,true));
                break;
            case 'error_code':
                exit(json_encode( array('status'=>false,'msg'=> '验证码错误','data' => array()) ,true));
                break;
            case 'error_mobile':
                exit(json_encode( array('status'=>false,'msg'=> '手机号错误','data' => array()) ,true));
                break;
            case 'error_not_invite_user':
                exit(json_encode( array('status'=>false,'msg'=> '抱歉，您不是邀请试用用户','data' => array()) ,true));
                break;
            case 'error_used':
                exit(json_encode( array('status'=>false,'msg'=> '验证码已被使用,请重新获取','data' => array()) ,true));
                break;
            case 'error_most_retry_times':
                exit(json_encode( array('status'=>false,'msg'=> '验证码已失效,请重新获取','data' => array()) ,true));
                break;
            case 'error_sms_one':
                exit(json_encode( array('status'=>false,'msg'=> '未获得验证码,请先获取验证码','data' => array()) ,true));
                break;
            case 'error_expire':
                exit(json_encode( array('status'=>false,'msg'=> '验证码已过期,请重新获取','data' => array()) ,true));
                break;
            default:
                exit(json_encode( array('status'=>false,'msg'=> '网络错误,请稍后重试','data' => array()) ,true));
                break;
        }


    }


    public function getWechartAppOpenid(){
        $code = $this->input->post_get('code');
        $data = $this->getUnionid($code,0,0);
        exit(json_encode( array('status'=>true,'msg'=> 'success','data' => $data) ,true));
    }
    /**
     * 获取用户unionid
     * @param $code
     * @param $encryptedData
     * @param $iv
     * @return mixed|string
     */
    public static function getUnionid($code,$encryptedData,$iv){
        if($code || $encryptedData || $iv) {
            $data['appid'] = 'wx3c035dd96f34dd5b';
            $data['secret'] = 'f578da21044447011111a4a9876088f0';

            $data['js_code'] = $code;
            $data['grant_type'] = 'authorization_code';
            //获取session_key
            $res = json_decode(request("https://api.weixin.qq.com/sns/jscode2session", $data,30,true), true);
//            if(!isset($apiData['errcode'])){
//                $sessionKey = json_decode($apiData)->session_key;
//                $pc = new WXBizDataCrypt($appid, $sessionKey);
//                $errCode = $pc->decryptData($encryptedData, $iv, $data );
//
//                if ($errCode == 0) {
//                    echo $data;
//                } else {
//                    print($errCode . "\n");
//                }
//            }
            return $res;
        }else{
            return $res['errcode']='参数错误';
        }
    }

    public function decryption(){
        $iv = $this->input->post_get('iv');
        $encryptedData = $this->input->post_get('encryptedData');
        $sessionKey = $this->input->post_get('sessionKey');
        $appid = 'wx300dfad01974a9e1';
        $pc = new WXBizDataCrypt($appid, $sessionKey);
        $errCode = $pc->decryptData($encryptedData, $iv, $data );

        if ($errCode == 0) {
            echo $data;
        } else {
            print($errCode . "\n");
        }
    }
}