<?php
class Beauticiansort extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 我的排班
     * @param  bid, time
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function showscheduling()
    {
        $bid = $this->input->get_post('bid', true);
        $time1 = $this->input->get_post('time', true);
        if(isset($bid) && isset($time1)) {
            $time = $time1 . "-01";
            $this->load->service('beauticiansort_service');
            $arr = $this->beauticiansort_service->getSchedultype($bid);//schedultype
            $result = $this->beauticiansort_service->getSchedulInfo($bid, $time);

            $arr['show'] = $this->mkTable($time1,$result);

            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $arr;
        }else{
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }
    public function mkTable($time,$schedul){
        $year=substr($time,0,4);
        $month=rtrim(substr($time,5,2),'-');
        $days=date('t',strtotime("{$year}-{$month}-1"));
        $week=date('w',strtotime("{$year}-{$month}-1"));

        $data = array();
        $k=0;
        for($i=1-$week;$i<=$days;){

            for($j=0;$j<7;$j++){
                if($i>$days || $i<=0){
                    $data[$k][$j]['colors']="";
                    $data[$k][$j]['dayname']="";
                }else{
                    $color = $this->getCurrColor($i,$schedul);
                    if ($color) {
                        $data[$k][$j]['colors']=$color;
                        $data[$k][$j]['dayname']=$i;
                    } else {
                        $data[$k][$j]['colors']="";
                        $data[$k][$j]['dayname']=$i;
                    }

                }
                $i++;
            }
            $k++;
        }

        return $data;
    }
    public function getCurrColor($currDay, $schedul) {

        $result = '';
        foreach ($schedul as $val) {

            $a =  date('d',strtotime( $val['date']));

            if ($a == $currDay) {
                $result = $val['config_note'];
                break;
            }
        }
        return $result;
    }
    /**
     * 我的加班
     * @param  bid, role, date
     * @return json
     * @author rwk
     */
    public function requestBidInfo()
    {
        $bid = $this->input->get_post('bid',true);
        $role = $this->input->get_post('role',true);
        $date = $this->input->get_post('date',true);
        $date = empty($date) ? date('Y-m') : $date;
        if(!empty($bid) && !empty($role)){

            $this->load->service('beauticiansort_service');
            $result['info'] = $this->beauticiansort_service->requestBidOverTimeInfo($bid, $date,$role);
            //获取总时长
            $result['total_time'] = $this->beauticiansort_service->requestBidOverTimeTotal($bid, $date,$role);

            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $result;
        }else{
            $data['status'] = false;
            $data['msg'] = '信息有误请重试';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }

    /**
     * 我的P/L
     * @param  bid, role, date
     * @return json;
     * @author rwk
     */
    public function requestBidLeaveTime()
    {
        $this->load->service('beauticiansort_service');
        $bid = $this->input->get_post('bid',true);
        $role = $this->input->get_post('role',true);
        $date = $this->input->get_post('date',true);
        $date = empty($date) ? date('Y-m') : $date;
        if(!empty($bid) && !empty($role)) {

            $result['info'] = $this->beauticiansort_service->requestBidLeaveTime($bid, $date, $role);
            //获取总时长
            $result['total_time'] = $this->beauticiansort_service->requestBidLeaveTimeTotal($bid, $date, $role);

            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $result;
        }else{
            $data['status'] = false;
            $data['msg'] = '信息有误请重试';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }

    //工时排序 sid
    public function timesort()
    {
        $sid = $this->input->get_post('sid',true);
        if (!empty($sid)) {

            $this->load->service('beauticiansort_service');
            $result['info'] = $this->beauticiansort_service->requestBidHoursSort($sid);

            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $result;
        }else{
            $data['status'] = false;
            $data['msg'] = '信息有误请重试';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }
}