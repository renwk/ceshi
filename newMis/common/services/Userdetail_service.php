<?php
class Userdetail_service extends MY_Service
{

    const MOST_RETRY_TIMES = 3;

    public function __construct()
    {
        parent::__construct();
    }

    public function userlist($bid,$store,$search){
        $this->load->model('users_model');
        $where = "1=1";
        if(!empty($bid)){
            $where .=" and `a`.`consultant_id`={$bid}";
        }
        if(!empty($search)){
            $where .= " and( `a`.`mobile` like '%{$search}%' or `a`.`nickname` like '%{$search}%')";
        }
        if(!empty($store)){
            $where .=" and `d`.`sname` = '{$store}'";
        }
        $users = $this->users_model->getUcardByAdviser($where);
        return $users;
    }
    public function storelist(){
        $this->load->model('userdetail_model');
        $users = $this->userdetail_model->lsStore();
        return $users;
    }
    public function detail($userid){
        $this->load->model('userdetail_model');
        $user_detail = $this->userdetail_model->getUserDetail($userid);
        $user_detail['sex'] = ($user_detail['sex'] == 'user_sex_man') ? '男' : '女';
//        $user_detail['registtime'] = !empty($user_detail['registtime']) ? date('Y-m-d', $user_detail['registtime']) : '';
//        $user_detail['order_num'] = !empty($user_detail['uid']) ? count($this->userdetail_model->getOrderByUid($user_detail['uid'])) : ''; //订单数
//        $user_detail['mycard_num'] = !empty($user_detail['uid']) ? count($this->userdetail_model->getUcardListByUserid($user_detail['userid'], array('balance'))) : ''; //用户会员储值卡数
//        $user_detail['mycourse_num'] = !empty($user_detail['uid']) ? count($this->userdetail_model->getUcardListByUserid($user_detail['userid'], array('other', 'common'))) : ''; //用户疗程卡/常规数
//        $user_detail['title_num'] = !empty($user_detail['uid']) ? count($this->userdetail_model->getUcardListByUserid($user_detail['userid'], array('titlecard'))) : ''; //资格卡
//        $user_detail['coupon_num'] = !empty($user_detail['uid']) ? count($this->userdetail_model->getMycoupon($user_detail['userid'])) : ''; //用户优惠券数
//        $user_detail['give_num'] = !empty($user_detail['uid']) ? count($this->userdetail_model->getGiveCount($user_detail['mobile'])) : ''; //用户礼包
//        $user_detail['package_num'] = !empty($user_detail['uid']) ? count($this->userdetail_model->getMyPackageTotal($user_detail['uid'])) : ''; //用户礼包



        return $user_detail;

    }

    //消费记录
    public function payDetail($userid) {
        $this->load->model('userdetail_model');
        $user_detail = $this->userdetail_model->getUserDetail($userid);
        $order_info = $this->userdetail_model->getOrderByUid($user_detail['uid']);
        $config_system = $this->userdetail_model->getConfigSystemList();
        $data = array();
        $data['userid'] = $userid;
        if (!empty($order_info)) {
            foreach ($order_info as $key => $val) {
                $data['order_info'][$key] = $val;
//                $data['order_info'][$key]['platform'] = $config_system[$val['platform']];
                $data['order_info'][$key]['type'] = $config_system[$val['type']];
                $data['order_info'][$key]['status'] = $config_system[$val['status']];
                $data['order_info'][$key]['start_time'] = !empty($val['start_time']) ? date('Y-m-d', $val['start_time']) : '';
                $data['order_info'][$key]['end_time'] = !empty($val['end_time']) ? date('Y-m-d', $val['end_time']) : '';
                $data['order_info'][$key]['order_price'] = !empty($val['order_price']) ? number_format(($val['order_price'] / 100), 2, '.', '') : '0.00';
                $data['order_info'][$key]['discount_price'] = !empty($val['discount_price']) ? number_format(($val['discount_price'] / 100), 2, '.', '') : '0.00';
                $data['order_info'][$key]['actual_price'] = !empty($val['actual_price']) ? number_format(($val['actual_price'] / 100), 2, '.', '') : '0.00';
                $data['order_info'][$key]['cover_charge'] = !empty($val['cover_charge']) ? number_format(($val['cover_charge'] / 100), 2, '.', '') : '0.00';
                $data['order_info'][$key]['tip'] = !empty($val['tip']) ? number_format(($val['tip'] / 100), 2, '.', '') : '0.00';
                $data['order_info'][$key]['create_time'] = !empty($val['create_time']) ? date('Y-m-d', $val['create_time']) : '';
            }
        }

        return $data;
    }

