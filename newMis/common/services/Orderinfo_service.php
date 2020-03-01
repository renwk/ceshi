<?php

class Orderinfo_service extends MY_Service{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('orderinfo_model');
        $this->load->model('collect_model');
    }

    //获取订单信息
    public function getOrderInfo($uid, $idx)
    {
        $info = array();
        if (empty($uid)) return $info = array('status' => false, 'msg' => '获取信息失败!', 'data' => '');
        $type = empty($idx) ? 0 : 1;
        $stime = strtotime(date('Y-m-d',time())) - 86400 * 7;
        $etime = strtotime(date('Y-m-d',time())) + 86399;
        if($type == 0){
            $data = $this->orderinfo_model->getOrderInfo($uid, $stime, $etime);
            $orderInfo = $this->handleOrderData($data);
            $info['status'] = true;
            $info['msg']    = 'success';
            $info['data']   = empty($orderInfo) ? null : $orderInfo;
        }else{
            $data = $this->orderinfo_model->getRechargeOrderInfo($uid, $stime, $etime);
            $orderData = $this->handleRechargeOrderData($data);
            $info['status'] = true;
            $info['msg']    = 'success';
            $info['data']   = empty($orderData) ? null : $orderData;
        }
       return $info;
    }

    public function handleOrderData($data)
    {
        $info = array();
        foreach($data as $k => $v)
        {
            $iname = explode(',',$v['iname']);
            $count = explode(',',$v['count']);
            $price = explode(',',$v['money']);
            $money = $this->handlePrice($price);
            $total = 0;
            foreach($money as $kk => $vv){
                $total += $vv;
            }
            $info[$k]['oid']  = $v['order_code'];
            $info[$k]['time'] = date('Y-m-d H:i:s',$v['prestatus_time']);
            $details = array();
            foreach($iname as $kk => $vv){
                $details[$kk]['iname'] = $vv;
                $details[$kk]['count'] = $count[$kk];
                $details[$kk]['money'] = $money[$kk];
            }
            $info[$k]['details'] = $details;
            $info[$k]['total'] = number_format($total,2) ;
        }
        return $info;
    }

    public function handlePrice($price)
    {
        $info = array();
        foreach($price as $k => $v){
            $info[] = number_format($v / 100 , 2);
        }
        return $info;
    }

    public function handleRechargeOrderData($data)
    {
        $info = array();
        foreach($data as $k => $v)
        {
            $ucard_no   = explode(',',$v['ucard_no']);
            $price      = explode(',',$v['gift_money']);
            $gift_money = $this->handlePrice($price);
            $info[$k]['oid']  = $v['oid'];
            $info[$k]['time'] = date('Y-m-d H:i:s',$v['time_pay']);
            $info[$k]['type'] = $v['type'] == 1 ? 1 : 0;
            $info[$k]['money_true'] = $v['money_true'];
            $info[$k]['ucard_no']   = $v['type'] == 3 ? $ucard_no[0] : $v['ucard_no'];
            $details = array();
            foreach($ucard_no as $kk => $vv){
                $details[$kk]['cardname'] = $v['type'] == 3 ? $v['cardname'].$vv : $v['cardname'];
                $details[$kk]['count']    = $v['count'];
                $details[$kk]['d_money']  = $v['type'] == 3 ? $gift_money[$kk] : $v['money_true'];
            }
            $info[$k]['details'] = $details;
        }
       return $info;
    }

    //获取订单详情
    public function getOrderDetails($oid,$type)
    {
        if (empty($oid))  return $info = array('status' => false, 'msg' => '获取信息失败!', 'data' => '');
        if (empty($type)) return $info = array('status' => false, 'msg' => '获取信息失败!', 'data' => '');
        if($type == 'consume'){
            $detailsData = $this->orderinfo_model->getOrderDetails($oid);
            $data = $this->handleDetailData($detailsData);
            $info['status'] = true;
            $info['msg']    = 'success';
            $info['data']   = $data;
        }else{
            $rechargeData = $this->orderinfo_model->getRechargeOrderDetails($oid);
            $data = $this->handleRechargeDetailData($rechargeData);
            $info['status'] = true;
            $info['msg']    = 'success';
            $info['data']   = $data;

        }
        return $info;
    }

    public function handleDetailData($data)
    {
        $info = array();
        foreach($data as $k => $v)
        {
            $iname = explode(',',$v['iname']);
            $price = explode(',',$v['price']);

            $paytype = explode(',',$v['paytype']);
            $pay_money = explode(',',$v['money']);

            $money = $this->handlePrice($price);
            $payMoney = $this->handlePrice($pay_money);
            $info['sname'] = $v['sname'];
            $info['time']  = date('Y-m-d H:i:s',$v['prestatus_time']);
            $info['sname'] = $v['sname'];
            $info['aid_name'] = $v['aid_name'];
            $info['bid_name'] = $v['bid_name'];
            $info['room_name'] = $v['room_name'];
            $details = array();
            foreach($iname as $kk => $vv){
                $details[$kk]['iname'] = $vv;
                $details[$kk]['money'] = $money[$kk];
            }
            $payment = array();
            foreach($paytype as $kk => $vv){
                $payment[$kk]['pay'] = $this->payType($vv);
                $payment[$kk]['money'] = $payMoney[$kk];

            }
            $info['details'] = $details;
            $info['order_price'] = number_format($v['order_price']/100,2);
            $info['discount_price'] = number_format($v['discount_price']/100,2);
            $info['tip'] = number_format($v['tip']/100,2);
            $info['cover_charge'] = number_format($v['cover_charge']/100,2);
            $info['actual_price'] = number_format($v['actual_price']/100,2);
            $info['payment'] = $payment;
        }
        return $info;
    }

    public function handleRechargeDetailData($rechargeData)
    {
        $info = array();
        foreach($rechargeData as $k => $v){
            $ucard_no   = explode(',',$v['ucard_no']);
            $gift_money = explode(',',$v['gift_money']);
            $paytype    = explode(',',$v['pay']);
            $pay_money  = explode(',',$v['d_money']);
            $payMoney = $this->handlePrice($pay_money);
            $giftMoney = $this->handlePrice($gift_money);
            $info['oid']        = $v['oid'];
            $info['sname']      = $v['sname'];
            $info['time']       = date('Y-m-d H:i:s',$v['time_pay']);
            $info['aid']        = empty($v['consultant_id']) ? '' : $this->getAidInfo($v['consultant_id']);
            $info['ucard_no']   = $v['type'] == 3 ? $ucard_no[0] : $v['ucard_no'];
            $info['free_num']   = $v['free_num'];
            $info['money_full'] = $v['money_full'];
            $info['cost']       = $v['cost'];
            $info['money_true'] = $v['money_true'];
            $details = array();
            foreach ($ucard_no as $kk => $vv)
            {
                $details[$kk]['ucard_no'] = $vv;
                $details[$kk]['gift_money'] = $v['type'] == 3 ?  $giftMoney[$kk] : $v['money_true'];
            }
            $payment = array();
            foreach($paytype as $kk => $vv){
                $payment[$kk]['pay'] = $this->payType($vv);
                $payment[$kk]['money'] = $payMoney[$kk];
            }
            $info['details'] = $details;
            $info['payment'] = $payment;

        }
        return $info;
    }

    public function payType($paytype)
    {
        $str = '';
        if($paytype == 1){
            $str = '现金';
        }else if($paytype == 2){
            $str = 'POS';
        }else if($paytype == 3){
            $str = '支票';
        }else if($paytype == 4){
            $str = '挂账';
        }else if($paytype == 5){
            $str = '现金礼券';
        }else if($paytype == 6){
            $str = '免单';
        }else if($paytype == 7){
            $str = '赠送';
        }else if($paytype == 8){
            $str = '合作';
        }else if($paytype == 9){
            $str = '储值';
        }else if($paytype == 10){
            $str = '免零';
        }else if($paytype == 11){
            $str = '多收零钱';
        }
        return $str;
    }

    public function getAidInfo($consultant_id)
    {
        $arr_aid = explode(',',$consultant_id);
        $aid = '';
        foreach($arr_aid as $k => $v){
            $info = $this->orderinfo_model->getAidInfo($v);
            $aid .= $info['nickname'].' ';
        }
        return $aid;
    }

    //获取收藏信息
    public function getOrderCollectionInfo($oid)
    {
        $info = array();
        if (empty($oid)) return $info = array('status' => false, 'msg' => '获取信息失败!', 'data' => '');
        $collection_data = $this->orderinfo_model->getOrderCollectionInfo($oid);
        $data = $this->handleCollectionInfo($collection_data);

        $info['status'] = true;
        $info['msg']    = 'success';
        $info['data']   = $data;
        return $info;
    }
    public function handleCollectionInfo($collection_data)
    {

        $info = array();
        foreach ($collection_data as $k =>$v)
        {

            $collectStore = $this->collect_model->one($v['user_id'], $v['storeid'], 'store');
            $info['is_collect'] = $collectStore ? true : false;
            $info['user_id']   = $v['user_id'];
            $info['sname']   = $v['sname'];
            $info['storeid'] = $v['storeid'];
            $info['adress']  = $v['adress'];
            $arr_aid = explode(',',$v['aid']);
            $nickname = explode(',',$v['nickname']);
            $aid = array();
            foreach($arr_aid as $kk => $vv)
            {
                $aid[$kk]['aid'] = $vv;
                $aid[$kk]['nickname'] = $nickname[$kk];
                $collectAdviser = $this->collect_model->one($v['user_id'], $vv, 'adviser');
                $aid[$kk]['is_collect'] =  $collectAdviser ? true : false;
            }
            $info['aid_info'] = $aid;
        }

        return $info;
    }
}