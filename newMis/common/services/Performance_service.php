<?php
class Performance_service extends MY_Service
{

    const MOST_RETRY_TIMES = 3;

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * 绩效排名
     * @param  $brand,$sid,$bid,$monthBegin,$role
     * @return array
     * @author rwk
     */
    public function getPerformanceInfo($brand,$sid,$bid,$monthBegin,$etime,$role){

        if($role == 'consultant'||$role == 'manage'){
            $this->load->model('employees_manage_model');
            //流水
            $waterMoney = $this->employees_manage_model->waterMoney($bid,$monthBegin);
            if(empty($waterMoney['waterMoney'])){
                $waterMoney['waterMoney'] = 0;
            }
            $storewaterMoney = $this->employees_manage_model->waterMoneyStore($sid,$waterMoney['waterMoney'],$monthBegin);
            $brandwaterMoney = $this->employees_manage_model->waterMoneyBrand($brand,$waterMoney['waterMoney'],$monthBegin);
            $sortperformance['waterMoney']['waterMoney'] = $waterMoney['waterMoney'];
            $sortperformance['waterMoney']['store'] = $storewaterMoney['store'];
            $sortperformance['waterMoney']['brand'] = $brandwaterMoney['brand'];
            $sortperformance['waterMoney']['name'] = '流水';

            //服务
            $serviceMoney = $this->employees_manage_model->serviceMoney($bid,$monthBegin);
            if(empty($serviceMoney['sMoney'])){
                $serviceMoney['sMoney'] = 0;
            }
            $storeserviceMoney = $this->employees_manage_model->serviceMoneyStore($sid,$serviceMoney['sMoney'],$monthBegin);
            $brandserviceMoney = $this->employees_manage_model->serviceMoneyBrand($brand,$serviceMoney['sMoney'],$monthBegin);
            $sortperformance['serviceMoney']['sMoney'] = $serviceMoney['sMoney'];
            $sortperformance['serviceMoney']['store'] = $storeserviceMoney['store'];
            $sortperformance['serviceMoney']['brand'] = $brandserviceMoney['brand'];
            $sortperformance['serviceMoney']['name'] = '服务';

            $this->load->model('beautician_model');
            //零售
            $lMoney = $this->beautician_model->retailMoney($bid,$monthBegin);
            if(empty($lMoney['lMoney'])){
                $lMoney['lMoney'] = 0;
            }
            $storelMoney = $this->beautician_model->retailMoneyStore($sid,$lMoney['lMoney'],$monthBegin);
            $brandlMoney = $this->beautician_model->retailMoneyBrand($brand,$lMoney['lMoney'],$monthBegin);
            $sortperformance['lMoney']['money'] = $lMoney['lMoney'];
            $sortperformance['lMoney']['store'] = $storelMoney['store'];
            $sortperformance['lMoney']['brand'] = $brandlMoney['brand'];
            $sortperformance['lMoney']['name'] = '零售';

            //售卡
            $card = $this->beautician_model->cardMoney($bid,$monthBegin);
            if(empty($card['lMoney'])){
                $card['lMoney'] = 0;
            }
            $storeCard = $this->beautician_model->cardMoneyStore($sid,$card['lMoney'],$monthBegin);
            $brandlCard = $this->beautician_model->cardMoneyBrand($brand,$card['lMoney'],$monthBegin);
            $sortperformance['card']['money'] = $card['lMoney'];
            $sortperformance['card']['store'] = $storeCard['store'];
            $sortperformance['card']['brand'] = $brandlCard['brand'];
            $sortperformance['card']['name'] = '售卡';
            if($role == 'consultant') {
                //人数
                $receptionNum = $this->employees_manage_model->receptionNum($bid, $monthBegin);
                if (empty($receptionNum['num'])) {
                    $receptionNum['num'] = 0;
                }
                $storeNum = $this->employees_manage_model->receptionNumStore($sid, $receptionNum['num'], $monthBegin);
                $brandNum = $this->employees_manage_model->receptionNumBrand($brand, $receptionNum['num'], $monthBegin);
                $sortperformance['receptionNum']['num'] = $receptionNum['num'];
                $sortperformance['receptionNum']['store'] = $storeNum['store'];
                $sortperformance['receptionNum']['brand'] = $brandNum['brand'];
                $sortperformance['receptionNum']['name'] = '人数';
            }

//p($sortperformance);die;
            return $sortperformance;

        }elseif ($role == 'beautician'){
            $this->load->model('beautician_model');
            $SumTime= $this->beautician_model->performanceSumTime($bid,$monthBegin,$etime);
            if(empty($SumTime['Sumtime'])){
                $SumTime['Sumtime']=0;
            }
            $storeSumTime= $this->beautician_model->performanceSumTimeStore($sid,$SumTime['Sumtime'],$monthBegin);
            $brandSumTime= $this->beautician_model->performanceSumTimeBrand($brand,$SumTime['Sumtime'],$monthBegin);

            //零售
            $lMoney = $this->beautician_model->retailMoney($bid,$monthBegin);
            if(empty($lMoney['lMoney'])){
                $lMoney['lMoney'] = 0;
            }
            $storelMoney = $this->beautician_model->retailMoneyStore($sid,$lMoney['lMoney'],$monthBegin);
            $brandlMoney = $this->beautician_model->retailMoneyBrand($brand,$lMoney['lMoney'],$monthBegin);

            //售卡
            $card = $this->beautician_model->cardMoney($bid,$monthBegin);
            if(empty($card['lMoney'])){
                $card['lMoney'] = 0;
            }
            $storeCard = $this->beautician_model->cardMoneyStore($sid,$card['lMoney'],$monthBegin);
            $brandlCard = $this->beautician_model->cardMoneyBrand($brand,$card['lMoney'],$monthBegin);

            $sortperformance['Sumtime']['SumTime']=$SumTime['Sumtime'];
            $sortperformance['Sumtime']['store'] = $storeSumTime['store'];
            $sortperformance['Sumtime']['brand'] = $brandSumTime['brand'];
            $sortperformance['Sumtime']['name'] = '工时';

            $sortperformance['lMoney']['money'] = $lMoney['lMoney'];
            $sortperformance['lMoney']['store'] = $storelMoney['store'];
            $sortperformance['lMoney']['brand'] = $brandlMoney['brand'];
            $sortperformance['lMoney']['name'] = '零售';

            $sortperformance['card']['money'] = $card['lMoney'];
            $sortperformance['card']['store'] = $storeCard['store'];
            $sortperformance['card']['brand'] = $brandlCard['brand'];
            $sortperformance['card']['name'] = '售卡';

            return $sortperformance;
        }
    }