    //储值卡信息
    public function ucardInfo($userid,$type=null) {
        $this->load->model('userdetail_model');

        $type_arr = array('balance');//titlecard
        $ucard_list = $this->userdetail_model->getUcardListByUserid($userid, $type_arr);
        if($type == 'api'){
            return $ucard_list;
        }else {
            $list = array();
            if (!empty($ucard_list)) {
                foreach ($ucard_list as $kk => $vv) {
                    $list[$kk]['label'] = $vv['ucard_no'] . "(" . $vv['cardname'] . ")";
                    $list[$kk]['value'] = $vv['ucard_no'] . "(" . $vv['mycardid'] . ")";
                }
            }
            $data = array();
            $data['userid'] = $userid;
            $data['ucard_list'] = json_encode($list);
            return $data;
        }
    }
    //获取储值卡信息
    public function requestMycardinfo($mycardid) {

        if (!empty($mycardid)) {
            $this->load->model('userdetail_model');
            $mycourse_info = $this->userdetail_model->getMyCardInfo($mycardid);
            $mycourse_log = $this->userdetail_model->getMyCardLog($mycardid);
            foreach ($mycourse_log as $k => $v) {
                $oid = strlen($v['oid']);
                if ($oid == 10) {
                    $sname = $this->userdetail_model->getUcardStoreName($v['oid']);
                    $mycourse_log[$k]['sname'] = $sname['sname'];
                } else if ($oid == 18) {
                    $osname = $this->userdetail_model->getOderStoreName($v['oid']);
                    $mycourse_log[$k]['sname'] = $osname['sname'];
                } else if ($oid == 17) {
                    $rosname = $this->userdetail_model->getOderRefundStoreName($v['oid']);
                    $mycourse_log[$k]['sname'] = $rosname['sname'];
                    if (empty($rosname)) {
                        $rusname = $this->userdetail_model->getUcardRefundStoreName($v['oid']);
                        $mycourse_log[$k]['sname'] = $rusname['sname'];
                    }
                }
            }
            if ($mycourse_info['cardid'] == '1') {//app会员卡
                $mycourse_info['money_available'] = $mycourse_info['balance'];
            }

            $mycourse_info['accounts'] = $this->getCardType($mycourse_info['accounts']);
            $mycourse_info['av_cost'] = !empty($mycourse_info['money_available']) ? $mycourse_info['money_available'] : 0.00;
            $mycourse_info['status'] = $this->myCardStatus($mycourse_info['status']);
            $mycourse_info['time_pay'] = date('Y-m-d', $mycourse_info['time_pay']);
            $mycourse_info['time_active'] = !empty($mycourse_info['time_active']) ? date('Y-m-d', $mycourse_info['time_active']) : '';
            $mycourse_info['time_validity'] = !empty($mycourse_info['time_validity']) ? date('Y-m-d', $mycourse_info['time_validity']) : '';
            $re = array();
            $re['mycard_info'] = $mycourse_info;
            $re['mycard_log'] = $mycourse_log;
        } else {
            $re = array();
            $re['mycard_info'] = '';
            $re['mycard_log'] = '';
        }
        return $re;
    }
    //资格卡
    public function titleCard($userid = null) {
        $type_arr = array('titlecard');//titlecard
        $this->load->model('userdetail_model');
        $ucard_list = $this->userdetail_model->getUcardListByUserid($userid, $type_arr);
        $data = array();
        $data['userid'] = $userid;
        $data['ucard_list'] = $ucard_list;

        return $data;
    }

    private function getCardType($type = null) {
        $re = '';
        if ($type == 'common') {
            $re = '常规卡';
        } else if ($type == 'balance') {
            $re = '储值卡';
        } else if ($type == 'other'){
            $re = '疗程卡';
        }else{
            $re = '资格卡';
        }
        return $re;
    }
    private function myCardStatus($type) {
        $re = '';
        if ('0' == $type) {
            $re = '待开卡';
        } else if ('1' == $type) {
            $re = '正常';
        } else if ('2' == $type) {
            $re = '冻结';
        } else if ('3' == $type) {
            $re = '停用';
        } else if ('4' == $type) {
            $re = '锁定';
        } else if ('5' == $type) {
            $re = '删除';
        } else if ($type == '6') {
            $re = '过期';
        } else {
            $re = '未知';
        }
        return $re;
    }

