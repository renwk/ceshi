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
        .user_img{
            text-align: center;
        }
        .user_img img{
            display: inline-block;
            width:91px;
            border-radius: 999px;
        }
        .user_name{
            margin-top:5px;
            text-align: center;
        }
        .me_list li{
                position: relative;
                overflow: hidden;
                padding-left: 0;
                color: #333;
                text-align: left;
        }
        .me_list_last li{
            text-align: left;
            padding-left: 18px;
        }
        .me_list li{
            border: none;
        }
        .me_list li .row_title{
            display: inline-block;
            left: 0px;
            padding-right: 0;
            width: 94px;
            text-align: left;
            color: #999;
        }
        .me_list li .arrow{
            position: absolute;
            right:14px;
            top:16px;
            display: inline-block;
            width:12px;
            height:12px;
            border: 1px solid #9d9d9d;
            border-left:none;
            border-bottom:none;
            transform:rotate(45deg);
        }
        .me_list li:after{
            display: none;
        }
        .mu_head{
            padding-top:20px;
        }
    </style>
</head>
<body class="p12">

<div class="con_box mu_head">
    <div class="user_img">
        <img src="<?php echo $headimgurl?>">
    </div>
    <div class="user_name">
        <?php echo $info['nickname']?>
    </div>
</div>
<div class="con_box me_list">
    <ul>
        <li>
            <span class="row_title">姓名</span>
            <span class="roow_con"><?php echo $info['nickname']?></span>
        </li>
        <li>
            <span class="row_title">手机号</span>
            <span class="roow_con"><?php echo $mobile?></span>
        </li>
        <li>
            <span class="row_title">生日</span>
            <span class="roow_con"><?php echo empty($info['brithday'])?0:date("Y-m-d",$info['brithday']); ?></span>
        </li>
        <li>
            <span class="row_title">归属门店</span>
            <span class="roow_con"><?php echo $info['sname']?></span>
        </li>
        <li>
            <span class="row_title">入职时间</span>
            <span class="roow_con"><?php echo empty($info['jointime'])?0:date("Y-m-d", $info['jointime']); ?></span>
        </li>
        <li>
            <span class="row_title">级别</span>
            <span class="roow_con"><?php echo empty($level['level_name'])? '未评级':$level['level_name'];?></span>
        </li>
    </ul>
</div>
<?php if( $role == 'beautician' ):?>
<div class="table-responsive statistical">
    <table class="table table-striped">
        <tr>
            <th>日期</th>
            <th>当前等级</th>
            <th>变更前等级</th>
            <th>变更门店</th>
        </tr>
        <tr>
            <td><?php echo date("Y-m",$level['grade_month'])?></td>
            <td><?php echo $level['level_name']?></td>
            <td><?php echo $level['level_name']?></td>
            <td><?php echo $info['sname']?></td>
        </tr>
    </table>
</div>
<?php endif;?>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>"></script>
</body>
</html>