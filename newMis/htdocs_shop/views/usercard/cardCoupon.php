<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>iSpa泰美好</title>
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/weui.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/base.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/tab.css'?>">
    <style>
        .coupon{
            overflow: hidden;
            margin-bottom:12px;
            width:100%;
            height:96px;
            background: #fff;
            box-shadow: 1px 6px 20px rgba(212,190,150,.2);
        }
        /***coupon_used 已使用优惠券class****/
        .coupon.coupon_used .coupon_head{
            background: #bfbebe;
        }
        .coupon.coupon_used  .coupon_head .icon_border{
            background: url("<?php echo __PUBLIC__.'./img/coupon_right_border_gray.png'?>") no-repeat;
        }
        /***coupon_expired 已过期优惠券class****/
        .coupon.coupon_expired .coupon_head{
            background: #bfbebe;
        }
        .coupon.coupon_expired  .coupon_head .icon_border{
            background: url("<?php echo __PUBLIC__.'./img/coupon_right_border_gray.png'?>") no-repeat;
        }
        .coupon.coupon_expired  .coupon_info{
            background: url("<?php echo __PUBLIC__.'./img/coupon_expired_bg.png'?>") no-repeat 92% 25%;
        }
        .coupon .coupon_head{
            position: relative;
            float: left;
            width:37%;
            height:100%;
            background: #cfba93;
            text-align: center;
            color: #fff;

        }
        .coupon .coupon_head .icon_border{
            display: block;
            position: absolute;
            right: -2px;
            top: 0;
            width:2px;
            height:96px;
            background: url("<?php echo __PUBLIC__.'./img/coupon_right_border_yellow.png'?>") no-repeat;

        }
        .coupon .coupon_head h3{
            padding-top:5px;
            line-height: 1.4em;
            font-size:24px;
            font-weight: normal;
        }
        .coupon .coupon_head span{
            font-size:12px;
        }
        .coupon .coupon_info{
            position: relative;
            float: left;
            padding-left:24px;
            width:63%;
            height:100%;
            line-height: 2em;
            font-size:12px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .coupon .coupon_info h3{
            margin-top:20px;
            font-size:12px;
            color: #333;
        }
        .coupon .coupon_info p{
            color: #999;
        }
        .coupon .coupon_info i{
            position: absolute;
            right: -21px;
            top: 10px;
            display: block;
            width: 85px;
            text-align: center;
            background: #e76057;
            font-size: 12px;
            color: #fff;
            font-style: normal;
            transform: rotate(45deg);
        }
    </style>
</head>
<body>

<div class="weui-tab" id="tab_switch">
    <!--<div class="weui-navbar-wrap">-->
    <div class="weui-navbar">
        <div class="weui-navbar__item">待使用（<?php echo count($on);?>）</div>
        <div class="weui-navbar__item">使用记录（<?php echo count($use);?>）</div>
        <div class="weui-navbar__item">已过期（<?php echo count($expired);?>）</div>
    </div>
    <!--</div>-->
    <div class="weui-tab__panel">
        <div class="weui-tab__content">
            <?php foreach ($on as $kk=>$vv):?>
                <div class="coupon"><!--coupon start-->
                    <div class="coupon_head">
                        <i class="icon_border"></i>
                        <h3>
                            <span>优惠券</span><br>
                            ¥ <?php echo $vv['money']?>
                        </h3>
                    </div>
                    <div class="coupon_info">
                        <?php if((strtotime($vv['expiratime'])-time()) < 86400):?>
                            <i>快过期</i>
                        <?php else:?>

                        <?php endif?>
                        <h3>消费满1000.00可用</h3>
                        <p>有效期：<?php echo $vv['addtime']?>-<?php echo $vv['expiratime']?></p>
                    </div>
                </div><!--coupon end-->
            <?php endforeach;?>

        </div>
        <div class="weui-tab__content">
            <?php foreach ($use as $kk=>$vv):?>
            <div class="coupon coupon_used"><!--coupon start-->
                <div class="coupon_head">
                    <i class="icon_border"></i>
                    <h3>
                        <span>优惠券</span><br>
                        ¥ <?php echo $vv['money']?>
                    </h3>
                </div>
                <div class="coupon_info">
                    <h3>消费满1000.00可用</h3>
                    <p>有效期：<?php echo $vv['addtime']?>-<?php echo $vv['expiratime']?></p>
                </div>
            </div><!--coupon end-->
            <?php endforeach;?>

        </div>
        <div class="weui-tab__content">
            <?php foreach ($expired as $kk=>$vv):?>
            <div class="coupon coupon_expired"><!--coupon start-->
                <div class="coupon_head">
                    <i class="icon_border"></i>
                    <h3>
                        <span>优惠券</span><br>
                        ¥ <?php echo $vv['money']?>
                    </h3>
                </div>
                <div class="coupon_info">
                    <h3>消费满1000.00可用</h3>
                    <p>有效期：<?php echo $vv['addtime']?>-<?php echo $vv['expiratime']?></p>
                </div>
            </div><!--coupon end-->
            <?php endforeach;?>

        </div>
    </div>
</div>



<script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>  "></script>
<script>
    weui.tab('#tab_switch',{
        defaultIndex: 0,
        onChange: function(index){
            //console.log(index);
        }
    });
</script>
</body>
</html>