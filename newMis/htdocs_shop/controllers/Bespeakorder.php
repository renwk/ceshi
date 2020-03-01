<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bespeakorder extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    //用户会员卡
    public function getUserCard(){
        $userId = $this->input->post_get('user', true);
        $this->load->service('order_service');
        $cardsinfo = $this->order_service->mycards($userId);
        $str = "";
        if(!empty($cardsinfo)){
            foreach ($cardsinfo as $kk=>$vv){
                $str .="<tr><td>".$vv['card_type']."</td>";
                $str .="<td>".$vv['ucard_no']."</td>";
                $str .="<td>".$vv['money']."</td></tr>";
            }
        }else{
            $str .="<tr><td colspan='3'>该客户暂无会员卡</td></tr>";
        }

        $cards['data'] = $str;
        $cards['code']='200';
        echo json_encode($cards);
    }
    //我的预约
    public function getBespeak(){
        $role = $_GET['id'];
        $time=time();
        $bid = $this->user['iduu'];

        $this->load->service('order_service');
        $bespeakorder['bespeak'] = $this->order_service->bespeakList($bid,$time,$role);
        $bespeakorder['role'] = $role;

        $this->load->view('glob/header.php');
        $this->load->view('bespeakorder/bespeakorder', $bespeakorder);
        $this->load->view('glob/footer.php');

    }
    //预约单详情
    public function bespeakInfo(){
        $order_code = $_GET['id'];
        $role = $_GET['role'];
        $bid = $this->user['iduu'];

        $this->load->service('order_service');
        $bespeak['info'] = $this->order_service->getbespeakinfo($order_code,$bid);
        $bespeak['role'] = $role;
        $this->load->view('glob/header.php');
        $this->load->view('bespeakorder/bespeakinfo', $bespeak);
        $this->load->view('glob/footer.php');
    }

}