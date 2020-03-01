<?php if($type === 'cousumption'):?>
        	<?php if( $cousumption ):?>
	        	<?php foreach ($cousumption as $v):?>
            <div class="paidinfo_box"><!--paidinfo_box start-->
             <!--  div class="paidinfo_box" onclick="href('<?php  echo base_url('runningAccount/consumptionDetail/'.$v['id']); ?>')">--><!--paidinfo_box start-->
                <div class="paid_head">
                    <?php echo date('Y-m-d H:i:s', $v['start_time']);?>
                    <a href="javascript:;" class="paid_star" onclick="showAddCollect('consumption', <?php echo $v['id'];?>)"></a>
                </div>
                <div class="paid_body" onclick="href('<?php  echo base_url('runningAccount/consumptionDetail/'.$v['id']); ?>')">
                <?php foreach ($v['item'] as $vItem):?>
                    <div class="paid_row">
                        <span class="paid_row_title"><?php echo $vItem['iname'];?></span>
                        <?php echo $vItem['count'];?>
                        <span class="paid_row_money"><?php echo formatMoney( round($vItem['actual_price']/100, 2) );?></span>
                    </div>
                <?php endforeach;?>
                </div>
                <div class="paid_foot">
                    实付金额：¥<?php echo formatMoney( round($v['actual_price']/100, 2) );?>
                </div>
            </div><!--paidinfo_box end-->
	            <?php endforeach;?>
	        <?php endif;?>    
 <?php else:?>
 			<?php if( $recharge ):?>
	        	<?php foreach ($recharge as $v):?>
	        	<div class="paidinfo_box <?php if($v['type'] == 1 ):?>renewal<?php endif;?>" onclick="href('<?php  echo base_url('runningAccount/rechargeDetail/'.$v['id']); ?>')"><!--paidinfo_box start-->
                <div class="paid_head">
                    <?php echo date('Y-m-d H:i:s', $v['create_time']);?>
                    <span>
                        <i>NO：<?php echo $v['card_no'];?></i>
                        <?php if( $v['type'] == 1 ):?><i class="status">续</i><?php else:?><i class="status"><?php if($v['type'] == 1 ):?>续<?php else:?>购<?php endif;?></i><?php endif;?>
                    </span>
                </div>
                <div class="paid_body">
                	<?php if( isset($v['cardinfo']) && !empty($v['cardinfo']) ):?>
	                    	<?php foreach( $v['cardinfo'] as $cv ):?>	
                    <div class="paid_row">
                        <span class="paid_row_title"><?php  if( !$v['card_type'] ){echo '礼券卡';}  echo $cv['cardname'];?></span>
                        1张
                        <span class="paid_row_money"><?php echo formatMoney( round($cv['money']/100, 2) );?></span>
                    </div>
                    <?php endforeach;?>
	                        <?php endif;?>
                </div>
                <div class="paid_foot">
                    实付金额：¥<?php echo formatMoney($v['money_true']);?>
                </div>
            </div><!--paidinfo_box end-->
	            <?php endforeach;?>
	        <?php endif;?>    
 <?php endif;?>      