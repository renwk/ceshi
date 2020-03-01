<?php
class Index extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * index
     * @param  openid;
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function index(){
//        $openid = $_POST('openid');

        $openid = $this->input->post_get('openid');
        $headimgurl=$this->input->post_get('avatarUrl');
        $appdata['headimgurl'] = isset($headimgurl) ? $headimgurl : '';

        $nickname =$this->input->post_get('nickName');
        $appdata['nickname'] = isset($nickname) ? $nickname : '';

        $country = $this->input->post_get('country');
        $appdata['country']= isset($country) ? $country : '';

        $city = $this->input->post_get('city');
        $appdata['city']= isset($city) ? $city : '';

        $language = $this->input->post_get('language');
        $appdata['language']= isset($language) ? $language : '';

        $province = $this->input->post_get('province');
        $appdata['province']= isset($province) ? $province : '';

        $sex = $this->input->post_get('sex');
        $appdata['sex']= isset($sex) ? $sex : '';

        $appdata['openid'] = $openid;

        $data=array();
        if(isset($openid)){
            $this->load->service('user_service');
            $add = $this->user_service->upWechatByOpenid($appdata);

            $wechat = $this->user_service->oneWechatByOpenid($openid);
            if($wechat['msg'] == 'success'){
                if(!empty($wechat['data']['uid']) && !empty($wechat['data']['userid'])) {
                    $user = $this->user_service->one($wechat['data']['uid']);
                    $wechat['data']['balance'] = $user['data']['balance'];
                    $wechat['data']['cardNums'] = $user['data']['cardNums'];
                    $wechat['data']['couponNums'] = $user['data']['couponNums'];

                    $datas['code'] = 'success';
                    $data['status'] = true;
                    $data['msg'] = 'success';
                    $data['data'] = $wechat['data'];
                }else{
                    $data['status'] = false;
                    $data['msg'] = '未绑定手机号';
                    $data['data'] = array('code'=>'login');
                }
            }else if($wechat['msg'] == 'error_one') {

                $data['status'] = false;
                $data['msg'] = '未绑定手机号';
                $data['data'] = array('code'=>'login');
            }else{
                $data['status'] = false;
                $data['msg'] = '微信获取失败';
                $data['data'] = array('code'=>$wechat['msg']);
            }
        }else{
            $data['status'] = false;
            $data['msg'] = '微信获取失败';
            $data['data'] = array('code'=>'error_openid');
        }

        exit(json_encode($data,true));

    }

    /**
     * info
     * @param  userid;
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function info()
    {

            $openid = $this->input->post_get('openid');
            $uid = $this->input->post_get('uid');


        if(empty($openid)){
            $data['status'] = false;
            $data['msg'] = '微信获取失败';
            $data['data'] = array();
        }else{
            $this->load->service('user_service');
            $user = $this->user_service->one($uid);
            $wechat = $this->user_service->oneWechatByOpenid($openid);
            $info['user']=$user['data']['userinfo'];
            $info['wechat']=$wechat['data'];

            if(!empty($info)) {
                $data['status'] = true;
                $data['msg'] = 'success';
                $data['data'] = $info;
            }else{
                $data['status'] = false;
                $data['msg'] = '获取信息失败';
                $data['data'] = '';
            }
        }

        exit(json_encode($data,true));
    }
    public function readAgreement()
    {
        $openid = $this->input->post_get('openid');
        $this->load->service('user_service');
        $res = $this->user_service->readAgreement($openid);
        if(!empty($res)) {
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $res;
        }else{
            $data['status'] = false;
            $data['msg'] = '网络错误,请重试!';
            $data['data'] = '';
        }
        exit(json_encode($data,true));
    }

}