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
         height:43px;
         position: relative;
         overflow: hidden;
         padding-left: 0;
         color: #333;
         text-align: center;
     }
     .me_list_last li{
         text-align: left;
         padding-left: 18px;
     }
     .me_list li .row_title{
         display: inline-block;
         position: absolute;
         left: 18px;
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
<body class="p12">

<div class="con_box mu_head">
    <div class="user_img">
        <img src="<?php echo $wechat['headimgurl'];?>">
    </div>
    <div class="user_name">
        <?php echo $wechat['nickname'];?>（<?php if( $userinfo['sex'] == 1 ){ echo '女'; } else { echo '男';}?>）
    </div>
</div>
<div class="con_box me_list">
    <ul>
        <li>
            <span class="row_title">手机号码</span>
            <?php echo $userinfo['mobile'];?>
        </li>
        <li>
            <span class="row_title">亲情手机1</span>
            <?php echo $userinfo['backup_mobile1'];?>
        </li>
        <li>
            <span class="row_title">亲情手机2</span>
            <?php echo $userinfo['backup_mobile2'];?>
        </li>
        <li>
            <span class="row_title">生日</span>
            <?php echo $userinfo['birthday'];?>
        </li>
        <li>
            <span class="row_title">邮箱</span>
            <?php echo $userinfo['email'];?>
        </li>
        <li>
            <span class="row_title">专属顾问</span>
            <?php echo $userinfo['by_consultant'];?>
        </li>
        <li>
            <span class="row_title">专属理疗师</span>
            <?php echo $userinfo['bid'];?>
        </li>
    </ul>
</div>
<div class="con_box me_list me_list_last" >
    <ul>
        <li onclick="href('<?php echo base_url('userinfo/transactionPassword')?>')">
            支付密码
            <i class="arrow"></i>
        </li>
    </ul>
</div>

</body>
</html>