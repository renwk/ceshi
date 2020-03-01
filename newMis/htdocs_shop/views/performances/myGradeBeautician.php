<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>iSpa泰美好</title>
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'js/bootstrap/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/weui.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/base.css'?>">
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
            /* min-width:82px; */
            width: 100%;
            padding-bottom:11px;
            background: #fff;
            color: #666;
            font-size: 14px;
        }
        .weui-navbar__item:last-child{
            font-size: 15px;
        }
        .weui-navbar__item:last-child span{
            margin-bottom: 10px;
            padding-top: 1px;
            padding-bottom: 1px;
            min-width:70px;
            border-radius: 30px;
            border-bottom-color: #cfba93 !important;
            background: #cfba93 !important;
            color: #fff !important;
            font-size: 12px;
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
        /* 表格 */
        .statistical_title{
            margin: 0 0 9px;
            padding-left: 8px;
            border-left: 4px solid #cfba93;
            font-size: 14px;
            color: #cfba93;
        }
        .statistical{
            margin-bottom: 9px;
            border: 1px solid #cfba93;
            border-radius: 8px;
        }
        .statistical:last-child{
            margin-bottom: 0;
        }
        .statistical .table>tbody>tr{
            display: flex;
            width: 100%;
        }
        .statistical .table>tbody>tr>th,
        .statistical .table>tbody>tr>td{
            padding-top: 4px;
            padding-bottom: 4px;
            padding-left: 0;
            padding-right: 0;
            position: relative;
            display: block;
            margin-bottom: 0;
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
        }
        .statistical .table>tbody>tr>th{
            border-bottom: 1px solid #cfba93;
            border-right: none;
            color: #333;
        }
        .weui-picker__bd .weui-picker__group:last-child{
            display: none !important;
        }
    </style>
</head>
<body>
<div class="weui-tab" id="tab_switch">
    <!--<div class="weui-navbar-wrap">-->
    <input type="hidden" id="role" value="<?php echo $role;?>">

    <div class="weui-navbar">
        <div class="weui-navbar__item"><span><?php echo date('m.d',time());?></span></div>
        <div class="weui-navbar__item"><span><?php echo date('m.d',time()-86400);?></span></div>
        <div class="weui-navbar__item"><span><?php echo date('m.d',time()-86400*2);?></span></div>
        <div class="weui-navbar__item"><span><?php echo date('m.d',time()-86400*3);?></span></div>

        <div class="weui-navbar__item"><span onclick="local()">历史绩效</span></div>
    </div>
    <!--</div>-->
    <div class="weui-tab__panel">
        <div class="weui-tab__content">
            <div class="con_box">
            </div>
        </div>
        <div class="weui-tab__content">
            <div class="con_box">
            </div>
        </div>
        <div class="weui-tab__content">
            <div class="con_box">
            </div>
        </div>
        <div class="weui-tab__content">
            <div class="con_box">
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

    function local(){
        var role =$("#role").val();
        var url = "<?php echo site_url('performances/historygrade'); ?>"+"?id="+role;
        window.location.href= url;
    }


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
</script>
<script type="text/javascript">
    $(function () {
        performance();
    });
    $(".weui-navbar__item").click(function () {
        performance();
    })
    function performance() {
        var day = $(".weui-bar__item_on span").html();
        var role =$("#role").val();
        var url = "<?php echo site_url('performances/performanceInfo'); ?>";
        data={
            'role':  role,
            'time':  day
        };

        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (msg) {
                if(msg.msg == 'success'){
                    $('.weui-tab__content div').remove();
                    $('.weui-tab__content').append(msg.data);
                }else{
                    $('.weui-tab__content').append('请刷新重试');
                }
            }
        })
    }

</script>
</body>
</html>