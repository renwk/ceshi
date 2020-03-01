<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usercard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    public function cardList(){
        $role = $_GET['id'];
        $type = empty($_GET['type'])? 0 : $_GET['type'];
//        $time=mktime(8,0,0,date('m'),1,date('Y'));
        $openid = $this->wechat['openidshop'];
        $bid = $this->user['iduu'];
        $this->load->service('user_service');
        $storelist['info'] = $this->user_service->getInfo($openid,$role);
        $this->load->service('userdetail_service');
        $storelist['list'] = $this->userdetail_service->storelist();
        $storelist['type'] = $type;
        $this->load->view('glob/header.php');
        $this->load->view('usercard/myMember', $storelist);
        $this->load->view('glob/footer.php');
    }

    public function userlist(){
        $type = $this->input->post_get('type', true);
        $store = $this->input->post_get('store', true);
        $search = $this->input->post_get('search', true);
        $bid = $this->user['iduu'];

        $this->load->service('userdetail_service');
        if($type == 'list'){
            $userlist = $this->userdetail_service->userlist('0',$store,$search);
        }else{
            $userlist = $this->userdetail_service->userlist($bid,$store,$search);
        }
        $html = "";
        if(!empty($userlist)>0) {
            foreach ($userlist as $key => $val) {
                $html.= "<tr>";
                $html.= $this->mktable($key,$val);
                $html.="</tr>";
            }
        }
        echo json_encode(returnMsg('success',$html));
    }
    public function mktable($key,$val){
        $html ="";
        $html .= "<td><a href='tel:".$val['mobile']."'>".$val['mobile']."</a></td>";
        $html .="<td onclick='local(\"{$val['userid']}\")'>".$val['name']."</td>";
        $html .="<td onclick='local(\"{$val['userid']}\")'>";
        if($val['state'] == 0){
            $html .= "正常";
        }else if($val['state'] == 1){
            $html .= "锁定";
        }else{
            $html .= "失效";
        }
        $html .= "</td>";
        return $html;
    }

    public function userDetail(){
        $userid = $_GET['id'];
        $this->load->service('userdetail_service');
        $userlist = $this->userdetail_service->detail($userid);

        $this->load->view('glob/header.php');
        $this->load->view('usercard/memberDetail', $userlist);
        $this->load->view('glob/footer.php');
    }


    public function usercardInfo(){//储值卡
        $userid = $_GET['id'];
        $this->load->service('userdetail_service');
        //卡列表
        $cardlist = $this->userdetail_service->ucardInfo($userid);

        $this->load->view('glob/header.php');
        $this->load->view('usercard/cardStored', $cardlist);
        $this->load->view('glob/footer.php');

    }

    public function titleCard(){//资格卡
        $userid = $_GET['id'];
        $this->load->service('userdetail_service');
        $cardlist = $this->userdetail_service->titleCard($userid);
        if(!empty($cardlist['ucard_list'])) {
            $cardInfo = $this->userdetail_service->requestMycourse($cardlist['ucard_list'][0]['mycardid']);
        }else{
            $cardInfo['mycourse_info'] = array();
        }
        $this->load->view('glob/header.php');
        $this->load->view('usercard/cardPower', $cardInfo);
        $this->load->view('glob/footer.php');
    }

    public function requestMycardinfo(){//卡详情
        $mycardid = $this->input->post_get('card', true);
        $this->load->service('userdetail_service');
        $cardInfo = $this->userdetail_service->requestMycardinfo($mycardid);
        $html = "";
        if(!empty($cardInfo['mycard_log'] )){
            foreach ($cardInfo['mycard_log']  as $key =>$val){
                $html.= $this->showtable($key,$val,'cashier');
            }
        }
        $cardInfo['showtable'] = $html;

        echo json_encode(returnMsg('success',$cardInfo));
    }
    public function showtable($key,$data){
        $html='';
        $html.="<tr><td>".$data['sname']."</td>";
        $html.="<td>".date('Y-m-d',$data['costime'])."<br>".date('H:i:s',$data['costime'])."</td>";
        $html.="<td>".$data['oldbalance']."</td>";
        $html.="<td>".$data['costmoney']."</td>";
        $html.="<td>".$data['newbalance']."</td></tr>";
        return $html;
    }

    public function mycourse(){//疗程常规金
        $userid = $_GET['id'];
        $this->load->service('userdetail_service');
        $cardlist = $this->userdetail_service->mycourse($userid);

        $this->load->view('glob/header.php');
        $this->load->view('usercard/cardNostorage', $cardlist);
        $this->load->view('glob/footer.php');
    }
    public function requestMycourse(){
        $mycardid = $this->input->post_get('card', true);
        $this->load->service('userdetail_service');
        $cardInfo = $this->userdetail_service->requestMycourse($mycardid);

        $html = "";
        if(!empty($cardInfo['mycourse_log'] )){
            foreach ($cardInfo['mycourse_log']  as $key =>$data){
                $html.="<tr><td>".$data['sname']."</td>";
                $html.="<td>".date('Y-m-d',$data['costime'])."<br>".date('H:i:s',$data['costime'])."</td>";
                $html.="<td>".$data['oldnum']."</td>";
                $html.="<td>".$data['costnum']."</td>";
                $html.="<td>".$data['newnum']."</td></tr>";
            }
        }
        $cardInfo['showtable'] = $html;
        echo json_encode(returnMsg('success',$cardInfo));
    }

    public function giveInfo(){
        $userid = $_GET['id'];
        $this->load->service('userdetail_service');
        $cardlist = $this->userdetail_service->giveInfo($userid);
        $data = array();
        $data['on'] = array();
        $data['use'] = array();
        $data['expired']=array();
        $time = time();
        foreach ($cardlist['give_info'] as $kk=>$vv){

            if($vv['status'] == "未使用"){
                if($vv['long'] >=$time){
                    $data['on'][$kk]['sname'] = $vv['sname'];
                    $data['on'][$kk]['nickname'] = $vv['nickname'];
                    $data['on'][$kk]['gtime'] = $vv['gtime'];
                    $data['on'][$kk]['long'] = $vv['long'];
                    $data['on'][$kk]['count'] = $vv['count'];
                    $data['on'][$kk]['status'] = $vv['status'];
                    $data['on'][$kk]['service_name'] = $vv['service_name'];
                    $data['on'][$kk]['time'] = $vv['time'];
                    $data['on'][$kk]['price'] = $vv['price'];
                }else{
                    $data['expired'][$kk]['sname'] = $vv['sname'];
                    $data['expired'][$kk]['nickname'] = $vv['nickname'];
                    $data['expired'][$kk]['gtime'] = $vv['gtime'];
                    $data['expired'][$kk]['long'] = $vv['long'];
                    $data['expired'][$kk]['count'] = $vv['count'];
                    $data['expired'][$kk]['status'] = $vv['status'];
                    $data['expired'][$kk]['service_name'] = $vv['service_name'];
                    $data['expired'][$kk]['time'] = $vv['time'];
                    $data['expired'][$kk]['price'] = $vv['price'];
                }

            }else if ($vv['status'] == "已使用"){
                $data['use'][$kk]['sname'] = $vv['sname'];
                $data['use'][$kk]['nickname'] = $vv['nickname'];
                $data['use'][$kk]['gtime'] = $vv['gtime'];
                $data['use'][$kk]['long'] = $vv['long'];
                $data['use'][$kk]['count'] = $vv['count'];
                $data['use'][$kk]['status'] = $vv['status'];
                $data['use'][$kk]['service_name'] = $vv['service_name'];
                $data['use'][$kk]['time'] = $vv['time'];
                $data['use'][$kk]['price'] = $vv['price'];

            }
        }

        $this->load->view('glob/header.php');
        $this->load->view('usercard/cardSpecial', $data);
        $this->load->view('glob/footer.php');
    }
    public function mycoupon(){
        $userid = $_GET['id'];
        $this->load->service('userdetail_service');
        $cardlist = $this->userdetail_service->mycoupon($userid);
        $data = array();
        $data['on'] = array();
        $data['use'] = array();
        $data['expired']=array();
        foreach ($cardlist['mycoupon_list'] as $kk=>$vv){

            if($vv['state'] == "已发送/可用"){
                $data['on'][$kk]['couponname'] = $vv['couponname'];
                $data['on'][$kk]['money'] = $vv['money'];
                $data['on'][$kk]['expiratime'] = $vv['expiratime'];
                $data['on'][$kk]['addtime'] = $vv['addtime'];
                $data['on'][$kk]['usetime'] = $vv['usetime'];
                $data['on'][$kk]['order_code'] = $vv['order_code'];
                $data['on'][$kk]['sname'] = $vv['sname'];

            }else if ($vv['state'] == "已使用"){
                $data['use'][$kk]['couponname'] = $vv['couponname'];
                $data['use'][$kk]['money'] = $vv['money'];
                $data['use'][$kk]['expiratime'] = $vv['expiratime'];
                $data['use'][$kk]['addtime'] = $vv['addtime'];
                $data['use'][$kk]['usetime'] = $vv['usetime'];
                $data['use'][$kk]['order_code'] = $vv['order_code'];
                $data['use'][$kk]['sname'] = $vv['sname'];

            }else if ($vv['state'] == "已过期"){
                $data['expired'][$kk]['couponname'] = $vv['couponname'];
                $data['expired'][$kk]['money'] = $vv['money'];
                $data['expired'][$kk]['expiratime'] = $vv['expiratime'];
                $data['expired'][$kk]['addtime'] = $vv['addtime'];
                $data['expired'][$kk]['usetime'] = $vv['usetime'];
                $data['expired'][$kk]['order_code'] = $vv['order_code'];
                $data['expired'][$kk]['sname'] = $vv['sname'];

            }
        }


        $this->load->view('glob/header.php');
        $this->load->view('usercard/cardCoupon', $data);
        $this->load->view('glob/footer.php');
    }

    public function mytaginfo(){
        $userid = $_GET['id'];
        $bid = $this->user['iduu'];
        $this->load->service('userdetail_service');

        $data['usertag'] = $this->userdetail_service->myTag($userid);
        $data['user'] = $this->userdetail_service->mysummary($userid);
        $data['usercontent'] = $this->userdetail_service->myContent($userid);
        $data['comment'] = $this->userdetail_service->userComment($userid);
        $data['bid'] = $bid;

        $this->load->view('glob/header.php');
        $this->load->view('usercard/SummaryNotes', $data);
        $this->load->view('glob/footer.php');
    }
    public function gettag(){

        $search = $this->input->post_get('search', true);
        $this->load->service('userdetail_service');
        $tag = $this->userdetail_service->gettag($search);

        $tag_type = $this->userdetail_service->getTagType();

        foreach ($tag_type as $k=>$v){

            foreach ($tag as $kk=>$vv){
                if($vv['tag_type'] == $v['config_value']){
                    $tag_type[$k]['tag'][] = $vv;
                }
            }

        }
        $html = $this->mkul($tag,$tag_type);
        echo json_encode(returnMsg('success',$html));

    }
    public function mkul($tag,$tag_type){
        $html = "";
        $html .= "<div class='menu'><ul id='tag_menu_list'>";
        $html .= "<li class='curr'><a>全部</a></li>";
        foreach ($tag_type as $k=>$v){
            $html .= "<li><a>".$v['config_description']."</a></li>";
        }
        $html .= "</ul>";
        $html .= "</div>";
        $html.="<div class='main' id='tag_main'>";
        $html.="<div class='con' style='display: block;'>";
        foreach ($tag as $kk=>$vv){
            $html.="<a code='".$vv['tag_code']."'>".$vv['tag_name']."</a>";
        }
        $html.="</div>";
        foreach ($tag_type as $k =>$v) {
            $html .= "<div class='con' style='display: none;'>";
            if(!empty($v['tag'])){
                foreach ($v['tag'] as $kk => $vv){
                    $html .= "<a code='".$vv['tag_code']."'>".$vv['tag_name']."</a>";
                }
            }
            $html.="</div>";
        }
        $html.="</div>";

        return $html;

    }

    public function delTag(){
        $userid = $this->input->post_get('id', true);
        $tagcode = $this->input->post_get('tagcode', true);
        $bid = $this->user['iduu'];
        $this->load->service('userdetail_service');
        $deltag = $this->userdetail_service->delTag($userid,$tagcode,$bid);
        if($deltag ==1){
            echo json_encode(returnMsg('success',$deltag));
        }else{
            echo json_encode(returnMsg('false',"删除失败"));
        }
    }

    public function upremark(){
        $userid = $this->input->post_get('id', true);
        $newremark = $this->input->post_get('newremark', true);
        $this->load->service('userdetail_service');
        $upremark = $this->userdetail_service->upremark($userid,$newremark);
        if($upremark == 1){
            echo json_encode(returnMsg('success',$newremark));
        }else{
            echo json_encode(returnMsg('false',"修改失败"));
        }
    }
    public function upContent(){
        $id = $this->input->post_get('id', true);
        $content = $this->input->post_get('content', true);
        $this->load->service('userdetail_service');
        $upContent = $this->userdetail_service->upContent($id,$content);
        if($upContent == 1){
            echo json_encode(returnMsg('success',$upContent));
        }else{
            echo json_encode(returnMsg('false',"修改失败"));
        }
    }

    public function addtag(){
        $userid = $this->input->post_get('id', true);
        $type = $this->input->post_get('type', true);
        $content = $this->input->post_get('content', true);
        $tagcode = $this->input->post_get('tagcode', true);
        $bid = $this->user['iduu'];
        $data['uid'] = $bid;
        $data['employeeid'] = $bid;
        $data['tag_code'] = $tagcode;
        $data['content'] = $content;
        $data['userid'] = $userid;
        if($type == 'code'){
            $data['mode'] = 0;//仅添加标签
        }else{
            $data['mode'] = 1;//仅添加日志
        }
        $data['type'] = 0;
        $this->load->service('userdetail_service');
        if($data['tag_code']!=null || $data['content']!=null){
            $addtag = $this->userdetail_service->addtag($data);
        }else{
            $addtag = 1; //空数据
        }
        if($addtag == 1){
            echo json_encode(returnMsg('success',$addtag));
        }else{
            echo json_encode(returnMsg('false',"添加失败"));
        }

    }

}