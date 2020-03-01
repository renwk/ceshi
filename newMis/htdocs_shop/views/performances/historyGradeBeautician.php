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
            /*display: none !important;*/
        }
    </style>
</head>
<body class="p12">
<div class="con_box">
    <div class="scheduling_check">
        <input type="hidden" id="role" value="beautician">
        <input type="text" class="date_scheduling" id="time" value="<?php echo date('Y-m-d',time());?>" readonly = "readonly">
        <a href="javascript:;" class="btn">查询</a>
    </div>
</div>
<div id="box">

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
            var day   = d.getDate()
            var month = d.getMonth() + 1
            var year  = d.getFullYear()

            weui.datePicker({
                start: bengin_date,
                end: year,
                // cron:'1-10 * *',
                defaultValue: [year, month, day],
                // cron: '1-10 * *',  // 每月1日-10日
                onChange: function(result){

                },
                onConfirm: function(result){
                    $("."+touch_class).val(result[0]+'-'+result[1]+'-'+result[2]);
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
    $(".btn").click(function () {
        performance();
    })
    function performance() {
        var day = $("#time").val();
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
                    $('#box div').remove();
                    $('#box').append(msg.data);
                }else{
                    $('#box').append('请刷新重试');
                }
            }
        })
    }
</script>
</body>
</html>