    //个人绩效
    public function onePerformanceInfo($role,$bid,$stime,$etime){

        if($role == "consultant"){

            $performance = $this->waterMoney($role, $bid, $stime,$etime);//零售
            $card = $this->adviceCardInfo($bid, $stime,$etime, $performance['waterMoney'],'one');//售卡
            $performance['selldata']=$card[$bid];
            return $performance;
        }elseif ($role =="beautician"){

            $this->load->model('beautician_model');
            $beauticiantime = $this->beautician_model->getTime($bid, $stime,$etime);

            $times = $this->dataInfo($beauticiantime);//工时
            $pMoney = $this->waterMoney($role, $bid, $stime,$etime);//零售
            $card = $this->beauticianCardInfo($bid, $stime,$etime,'one');//我的绩效:售卡
            // 获取加钟奖励+加班排班
            $add_bell = $this->beautician_model->getBelRewardTime($bid,$stime,$etime);

            $data = $this->processingDataAll($bid,$times,$pMoney,$card,$add_bell);
            return $data;
        }
    }

    public function getThrowntime($bid,$time){
        $this->load->model('beautician_model');
        $thrownTime = $this->beautician_model->getThrowntime($bid,$time);
        return $thrownTime;
    }
    public function getTargetTimeInfo($bid,$month){
        $this->load->model('beautician_model');
        $target = $this->beautician_model->getTargetWaterInfo($bid,$month);
        return $target;
    }
    public function getTargetWaterInfo($bid,$month){
        $this->load->model('employees_manage_model');
        $target = $this->employees_manage_model->getTargetWaterInfo($bid,$month);
        return $target;
    }

