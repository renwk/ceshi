<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>iSpa泰美好</title>
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'js/bootstrap/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/weui.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/base.css'?>">
    <style>
        .head_info{
            position: relative;
            overflow: hidden;
        }
        .head_info .user_pic{
            float: left;
            width: 88px;
            border-radius: 99px;
        }
        .head_info .info_main{
            margin-top: 7px;
            margin-left: 23px;
            float: left;
            line-height: 38px;
            font-size: 18px;
        }
        .head_info .info_main .mobile{
            padding-left: 26px;
            background: url("<?php echo __PUBLIC__.'./img/mobile.png'?>") no-repeat left center;
            color: #333;
        }
        .head_info .user_set{
            display: inline-block;
            width: 21px;
            height: 22px;
            background: url("<?php echo __PUBLIC__.'./img/set_icon.png'?>") no-repeat;
        }
        
        @-moz-document url-prefix() {
        fieldset { display: table-cell; }
        }
        .statistical .table{
            font-size: 12px;
        }
        .statistical .table>tbody>tr>th,
        .statistical .table>tbody>tr>td{
            padding-left: 0;
            padding-right: 0;
        }
        .statistical .table>tbody>tr>th{
            border-right: none;
        }
        .statistical .table>tbody>tr>td{
            padding-top: 2px;
            padding-bottom: 2px;
        }
        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #fff;
        }
        /* 搜索框 */
        .scheduling_check{
            overflow: hidden;
        }
        .scheduling_check input{
            float: left;
            border: 1px solid #a6a6a6;
            padding:0 12px;
            width: calc(100% - 84px);/*72 + 10*/
            line-height: 34px;
            border-radius: 6px;
        }
        .scheduling_check .btn{
            float: right;
            padding: 0;
            display: inline-block;
            width: 72px;
            line-height: 36px;
            border: none;
            background: #cfba93;
            border-radius: 6px;
            font-size: 16px;
        }
        /* 排班时间 */
        .status_mshift{
            background: #e94d3e;
        }
        .status_rest{
            background: #cfba93;
        }
        .statistical td span{
            display: inline-block;
            width: 24px;
            height: 24px;
            line-height: 24px;
        }
        .statistical .status_mshift,
        .statistical .status_rest{
            border-radius: 99px;
            color: #fff;
        }
        /* 排班列表 */
        .status_list{
            overflow: hidden;
        }
        .status_list>div{
            float: right;
            margin-left: 24px;
        }
        .status_list i{
            display: inline-block;
            margin-right: 12px;
            width: 20px;
            height: 12px;
        }
        /* 隐藏日 */
        .weui-animate-slide-up .weui-picker__group:last-child{
            display: none !important;
        }
    </style>
</head>
<body class="p12">
<div class="con_box">
    <div class="scheduling_check">
        <input type="hidden" id="bid" value="<?php echo $bid;?>">
        <input type="text" class="date_scheduling" id="time" value="<?php echo date('Y-n');?>" readonly = "readonly">
        <a href="javascript:;" class="btn" onclick="scheduling()">查询</a>
    </div>
</div>
<div class="table-responsive statistical">
    <table class="table table-striped">
        <tbody id="schedul">
        <?php
        $year=date('Y');
        $month=date('m');
        $days=date('t',strtotime("{$year}-{$month}-1"));
        $week=date('w',strtotime("{$year}-{$month}-1"));
        echo "<tr><th>星期日</th><th>星期一</th><th>星期二</th><th>星期三</th><th>星期四</th><th>星期五</th><th>星期六</th></tr>";
        for($i=1-$week;$i<=$days;){
            echo "<tr>";
            for($j=0;$j<7;$j++){
                if($i>$days || $i<=0){
                    echo "<td><span>&nbsp;</span></td>";
                }else{
                    echo "<td><span>{$i}</span></td>";
                }
                $i++;
            }
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<div class="status_list">

    <?php foreach ($schedultype as $val): ?>
        <div class="color-colorful" style=' float: left'>
            <div class="color-font" style='height: 15px; width: 40px;  float: left;display: block ; margin-top: -2px; padding-bottom: 30px;'><?php echo $val['config_description']; ?></div>
            <div  style="height: 15px; width: 30px;float: left; margin-right:20px; background-color:<?php echo $val['config_note']; ?>"></div>
        </div>
    <?php endforeach; ?>
</div>

<script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>"></script>
<script type="text/javascript">
function dateSelect(touch_class,bengin_date=2000)
{
    $("."+touch_class).click(function(){
        var d     = new Date();
        //var day   = d.getDate()
        var month = d.getMonth() + 1
        var year  = d.getFullYear()
    
        weui.datePicker({
            start: bengin_date,
            end: year,
            // cron:'1-10 * *',
            defaultValue: [year, month, 1],
            // cron: '1-10 * *',  // 每月1日-10日
            onChange: function(result){
                
            },
            onConfirm: function(result){
                $("."+touch_class).val(result[0]+'-'+result[1]);
            },
            id: 'doubleLinePicker'
        });

        //移除日选择
        $(".weui-animate-slide-up").find(".weui-picker__group:last").hide();
    })
    
}
//开始时间选择
dateSelect('date_scheduling');

    $(function () {
        scheduling();
    });

    function scheduling() {
        var time = $('#time').val();
        var bid = $('#bid').val();

        var url = "<?php echo site_url('beauticiansort/showscheduling'); ?>";
        data={
            'time': time,
            'bid':  bid
        };
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (data) {
                if(data.msg=='success'){
                    $('#schedul').html(data.data);
                }
            }
        })

    }
</script>
</body>
</html>