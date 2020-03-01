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
            text-align: left;
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
            <a href="<?php echo base_url('usercard/userDetail')?>?id=<?php echo $order_info['userid']?>"><?php echo $order_info['phone']?></a>
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
            <span>消费时间</span>
            <?php echo date("Y-m-d H:i:s",$order_info['prestatus_time'])?>
        </li>
        <li>
            <span>服务时长</span>
            <?php echo $sumtime?> 分钟
        </li>
        <li>
            <span>服务顾问</span>
            <?php echo $order_adviser?>
        </li>
        <li>
            <span>服务理疗师</span>
            <?php echo $order_beautician?>
        </li>
        <li>
            <span>服务房间</span>
            <?php echo $order_room?>
        </li>
    </ul>
</div>
<div class="con_box list_coupon">
    <ul>
        <?php foreach ($order_detail as $kk=>$vv):?>
        <li>
            <span class="name"><?php echo $vv['iname']?></span>
            <?php echo $vv['now_price']?>
        </li>
        <?php endforeach;?>
    </ul>
    <div class="result">
        <span class="name">优惠券</span>
        <?php if(empty($order_info['coupon_code'])):?>
            无
        <?php else:?>
            优惠券名称:<?php echo $order_info['coupon_code'];?>
        <?php endif?>
    </div>
</div>

<div class="panel-group con_box tab_con" id="accordion">
    <div class="tab_title" id="">
        结算信息
    </div>
    <ul class="list_box">
        <li>
            <span>订单金额</span>
            <?php echo $order_info['order_price']?>
        </li>
        <li>
            <span>优惠金额</span>
            <?php echo $order_info['discount_price']?>
        </li>
        <li>
            <span>服务费</span>
            <?php echo $order_info['cover_charge']?>
        </li>
        <li>
            <span>小费</span>
            <?php echo $order_info['tip']?>
        </li>
        <li>
            <span>实付金额</span>
            <?php echo $order_info['actual_price']?>
        </li>
    </ul>
</div>
<div class="panel-group con_box tab_con" >
    <div class="tab_title" id="">
        支付信息
    </div>
    <div class="" >
        <ul class="list_box">
        <?php foreach ($order_play as $kk=>$vv):?>
            <li>
                <span class="name"><?php echo $vv['paytype']?></span>
                <?php echo $vv['money']?>
            </li>
        <?php endforeach;?>
        </ul>
    </div>
</div>
<?php if($order_info['type'] != 8603):?>
<div class="panel-group con_box tab_con" >
    <div class="tab_title" id="">
        理疗师绩效
    </div>

    <?php if( $order_beautician_list ):?>
    <?php foreach ($order_beautician_list as $kk=>$val):?>
    <div class="table-responsive statistical beautician">
        <table class="table">
            <tr>
                <td>
                    <div class="title">
                        <?php echo $val['nickname']?>
                    </div>
                </td>
                <td>
                    <ul>
                        <li>排钟：<?php echo $val['compane_time']; ?>分钟</li>
                        <li>点钟：<?php echo $val['clock_time'];?>分钟</li>
                        <li>加钟：<?php echo $val['add_bell_time']; ?>分钟</li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li>加钟排班：<?php echo $val['overtime']; ?>分钟</li>
                        <li>加钟奖励：<?php echo $val['add_bell_reward_time']; ?>分钟</li>
                        <li>服务评级：<?php echo $val['level']; ?></li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <?php endforeach;?>
    <?php endif?>
    <?php if( $recommend_beautician_list ):?>
    <?php foreach ($recommend_beautician_list as $k=>$v):?>
    <div class="table-responsive statistical beautician">
        <table class="table">
            <tr>
                <td>
                    <div class="title">
                        <?php echo $v['nickname']?>
                    </div>
                </td>
                <td>
                    <ul>
                        <li>排钟：<?php echo $v['compane_time']; ?>分钟</li>
                        <li>点钟：<?php echo $v['clock_time'];?>分钟</li>
                        <li>加钟排班：<?php echo $v['overtime']; ?>分钟</li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li>加钟：<?php echo $v['add_bell_time']; ?>分钟</li>
                        <li>加钟奖励：<?php echo $v['add_bell_reward_time']; ?>分钟</li>
                        <li>服务评级：<?php echo $v['level']; ?></li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <?php endforeach;?>
    <?php endif?>
</div>
<?php endif?>
<div class="panel-group con_box tab_con" >
    <div class="tab_title" id="">
        顾问绩效
    </div>
    <div class="table-responsive statistical"  style="overflow-x: auto;">
        <table class="table table-striped">
            <tr>
                <th>名称</th>
                <th>绩效</th>
                <th>流水</th>
                <th>收入</th>
                <th>接待人数</th>
            </tr>
            <?php if( $performance ):?>
            <?php foreach ($performance as $kk=>$val):?>
            <?php if($val['position'] == 1): ?>
                <tr>
                    <td><?php echo $val['name'];?></td>
                    <td>¥<?php echo $val['pMoney'];?></td>
                    <td>¥<?php echo $val['waterMoney'];?></td>
                    <td>¥<?php echo $val['aMoney'];?></td>
                    <td><?php echo $val['reception'];?></td>
                </tr>
            <?php endif ?>
            <?php endforeach;?>

            <?php foreach ($performance as $kk=>$val):?>
                <?php if($val['position'] == 2): ?>
                    <tr>
                        <td><?php echo $val['name'];?>(理疗师)</td>
                        <td>¥<?php echo $val['pMoney'];?></td>
                        <td>¥<?php echo $val['waterMoney'];?></td>
                        <td>¥<?php echo $val['aMoney'];?></td>
                        <td><?php echo $val['reception'];?></td>
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