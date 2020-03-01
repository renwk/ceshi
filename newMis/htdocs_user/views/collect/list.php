<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.touchSwipe.min.js?v='.V;?>"></script>
<?php if( $collect ):?>
<?php foreach ($collect as $val):?>
		<?php if( $val['type'] === 'store' ):?>
            <div class="favorites_box favorites_shop slide_box"><!--favorites_box start-->
                <div class="weui-panel weui-panel_access">
                    <div class="weui-panel__bd">
                        <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                            <div class="weui-media-box__hd">
                                <img class="weui-media-box__thumb" src="<?php echo  $val['photo'];?>" alt="">
                            </div>
                            <div class="weui-media-box__bd">
                                <h4 class="weui-media-box__title"><?php echo  $val['name'];?></h4>
                                <p class="weui-media-box__desc">电话：<?php echo  $val['mobile'];?></p>
                                <p class="weui-media-box__desc address"><?php echo  $val['address'];?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <i  class="del_box" data-id="<?php echo $val['id'];?>">
                    删除
                </i>
            </div><!--favorites_box end-->
          <?php else:?>
          <div class="favorites_box slide_box"><!--favorites_box start-->
                <div class="weui-panel weui-panel_access">
                    <div class="weui-panel__bd">
                        <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                            <div class="weui-media-box__hd">
                                <img class="weui-media-box__thumb" src="<?php echo  $val['photo'];?>" alt="">
                            </div>
                            <div class="weui-media-box__bd">
                                <h4 class="weui-media-box__title"><?php echo  $val['name'];?>（<?php echo  $val['store_name'];?>）</h4>
                                <p class="weui-media-box__desc">类型：<?php if( $val['type'] === 'beautician' ):?>理疗师<?php else:?>顾问<?php endif;?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <i  class="del_box" data-id="<?php echo $val['id'];?>">
                    删除
                </i>
            </div><!--favorites_box end-->
          <?php endif?>  
  <?php endforeach;?>
  

<script>
	var delFlag = true;
    //删除当前模块
    $(".del_box").click(function(){
		if(!delFlag) {
			return;
		}	
		var obj = $(this);
		delFlag = false;
		var id = obj.attr('data-id');
		if( !id ) {
				return;
		}
		var url = '<?php echo base_url('collect/actionDel');?>';	
		var param= {id:id};
		loadMod(url, param, function(data){
			delFlag = true;
			if( data.replace(/\s/g,'') === 'success' ) {
				obj.parent(".slide_box").remove();
			        return false;
			}	
		})	
    })
    
    $(".slide_box").swipe({
        swipeLeft:function(event, direction, distance, duration, fingerCount){
            // 向左滑动执行
            if(distance > 10)
            {
                $(this).css("transform","translateX(-82px)")
            }

        },
        swipeRight:function(event, direction, distance, duration, fingerCount){
            // 向右滑动执行
            if(distance > 10)
            {
                $(this).css("transform","translateX(0px)")
            }

        },
        click:function(){
            alert("点击跳转链接");
        },
        excludedElements: "i"//排除元素
    });


</script>
  <?php endif;?>