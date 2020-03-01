<link rel="stylesheet" href="<?php echo __PUBLIC__.'slick/slick.css?v='.V;?>">
<script type="text/javascript" src="<?php echo __PUBLIC__.'slick/slick.min.js?v='.V;?>"></script>
    <style>
        /* tab样式 */
        .weui-tab__content{
            padding: 12px 0;
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
            margin-left: -40px;
            border-bottom: 2px solid #fff;
            min-width:78px;
            padding-bottom:8px;
            background: #fff;
            color: #666;
        }
        .weui-navbar__item:last-child span{
            margin-right: -40px;
        }
        .weui-navbar__item.weui-bar__item_on span{
            border-bottom-color: #cfba93;
            background: #fff;
            color: #cfba93;
        }
        /* 付款模块 */
        .payment{

        }
        .payment .title{
            margin-top: 3px;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: normal;
        }
        .payment .title span{
            color: #666;
        }
        .payment .card_info{
            position: relative;
            width: 100%;
        }
        .payment .card_info p{
            position: absolute;
            left: 0;
            top: calc(50% - 14px);
            margin: 0;
            width: 100%;
            text-align: center;
            color: #fff;
            font-size:18px;
            
        }
        .payment .card_info p span{
            padding: 0 22px;
        }
        /* tab内容 */
        .payment .lifting_self,
        .payment .lifting_other{
            padding: 15px 12px;
            height: 120px;
            border: 1px solid #cfba93;
            border-radius: 15px;
        }
        .payment .lifting_self{
            text-align: center;
        }
        .payment .lifting_self h4{
            margin: 0;
            font-size: 18px;
            font-weight: normal;

        }
        .payment .lifting_self h3{
            margin: 12px 0;
            font-size: 24px;
            font-weight: normal;

        }
        .payment .lifting_self p{
            margin: 0;
            font-size: 12px;
            font-weight: normal;
            color: #999;
        }
        .payment .lifting_other{
            position: relative;
            text-align: left;
        }
        .payment .lifting_other h2{
            margin-top: 8px;
            font-size: 24px;
            font-weight: 500;
        }
        .payment .lifting_other h2 span{
            padding-left: 12px;
            font-size: 18px;
        }
        .payment .lifting_other p{
            margin-bottom: 0;
            padding-right: 30px;
            font-size: 14px;
            font-weight: 500;
            color: #999;
        }
        .payment .lifting_other p span{
            padding: 0 5px 1px;
            border-radius: 3px;
            background: #f1eade;
            color: #cfba93;
        }
        .payment .lifting_other .icon_payment_arrow{
            position: absolute;
            right: 10px;
            top: calc(50% - 18px);
            display: inline-block;
            width: 15px;
            height: 29px;
            background: url("<?php echo __PUBLIC__?>images/payment_arrow_icon.png") no-repeat;
        }
        .btn_wrap{
            padding: 8px 30px;
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
<form action="<?php echo base_url('buy/pay');?>" method="post">
	<input type="hidden" name="cardid" value="<?php echo $cardid;?>"/>
    <div class="con_box payment">
    	
        <h2 class="title">
            会员卡信息
        </h2>
        <div class="card_info">
            <!-- ispa卡使用 card_payment_ispa.png -->
            <img class="center-block img-responsive" src="<?php echo __PUBLIC__?>images/<?php if($card['kind'] == 'ispa'):?>card_payment_ispa.png<?php else:?>card_payment_escapespa.png<?php endif;?>">
            <p>
                <span><?php echo $card['cardname'];?></span>
                <span><?php echo formatMoney( $card['money'] );?></span>
            </p>
        </div>
    </div>
    <div class="con_box payment">
        <h2 class="title">
            收货信息
            <span>（礼包收取地址）</span>
        </h2>
        <div class="weui-tab" id="tab_switch">
            <div class="weui-navbar">
                <div class="weui-navbar__item"><span>门店自提</span></div>
                <div class="weui-navbar__item"><span>快递收货</span></div>
            </div>
            <div class="weui-tab__panel">
                <div class="weui-tab__content">
                    <div class="lifting_self">
                        <h4>提货码</h4>
                        <p>下单成功后提货码会以短信的形式发送到你手机。</p>
                    </div>
                </div>
                <div class="weui-tab__content" onclick="href('<?php echo base_url('userinfo/address?cardid='.$cardid);?>')">
                    <div class="lifting_other">
                    	<?php if( $address ):?>
                        <h2>
                            <?php echo $address['receiver_name'];?>
                            <span><?php echo $address['receiver_mobile'];?></span>
                        </h2>
                        <p>
                            <?php if( $address['is_default'] == 'yes' ):?>
                            <span>默认</span>
                            <?php endif;?>
                            <?php echo $address['address'];?>
                            <input type="hidden" name="address_id" id="address_id" value="<?php echo $address['id'];?>">
                        </p>
                        <?php else:?>
                          <h2>
                          </h2>
                          <p>
                          		您还没有添加收货地址，请添加地址
                          		<input type="hidden" name="address_id" id="address_id" value="0">
                          </p>
                        <?php endif;?>
                        <i class="icon_payment_arrow"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="con_box payment">
        <h2 class="title">
            应付金额：<?php echo formatMoney( $card['money'] );?>
        </h2>
        <div class="btn_wrap">
        	<input type="hidden" value="<?php echo $chooseExpress ? 'express' : 'shop';?>" name="get_way" id="get_way"/>
            <a href="javascript:;" class="btn btn_big" id="gotoPay">立即支付</a>
        </div>
    </div>
	</form>	
<script>
    
    
  
    weui.tab('#tab_switch',{
        defaultIndex: <?php echo  $chooseExpress ? 1 : 0;?>,
        onChange: function(index){
			if( index == 1 ) {
				$('#get_way').val('express');
			} else{
				$('#get_way').val('shop');
			}
            
        }
    });

	$('#gotoPay').click(function(){

		$('form').submit();
	})


</script>
</body>
<script>
    window.onload = function () { 
        // alert($(".slick-active").width())
        a_width = $(".slick-active").width();
        // $(".slick-slide").width($(".slick-active").width());
    }
  
</script>
</html>