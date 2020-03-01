
<script>
function onBridgeReady(){
   WeixinJSBridge.invoke(
       'getBrandWCPayRequest', <?php echo $jsApiParameters; ?>,
       function(res){
//		   for (var xxx in res) {
//			   alert( xxx + ' = ' + res[xxx] );
//		   };
		   if (res.err_msg == "get_brand_wcpay_request:ok") {
			   href('<?php echo base_url('card/index')?>');
		   } else if (res.err_msg == "get_brand_wcpay_request:cancel") {
			   history.back();
		   } else if (res.err_msg == "get_brand_wcpay_request:fail") {
			  Xalert('支付失败');
		   }
       }
   ); 
};
if (typeof WeixinJSBridge === "undefined"){
   if( document.addEventListener ){
       document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
   }else if (document.attachEvent){
       document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
       document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
   }
} else {
	onBridgeReady();
}

</script>