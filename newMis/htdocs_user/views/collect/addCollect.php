 <div class="modal-dialog" role="document" id="addCollect">
        <div class="modal-content">
            <div class="modal-header fmodal_header">
                <h4 class="modal-title text-center" id="">收藏</h4>
            </div>
            <div class="modal-body fmodal_body">
                <div class="weui-cells__title">请选择收藏的内容</div>
                <?php  if( isset($order['store']) ): ?>
                <div class="weui-cells__title">门店</div>
                <div class="weui-cells weui-cells_checkbox" id="store">
                    <label class="weui-cell weui-check__label" for="c<?php echo $order['store']['storeid'];?>">
                        <div class="weui-cell__hd">
                            <input required="" pattern="{1,2}" type="checkbox"  <?php if($order['store']['is_collect'] ):?>checked<?php endif;?>  flag="store"  tips=""  value="<?php echo $order['store']['storeid'];?>" class="weui-check" name="assistance" id="c<?php echo $order['store']['storeid'];?>">
                            <i class="weui-icon-checked"></i>
                        </div>
                        <div class="weui-cell__bd">
                            <div class="weui-panel__bd">
                                <div class="weui-media-box weui-media-box_appmsg">
                                    <div class="weui-media-box__hd">
                                        <img class="weui-media-box__thumb" src="<?php echo $order['store']['photo']?>" alt="">
                                    </div>
                                    <div class="weui-media-box__bd">
                                        <h4 class="weui-media-box__title"><?php echo $order['store']['sname']?></h4>
                                        <p class="weui-media-box__desc address"><?php echo $order['store']['adress']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
                <?php endif;?>
                <?php if( isset($order['adviser']) && !empty($order['adviser'])  ):?>
                <div class="weui-cells__title">顾问</div>
                <div class="weui-cells weui-cells_checkbox" id="adviser">
                	<?php foreach ($order['adviser'] as $a_v):?>
                    <label class="weui-cell weui-check__label" for="c<?php echo  $a_v['adviser_id'];?>">
                        <div class="weui-cell__hd">
                            <input required="" pattern="{1,2}" type="checkbox"  <?php if($a_v['is_collect'] ):?>checked<?php endif;?>  tips=""   flag="adviser"   value="<?php echo  $a_v['adviser_id'];?>"  class="weui-check" name="assistance" id="c<?php echo  $a_v['adviser_id'];?>">
                            <i class="weui-icon-checked"></i>
                        </div>
                        <div class="weui-cell__bd">
                            <div class="weui-panel__bd">
                                <div class="weui-media-box weui-media-box_appmsg">
                                    <div class="weui-media-box__hd">
                                        <img class="weui-media-box__thumb" src="<?php echo $a_v['photo'];?>" alt="">
                                    </div>
                                    <div class="weui-media-box__bd">
                                        <h4 class="weui-media-box__title"><?php echo $a_v['nickname'];?></h4>
                                        <p class="weui-media-box__desc"><?php echo $a_v['nickname'];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </label>
                    <?php endforeach;?>
                </div>
                <?php endif;?>
                <?php if( isset($order['beautician']) && !empty($order['beautician']) ):?>
                <div class="weui-cells__title">理疗师</div>
                <div class="weui-cells weui-cells_checkbox" id="beautician">
                	<?php foreach ($order['beautician'] as $b_v ) :?>
                    <label class="weui-cell weui-check__label" for="c<?php echo $b_v['beauticianid'];?>">
                        <div class="weui-cell__hd">
                            <input required="" pattern="{1,2}" type="checkbox"  <?php if($b_v['is_collect'] ):?>checked<?php endif;?> tips=""  flag="beautician"  value="<?php echo $b_v['beauticianid'];?>" class="weui-check" name="assistance" id="c<?php echo $b_v['beauticianid'];?>">
                            <i class="weui-icon-checked"></i>
                        </div>
                        <div class="weui-cell__bd">
                            <div class="weui-panel__bd">
                                <div class="weui-media-box weui-media-box_appmsg">
                                    <div class="weui-media-box__hd">
                                        <img class="weui-media-box__thumb" src="<?php echo $b_v['photo'];?>" alt="">
                                    </div>
                                    <div class="weui-media-box__bd">
                                        <h4 class="weui-media-box__title"><?php echo $b_v['nickname'];?></h4>
                                        <p class="weui-media-box__desc"><?php echo $b_v['nickname'];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </label>
                    <?php endforeach;?>
                </div>
                 <?php endif;?>
            </div>
            <div class="modal-footer container-fluid fmodal_footer">
                <div class="row">
                    <div class="col-xs-6" style="padding-left:0px;padding-right:6px;">
                        <button type="button" class="btn btn-default btn-block btn_yellow" data-dismiss="modal">取消</button>
                    </div>
                    <div class="col-xs-6" style="padding-left:6px;padding-right:0px;">
                        <button type="button" class="btn btn-default btn-block btn_yellow" data-dismiss="modal">确认</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
    	var loadFlag = true;

		$('#addCollect').find(':input[type=checkbox]').change(function(){
			if( !loadFlag ) {
				return false;
			}
			
			var id = $(this)	.val();
			var type = $(this).attr('flag');
			if( $(this).prop('checked') ) {
				var param = {id:id,type:type,action:'add'}
			} else{
				var param = {id:id,type:type,action:'delete'}
			}

			loadFlag = false;
			var url = '<?php echo base_url('collect/actionCollect')?>';
			loadMod(url, param, function(data){
				loadFlag = true;
			})
		})

    	
		$('#submit').click(function(){
			if( !loadFlag ) {
				return;
			}	
			var params = new Array();

			var storeCollectArray = new Array();
			var storeDeleteArray = new Array();

			var beauticianCollectArray = new Array();
			var beauticianDeleteArray = new Array();

			var adviserCollectArray = new Array();
			var adviserDeleteArray = new Array();
			
			
			$('#store').find('input').each(function(){
				if( $(this).prop('checked') ) {
					storeCollectArray.push( $(this).val() );
				}else{
					storeDeleteArray.push( $(this).val() );
				}
			})
			
			$('#beautician').find('input').each(function(){
				if( $(this).prop('checked') ) {
					beauticianCollectArray.push( $(this).val() );
				}else{
					 beauticianDeleteArray.push( $(this).val() );
				}
			})
			$('#adviser').find('input').each(function(){
				if( $(this).prop('checked') ) {
					adviserCollectArray.push( $(this).val() );
				}else{
					adviserDeleteArray.push( $(this).val() );
				}
			})

			params['storeCollect'] = storeCollectArray;
			params['storeDelete'] = storeDeleteArray;

			params['beauticianCollect'] = beauticianCollectArray;
			params['beauticianDelete'] = beauticianCollectArray;

			params['adviserCollect'] = adviserCollectArray;
			params['adviserDelete'] = adviserDeleteArray;

			loadFlag = false;
			var url = '<?php echo base_url('collect/actionCollect')?>';
			loadMod(url, params, function(data){
				loadFlag = true;
			})
		})
    </script>
    
    
    