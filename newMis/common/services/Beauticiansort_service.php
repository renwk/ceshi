<?php

class beauticiansort_service extends MY_Service
{

    public function __construct()
    {
        $this->load->model('Beautician_model');
        parent::__construct();
    }

    public function requestBidHoursSort($sid)
    {
        //获取门店所以理疗师信息
        $bid_info =  $this->Beautician_model->requestBidHoursAllInfo($sid);
        $data = array();
        foreach($bid_info as $k => $v)
        {
            $btime =  $this->Beautician_model->requestBidHoursSort($v['bid']);
            $total = $btime['actual_time'] + $btime['initial_time'] + $btime['thrown_time'];
            $data[$k]['name'] = $btime['nickname'];
            $data[$k]['total'] = round($total/60,2);
            $data[$k]['total_sort'] = $total;
        }
        $sort = array();
        foreach($data as $k => $v)
        {
            $sort[] = $v['total_sort'];
        }
        array_multisort($sort,SORT_ASC,$data);
        return $data;
    }

    //获取理疗师加班信息
    public function requestBidOverTimeInfo($bid, $date,$role)
    {
        $ymd = $this->processDate($date);
        if($role == 'beautician') {
            $info = $this->Beautician_model->requestBidOverTimeInfo($bid, $ymd);
        }else{
            $info = $this->Beautician_model->consultantBidOverTimeInfo($bid, $ymd);
        }
        foreach($info as $k => $v){
            $info[$k]['otime_date'] = date('Y-m-d',$v['otime_date']);
            $info[$k]['otm_time'] = round($v['otm_time']/60,2);
            $info[$k]['ott_time'] = round($v['ott_time']/60,2);
        }
        return $info;
    }
    //获取加班总时长
    public function requestBidOverTimeTotal($bid, $date,$role)
    {
        $ymd = $this->processDate($date);
        if($role == 'beautician'){
            $info =  $this->Beautician_model->requestBidOverTimeTotal($bid, $ymd);
        }else{
            $info =  $this->Beautician_model->consultantBidOverTimeTotal($bid, $ymd);
        }
        $info['OTT'] = round($info['OTT']/60,2);
        $info['OTM'] = round($info['OTM']/60,2);
        return $info;
    }
    //获取请假信息
    public function requestBidLeaveTime($bid, $date,$role)
    {
        $ymd = $this->processDate($date);
        if($role == 'beautician') {
            $info = $this->Beautician_model->requestBidLeaveTime($bid, $ymd);
        }else{
            $info = $this->Beautician_model->consultantBidLeaveTime($bid, $ymd);
        }
        foreach($info as $k => $v){
            $info[$k]['stime'] = date('Y-m-d H:i',$v['stime']);
            $info[$k]['ott']   = round($v['ott']/60,2);
            $info[$k]['otm']   = round($v['otm']/60,2);
            $info[$k]['time']  = round($v['time']/60,2);
            $info[$k]['type']  = $this->processType($v['type']);
        }
        return $info;
    }
    //获取请假总时长
    public function requestBidLeaveTimeTotal($bid, $date,$role)
    {
        $ymd = $this->processDate($date);
        if($role == 'beautician') {
            $info = $this->Beautician_model->requestBidLeaveTimeTotal($bid, $ymd);
        }else{
            $info = $this->Beautician_model->consultantBidLeaveTimeTotal($bid, $ymd);
        }
        $info['OTT'] = round($info['OTT']/60,2);
        $info['OTM'] = round($info['OTM']/60,2);
        $info['ltime'] = round($info['ltime']/60,2);
        return $info;
    }
    //日期
    public function processDate($date)
    {
        $arr = explode('-',$date);
        $month = strlen($arr[1])<2 ? '0'.$arr[1] : $arr[1];
        $ymd = $arr[0].'-'.$month;
        return $ymd;
    }
    //类型
    public function processType($type)
    {
        $str = '';
        if($type == 1){
            $str = '请假';
        }else if($type == 2){
            $str = '培训';
        }else if($type == 3){
            $str = '活动';
        }else{
            $str = '未知';
        }
        return $str;
    }

    public function getSchedultype($bid){
        $beautician = $this->Beautician_model->oneBybid($bid);
        $sid = $beautician['sid'];
        $data['schedultype']=$this->Beautician_model->getSchedulType($sid);
        $data['bid'] = $beautician['bid'];
        return $data;
    }

    public function getSchedulInfo($bid,$time){
        $beautician = $this->Beautician_model->oneBybid($bid);
        $data['bid']=$beautician['beauticianid'];
        $data['date']=$time;
        $SchedulInfo = $this->Beautician_model->getSchedulInfo($data);
        return $SchedulInfo;
    }

}