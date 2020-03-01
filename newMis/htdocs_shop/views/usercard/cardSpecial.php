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
        .weui-tab__content{
            /* width: 100%; */
            padding: 12px;
        }
        .weui-navbar__item{
            padding-bottom: 0;
            border-bottom: none;
            font-size: 16px;
            color: #666;
        }
        .weui-navbar__item.weui-bar__item_on{
            border-bottom-color: #fff;
            background: #fff;
            color: #666;
        }
        .weui-navbar__item span{
            display: inline-block;
            border-bottom: 2px solid #fff;
            /*padding-left: 14px;
            padding-right: 14px;*/
            min-width:82px;
            padding-bottom:11px;
            background: #fff;
            color: #666;
        }
        .weui-navbar__item.weui-bar__item_on span{
            border-bottom-color: #cfba93;
            background: #fff;
            color: #cfba93;
        }
        .weui-media-box_appmsg .weui-media-box__hd{
            margin-right: 1.5em;
            width: 72px;
            height: 72px;
            line-height: 72px;
            text-align: center;
        }
        .weui-media-box__desc{
            line-height: 28px;
        }
        .weui-panel:after{
            border-bottom:none;
        }
        .weui-media-box_appmsg .weui-media-box__thumb{
            border-radius:6px;
        }
        /* 预约框 */
        .reservation_box{
            overflow: hidden;
            margin-right: 12px;
            margin-bottom: 12px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #cfba93;
            border-radius:10px;
            background: #fff;
            font-size: 14px;
        }
        .reservation_box dl{
            margin: 0;
        }
        .reservation_box dt{
            overflow: hidden;
            padding-left:12px;
            padding-right: 12px;
            height: 30px;
            border-bottom: 1px solid #cfba93;
            border-radius:10px 10px 0 0;
            line-height:30px;
            background: #e3e3e3;
            font-weight: normal;
            vertical-align: middle;
        }
        .reservation_box dt span{
            float: right;
            vertical-align: middle;
        }
        .reservation_box dt .icon_vip{
            display: inline-block;
            margin-top: -4px;
            width: 24px;
            height: 18px;
            background: url("<?php echo __PUBLIC__.'./img/vip_icon.png'?>") no-repeat;
            vertical-align: middle;
        }
        .reservation_box dd{
            overflow: hidden;
            padding-left:12px;
            padding-right: 12px;
            height: 28px;
            line-height:28px;
            vertical-align: middle;
        }
        .reservation_box dd span{
            display: inline-block;
            min-width: 70px;
            color: #666;
        }
        .rechargelist .reservation_box dd span{
            min-width: 76px;
        }
        .reservation_box dd.table_wrap{
            padding: 0;
            height: auto;
            line-height: 1em;
            background: #f5f5f5;
        }
        .reservation_box dd.table_wrap .table{
            margin-bottom: 0;
        }
        .reservation_box .table>tbody>tr>th{
            padding: 4px 0;
            background: #fff;
            text-align: center;
            font-weight: normal;
            border-top: 1px solid #cfba93;
            border-bottom: 1px solid #cfba93;
            border-right: 1px solid #cfba93;
        }
        .reservation_box .table>tbody>tr>th:last-child{
            border-right: none;
        }
        .reservation_box .table>tbody>tr>td{
            padding: 4px 0;
            border: none;
            text-align: center;
            background: #f5f5f5;
            font-weight: normal;
        }
        .reservation_box .table>tbody>tr:nth-child(2n) td{
            background: #fff;
        }
        .order_list{
            width: 100%;
            overflow: hidden;
        }
        /* 选择日期下拉菜单 */
        .caret {
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: 2px;
            vertical-align: middle;
            border-top: 8px dashed;
            border-top: 4px solid\9;
            border-right: 6px solid transparent;
            border-left: 6px solid transparent;
        }
        .dropdown-backdrop{
            background: rgba(0,0,0,.2);
            z-index: 555;
        }
        .dropdown-toggle{
            padding: 5px 12px;
            min-width: 128px;
            border: none;
            background: #cfba93;
            text-align: right;
            font-size: 16px;
            position: relative;
            zoom: 1;
            z-index: 556;
            display: -webkit-box;
            display: -webkit-flex;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            align-items: center;
            
        }
        .dropdown-toggle .date_txt{
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
            text-align: left;
        }
        .dropdown-toggle,
        .dropdown-toggle:visited,
        .dropdown-toggle:hover,
        .dropdown-toggle:active{
            background: #cfba93;
            color: #fff;
        }
        .btn-default.active.focus, 
        .btn-default.active:focus, 
        .btn-default.active:hover, 
        .btn-default:active.focus, 
        .btn-default:active:focus, 
        .btn-default:active:hover, 
        .open>.dropdown-toggle.btn-default.focus, 
        .open>.dropdown-toggle.btn-default:focus, 
        .open>.dropdown-toggle.btn-default:hover {
            color: #fff;
            background-color: #cfba93;
            border-color: #cfba93;
            box-shadow: none;
            border-radius: 6px 6px 0 0;
        }
        .btn-group.open .dropdown-toggle {
            box-shadow: none;
        }
        .btn-default.active, 
        .btn-default:active, 
        .open>.dropdown-toggle.btn-default{
            background-color: #cfba93;
            border-color: #cfba93;
            color: #fff;
            z-index: 556;
        }
        .btn .caret {
            margin-left: 12px;
        }
        .dropdown-menu{
            margin-top: 0;
            border-top: none;
            min-width: 94px;
            border-radius: 0 0 6px 6px;
            border: none;
        }
        .dropdown-menu>li>a{
            padding-left: 19px;
            padding-right: 39px;
        }
        .dropdown-menu>li>a.curr{
            background: url("<?php echo __PUBLIC__.'./img/yes_yellow_icon.png'?>") no-repeat right 10px  top 8px;
            color: #cfba93;
        }
        /* 搜索框 */
        .orderlist_select_input{
            position: relative;
            float: right;
            /* width: 191px; */
            /* 130 + 12 */
            width: calc(100% - 144px);
            height: 100%;
        }
        .orderlist_select_input input{
            padding-left: 12px;
            width: 100%;
            height: 34px;
            border: 1px solid #a6a6a6;
            border-radius: 6px;
            outline: none;
        }
        .orderlist_select_input a{
            position: absolute;
            right: 0;
            top: 0;
            display: inline-block;
            width: 42px;
            height: 32px;
            background: url("<?php echo __PUBLIC__.'./img/select_icon.png'?>") no-repeat right 12px top 6px;
        }
        /* 自定义时间选择 */
        .orderlist_date_select{
            overflow: hidden;
            margin-bottom: 12px;
            padding-left: 31px;
            height: 34px;
            line-height: 34px;
            background: url("<?php echo __PUBLIC__.'./img/orderlist_date_select.png'?>") no-repeat left center;
            text-align: center;
            color: #999;
        }
        .orderlist_date_select i{
            display: none;
            width: 19px;
            height: 19px;
            
        }
        .orderlist_date_select input{
            float: left;
            display: inline-block;
            /* width: 128.5px; */
            width: calc(50% - 20px);
            height: 34px;
            line-height: 34px;
            padding-left: 11px;
            border: 1px solid #a6a6a6;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            color: #333;
        }
        .orderlist_date_select input:last-child{
            float: right;
        }
        .order_list .tag_add_icon{
            position: relative;
            z-index: 99;
            float: right;
            display: inline-block;
            width: 44px;
            height: 30px;
            background: url("<?php echo __PUBLIC__.'./img/tag_add_icon.png'?>") no-repeat center center;
            vertical-align: middle;
        }
        .weui-picker__action{
            color: #cfba93;
        }
        @media screen and (min-width: 413px) {
            
        }
        @media screen and (min-width: 570px) {
            
        }
    </style>