    public function processingDataAll($bid,$times,$pMoney,$card,$add_bell){
//        $bid = $times['bid'];
        $data = array();
        $data = $times;

        $card[$bid]['pMoney'] = $pMoney;
        $data['selldata'] = $card[$bid];
        $data['abtime']=0;
        $data['numab']=0;
        $data['overtime']=0;
        $data['num_over']=0;
        if(count($add_bell)>0){
            foreach ($add_bell as $k=>$v) {
                if($data['bid'] == $v['ids']){
                    $data['abtime'] = $v['abtime'];
                    $data['numab'] = $v['abtime'] > 0 ? $v['numab'] : 0;
                    $data['overtime'] = $v['overtime'];
                    $data['num_over'] = $v['overtime'] > 0 ? $v['num_over'] : 0;
                }
            }
        }
        return $data;
    }

//    // 合并理疗师服务工时
//    private function processingDataInfo($beauticianService)
//    {
//        $beauticianInfo = array();
//        $beauticianInfo['sumTime'] = 0;
//
//        foreach($beauticianService as $k => $v)
//        {
//            $beauticianInfo['sumTime']    += round($v['rowTime']/60,2);
//            $beauticianInfo['sumTime']   += round($v['spotTime']/60,2);
//            $beauticianInfo['sumTime'] += round($v['upgrade_bell_time']/60,2);
//            $beauticianInfo['sumTime'] += round($v['add_bell_time']/60,2);
//        }
//        return $beauticianInfo;
//    }

