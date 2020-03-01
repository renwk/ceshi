<!-- Modal -->
<div class="modal fade favorites_modal" id="card_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body fmodal_body">
                <div class="card"><!--card start-->
                    <h2>
                        <img src="<?php echo __PUBLIC__?>images/card_ispa.png">
                        储值卡
                    <span class="card_no">
                        NO：<?php echo $card['card_no']?>
                    </span>
                    </h2>
                    <h3>
                        <?php echo $card['cardname']?>
                    </h3>
                    <div class="card_info">
                        <div class="money">
                            <?php echo $card['money_available']?><br>
                            剩余金额
                        </div>
                        <div class="discount">
                            iSpa折扣：<?php echo $card['serviceDiscountIspa']?>%<br>
                            隐逸折扣：<?php echo $card['serviceDiscountEasy']?>%
                        </div>
                    </div>
                    <div class="time">
                        有效期至：<?php echo date('Y-m-d', $card['time_validity']);?>
                    </div>
                    <div class="card_status">正常</div>
                </div><!--card end-->
                <h2>你可以将爱币转赠给你的亲朋好友，一起享受iSpa泰美好的优质服务～</h2>
                <p>注：转赠一旦成功不支持撤回。</p>
                <div class="transfer_con">
                    <div class="ib_row">
                        <span>手机号码</span>
                        <input type="text" class="ib_phone">
                        <span>爱币金额</span>
                        <input type="text" class="ib_money">
                        <span class="ib_btn_add"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer container-fluid fmodal_footer">
                <div class="row">
                    <div class="col-xs-6" style="padding-right:6px;">
                        <button type="button" class="btn btn-block btn_yellow" data-dismiss="modal">取消</button>
                    </div>
                    <div class="col-xs-6" style="padding-left:6px;">
                        <button type="button" class="btn btn-block btn_yellow" id="submitButton">确认</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
var ib_row_html = '<div class="ib_row">'+
'<span>手机号码</span>'+
'<input type="text" class="ib_phone">'+
'<span>爱币金额</span>'+
'<input type="text" class="ib_money">'+
'<span class="ib_btn_del"></span>'+
'</div>';
$(".ib_btn_add").click(function(){
	$(".transfer_con").append(ib_row_html);
	ib_del_this();
});

function ib_del_this()
{
	$(".ib_btn_del").click(function(){
		$(this).parent(".ib_row").remove();
	});
}


var loadFlag = true;
$('#submitButton').click(function(){
	if( !loadFlag ) {
		return false;
	}
	
	var checkFlag = true;
	var param = new Array();
	$('.ib_row').each(function(){
		var phone  = $(this).find('.ib_phone').val();
		var money = $(this).find('.ib_money').val();
		if( !phone ) {
			Xalert('请填写手机号码', 1000);
			checkFlag = false;
			return false;
		}
		if(  !isMobile(phone) ) {
			Xalert('手机号码填写错误', 1000);
			checkFlag = false;
			return false;
		}
		
		if( !money ) {
			Xalert('请填写爱币金额', 1000);
			checkFlag = false;
			return false;
		}
		var json = {mobile:phone,ib:money}
		param.push( json );
	});
	if( !checkFlag ) {
		return false;
	}
	loadFlag = false;
	
	var url = '<?php echo base_url('card/actionGiveIb')?>';
	loadMod(url, {give_info:JSON.stringify(param), mycardid:<?php echo $card['mycardid']?>}, function(data){
		loadFlag = true;

		var json = $.parseJSON(data);
		if( json.msg === 'success' ) {
			href('<?php echo base_url('card/giveIbInfo/');?>'+json.give_id);
		} else	{
			Xalert(json.msg, 1000);
		}
	})
})

$('#card_modal').modal('show');
</script>