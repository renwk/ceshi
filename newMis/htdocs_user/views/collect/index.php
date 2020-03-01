<link rel="stylesheet" href="<?php echo __PUBLIC__.'css/collect.css?v='.V;?>">
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.touchSwipe.min.js?v='.V;?>"></script>
<body>
<div class="weui-tab" id="tab_switch">
    <!--<div class="weui-navbar-wrap">-->
    <div class="weui-navbar">
        <div class="weui-navbar__item weui-bar__item_on" onClick="collectList.changeTab('store', this);"><span>门店</span></div>
        <div class="weui-navbar__item" onClick="collectList.changeTab('beauticianAndConsultant', this);"><span>顾问理疗师</span></div>
    </div>
    <!--</div>-->
    <div class="weui-tab__panel">
        <div class="weui-tab__content"     id="coupon_content" style="display: block">
            
        </div>
    </div>
</div>

<script>



var loadFlag = true;
var collectList = new function(){
	this.param = new Array();
	this.url =  "<?php echo base_url('collect/getList')?>";
	
	this.param['type'] = 'store';
	this.loadList =  function(){
			if(!loadFlag) {
				return;
			}
			$('#coupon_content').html('<center>数据加载中...</center>');
			loadFlag = false;
			loadMod(collectList.url, collectList.param, function(data){
					loadFlag = true;
					$('#coupon_content').html(data);
			})

	}
	this.changeTab = function(type, obj){
		collectList.param['type'] = type;
		$(obj).addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
		collectList.loadList();
	}
}
collectList.loadList();

</script>
</body>
</html>