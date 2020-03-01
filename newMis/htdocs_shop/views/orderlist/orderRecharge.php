<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="<?php echo __PUBLIC__.'width=device-width,initial-scale=1,user-scalable=0'?>">
    <title>iSpa泰美好</title>
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'js/bootstrap/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/weui.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/base.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/tab.css'?>">
    <style>
        .list_box{
            margin-bottom:0;
            list-style: none;
            font-size:14px;
            color: #333;
        }
        .list_box li{
            line-height: 28px;
        }
        .list_box li span{
            display: inline-block;
            width:92px;
            color: #666;
        }
        .list_box li a{
            color: #cfba93;
            text-decoration: underline;
        }
        /* .tab_con{

        } */
        .tab_con .tab_title{
            overflow: hidden;
            margin-bottom: 5px;
            font-size:18px;
            color: #333;
        }
        .tab_con .tab_close{
            float: right;
            line-height: 28px;
            font-size:14px;
            color: #cfba93;
        }


        .list_coupon{
            text-align: right;
        }
        .list_coupon ul{
            margin-bottom:0;
            list-style: none;
            font-size:14px;
            color: #333;
        }
        .list_coupon li{
            line-height: 28px;
        }
        .list_coupon .name{
            float: left;
        }
        .list_coupon .result{
            padding: 6px 12px 8px;
            background: #e3e3e3;
            border-radius: 0 0 10px 10px;
            margin: 0 -12px -12px;
        }
        .order_info_result{
            margin-left: -12px;
            margin-right: -12px;
            margin-bottom: -12px;
            padding: 0 12px;
            background: #cfba93;
            line-height: 48px;
            border-radius: 0 0 10px 10px;
            text-align: right;
            font-size: 18px;
            color: #fff;
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
        .order_info_result span{
            vertical-align: middle;
        }
        .order_info_result .name{
            text-align: left;
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
        }
        .order_info_result .money{
            
        }
        .beautician .table>tbody>tr>td:first-child{
            width: 70px;
            text-align: center;
        }
        .beautician .table>tbody>tr>td .title{
            display: inline-block;
            vertical-align: middle;
            position: relative;
            line-height: 5em;
        }
        .beautician .table>tbody>tr>td{
            padding: 0;
            border-right: 1px solid #cfba93;
        }
        .beautician .table>tbody>tr>td:last-child{
            border-right: none;
        }
        .beautician .table ul{
            margin-bottom: 0;
        }
        .beautician .table li{
            padding: 0 12px;
            text-align: center;
            list-style: none;
            line-height: 1.8em;
        }
        .statistical .table li:nth-child(2n){
            background: #f5f5f5;
        }
        .statistical .table li span{
            width: 14px;
        }
        .statistical .table>tbody>tr>td{

        }
        .statistical .table>tbody>tr>td{

        }
    </style>
</head>
<body class="p12">
<div class="con_box">
    <ul class="list_box">
        <li>
            <span>订单号</span>
            <?php echo $order_info['oid']?>
        </li>
        <li>
            <span>客户电话</span>
            <a href="<?php echo base_url('usercard/userDetail')?>?id=<?php echo $order_info['userid']?>"><?php echo $order_info['mobile']?></a>
        </li>
        <li>
            <span>客户名称</span>
            <?php echo $order_info['nickname']?>
        </li>
        <li>
            <span>消费门店</span>
            <?php echo $order_info['sname']?>
        </li>
        <li>
            <span>创建时间</span>
            <?php echo $order_info['create_time'];?>
        </li>
        <li>
            <span>支付时间</span>
            <?php echo $order_info['time_pay'];?>
        </li>
        <li>
            <span>专属顾问</span>
            <?php echo $order_info['exclusive_aid']?>
        </li>
        <li>
            <span>推荐顾问</span>
            <?php echo $order_adviser?>
        </li>
        <li>
            <span>推荐理疗师</span>
            <?php echo $order_beautician?>
        </li>
        <li>
            <span>接待顾问</span>
            <?php echo $order_info['reception_aid']?>
        </li>
        <li>
            <span>会员卡号</span>
            <?php echo isset($order_info['ucard_no'])?$order_info['ucard_no']:'';?>
        </li>
        <li>
            <span>订单状态</span>
            <?php echo $order_info['status']?>
        </li>
        </li>
    </ul>

    <?php if(!empty($order_ucard)):?>
        <?php foreach ($order_ucard as $kk=>$vv):?>
        <div class="order_info_result">
                <span class="name"><?php echo $vv['cardname']?>(<?php echo $vv['accounts']?>)</span>
                <span class="money">¥<?php echo $vv['money']?></span>
        </div>
        <?php endforeach;?>
    <?php else:?>
        <div class="order_info_result">
            <span class="name"><?php echo $order_info['cardname']?>(<?php echo $order_info['accounts']?>)</span>
            <span class="money">¥<?php echo $order_info['money_true']?></span>
        </div>
    <?php endif?>

</div>
<div class="panel-group con_box tab_con" id="">
        <div class="tab_title" id="">
            赠送信息
        </div>
        <ul class="list_box">
            <?php if(!empty($order_info['gift_coupon'])):?>
            <?php foreach ($order_info['gift_coupon'] as $kk=>$vv):?>
                <li>
                    <span class="name">优惠券名称</span>
                    <?php echo $vv['couponname']?>
                </li>
                <li>
                    <span>赠送次数</span>
                    <?php echo $vv['num']?>
                </li>
            <?php endforeach;?>
            <?php else:?>
                <li>
                    <span>优惠券名称</span>
                    无
                </li>
                <li>
                    <span>赠送次数</span>
                    0
                </li>
            <?php endif?>
        </ul>
    </div>
<div class="panel-group con_box tab_con" id="">
    <div class="tab_title" id="">
        结算信息
    </div>
    <ul class="list_box">
        <li>
            <span>实付金额</span>
            <?php echo isset($order_info['money_true_true'])?$order_info['money_true_true']:'';?>
        </li>
    </ul>
</div>
<div class="panel-group con_box tab_con" >
    <div class="tab_title" id="">
        支付信息
    </div>
    <div class="" >
        <ul class="list_box">
            <?php if(!empty($order_play)):?>
            <?php foreach ($order_play as $kk=>$vv):?>
                <li>
                    <span class="name"><?php echo $vv['paytype']?></span>
                    <?php echo $vv['money']?>
                </li>
            <?php endforeach;?>
            <?php else:?>
            <?php endif?>
        </ul>
    </div>
</div>
<!--<div class="panel-group con_box tab_con" >-->
<!--    <div class="tab_title" id="">-->
<!--        理疗师绩效-->
<!--    </div>-->
<!--    <div class="table-responsive statistical beautician">-->
<!--        <table class="table">-->
<!--            <tr>-->
<!--                <td>-->
<!--                    <div class="title">-->
<!--                        Sara-->
<!--                    </div>-->
<!--                </td>-->
<!--                <td>-->
<!--                    <div class="title">-->
<!--                        绩效金额  1200元-->
<!--                    </div>-->
<!--                </td>-->
<!--            </tr>-->
<!--        </table>-->
<!--    </div>-->
<!---->
<!--</div>-->
<div class="panel-group con_box tab_con" >
    <div class="tab_title" id="">
        员工绩效
    </div>
    <div class="table-responsive statistical">
        <table class="table table-striped">
            <tr>
                <th>岗位</th>
                <th>名称</th>
                <th>绩效</th>
                <th>流水</th>
                <th>收入</th>
            </tr>
            <?php if( $performance ):?>
                <?php foreach ($performance as $kk=>$val):?>
                    <?php if($val['position'] == 1): ?>
                    <tr>
                        <td>顾问</td>
                        <td><?php echo $val['name'];?></td>
                        <td>¥ <?php echo $val['pMoney'];?></td>
                        <td>¥ <?php echo $val['waterMoney'];?></td>
                        <td>¥ <?php echo $val['aMoney'];?></td>
                    </tr>
                    <?php else:?>
                    <tr>
                        <td>理疗师</td>
                        <td><?php echo $val['name'];?></td>
                        <td>¥ <?php echo $val['pMoney'];?></td>
                        <td>¥ <?php echo $val['waterMoney'];?></td>
                        <td>¥ <?php echo $val['aMoney'];?></td>
                    </tr>
                    <?php endif ?>
                <?php endforeach;?>
            <?php endif?>
        </table>
    </div>
</div>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/bootstrap/js/bootstrap.min.js'?>"></script>
</body>
</html>