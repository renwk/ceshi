<?php  if( !empty($card) ):?>
<?php foreach ($card as  $v): ?>
            <div class="card"  <?php if  ( $v['accounts'] === 'balance' && $v['status'] == 1  ): ?>  onclick="showCardInfo(<?php echo $v['mycardid']?>)" <?php endif;?>><!--card start-->
                <h2>
                    <img src="<?php echo __PUBLIC__;?>images/card_ispa.png">
                    <?php if ( $v['accounts'] === 'balance' ):?>储值卡
                    <?php elseif( $v['accounts'] === 'common' ):?>常规金卡
                    <?php elseif( $v['accounts'] === 'other' ):?>疗程卡
                    <?php endif;?>
                    <span class="card_no">
                        NO：<?php echo $v['ucard_no']?>
                    </span>
                </h2>
                <h3>
                    <?php echo $v['cardname']?>
                </h3>
                <div class="card_info">
                    <div class="money">
                        <?php if ( $v['accounts'] === 'balance' ):?>
                        	<?php echo formatMoney( $v['money_available'] )?><br>
                        	剩余金额
                        <?php else:?>
	                        <?php echo $v['left_nums']?>/<?php echo $v['total_nums']?><br>
	                        剩余次数
                        <?php endif;?>
                    </div>
                    <div class="discount">
                        iSpa折扣：<?php echo $v['serviceDiscountIspa']?>%<br>
                        隐逸折扣：<?php echo $v['serviceDiscountEasy']?>%
                    </div>
                </div>
                <div class="time">
                    有效期至：<?php echo date('Y-m-d', $v['time_validity']);?>
                </div>
                <?php if($v['store_type'] ==9202 ):?>
                <div class="time">
                    <?php echo $v['sname'];?>
                </div>
                <?php endif;?>
               <?php if($v['status'] ==6 ):?>
                   <div class="card_status  status_fail">已失效
                 <?php elseif($v['status'] ==3 ):?>
                   <div class="card_status  status_fail">已停用   
               <?php elseif($v['status'] == 2):?>
                   <div class="card_status  status_freeze">冻结
               <?php elseif($v['status'] == 0):?>
                   <div class="card_status  status_ready">待开卡
               <?php else:?>
               		 <div class="card_status">正常	
               <?php endif;?></div>
            </div>
<?php endforeach; ?>
<?php endif;?>               