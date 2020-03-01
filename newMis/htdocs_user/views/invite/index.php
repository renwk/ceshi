 <style>
        .invite_friends{
            position: relative;
            width:100%;
        }
        .invite_friends .show_new{
            border-radius: 12px;
        }
        .invite_friends .con{
            position: absolute;
            bottom:12px;
            left:12px;
            padding:12px 0 12px 12px;
            width:calc(100% - 24px);
            overflow: hidden;
            background: #fff;
            -webkit-border-radius:12px;
            -moz-border-radius:12px;
            border-radius:12px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .invite_friends .img{
            float: left;
            width:64px;
        }
        .invite_friends .info{
            float: left;
            padding-left:10px;
            font-size:14px;
        }
        .invite_friends .info h3{
            margin-top:8.5px;
            font-size:14px;
        }
        .invite_friends .info p{
            margin:0;
            line-height: 1.9em;
            color: #cfba93;
        }
        .select_module{
            overflow: hidden;
            padding-top:12px;
        }
        .select_module .con{
            position: relative;
            float: left;
            width:50%;
            height:101px;
            padding-right:6px;
        }
        .select_module .con .img_warp{
            position: relative;
            width:auto;
        }
        .select_module .con img{
            -webkit-border-radius:14px;
            -moz-border-radius:14px;
            border-radius:14px;
        }
        .select_module .con p{
            margin:0;
            position: absolute;
            bottom:0px;
            left:0;
            width:100%;
            height:32px;
            line-height:32px;
            background: rgba(0,0,0,.1);
            text-align: center;
            color: #fff;
            font-size:12px;
        }
        .select_module .con:nth-child(2n){
            padding-right:0;
            padding-left:6px;
        }
        .btn_wrap{
            margin-top:12px;
        }
    </style>
<body class="p12">
<div class="mask_layer"><div class="share_tips"></div></div>
<div class="invite_friends">
    <img class="center-block img-responsive show_new" id="module_show" src="<?php echo __PUBLIC__;?>images/share_module/share_module_1_medium.jpg">
    <div class="con">
        <div class="img">
            <img class="center-block img-responsive" src="<?php echo __PUBLIC__;?>images/qer_test.png">
        </div>
        <div class="info">
            <h3><?php echo $wechat['nickname'];?>，邀请你体验iSpa！</h3>
            <p>注册立即领取100.00元无门槛优惠券。</p>
        </div>
    </div>
</div>
<div class="select_module">
    <div class="con module_img">
        <div class="img_warp">
            <img class="center-block img-responsive" src="<?php echo __PUBLIC__;?>images/share_module/share_module_1_min.jpg" data-img="<?php echo __PUBLIC__;?>images/share_module/share_module_1_medium.jpg" data-template="templateA">
            <p>模板一</p>
        </div>
    </div>
    <div class="con module_img">
        <div class="img_warp">
            <img class="center-block img-responsive" src="<?php echo __PUBLIC__;?>images/share_module/share_module_2_min.jpg" data-img="<?php echo __PUBLIC__;?>images/share_module/share_module_2_medium.jpg"  data-template="templateB">
            <p>模板二</p>
        </div>
    </div>
</div>
<div class="btn_wrap">
    <a href="javascript:;" class="btn btn_big" id="inviteFriend">邀请好友</a>
</div>

<script type="text/javascript">
 var shareUrl = '<?php echo base_url('invite/templateA/'.$login_wechat_id)?>';
 var shareImg = '<?php echo __PUBLIC__;?>images/share_module/ispa.jpg';
    $(".module_img").click(function(){
        var show_url = $(this).find('img').attr("data-img");
        var template = $(this).find('img').attr("data-template");
        $("#module_show").attr('src',show_url);

	
        if( template == 'templateB' ) {
			shareUrl = '<?php echo base_url('invite/templateB/'.$login_wechat_id)?>';
		} else{
			shareUrl = '<?php echo base_url('invite/templateA/'.$login_wechat_id)?>';
		}

        wx.ready(function(){
        	wx.onMenuShareTimeline({
        	    title: "记住，你已经照顾了全世界，别忘了照顾你自己。", // 分享标题
        	    desc: '爱生活，爱自己。',
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
        	    title:  "记住，你已经照顾了全世界，别忘了照顾你自己。", // 分享标题
        	    desc: '爱生活，爱自己。', // 分享描述
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
        
    });
</script>

<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script><!--调用JSSDK-->
<script>
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
$('#inviteFriend').click(function(){
	
})

wx.ready(function(){
	wx.onMenuShareTimeline({
	    title: "<?php echo $wechat['nickname'];?>，邀请你体验iSpa健康之路！", // 分享标题
	    desc: '注册立即领取100.00元无门槛优惠券。',
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
	    title:  "<?php echo $wechat['nickname'];?>，邀请你体验iSpa健康之路！", // 分享标题
	    desc: '注册立即领取100.00元无门槛优惠券。', // 分享描述
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
$("#inviteFriend").click(function(){
    $(".mask_layer").show();
});

/*删除遮罩层*/
$(".share_tips").click(function(){
    $(".mask_layer").hide();
});

</script>    
</body>
</html>