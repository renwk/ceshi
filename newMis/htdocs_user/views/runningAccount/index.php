<link rel="stylesheet" href="<?php echo __PUBLIC__.'css/runningAccount.css?v='.V;?>">
<body>
<div class="weui-tab" id="tab_switch">
    <!--<div class="weui-navbar-wrap">-->
    <div class="weui-navbar">
        <div class="weui-navbar__item weui-bar__item_on"   onClick="runningAccountList.changeTab('cousumption', this);"><span>消费记录</span></div>
        <div class="weui-navbar__item"  onClick="runningAccountList.changeTab('recharge', this);"><span>充值记录</span></div>
    </div>
    <!--</div>-->
    <div class="weui-tab__panel">
        <div class="weui-tab__content" style="display: block;" id="runningAccountContent">
        		
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade favorites_modal" id="favorites_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   
</div>

</body>
</html>
<script>

var loadFlag = true;
var runningAccountList = new function(){
	this.param = new Array();
	this.url =  "<?php echo base_url('runningAccount/getList')?>";
	
	this.param['type'] = 'cousumption';
	this.loadList =  function(){
			if(!loadFlag) {
				return;
			}
			$('#runningAccountContent').html('<center>数据加载中...</center>');
			loadFlag = false;
			loadMod(runningAccountList.url, runningAccountList.param, function(data){
					loadFlag = true;
					$('#runningAccountContent').html(data);
			})

	}
	this.changeTab = function(type, obj){
		runningAccountList.param['type'] = type;
		$(obj).addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
		runningAccountList.loadList();
	}
}
runningAccountList.loadList();

function showAddCollect(type, id)
{
		if(!loadFlag) {
			return;
		}
		if( !type || !id ) {
			return;
		}
		
	    var url =  "<?php echo base_url('collect/addCollect')?>";
	    loadFlag = false;
	    loadMod(url, {type:type, id:id}, function(data){
			loadFlag = true;
			$('#favorites_modal').html(data);
			$('#favorites_modal').modal('show');
		})
}

		
</script>