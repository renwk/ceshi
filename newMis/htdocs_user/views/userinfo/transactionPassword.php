<style>
        .changgepassword{
            position: relative;
            padding-top:18px;
        }
        .changgepassword .head{
            position: absolute;
            left:calc(50% - 49px);
            top:-49px;
            width:98px;
            height:98px;
        }
        .changgepassword .head img{
            border-radius:50%;
            width:auto;
            max-width:100%;
            border: 1px solid #fff;
        }
        .changgepassword .line_row{
            overflow: hidden;
            padding-bottom:36px;
        }
        .changgepassword .line_row .line_name{
            float: left;
            width:20%;
            line-height: 35px;
            text-align: right;
        }
        .changgepassword .line_row .line_txt{
            float: left;
            padding-left:12px;
            line-height:35px;
        }
        .changgepassword .line_row .line_input{
            position: relative;
            float: left;
            padding-left:12px;
            width:80%;
            position: relative;
            box-sizing:border-box;
        }
        .changgepassword .line_row .line_input .password_tips{
            position: absolute;
            left: 14px;
            top: 40px;
            color: #666;
        }
        .changgepassword .line_row input{
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
        .changgepassword .line_row input.input_min{
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
<div class="con_box changgepassword">
    <div class="line_row">
        <span class="line_name">手机号</span>
        <div class="line_txt">
            <?php echo $mobile;?>
        </div>
    </div>
    <div class="line_row">
        <span class="line_name">验证码</span>
        <div class="line_input">
            <input type="text" placeholder="" class="input_min" id="verifyCode">
            <div class="send_code">
                <a href="javascript:;" class="btn"  id="getverify">获取验证码</a>
            </div>
        </div>
    </div>
    <div class="line_row">
        <span class="line_name">支付密码</span>
        <div class="line_input">
            <input type="password" id="password" />
            <p class="password_tips">支付密码是由6位数字组成</p>
        </div>
    </div>
    <div class="line_row">
        <span class="line_name">确认密码</span>
        <div class="line_input">
            <input type="password" id="check_password" />
        </div>
    </div>
    <div class="btn_wrap">
        <a href="javascript:;" class="btn btn_big"  id="submit">确认</a>
    </div>
</div>
<script>
var sendFlag = true;
var submitFlag = true;
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
  
  sendFlag = false;
	var url = "<?php echo base_url('userinfo/actionGetTransPwdCode')?>";
	var data = {};
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

$('#submit').click(function(){
	  if( !submitFlag  ) {
			return;
	  }
	var verifyCode = $('#verifyCode').val();
	if( !verifyCode ) {
		Xalert('请输入验证码', 1000);
		return;
	}

	var password = $('#password').val();
	if( !password ) {
		Xalert('请输入支付密码', 1000);
		return;
	}
	var check_password = $('#check_password').val();
	if( !check_password ) {
		Xalert('请确认密码', 1000);
		return;
	}

	if( password !== check_password ) {
		Xalert('两次密码输入不一致', 1000);
		return;
	}
	submitFlag = false;
	var url = "<?php echo base_url('userinfo/actionSetTransPwd')?>";
	var data = {code:verifyCode, password:password, check_password:check_password};
	loadMod(url, data, function(data){
			submitFlag = true;
			if(data.replace(/\s/g,'') == 'success'){
	                window.history.back();
	                return false;
			}else{
				Xalert(data, 1000);
				return false;
			}
			
	})
	
})

</script>
</body>
</html>