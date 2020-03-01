<style>
          .list_box{
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
            width:92px;
            color: #666;
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
        .list_coupon .result{
            padding: 2px 12px 6px;
            background: #e3e3e3;
            border-radius: 0 0 10px 10px;
            margin: 0 -12px -12px;
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
            border-radius: 18px;
            text-align: center;
            font-size:17px;
            color: #fff;
        }
        .paid_btn_wrap .paid_btn:last-child{
            float: right;
        }
		
/*弹框*/
        .forget_modal{}
        .forget_modal .modal-dialog{
            margin-top:210px;
            margin-left:35px;
            margin-right:35px;
        }
        .forget_modal .modal-header{
            border-bottom:none;
        }
        .forget_modal .modal-content{
            border-radius:15px;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
        }
        .forget_modal .modal-footer{
            padding-top:0;
            padding-bottom:0;
            border-top:1px solid #d7d7d7;
        }

        .forget_modal .modal-footer .col-xs-6{
            text-align: center;
        }
        .forget_modal .modal-footer .col-xs-6:last-child{
            border-left:1px solid #d7d7d7;
        }
        .forget_modal .modal-footer .btn-link{
            padding-top:15px;
            padding-bottom:15px;
            font-size:16px;
            color: #cfba93;
        }
        .fmodal_body{
            padding-top:0;
        }
        .fmodal_body input{
            display: inline-block;
            padding-left:12px;
            width:100%;
            height:43px;
            line-height:43px;
            border:none;
            background: #f5f5f5;
            outline:none;
        }
        /*微信框*/
        .weui-dialog{
            border-radius:15px;
        }
        .weui-dialog__btn_primary{
            color: #cfba93;
        }
        .weui-dialog__bd{
            color: #666;
        }
        
        
    </style>
<body class="p12">
<div class="con_box">
    <ul class="list_box">
        <li>
            <span>消费门店</span>
            <?php echo $order['store']['sname'];?>
        </li>
        <li>
            <span>服务时间</span>
            <?php echo date('Y-m-d H:i:s', $order['start_time']);?>
        </li>
        <li>
            <span>服务顾问</span>
            <?php 
             $nameArray = array_column($order['adviser'], 'nickname');
          	 echo rtrim( implode('、', $nameArray) , '、');	
           ?>
        </li>
        <li>
            <span>服务理疗师</span>
           <?php 
             if( isset($order['beautician']) && !empty($order['beautician']) ) {
             	$nameArray = array_column($order['beautician'], 'nickname');
          	 	echo rtrim( implode('、', $nameArray) , '、');	
          	 }
           ?>
        </li>
        <li>
            <span>服务房间</span>
             <?php 
             $roomArray = array_column($order['store_room'], 'srname');
          	 echo rtrim( implode('、', $roomArray) , '、');	
           ?>
        </li>
    </ul>
</div>
<div class="con_box list_coupon">
    <ul>
    	<?php foreach ($order['item'] as $item):?>
        <li>
            <span class="name"><?php echo $item['iname'];?></span>
            <?php echo formatMoney( round($item['actual_price']/100, 2) );?>
        </li>
        <?php endforeach;?>
    </ul>
    <?php if( isset($order['coupon']) && !empty( $order['coupon'] ) ):?>
    <div class="result">
        <span class="name">优惠券</span>
        <?php echo $order['coupon']['couponname']?>
    </div>
    <?php endif;?>
</div>

<div class="panel-group con_box tab_con" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="tab_title" role="tab" id="headingOne">
        结算信息
        <a class="tab_close" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            查看详情
        </a>
    </div>
    <ul class="list_box">
        <li>
        	 <span>订单金额</span>
        	  <?php echo formatMoney( round($order['order_price']/100, 2) );?>
        </li>
    </ul>
    <!--in-->
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <ul class="list_box">
          
            <li>
                <span>优惠金额</span>
                <?php echo formatMoney( round($order['discount_price']/100, 2) );?>
            </li>
            <li>
                <span>服务费</span>
                <?php echo formatMoney( round($order['cover_charge']/100, 2) );?>
            </li>
            <li>
                <span>小费</span>
                <?php echo formatMoney( round($order['tip']/100, 2) );?>
            </li>
              <li>
                <span>实付金额</span>
                <?php echo formatMoney( round($order['actual_price']/100, 2) );?>
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
        	<?php foreach ($order['order_paytype'] as $pv):?>
            <li>
                <span><?php echo $pv['paytype'];?></span>
                <?php echo formatMoney( round($pv['money']/100, 2) );?>
            </li>
            <?php endforeach;?>
            </li>
        </ul>
    </div>
</div>


<?php if( $order['confirm_state']  === 'init'):?>
<!--	<div class="con_box paid_btn_wrap" style="display: none">-->
	<div class="con_box paid_btn_wrap" >
    	<a href="javascript:;" class="btn btn_big paid_btn"  <?php   if( !$have_transaction_password ):?>onclick="setPwdNotice()" <?php else:?>onclick="userConfirm()" <?php endif;?>>消费确认</a>
 	</div>
 <?php elseif( $order['confirm_state']  === 'confirm'  ):?>  
 	<?php if( !$order['comment'] ):?> 
	 	<div class="con_box paid_btn_wrap">
	    	<a href="<?php echo base_url('comment/index/'.$order['id']);?>" class="btn btn_big paid_btn">去评价，赚爱星</a>
	    </div>	
    <?php endif;?>
 <?php endif;?>   

<!-- Modal -->
<div class="modal fade forget_modal" id="forget_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header fmodal_header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">支付密码</h4>
            </div>
            <div class="modal-body fmodal_body">
                <input type="password" placeholder="请输入支付密码" id="password">
            </div>
            <div class="modal-footer container-fluid fmodal_footer">
                <div class="row">
                    <div class="col-xs-6" style="padding-left:0px;padding-right:6px;" data-dismiss="modal">
                        <button type="button" class="btn-link">取消</button>
                    </div>
                    <div class="col-xs-6" style="padding-left:6px;padding-right:0px;" id="submitConfirm">
                        <button type="button" class="btn-link">确认</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


</body>
</html>
<script>


function setPwdNotice(){
	weui.dialog({
        title: '提示',
        content: '你还未设置密码',
        className: 'password_null',
        buttons: [ {
            label: '去设置',
            type: 'primary',
            onClick: function () {
            	gotoSetPwd();
            }
        }]
    });
}
           
function gotoSetPwd(){
	href("<?php echo base_url('userinfo/transactionPassword');?>");
}


/*支付密码错误*/
function pwErrorAlert(content)
{
    weui.dialog({
        title: "",
        content: content,
        className: 'pwErrorAlert',
        buttons: [ {
            label: '忘记密码',
            type: 'default',
            onClick: function () {
            	gotoSetPwd();
            }
        },
            {
                label: '重试',
                type: 'primary',
                onClick: function () {

                }
            }]
    });
}




function userConfirm()
{
	$('#forget_modal').modal('show');
}
var submitFlag = true;
$('#submitConfirm').click(function(){
	if( !submitFlag ) {
		return;
	}
	var password = $('#password').val();	
	if( !password ) {
		Xalert('请输入支付密码', 1000);
		return;
	}
	submitFlag = false;
	var url = "<?php  echo base_url('runningAccount/actionConfirmOrder'); ?>"
	var param = {password:password, id:'<?php echo $order['id']; ?>'}
	loadMod( url, param, function( data ){
		submitFlag = true;
		if(data.replace(/\s/g,'') == 'success'){
			window.location.reload();
            return false;
		}else{
			$('#forget_modal').modal('hide');
			pwErrorAlert(data);
			return false;
		}

	} )

	
	
})	   	        
	
           
 </script>          



