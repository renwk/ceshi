<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class beauticiansort extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $sid = $_GET['sid'];
        if(empty($sid) ){
            die('信息有误 , 请联系管理员!');
        }
        $this->load->service('beauticiansort_service');
        $data = array();
        $data['info'] = $this->beauticiansort_service->requestBidHoursSort($sid);
        $this->load->view('beauticiansort/list', $data);
    }
    //获取理疗师单独加班休息信息
    public function oneBidInfo()
    {
        $role = $_GET['id'];
        $bid = $this->user['iduu'];
        if(empty($bid)){
            die('信息有误 , 请联系管理员!');
        }
        $data = array();
        $data['bid'] = $bid;
        $data['role'] = $role;
        $this->load->view('beauticiansort/overtime', $data);
    }

    public function requestBidInfo()
    {
        $this->load->service('beauticiansort_service');
        $bid = $this->input->post('bid',true);
        $role = $this->input->post('role',true);
        $date = $this->input->post('date',true);
        $date = empty($date) ? date('Y-m') : $date;
        if(empty($bid)){
            die('信息有误 , 请联系管理员!');
        }
        $info = $this->beauticiansort_service->requestBidOverTimeInfo($bid, $date,$role);
        //获取总时长
        $total_time = $this->beauticiansort_service->requestBidOverTimeTotal($bid, $date,$role);
        echo json_encode(array($info,$total_time));
    }

    public function requestBidLeaveTime()
    {
        $this->load->service('beauticiansort_service');
        $bid = $this->input->post('bid',true);
        $role = $this->input->post('role',true);
        $date = $this->input->post('date',true);
        $date = empty($date) ? date('Y-m') : $date;
        if(empty($bid)){
            die('信息有误 , 请联系管理员!');
        }
        $info = $this->beauticiansort_service->requestBidLeaveTime($bid, $date,$role);
        //获取总时长
        $total_time = $this->beauticiansort_service->requestBidLeaveTimeTotal($bid, $date,$role);
        echo json_encode(array($info,$total_time));
    }

    public function scheduling(){
        $bid = $_GET['id'];
        $this->load->service('beauticiansort_service');
        $result = $this->beauticiansort_service->getSchedultype($bid);
        $arr = array();
        $arr['schedultype'] = $result['schedultype'];
        $arr['bid'] = $bid;
        $this->load->view('glob/header.php');
        $this->load->view('beauticiansort/myScheduling', $arr);
        $this->load->view('glob/footer.php');
    }

    public function showscheduling(){
        $bid = $this->input->post('bid',true);
        $date = $this->input->post('time',true);
        $time = $date."-01";
        $this->load->service('beauticiansort_service');
        $data = $this->beauticiansort_service->getSchedulInfo($bid,$time);
        $html = $this->mkTable($time,$data);
        echo json_encode(returnMsg('success',$html));
    }

    public function mkTable($time,$schedul){
        $html = "";
        $year=substr($time,0,4);
        $month=rtrim(substr($time,5,2),'-');
        $days=date('t',strtotime("{$year}-{$month}-1"));
        $week=date('w',strtotime("{$year}-{$month}-1"));

        $html.="<tr><th>星期日</th><th>星期一</th><th>星期二</th><th>星期三</th><th>星期四</th><th>星期五</th><th>星期六</th></tr>";


        for($i=1-$week;$i<=$days;){
            $html.="<tr>";
            for($j=0;$j<7;$j++){
                if($i>$days || $i<=0){
                    $html.="<td><span>&nbsp;</span></td>";
                }else{
                    $color = $this->getCurrColor($i,$schedul);
                    if ($color) {
                        $html .= "<td><span style='background-color:".$color."; color:#fff;border-radius: 99px;'>{$i}</span></td>";

                    } else {
                        $html .= "<td><span>{$i}</span></td>";
                    }

                }
                $i++;
            }
            $html.="</tr>";
        }

        return $html;
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
}