    //疗程常规金
    public function mycourse($userid = null,$type=null) {

        $this->load->model('userdetail_model');
        $type_arr = array('other', 'common');
        $ucard_list = $this->userdetail_model->getUcardListByUserid($userid, $type_arr);
        $data = array();

        if($type=='api'){
            return $ucard_list;
        }else{
        $list = array();
        if(!empty($ucard_list)){
            foreach ($ucard_list as $kk =>$vv){
                $list[$kk]['label'] = $vv['ucard_no']."(".$vv['cardname'].")";
                $list[$kk]['value'] = $vv['ucard_no']."(".$vv['mycardid'].")";
            }
        }

        $data['userid'] = $userid;
        $data['ucard_list'] = json_encode($list);
        return $data;
        }
    }
    public function mycourseHandle($data) {
        $re = array();
        foreach ($data as $key => $val) {
            foreach ($val as $k => $v) {
                if ($k == 'time_validity' || $k == 'time_validity' || $k == 'time_active') {
                    $re[$key][$k] = !empty($v) ? date('Y-m-d', $v) : '';
                } else if ($k == 'occupy_times') {
                    $re[$key][$k] = $v;
                    $re[$key]['over_num'] = $re[$key]['total'] - $re[$key]['used_times'] - $re[$key]['occupy_times'];
                } else {
                    $re[$key][$k] = $v;
                }
            }
        }

        return $re;
    }
    //获取疗程信息
    public function requestMycourse($mycardid) {
        $this->load->model('userdetail_model');
        $mycourse_info = $this->userdetail_model->getMyCardInfo($mycardid); //mycourse_id
        $mycourse_log = $this->userdetail_model->getMyCardLog($mycardid, $mycourse_info['mycourse_id']);
        foreach ($mycourse_log as $k => $v) {
            $oid = strlen($v['oid']);
            if ($oid == 10) {
                $sname = $this->userdetail_model->getUcardStoreName($v['oid']);
                $mycourse_log[$k]['sname'] = $sname['sname'];
            } else if ($oid == 18) {
                $osname = $this->userdetail_model->getOderStoreName($v['oid']);
                $mycourse_log[$k]['sname'] = $osname['sname'];
            } else if ($oid == 17) {
                $rosname = $this->userdetail_model->getOderRefundStoreName($v['oid']);
                $mycourse_log[$k]['sname'] = $rosname['sname'];
                if (empty($rosname)) {
                    $rusname = $this->userdetail_model->getUcardRefundStoreName($v['oid']);
                    $mycourse_log[$k]['sname'] = $rusname['sname'];
                }
            }
        }
        $mycourse_info['accounts'] = !empty($mycourse_info['accounts']) ? $this->getCardType($mycourse_info['accounts']) : '';
        $mycourse_info['av_num'] = !empty($mycourse_info['total']) ? $mycourse_info['total'] - $mycourse_info['used_times'] - $mycourse_info['occupy_times'] : 0;
        $mycourse_info['status'] = $mycourse_info['status'] != '' && $mycourse_info['status'] != null ? $this->myCardStatus($mycourse_info['status']) : '';
        $mycourse_info['time_pay'] = !empty($mycourse_info['time_pay']) ? date('Y-m-d', $mycourse_info['time_pay']) : '';
        $mycourse_info['time_active'] = !empty($mycourse_info['time_active']) ? date('Y-m-d', $mycourse_info['time_active']) : '';
        $mycourse_info['time_validity'] = !empty($mycourse_info['time_validity']) ? date('Y-m-d', $mycourse_info['time_validity']) : '';

        $re = array();
        $re['mycourse_info'] = $mycourse_info;
        $re['mycourse_log'] = $mycourse_log;

        return $re;
    }

    //优惠券
    public function mycoupon($userid) {

        $this->load->model('userdetail_model');
        $mycoupon_list_rs = $this->userdetail_model->getMycoupon($userid);
        $mycoupon_list = $this->mycouponHandle($mycoupon_list_rs);
        $data = array();
        $data['userid'] = $userid;
        $data['mycoupon_list'] = $mycoupon_list;

        return $data;
    }
    public function mycouponHandle($data) {

        $re = array();
        $i = 1;
        $this->load->model('userdetail_model');
        foreach ($data as $key => $val) {

            foreach ($val as $k => $v) {
                if ($k == 'addtime' || $k == 'expiratime' || $k == 'usetime') {
                    $re[$key][$k] = !empty($v) ? date('Y-m-d', $v) : '';
                } else if ($k == 'state') {
                    $re[$key][$k] = $this->makeCouponStatus($v);
                } else if ($k == 'rowNo') {
                    $re[$key][$k] = $i;
                } else {
                    $re[$key][$k] = $v;
                }
            }
            if (!empty($val['order_code'])) {

                $sname = $this->userdetail_model->getOderStoreName($val['order_code']);
                $re[$key]['sname'] = $sname['sname'];
            } else {
                $re[$key]['sname'] = '';
            }
            $i++;
        }

        return $re;
    }
    //优惠券状态
    private function makeCouponStatus($type) {
        $re = '';
        if ('COUPON_WAITSEND' == $type) {
            $re = '未发送';
        } else if ('COUPON_ON' == $type) {
            $re = '已发送/可用';
        } else if ('COUPON_USE' == $type) {
            $re = '已使用';
        } else if ('COUPON_DEL' == $type) {
            $re = '已删除';
        } else if ('COUPON_STOP' == $type) {
            $re = '暂停使用';
        } else if ('COUPON_EXPIRED' == $type) {
            $re = '已过期';
        }
        return $re;
    }


