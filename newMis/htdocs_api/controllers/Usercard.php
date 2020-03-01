<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usercard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * userlist 用户列表
     * @param bid, sname, search, type
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function userlist()
    {
        $bid = $this->input->post_get('bid', true);
        $store = $this->input->post_get('sname', true);//门店名称
        $search = $this->input->post_get('search', true);
        $type = $this->input->post_get('type', true);

        if($type != 'list'){
            if(empty($bid)){
                $data['status'] = false;
                $data['msg'] = '获取登录信息失败';
                $data['data'] = array();
                exit(json_encode($data,true));
            }
        }

        if(isset($store)) {
            $this->load->service('userdetail_service');
            if ($type == 'list') {//所有会员
                $userlist = $this->userdetail_service->userlist('0', $store, $search);
            } else { //我的会员
                $userlist = $this->userdetail_service->userlist($bid, $store, $search);
            }

            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $userlist;
        }else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }

        exit(json_encode($data,true));
    }
    public function storelist(){
        $this->load->service('userdetail_service');
        $storelist = $this->userdetail_service->storelist();
        $data['status'] = true;
        $data['msg'] = 'success';
        $data['data'] = $storelist;
        exit(json_encode($data,true));
    }
    /**
     * userDetail
     * @param  用户详情
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function userDetail()
    {
        $userid = $this->input->post_get('userid', true);
        if(isset($userid)){
            $this->load->service('userdetail_service');
            $userinfo = $this->userdetail_service->detail($userid);
            $userinfo['registtime']=date("Y-m-d",$userinfo['registtime']);
            foreach($userinfo as $k=>$v){
                if(empty($v)){
                    $userinfo[$k]='';
                }
            }
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $userinfo;

        }else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }

    public function usercardInfo(){//储值卡
        $userid = $this->input->post_get('userid', true);
        if(isset($userid)){
            $this->load->service('userdetail_service');
            //卡列表
            $cardlist = $this->userdetail_service->ucardInfo($userid,'api');
            if(!empty($cardlist)){
                foreach ($cardlist as $kk => $vv) {
                    $list[$kk]['id']=$kk;
                    $list[$kk]['mycardid']=$vv['mycardid'];
                    $list[$kk]['label'] = $vv['ucard_no'] . "(" . $vv['cardname'] . ")";
                }
            }else{
                $list = '';
            }
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $list;

        }else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }
        exit(json_encode($data,true));

    }
    public function requestMycardinfo(){
        $mycardid = $this->input->get_post('card', true);
        if(isset($mycardid)) {
            $this->load->service('userdetail_service');
            $cardInfo = $this->userdetail_service->requestMycardinfo($mycardid);
            foreach ($cardInfo['mycard_info'] as $k=>$v){
                if(empty($v)){
                    $cardInfo['mycard_info'][$k] = '';
                }
            }
            foreach ($cardInfo['mycard_log'] as $kk=>$vv){
                if(!empty($vv)){
                    $cardInfo['mycard_log'][$kk]['ctime'] = date('Y-m-d H:i:s',$vv['costime']);
                }
            }
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $cardInfo;

        }else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }

    public function mycourse(){//疗程常规金
        $userid = $this->input->post_get('userid', true);
        if(isset($userid)){
            $this->load->service('userdetail_service');
            $cardlist = $this->userdetail_service->mycourse($userid,'api');
            if(!empty($cardlist)){
                foreach ($cardlist as $kk => $vv) {
                    $list[$kk]['id']=$kk;
                    $list[$kk]['mycardid']=$vv['mycardid'];
                    $list[$kk]['label'] = $vv['ucard_no'] . "(" . $vv['cardname'] . ")";
                }
            }else{
                $list = '';
            }
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $list;

        }else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }
    public function requestMycourse(){
        $mycardid = $this->input->post_get('card', true);

        if(isset($mycardid)) {
            $this->load->service('userdetail_service');
            $cardInfo = $this->userdetail_service->requestMycourse($mycardid);
            foreach ($cardInfo['mycourse_info'] as $k=>$v){
                if(empty($v)){
                    $cardInfo['mycourse_info'][$k] = '';
                }
            }
            foreach ($cardInfo['mycourse_log'] as $kk=>$vv){
                if(!empty($vv)){
                    $cardInfo['mycourse_log'][$kk]['ctime'] = date('Y-m-d H:i:s',$vv['costime']);
                }
            }
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $cardInfo;
        }else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }

    public function titleCard(){//资格卡
        $userid = $this->input->post_get('userid', true);
        if(isset($userid)){
            $this->load->service('userdetail_service');
            $cardlist = $this->userdetail_service->titleCard($userid);
            if(!empty($cardlist['ucard_list'])) {
                $cardInfo = $this->userdetail_service->requestMycourse($cardlist['ucard_list'][0]['mycardid']);
                if(!empty($cardInfo['mycourse_info'])){
                    foreach ($cardInfo['mycourse_info'] as $k=>$v){
                        if(empty($v)){
                            $cardInfo['mycourse_info'][$k] = '';
                        }
                    }
                }
                $data['status'] = true;
                $data['msg'] = 'success';
                $data['data'] = $cardInfo;
            }else{
                $data['status'] = false;
                $data['msg'] = '该用户暂无资格卡';
                $data['data'] = array();
            }
        }else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }

    public function giveInfo(){//特殊礼遇
        $userid = $this->input->post_get('userid', true);

        if(isset($userid)) {
            $this->load->service('userdetail_service');
            $cardlist = $this->userdetail_service->giveInfo($userid);
            $arr = array();
            $arr['on'] = array();
            $arr['use'] = array();
            $arr['expired'] = array();
            $time = time();
            foreach ($cardlist['give_info'] as $kk => $vv) {

                if ($vv['status'] == "未使用") {
                    if ($vv['long'] >= $time) {
                        $arr['on'][$kk]['sname'] = $vv['sname'];
                        $arr['on'][$kk]['nickname'] = $vv['nickname'];
                        $arr['on'][$kk]['gtime'] = date("Y-m-d",$vv['gtime']);
                        $arr['on'][$kk]['long'] = date("Y-m-d",$vv['long']);
                        $arr['on'][$kk]['count'] = $vv['count'];
                        $arr['on'][$kk]['status'] = $vv['status'];
                        $arr['on'][$kk]['service_name'] = $vv['service_name'];
                        $arr['on'][$kk]['time'] = $vv['time'];
                        $arr['on'][$kk]['price'] = $vv['price'];
                    } else {  //过期
                        $arr['expired'][$kk]['sname'] = $vv['sname'];
                        $arr['expired'][$kk]['nickname'] = $vv['nickname'];
                        $arr['expired'][$kk]['gtime'] = date("Y-m-d",$vv['gtime']);
                        $arr['expired'][$kk]['long'] = date("Y-m-d",$vv['long']);
                        $arr['expired'][$kk]['count'] = $vv['count'];
                        $arr['expired'][$kk]['status'] = $vv['status'];
                        $arr['expired'][$kk]['service_name'] = $vv['service_name'];
                        $arr['expired'][$kk]['time'] = $vv['time'];
                        $arr['expired'][$kk]['price'] = $vv['price'];
                    }

                } else if ($vv['status'] == "已使用") {
                    $arr['use'][$kk]['sname'] = $vv['sname'];
                    $arr['use'][$kk]['nickname'] = $vv['nickname'];
                    $arr['use'][$kk]['gtime'] = date("Y-m-d",$vv['gtime']);
                    $arr['use'][$kk]['long'] = date("Y-m-d",$vv['long']);
                    $arr['use'][$kk]['count'] = $vv['count'];
                    $arr['use'][$kk]['status'] = $vv['status'];
                    $arr['use'][$kk]['service_name'] = $vv['service_name'];
                    $arr['use'][$kk]['time'] = $vv['time'];
                    $arr['use'][$kk]['price'] = $vv['price'];

                }
            }
            foreach ($arr as $k=>$v){
                if(empty($v)){
                    $arr[$k] = null;
                }
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

    public function mycoupon(){
        $userid = $this->input->post_get('userid', true);

        if (isset($userid)) {
            $this->load->service('userdetail_service');
            $cardlist = $this->userdetail_service->mycoupon($userid);
            $time = strtotime('+5 days');
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

    //会员标签
    public function mytaginfo(){
        $userid = $this->input->post_get('userid', true);
//        $bid = $this->input->post_get('bid', true);
        if(isset($userid)){
            $this->load->service('userdetail_service');

            $arr['usertag'] = $this->userdetail_service->myTag($userid);//用户标签

            $arr['user'] = $this->userdetail_service->mysummary($userid);
            $arr['user']['sttime']=date('Y/m/d',$arr['user']['registtime']);
            $arr['usercontent'] = $this->userdetail_service->myContent($userid);//护理日志
            $arr['comment'] = $this->userdetail_service->userComment($userid);//评价

            if(!empty($arr['usercontent'])){
                foreach ($arr['usercontent'] as $k=>$v){
                    $arr['usercontent'][$k]['visit_time'] = date('Y/m/d H:i',$v['visit_time']);
                }
            }
            if(!empty($arr['comment'])){
                foreach ($arr['comment'] as $k=>$v){
                    $arr['comment'][$k]['datetime'] = date('Y/m/d H:i',$v['datetime']);
                }
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

    //标签展示
    public function gettag()
    {
        $search = $this->input->post_get('search', true);
        $this->load->service('userdetail_service');
        $tag = $this->userdetail_service->gettag($search);
        $tag_type = $this->userdetail_service->getTagType();
//        $key = count($tag_type);
//        $tag_type[$key]=array('config_description'=>'全部','config_value'=>'11000');

        if(!empty($tag) || !empty($tag_type)){
            foreach ($tag as $kk => $vv ){
                $tag[$kk]['checked']=false;
            }
            foreach ($tag as $kk => $vv) {
                foreach ($tag_type as $k => $v) {
                    if ($vv['tag_type'] == $v['config_value']) {
                        $tag_type[$k]['tag'][] = $vv;
                    }
                }
//                $tag_type[$key]['tag'][] = $vv;
            }

            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $tag_type;
        }else {
            $data['status'] = false;
            $data['msg'] = '获取数据失败';
            $data['data'] = array();
        }

        exit(json_encode($data,true));

    }

    //添加标签
    public function addtag(){
        $userid = $this->input->post_get('userid', true);
        $bid = $this->input->post_get('bid', true);
        $type = $this->input->post_get('type', true);
        $content = $this->input->post_get('content', true);
        $tagcode = $this->input->post_get('tagcode', true);

        if(isset($userid) && isset($type) && isset($bid)) {

            if ($type == 'code') {
                $this->load->service('userdetail_service');
                $addtag = $this->userdetail_service->addusertag($userid,$bid,$tagcode);

            } else {
                if(strlen($bid) == 36){
                    $beauticianid = $this->db->select('beauticianid')->get_where('o2o_beautician', array('bid' => $bid))->row_array();
                    $data['uid'] = $beauticianid['beauticianid'];
                }else{
                    $data['uid'] = $bid;
                }
                $data['employeeid'] = $bid;
                $data['tag_code'] = $tagcode;
                $data['content'] = $content;
                $data['userid'] = $userid;
                $data['type'] = 0;
                $this->load->service('userdetail_service');
                if ($data['tag_code'] != null || $data['content'] != null) {
                    $addtag = $this->userdetail_service->addtag($data);
                } else {
                    $addtag = 1; //空数据
                }
            }

            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $addtag;
        }else{
            $data['status'] = false;
            $data['msg'] = '添加失败';
            $data['data'] = array();
        }

        exit(json_encode($data,true));
    }

    //删除标签
    public function delTag(){
        $userid = $this->input->post_get('userid', true);
        $tagcode = $this->input->post_get('tagcode', true);
        $bid = $this->input->post_get('bid', true);
        if(isset($userid) && isset($tagcode) && isset($bid)) {
            $this->load->service('userdetail_service');
            $deltag = $this->userdetail_service->delTag($userid,$tagcode);
            if($deltag){
                $data['status'] = true;
                $data['msg'] = 'success';
                $data['data'] = $deltag;
            }else{
                $data['status'] = false;
                $data['msg'] = '删除失败';
                $data['data'] = array();
            }
        }else{
            $data['status'] = false;
            $data['msg'] = '数据错误';
            $data['data'] = array();
        }

        exit(json_encode($data,true));
    }

    //护理汇总
    public function upremark(){
        $userid = $this->input->post_get('userid', true);
        $newremark = $this->input->post_get('newremark', true);
        $this->load->service('userdetail_service');
        $upremark = $this->userdetail_service->upremark($userid,$newremark);
        if($upremark == 1){
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $upremark;
        }else{
            $data['status'] = false;
            $data['msg'] = '修改失败';
            $data['data'] = array();
        }

        exit(json_encode($data,true));
    }

    //修改日志
    public function upContent(){
        $id = $this->input->post_get('id', true);
        $content = $this->input->post_get('content', true);
        $this->load->service('userdetail_service');
        $upContent = $this->userdetail_service->upContent($id,$content);
        if($upContent == 1){
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $upContent;
        }else{
            $data['status'] = false;
            $data['msg'] = '修改失败';
            $data['data'] = array();
        }

        exit(json_encode($data,true));
    }

}