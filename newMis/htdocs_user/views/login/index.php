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
<body>
    <div class="login_page">
        <div class="head">
            <img src="<?php echo $wechat['headimgurl'];?>">
        </div>
        <div class="line_row">
            <span class="line_name">手机号：</span>
            <div class="line_input">
                <input type="text" id="mobile" />
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
        	
            <!--用户协议，正式上线需要打开-->
            <p><input type="checkbox" id="tongyi"> 我同意并已阅读 <a href="javascript:;" class=""  id="user_agree">《用户注册协议》</a></p>
            <a href="javascript:;" class="btn btn_big"  id="submit" style="background-color:#d0d0d0">确认</a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">用户注册协议</h4>
            </div>
            <div class="modal-body" style="height:430px;overflow-y:auto;">
                    <div style="height:100%;">
                    一、用户注册协议的确认及接受
                    <br>1.本网站（指ispa.cn及其移动客户端软件，以下称“本网站”）各项电子服务的所有权和运作权归属于北京泰美好健康管理股份有限公司（以下简称“泰美好”）所有，本网站提供的服务将完全按照本协议严格执行。您确认所有注册协议并完成注册程序时，本协议在您与本网站间成立并发生法律效力，同时您成为本网站正式用户。
                    <br>2.根据国家法律法规变化及本网站运营需要，泰美好有权对本协议条款及相关规则不时地进行修改，修改后的内容一旦以任何形式公布在本网站上即生效，并取代此前相关内容，您应不时关注本网站公告、提示信息及协议、规则等相关内容的变动。您知悉并确认，如您不同意更新后的内容，应立即停止使用本网站，如您继续使用本网站，即视为知悉变动内容并同意接受。
                    <br>二、服务需知
                    <br>1.本网站运用自身开发的操作系统为您不时提供泰美好及关联公司消费时可以使用的优惠券、折扣券等，并不时向您提供最新的广告信息、宣传信息。
                    <br>2.基于本网站所提供网络服务的重要性，您确认并同意：
                    <br>（1）提供的注册资料真实、准确、完整、合法有效，注册资料如有变动的，应及时更新；
                    <br>（2）如果您提供的注册资料不合法、不真实、不准确、不详尽的，您需承担因此引起的相应责任及后果，并且泰美好保留终止您使用本网站各项服务的权利。
                    <br>3.您成功注册成为本网站用户后，您将得到用户账户，登录用户账户时您可以使用您提供或确认的用户名、手机号码或者本网站允许的方式作为用户账户登录名进行登录，但在登录时您必须输入您设定并保管的用户账户密码，您应妥善保管您的用户账户的密码。为保护您的权益，您在设定用户账户密码时，请勿使用重复性或者连续数字的简单密码，请勿将密码告知他人，因密码保管不善而造成的经济损失由您自行承担。
                    <br>4.您可以为您的账户设定用户昵称，但用户昵称不得侵犯他人合法权益，如您设置的用户昵称涉嫌侵犯他人合法权益的，泰美好有权终止为您提供用户服务，注销您的用户昵称。若您不再属于本网站会员，对于您的原用户昵称，本网站可以将其开放给任意用户注册。
                    <br>5.除非有法律规定或依生效法律文书，或者符合泰美好公布的条件，否则您的用户名、用户昵称和密码不得以任何方式转让、赠与或继承，并且转让、赠与或继承需提供泰美好要求的合格的文件材料并根据泰美好制定的操作流程办理。
                    <br>6.您需要对通过您的用户账户所进行的活动和事件负全责，请勿将在本网站注册获得的用户账号借给他人使用，如果您发现任何非法使用您用户账户的情况，请立即告知泰美好。
                    <br>三、用户个人信息保护及授权
                    <br>1.您知悉并同意，为方便您使用本网站相关服务，本网站将存储您在使用时的必要信息，包括但不限于您的真实姓名、性别、生日、联系方式、通讯录等。除法律法规规定的情形外，未经您的许可，泰美好不会向第三方公开、透露您的个人信息。泰美好对相关信息采取专业加密存储与传输方式，利用合理措施保障您个人信息的安全。
                    <br>2.您知悉并确认，您在注册账号或使用本网站的过程中，需要提供真实的身份信息，泰美好将根据国家法律法规相关要求，进行基于移动电话号码的真实身份信息认证。若您提供的信息不真实、不完整，则无法使用本网站或在使用过程中受到限制，同时，由此产生的不利后果，由您自行承担。
                    <br>3.您在使用本网站某一特定服务时，该服务可能会另有单独的协议、相关业务规则等（以下统称为“单独协议”），您在使用该项服务前请阅读并同意相关的单独协议。
                    <br>4.您充分理解并同意：
                    <br>（1）接收本网站向您发送活动信息、优惠券、折扣券等内容；
                    <br>（2）为配合行政监管机关、司法机关执行工作，在法律规定范围内泰美好有权向上述行政、司法机关提供您在使用本网站时所储存的相关信息，包括但不限于您的注册信息等，或使用相关信息进行证据保全，包括但不限于公证、见证等；
                    <br>（3）泰美好依法保障您在安装或使用过程中的知情权和选择权，在您使用本网站服务过程中，涉及您设备自带功能的服务会提前征得您同意，您一经确认，泰美好有权开启包括但不限于收集地理位置、读取通讯录、使用摄像头、启用录音等提供服务必要的辅助功能；
                    <br>（4）泰美好有权根据实际情况，在法律规定范围内自行决定单个用户在本网站及服务中数据的最长储存期限以及用户日志的储存期限，并在服务器上为其分配数据最大存储空间等。
                    <br>四、用户行为规范
                    <br>1.本协议依据国家相关法律法规规章制定，您同意严格遵守以下义务：
                    <br>（1）不得传输或发表：煽动抗拒、破坏宪法和法律、行政法规实施的言论，煽动颠覆国家政权，推翻社会主义制度的言论，煽动分裂国家、破坏国家统一的言论，煽动民族仇恨、民族歧视、破坏民族团结的言论；
                    <br>（2）从中国大陆向境外传输资料信息时必须符合中国有关法规；
                    <br>（3）不得利用本网站从事洗钱、窃取商业秘密、窃取个人信息等违法犯罪活动；
                    <br>（4）不得干扰本网站的正常运转，不得侵入本网站及国家计算机信息系统；
                    <br>（5）不得传输或发表任何违法犯罪的、骚扰性的、中伤他人的、辱骂性的、恐吓性的、伤害性的、庸俗的、淫秽的、不文明的等信息资料；
                    <br>（6）不得传输或发表损害国家社会公共利益和涉及国家安全的信息资料或言论；
                    <br>（7）不得教唆他人从事本条所禁止的行为；
                    <br>（8）不得利用在本网站注册的账户进行牟利性经营活动；
                    <br>（9）不得发布任何侵犯他人隐私、个人信息、著作权、商标权等知识产权或合法权利的内容等。
                    <br>2.您须对自己在网上的言论和行为承担法律责任，您若在本网站上散布和传播反动、色情或其它违反国家法律的信息，本网站的系统记录有可能作为您违反法律的证据。
                    <br>五、本网站使用规范
                    <br>1.关于移动客户端软件的获取与更新：
                    <br>（1）您可以直接从本网站上获取泰美好移动客户端软件，也可以从得到泰美好授权的第三方获取，如果您从未经泰美好授权的第三方获取软件或与泰美好移动客户端软件名称相同的安装程序，泰美好无法保证该软件能够正常使用，并对因此给您造成的损失不予负责；
                    <br>（2）为了改善用户体验、完善服务内容，泰美好将不断努力开发新的服务，并为您不时提供软件更新，新版本发布后，旧版本的软件可能无法使用，泰美好不保证旧版本软件继续可用及提供相应的客户服务，请您随时核对并下载最新版本。
                    <br>2.除非法律允许或泰美好书面许可，您使用本网站过程中不得从事下列行为：
                    <br>（1）删除本网站及其副本上关于著作权的信息；
                    <br>（2）对本网站进行反向工程、反向汇编、反向编译，或者以其他方式尝试发现本网站的源代码；
                    <br>（3）对泰美好拥有知识产权的内容进行使用、出租、出借、复制、修改、链接、转载、汇编、发表、出版、建立镜像站点等；
                    <br>（4）对本网站或者本网站运行过程中释放到任何终端内存中的数据、网站运行过程中客户端与服务器端的交互数据，以及本网站运行所必需的系统数据，进行复制、修改、增加、删除、挂接运行或创作任何衍生作品，其形式包括但不限于使用插件、外挂或非经泰美好授权的第三方工具/服务接入本网站和相关系统；
                    <br>（5）通过修改或伪造网站运行中的指令、数据，增加、删减、变动网站的功能或运行效果，或者将用于上述用途的软件、方法进行运营或向公众传播，无论这些行为是否为商业目的；
                    <br>（6）通过非泰美好开发、授权的第三方软件、插件、外挂、系统，登录或使用本网站及服务，或制作、发布、传播上述工具；
                    <br>（7）自行或者授权他人、第三方软件对本网站及其组件、模块、数据进行干扰。
                    <br>六、违约责任
                    <br>1.如果泰美好发现或收到他人举报投诉您违反本协议约定或存在任何恶意行为的，泰美好有权不经通知随时对相关内容进行删除、屏蔽，并视行为情节对违规帐号处以包括但不限于警告、限制或禁止使用部分或全部功能、帐号封禁、注销等处罚，并公告处理结果。
                    <br>2.泰美好有权依据合理判断对违反有关法律法规或本协议约定的行为采取适当的法律行动，并依据法律法规保存有关信息向有关部门报告等，您应独自承担由此产生的一切法律责任。
                    <br>3.您理解并同意，因您违反本协议或相关服务条款的约定，导致或产生第三方主张的任何索赔、要求或损失，您应当独立承担责任，泰美好因此遭受损失的，您也应当一并赔偿。
                    <br>4.除非另有明确的书面说明,泰美好不对本网站的运营及其包含在本网站上的信息、内容、材料、产品（包括软件）或服务作任何形式的、明示或默示的声明或担保（根据中华人民共和国法律另有规定的以外）。
                    <br>七、所有权及知识产权
                    <br>1.您一旦接受本协议，即表明您主动将您在任何时间段在本网站发表的任何形式的信息内容（包括但不限于客户评价、客户咨询、各类话题文章等信息内容）的财产性权利等任何可转让的权利，如著作权财产权（包括并不限于复制权、发行权、出租权、展览权、表演权、放映权、广播权、信息网络传播权、摄制权、改编权、翻译权、汇编权以及应当由著作权人享有的其他可转让权利），全部独家且不可撤销地转让给泰美好所有，并且您同意泰美好有权就任何主体侵权而单独提起诉讼。
                    <br>2.除法律另有强制性规定外，未经泰美好明确的特别书面许可,任何单位或个人不得以任何方式非法地全部或部分复制、转载、引用、链接、抓取或以其他方式使用本网站的信息内容，否则，泰美好有权追究其法律责任。
                    <br>3.本网站所刊登的资料信息（诸如文字、图表、标识、按钮图标、图像、声音文件片段、数字下载、数据编辑和软件），均是泰美好或其内容提供者的财产，受中国和国际版权法的保护。本网站上所有内容的汇编是泰美好的排他财产，受中国和国际版权法的保护。本网站上所有软件都是泰美好或其关联公司或其软件供应商的财产，受中国和国际版权法的保护。
                    <br>八、法律管辖适用及其他
                    <br>1.本协议的订立、执行和解释及争议的解决均应适用中国法律。如双方就本协议内容或其执行发生任何争议，双方应尽力友好协商解决，协商不成时，应向北京市朝阳区人民法院提起诉讼解决。
                    <br>2.如果本协议中任何一条被视为废止、无效或因任何理由不可执行，不影响任何其余条款的有效性和可执行性。
                    <br>3.本协议未明示授权的其他权利仍由泰美好保留，您在行使这些权利时须另外取得泰美好的书面许可。泰美好如果未行使前述任何权利，并不构成对该权利的放弃。
                    <br>4.您点击“同意”按钮即视为您完全接受本协议，在点击之前请您再次确认已知悉并完全理解本协议的全部内容。
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" id="agree_agreement">我知道了</button>
            </div>
            </div>
        </div>
    </div>
