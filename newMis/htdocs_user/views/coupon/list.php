<?php  if( !empty($coupon) ):?>
<?php foreach ($coupon as  $v): ?>
            <div class="coupon<?php if( $v['state'] == 'COUPON_EXPIRED' ):?> coupon_expired<?php elseif ( $v['state'] == 'COUPON_USE' ):?> coupon_used<?php else:?><?php endif; ?>"><!--coupon start-->
                <div class="coupon_head">
                    <i class="icon_border"></i>
                    <h3>
                        <span><?php echo $v['couponname'];?></span><br>
                        ¥<?php echo formatMoney($v['money']);?>
                    </h3>
                </div>
                <div class="coupon_info">
                    <?php if($v['expired_notice'] && $v['state'] == 'COUPON_ON' ):?><i>快过期</i><?php endif;?>
                    <h3><?php echo $v['explain'];?></h3>
                    <p>有效期至：<?php echo date( 'Y-m-d', $v['expiratime']);?></p>
                </div>
            </div><!--coupon end-->
<?php endforeach; ?>
<?php endif;?>               