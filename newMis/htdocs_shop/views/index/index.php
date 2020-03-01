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
        .head_info .user_name{
            margin-top: 15px;
            margin-left: 23px;
            float: left;
            font-size: 18px;
        }
        .head_info .user_set{
            display: inline-block;
            width: 21px;
            height: 22px;
            background: url("<?php echo __PUBLIC__.'./img/set_icon.png'?>") no-repeat;
        }
        .head_info .user_operat{
            position: absolute;
            right: 12px;
            top: 12px;
            display: block;
            z-index: 90;
        }
        .head_info .user_operat a{
            margin-left: 12px;
            display: inline-block;
            vertical-align: middle;
        }
        .head_info .user_operat .btn{
            padding: 3px 10px;
            border-radius: 50px;
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
        .icon_calendar{
            background: url("<?php echo __PUBLIC__.'./img/calendar_icon.png'?>") no-repeat;
        }
        .icon_order{
            background: url("<?php echo __PUBLIC__.'./img/order_icon.png'?>") no-repeat;
        }
        .icon_diamond{
            background: url("<?php echo __PUBLIC__.'./img/diamond_icon.png'?>") no-repeat;
        }
        .icon_info{
            background: url("<?php echo __PUBLIC__.'./img/info_icon.png'?>") no-repeat;
        }
        .icon_book{
            background: url("<?php echo __PUBLIC__.'./img/book_icon.png'?>") no-repeat;
        }
        .icon_chart{
            background: url("<?php echo __PUBLIC__.'./img/chart_icon.png'?>") no-repeat;
        }
        .icon_date{
            background: url("<?php echo __PUBLIC__.'./img/date_icon.png'?>") no-repeat;
        }
        .icon_time{
            background: url("<?php echo __PUBLIC__.'./img/time_icon.png'?>") no-repeat;
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
            margin: 0 2% 12px;
            padding: 10px 0 5px;
            text-align: center;
            color: #333;
            border-radius: 5px;
            box-shadow: 0px 3px 10px rgba(0,0,0,.1);
        }
        .modal-header{
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .modal-body{
            padding-top: 0;
        }
        .weui-navbar+.weui-tab__panel{
            padding-top: 39px;
        }
        .weui-tab__content{

            /* width: 100%; */
            /* padding: 12px; */
        }
        .weui-navbar__item{
            padding-top: 6px;
            padding-bottom: 0;
            text-align: right;
            padding-right: 20px;
            border-bottom: none;
            font-size: 16px;
            color: #666;
        }
        .weui-navbar__item:last-child{
            text-align: left;
            padding-left: 20px;
        }
        .weui-navbar__item.weui-bar__item_on{
            border-bottom-color: #fff;
            background: #fff;
            color: #666;
        }
        .weui-navbar{
            background: #fff;
        }
        .weui-navbar:after{
            border-bottom: none;
        }
        .weui-navbar__item:after{
            border-right: none;
        }
        .weui-navbar__item span{
            display: inline-block;
            border-bottom: 2px solid #fff;
            padding-left: 14px;
            padding-right: 14px;
            /* min-width:82px; */
            /* width: 100%; */
            padding-bottom:6px;
            background: #fff;
            color: #666;
            font-size: 14px;
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
        .weui-picker__action{
            color: #cfba93;
        }
        /* 表格 */
        .statistical_title{
            margin: 0 0 9px;
            padding-left: 8px;
            border-left: 4px solid #cfba93;
            font-size: 14px;
            color: #cfba93;
        }
        .statistical{
            margin-bottom: 9px;
            border: 1px solid #cfba93;
            border-radius: 8px;
        }
        .statistical:last-child{
            margin-bottom: 0;
        }
        .statistical .table>tbody>tr{
            display: flex;
            width: 100%;
        }
        .statistical .table>tbody>tr>th,
        .statistical .table>tbody>tr>td{
            padding-top: 4px;
            padding-bottom: 4px;
            padding-left: 0;
            padding-right: 0;
            position: relative;
            display: block;
            margin-bottom: 0;
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            flex: 1;
        }
        .statistical .table>tbody>tr>th{
            border-bottom: 1px solid #cfba93;
            border-right: none;
            color: #333;
        }
        .weui-picker__bd .weui-picker__group:last-child{
            display: none !important;
        }
        .paid_btn_wrap{
            padding-bottom: 0;
            margin-bottom: 0;
            overflow: hidden;
            text-align: center;
        }
        .paid_btn,
        .paid_btn:visited,
        .paid_btn:hover,
        .paid_btn:active,
        .paid_btn:focus{
            display: inline-block;
            padding-top: 5px;
            padding-bottom: 6px;
            width: calc(60% - 7px);
            border-radius: 10px;
            text-align: center;
            font-size: 17px;
            color: #fff;
        }
        .weui-tab__content .con_box{
            margin-bottom: 0;
            padding-bottom: 0;
        }
    </style>
</head>
<body class="p12">
<div class="con_box head_info" onclick="href('<?php echo base_url('index/info');?>')">
    <img class="user_pic" src="<?php echo $wechat['headimgurl'];?>">
    <div class="user_name">
        Hi，<br><?php echo $info['nickname']?>
    </div>
    <div class="user_operat">
        <a href="javascript:;" class="user_set"></a>
    </div>
</div>
<div class="table-responsive statistical">
    <input type="hidden" id="brand" value="<?php echo $info['brand']?>">
    <input type="hidden" id="bid" value="<?php echo $uid?>">
    <input type="hidden" id="sid" value="<?php echo $info['sid']?>">
    <input type="hidden" id="role" value="<?php echo $role?>">
    <table class="table table-striped" id="performanceSort">
        <tr>
            <th>类型</th>
            <th>数额</th>
            <th>门店排名</th>
            <th>品牌排名</th>
        </tr>
        <?php if ( $role == 'consultant' || $role == 'manage' ):?>
            <tbody id="consultantsortinfo">
            <tr>
                <td>流水</td>
                <td >0</td>
                <td >0</td>
                <td >0</td>
            </tr>
            <tr>
                <td>服务</td>
                <td >0</td>
                <td >0</td>
                <td >0</td>
            </tr>
            <tr>
                <td>零售</td>
                <td >0</td>
                <td >0</td>
                <td >0</td>
            </tr>
            <tr>
                <td>售卡</td>
                <td >0</td>
                <td >0</td>
                <td >0</td>
            </tr>
            <?php if( $role == 'consultant' ):?>
                <tr>
                    <td>人数</td>
                    <td >0</td>
                    <td >0</td>
                    <td >0</td>
                </tr>
            <?php endif;?>
            </tbody>
        <?php elseif( $role == 'beautician' ):?>
            <tbody id="beauticiansortinfo">
            <tr>
                <td>工时</td>
                <td >0</td>
                <td >0</td>
                <td >0</td>
            </tr>
            <tr>
                <td>零售</td>
                <td >0</td>
                <td >0</td>
                <td >0</td>
            </tr>
            <tr>
                <td>售卡</td>
                <td >0</td>
                <td >0</td>
                <td >0</td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>
</div>
<div class="con_box menu_list">
    <?php if ( $role == 'consultant' ):?>
        <a href="<?php echo base_url('bespeakorder/getBespeak')?>?id=<?php echo $role?>" class="menu_one">
            <i class="s_icon icon_calendar"></i>
            <span>我的预约</span>
        </a>
        <a href="<?php echo base_url('orderlist/index')?>?id=<?php echo $role?>" class="menu_one">
            <i class="s_icon icon_order"></i>
            <span>我的订单</span>
        </a>
        <a href="<?php echo base_url('usercard/cardList')?>?id=<?php echo $role?>" class="menu_one">
            <i class="s_icon icon_diamond"></i>
            <span>我的会员</span>
        </a>
        <a href="<?php echo base_url('usercard/cardList')?>?id=<?php echo $role?>&type=list" class="menu_one">
            <i class="s_icon icon_info"></i>
            <span>会员信息</span>
        </a>
        <a href="<?php echo base_url('orderlist/index')?>" class="menu_one">
            <i class="s_icon icon_book"></i>
            <span>订单信息</span>
        </a>
        <a href="<?php echo base_url('performances/index')?>?id=<?php echo $role?>" class="menu_one">
            <i class="s_icon icon_chart"></i>
            <span>我的绩效</span>
        </a>
        <a href="javascript:;" class="menu_one">
            <i class="s_icon icon_date"></i>
            <span>我的排班</span>
        </a>
        <a href="<?php echo base_url('beauticiansort/oneBidInfo')?>?id=<?php echo $role; ?>&type=list?>" class="menu_one">
            <i class="s_icon icon_time"></i>
            <span>加班休息</span>
        </a>
    <?php elseif ($role == 'manage'):?>
        <a href="<?php echo base_url('usercard/cardList')?>?id=<?php echo $role?>&type=list" class="menu_one">
            <i class="s_icon icon_info"></i>
            <span>会员信息</span>
        </a>
        <a href="<?php echo base_url('orderlist/index')?>" class="menu_one">
            <i class="s_icon icon_book"></i>
            <span>订单信息</span>
        </a>
        <a href="javascript:;" class="menu_one">
            <i class="s_icon icon_info"></i>
            <span>办卡信息</span>
        </a>
        <a href="javascript:;" class="menu_one">
            <i class="s_icon icon_book"></i>
            <span>门店绩效</span>
        </a>
    <?php elseif( $role == 'beautician' ):?>
        <a href="<?php echo base_url('bespeakorder/getBespeak')?>?id=<?php echo $role?>" class="menu_one" >
            <i class="s_icon icon_calendar"></i>
            <span>我的预约</span>
        </a>
        <a href="<?php echo base_url('orderlist/index')?>?id=<?php echo $role?>" class="menu_one">
            <i class="s_icon icon_order"></i>
            <span>我的订单</span>
        </a>
        <a href="<?php echo base_url('performances/index')?>?id=<?php echo $role?>" class="menu_one">
            <i class="s_icon icon_chart"></i>
            <span>我的绩效</span>
        </a>
        <a href="<?php echo base_url('beauticiansort/oneBidInfo')?>?id=<?php echo $role; ?>&type=list?>" class="menu_one">
            <i class="s_icon icon_time"></i>
            <span>加班休息</span>
        </a>
        <a href="<?php echo base_url('beauticiansort/scheduling')?>?id=<?php echo $uid; ?>&type=list?>" class="menu_one">
            <i class="s_icon icon_date"></i>
            <span>我的排班</span>
        </a>
        <a href="<?php echo base_url('beauticiansort/index')?>?sid=<?php echo $info['sid']?>" class="menu_one">
            <i class="s_icon icon_time"></i>
            <span>工时排序</span>
        </a>

    <?php endif;?>

</div>
<div class="modal fade" tabindex="-1" role="dialog" id="performance">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">绩效信息</h4>
            </div>
            <div class="modal-body">

                <div class="weui-tab" id="tab_switch">
                    <!--<div class="weui-navbar-wrap">-->
                    <div class="weui-navbar">
                        <div class="weui-navbar__item" onclick="performanceshow(1)"><span>今天</span><input type="hidden" value="1"></div>
                        <div class="weui-navbar__item" onclick="performanceshow(2)"><span>本月</span><input type="hidden" value="2"></div>
                    </div>
                    <!--</div>-->
                    <div class="weui-tab__panel">
                        <div class="weui-tab__content">
                            <div class="con_box" id="day">
                                <?php if ( $role == 'consultant' ):?>
                                <h2 class="statistical_title">基础信息</h2>
                                <div style="margin-bottom:10px;">接待人数：</div>
                                <h2 class="statistical_title">销售信息</h2>
                                <div class="table-responsive statistical">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>项目类型</th>
                                            <th>金额</th>
                                        </tr>
                                        <tr>
                                            <td>储值卡</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>常规金</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>疗程卡</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>礼券卡</td>
                                            <td>0.00</td>
                                        </tr>
                                    </table>
                                </div>
                                <h2 class="statistical_title">流水收入</h2>
                                <div class="table-responsive statistical">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>项目类型</th>
                                            <th>金额</th>
                                        </tr>
                                        <tr>
                                            <td>流水</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>服务收入</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>零售收入</td>
                                            <td>0.00</td>
                                        </tr>
                                    </table>
                                </div>
                                <?php elseif( $role == 'beautician' ):?>
                                <h2 class="statistical_title">工时信息</h2>
                                <div class="table-responsive statistical">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>工时类型</th>
                                            <th>时长(h)</th>
                                            <th>人数</th>
                                        </tr>
                                        <tr>
                                            <td>排钟</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>加钟</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>点钟</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>加钟奖励</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>加班奖励</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                    </table>
                                </div>
                                <h2 class="statistical_title">评价信息</h2>
                                <div class="table-responsive statistical">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>E4</th>
                                            <th>E3</th>
                                            <th>E2</th>
                                            <th>E1</th>
                                            <th>G</th>
                                            <th>A</th>
                                            <th>P</th>
                                        </tr>
                                        <tr>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                    </table>
                                </div>
                                <h2 class="statistical_title">销售信息</h2>
                                <div class="table-responsive statistical">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>项目类型</th>
                                            <th>金额</th>
                                        </tr>
                                        <tr>
                                            <td>产品</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>储值卡</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>常规金</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>疗程卡</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>礼券卡</td>
                                            <td>0.00</td>
                                        </tr>
                                    </table>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="weui-tab__content">
                            <div class="con_box"  id="month">
                                <?php if ( $role == 'consultant' ):?>
                                <h2 class="statistical_title">基础信息</h2>
                                <div style="margin-bottom:10px;">接待人数：</div>
                                <h2 class="statistical_title">销售信息</h2>
                                <div class="table-responsive statistical">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>项目类型</th>
                                            <th>金额</th>
                                        </tr>
                                        <tr>
                                            <td>储值卡</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>常规金</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>疗程卡</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>礼券卡</td>
                                            <td>0.00</td>
                                        </tr>
                                    </table>
                                </div>
                                <h2 class="statistical_title">流水收入</h2>
                                <div class="table-responsive statistical">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>项目类型</th>
                                            <th>金额</th>
                                            <th>目标</th>
                                            <th>完成度</th>
                                        </tr>
                                        <tr>
                                            <td>流水</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>服务收入</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>零售收入</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>0</td>
                                        </tr>
                                    </table>
                                </div>
                                <?php elseif( $role == 'beautician' ):?>
                                <h2 class="statistical_title">工时信息</h2>
                                <div class="table-responsive statistical">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>工时类型</th>
                                            <th>时长(h)</th>
                                            <th>人数</th>
                                        </tr>
                                        <tr>
                                            <td>排钟</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>加钟</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>点钟</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>加钟奖励</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>加班奖励</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                    </table>
                                </div>
                                <div style="margin-bottom:5px;">虚拟工时：</div>
                                <h2 class="statistical_title">评价信息</h2>
                                <div class="table-responsive statistical">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>E4</th>
                                            <th>E3</th>
                                            <th>E2</th>
                                            <th>E1</th>
                                            <th>G</th>
                                            <th>A</th>
                                            <th>P</th>
                                        </tr>
                                        <tr>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                    </table>
                                </div>
                                <h2 class="statistical_title">销售信息</h2>
                                <div class="table-responsive statistical">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>项目类型</th>
                                            <th>金额</th>
                                        </tr>
                                        <tr>
                                            <td>产品</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>储值卡</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>常规金</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>疗程卡</td>
                                            <td>0.00</td>
                                        </tr>
                                        <tr>
                                            <td>礼券卡</td>
                                            <td>0.00</td>
                                        </tr>
                                    </table>
                                </div>
                                <h2 class="statistical_title">目标信息</h2>
                                <div class="table-responsive statistical">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>工时类型</th>
                                            <th>完成工时</th>
                                            <th>目标工时</th>
                                            <th>目标进度</th>
                                        </tr>
                                        <tr>
                                            <td>总工时</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        </tr>
                                    </table>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="con_box paid_btn_wrap">
                    <a href="javascript:;" class="btn btn_big paid_btn" data-dismiss="modal">知道了</a>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/common.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/bootstrap/js/bootstrap.min.js'?>"></script>
<script type="text/javascript">


    $(function () {
        var role = $('#role').val();
        if( role == 'consultant' || role == 'manage'){
            consultantsortinfo();
        }else if(role == 'beautician'){
            beauticiansortlist();
        }
    })
    function consultantsortinfo() {
        var brand = $('#brand').val();
        var sid = $('#sid').val();
        var bid = $('#bid').val();
        var role = $('#role').val();
        var url = "<?php echo site_url('index/performanceSort'); ?>";
        data={
            'brand': brand,
            'sid': sid,
            'bid':  bid,
            'role':  role
        };
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (data) {
                if(data.msg=='success'){
                    $('#consultantsortinfo').html(data.data);
                }
            }
        })
    }
    function beauticiansortlist() {
        var brand = $('#brand').val();
        var sid = $('#sid').val();
        var bid = $('#bid').val();
        var role = $('#role').val();
        var url = "<?php echo site_url('index/performanceSort'); ?>";
        data={
            'brand': brand,
            'sid': sid,
            'bid':  bid,
            'role':  role
        };
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (data) {
                if(data.msg=='success'){
                    $('#beauticiansortinfo').html(data.data);
                }
            }
        })
    }
    $("#performanceSort").click(function () {
        var role = $('#role').val();

            $("#performance").modal('show');
            performanceshow();

    })
    function performanceshow(type = null) {

        if(type == null){
            type = $('.weui-bar__item_on input').val();
        }

        var bid = $('#bid').val();
        var role = $('#role').val();
        var url = "<?php echo site_url('index/onePerformance'); ?>";
        data={
            'bid':  bid,
            'role':  role,
            'type': type
        };
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (data) {
                if(data.msg=='success'){
                    if( type == '1'){
                        $("#day").html(data.data);
                    }else if( type == '2'){
                        $("#month").html(data.data);
                    }
                }
            }
        })
    }
    weui.tab('#tab_switch',{
        defaultIndex: 0,
        onChange: function(index){
            //console.log(index);
        }
    });
</script>
</body>
</html>