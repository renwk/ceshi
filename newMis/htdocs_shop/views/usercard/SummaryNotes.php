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
            padding: 12px 0 0;
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
            padding:12px;
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



        .summary_tag{
            
        }
        .summary_tag h2{
            overflow: hidden;
            margin: 0;
            height: 1.6em;
            line-height: 1.6em;
            font-size: 18px;
        }
        .icon_add{
            display: inline-block;
            width: 28px;
            height: 28px;
            background: url("<?php echo __PUBLIC__.'./img/add_icon.png'?>") no-repeat;
            background-size: 100%;
        }
        .summary_tag .icon_add_btn{
            float: right;
        }
        .summary_tag .tag_con{
            overflow: hidden;
            margin-top: 16px;
            width: calc(100% + 12px);
        }
        .summary_tag .tag_con a{
            float: left;
            display: block;
            margin-right: 12px;
            margin-bottom: 12px;
            padding: 5px 15px;
            border-radius: 5px;
            background: #cfba93;
            color: #fff;
            font-size: 14px;
        }
        .summary_tag .tips{
            color: #999;
        }

        .summary_tab{
            padding-top: 0;
        }
        .summary_tab .user_pic{
            margin: 0 auto;
            width: 50px;
            height: 50px;
            text-align: center;
        }
        .summary_tab .user_pic img{
            display: inline-block;
            width: auto;
            max-width: 100%;
            border-radius: 50%;
        }
        .summary_tab .user_name{
            margin: 5px 0;
            padding-top: 0;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .summary_tab .reservation_box dt{
            position: relative;
        }
        .summary_tab dt span{
            padding-right: 30px;
        }
        @media screen and (max-width: 374px) {
            .summary_tab dt span{
                font-size: 12px;
            }
        }
        .summary_tab .edit_btn{
            position: absolute;
            right: 12px;
            top: 4px;
            display: inline-block;
            width: 21px;
            height: 21px;
            background: url("<?php echo __PUBLIC__.'./img/edit_icon.png'?>") no-repeat center;
        }

        .remarks_box{
            
        }
        .remarks_box .rhead{
            float: left;
            width: 50px;
        }
        .remarks_box .rmain{
            float: left;
            margin-right: 0;
            margin-left: 12px;
            width: calc(100% - 69px);/*50 + 12*/
        }
        .remarks_add{
            margin-bottom: 12px;
            text-align: center;
        }
        .remarks_add a{
            height: 1em;
            line-height: 1em;
            font-size: 14px;
            color: #999;
        }
        .remarks_add span{
            margin-top: -3px;
            width: 20px;
            height: 20px;
            margin-right: 8px;
            vertical-align: middle;
        }
        .nothing_add{
            padding-top: 50px;
            padding-bottom: 50px;
            text-align: center;
        }
        .nothing_add a{
            color:#999;
        }
        .nothing_add .icon_add{
            width: 50px;
            height: 50px;
        }

        /* 标签选择框 */
        .tag_select_box{
            
        }
        .tag_select_box .search{
            position: relative;

        }
        .tag_select_box .search input{
            padding: 0 5px;
            width: 100%;
            height: 34px;
            line-height: 34px;
            text-align: center;
            border: 1px solid #cfba93;
            border-radius: 8px;
        }
        .tag_select_box .search a{
            position: absolute;
            right: 12px;
            top: 7px;
            display: inline-block;
            width: 21px;
            height: 21px;
            background: url("<?php echo __PUBLIC__.'./img/select_icon.png'?>") no-repeat;
            background-size: 100%;
        }
        .tag_select_box .con{
            overflow: hidden;
            margin-top: 12px;
        }
        .tag_select_box .con .menu{
            float: left;
            width: 73px;
            height: 300px;
            overflow-y: auto;
        }
        .tag_select_box .con .menu li{
            padding: 18px 0;
            text-align: center;
            color: #333;
            background: #f5f5f5;
        }
        .tag_select_box .con .menu li a{
            display: inline-block;
            width: 100%;
            color: #333;
        }
        .tag_select_box .con .menu li.curr a{
            border-left: 4px solid #cfba93;
            color: #cfba93;
        }
        .tag_select_box .con .main{
            overflow: hidden;
            height: 300px;
            overflow-y: auto;
            float: left;
            padding: 12px 0 12px 12px;
            width: calc(100% - 73px);
        }
        .tag_select_box .con .main .con{
            margin-top: 0;
        }
        .tag_select_box .con .main a{
            float: left;
            margin-right: 12px;
            margin-bottom: 12px;
            display: block;
            padding: 3px 11px;
            border: 1px solid #999;
            border-radius:5px;
            color: #666;
        }
        .tag_select_box .con .main a.curr{
            background: url("<?php echo __PUBLIC__.'./img/tag_curr_icon.png'?>") no-repeat right top #f1eade;
            border-color: #f1eade;
            color: #cfba93;
        }
        
        .tag_select_box .fun_btn_wrap{
            overflow: hidden;
        }
        .tag_select_box .fun_btn_wrap button{
            float: right;
            display: block;
            padding: 4px 0;
            width: calc(50% - 6px);
            border: 1px solid #cfba93;
            border-radius: 8px;
            font-size: 18px;
            color: #fff;
        }
        .tag_select_box .fun_btn_wrap button.btn_white{
            float: left;
            background: #fff;
            color: #cfba93;
        }

        .remarks_pcon{
            
        }
        .remarks_pcon h2{
            margin: 0;
            text-align: center;
            font-size: 18px;
        }
        .remarks_pcon textarea{
            margin: 12px 0;
            padding: 12px 8px;
            display: block;
            width: 100%;
            height: 300px;
            border: 1px solid #cfba93;
            border-radius: 10px;
            resize:none;
        }
        .summary_tab .evaluation dt span{
            padding-right: 0;
        }
    </style>
</head>
<body class="p12">
<div class="con_box summary_tag">
    <input type="hidden" id="userid" value="<?php echo $user['userid']?>">
    <input type="hidden" id="consultant_id" value="<?php echo $user['consultant_id']?>">
    <input type="hidden" id="bid" value="<?php echo $bid?>">
    <h2>
        标签
        <a href="javascript:;" class="icon_add icon_add_btn" id="create_tag_btn"></a>
    </h2>
    <div class="tag_con" id="tag_pool">
        <?php foreach($usertag as $k => $v):?>
            <a href="javascript:;" code="<?php echo $v['tag_code']?>"><?php echo $v['tag_name']?></a>
        <?php endforeach;?>
    </div>
    <div class="tips">注：双击标签可以进行删除操作。</div>
</div>
<div class="con_box summary_tab">
    <div class="weui-tab" id="tab_switch">
        <!--<div class="weui-navbar-wrap">-->
        <div class="weui-navbar">
            <div class="weui-navbar__item"><span>护理汇总</span></div>
            <div class="weui-navbar__item"><span>护理日志</span></div>
            <div class="weui-navbar__item"><span>客户评价</span></div>
        </div>
        <!--</div>-->
        <div class="weui-tab__panel">
            <div class="weui-tab__content">
                <!-- 有数据展示这个 -->
                <?php if(!isset($user['remark']) || strlen($user['remark'])>0):?>
                <div>
                    <div class="user_pic">
                        <img src="<?php echo $user['userphoto']?>">
                    </div>
                    <div class="user_name"><?php echo $user['name']?></div>
                    <div class="order_list">
                        <div class="reservation_box">
                            <dl>
                                <dt>
                                    <?php echo $user['sname']?>
                                    <span>
                                        <?php echo date("Y-m-d H:i:s",$user['registtime'])?>
                                        <a href="javascript:;" class="edit_btn edit_remarks"></a>
                                    </span>
                                </dt>
                                <dd id="remark">
                                    <?php echo $user['remark']?>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <?php else:?>
                <!-- 没数据展示这个 -->
                <div class="nothing_add">
                    <a id="addremark" class="edit_remarks">
                        <span class="icon_add"></span><br>
                        新增护理汇总
                    </a>
                </div>
                <?php endif?>
            </div>
            <div class="weui-tab__content">
            
                <div class="remarks_add">
                    <a id="addcontent">
                        <span class="icon_add"></span>
                        新增日志
                    </a>
                </div>
                <div class="order_list remarks_box">
                    <?php if( $usercontent ):?>
                    <?php foreach ($usercontent as $key=>$val):?>
                        <?php if(!isset($val['content']) || strlen($val['content'])>0):?>
                        <div>
                        <div class="rhead">
                            <div class="user_pic">
                                <img src="<?php echo $user['userphoto']?>">
                            </div>
                            <div class="user_name"><?php echo $user['name']?></div>
                        </div>
                        <div class="reservation_box rmain">
                            <dl>
                                <dt style="font-size: 12px">
                                    <span style="width: 43%; text-overflow:ellipsis; float:left;padding-right: 0px;">
                                        <?php echo $user['sname']?>
                                    </span>
                                    <span style="width: 56%; text-overflow:ellipsis">
                                        <?php echo date("Y/m/d H:i",$val['visit_time']);?>
                                        <a href="javascript:;" class="edit_btn edit_content"></a>
                                        <input type="hidden" class="ids" value="<?php echo $val['id']?>">
                                    </span>
                                </dt>
                                <dd><?php echo $val['content']?></dd>
                            </dl>
                        </div>
                        </div>
                        <?php endif?>
                    <?php endforeach;?>
                    <?php endif?>
                </div>
            </div>
            <div class="weui-tab__content">
                <div class="order_list remarks_box evaluation">
                    <?php if( $comment ):?>
                    <?php foreach ($comment as $key=>$val):?>
                    <div>
                        <div class="rhead">
                            <div class="user_pic">
                                <img src="<?php echo $user['userphoto']?>">
                            </div>
                        </div>
                        <div class="reservation_box rmain">
                            <dl>
                                <dt>
                                    <?php echo $user['name']?>
                                    <span>
                                        <?php echo date("Y-m-d H:i:s",$val['datetime'])?>
                                    </span>
                                </dt>
                                <dd><?php echo $val['content']?></dd>
                            </dl>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <?php endif?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 标签框 -->
<div class="modal fade" id="select_tag_pop_box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body tag_select_box">
                <div class="search">
                    <input type="text" placeholder="搜索标签" id="search">
                    <a href="javascript:;" onclick="getTag()"></a>
                </div>
                <div class="con" id="tagshow">
                </div>
                <div class="fun_btn_wrap">
                    <button type="button" class="btn btn-default btn_white" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-default" id="select_tag_btn">确定</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 备注汇总编辑框 -->
<div class="modal fade" id="remarks_pop_box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body tag_select_box">
                <div class="remarks_pcon">
                    <h2>汇总内容</h2>
                    <textarea id="newremark"><?php echo $user['remark']?></textarea>
                </div>
                <div class="fun_btn_wrap">
                    <button type="button" class="btn btn-default btn_white" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-default" id="select_remark_btn">确定</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 客户备注框 -->
<div class="modal fade" id="content_pop_box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body tag_select_box">
                <div class="remarks_pcon">
                    <h2>备注内容</h2>
                    <textarea id="content"></textarea>
                </div>
                <div class="fun_btn_wrap">
                    <button type="button" class="btn btn-default btn_white" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-default" id="select_content_btn">确定</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 客户备注修改框 -->
<div class="modal fade" id="upcontent_pop_box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body tag_select_box">
                <div class="remarks_pcon">
                    <h2>备注内容</h2>
                    <textarea id="upcontent"></textarea>
                </div>
                <div class="fun_btn_wrap">
                    <input type="hidden" id="ids">
                    <button type="button" class="btn btn-default btn_white" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-default" id="select_upcontent_btn">确定</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/bootstrap/js/bootstrap.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>
<script>
    //汇总弹框
    $(".edit_remarks").click(function(){
        var consultant_id = $("#consultant_id").val();
        var bid = $("#bid").val();
        if(consultant_id == bid) {
            $('#remarks_pop_box').modal('show');
        }else{
            alert("仅会员专属顾问可以添加或修改");
        }
        
    });
    $("#select_remark_btn").click(function(){
        var url = "<?php echo site_url('Usercard/upremark'); ?>";
        var newremark = $("#newremark").val();
        var userid = $("#userid").val();
        data = {
            'newremark': newremark,
            'id':  userid
        }
        update(url,data);
        //关闭弹框
        $('#remarks_pop_box').modal('hide');
    });

    $(".edit_content").click(function(){
        var te = $.trim($(this).parent().parent().siblings('dd').html());
        var id = $(this).siblings('.ids').val();
        $('#upcontent').html(te);
        $('#ids').val(id);
        $('#upcontent_pop_box').modal('show');
    });
    $("#select_upcontent_btn").click(function(){
        var url = "<?php echo site_url('Usercard/upContent'); ?>";
        var upcontent = $("#upcontent").val();
        var ids = $("#ids").val();
        data = {
            'content': upcontent,
            'id':  ids
        }
        update(url,data);
        //关闭弹框
        $('#upcontent_pop_box').modal('hide');
    });
    function update(url,data) {
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (msg) {
                if(msg.msg == 'success'){
                    window.location.reload()
                }else{
                    alert(msg.data);
                    return false;
                }
            }
        })
    }

    //选择标签弹框
    $("#create_tag_btn").click(function(){
        getTag();
    });
    function getTag() {
        var search = $("#search").val();
        var url = "<?php echo site_url('Usercard/getTag'); ?>";
        $.ajax({
            type: "post",
            url: url,
            data: {'search':search},
            dataType: "json",
            success: function (msg) {
                if(msg.msg == 'success'){
                    $("#tagshow").html(msg.data);
                    $('#select_tag_pop_box').modal('show');
                }else{
                    alert(msg.data);
                    return false;
                }
            }
        })
    }

    //选择标签
    $("#select_tag_btn").click(function(){
        var code = '';
        $("#tag_main").find(".curr").each(function(){
            //这里取值处理
            code += $(this).attr('code')+',';
        });
        addtag(code,'code');
        //关闭弹框
        $('#select_tag_pop_box').modal('hide');
    });
    function addtag(code,type) {
        var id = $("#userid").val();
        if(type == 'code'){
            var data = {'tagcode':code,'id':id,'type':type}
        }else{
            var data = {'content': code,'id':  id,'type':type}
        }

        var url = "<?php echo site_url('Usercard/addtag'); ?>";
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (msg) {
                if(msg.msg == 'success'){
                    window.location.reload()
                }else{
                    alert(msg.data);
                    return false;
                }
            }
        })
    }
    //标签框切换
    $("#tagshow").delegate("#tag_menu_list li",'click',function(){
        var id = $(this).index();

        $("#tag_menu_list li").removeClass("curr");
        $(this).addClass("curr");
        $("#tag_main .con").hide();
        $("#tag_main .con").eq(id).show();
    })

    //标签点击样式
    $("#tagshow").delegate("#tag_main a",'click',function(){
        if($(this).is('.curr'))
        {
            $(this).removeClass("curr");
        }
        else
        {
            $(this).addClass("curr");
        }
    });


    weui.tab('#tab_switch',{
        defaultIndex: 0,
        onChange: function(index){
            //console.log(index);
        }
    });

    var touchtime = new Date().getTime();
    
    $("#tag_pool a").on("click", function(){
        if( new Date().getTime() - touchtime < 500 ){
            var consultant_id = $("#consultant_id").val();
            var bid = $("#bid").val();
            if(consultant_id == bid){
                //删除自身tag
                if(confirm("确定删除该标签?")){
                    var code = $(this).attr('code');
                    delTag(code);
                    $(this).remove();
                }
            }else{
                alert("仅会员专属顾问可删");
            }
        }else{
            touchtime = new Date().getTime();
            // console.log("click")
        }
    });
    function delTag(tag_code) {
        var id = $("#userid").val();
        var url = "<?php echo site_url('Usercard/delTag'); ?>";
        $.ajax({
            type: "post",
            url: url,
            data: {'tagcode':tag_code,'id':id},
            dataType: "json",
            success: function (msg) {
                if(msg.msg == 'success'){
                }else{
                    alert(msg.data);
                    return false;
                }
            }
        })
    }

    $("#addcontent").click(function () {
        $("#content").val('');
        $('#content_pop_box').modal('show');

    })
    $("#select_content_btn").click(function(){
        var content = $("#content").val();
        addtag(content,'content');
        //关闭弹框
        $('#content_pop_box').modal('hide');
    });

</script>
</body>
</html>