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
        $login = $this->user_service->shopLogin($mobile, $code,null,$appopenid);
//        exit(json_encode( array('status'=>true,'msg'=> 'success','data' => $login['msg']) ,true));
//        p($login);die;
        switch ($login['msg']) {
            case 'success':
                if(!empty($login['data']['openid'])){//首次绑定
                    $bindResult = $this->user_service->appWechatBindUser($appopenid, $login['data']['uid'], $login['data']['role'],$login['data']['mobile'],'upd');
                    if( $bindResult['msg'] !== 'success' ) {
                        exit(json_encode( array('status'=>false,'msg'=> '登录失败,请重新尝试!!','data' => array()) ,true));
                    }
                }else if(!empty($login['data']['type'])){//重新绑定
                    $bindResult = $this->user_service->appWechatBindUser($appopenid, $login['data']['uid'], $login['data']['role'],$login['data']['mobile'],'updapp');
                    if( $bindResult['msg'] !== 'success' ) {
                        exit(json_encode( array('status'=>false,'msg'=> '登录失败,请重新尝试!!','data' => array()) ,true));
                    }
                }else{//首次登陆
                    $bindResult = $this->user_service->appWechatBindUser($appopenid, $login['data']['uid'], $login['data']['role'],$login['data']['mobile'],'add');
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
            $data['appid'] = 'wx5bd609d4ee123176';
            $data['secret'] = '20b2d6c371b4713e020619435fda8131';

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
    public function getaccess_token(){

        $this->load->service('user_service');
        $login = $this->user_service->getaccesstoken();
        $lasttime = time()-2*3600;

        if(empty($login)|| $login['create_time']<$lasttime){

            $data['appid'] = 'wx5bd609d4ee123176';
            $data['secret'] = '20b2d6c371b4713e020619435fda8131';
            $data['grant_type'] = 'client_credential';
            $res = json_decode(request("https://api.weixin.qq.com/cgi-bin/token", $data,30,true), true);
            if($res){
                $res['type']  = 0;
                $res['create_time'] = time();
            }
            $this->user_service->addAccessToken($res);
        }else{
            $res = $login;
        }
        $data1['status'] = true;
        $data1['msg'] = 'success';
        $data1['data'] = $res;
        exit(json_encode($data1,true));
    }
    public function getformid(){
        $formid = $this->input->post_get('formid');
        $openid = $this->input->post_get('openid');
        $this->load->service('user_service');
        $formdata = $this->user_service->getformid($openid);
        $lasttime = time()-86400*7;

        if(!empty($formid) && $formdata['send']==0) {
            if (empty($formdata) || $formdata['create_time'] < $lasttime) {
                $data['openid'] = $openid;
                $data['formid'] = $formid;
                $data['create_time'] = time();
                $data['send'] = 0;
                $this->user_service->addformid($data);

            } else {
                $data = $formdata;
            }
            $arr['status'] = true;
            $arr['msg'] = 'success';
            $arr['data'] = $data;
        }elseif($formdata['send'] ==1){
            $arr['status'] = false;
            $arr['msg'] = '生日快乐';
            $arr['data'] = array();
        }else{
            $arr['status'] = false;
            $arr['msg'] = '获取信息失败';
            $arr['data'] = array();
        }
        exit(json_encode($arr,true));
    }
    public function sent(){
        $id = $this->input->post_get('id');

        if(!empty($id)){
            $this->load->service('user_service');
            $res = $this->user_service->sent($id);
            $arr['status'] = true;
            $arr['msg'] = 'success';
            $arr['data'] = $res;
        }else{
            $arr['status'] = false;
            $arr['msg'] = '获取信息失败';
            $arr['data'] = array();
        }
        exit(json_encode($arr,true));
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