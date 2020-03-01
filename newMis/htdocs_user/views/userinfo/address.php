    <style>
        .pay_address{
            padding-top: 0;
            padding-bottom: 0;
            color: #333;
            font-size:14px;
            font-weight: normal;
        }
        .pay_address h2{
            font-size:16px;
            font-weight:normal;
            color: #333;
        }
        .pay_address .row_from{
            overflow: hidden;
            font-size:16px;
            font-weight:normal;
            color: #333;
        }
        .pay_address .row_from .row_radio{
            position: relative;
            padding: 6px 0 6px 28px;
            border-bottom: 1px solid #eee;
        }
        .pay_address .row_radio i{
            vertical-align: middle;
        }
        .pay_address .row_radio .payaddress_edit_icon{
            position: absolute;
            right: 6px;
            top: 0;
            display: inline-block;
            width: 26px;
            height: 100%;
            background: url("<?php echo __PUBLIC__?>images/payaddress_edit_icon.png") no-repeat center 32px;
        }
        .pay_address .row_radio label{
            display: block;
            width: 92%;
            font-weight: normal;
        }
        .pay_address .row_radio .iradio{
            position: absolute;
            left: 0px;
            top: 32px;
            margin-right:3px;
            display: inline-block;
            width:16px;
            height:16px;
            line-height:16px;
            border:1px solid #cfba93;
            border-radius:99px;
        }
        .pay_address .row_radio .iradio.radio_curr{
            background: #cfba93;
        }
        .pay_address .row_radio .iradio.radio_curr:before{
            position: absolute;
            left: 2px;
            top: 3px;
            display: block;
            width:10px;
            height:8px;
            background: url("<?php echo __PUBLIC__?>images/hook_white.png") no-repeat;
            content: ' ';
            color: #fff;
        }
        .pay_address .row_radio .info{
            font-size: 18px;
        }
        .pay_address .row_radio .info span{
            vertical-align: middle;
        }
        .pay_address .row_radio .info .mobile{
            margin-left: 46px;
            font-size: 16px;
        }
        .pay_address .row_radio .info .def_icon{
            margin-left: 3px;
            padding: 0px 4.5px 1px 5px;
            border-radius: 3px;
            background: #cfba93;
            font-size: 14px;
            color: #fff;
        }
        .pay_address .row_radio .detail{
            margin-top: 5px;
            font-size: 14px;
            color: #999;
        }
        .pay_address .total_sore{
            margin-top:20px;
            overflow: hidden;
            height: 28px;
            line-height: 28px;
        }
        .pay_address ul{
            margin-bottom:12px;
        }
        .pay_address li{
            overflow: hidden;
            height:28px;
            line-height:28px;
            list-style: none;
        }
        /* 确认按钮 */
        .btn_wrap{
            padding: 70px 24px;
        }
        .btn_big{
            width: 100%;
            padding-top: 6px;
            padding-bottom: 6px;
            border-radius: 10px;
            font-size: 16px;
        }
    </style>
<body class="p12">
    <div class="con_box pay_address">
        <div class="row_from">
            <?php if( $address ):?>
            <?php foreach ($address as $v):?>
            <div class="row_radio">
                <label data-id="<?php echo $v['id'];?>">
                    <i class="iradio<?php if($v['is_default'] == 'yes'):?> radio_curr<?php endif;?>"></i>
                    <div class="info">
                        <span><?php echo $v['receiver_name'];?></span>
                        <span class="mobile"><?php echo $v['receiver_mobile']?></span>
                        <?php if($v['is_default'] == 'yes'):?><span class="def_icon">默认</span><?php endif;?>
                    </div>
                    <div class="detail">
                        <?php echo $v['address'];?>
                    </div>
                </label>
                <a href="<?php echo base_url('userinfo/addOrEditAddress/'.$v['id'].'?cardid='.$cardid);?>" class="payaddress_edit_icon"></a>
            </div>
           	<?php endforeach;?>
           	<?php endif;?>
        </div>
        <div class="btn_wrap">
            <a href="<?php echo base_url('userinfo/addOrEditAddress?cardid='.$cardid)?>" class="btn btn_big" id="">新增地址</a>
        </div>
    </div>
</body>
<script>
    $(".row_radio label").click(function(){
        $(".row_from").find('.iradio').removeClass("radio_curr");
        $(this).find(".iradio").addClass("radio_curr");

		var addressid = $(this).attr('data-id');
		href('<?php echo base_url('buy/gotoPay/'.$cardid.'?addressid=');?>'+addressid);
        
    });
  
</script>
</html>