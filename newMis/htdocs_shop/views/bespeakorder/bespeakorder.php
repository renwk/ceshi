<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>iSpa泰美好</title>
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'js/bootstrap/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/weui.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/base.css'?>">
    <script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>
    <script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>"></script>
    <script type="text/javascript" src="<?php echo __PUBLIC__.'js/bootstrap/js/bootstrap.min.js'?>"></script>
    <style>
        .con_box{
            overflow: hidden;
            position: relative;
            padding-right: 0;
            padding-bottom: 0;
        }
        .reservation_box{
            float: right;
            margin-right: 12px;
            margin-bottom: 12px;
            width: 283px;
            border: 1px solid #cfba93;
            border-radius:10px;
        }
        .reservation_box dl{
            margin: 0;
        }
        .reservation_box dt{
            overflow: hidden;
            padding-left:12px;
            padding-right: 12px;
            height: 30px;
            border-bottom: 1px solid #cfba93;
            border-radius:10px 10px 0 0;
            line-height:30px;
            background: #e3e3e3;
            font-weight: normal;
            vertical-align: middle;
        }
        .reservation_box dt span{
            float: right;
            vertical-align: middle;
        }
        .reservation_box dt .icon_vip{
            display: inline-block;
            margin-top: -4px;
            width: 24px;
            height: 18px;
            background: url("<?php echo __PUBLIC__.'./img/vip_icon.png'?>") no-repeat;
            vertical-align: middle;
        }
        .reservation_box dd{
            overflow: hidden;
            padding-left:12px;
            padding-right: 12px;
            height: 32px;
            line-height:32px;
            vertical-align: middle;
        }
        .reservation_box dd span{
            display: inline-block;
            width: 69px;
            color: #666;
        }
        .con_box .reservation_dateicon{
            position: absolute;
            left: 10px;
            top: 12px;
            display: inline-block;
            width: 36px;
            height: 32px;
            line-height: 38px;
            background: url("<?php echo __PUBLIC__.'./img/air_date_icon.png'?>") no-repeat;
            text-align: center;
            font-size: 12px;
            color: #454545;
        }
        .statistical{
            margin-bottom: 0;
            border-radius: 10px;
        }
        .table-striped>tbody>tr:nth-of-type(odd){
            background: #f5f5f5;
        }
        #cardListModal .modal-dialog{
            /* top:200px; */
            margin-top: 200px;
        }
        #cardListModal .modal-content{
            border-radius: 15px;
            box-shadow: none;
        }
        #cardListModal .modal-header{
            border-bottom: none;
            padding-bottom: 0;
        }
        #cardListModal .modal-footer{
            padding-top: 0;
            border-top: none;
            text-align: center;
        }
        #cardListModal .confirm_card{
            padding-left: 20px;
            padding-right: 20px;
            background: #cfba93;
            border-radius: 8px;
        }
        @media screen and (min-width: 413px) {
            .reservation_box{
                width: 320px;
            }
        }
        @media screen and (min-width: 570px) {
            .reservation_box{
                width: 90%;
            }
        }
        @media screen and (max-width: 365px) {
            .con_box .reservation_dateicon{
                position: relative;
                top: -7px;
                left: 0;
            }
        }
        .nothing_box{
            margin-top:65px;
            text-align: center;
        }
        .nothing_txt{
            margin-top:70px;
            font-size:18px;
            color: #333;
        }
    </style>
</head>
<body class="p12">
<!--bespeak-->
<?php if( $bespeak ):?>
<?php foreach ($bespeak as $key=>$val):?>
    <div class="con_box">
        <span class="reservation_dateicon">
            <?php echo $key?>
        </span>
        <?php foreach ($val as $kk=>$vv):?>
        <div class="reservation_box">
<!--        <div class="reservation_box"  onclick="href('<?php //echo base_url('bespeakorder/bespeakInfo');?>//?id=<?php //echo $vv['order_code']?>//')">-->
            <dl>
                <dt style="font-size: 13px">
                    姓名：<?php echo $vv['nickname']?>
                    <a href="javascript:;" class="card_btn">
                        <i class="icon_vip"></i>
                        <input type="hidden" name="user" value="<?php echo $vv['user_id']?>">
<!--                        <input type="hidden" name="local" value="--><?php //echo base_url('bespeakorder/bespeakInfo');?><!--?id=--><?php //echo $vv['order_code']?><!--&role=--><?php //echo $role?><!--">-->
                    </a>
                    <?php if($role != "beautician"):?>
                    <span>手机号：<?php echo $vv['mobile']?></span>
                    <?php endif?>
                </dt>
                <dd>
                    <span>订单状态</span>
                    <?php echo $vv['state']?>
                </dd>
                <dd>
                    <span>预约单号</span>
                    <?php echo $vv['order_code']?>
                </dd>
                <dd>
                    <span>预约时间</span>
                    <?php echo $vv['y_time']?>
                </dd>
                <dd>
                    <span>预约时长</span>
                    <?php echo $vv['iusetime']?> 分钟
                </dd>
                <dd>
                    <span>预约房间</span>
                    <?php echo $vv['s_name']?>
                </dd>
                <?php if($vv['type']=='beautician'):?>
                <dd>
                    <span>理疗师</span>
                    <?php echo $vv['b_name']?>
                </dd>
                <?php elseif ($vv['type']=='consultant'):?>
                <dd>
                    <span>顾问</span>
                    <?php echo $vv['b_name']?>
                </dd>
                <?php endif?>
<!--             <input type="hidden" id="mobile" value="--><?php //echo $vv['mobile']?><!--">-->
<!--                <input type="hidden" name="user" value="--><?php //echo $vv['user_id']?><!--">-->
                <input type="hidden" name = "local" value="<?php echo base_url('bespeakorder/bespeakInfo');?>?id=<?php echo $vv['order_code']?>&role=<?php echo $role?>">
            </dl>
        </div>
        <?php endforeach;?>
    </div>
<?php endforeach;?>
<?php else:?>
<div class="nothing_box">
    <div>
        <img src="<?php echo __PUBLIC__.'img/nothing.png'?>">
    </div>
    <div class="nothing_txt">
        找不到预约单内容
    </div>
</div>
<?php endif?>
    <!-- Modal -->
    <div class="modal fade" id="cardListModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-center" id="myModalLabel">会员卡明细</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive statistical">
                    <table class="table table-striped" id="">
                        <tr>
                            <th>类型</th>
                            <th>卡号</th>
                            <th>余额/次数</th>
                        </tr>
                        <tbody id="cardinfo"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer text-center">
              <button type="button" class="btn btn-default center-block confirm_card" data-dismiss="modal">知道了</button>
            </div>
          </div>
        </div>
    </div>

    <script>
        $('dd').click(function () {
            var url = $(this).siblings('input[name="local"]').val();
            window.location.href= url;
        });
        $(".card_btn").click(function(){
            var user = $(this).find('input[name="user"]').val();
            $.ajax({
                type: "post",
                url: "<?php echo site_url('bespeakorder/getUserCard'); ?>",
                data: {user: user},
                dataType: "json",
                success: function (msg) {
                    if (msg.code == '200') {
                        $('#cardinfo').html(msg.data);
                        $('#cardListModal').modal('show');
                    }
                }
            });
        })
    </script>
</body>
</html>