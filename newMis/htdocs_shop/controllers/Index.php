<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {

		$data = array();
        $this->load->service('user_service');
        $openid = $this->wechat['openidshop'];

        $wechat = $this->user_service->oneShopWechatByOpenid($openid);
        if(empty($wechat['data']['mobile'])){
            redirect('login/index');
        }else {
            $data['wechat'] = $wechat['data'];
            $datas = $this->user_service->getUserInfo($openid);
            if (!empty($data) && !empty($datas)) {
                $arr = array_merge($data, $datas);
            } else {
                $arr = $data;
            }
            if ($arr['role'] == 'operator') {
                $this->info();
            }else{
                $this->load->view('glob/header.php');
                $this->load->view('index/index', $arr);
                $this->load->view('glob/footer.php');
            }
        }
	}
	//个人信息
	public function info(){
        $openid = $this->wechat['openidshop'];

        $this->load->service('user_service');
        $employee = $this->user_service->getInfo($openid,'info');

        $this->load->view('glob/header.php');
        $this->load->view('index/info', $employee);
        $this->load->view('glob/footer.php');
    }

    public function performanceSort(){
        $brand = $this->input->post_get('brand', true);
        $sid = $this->input->post_get('sid', true);
        $bid = $this->input->post_get('bid', true);
//        $monthBegin = $this->input->post_get('time', true);
        $role = $this->input->post_get('role', true);
        $monthBegin=mktime(8,0,0,date('m'),1,date('Y'));

        $this->load->service('performance_service');
        $performance = $this->performance_service->getPerformanceInfo($brand,$sid,$bid,$monthBegin,$role);

        $html = "";
        if ( $role == 'consultant' || $role == 'manage'){
            $html.="<tr><td>流水</td><td>".sprintf("%.2f", $performance['waterMoney']['waterMoney'])."</td>";
            $html.="<td>第".($performance['waterMoney']['store'])."名</td>";
            $html.="<td>第".($performance['waterMoney']['brand'])."名</td></tr>";

            $html.= "<tr><td>服务</td><td>".sprintf("%.2f", $performance['serviceMoney']['sMoney'])."</td>";
            $html.="<td>第".($performance['serviceMoney']['store'])."名</td>";
            $html.="<td>第".($performance['serviceMoney']['brand'])."名</td></tr>";

            $html.= "<tr><td>零售</td><td>".sprintf("%.2f", $performance['lMoney']['money'])."</td>";
            $html.="<td>第".($performance['lMoney']['store'])."名</td>";
            $html.="<td>第".($performance['lMoney']['brand'])."名</td></tr>";

            $html.= "<tr><td>售卡</td><td>".sprintf("%.2f", $performance['card']['money'])."</td>";
            $html.="<td>第".($performance['card']['store'])."名</td>";
            $html.="<td>第".($performance['card']['brand'])."名</td></tr>";
            if ( $role == 'consultant'){
                $html.= "<tr><td>人数</td><td>".$performance['receptionNum']['num']."</td>";
                $html.="<td>第".($performance['receptionNum']['store'])."名</td>";
                $html.="<td>第".($performance['receptionNum']['brand'])."名</td></tr>";
            }
        }elseif( $role == 'beautician' ){
            $html.= "<tr><td>工时(h)</td><td>".round($performance['Sumtime']['SumTime']/60 ,2)."</td>";
            $html.="<td>第".($performance['Sumtime']['store'])."名</td>";
            $html.="<td>第".($performance['Sumtime']['brand'])."名</td></tr>";

            $html.= "<tr><td>零售</td><td>".sprintf("%.2f", $performance['lMoney']['money'])."</td>";
            $html.="<td>第".($performance['lMoney']['store'])."名</td>";
            $html.="<td>第".($performance['lMoney']['brand'])."名</td></tr>";

            $html.= "<tr><td>售卡</td><td>".sprintf("%.2f", $performance['card']['money'])."</td>";
            $html.="<td>第".($performance['card']['store'])."名</td>";
            $html.="<td>第".($performance['card']['brand'])."名</td></tr>";
        }

        echo json_encode(returnMsg('success',$html));

    }
    public function onePerformance(){
//        $this->load->service('performance_service');
        $role = $this->input->post_get('role', true);
        $bid = $this->input->post_get('bid', true);
        $type = $this->input->post_get('type', true);
        if($role == "beautician"){
        if($type == 1 ){
            $stime = strtotime(date("Y-m-d"),time()) + 28800;
            $etime=mktime(8,0,0,date('m'),date('d')+1,date('Y'));
            $this->load->service('performance_service');
            $performanceDay = $this->performance_service->onePerformanceInfo($role,$bid,$stime,$etime);
            $html = $this->mkTable($performanceDay,'day');
            echo json_encode(returnMsg('success',$html));

        }else if($type == 2 ){
            $month = date("Y-m");
            $stime = strtotime(date("Y-m"),time()) + 28800;
            $etime=mktime(8,0,0,date('m'),date('d')+1,date('Y'));
            $arr = explode('-',$month);
            $ym = $arr[0].$arr[1];
            $this->load->service('performance_service');
            $performanceMonth = $this->performance_service->onePerformanceInfo($role,$bid,$stime,$etime);
            $sumtime = $performanceMonth['rowTime']+$performanceMonth['add_bell_time']+$performanceMonth['spotTime']+round($performanceMonth['abtime']/60,2)+round($performanceMonth['overtime']/60,2);
            $throwntime = $this->performance_service->getThrowntime($bid,$ym);//虚拟工时
            $target = $this->performance_service->getTargetTimeInfo($bid,$month);//目标工时
            $performanceMonth['thrown_time'] = round($throwntime['thrown_time'],2);
            $performanceMonth['total_time'] = $target['total_time'];
            $performanceMonth['sumtime'] = $sumtime;
            $performanceMonth['percent'] = isset($target['total_time'])? round($sumtime/$target['total_time'],4)*100: 100 ;
            $html = $this->mkTable($performanceMonth,'month');

            echo json_encode(returnMsg('success',$html));

        }
        }else{
            if($type == 1 ) {
                $stime = strtotime(date("Y-m-d"), time()) + 28800;
                $etime = mktime(8, 0, 0, date('m'), date('d') + 1, date('Y'));
                $this->load->service('performance_service');
                $performanceDay = $this->performance_service->onePerformanceInfo($role, $bid, $stime, $etime);

                $html = $this->mkconsultantTable($performanceDay,'day');

                echo json_encode(returnMsg('success',$html));
            }else{
                $month = date("Y-m");
                $stime = strtotime(date("Y-m"),time()) + 28800;
                $etime=mktime(8,0,0,date('m'),date('d')+1,date('Y'));
                $arr = explode('-',$month);
                $ym = $arr[0].$arr[1];
                $this->load->service('performance_service');
                $performanceMonth = $this->performance_service->onePerformanceInfo($role,$bid,$stime,$etime);
                $target = $this->performance_service->getTargetWaterInfo($bid,$month);//目标工时
                $performanceMonth['flowing'] = $target['flowing'];
                $performanceMonth['fpercent'] = isset($target['flowing'])? round($performanceMonth['selldata']['waterMoney']/$target['flowing'],4)*100: 100;
                $performanceMonth['server'] = $target['server'];
                $performanceMonth['spercent'] = isset($target['server'])? round($performanceMonth['sMoney']/$target['server'],4)*100: 100;
                $performanceMonth['retail'] = $target['retail'];
                $performanceMonth['rpercent'] = isset($target['retail'])? round($performanceMonth['lMoney']/$target['retail'],4)*100: 100;
                $html = $this->mkconsultantTable($performanceMonth,'month');
                echo json_encode(returnMsg('success',$html));
            }

        }


    }
    public function mkTable($data,$type){
        $html = "";
        $html.="<h2 class='statistical_title'>工时信息</h2><div class='table-responsive statistical'>";
        $html.="<table class='table table-striped'><tr><th>工时类型</th><th>时长(h)</th><th>人数</th></tr>";
        $html.="<tr><td>排钟</td><td>".$data['rowTime']."</td><td>".$data['rowNum']."</td></tr>";
        $html.="<tr><td>加钟</td><td>".$data['add_bell_time']."</td><td>".$data['bell_num']."</td></tr>";
        $html.="<tr><td>点钟</td><td>".$data['spotTime']."</td><td>".$data['spotNum']."</td></tr>";
        $html.="<tr><td>加钟奖励</td><td>".round($data['abtime']/60,2)."</td><td>".$data['numab']."</td></tr>";
        $html.="<tr><td>加班奖励</td><td>".round($data['overtime']/60,2)."</td><td>".$data['num_over']."</td></tr>";
        $html.="</table></div>";
        if($type == 'month'){
            $html.="<div style='margin-bottom:5px;'>虚拟工时：".round($data['thrown_time']/60,2)." h</div>";
        }
        $html.="<h2 class='statistical_title'>评价信息</h2><div class='table-responsive statistical'>";
        $html.="<table class='table table-striped'><tr><th>E4</th><th>E3</th><th>E2</th><th>E1</th><th>G</th><th>A</th><th>P</th></tr>";
        $html.="<tr><td>".$data['levlNumE4']."</td><td>".$data['levlNumE3']."</td><td>".$data['levlNumE2']."</td><td>".$data['levlNumE1']."</td>";
        $html.="<td>".$data['levlNumG']."</td><td>".$data['levlNumA']."</td><td>".$data['levlNumP']."</td></tr>";
        $html.="</table></div>";
        $html.="<h2 class='statistical_title'>销售信息</h2><div class='table-responsive statistical'>";
        $html.="<table class='table table-striped'><tr><th>项目类型</th><th>金额</th></tr>";
        $html.="<tr><td>产品</td><td>".sprintf("%.2f", $data['selldata']['pMoney'])."</td></tr>";
        $html.="<tr><td>储值卡</td><td>".sprintf("%.2f", $data['selldata']['balanceMoney'])."</td></tr>";
        $html.="<tr><td>常规金</td><td>".sprintf("%.2f", $data['selldata']['commonMoney'])."</td></tr>";
        $html.="<tr><td>疗程卡</td><td>".sprintf("%.2f", $data['selldata']['otherMoney'])."</td></tr>";
        $html.="<tr><td>礼券卡</td><td>".sprintf("%.2f", $data['selldata']['ucardGiftMoney'])."</td></tr>";
        $html.="</table></div>";
        if($type == "month"){
            $html.="<h2 class='statistical_title'>目标信息</h2><div class='table-responsive statistical'>";
            $html.="<table class='table table-striped'><tr><th>工时类型</th><th>完成工时</th><th>目标工时</th><th>目标进度</th></tr>";
            $html.="<tr><th>总工时</th><th>".$data['sumtime']."</th><th>".$data['thrown_time']."</th><th>".$data['percent']."%</th></tr>";
            $html.="</table></div>";
        }
        return $html;
    }

    public function mkconsultantTable($data,$type){
        $html = "";
        $html.= "<h2 class='statistical_title'>基础信息</h2><div style='margin-bottom:10px;'>接待人数：".$data['reception']."</div>";
        $html.="<h2 class='statistical_title'>销售信息</h2><div class='table-responsive statistical'>";
        $html.="<table class='table table-striped'><tr><th>项目类型</th><th>金额</th></tr>";
        $html.="<tr><td>储值卡</td><td>".sprintf("%.2f", $data['selldata']['balanceMoney'])."</td></tr>";
        $html.="<tr><td>常规金</td><td>".sprintf("%.2f", $data['selldata']['commonMoney'])."</td></tr>";
        $html.="<tr><td>疗程卡</td><td>".sprintf("%.2f", $data['selldata']['otherMoney'])."</td></tr>";
        $html.="<tr><td>礼券卡</td><td>".sprintf("%.2f", $data['selldata']['ucardGiftMoney'])."</td></tr>";
        $html.="</table></div>";

        $html.="<h2 class='statistical_title'>流水收入</h2><div class='table-responsive statistical'>";

        if($type =="month" ){
            $html.="<table class='table table-striped'><tr><th>项目类型</th><th>金额</th><th>目标</th><th>完成度</th></tr>";
            $html.="<tr><td>流水</td><td>".sprintf("%.2f", $data['selldata']['waterMoney'])."</td><td>".sprintf("%.2f", $data['flowing'])."</td><td>".$data['fpercent']."%</td></tr>";
            $html.="<tr><td>服务收入</td><td>".sprintf("%.2f", $data['sMoney'])."</td><td>".sprintf("%.2f", $data['server'])."</td><td>".$data['spercent']."%</td></tr>";
            $html.="<tr><td>零售收入</td><td>".sprintf("%.2f", $data['lMoney'])."</td><td>".sprintf("%.2f", $data['retail'])."</td><td>".$data['rpercent']."%</td></tr>";
            $html.="</table>";
        }else{
            $html.="<table class='table table-striped'><tr><th>项目类型</th><th>金额</th></tr>";
            $html.="<tr><td>流水</td><td>".sprintf("%.2f", $data['selldata']['waterMoney'])."</td></tr>";
            $html.="<tr><td>服务收入</td><td>".sprintf("%.2f", $data['sMoney'])."</td></tr>";
            $html.="<tr><td>零售收入</td><td>".sprintf("%.2f", $data['lMoney'])."</td></tr>";
            $html.="</table>";
        }
        $html.="</div>";
        return $html;
    }
}
