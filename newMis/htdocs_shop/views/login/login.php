<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>iSpa泰美好</title>
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'js/bootstrap/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/weui.min.css'?>">
    <link rel="stylesheet" href="<?php echo __PUBLIC__.'css/base.css'?>">
    <style>
        .login_page{
            position: relative;
            margin-top:125px;
            margin-left:24px;
            margin-right:24px;
            padding-top:49px;
            padding-left:12px;
            padding-right:12px;
            background: #fff;
            border-radius:15px;
            font-size:18px;
            color: #666;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            box-shadow: 1px 12px 45px rgba(212,190,150,.5);
        }
        .login_page .head{
            position: absolute;
            left:calc(50% - 49px);
            top:-49px;
            width:98px;
            height:98px;
        }
        .login_page .head img{
            border-radius:50%;
            width:auto;
            max-width:100%;
            border: 1px solid #fff;
        }
        .login_page .line_row{
            overflow: hidden;
            margin-top:42.5px;
        }
        .login_page .line_row .line_name{
            float: left;
            width:27%;
            text-align: right;
        }
        .login_page .line_row .line_input{
            float: left;
            padding-left:12px;
            width:73%;
            position: relative;
            box-sizing:border-box;
        }
        .login_page .line_row input{
            padding-left:12px;
            padding-bottom:10px;
            width:100%;
            border:none;
            border-bottom:1px solid #e3e3e3;
            outline:none;
            font-size:18px;
            color: #333;
        }
        .login_page .line_row input.input_min{
            font-size:15px;
        }
        .btn_wrap{
            padding-top: 50px;
            padding-bottom: 37.5px;
        }
        .send_code{
            position: absolute;
            right:0;
            top:0;
            padding-left:12px;
            padding-bottom: 10px;
            background: #fff;
        }
        @media screen and (max-width: 374px) {
            .login_page .line_row .line_name {
                width: 36%;
            }
            .login_page .line_row .line_input{
                padding-left: 0px;
                width: 63%;
            }
            .login_page .line_row input {
                 padding-left: 0px;
            }
            .login_page .line_row input.input_min {
                font-size: 12px;
            }
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
</head>
<body>
    <div class="login_page">
        <div class="head">
            <img src="<?php echo $wechat['headimgurl'];?>">
        </div>
        <div class="line_row">
            <span class="line_name">手机号：</span>
            <div class="line_input">
                <input type="text" id="mobile">
            </div>
        </div>
        <div class="line_row">
            <span class="line_name">验证码：</span>
            <div class="line_input">
                <input type="text" placeholder="请输入验证码" class="input_min" id="se_code">
                <div class="send_code">
                    <a href="javascript:;" class="btn"  id="getverify">获取验证码</a>
                </div>
            </div>
        </div>
        <div class="btn_wrap">
            <a href="javascript:;" class="btn btn_big" id="submit">确认</a>
        </div>
    </div>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/common.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/weui.min.js'?>"></script>
<script type="text/javascript" src="<?php echo __PUBLIC__.'js/jquery.min.js'?>"></script>

<script>
    var sendFlag = true;
    var m = /^1\d{10}$/;

    var validCode=true;
    //获取短信验证码
    function check_code(e)
    {

        /*验证手机号*/
      /*  var phone =  checkPhone();

        if(!phone) return false;*/

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
//            Xalert('请输入手机号码', 1000);
            alert('请输入手机号码');
            return false;
        }
        if (!m.test(mobile)){
//            Xalert('手机号输入有误，请重新输入', 1000);
            alert('手机号输入有误，请重新输入');
            return false;
        }
        sendFlag = false;
        var url = "<?php echo base_url('login/actionGetVerifycode')?>";
        var data = {mobile:mobile};
        loadMod(url, data, function(data){
            if(data.replace(/\s/g,'') == 'success'){
                time();
                return false;
            }else{
                sendFlag = true;
//                Xalert(data, 1000);
                alert(data);
                return false;
            }

        })
        return;
    });
    var loginFlag = true;
    $('#submit').click(function(){
        if( !loginFlag ) {
            return;
        }
        var mobile = $('#mobile').val();
        var se_code = $('#se_code').val();
        if (mobile =='' || !mobile){
            alert('请输入手机号码', 1000);
            return false;
        }
        if (!m.test(mobile)){
            alert('手机号输入有误，请重新输入', 1000);
            return false;
        }
        if (se_code == '' || !se_code){
            alert('请获取验证码', 1000);
            return false;
        }
        loginFlag = false;
        url = "<?php echo base_url('login/actionLogin')?>";
        data = {mobile:mobile, code:se_code};
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (msg) {
                loginFlag = true;
                if(msg.msg == 'success'){
                    href('<?php echo base_url('index/index')?>');
                }else{
                    alert(msg.msg, 1000);
                    return false;
                }
            }
        });
//        loadMod(url, data, function(data){
//            loginFlag = true;
//            if(data.replace(/\s/g,'') == 'success'){
//                href('<?php //echo base_url('index/index')?>//');
//            }else{
//                alert(data, 1000);
//                return false;
//            }
//        })
//        return;
    });

</script>
</body>
</html>