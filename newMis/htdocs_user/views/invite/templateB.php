  <style>
        .invite_friends{
            position: relative;
            width:100%;
        }
        .invite_friends .show_new{
            border-radius: 12px;
        }
        .invite_friends .con{
            position: absolute;
            bottom:12px;
            left:12px;
            padding:12px 0 12px 12px;
            width:calc(100% - 24px);
            overflow: hidden;
            background: #fff;
            -webkit-border-radius:12px;
            -moz-border-radius:12px;
            border-radius:12px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .invite_friends .img{
            float: left;
            width:64px;
        }
        .invite_friends .info{
            float: left;
            padding-left:10px;
            font-size:14px;
        }
        .invite_friends .info h3{
            margin:0;
            font-size:14px;
        }
        .invite_friends .info p{
            margin:0;
            color: #cfba93;
        }
        .invite_friends .info div{
            margin-top: 5px;
            margin-bottom: 2px;
            color: #666;
        }
        .select_module{
            overflow: hidden;
            padding-top:12px;
        }
        .select_module .con{
            position: relative;
            float: left;
            width:50%;
            height:101px;
            padding-right:6px;
        }
        .select_module .con .img_warp{
            position: relative;
            width:auto;
        }
        .select_module .con img{
            -webkit-border-radius:14px;
            -moz-border-radius:14px;
            border-radius:14px;
        }
        .select_module .con p{
            margin:0;
            position: absolute;
            bottom:0px;
            left:0;
            width:100%;
            height:32px;
            line-height:32px;
            background: rgba(0,0,0,.1);
            text-align: center;
            color: #fff;
            font-size:12px;
        }
        .select_module .con:nth-child(2n){
            padding-right:0;
            padding-left:6px;
        }
        .btn_wrap{
            margin-top:12px;
        }
    </style>
<body class="p12">
<div class="invite_friends">
    <img class="center-block img-responsive show_new" id="module_show" src="<?php echo __PUBLIC__;?>images/share_module/share_module_2_big.jpg">
    <div class="con">
        <div class="img">
            <img class="center-block img-responsive" src="<?php echo __PUBLIC__;?>images/qer_test.png">
        </div>
        <div class="info">
            <h3><?php echo $wechat['nickname'];?>，邀请你体验iSpa！</h3>
            <div>长按二维码识别关注公众号</div>
            <p>注册立即领取100.00元无门槛优惠券。</p>
        </div>
    </div>
</div>
</body>
</html>