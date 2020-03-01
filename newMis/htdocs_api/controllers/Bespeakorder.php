<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bespeakorder extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 展示预约单
     * @param  bid, role;
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function Bespeakorder(){
        $bid = $this->input->post_get('bid', true);//用户id
        $role = $this->input->post_get('role', true);//用户id
        $data = array();
        if(isset($bid) || isset($role)){

            $time=time();
            $this->load->service('order_service');
            $bespeakorder['bespeak'] = $this->order_service->bespeakList($bid,$time,$role);
            $bespeakorder['role'] = $role;

            if(!empty($bespeakorder['bespeak'])){

                $data['status'] = true;
                $data['msg'] = 'success';
                $data['data'] = $bespeakorder;
            }else{

                $data['status'] = false;
                $data['msg'] = '暂无预约信息';
                $data['data'] = array();
            }
        }else{

            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }

        exit(json_encode($data,true));
    }

    /**
     * 用户会员卡
     * @param  userid;
     * @return json;
     * @author rwk
     */
    public function getUserCard(){
        $userId = $this->input->post_get('userid', true);
        $data=array();
        if(isset($userId)) {
            $this->load->service('order_service');
            $cardsinfo = $this->order_service->mycards($userId);
            if (!empty($cardsinfo)) {
                $data['status'] = true;
                $data['msg'] = 'success';
                $data['data'] = $cardsinfo;
            } else {
                $data['status'] = false;
                $data['msg'] = '该客户暂无会员卡';
                $data['data'] = array();
            }
        } else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }

    /**
     * 预约单详情
     * @param  ordercode;
     * @return json;
     * @author rwk
     */
    public function bespeakInfo(){
        $order_code = $this->input->post_get('ordercode', true);
        if(isset($order_code)){
            $this->load->service('order_service');
            $bespeak['info'] = $this->order_service->getbespeakinfo($order_code);

            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $bespeak;
        } else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }

}