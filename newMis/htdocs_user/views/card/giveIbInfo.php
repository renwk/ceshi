<style>
        .transferresult h1{
            font-size:16px;
            color: #333;
        }
        .transferresult h4{
            margin-top:25px;
            font-size:16px;
            color: #cfba93;
            font-weight:normal;
        }
        .transferresult .tips{
            margin-top:14px;
            font-size:14px;
            color: #999;
        }
        .transferresult .result_img{
            margin-top:30px;
            text-align: center;
        }
        .transferresult .result_img img{
            width:auto;
            max-width:100%;
        }
        .transferresult h2{
            margin-top:30px;
            margin-bottom:12px;
            padding-bottom:10px;
            border-bottom: 1px solid #e3e3e3;
            font-size:18px;
            color: #333;
        }
        .transferresult .transfer_info{
            min-height:150px;
        }
        .transferresult .transfer_info p{
            overflow: hidden;
            margin-bottom:15px;
        }
        .transferresult .transfer_info p span{
            float: right;
        }
    </style>
<body class="p12">

<div class="con_box transferresult">
    <h1 style="margin-top:0;line-height:1.6"><b>你已经成功将你账号中价值<?php echo ib2Money( $give['ib_all'] );?>元的爱币<br>转增给你关心的人！</b></h1>
    <h4><b>分享此页面给你的好友，通知他们领取。</b></h4>
    <p class="tips">注：72小时未领取，爱币将自动退回到你的账号中。</p>
    <div class="result_img">
        <img src="<?php echo __PUBLIC__;?>images/transfer_result.png">
    </div>
    <h2><b>转赠信息</b></h2>
    <div class="transfer_info">
    <?php if($info):?>
    	<?php foreach ($info as $v):?>
        <p>
            <?php echo $v['accept_mobile']?>
            <span><?php echo $v['accept_ib']?>爱币</span>
        </p>
        <?php endforeach;?>
     <?php endif;?>
    </div>
    <div>

    </div>
</div>



</body>
</html>

<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script><!--调用JSSDK-->
<script>

var shareUrl = '<?php echo base_url('card/acceptIb/'.$give['id'])?>';
var shareImg = '<?php echo __PUBLIC__;?>images/share_module/ispa.jpg';
var title = '您的好友给您送爱币啦';
var desc = '您的好友给您送爱币啦';

wx.config({

    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。

    appId: '<?php echo $jsSdkParams["appid"]; ?>', // 必填，公众号的唯一标识

    timestamp: '<?php echo $jsSdkParams["timestamp"]; ?>', // 必填，生成签名的时间戳

    nonceStr: '<?php echo $jsSdkParams["nonceStr"]; ?>', // 必填，生成签名的随机串

    signature: '<?php echo $jsSdkParams["signature"]; ?>',// 必填，签名，见附录1

    jsApiList: [
		'onMenuShareTimeline',
		'onMenuShareAppMessage',
              ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
});

wx.ready(function(){
	wx.onMenuShareTimeline({
	    title: title, // 分享标题
	    desc: desc,
	    link: shareUrl, // 分享链接，该链接域名必须与当前企业的可信域名一致
	    imgUrl: shareImg, // 分享图标
	    success: function () {
	        // 用户确认分享后执行的回调函数
	    },
	    cancel: function () {
	        // 用户取消分享后执行的回调函数
	    }
	});
	wx.onMenuShareAppMessage({
	    title: title, // 分享标题
	    desc: desc, // 分享描述
	    link: shareUrl, // 分享链接，该链接域名必须与当前企业的可信域名一致
	    imgUrl: shareImg, // 分享图标
	    type: '', // 分享类型,music、video或link，不填默认为link
	    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
	    success: function () {
	        // 用户确认分享后执行的回调函数
	    },
	    cancel: function () {
	        // 用户取消分享后执行的回调函数
	    }
	});

});

</script>    


