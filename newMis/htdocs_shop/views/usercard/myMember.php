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
            min-height:500px;
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
            /* padding-right: 12px; */
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
            width: 128px;
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
            word-break:keep-all;
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
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
        .mymember_table{
            border: 1px solid #cfba93;
            border-radius: 10px;
            background: #fff;
        }
        .mymember_table .table{
            margin-bottom: 0;
        }
        .mymember_table>table>tbody>tr>th,
        .mymember_table>table>tbody>tr>td{
            text-align: center;
        }
        .mymember_table>table>tbody>tr>th{
            border-top: none;
            border-bottom: 1px solid #cfba93;
            background: #e3e3e3;
        }
        .mymember_table>table>tbody>tr>td{
            border-top: none;
            color: #666;
        }
        .mymember_table>table>tbody>tr>td a{
            text-decoration: underline;
            color: #cfba93;
        }
        /* .mymember_table th:first-child{
            border-radius: 10px 0 0 0;
        }
        .mymember_table th:last-child{
            border-radius: 0 10px 0 0;
        } */
        .mymember_table hd{

        }
        @media screen and (min-width: 413px) {
            
        }
        @media screen and (min-width: 570px) {
            
        }
    </style>
</head>
<body class="p12">
    <div class="con_box">
        <div class="orderlist_date_select" style="display:none;">
            <i></i>
            <input type="text" placeholder="开始时间" class="date_begin"  readonly = "readonly">
            至
            <input type="text" class="date_end" value="2018-9-10"  readonly = "readonly">
        </div>
        <!-- Single button -->
        <div class="btn-group">
            <input type="hidden" id="type" value="<?php echo $type?>">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="date_txt"><?php echo $info['info']['sname']?></span>
            <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <?php foreach ($list as $k => $v): ?>
                    <li><a href="#"><?php echo $v['sname']?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="orderlist_select_input">
            <input type="text" id="condition1"  placeholder="姓名或手机号">
            <a href="javascript:;" onclick="showlist()"></a>
        </div>
    </div>
    <div class="order_list mymember_table">
        <table class="table table-striped">
            <tr>
                <th>手机号</th>
                <th>姓名</th>
                <th>状态</th>
            </tr>
            <tbody id="userlist">

            </tbody>

        </table>
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
<script>
    $(function(){
        $(".dropdown-toggle").click(function(){
            var this_text = $.trim($(this).text());
            $(this).nextAll(".dropdown-menu").find("li").find("a").each(function(){
                //alert($.trim($(this).text()));
                //对比 加钩
                if($.trim($(this).text()) == this_text)
                {
                    $(".dropdown-menu a").removeClass("curr");
                    $(this).addClass("curr");
                }
            });            
        });
        // 选择点击
        $(".dropdown-menu>li>a").click(function(){
            var menu_text = $(this).text();
           $(".dropdown-toggle").html( '<span class="date_txt">' + menu_text + '</span><span class="caret"></span>'); 
        });

        function dateSelect(touch_class,bengin_date=2000)
        {
            $("."+touch_class).click(function(){
                var d     = new Date();
                var day   = d.getDate()
                var month = d.getMonth() + 1
                var year  = d.getFullYear()
                weui.datePicker({
                    start: bengin_date,
                    end: year,
                    defaultValue: [year, month, day],
                    onChange: function(result){
                        
                    },
                    onConfirm: function(result){
                        $("."+touch_class).val(result[0]+'-'+result[1]+'-'+result[2]);
                    },
                    id: 'date_begin_box'
                });
            })
        }
        //开始时间选择
        dateSelect('date_begin');
        //结束时间选择
        dateSelect('date_end');
    });
    $(function () {
        showlist();
    })

    function showlist() {
        $('#userlist tr').remove();
        var type = $("#type").val();
        var store = $(".btn-group button .date_txt").html();
//        alert(store);
        var search = $("#condition1").val();
        data={
            'type' : type,
            'store': store,
            'search': search
        };
        $.ajax({
            type: "post",
            url: "<?php echo site_url('usercard/userlist'); ?>",
            data: data,
            dataType: "json",
            success: function (msg) {
                if(msg.msg == 'success'){
                    $('#userlist tr').remove();
                    $('#userlist').append(msg.data);
                }else{
                    $('#userlist').append('请刷新重试');
                }
            }
        })

    }

    function local(order) {
        var url = "<?php echo site_url('usercard/userDetail'); ?>"+"?id="+order;
        window.location.href= url;
    }
</script>
</html>