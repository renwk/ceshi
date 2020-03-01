<?php
class Bespeak extends MY_Controller {

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
    public function getlist()
    {
        $uid = $this->input->post_get('uid');
        if(empty($uid)){
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }else {
            $time = time();
            $this->load->service('order_service');
            $info = $this->order_service->appointmentList($uid,$time);
            $list = $info['data'];
            if(!empty($list)){
                foreach ($list as $kk=>$vv){
                    $list[$kk]['p_time'] = date('Y-m-d H:i:s', $vv['prestatus_time']);
                    $list[$kk]['b_name'] = implode('、', array_column($vv['beautician'], 'nickname'));
                }
            }else{
                $list = null;
            }
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $list;
        }
        exit(json_encode($data,true));

    }

}