 <?php if( !empty($store) ):?>
 <?php foreach ($store as $sv):?>		
 		
 		<div class="userrecharge_box"><!--userrecharge_box start-->
            <div class="weui-media-box weui-media-box_appmsg">
                <div class="weui-media-box__hd">
                    <img class="weui-media-box__thumb" src="<?php echo $sv['photo'];?>" alt="">
                </div>
                <div class="weui-media-box__bd">
                    <h4 class="weui-media-box__title"><?php echo  $sv['sname'];?></h4>
                    <div class="weui-media-box__desc">
                        电话：<?php echo  $sv['smobile'];?>
                        <a href="tel:17600669474" class="phone"></a>
                    </div>
                    <p class="weui-media-box__desc address"><?php echo  $sv['adress'];?></p>
                    <div class="linelength">
                        距你<br>
                        ≦<?php echo  $sv['length'];?>M
                    </div>
                </div>
            </div>
        </div><!--userrecharge_box end-->
 <?php endforeach;?>
 <?php endif;?>       
        