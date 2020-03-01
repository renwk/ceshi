<?php
class Coupon extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * index
     * @param  userid;
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function index(){
        $userid = $this->input->post_get('userid', true);

        if (isset($userid)) {
            $this->load->service('userdetail_service');
            $cardlist = $this->userdetail_service->mycoupon($userid);
            $time = strtotime('+3 days');//三天快到期
            $arr = array();
            $arr['on'] = array();
            $arr['use'] = array();
            $arr['expired'] = array();
            foreach ($cardlist['mycoupon_list'] as $kk => $vv) {

                if ($vv['state'] == "已发送/可用") {
                    $arr['on'][$kk]['couponname'] = $vv['couponname'];
                    $arr['on'][$kk]['money'] = $vv['money'];
                    $arr['on'][$kk]['expiratime'] = $vv['expiratime'];
                    $arr['on'][$kk]['addtime'] = $vv['addtime'];
                    $arr['on'][$kk]['usetime'] = $vv['usetime'];
                    $arr['on'][$kk]['order_code'] = $vv['order_code'];
                    $arr['on'][$kk]['sname'] = $vv['sname'];
                    if(strtotime($vv['expiratime'])<$time){
                        $arr['on'][$kk]['show'] = '1';
                    }else{
                        $arr['on'][$kk]['show'] = null;
                    }

                } else if ($vv['state'] == "已使用") {
                    $arr['use'][$kk]['couponname'] = $vv['couponname'];
                    $arr['use'][$kk]['money'] = $vv['money'];
                    $arr['use'][$kk]['expiratime'] = $vv['expiratime'];
                    $arr['use'][$kk]['addtime'] = $vv['addtime'];
                    $arr['use'][$kk]['usetime'] = $vv['usetime'];
                    $arr['use'][$kk]['order_code'] = $vv['order_code'];
                    $arr['use'][$kk]['sname'] = $vv['sname'];

                } else if ($vv['state'] == "已过期") {
                    $arr['expired'][$kk]['couponname'] = $vv['couponname'];
                    $arr['expired'][$kk]['money'] = $vv['money'];
                    $arr['expired'][$kk]['expiratime'] = $vv['expiratime'];
                    $arr['expired'][$kk]['addtime'] = $vv['addtime'];
                    $arr['expired'][$kk]['usetime'] = $vv['usetime'];
                    $arr['expired'][$kk]['order_code'] = $vv['order_code'];
                    $arr['expired'][$kk]['sname'] = $vv['sname'];

                }
            }
            foreach ($arr as $k=>$v){
                $arr['num'][$k] = count($v);
            }
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $arr;
        }else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }

        exit(json_encode($data,true));
    }

}