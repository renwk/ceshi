<?php
class Index extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * index
     * @param  openid;
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function Appindex(){
//        $openid = $_POST('openid');

        $openid = $this->input->post_get('openid');
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;

        $data=array();
        if(isset($openid)){
            $this->load->service('user_service');
            $wechat = $this->user_service->oneShopWechatByOpenid($openid,'app');

            if($wechat['msg'] == 'success'){

                if(!empty($wechat['data']['mobile'])) {

                    $datas = $this->user_service->getAppUserInfo($openid);//用户详情


                    if ($datas['role'] == 'operator') { //非店面员工
                        $datas = $this->user_service->getInfo($openid, 'info');
                        $datas['code'] = 'info';

                        $data['status'] = true;
                        $data['msg'] = '非店面员工';
                        $data['data'] = $datas;
                    } else {
                        if($datas['role'] == 'beautician'){
                            $bid = $datas['info']['beauticianid'];
                            $type = 0;
                        }elseif ($datas['role'] == 'consultant'){
                            $bid = $datas['info']['id'];
                            $type = 1;
                        }else{
                            $bid = 0;
                        }
                        $time = mktime(0,0,0,date('m'),date('d'),date('Y'));

                        $res = $this->user_service->getgradechange($type,$bid,$time);
                        if(!empty($res) && !empty($res['grades'])){
                            $datas['gradecharge'] = $res;
                            $datas['info']['time'] = date("Y-m-d");
                        }else{
                            $datas['gradecharge'] = null;
                        }
                        $brithdaystr = date("Y-m-d",$datas['info']['brithday']);
                        $ymdstr = substr($brithdaystr,5);
                        $year = date('Y');
                        $brithday = $year."-".$ymdstr;
                        $brithtime = strtotime($brithday);
                        if($beginToday<=$brithtime && $endToday>$brithtime){
                            $datas['info']['brith'] = 1;
                            $count = floor((time()-$datas['info']['jointime'])/31536000);
                            $datas['info']['brithcount'] = $count;
                            $datas['info']['time'] = date("Y-m-d");
                        }else{
                            $datas['info']['brith'] = 0;
                        }
                        $datas['code'] = 'success';
                        $data['status'] = true;
                        $data['msg'] = 'success';
                        $data['data'] = $datas;
                    }
                }else{
                    $data['status'] = false;
                    $data['msg'] = '未绑定手机号';
                    $data['data'] = array('code'=>'login');
                }
            }elseif($wechat['msg'] == 'error_one') {

                $data['status'] = false;
                $data['msg'] = '未绑定手机号';
                $data['data'] = array('code'=>'login');
            }else{
                $data['status'] = false;
                $data['msg'] = '微信获取失败!';
                $data['data'] = array('code'=>$wechat['msg']);
            }
        }else{
            $data['status'] = false;
            $data['msg'] = '微信获取失败';
            $data['data'] = array('code'=>'error_openid');
        }

        exit(json_encode($data,true));

    }
    public function gradessent(){
        $id = $this->input->post_get('id');

        if(!empty($id)){
            $this->load->service('user_service');
            $res = $this->user_service->gradessent($id);
            $arr['status'] = true;
            $arr['msg'] = 'success';
            $arr['data'] = $res;
        }else{
            $arr['status'] = false;
            $arr['msg'] = '获取信息失败!';
            $arr['data'] = array();
        }
        exit(json_encode($arr,true));
    }
    public function brithday(){
        $sid = $this->input->post_get('sid');
        if(isset($sid)){
            $this->load->service('user_service');
            $adv = $this->user_service->getStaffBrithday($sid);
            if(empty($adv)){
                $arr['broth'] = null;
                $arr['count'] = 0;
            }else{
                $arr['broth'] = $adv;
                $arr['count'] = count($adv);
            }

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
    public function deluser(){
        $appopenid = $this->input->post_get('appopenid');
        $data = array();
        if(isset($appopenid)){
            $this->load->service('user_service');
            $res = $this->user_service->deluser($appopenid);
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $res['msg'];
        }else{
            $data['status'] = false;
            $data['msg'] = '获取信息失败!';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }
    /**
     * performanceSort
     * @param
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function performanceSort(){
        $brand = $this->input->post_get('brand');
        $sid = $this->input->post_get('sid');
        $bid = $this->input->post_get('bid');
        $role = $this->input->post_get('role');
        $monthBegin = $this->input->post_get('stime');
        $etime = $this->input->post_get('etime');

        if(isset($role) && isset($bid)){
            if(empty($monthBegin)){
                $monthBegin = mktime(8,0,0,date('m'),date('d'),date('Y'));
            }
            if(empty($etime)){
                $etime = mktime(8,0,0,date('m'),date('d')+1,date('Y'));
            }
            $this->load->service('performance_service');
            $performance = $this->performance_service->getPerformanceInfo($brand, $sid, $bid, $monthBegin,$etime, $role);
            if(!empty($performance)){
                $data['status'] = true;
                $data['msg'] = 'success';
                $data['data'] = $performance;
            }else{
                $data['status'] = false;
                $data['msg'] = '排名数据为空';
                $data['data'] = $performance;
            }
        }else{
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }

    /**
     * info
     * @param  openid;
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function info($openid = null)
    {
        if(empty($openid)){
            $openid = $this->input->post_get('openid');
        }

        if(empty($openid)){
            $data['status'] = false;
            $data['msg'] = '网络错误';
            $data['data'] = array();
        }else{
            $this->load->service('user_service');
            $employee = $this->user_service->getInfo($openid, 'app');

            if(!empty($employee)) {
                $data['status'] = true;
                $data['msg'] = 'success';
                $data['data'] = $employee;
            }else{
                $data['status'] = false;
                $data['msg'] = '获取信息失败';
                $data['data'] = $employee;
            }
        }

        exit(json_encode($data,true));
    }

    /**
     * onePerformance
     * @param  role-顾问,理疗师; bid; type-1今天,2-本月;
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function onePerformance(){

        $role = $this->input->post_get('role', true);
        $bid = $this->input->post_get('bid', true);
        $type = $this->input->post_get('type', true);
        $data = array();
        if(isset($role) || isset($bid) || isset($type)){

            if ($role == "beautician") { //理疗师
                if ($type == 1) { //今天
                    $stime = strtotime(date("Y-m-d"), time()) + 28800;
                    $etime = mktime(8, 0, 0, date('m'), date('d') + 1, date('Y'));
                    $this->load->service('performance_service');
                    $performanceDay = $this->performance_service->onePerformanceInfo($role, $bid, $stime, $etime);
                    $performanceDay['abtime']=round($performanceDay['abtime']/60,2);
                    $performanceDay['overtime']=round($performanceDay['overtime']/60,2);
                    $data['status'] = true;
                    $data['msg'] = 'success';
                    $data['data'] = $performanceDay;

                } else if ($type == 2) { //本月
                    $month = date("Y-m");
                    $stime = strtotime(date("Y-m"), time()) + 28800;
                    $etime = mktime(8, 0, 0, date('m'), date('d') + 1, date('Y'));
                    $arr = explode('-', $month);
                    $ym = $arr[0] . $arr[1];
                    $this->load->service('performance_service');
                    $performanceMonth = $this->performance_service->onePerformanceInfo($role, $bid, $stime, $etime);
                    $sumtime = $performanceMonth['rowTime'] + $performanceMonth['add_bell_time'] + $performanceMonth['spotTime'] + round($performanceMonth['abtime'] / 60, 2) + round($performanceMonth['overtime'] / 60, 2);
                    $throwntime = $this->performance_service->getThrowntime($bid, $ym);//虚拟工时
                    $target = $this->performance_service->getTargetTimeInfo($bid, $month);//目标工时
                    $performanceMonth['thrown_time'] = round($throwntime['thrown_time'], 2);
                    $performanceMonth['total_time'] = $target['total_time'];
                    $performanceMonth['sumtime'] = $sumtime;
                    $performanceMonth['percent'] = isset($target['total_time']) ? round($sumtime / $target['total_time'], 4) * 100 : 100;
                    $performanceMonth['abtime']=round($performanceMonth['abtime']/60,2);
                    $performanceMonth['overtime']=round($performanceMonth['overtime']/60,2);
                    $performanceMonth['thrown_time']=round($performanceMonth['thrown_time']/60,2);
                    $data['status'] = true;
                    $data['msg'] = 'success';
                    $data['data'] = $performanceMonth;

                }
            } else { //顾问
                if ($type == 1) { //今天
                    $stime = strtotime(date("Y-m-d"), time()) + 28800;
                    $etime = mktime(8, 0, 0, date('m'), date('d') + 1, date('Y'));
                    $this->load->service('performance_service');
                    $performanceDay = $this->performance_service->onePerformanceInfo($role, $bid, $stime, $etime);

                    $data['status'] = true;
                    $data['msg'] = 'success';
                    $data['data'] = $performanceDay;

                } else { //本月
                    $month = date("Y-m");
                    $stime = strtotime(date("Y-m"), time()) + 28800;
                    $etime = mktime(8, 0, 0, date('m'), date('d') + 1, date('Y'));
                    $arr = explode('-', $month);
                    $ym = $arr[0] . $arr[1];
                    $this->load->service('performance_service');
                    $performanceMonth = $this->performance_service->onePerformanceInfo($role, $bid, $stime, $etime);
                    $target = $this->performance_service->getTargetWaterInfo($bid, $month);//目标工时
                    $performanceMonth['flowing'] = $target['flowing'];
                    $performanceMonth['fpercent'] = isset($target['flowing']) ? round($performanceMonth['selldata']['waterMoney'] / $target['flowing'], 4) * 100 : 100;
                    $performanceMonth['server'] = $target['server'];
                    $performanceMonth['spercent'] = isset($target['server']) ? round($performanceMonth['sMoney'] / $target['server'], 4) * 100 : 100;
                    $performanceMonth['retail'] = $target['retail'];
                    $performanceMonth['rpercent'] = isset($target['retail']) ? round($performanceMonth['lMoney'] / $target['retail'], 4) * 100 : 100;

                    $data['status'] = true;
                    $data['msg'] = 'success';
                    $data['data'] = $performanceMonth;

                }

            }
        } else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }

        exit(json_encode($data,true));
    }

}