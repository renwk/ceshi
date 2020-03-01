 <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/nocard.css?v='.V;?>">
<body class="p12">
<div class="con_box">
    <div class="userrecharge_tips">
        会员卡充值，目前只针对会员续费不支持新购卡，如果需要购买新卡，请联系门店了解详细信息~
    </div>
    <h2 class="userrecharge_title">门店信息</h2>
    <div id="stroe_div">
       	正在加载中...... 
    </div>
</div>
</body>
</html>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script><!--调用JSSDK-->
<script>
 
var longitude = '';
var latitude = '';

wx.config({

    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。

    appId: '<?php echo $jsSdkParams["appid"]; ?>', // 必填，公众号的唯一标识

    timestamp: '<?php echo $jsSdkParams["timestamp"]; ?>', // 必填，生成签名的时间戳

    nonceStr: '<?php echo $jsSdkParams["nonceStr"]; ?>', // 必填，生成签名的随机串

    signature: '<?php echo $jsSdkParams["signature"]; ?>',// 必填，签名，见附录1

    jsApiList: [
		'getLocation',
              ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2

});
wx.ready(function(){

    // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
	wx.getLocation({

	    type: 'gcj02', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'

	    success: function (res) {
	   	 //alert(JSON.stringify(res)); 
	         latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90

	         longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。

	         //alert(longitude+','+latitude);

			loadMod("<?php echo base_url('recharge/storeList'); ?>", {latitude:res.latitude, longitude:res.longitude}, function(data){
				$('#stroe_div').html(data);
			})
	    },
	cancel: function (res) {
	    alert('用户拒绝授权获取地理位置');
	  },
	  fail: function (res) {
	    alert(JSON.stringify(res));
	  }
	});

	 
});
wx.error(function(res){

    // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。

});
</script>
