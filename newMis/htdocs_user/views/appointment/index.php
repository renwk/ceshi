<style>
        .list_box{
            margin-bottom:0;
            list-style: none;
            font-size:14px;
            color: #333;
        }
        .list_box li{
            line-height: 1.9em;
        }
        .list_box li:first-child{
            border-bottom:1px solid #e3e3e3;
        }
        .list_box li span{
            display: inline-block;
            width:92px;
            color: #666;
        }
    </style>
<body class="p12" style="background: #f9f9f9;">
<?php if( !empty($list) ):?>
<?php foreach ($list as $order):?>
<div class="con_box">
    <ul class="list_box">
        <li>
            <span>预约时间</span>
           <?php echo  date('Y-m-d H:i:s', $order['prestatus_time']);?>
        </li>
        <li>
            <span>预约人数</span>
            <?php echo $order['service_number'];?>人
        </li>
        <li>
            <span>预约房间</span>
            <?php echo $order['house_num'];?>间
        </li>
        <li>
            <span>点钟理疗师</span>
            <?php echo  implode('、', array_column($order['beautician'], 'nickname'));?>
        </li>
        <li>
            <span>预约门店</span>
            <?php echo   $order['store']['sname'];?>
        </li>
    </ul>
</div>
<?php endforeach;?>
<?php endif;?>
</body>
</html>