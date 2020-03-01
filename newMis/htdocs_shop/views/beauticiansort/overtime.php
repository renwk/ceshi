<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>iSpa泰美好</title>

    <link rel="stylesheet" href="<?php echo __PUBLIC__.'js/bootstrap/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/weui.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/base.css'?>">

   <!-- <link rel="stylesheet" href="<?php /*echo __PUBLIC__.'js/bootstrap/css/bootstrap.min.css'*/?>">
    <link rel="stylesheet" href="<?php /*echo __PUBLIC__.'css/weui.min.css'*/?>">
    <link rel="stylesheet" href="<?php /*echo __PUBLIC__.'css/base.css'*/?>">-->
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/tab.css'?>">
    <style>
        .weui-tab__content{

            /* width: 100%; */
            padding: 12px;
        }
        .weui-navbar__item{
            padding-bottom: 0;
            border-bottom: none;
            font-size: 16px;
            color: #666;
        }
        .weui-navbar__item.weui-bar__item_on{
            border-bottom-color: #fff;
            background: #fff;
            color: #666;
        }
        .weui-navbar__item span{
            display: inline-block;
            border-bottom: 2px solid #fff;
            /*padding-left: 14px;
            padding-right: 14px;*/
            min-width:82px;
            padding-bottom:11px;
            background: #fff;
            color: #666;
        }
        .weui-navbar__item.weui-bar__item_on span{
            border-bottom-color: #cfba93;
            background: #fff;
            color: #cfba93;
        }
        .weui-media-box_appmsg .weui-media-box__hd{
            margin-right: 1.5em;
            width: 72px;
            height: 72px;
            line-height: 72px;
            text-align: center;
        }
        .weui-media-box__desc{
            line-height: 28px;
        }
        .weui-panel:after{
            border-bottom:none;
        }
        .weui-media-box_appmsg .weui-media-box__thumb{
            border-radius:6px;
        }
        .weui-picker__action{
            color: #cfba93;
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
        .statistical .table>tbody>tr>th,
        .statistical .table>tbody>tr>td{
            padding-left: 0;
            padding-right: 0;
        }
        .statistical .table>tbody>tr>th{
            color: #333;
        }
        .ott_ckeck_out{
            position: fixed;
            bottom: 12px;
            left: 12px;
            width: calc(100% - 24px);
            padding: 5px 12px 6px;
            border-radius: 12px;
            background: #cfba93;
            font-size: 14px;
            color: #fff;
        }
        .ott_ckeck_out .ott_list{
            margin-top: 3px;
            overflow: hidden;
            display: flex;
            width: 100%;
        }
        .ott_ckeck_out .ott_list p{
            position: relative;
            display: block;
            margin-bottom: 0;
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
            font-size: 12px;
        }
        .weui-picker__bd .weui-picker__group:last-child{
            display: none !important;
        }
        @media screen and (min-width: 413px) {

        }
        @media screen and (min-width: 570px) {

        }
    </style>
</head>
<body>
<div class="weui-tab" id="tab_switch">
    <!--<div class="weui-navbar-wrap">-->
    <div class="weui-navbar">
        <div class="weui-navbar__item orver_time_bid"><span>我的加班</span></div>
        <div class="weui-navbar__item leave_time_bid"><span>我的P/L</span></div>
    </div>
    <!--</div>-->
    <div class="weui-tab__panel">
        <div class="weui-tab__content">
            <div class="con_box">
                <div class="scheduling_check">
                    <input type="text" class="date_scheduling" id="date" value="<?php echo date('Y-n');?>" readonly = "readonly">
                    <input type="hidden" id="bid" value="<?php echo $bid;?>">
                    <input type="hidden" id="role" value="<?php echo $role;?>">
                    <input type="hidden" id="type" value="submit ">
                    <a href="javascript:;" class="btn" id="submitinfo">查询</a>
                </div>
            </div>
            <div class="table-responsive statistical" style="margin-bottom: 60px;">
                <table class="table table-striped table_bid_overTime">
                    <tr>
                        <th>加班日期</th>
                        <th>OTT</th>
                        <th>OTM</th>
                        <th>操作人</th>
                    </tr>
                </table>
            </div>
            <div class="ott_ckeck_out">
                总计
                <div class="ott_list">
                    <p id="ott_time"></p>
                    <p id="otm_time"></p>
                </div>
            </div>
        </div>
        <div class="weui-tab__content">
            <div class="con_box">
                <div class="scheduling_check">
                    <input type="hidden" id="bid_l" value="<?php echo $bid;?>">
                    <input type="hidden" id="role_l" value="<?php echo $role;?>">
                    <input type="text" class="date_scheduling" id="date_l" value="<?php echo date('Y-n');?>" readonly = "readonly">
                    <a href="javascript:;" class="btn" id="submitinfo_l">查询</a>
                </div>
            </div>
            <div class="table-responsive statistical" style="margin-bottom: 60px;">
                <table class="table table-striped table_bid_leaveTime">
                    <tr>
                        <th>请假类型</th>
                        <th>开始时间</th>
                        <th>时长</th>
                        <th>消耗OTT</th>
                        <th>消耗OTM</th>
                        <th>操作人</th>
                    </tr>
                </table>
            </div>
            <div class="ott_ckeck_out">
                总计
                <div class="ott_list">
                    <p class="bid_lever_time">总时长：0小时</p>
                    <p class="bid_lever_otm">OTM：0小时</p>
                    <p class="bid_lever_ott">OTT：0小时</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/bootstrap/js/bootstrap.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>

<script>

    weui.tab('#tab_switch',{
        defaultIndex: 0,
        onChange: function(index){
            //console.log(index);
        }
    });

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

        })

    }

    //开始时间选择
    dateSelect('date_scheduling');

    $(function(){
        $('#submitinfo').click();
    });
    $('.orver_time_bid').click(function(){
        $('#submitinfo').click();
    });
    $('.leave_time_bid').click(function(){
        $('#submitinfo_l').click();
    });

    $('#submitinfo').click(function () {
        var bid = $('#bid').val();
        var role = $('#role').val();
        var date = $('#date').val();
        $.ajax({
            type: "post",
            url : "<?php echo site_url().'/beauticiansort/requestBidInfo'; ?>",// 跳转到 action
            data: {'bid': bid,'date' : date,'role': role},
            dataType: "json",
            cache:false,
            success:function(msg) {
                $('.bid_list').remove();
                var str = '';
                for(var i = 0; i < msg[0].length; i++){
                    str +="<tr class='bid_list'><td>"+ msg[0][i]['otime_date'] +"</td><td>"+ msg[0][i]['ott_time'] +"</td><td>"+ msg[0][i]['otm_time'] +"</td><td>"+ msg[0][i]['username'] +"</td></tr>";
                }
                $('.table_bid_overTime tr').after(str);
                $('#ott_time').text('OTT：'+ msg[1]['OTT'] +'小时');
                $('#otm_time').text('OTM：'+ msg[1]['OTM'] +'小时');
            }
        });
    });
    $('#submitinfo_l').click(function(){
        var bid = $('#bid_l').val();
        var role = $('#role_l').val();
        var date = $('#date_l').val();
        $.ajax({
            type: "post",
            url : "<?php echo site_url().'/beauticiansort/requestBidLeaveTime'; ?>",// 跳转到 action
            data: {'bid': bid,'date' : date,'role': role },
            dataType: "json",
            cache:false,
            success:function(msg) {
                 $('.bid_list_l').remove();
                 var str = '';
                 for(var i = 0; i < msg[0].length; i++){
                     str +="<tr class='bid_list_l'><td>"+ msg[0][i]['type'] +"</td><td>"+ msg[0][i]['stime'] +"</td><td>"+ msg[0][i]['time'] +"</td><td>"+ msg[0][i]['ott'] +"</td><td>"+ msg[0][i]['otm'] +"</td><td>"+ msg[0][i]['username'] +"</td></tr>";
                 }
                 $('.table_bid_leaveTime tr').after(str);
                $('.bid_lever_time').text('总时长：'+ msg[1]['ltime'] +'小时');
                $('.bid_lever_ott').text('OTT：'+ msg[1]['OTT'] +'小时');
                $('.bid_lever_otm').text('OTM：'+ msg[1]['OTM'] +'小时');
            }
        });
    });
</script>
<script type="text/javascript">

</script>
</body>
</html>