    public function dataInfo($beauticianService){
        $beauticianInfo = array();
        $beauticianInfo['levlNumE4']  = 0;
        $beauticianInfo['levlNumE3']  = 0;
        $beauticianInfo['levlNumE2']  = 0;
        $beauticianInfo['levlNumE1']  = 0;
        $beauticianInfo['levlNumG']   = 0;
        $beauticianInfo['levlNumA']   = 0;
        $beauticianInfo['levlNumP']   = 0;
        $beauticianInfo['rowTime']    = 0;
        $beauticianInfo['rowNum']     = 0;
        $beauticianInfo['spotTime']   = 0;
        $beauticianInfo['spotNum']    = 0;
//        $beauticianInfo['bell_time']  = 0;
        $beauticianInfo['bell_num']   = 0;
        $beauticianInfo['add_bell_time']   = 0;
        foreach($beauticianService as $k => $v)
        {
            $E4 = 0;
            $E3 = 0;
            $E2 = 0;
            $E1 = 0;
            $G = 0;
            $A = 0;
            $P = 0;
            if($v['level'] == 'E3'){
                $E3 = $v['levlNum']; //
            } else if($v['level'] == 'E2'){
                $E2 = $v['levlNum']; //
            }else if($v['level'] == 'E1'){
                $E1 = $v['levlNum']; //
            }else if($v['level'] == 'G'){
                $G = $v['levlNum']; //
            }else if($v['level'] == 'A'){
                $A = $v['levlNum']; //
            }else if($v['level'] == 'P'){
                $P = $v['levlNum']; //
            }elseif($v['level'] == 'E4'){
                $E4 = $v['levlNum'];
            }
            $beauticianInfo['bid']      = $v['bid'];
            $beauticianInfo['nickname']   = $v['nickname'];
            $beauticianInfo['level_name'] = $v['level'];
            $beauticianInfo['levlNumE4']  += $E4;
            $beauticianInfo['levlNumE3']  += $E3;
            $beauticianInfo['levlNumE2']  += $E2;
            $beauticianInfo['levlNumE1']  += $E1;
            $beauticianInfo['levlNumG']   += $G;
            $beauticianInfo['levlNumA']   += $A;
            $beauticianInfo['levlNumP']   += $P;
            $beauticianInfo['rowTime']    += round($v['rowTime']/60,2);
            $beauticianInfo['rowNum']     += $v['rowNum'];
            $beauticianInfo['spotTime']   += round($v['spotTime']/60,2);
            $beauticianInfo['spotNum']    += $v['spotNum'];
//            $beauticianInfo['bell_time'] += round($v['upgrade_bell_time']/60,2);
            $beauticianInfo['add_bell_time'] += round($v['add_bell_time']/60,2);
            $bell_num = explode(',',$v['bell_num']);
            $num = array();
            foreach($bell_num as $kk => $vv)
            {
                if($vv == 8406)
                {
                    $num[$kk] = $vv;
                }
            }
            $beauticianInfo['bell_num']    += count($num);
        }

        return $beauticianInfo;
    }
    //流水
    public function waterMoney($role,$bid,$stime,$etime){
        $waterMoney = 0;

        if($role == 'consultant'|| $role == 'manage'){//顾问 经理
            $result['reception'] = 0;
            $result['waterMoney'] = 0.00;
            $result['lMoney'] = 0.00;
            $result['sMoney'] = 0.00;
            $this->load->model('employees_manage_model');
            $consultantPerformance = $this->employees_manage_model->consultantPerformance($bid,$stime,$etime);
            $refundconsultantPerformance = $this->employees_manage_model->refundconsultantPerformance($bid,$stime,$etime);

            if(count($consultantPerformance)>0) {
                foreach ($consultantPerformance as $key => $val) {
                    $type = $val['config_type'];//订单类型
                    $otype = $val['type']; //订单状态
                        if ($otype == '1' || $otype == '3' || $otype == '5') {
                            if ($type == '8603') {
                                $result['waterMoney'] += $val['waterMoney'];
                                $result['lMoney'] += $val['pMoney'];
                            } else if ($type == '8601' || $type == '8602' || $type == '8604' || $type == '8605' || $type == '8606' || $type == '8607') {
                                $result['reception'] += $val['reception'];
                                $result['waterMoney'] += $val['waterMoney'];
                                $result['sMoney'] += $val['pMoney'];
                            } else {
                                $result['waterMoney'] += $val['waterMoney'];
                            }
                        }

                }
            }
            if(count($refundconsultantPerformance)>0) {
                foreach ($refundconsultantPerformance as $k => $vv) {
                    $type = $vv['o_type'];//订单类型
                    $otype = $vv['type']; //订单状态
                    if ($otype == '2' || $otype == '4' || $otype == '6') {
                        if ($type == '8603') {
                            $result['waterMoney'] -= $vv['waterMoney'];
                            $result['lMoney'] -= $vv['pMoney'];
                        } else if ($type == '8601' || $type == '8602' || $type == '8604' || $type == '8605' || $type == '8606' || $type == '8607') {
                            $result['reception'] -= $vv['reception'];
                            $result['waterMoney'] -= $vv['waterMoney'];
                            $result['sMoney'] -= $vv['pMoney'];
                        } else {
                            $result['waterMoney'] -= $vv['waterMoney'];
                        }
                    }
                }
            }
            return $result;
        }elseif($role == 'beautician'){//理疗师
            $result['pMoney'] = 0.00;
            $this->load->model('beautician_model');
            $beauticianPerformance = $this->beautician_model->beauticianPerformance($bid,$stime,$etime);
            $refundbeauticianPerformance = $this->beautician_model->refundbeauticianPerformance($bid,$stime,$etime);
            if(count($beauticianPerformance)>0) {
                foreach ($beauticianPerformance as $key => $val) {
                    $result['pMoney'] += $val['pMoney'];
                }
            }
            if(count($refundbeauticianPerformance)>0) {
                foreach ($refundbeauticianPerformance as $k => $vv) {
                    $result['pMoney'] -= $vv['pMoney'];
                }
            }
            return $result['pMoney'];
        }
    }
    //售卡
    public function adviceCardInfo($bid,$stime,$etime,$waterMoney,$type=null){
            $performance['cardMoney'] = 0;
            $performance['waterMoney'] = $waterMoney;
            $this->load->model('employees_manage_model');
            $Cards = $this->employees_manage_model->getCardTypeInfo($bid, $stime, $etime);
            if ($type == 'one') {
                $performance = $this->cardTypeInfo($bid,$Cards, $waterMoney);
            } else {
                foreach ($Cards as $key => $val) {
                    if ($val['otype'] == 1) {
                        $performance['waterMoney'] += $val['waterMoney'];
                        $performance['cardMoney'] += $val['pMoney'];
                    } else {
                        $performance['waterMoney'] -= $val['waterMoney'];
                        $performance['cardMoney'] -= $val['pMoney'];
                    }
                }
            }
            return $performance;
        }
    public function beauticianCardInfo($bid,$stime,$etime,$type=null){
            $cardMoney = 0;
            $this->load->model('beautician_model');
            $beauticianCards = $this->beautician_model->getCards($bid, $stime,$etime);
            if($type == 'one'){
                $cardMoney = $this->cardTypeInfo($bid,$beauticianCards,0);
            }else {
                foreach ($beauticianCards as $key => $val) {
                    if ($val['otype'] == 1) {
                        $cardMoney += $val['pMoney'];
                    } else {
                        $cardMoney -= $val['pMoney'];
                    }
                }
            }
            return $cardMoney;
        }

//    //数组排序
//    public function sortinfo($performance,$sid,$bid,$type){
//        foreach($performance as $key =>$val){
//            if($val['sid'] == $sid){
//                $ptype[$key] = $val[$type];
//                $Sperformance[] = $val;
//            }
//            $Btype[$key] = $val[$type];
//        }
//        array_multisort($Btype, SORT_DESC, $performance);
//        array_multisort($ptype, SORT_DESC, $Sperformance);
//        foreach ($Sperformance as $k =>$v){
//            if($v['bid'] == $bid){
//                $type1 = $v;
//                $type1['sort'] = $k;
//            }
//        }
//        foreach ($performance as $kk=>$vv){
//            if($vv['bid'] == $bid){
//                $type1['brand'] = $kk;
//            }
//        }
//        $sort = $type1;
//        return $sort;
//    }