    //特殊礼遇
    public function giveInfo($userid) {
        $data = array();
        $data['userid'] = $userid;
        $this->load->model('userdetail_model');
        $user_detail = $this->userdetail_model->getUserDetail($userid);
        $user_phone = $user_detail['mobile'];
        $data['give_info'] = $this->userdetail_model->getGiveInfo($user_phone);
        return $data;
    }

    public function myTag($userid){
        $this->load->model('userdetail_model');
        $usertag = $this->userdetail_model->getCustomer($userid);
        $tag_code = json_decode($usertag['tag_code'], true);
        $tag_arr = array();
        if(!empty($tag_code)){
            foreach($tag_code as $k => $v)
            {
                $tag_info = $this->userdetail_model->getTagInfo($v);
                $tag_arr[$k]['tag_name'] = $tag_info['tag_name'];
                $tag_arr[$k]['tag_code'] = $tag_info['tag_code'];
            }
        }
        return $tag_arr;
    }
    public function myContent($userid){
        $this->load->model('userdetail_model');
        $usercontent = $this->userdetail_model->myContent($userid);
        return $usercontent;

    }
    public function userComment($userid){
        $this->load->model('userdetail_model');
        $usercontent = $this->userdetail_model->userComment($userid);
        return $usercontent;

    }

    public function gettag($costmoney){
        $this->load->model('userdetail_model');
        $usertag = $this->userdetail_model->getUserTag($costmoney);
        return $usertag;
    }
    public function getTagType(){
        $this->load->model('userdetail_model');
        $usertag = $this->userdetail_model->getTagType();
        return $usertag;
    }
    public function mysummary($userid){
        $this->load->model('userdetail_model');
        $usertaginfo = $this->userdetail_model->getUserDetail($userid);
        return $usertaginfo;
    }

    public function upremark($userid,$newremark){
        $this->load->model('userdetail_model');
        $data = ['remark'=>$newremark];
        $res = $this->userdetail_model->upUserRemark($userid,$data);
        return $res;
    }
    public function upContent($id,$content){
        $this->load->model('userdetail_model');
        $data = ['content'=>$content];
        $res = $this->userdetail_model->upTagData($data,$id);
        return $res;
    }
    public function addtag($data){
        $data['visit_time'] = time();
        $data['addtime'] = time();
        $this->load->model('userdetail_model');
        $res = $this->userdetail_model->getUserTagInsert($data);
        return $res;
    }

    //新增/更新 会员标签信息
    public function addUserTag($user_id,$bid,$tag_code)
    {
        if(empty($tag_code)){
            $error = '信息有误,请稍后再试!';
            return $error;
        }
        $tagcode = explode(',',rtrim($tag_code,','));
        $arr = new ArrayObject($tagcode);
        $tagCode = json_encode($arr);

        if(empty($user_id))
        {
            $error = '信息有误,请稍后再试!';
            return $error;
        }
        $data = array();
        $data['userid']   = $user_id;
        $data['type']     = 1;
        $data['tag_code'] = $tagCode;
        $data['employeeid']= $bid;
        $data['uid']      = $bid;
        $data['addtime']  = time();
        $this->load->model('userdetail_model');
        $is_tag = $this->userdetail_model->getUserTagOne($user_id);
        if($is_tag['count'] == 0){
            $re = $this->userdetail_model->getUserTagInsert($data);
            return $re;
        }else{

            $info = $this->userdetail_model->getCustomer($user_id);
            $tag_code = json_decode($info['tag_code'], true);
            $code = empty($tag_code) ? $tagcode : array_unique(array_merge($tag_code,$tagcode));
            $arr = new ArrayObject($code);
            $edit_tag_code = json_encode($arr);
            $e_data['tag_code'] = $edit_tag_code;
            $re = $this->userdetail_model->getUserTagUpdate($info['id'],$e_data);
            return $re;
        }
    }
//删除标签
    public function delTag($uid,$tag_code)
    {

        $this->load->model('userdetail_model');
        $info = $this->userdetail_model->getCustomer($uid);
        $tagCode_arr = json_decode($info['tag_code'], true);
        $tagcode = explode(',',rtrim($tag_code,','));
        $code = array();
        foreach($tagCode_arr as $k => $v)
        {
            foreach($tagcode as $kk => $vv){
                if($vv != $v){
                    $code[] = $v;
                }
            }
        }
        $arr = new ArrayObject($code);
        $e_data['tag_code'] = empty($code) ? '' : json_encode($arr);
        $re = $this->userdetail_model->getUserTagUpdate($info['id'],$e_data,'del');
        return $re;
    }

}