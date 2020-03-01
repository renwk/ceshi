
<link rel="stylesheet" href="<?php echo __PUBLIC__.'slick/slick.css?v='.V;?>">
<link rel="stylesheet" href="<?php echo __PUBLIC__.'css/recharge.css?v='.V;?>">
<script type="text/javascript" src="<?php echo __PUBLIC__.'slick/slick.min.js?v='.V;?>"></script>
   
<body class="p12">
<div class="weui-tab" id="tab_switch">
    <!--<div class="weui-navbar-wrap">-->
    <div class="weui-navbar">
        <div class="weui-navbar__item" onclick="href('<?php echo base_url('buy/index');?>')"><span>购卡</span></div>
        <div class="weui-navbar__item weui-bar__item_on"><span>续费</span></div>
    </div>
    <!--</div>-->
    <div class="weui-tab__panel">
        <div class="weui-tab__content" style="display:block">
            <?php if($card):?>
            <div class="con_box">
                <div class="slick">
                	<?php foreach ($card as $v):?>
                    <div  data-id="<?php echo $v['mycardid'] ?>" class="card_div">
                        <div class="card"><!--card start-->
                            <h2>
                                <img src="<?php echo __PUBLIC__;?>images/card_ispa.png">
                                储值卡
                                <span class="card_no">
                                    NO：<?php echo $v['ucard_no'];?>
                                </span>
                            </h2>
                            <h3>
                                <?php echo $v['cardname'];?>
                            </h3>
                            <div class="card_info">
                                <div class="money">
                                    <?php echo formatMoney($v['money_available'])?><br>
                                    剩余金额
                                </div>
                                <div class="discount">
                                    iSpa折扣：<?php echo $v['serviceDiscountIspa']?>%<br>
                                    隐逸折扣：<?php echo $v['serviceDiscountEasy']?>%
                                </div>
                            </div>
                            <div class="time">
                                有效期至：<?php echo date('Y-m-d', $v['time_validity']);?>
                            </div>
                            <span class="def_money" style="display:none"><?php echo $v['money'];?></span>
                            <span class="def_ib" style="display:none"><?php echo money2Ib($v['money']);?></span>
                            <span class="def_validity" style="display:none"><?php echo date('Y-m-d' , $v['time_validity'] + $v['validity_day']*86400); ?></span>
                            <span class="def_paymoney" style="display:none"><?php echo $v['money'];?></span>
                        </div><!--card end-->
                    </div>
                    <?php endforeach;?>
                </div>
            
            
                <div class="panel-group tab_con" id="accordion2" role="tablist" aria-multiselectable="true">
                    <div class="tab_title" id="">
                        充值信息
                    </div>
                    <div class="" >
                        <ul class="list_box">
                            <li id="def_money">
                                <span>充值金额</span>
                                <?php echo formatMoney( $card[0]['money'] ); ?>
                            </li>
                            <li id="def_ib">
                                <span>爱币金额</span>
                                <?php echo money2Ib( $card[0]['money'] ); ?>
                            </li>
                            <li id="def_validity">
                                <span>有效期</span>
                                <?php echo date('Y-m-d' ,$card[0]['time_validity'] + $card[0]['validity_day']*86400); ?>
                            </li>
                            <li id="def_paymoney">
                                <span>应付金额</span>
                                <?php echo formatMoney( $card[0]['money']); ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="btn_wrap">
                	<input type="hidden" value="<?php echo $card[0]['mycardid'];?>" id="select_mycardid"/>
                	<a href="javascript:;" class="btn btn_big" onclick="gotoPay()">支付</a>
                
                </div>
            </div>
            
            <?php else:?>
            	您还没有储值卡，点击<a href="<?php echo base_url('buy/index');?>">去购买</a>
            <?php endif;?>
   	 </div>
  </div>
</div>

<script>


    /*轮播*/
    $(function(){
        $('.slick').slick({
            dots: true,
            onAfterChange:function(on_this, on_index){

            	var mycardid = $('.card_div').eq(on_index+1).attr('data-id');
            	var def_money = $('.card_div').eq(on_index+1).find('.def_money').text();
            	var def_ib = $('.card_div').eq(on_index+1).find('.def_ib').text();
            	var def_validity = $('.card_div').eq(on_index+1).find('.def_validity').text();
            	var def_paymoney = $('.card_div').eq(on_index+1).find('.def_paymoney').text();
            	
				$('#def_money').html('<span>充值金额</span> '+def_money);
				$('#def_ib').html(  '<span>爱币金额</span> ' + def_ib);
				$('#def_validity').html( '<span>有效期</span> ' + def_validity);
				$('#def_paymoney').html('<span>应付金额</span> '+def_paymoney);
				
              	$('#select_mycardid').val(mycardid);
            }

            
        });
        
    });

	function gotoPay(){
		var mycardid = $('#select_mycardid').val();
		href('<?php echo base_url('recharge/pay/'); ?>'+mycardid);
		
        return false;
	}

	
</script>
</body>
</html>