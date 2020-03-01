 <style>
        .transfterdone{
            position: relative;
            padding-top:18px;
        }
        .transfterdone .letter{
            font-size:16px;
            color: #333;
        }
        .transfterdone .letter p:first-child{
            margin-bottom:10px;
        }
        .transfterdone .letter .tips{
            margin:12px 0 12px;
            font-size:14px;
            color: #999;
        }
        .transfterdone .line_row{
            overflow: hidden;
            padding-bottom:36px;
        }
        .transfterdone .line_row .line_name{
            float: left;
            width:20%;
            line-height: 35px;
            text-align: right;
        }
        .transfterdone .line_row .line_input{
            position: relative;
            float: left;
            padding-left:12px;
            width:80%;
            position: relative;
            box-sizing:border-box;
        }
        .transfterdone .line_row input{
            padding-left:12px;
            width:100%;
            line-height:35px;
            border:1px solid #999;
            border-radius: 6px;
            outline:none;
            font-size:18px;
            color: #333;
            box-sizing:border-box;
        }
        .transfterdone .line_row input.input_min{
            width:calc(100% - 92px);
            line-height:35px;
            font-size:15px;
        }
        .btn_wrap{
            padding-top: 20px;
            padding-bottom: 37.5px;
        }
        .send_code{
            position: absolute;
            right:0;
            top:0;
            background: #fff;
        }
        .send_code .btn{
            width:80px;
            text-align: center;
            padding: 9px 0px;
        }
        /*验证码按钮锁定*/
        .disabled_bg,
        .disabled_bg:hover,
        .disabled_bg:active{
            text-decoration: none !important;
            background: #ddd !important;
            color: #fff !important;
            border-color: #ddd !important;
        }
    </style>
<body class="p12">
<div class="con_box transfterdone">
    <div class="letter">
        <p><?php echo $wechat['nickname'];?>：</p>
        <p>您好！<br>
            “<?php echo $sendWechat['nickname'];?>”于<?php echo date('Y-m-d H:i:s', $give['create_time'])?>赠送您iSpa泰美好的爱币，输入手机号完成激活，激活后可以查看具体的数量。</p>
        <p class="tips">注：爱币可以直接用于iSpa泰美好旗下门店消费。</p>
    </div>
    <div class="line_row">
        <span class="line_name">手机号码</span>
        <div class="line_input">
            <input type="text" id="mobile">
        </div>
    </div>
    <div class="line_row">
        <span class="line_name">验证码</span>
        <div class="line_input">
            <input type="text" placeholder="" class="input_min" id="se_code">
            <div class="send_code">
                <a href="javascript:;" class="btn" id="getverify">获取验证码</a>
            </div>
        </div>
    </div>
    <div class="btn_wrap">
        <a href="javascript:;" class="btn btn_big" id="submit">领取</a>
    </div>
</div>

<script>
 	/*
    var validCode=true;
    //获取短信验证码
    function check_code(e)
    {

       // 验证手机号
         var phone =  checkPhone();

         if(!phone) return false;

        var time=60;
        var $code=e;
        if (validCode){
            validCode=false;

            $code.addClass('disabled_bg');
            //获取短信验证码


            var t=setInterval(function(){
                time--;
                $code.html(time+" S");
                $code.addClass('disabled_bg');
                if(time==0){
                    clearInterval(t);
                    $code.html("重新获取");
                    $code.removeClass('disabled_bg');
                    validCode=true;
                }
                else {

                }
            },1000)
        }
    }
	*/
    var sendFlag = true;
    var m = /^1\d{10}$/;
   //获取短信验证码
	var wait = 60;
    function time(){
           $('#getverify').addClass('disabled_bg');
           $('#getverify').html(wait+'秒');
            var interval = setInterval(function(){
         	   	 wait--;
           	   if(wait == 0){
                      wait = 60;
                      sendFlag = true;
                      $('#getverify').removeClass('disabled_bg');
                      $('#getverify').html('重新获取');
                      clearInterval(interval);
                  }else{
                		$('#getverify').html(wait+'秒');
                  }
            },1000);
    }
  
  $('#getverify').click(function(){
	    if( !sendFlag  ) {
			return;
      }
      var mobile = $('#mobile').val();
      if (mobile =='' || !mobile){
          Xalert('请输入手机号码', 1000);
          return false;
      }
      if (!m.test(mobile)){
          Xalert('手机号输入有误，请重新输入', 1000);
          return false;
      }
      sendFlag = false;
		var url = "<?php echo base_url('card/actionGetIbSendCode')?>";
		var data = {mobile:mobile};
		loadMod(url, data, function(data){
				if(data.replace(/\s/g,'') == 'success'){
		                time();	
		                return false;
				}else{
					sendFlag = true;
					Xalert(data, 1000);
					return false;
				}
				
		})
      return;
  });
	



  /*提交*/
 var loginFlag = true;
  $('#submit').click(function(){
  	if( !loginFlag ) {
			return;
      }
      var mobile = $('#mobile').val();
      var se_code = $('#se_code').val();
      if (mobile =='' || !mobile){
          Xalert('请输入手机号码', 1000);
          return false;
      }
      if (!m.test(mobile)){
          Xalert('手机号输入有误，请重新输入', 1000);
          return false;
      }
      if (se_code == '' || !se_code){
          Xalert('请获取验证码', 1000);
          return false;
      }
      loginFlag = false;
      url = "<?php echo base_url('card/actionBindMobileAndGetIb')?>";
		data = {mobile:mobile, code:se_code, give_id: '<?php echo $give['id']?>'};
		loadMod(url, data, function(data){
			loginFlag = true;
			if(data.replace(/\s/g,'') == 'success'){
				Xalert('领取成功');
                setTimeout(href('<?php echo base_url('index/index')?>'), 3000);
                return false;
			}else{
				Xalert(data, 1000);
				return false;
			}
		})
 	 	return;
  });	
</script>
</body>
</html>