    public function cardTypeInfo($bid,$cards,$waterMoney){
            $result = array();
            $result[$bid]['waterMoney'] = $waterMoney;
            $result[$bid]['balanceMoney'] = 0.00;
            $result[$bid]['commonMoney'] = 0.00;
            $result[$bid]['otherMoney'] = 0.00;
            $result[$bid]['ucardGiftMoney'] = 0.00;
            $result[$bid]['titlecardMoney'] = 0.00;

        foreach ($cards as $k => $val) {
            $key = $val['bid'];
            $type = $val['accounts1'];
            $otype = $val['otype'];
            $Money = isset($val['waterMoney']) ? $val['waterMoney'] : 0;
            if (!isset($result[$key])) {
                $result[$key]['oid'] = $val['oid'];
                $result[$key]['bid'] = $val['bid'];
                $result[$key]['waterMoney'] = $waterMoney;
                $result[$key]['balanceMoney'] = 0.00;
                $result[$key]['commonMoney'] = 0.00;
                $result[$key]['otherMoney'] = 0.00;
                $result[$key]['ucardGiftMoney'] = 0.00;
                $result[$key]['titlecardMoney'] = 0.00;
            }
            if ($otype == '1' || $otype == '3' || $otype == '5') {
                $result[$key]['waterMoney'] += $Money;
                if ($type == 'titlecard') {//资格卡
                    $result[$key]['titlecardMoney'] += $val['pMoney'];
                } elseif ($type == 'other') {//疗程卡
                    $result[$key]['otherMoney'] += $val['pMoney'];
                } elseif ($type == 'common') {//常规金
                    $result[$key]['commonMoney'] += $val['pMoney'];
                } elseif ($type == 'balance') {//储值卡
                    $result[$key]['balanceMoney'] += $val['pMoney'];
                } else {//gift 礼券卡
                    $result[$key]['ucardGiftMoney'] += $val['pMoney'];
                }
            } else {
                $result[$key]['waterMoney'] -= $Money;
                if ($type == 'titlecard') {//资格卡
                    $result[$key]['titlecardMoney'] -= $val['pMoney'];
                } elseif ($type == 'other') {//疗程卡
                    $result[$key]['otherMoney'] -= $val['pMoney'];
                } elseif ($type == 'common') {//常规金
                    $result[$key]['commonMoney'] -= $val['pMoney'];
                } elseif ($type == 'balance') {//储值卡
                    $result[$key]['balanceMoney'] -= $val['pMoney'];
                } else {//gift 礼券卡
                    $result[$key]['ucardGiftMoney'] -= $val['pMoney'];
                }
            }
        }

        return $result;
    }
}