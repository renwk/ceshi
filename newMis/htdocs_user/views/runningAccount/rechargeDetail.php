    <style>
        .list_box{
            position: relative;
            margin-bottom:0;
            list-style: none;
            font-size:14px;
            color: #333;
        }
        .list_box li{
            line-height: 1.9em;
        }
        .list_box li span{
            display: inline-block;
            width:86px;
            color: #666;
        }
        .list_box .i_ellipsis{
            position: absolute;
            right: -6px;
            bottom: 6px;
            display: inline-block;
            width: 16px;
            height: 16px;
            border-radius: 99px;
            background: #cfba93;
            color: #fff;
        }
        .list_box .i_ellipsis:before {	
            content: '...';	
            display: block;	
            position: absolute;	
            left: 1px;	
            bottom: 1px;
            font-size: 16px;
        }
        .tab_con{

        }
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
            line-height: 1.9em;
        }
        .list_coupon .name{
            float: left;
        }
        .result{
            overflow: hidden;
            margin-bottom:12px;
            padding: 6px 12px 6px;
            text-align: right;
            background: #e3e3e3;
            border-radius:10px 10px;
        }
        .result .name{
            float: left;
        }
        .paid_btn_wrap{
            overflow: hidden;
        }
        .paid_btn,
        .paid_btn:visited,
        .paid_btn:hover,
        .paid_btn:active,
        .paid_btn:focus{
            display: inline-block;
            width:calc(50% - 7px);
            border-radius: 18px;
            text-align: center;
            font-size:17px;
            color: #fff;
        }
        .paid_btn_wrap .paid_btn:last-child{
            float: right;
        }
        /* 快递 */
        .postal_box{

        }
        .postal_box .postal_con{
            position: relative;
            padding-left: 43px;
            margin-bottom: 22.5px;
        }
        .postal_box .postal_con:before {	
            content: ' ';	
            display: block;	
            position: absolute;	
            left: 10px;	
            top: calc(50% - 4px);
            width: 8px;
            height: 8px;
            border: 2px solid #e3e3e3;
            border-radius: 50%;
            background: #e3e3e3;
            font-size: 16px;
        }
        .postal_box .postal_con:before {	
            content: ' ';	
            display: block;	
            position: absolute;	
            left: 10px;	
            top: calc(50% - 4px);
            width: 8px;
            height: 8px;
            border: 2px solid #e3e3e3;
            border-radius: 50%;
            background: #e3e3e3;
            font-size: 16px;
            z-index: 9;
        }

        .postal_box .postal_con:after {	
            content: ' ';	
            display: block;	
            position: absolute;	
            left: 13.5px;	
            top: 0;
            width: 1px;
            height: calc(100% + 22.5px);
            border-left: 1px dashed #e3e3e3;
            border-radius: 50%;
            background: #e3e3e3;
            font-size: 16px;
        }
        .postal_box .postal_con:first-child:after{
            top: 13px;
        }
        .postal_box .postal_con:last-child:after{
            height: calc(100% - 15px);
        }
        /* .postal_box .postal_con.curr{

        } */
        .postal_box .postal_con.curr:before {
            border-color: #e2d6be;
            background: #cfba93;
        }
        .postal_box .postal_con:last-child{
            padding-bottom: 0;
        }
        .postal_box .postal_con.curr h3,
        .postal_box .postal_con.curr h4,
        .postal_box .postal_con.curr p{
            color: #cfba93;
        }
        .postal_box .postal_con h3,
        .postal_box .postal_con h4,
        .postal_box .postal_con p{
            margin: 0;
            font-size: 12px;
        }
        .postal_box .postal_con h3{
            color: #333;
        }
        .postal_box .postal_con h4{
            margin: 7.5px 0 7px;
            color: #333;
        }
        .postal_box .postal_con p{
            color:#999;
        }
        .postal_box .postal_con a{
            color: #cfba93;
        }
        #postalInfoBox .modal-dialog{
            margin-top: 120px;
        }
    </style>
<body class="p12">
<div class="con_box">
    <ul class="list_box">
        <li>
            <span>订单号</span>
            <?php echo $order['oid'];?>
        </li>
        <li>
            <span>充值门店</span>
            <?php  echo $order['store']['sname'];?>
        </li>
        <li>
            <span>充值时间</span>
            <?php echo date('Y-m-d H:i:s', $order['create_time']);?>
        </li>
        <li>
            <span>服务顾问</span>
            <?php if( isset($order['adviser']) &&  !empty($order['adviser']) ):?>
            <?php echo implode('、', array_column($order['adviser'], 'nickname') );?>
            <?php endif;?>
        </li>
        <li>
            <span>会员卡号</span>
            <?php echo $order['card_no'];?>
        </li>
    </ul>
</div>
<?php if( isset( $order['cardinfo'] ) && !empty($order['cardinfo'])   )?>
<?php foreach ($order['cardinfo'] as $v):?>
<div class="result">
    <span class="name"><?php echo $v['cardname'];?></span>
    <?php echo formatMoney( round($v['money']/100, 2) );?>
