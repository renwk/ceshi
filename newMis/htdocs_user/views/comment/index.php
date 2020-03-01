<link rel="stylesheet" href="<?php echo __PUBLIC__.'css/comment.css?v='.V;?>">
<body class="p12">
<div class="mask_layer"></div>
<div class="con_box review_box">
    <ul>
    	<?php foreach($order['item'] as $v):?>
        <li>
            <?php echo $v['iname'];?>
            <div class="star_wrap">
                <div class="star" data-itemid="<?php echo $v['item_id'];?>"  data-score="0"></div>
            </div>
        </li>
        <?php endforeach;?>
    </ul>
    <ul>
        <li>
            你对本次服务的环境是否满意
            <div class="star_wrap">
                <div class="star" data-itemid="service_environment" data-score="0"></div>
            </div>
        </li>
        <li>
            你对本次服务的整体感受是否满意
            <div class="star_wrap">
                <div class="star" data-itemid="service_all" data-score="0"></div>
            </div>
        </li>
    </ul>
    <h2>其他意见建议</h2>
    <div class="tree_hole">
        <textarea id="comment_content"></textarea>
    </div>
</div>
<div class="btn_wrap">
    <a href="javascript:;" class="btn btn_big" id="password" onclick="submit_comment()">提交</a>
</div>

<?php if( isset($questions) && !empty($questions) ):?>
<?php foreach ($questions as $k => $q_v):?>
<div class="survey" style="display:<?php echo $k > 0 ? 'none' : 'block';?>">
    <h2 class="title">
        问卷调查
        <i class="close" onclick="closeSurvey();"></i>
    </h2>
    <div class="tips">（参与问卷调查可以获得10个爱币）</div>
    <div class="main clearfix">
        <div class="bookmark">
            <span><?php echo $k+1;?></span>/<?php echo count($questions);?>
        </div>
        <div class="txt">
            <?php echo $q_v['content'];?>
        </div>
    </div>
    <div class="select" data-questionid="<?php echo $q_v['id'];?>" data-answer="">
        <div class="box">
            <a href="javascript:;" class="btn btn_no" onclick="openPopBox(this, 'no');<?php if( ($k+1) == count($questions) ){ echo 'closeSurvey()';} ?>">否</a>
        </div>
        <div class="box">
            <a href="javascript:;" class="btn" onclick="openPopBox(this, 'yes');<?php if( ($k+1) == count($questions) ){ echo 'closeSurvey()';} ?>">是</a>
        </div>
    </div>
</div>
<?php endforeach;?>
<?php endif;?>
</body>
</html>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/raty/jquery.raty.min.js?v='.V;?>"></script>
<script type="text/javascript">

	
    $(".row_radio").click(function(){
        $(".row_from").find('.iradio').removeClass("radio_curr");
        $(this).find(".iradio").addClass("radio_curr");
    });
    /*选星星*/
    $.fn.raty.defaults.path = '<?php echo __PUBLIC__.'js/raty/img'?>';
    $('.star').raty({

        numberMax: 5,

        number   : 500,
        click: function(score, event){
            $(this).attr('data-score', score);
           }

    });
    /*问卷调查*/
    /*mask_layer*/
    function closeSurvey()
    {
        $(".survey").hide();
        closeMaskLayer();
    }
    function closeMaskLayer()
    {
        $(".mask_layer").hide();
    }

    function openPopBox(thisObj, yesOrNo)
    {
        $(thisObj).parents('.survey').next().show();
        $(thisObj).parents('.survey').hide();
        $(thisObj).parents('.select').attr('data-answer', yesOrNo);
    }
	var commentFlag = true;
	function submit_comment()
	{
		if( !commentFlag ) {
			return;
		}
		var url = "<?php echo base_url('comment/actionComment');?>"
		var answerArray = new Array();
		var scoreArray = new Array();
		var content = $('#comment_content').val();
	
		$('.star').each(function(){
			var itemid = $(this).attr('data-itemid');
			var score = $(this).attr('data-score');
			if( score <= 0 ) {
				Xalert('请为服务打分！', 1000);
				return;
			}
			var json = {item_id:itemid, score:score};
			scoreArray.push(json);
		});
		
		$('.select').each(function(){
			var questionid = $(this).attr('data-questionid');
			var answer = $(this).attr('data-answer');
			var json = {question_id:questionid, answer:answer};
			answerArray.push(json);
		});
		
		var param = new Array();
		param['score'] = scoreArray;
		param['answer'] = answerArray;
		param['order_id'] = '<?php echo $order['id'];?>';
		param['content'] = content;

		commentFlag = false;
		
		loadMod(url, param, function(data){
			commentFlag = true;
			if(data === 'success') {
				href('<?php echo base_url('index/index');?>');
			}else{
				Xalert(data, 2000);
			}
		});

	}

    
</script>