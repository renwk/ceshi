<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Performance extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 绩效信息
     * @param  bid, role, time
     * @return json;
     * @author rwk
     */
    public function performanceInfo(){
        $bid = $this->input->post_get('bid', true);
        $role = $this->input->post_get('role', true);
        $time = $this->input->post_get('time', true);

        if(isset($role) && isset($time) && isset($bid)) {
            if (strlen($time) < 6) {
                $datetime = date('Y') . "-" . $time;
                $datetime = str_replace('-', '/', $datetime);
                $stime = empty(strtotime($datetime)) ? time() : strtotime($datetime) + 28800;
            } else {
                $stime = strtotime($time) + 28800;
            }
            $etime = $stime + 86400;
            $this->load->service('performance_service');
            $data = array();
            $Money = $this->performance_service->onePerformanceInfo($role, $bid, $stime, $etime);

            $data['data'] = $Money;
            $data['status'] = true;
            $data['msg'] = 'success';
        }else{
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }

        exit(json_encode($data,true));

    }
}