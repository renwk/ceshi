<link rel="stylesheet" href="<?php echo __PUBLIC__.'slick/slick.css?v='.V;?>">
<link rel="stylesheet" href="<?php echo __PUBLIC__.'css/buy.css?v='.V;?>">
<script type="text/javascript" src="<?php echo __PUBLIC__.'slick/slick.min.js?v='.V;?>"></script>

<body>
<div class="weui-tab" id="tab_switch">
    <!--<div class="weui-navbar-wrap">-->
    <div class="weui-navbar">
        <div class="weui-navbar__item weui-bar__item_on"><span>购卡</span></div>
        <div class="weui-navbar__item" onclick="href('<?php echo base_url('recharge/index');?>')"><span>续费</span></div>
    </div>
    <!--</div>-->
    <div class="weui-tab__panel">
        <div class="weui-tab__content" style="display:block">
            
            <div class="slick slick_one">
                
                <?php if( $card ):?>
                	<?php foreach($card as $v):?>
                    <div>
                        <div class="card <?php if($v['kind'] === 'easy'):?>card_escapespa<?php else:?>card_ispa<?php endif;?>"><!--card start-->
                            <h2 class="card_name">
                                <?php echo $v['cardname'];?><br>
                                <span><?php echo $v['policy'];?></span>
                            </h2>
                            <div class="card_money_year">
                                金额：<?php echo formatMoney($v['money']);?>
                                <span>有效期：<?php echo $v['validity_day'];?>天</span>
                            </div>
                        </div><!--card end-->
                    </div>
  					<?php endforeach;?>              
                <?php endif;?>
            </div>
            <div id="explain">
            	<?php if($card[0]['explain']):?>
            	<?php foreach ($card[0]['explain'] as $explain):?>
                <div class="card_item">
                    <h3><?php echo $explain['title'];?></h3>
                    <p><?php echo $explain['content'];?></p>
                </div>
                <?php endforeach;?>
                <?php endif;?>
            </div>

        </div>
        
    </div>
</div>
<div class="btn_wrap">
	<input type="hidden" id="select_cardid" value="<?php  if($card) { echo $card[0]['cardid'];}?>" />
    <a href="javascript:;" class="btn btn_big" id="password" onclick="gotoBuy()">立即下单</a>
</div>

<script>
    
    
    $(function(){
        slickCommon('slick_one');
    })
    
		
  function gotoBuy(){
		var cardid = $('#select_cardid').val();
		if( !cardid ) {
			return false;
		}

		//href('<?php echo base_url('buy/pay/'); ?>'+cardid);
		href('<?php echo base_url('buy/gotoPay/'); ?>'+cardid);
		
  }



/*轮播 公用*/
function slickCommon(className)
{
    $('.'+className).slick({
        dots: true,
        // slidesToShow:3,
        onAfterChange:function(on_this, on_index){
			<?php if($card):?>
			var json = <?php echo json_encode($card);?>;
			var html = '';	
			for(i in json[on_index].explain) {
				var str = '<div class="card_item"><h3>'+json[on_index].explain[i].title+'</h3><p>'+json[on_index].explain[i].content+'</p></div>';
				html += str;
			}
			$('#explain').html(html);
			$('#select_cardid').val(json[on_index].cardid);            
			<?php endif;?>
            //console.log(on_this)
            //$(on_this.$list).find(".slick-cloned").css('background',"#ddd")
            // alert(on_index)
        }
    });
}
</script>
</body>
<script>
    window.onload = function () { 
        // alert($(".slick-active").width())
        a_width = $(".slick-active").width();
        // $(".slick-slide").width($(".slick-active").width());
    }
  
</script>
</html>