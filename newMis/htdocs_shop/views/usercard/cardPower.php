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
        /* 图标 */
        .s_icon{
            margin: 0 auto 6px;
            display: block;
            width: 28px;
            height: 28px;
        }
        .icon_record{
            background: url("<?php echo __PUBLIC__.'./img/m_record.png'?>") no-repeat center;
        }
        .icon_storage{
            background: url("<?php echo __PUBLIC__.'./img/m_storage.png'?>") no-repeat center;
        }
        .icon_nostorage{
            background: url("<?php echo __PUBLIC__.'./img/m_nostorage.png'?>") no-repeat center;
        }
        .icon_power{
            background: url("<?php echo __PUBLIC__.'./img/m_power.png'?>") no-repeat left center;
        }
        .icon_special{
            background: url("<?php echo __PUBLIC__.'./img/m_special.png'?>") no-repeat center;
        }
        .icon_coupon{
            background: url("<?php echo __PUBLIC__.'./img/m_coupon.png'?>") no-repeat center;
        }
        .icon_utag{
            background: url("<?php echo __PUBLIC__.'./img/m_utag.png'?>") no-repeat center 5px;
        }
        /* 菜单 */
        .menu_list{
            overflow: hidden;
            width: 100%;
            padding-left: 8px;
            padding-right: 8px;
            padding-bottom: 0;
        }
        .menu_list .menu_one{
            float: left;
            display: block;
            width: 21%;
            margin: 0 1.5% 12px;
            padding: 10px 0 5px;
            text-align: center;
            color: #333;
            font-size: 13px;
            border-radius: 5px;
            box-shadow: 0px 3px 10px rgba(0,0,0,.1);
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
            color: #666;
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
        .select_card_wrap{
            position: relative;
            margin-bottom: 10px;

        }
        .arrow_down{
            position: absolute;
            right: 12px;
            top: 14px;
            display: block;
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 6px solid #fff;
        }
        .select_card{
            padding-left: 12px;
            width: 100%;
            line-height: 36px;
            border: none;
            border-radius: 6px;
            background: #cfba93;
            font-size: 16px;
            color: #fff;
        }
        .statistical .table>tbody>tr>th,
        .statistical .table>tbody>tr>td{
            padding-left: 0;
            padding-right: 0;
        }
    </style>
</head>
<body class="p12">
    <?php if ( !empty($mycourse_info) ):?>
    <div class="con_box me_list">
    <ul>
        <li>
            <span class="row_title">会员卡名称</span>
            <span class="roow_con"><?php echo $mycourse_info['ucard_no']?></span>
        </li>
        <li>
            <span class="row_title">会员卡状态</span>
            <span class="roow_con"><?php echo $mycourse_info['status']?></span>
        </li>
        <li>
            <span class="row_title">归属门店</span>
            <span class="roow_con"><?php echo $mycourse_info['sname']?></span>
        </li>
        <li>
            <span class="row_title">购卡时间</span>
            <span class="roow_con"><?php echo $mycourse_info['time_pay']?></span>
        </li>
        <li>
            <span class="row_title">激活时间</span>
            <span class="roow_con"><?php echo $mycourse_info['time_active']?></span>
        </li>
        <li>
            <span class="row_title">到期时间</span>
            <span class="roow_con"><?php echo $mycourse_info['time_validity']?></span>
        </li>
        <li>
            <span class="row_title">专属顾问</span>
            <span class="roow_con"><?php echo $mycourse_info['cname']?></span>
        </li>
    </ul>
</div>
    <?php else:?>
        <div class="nothing_box" style='margin-top:65px;text-align: center;'>
            <div>
                <img src="<?php echo __PUBLIC__.'img/nothing.png'?>">
            </div>
            <div class="nothing_txt" style='margin-top:70px;font-size:18px;color: #333;'>
                该会员暂无资格卡
            </div>
        </div>
    <?php endif;?>



<script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>"></script>
</body>
</html>