</head>
<body>
<div class="weui-tab" id="tab_switch">
    <!--<div class="weui-navbar-wrap">-->
    <div class="weui-navbar">
        <div class="weui-navbar__item"><span>未使用</span></div>
        <div class="weui-navbar__item"><span>使用记录</span></div>
        <div class="weui-navbar__item"><span>已过期</span></div>
    </div>
    <!--</div>-->
    <div class="weui-tab__panel">
        <div class="weui-tab__content">

            <div class="order_list">
                <?php foreach ($on as $kk=>$vv):?>
                <div class="reservation_box">
                    <dl>
                        <dt>
                            赠送门店: <?php echo $vv['sname']?>
                            <span>赠送顾问：<?php echo $vv['nickname']?></span>
                        </dt>
                        <dd>
                            <span>开始时间：</span>
                            <?php echo date("Y-m-d",$vv['gtime'])?>
                        </dd>
                        <dd>
                            <span>到期时间：</span>
                            <?php echo date("Y-m-d",$vv['long'])?>
                        </dd>
                        <dd class="table_wrap">
                            <table class="table table-striped">
                                <tr>
                                    <th>项目名称</th>
                                    <th>数量</th>
                                    <th>价格</th>
                                </tr>
                                <tr>
                                    <td><?php echo $vv['service_name']?></td>
                                    <td><?php echo $vv['count']?></td>
                                    <td><?php echo $vv['price']?></td>
                                </tr>
                            </table>
                        </dd>
                    </dl>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        <div class="weui-tab__content">

            <div class="order_list">
                <?php foreach ($use as $kk=>$vv):?>
                <div class="reservation_box">
                    <dl>
                        <dt>
                            赠送门店：<?php echo $vv['sname']?>
                            <span>赠送顾问：<?php echo $vv['nickname']?></span>
                        </dt>
                        <dd>
                            <span>开始时间：</span>
                            <?php echo date("Y-m-d",$vv['gtime'])?>
                        </dd>
                        <dd>
                            <span>到期时间：</span>
                            <?php echo date("Y-m-d",$vv['long'])?>
                        </dd>
