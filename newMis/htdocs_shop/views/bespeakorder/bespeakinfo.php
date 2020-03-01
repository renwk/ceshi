<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>iSpa泰美好</title>
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'js/bootstrap/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/weui.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/base.css'?>">
    <script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>
    <script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>"></script>
    <script type="text/javascript" src="<?php echo __PUBLIC__.'js/bootstrap/js/bootstrap.min.js'?>"></script>
    <style>
        .con_box{
            padding-top: 0;
            padding-bottom: 0;
        }
        .list_box{
            margin-bottom:0;
            list-style: none;
            font-size:16px;
            color: #333;
        }
        .list_box li{
            height: 36px;
            line-height: 36px;
        }
        .list_box li span{
            display: inline-block;
            width:102px;
            color: #666;
        }
    </style>
</head>
<body class="p12">
    <div class="con_box">
        <ul class="list_box">
            <?php if($role != "beautician"):?>
            <li>
                <span>手机号</span>
                <?php echo $info['mobile']?>
            </li>
            <?php endif?>
            <li>
                <span>姓名</span>
                <?php echo $info['nickname']?>
            </li>
            <li>
                <span>性别</span>
                <?php if($info['sex']=="user_sex_man"):?> 男
                <?php else:?> 女
                <?php endif?>
            </li>
        </ul>
    </div>
    <div class="con_box">
        <ul class="list_box">
            <li>
                <span>预约单号</span>
                <?php echo $info['order_code']?>
            </li>
            <li>
                <span>预约时间</span>
                <?php echo $info['y_time']?>
            </li>
            <li>
                <span>预约时长</span>
                <?php echo $info['iusetime']?> 分钟
            </li>
            <li>
                <span>服务顾问</span>
                <?php echo $info['a_name']?>
            </li>
            <li>
                <span>服务理疗师</span>
                <?php echo $info['b_name']?>
            </li>
            <li>
                <span>预约房间</span>
                <?php echo $info['s_name']?>
            </li>
        </ul>
    </div>


</body>
</html>