</div>
<?php endforeach;?>
<div class="panel-group con_box tab_con" >
    <div class="tab_title">
        赠送信息
    </div>
    <div class="" >
        <ul class="list_box">
        <?php if( isset($order['coupon_array']) && !empty($order['coupon_array']) ):?>
            <?php foreach ($order['coupon_array']  as $cv ):?>
            <li>
                <span>优惠券</span>
                <?php echo $cv['coupon_name'];?>*<?php echo $cv['num'];?>                
            </li>
            <?php endforeach;?>
        <?php endif;?>    
            <li>
                <span>赠送次数</span>
                <?php echo $order['free_num'];?>次
            </li>
        </ul>
    </div>
</div>

<div class="panel-group con_box tab_con" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="tab_title" role="tab" id="headingOne">
        结算信息
        <a class="tab_close" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            查看详情
        </a>
    </div>
    <ul class="list_box" id="collapseOneTitle">
        <li>
            <span>实付金额</span>
            <?php echo formatMoney($order['money_true']);?>
        </li>
    </ul>
    <!--in-->
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <ul class="list_box">
            <li>
                <span>订单金额</span>
                <?php echo formatMoney($order['money_full']);?>
            </li>
            <li>
                <span>优惠金额</span>
                <?php echo formatMoney( $order['money_list'] - $order['money_true']);?>
            </li>
            <li>
                <span>手续费</span>
                <?php echo formatMoney( round($order['cost'], 2) );?>
            </li>
             <li>
                 <span>实付金额</span>
            <?php echo formatMoney($order['money_true']);?>
            </li>
        </ul>
    </div>
</div>
<div class="panel-group con_box tab_con" id="accordion2" role="tablist" aria-multiselectable="true">
    <div class="tab_title" id="">
        支付信息
    </div>
    <div class="" >
        <ul class="list_box">
        	<?php if( !empty($order['order_paytype']) ):?>
	            <?php foreach ($order['order_paytype'] as $pv):?>
		            <li>
		                <span><?php echo  $pv['paytype'];?></span>
		                <?php echo formatMoney( round($pv['money']/100, 2) );?>
		            </li>
	            <?php endforeach;?>
            <?php endif;?>
        </ul>
    </div>
</div>
<?php if( !empty($order['buy_card_extension']) && $order['buy_card_extension']['get_way'] == 'shop' ): ?>
<!-- 门店自提 -->
<div class="panel-group con_box tab_con" id="" role="tablist" aria-multiselectable="true">
    <div class="tab_title" id="">
        门店自提
    </div>
    <div class="" >
        <ul class="list_box">
            <li>
                <span>提货码</span>
                <?php echo $order['buy_card_extension']['get_code']?>
            </li>
        </ul>
    </div>
</div>
<?php elseif ( !empty($order['buy_card_extension']) && $order['buy_card_extension']['get_way'] == 'express' ):?>
<!-- 快递上门 -->
<div class="panel-group con_box tab_con" id="" role="tablist" aria-multiselectable="true">
    <div class="tab_title" id="">
        快递上门
    </div>
    <div class="" >
        <ul class="list_box">
            <li>
                <span>收货人</span>
                <?php echo $order['buy_card_extension']['receiver_name']?>
            </li>
            <li>
                <span>收货电话</span>
                <?php echo $order['buy_card_extension']['receiver_mobile']?>
            </li>
            <li>
                <span>收货地址</span>
                <?php echo $order['buy_card_extension']['address']?>
            </li>
            <li>
                <span>快递单号</span>
                <?php echo $order['buy_card_extension']['express_number']?>
            </li>
            <li>
                <span>物流信息</span>
                【广州市】快件已从广州中心发出...
            </li>
            <i class="i_ellipsis"  data-toggle="modal" data-target="#postalInfoBox"></i>
        </ul>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="postalInfoBox">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center">物流信息</h4>
        </div>
        <div class="modal-body">
            <div class="postal_box">
                <div class="postal_con curr">
                    <h3>亲，包裹已投入您的怀抱，爱你哟～</h3>
                    <p>2018.9.20   15:20</p>
                </div>
                <div class="postal_con">
                    <h3>包裹已分配给配送员派送，联系方式</h3>
                    <h4>手机：<a href="tel:12345678910">12345678910</a></h4>
                    <p>2018.9.20   15:20</p>
                </div>
                <div class="postal_con">
                    <h3>【深圳市】广东深圳公司福田区面分拨部已发出已发</h3>
                    <p>2018.9.20   15:20</p>
                </div>
                <div class="postal_con">
                    <h3>【深圳市】广东深圳公司福田区面分拨部已发出</h3>
                    <p>2018.9.20   15:20</p>
                </div>
                <div class="postal_con">
                    <h3>【深圳市】广东深圳公司福田区面分拨部已发出</h3>
                    <p>2018.9.20   15:20</p>
                </div>
            </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php endif;?>

</body>
<script type="application/javascript">
    $(function(){
        $('#collapseOne').on('hide.bs.collapse', function () {
            $("#collapseOneTitle").show();
        })
        $('#collapseOne').on('show.bs.collapse', function () {
            $("#collapseOneTitle").hide();
        })
    });
</script>
</html>