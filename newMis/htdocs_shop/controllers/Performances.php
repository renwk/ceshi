<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Performances extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $role = $_GET['id'];
        $data['role'] = $role;
        if($role == 'consultant'){
            $this->load->view('glob/header.php');
            $this->load->view('performances/myGradeStaff', $data);
            $this->load->view('glob/footer.php');
        }elseif ($role == 'beautician'){
            $this->load->view('glob/header.php');
            $this->load->view('performances/myGradeBeautician', $data);
            $this->load->view('glob/footer.php');
        }

    }

    public function historygrade(){
        $role = $_GET['id'];
        $data['role'] = $role;
        $data = array();
        if($role == 'consultant'){
            $this->load->view('glob/header.php');
            $this->load->view('performances/historyGradeStaff', $data);
            $this->load->view('glob/footer.php');
        }elseif ($role == 'beautician'){
            $this->load->view('glob/header.php');
            $this->load->view('performances/historyGradeBeautician', $data);
            $this->load->view('glob/footer.php');
        }
    }
    public function performanceInfo(){
        $role = $this->input->post_get('role', true);
        $time = $this->input->post_get('time', true);

        $bid = $this->user['iduu'];

        if(strlen($time)<6) {
            $datetime = date('Y') . "." . $time;
            $datetime = str_replace('.', '/', $datetime);
            $stime = empty(strtotime($datetime)) ? time() : strtotime($datetime)+28800;
        }else{
            $stime = strtotime($time)+28800;
        }

        $etime = $stime+86400;
        $this->load->service('performance_service');
        $data = array();
        $Money = $this->performance_service->onePerformanceInfo($role,$bid,$stime,$etime);

        if($role == 'consultant'){
            $html = $this->mkconsultantTable($Money);
        }elseif ($role == 'beautician'){
            $html = $this->mkbeauticiantable($Money);
        }

        echo json_encode(returnMsg('success',$html));
    }

    public function mkbeauticiantable($Money){
        $html = "";
        $html.="<div class='con_box'><h2 class='statistical_title'>工时信息</h2><div class='table-responsive statistical'><table class='table table-striped'>";
        $html .="<tr><th>工时类型</th><th>时长(h)</th><th>人数</th></tr>";
        $html.="<tr><td>排钟</td><td>".$Money['rowTime']."</td><td>".$Money['rowNum']."</td></tr>";
        $html.="<tr><td>加钟</td><td>".$Money['add_bell_time']."</td><td>".$Money['bell_num']."</td></tr>";
        $html.="<tr><td>点钟</td><td>".$Money['spotTime']."</td><td>".$Money['spotNum']."</td></tr>";
        $html.="<tr><td>加钟奖励</td><td>".round($Money['abtime']/60,2)."</td><td>".$Money['numab']."</td></tr>";
        $html.="<tr><td>加班奖励</td><td>".round($Money['overtime']/60,2)."</td><td>".$Money['num_over']."</td></tr></table></div>";

        $html.="<h2 class='statistical_title'>评价信息</h2><div class='table-responsive statistical'><table class='table table-striped'>";
        $html.="<tr><th>评价类型</th><th>评价数量</th></tr>";
        $html.="<tr><td>E4</td><td>".$Money['levlNumE4']."</td></tr>";
        $html.="<tr><td>E3</td><td>".$Money['levlNumE3']."</td></tr>";
        $html.="<tr><td>E2</td><td>".$Money['levlNumE2']."</td></tr>";
        $html.="<tr><td>E1</td><td>".$Money['levlNumE1']."</td></tr>";
        $html.="<tr><td>G</td><td>".$Money['levlNumG']."</td></tr>";
        $html.="<tr><td>A</td><td>".$Money['levlNumA']."</td></tr>";
        $html.="<tr><td>P</td><td>".$Money['levlNumP']."</td></tr>";
        $html.="</table></div>";

        $html.="<h2 class='statistical_title'>销售信息</h2><div class='table-responsive statistical'><table class='table table-striped'>";
        $html.="<tr><th>项目类型</th><th>金额</th></tr>";
        $html.="<tr><td>产品</td><td>".sprintf("%.2f", $Money['selldata']['pMoney'])."</td></tr>";
        $html.="<tr><td>储值卡</td><td>".sprintf("%.2f", $Money['selldata']['balanceMoney'])."</td></tr>";
        $html.="<tr><td>常规金</td><td>".sprintf("%.2f", $Money['selldata']['commonMoney'])."</td></tr>";
        $html.="<tr><td>疗程卡</td><td>".sprintf("%.2f", $Money['selldata']['otherMoney'])."</td></tr>";
        $html.="<tr><td>礼券卡</td><td>".sprintf("%.2f", $Money['selldata']['ucardGiftMoney'])."</td></tr>";
        $html.="<tr><td>资格卡</td><td>".sprintf("%.2f", $Money['selldata']['titlecardMoney'])."</td></tr>";
        $html.="</table></div></div>";
        return $html;
    }
    public function mkconsultantTable($Money){
        $html ="";
        $html.="<div class='con_box'><h2 class='statistical_title'>流水收入信息</h2><div class='table-responsive statistical'><table class='table table-striped'>";
        $html.="<tr><th>项目类型</th><th>金额</th></tr>";
        $html.="<tr><td>流水</td><td>".sprintf("%.2f", $Money['selldata']['waterMoney'])."</td></tr>";
        $html.="<tr><td>服务</td><td>".sprintf("%.2f", $Money['sMoney'])."</td></tr>";
        $html.="<tr><td>零售</td><td>".sprintf("%.2f", $Money['lMoney'])."</td></tr>";
        $html.="</table></div>";

        $html.="<h2 class='statistical_title'>销售信息</h2><div class='table-responsive statistical'><table class='table table-striped'>";
        $html.="<tr><th>项目类型</th><th>金额</th></tr>";
        $html.="<tr><td>储值卡</td><td>".sprintf("%.2f", $Money['selldata']['balanceMoney'])."</td></tr>";
        $html.="<tr><td>常规金</td><td>".sprintf("%.2f", $Money['selldata']['commonMoney'])."</td></tr>";
        $html.="<tr><td>疗程卡</td><td>".sprintf("%.2f", $Money['selldata']['otherMoney'])."</td></tr>";
        $html.="<tr><td>礼券卡</td><td>".sprintf("%.2f", $Money['selldata']['ucardGiftMoney'])."</td></tr>";
        $html.="<tr><td>资格卡</td><td>".sprintf("%.2f", $Money['selldata']['titlecardMoney'])."</td></tr>";
        $html.="</table></div></div>";

        return $html;
    }



}