<!--                        <dd>-->
<!--                            <span>使用订单号：</span>-->
<!--                            201800000-->
<!--                        </dd>-->
                        <dd class="table_wrap">
                            <table class="table table-striped">
                                <tr>
                                    <th>项目名称</th>
                                    <th>数量</th>
                                    <th>价格</th>
                                </tr>
                                <tr>
                                    <td><?php echo $vv['service_name']?></td>
                                    <td><?php echo $vv['count']?></td>
                                    <td><?php echo $vv['price']?></td>
                                </tr>
                            </table>
                        </dd>
                    </dl>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        <div class="weui-tab__content">

            <div class="order_list">

                <?php foreach ($expired as $kk=>$vv):?>
                    <div class="reservation_box">
                        <dl>
                            <dt>
                                赠送门店: <?php echo $vv['sname']?>
                                <span>赠送顾问：<?php echo $vv['nickname']?></span>
                            </dt>
                            <dd>
                                <span>开始时间：</span>
                                <?php echo date("Y-m-d",$vv['gtime'])?>
                            </dd>
                            <dd>
                                <span>到期时间：</span>
                                <?php echo date("Y-m-d",$vv['long'])?>
                            </dd>
                            <dd class="table_wrap">
                                <table class="table table-striped">
                                    <tr>
                                        <th>项目名称</th>
                                        <th>数量</th>
                                        <th>价格</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $vv['service_name']?></td>
                                        <td><?php echo $vv['count']?></td>
                                        <td><?php echo $vv['price']?></td>
                                    </tr>
                                </table>
                            </dd>
                        </dl>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/bootstrap/js/bootstrap.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>
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