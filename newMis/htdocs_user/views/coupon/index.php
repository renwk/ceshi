<link rel="stylesheet" href="<?php echo __PUBLIC__.'css/coupon.css?v='.V;?>">
<body>
<div class="weui-tab" id="tab_switch">
    <!--<div class="weui-navbar-wrap">-->
    <div class="weui-navbar">
        <div class="weui-navbar__item weui-bar__item_on" onClick="couponList.changeTab('on', this);">待使用（<?php echo $countOn;?>）</div>
        <div class="weui-navbar__item" onClick="couponList.changeTab('used', this);">使用记录（<?php echo $countUsed;?>）</div>
        <div class="weui-navbar__item" onClick="couponList.changeTab('expired', this);">已过期（<?php echo $countExpired;?>）</div>
    </div>
    <!--</div>-->
    <div class="weui-tab__panel">
        <div class="weui-tab__content" id="coupon_content" style="display: block">
           
        </div>
    </div>
</div>
<script>



var loadFlag = true;
var couponList = new function(){
	this.param = new Array();
	this.url =  "<?php echo base_url('coupon/getList')?>";
	
	this.param['state'] = 'on';
	this.loadList =  function(){
			if(!loadFlag) {
				return;
			}
			$('#coupon_content').html('<center>数据加载中...</center>');
			loadFlag = false;
			loadMod(couponList.url, couponList.param, function(data){
					loadFlag = true;
					$('#coupon_content').html(data);
			})

	}
	this.changeTab = function(state, obj){
		couponList.param['state'] = state;
		$(obj).addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
		couponList.loadList();
	}
}
couponList.loadList();

</script>
</body>
</html>
