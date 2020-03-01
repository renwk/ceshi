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
        }  .scheduling_check{
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
    </style>
</head>
<body class="p12">
<div class="con_box me_list"></div>
<div class="table-responsive statistical">
    <table class="table table-striped">
        <tr>
            <th>姓名</th>
            <th>上钟工时</th>
            <th>排名</th>
        </tr>
        <?php foreach($info as $k => $v):?>
            <tr>
                <td><?php echo $v['name'] ;?></td>
                <td><?php echo $v['total'] ;?></td>
                <td><?php echo ($k+1) ;?></td>
            </tr>
          <?php endforeach;?>
    </table>
</div>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>"></script>
</body>
</html>