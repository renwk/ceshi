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
    </style>
</head>
<body class="p12">
<div class="con_box head_info">
    <img class="user_pic" src="<?php echo $userphoto?>">
    <div class="info_main">
        <?php echo $name?>（<?php echo $sex?>）<br>
        <a class="mobile" href="tel:<?php echo $mobile?>"><?php echo $mobile?></a>
    </div>
</div>
<div class="con_box me_list">
    <ul>
        <li>
            <span class="row_title">客户生日</span>
            <span class="roow_con"><?php echo empty($birthday) ? "无记录": $birthday;?></span>
        </li>
        <li>
            <span class="row_title">客户国籍</span>
            <span class="roow_con"><?php echo empty($country) ? "无记录": $country;?></span>
        </li>
        <li>
            <span class="row_title">创建日期</span>
            <span class="roow_con"><?php echo empty($registtime) ? "无记录": date("Y-m-d",$registtime);?></span>
        </li>
        <li>
            <span class="row_title">专属顾问</span>
            <span class="roow_con"><?php echo $consultant?></span>
        </li>
        <li>
            <span class="row_title">专属理疗师</span>
            <span class="roow_con"><?php echo $bid?></span>
        </li>
    </ul>
</div>
<div class="con_box menu_list">
    <a href="<?php echo site_url('orderlist/index'); ?>?uid=<?php echo $userid?>" class="menu_one">
        <i class="s_icon icon_record"></i>
        <span>消费记录</span>
    </a>
    <a href="<?php echo site_url('usercard/usercardInfo'); ?>?id=<?php echo $userid?>" class="menu_one">
        <i class="s_icon icon_storage"></i>
        <span>储值卡</span>
    </a>
    <a href="<?php echo site_url('usercard/mycourse'); ?>?id=<?php echo $userid?>" class="menu_one">
        <i class="s_icon icon_nostorage"></i>
        <span>常规/疗程</span>
    </a>
    <a href="<?php echo site_url('usercard/titleCard'); ?>?id=<?php echo $userid?>" class="menu_one">
        <i class="s_icon icon_power"></i>
        <span>资格卡</span>
    </a>
    <a href="<?php echo site_url('usercard/giveInfo'); ?>?id=<?php echo $userid?>" class="menu_one">
        <i class="s_icon icon_special"></i>
        <span>特殊礼遇</span>
    </a>
    <a href="<?php echo site_url('usercard/mycoupon'); ?>?id=<?php echo $userid?>" class="menu_one">
        <i class="s_icon icon_coupon"></i>
        <span>优惠券</span>
    </a>
    <a href="<?php echo site_url('usercard/mytaginfo'); ?>?id=<?php echo $userid?>" class="menu_one">
        <i class="s_icon icon_utag"></i>
        <span>会员标签</span>
    </a>
</div>

<script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>"></script>
</body>
</html>