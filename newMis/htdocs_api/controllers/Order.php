<?php
class Order extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * orderlist
     * @param   {bid,role,} sid, userid, condition, type, stime, etime, ordertype, datetype;
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function orderList(){

        $bid1 = $this->input->post_get('bid', true);//用户id
        $bid1 = isset($bid1) ? $bid1 : 0;
        $sid = 0;
        $userid = 0;
        $role = 0;
        $bid = 0;
        $role1 = $this->input->post_get('role', true);//角色类型
        if(isset($role1)){
            if($role1=='beautician'||$role1=='consultant'){
                $role = $role1;
                $bid = $bid1;
            }else if($role1 == 'store'){
                $sid = $bid1;
            }else if($role1 == 'users'){
                $userid = $bid1;
            }else{
                $data['status'] = false;
                $data['msg'] = '数据错误1';
                $data['data'] = null;
                exit(json_encode($data,true));
            }
        }else{
            $data['role'] = 0;
            $data['status'] = false;
            $data['msg'] = '数据错误1';
            $data['data'] = null;
            exit(json_encode($data,true));
        }

        $condition = $this->input->post_get('condition', true);//条件
        $ordertype = $this->input->post_get('ordertype', true);//订单类型
        $o_notes  =  $this->input->post_get('onotes', true);//订单类型
        $datetype = $this->input->post_get('datetype', true);//日期类型
        if($datetype == '最近一周'){
            $stime = strtotime('-6 days');
            $etime = strtotime(date("Y-m-d"),time())+86400+28800;
        }elseif ($datetype =='今天'){
            $stime = strtotime(date("Y-m-d"),time())+28800;
            $etime = strtotime(date("Y-m-d"),time())+86400+28800;
        }elseif ($datetype =='本月'){
            $firstday = date('Y-m-01', time());
            $stime = strtotime($firstday)+28800;
            $etime = strtotime(date('Y-m-d', strtotime("$firstday +1 month -1 day")))+86400+28800;;
        }else{
            $stime= strtotime($this->input->post_get('stime', true))+28800;
            $etime= strtotime($this->input->post_get('etime', true))+28800;
        }

        $this->load->service('order_service');

        $orderlist = $this->order_service->orderList($bid,$stime,$role,$sid,$etime,$ordertype,$condition,$userid);

        if(!empty($orderlist['cashier'])) {

            foreach($orderlist['cashier'] as $k=>$v){
                $orderlist['cashier'][$k]['ordertimes']=date("Y-m-d H:i:s",$v['prestatus_time']);
                foreach ($v as $kk=>$vv){
                    if(empty($vv)){
                        $orderlist['cashier'][$k][$kk] = ' ';
                    }
                }
                if($o_notes == 1 && $v['onotes']== 1){
                    unset($orderlist['cashier'][$k]);
                }
            }

            $orders['cashier'] = $orderlist['cashier'];
        }else if(!empty($orderlist['charge'])) {

            foreach($orderlist['charge'] as $k=>$v){
                $orderlist['charge'][$k]['ordertimes']=date("Y-m-d H:i:s",$v['time_pay']);
                foreach ($v as $kk=>$vv){
                    if(empty($vv)){
                        $orderlist['charge'][$k][$kk] = ' ';
                    }
                }
            }
            $orders['charge'] = $orderlist['charge'];
        }else{
            $orders = '找不到订单内容';
        }
        $data['status'] = true;
        $data['msg'] = 'success';
        $data['data'] = $orders;
        exit(json_encode($data,true));
    }

    /**
     * 消费订单详情
     * @param  ordercode;
     * @return json;
     * @author rwk
     */
    public function cashierOrderDetail(){
        $order_code = $this->input->post_get('ordercode', true);
        if(isset($order_code)) {
            $this->load->service('order_service');
            $orderInfo = $this->order_service->orderInfo($order_code);
            $orderInfo['order_info']['ordertimes']= date("Y-m-d H:i:s",$orderInfo['order_info']['prestatus_time']);

            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $orderInfo;
        } else {

            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }

        exit(json_encode($data,true));
    }

    /**
     * 充值订单详情
     * @param  ordercode;
     * @return json;
     * @author rwk
     */
    public function chargeOrderDetail(){
        $order_code = $this->input->post_get('ordercode', true);
        if(isset($order_code)) {

            $this->load->service('order_service');
            $orderInfo= $this->order_service->chargeOrderInfo($order_code);
            $orderInfo['order_info']['ordertimes']= isset($orderInfo['order_info']['ucard_no'])?$orderInfo['order_info']['ucard_no']:'';
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $orderInfo;
        } else {

            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }

        exit(json_encode($data,true));
    }

}