<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class orderlist extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index(){

        $data['role'] = isset($_GET['id'])?$_GET['id']:0;
        $data['userid'] = isset($_GET['uid'])?$_GET['uid']:0;
        $this->load->view('orderlist/orderlist.php',$data);
    }
    /**
     * 我的订单
     * @param
     * @return json
     * @author rwk
     */
    public function orderList(){
        $role = $this->input->post_get('role', true);
        $userid = $this->input->post_get('userid', true);
        $condition = $this->input->post_get('condition', true);//条件
        $ordertype = $this->input->post_get('type', true);
        $stime= strtotime($this->input->post_get('stime', true))+28800;
        $etime= strtotime($this->input->post_get('etime', true))+28800;
        $datetype = $this->input->post_get('time', true);
        if($datetype == '最近一周'){
            $stime = strtotime('-6 days');
            $etime = strtotime(date("Y-m-d"),time())+86400+28800;
        }elseif ($datetype =='今天'){
            $stime = strtotime(date("Y-m-d"),time())+28800;
            $etime = strtotime(date("Y-m-d"),time())+86400+28800;
        }

//        $stime=mktime(8,0,0,date('m'),date('d'),date('Y'));
        $openid = $this->wechat['openidshop'];
        $bid = $this->user['iduu'];

        $this->load->service('user_service');
        $employee = $this->user_service->getInfo($openid,'order');
        $this->load->service('order_service');
        $orderlist = $this->order_service->orderList($bid,$stime,$role,$employee['info']['sid'],$etime,$ordertype,$condition,$userid);
        $html = "";
        if(!empty($orderlist['cashier'])) {
            foreach ($orderlist['cashier'] as $key => $val) {
                $order_code = $val['order_code'];
                $html .= "<div class='reservation_box' onclick='local(\"{$order_code}\")' ><dl>";
                $html .= $this->mktable($key, $val, 'cashier');
                $html .= "</dl></div>";
            }
        }else if(!empty($orderlist['charge'])) {
                foreach ($orderlist['charge'] as $kk => $vv) {
                    $order_code = $vv['oid'];
                    $html.= "<div class='reservation_box' onclick='local(\"{$order_code}\")'><dl>";
                    $html.= $this->mktable($kk,$vv,'charge');
                    $html.="</dl></div>";
                }
        }else{
            $html .="<div class='nothing_box' style='margin-top:65px;text-align: center;'><div><img src='". __PUBLIC__.'img/nothing.png'."'></div>
<div class='nothing_txt' style='margin-top:70px;font-size:18px;color: #333;'>找不到订单内容</div></div>";
        }

        echo json_encode(returnMsg('success',$html));
    }
    public function mktable($k,$data,$type){
        $html='';
        if($type == 'cashier') {
            $html .= '<dt>手机号：' . $data['phone'] . '<i class="tag_add_icon"></i><span>姓名：' . $data['name'] . '</span></dt>';
            $html .= '<dd><span>开始时间</span>' . date('Y-m-d H:i:s', $data['prestatus_time']) . '</dd>';
            $html .= '<dd><span>订单编号</span>' . $data['order_code'] . '</dd>';
            $html .= '<dd><span>顾问</span>' . $data['adviser'] . '</dd>';
            $html .= '<dd><span>理疗师</span>' . $data['beautician'] . '</dd>';
            $html .= '<dd><span>房间</span>' . $data['s_name'] . '</dd>';
            $html .= '<dd><span>状态</span>' . $data['state'] . '</dd>';
            $html .= '<dd><span>状态</span>' . $data['state'] . '</dd>';
//            $html .= '<input type="hidden" name = "local" value="'.base_url('orderlist/orderInfo').'?id='.$data['order_code'].'">';

        }elseif ($type =='charge'){
            $html .= '<dt>手机号：' . $data['mobile'] . '<i class="tag_add_icon"></i><span>姓名：' . $data['name'] . '</span></dt>';
            $html .= '<dd><span>订单编号</span>' . $data['oid'] . '</dd>';
            $html .= '<dd><span>会员卡号</span>' . $data['ucard_no'] . '</dd>';
            $html .= '<dd><span>会员卡名称</span>' . $data['cardname'] . '</dd>';
            $html .= '<dd><span>充值金额</span>' . $data['money_true'] . '</dd>';
            $html .= '<dd><span>订单时间</span>' . date('Y-m-d H:i:s', $data['time_pay']) . '</dd>';
        }
        return $html;
    }

    public function cashierOrderDetail(){
        $order_code = $_GET['id'];
        $this->load->service('order_service');
        $orderInfo= $this->order_service->orderInfo($order_code);
        $this->load->view('orderlist/orderService.php', $orderInfo);
    }
    public function chargeOrderDetail(){
        $order_code = $_GET['id'];
        $this->load->service('order_service');
        $orderInfo= $this->order_service->chargeOrderInfo($order_code);
        $this->load->view('orderlist/orderRecharge.php', $orderInfo);
    }


}