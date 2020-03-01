 <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/card.css?v='.V;?>">
<body>

<div class="weui-tab" id="tab_switch">
    <!--<div class="weui-navbar-wrap">-->
        <div class="weui-navbar">
            <div class="weui-navbar__item weui-bar__item_on" onClick="cardList.changeTab('all', this);">全部</div>
            <div class="weui-navbar__item" onClick="cardList.changeTab('normal', this);">正常</div>
            <div class="weui-navbar__item" onClick="cardList.changeTab('frozen', this);">冻结</div>
            <!-- div class="weui-navbar__item" onClick="cardList.changeTab('expired', this);">已失效</div-->
        </div>
    <!--</div>-->
    <div class="weui-tab__panel">
    	<div class="weui-tab__content" id="card_content" style="display: block">

        </div>
    </div>
</div>
<div id="cardInfo">

</div>
<script>
    var loadFlag = true;
    var cardList = new function(){
    	this.param = new Array();
    	this.url =  "<?php echo base_url('card/getList')?>";
    	
    	this.param['state'] = 'all';
    	this.loadList =  function(){
    			if(!loadFlag) {
    				return;
    			}
    			$('#card_content').html('<center>数据加载中...</center>');
    			loadFlag = false;
    			loadMod(cardList.url, cardList.param, function(data){
    					loadFlag = true;
    					$('#card_content').html(data);
    			})

    	}
    	this.changeTab = function(state, obj){
    		cardList.param['state'] = state;
    		$(obj).addClass('weui-bar__item_on').siblings().removeClass('weui-bar__item_on');
    		cardList.loadList();
    	}
    }
    cardList.loadList();

	
	function showCardInfo(id){
//		/*
		if( !id ) {
			return false;
		}
		var url='<?php echo base_url('card/cardInfo')?>';
		loadMod(url, {id:id}, function(data){

			$('#cardInfo').html(data);
		})
//		*/
	}
</script>
</body>
</html>