<script>
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
		var url = "<?php echo base_url('login/actionGetVerifycode')?>";
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

   /*用户协议*/
   $("#user_agree").click(function(){
        //弹框默认加载
        $('#myModal').modal({
            show:true,
            keyboard: false,
            backdrop:'static'
        })
   });
   $('#agree_agreement').click(function(){
	   $('#myModal').modal('hide');
	})
	$('#tongyi').click(function(){
		if($(this).prop('checked')){
			$('#submit').css('background-color', '#cfba93');
		}else{
			$('#submit').css('background-color', '#d0d0d0');
		}

	})	
   /*提交*/
  var loginFlag = true;
   $('#submit').click(function(){
   	   if( !loginFlag ) {
			return;
       }
       if(!$('#tongyi').prop('checked')){
    	   Xalert('请同意用户协议', 1000);
           return false;
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
       url = "<?php echo base_url('login/actionLogin')?>";
		data = {mobile:mobile, code:se_code};
		loadMod(url, data, function(data){
			loginFlag = true;
			if(data.replace(/\s/g,'') == 'success'){
                     href('<?php echo base_url('index/index')?>');
			}else if(data.replace(/\s/g,'') == 'error_not_invite_user'){
				Xalert('非常抱歉，现在是测试时间暂停注册，请谅解。祝您每天泰美好');
				loginFlag = false;
				$('#submit').css('background-color', '#d0d0d0');
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