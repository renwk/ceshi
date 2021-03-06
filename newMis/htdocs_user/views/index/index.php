<link rel="stylesheet" href="<?php echo __PUBLIC__.'css/index.css?v='.V;?>">
<body class="p12">
<div class="mask_layer" style="display: none;"></div>
<div class="ib_aount_box" style="display: none;">

    <h3><span>关于爱币<i class="icon_arrow"></i></span></h3>
    <p>爱币是由泰美好公司发行的一种虚拟货币，可用于支付在泰美好旗下门店的消费。</p>
    <div class="btn_wrap">
        <a href="javascript:;" class="btn ib_close">我知道了</a>
    </div>
</div>
<div class="con_box index_head">
    <div class="user_img">
        <img src="<?php echo $wechat['headimgurl'];?>">
    </div>
    <div class="user_info">
        <div class="user_name">
            Hi，<br>
            <?php echo $wechat['nickname'];?>
            <!-- i class="icon_star">
                <b></b>
                <b></b>
                <b></b>
                <b></b>
                <b></b>
            </i -->
        </div>
        <div class="love_money">
            剩余金额:
            <i class="icon_about ib_what" style="margin: -5px 2px 0 0px;display:none"></i>
               <?php echo money2Ib($balance);?>
        </div>
    </div>
    <div class="rights_info">
        <a class="mycard" href="<?php echo base_url('card/index');?>">
            <?php echo $cardNums;?><br>
            会员卡
        </a>
        <a class="coupon" href="<?php echo base_url('coupon/index');?>">
            <?php echo $couponNums;?><br>
            优惠券
        </a>
    </div>
</div>
<!--<div class="con_box index_btn_list" style="display: none">--><!--还原-->
<div class="con_box index_btn_list" >
    <a href="<?php echo base_url('buy/index')?>" class="btn btn_icon_money">
        <span>我要充值</span>
    </a>
    <a href="<?php echo base_url('invite/index')?>" class="btn btn_icon_friend">
        <span>邀请好友</span>
    </a>
</div>
<div class="grid_list">
    <div class="grid_label" onclick="href('<?php echo base_url('appointment/index');?>')">
        <div class="grid_img">
            <img src="<?php echo __PUBLIC__;?>images/date_icon.png">
        </div>
        <span>我的预约</span>
    </div>
    <div class="grid_label" onclick="href('<?php echo base_url('runningAccount/index');?>')">
        <div class="grid_img">
            <img src="<?php echo __PUBLIC__;?>images/bill_icon.png">
        </div>
        <span>我的消费</span>
    </div>
    <div class="grid_label" onclick="href('<?php echo base_url('collect/index');?>')">
        <div class="grid_img">
            <img src="<?php echo __PUBLIC__;?>images/favorites_icon.png">
        </div>
        <span>我的收藏</span>
    </div>
    <div class="grid_label" onclick="href('<?php echo base_url('userinfo/index');?>')">
        <div class="grid_img">
            <img src="<?php echo __PUBLIC__;?>images/user_file.icon.png">
        </div>
        <span>个人资料</span>
    </div>
</div>
<?php if(!$wechat['is_read_agreement']):?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">欢迎您成为泰美好会员!</h4>
      </div>
      <div class="modal-body" style="height:430px;overflow-y:auto;">
            <div style="height:100%;">
            第一条 会员协议的确认和接纳
            <br>本协议由您（“会员”）与北京泰美好健康管理股份有限公司（以下简称“泰美好”）订立，在您申请注册成为泰美好会员前，请您仔细阅读本协议。您在本页面选择“同意《会员协议》”（或类似同意按钮）后完成会员储值，或以泰美好允许的其他方式实际使用会员服务时，即表示您自愿接受并遵守本协议，正式成为泰美好会员，若您不同意本协议或者对本协议条款存在任何疑问，您可停止本协议的订立程序。
            <br>第二条 定义与说明
            <br>1.会员：是指已经过iSpa/Escape Spa批准，从本网站注册成功，并向泰美好银行账户一次性支付全部会费的群体。
            <br>2.直营店：是指开展泰美好品牌服务的泰美好公司及其分公司、绝对控股公司。
            <br>3.加盟店：是指与泰美好签订了相关加盟协议，并经泰美好同意，允许其开展Escape Spa品牌服务的企业主体。
            <br>4.会员卡：是指由泰美好发行的，可以并仅限于购买泰美好品牌服务及泰美好销售产品的单用途商业预付卡（以下简称“预付卡”）。会员卡包括在PVC卡片等介质存储预付价值的实体卡及虚拟电子卡，泰美好发行的会员卡分为“iSpa会员卡”及“Escape Spa会员卡”，会员可根据需求自行选择会员卡类型。
            <br><b>5.会员权益：是指本协议中约定的会员权益，包括会员在泰美好消费可享受折扣、优惠及获得赠品的权益，也包括在加盟店消费时可使用会员卡余额及享受折扣价格的权益。泰美好某一店面经营情况发生变化，不影响会员资格，会员权益仅在会员不再享有会员资格时终止。</b>
            <br>6.店面：指为会员提供iSpa品牌服务或Escape Spa品牌服务的场所。
            <br><b>第三条 会员卡储值及使用
            <br>1.单张会员卡限额为人民币5000元（含），单张会员卡充值后资金余额不得超过上述限额。
            <br>2.会员卡内金额可折抵等值现金用于消费，多张会员卡可累加使用，会员应保证其卡内金额足以折抵商品或服务价款，如因卡内余额不足导致会员无法消费，则泰美好不承担任何责任。会员卡内余额不提供兑现或找零，严禁以任何方式套现、透支。
            <br>3.用会员卡兑付的商品如发生退货时，应退资金将退回至原会员卡内。原会员卡不存在或退货后卡内资金余额超过会员卡限额的，应退回至会员在泰美好同类预付卡内。
            <br>4.会员可通过密码方式进行支付，也可通过确认《免密支付条款》，开通免密支付功能。
            <br>5.会员可通过本网站查询会员卡累计余额。
            <br>6.会员应信守承诺，避免爽约，每位会员仅有两次无条件爽约的机会，从第三次爽约开始，若会员在最后2小时内取消预约的，或者会员比预定时间迟到45分钟以上，则店面有权扣除赠送项目，同时按会员折后50％但是不低于300元的价格收取预定的项目费用，并从会员卡内扣除相应金额。
            <br>7.冻结和转让：会员最多可以申请冻结2次，暂停计算使用期，冻结无需支付手续费，只需填写《会员冻结申请书》，交与店面即可（或扫描、拍照发给店面），冻结期累计不超过1年，如遇会员怀孕，冻结期可延长，但最长不超过2年，未使用的会员资格只可以转让一次，无须支付转让费。
            <br>8.会员权益期限：所有会员权益有效期限自办卡之日起计算。超出有效期，所有赠送会员的礼券、服务、产品等全部作废。会员权益到期后，会员自愿将储值余额换购为优惠券。每张优惠券最高面值为500元，有效期为换购之日起三个月。优惠券不兑现、不找零，可多张累计使用，可转赠亲友。使用优惠券时，需按照非会员项目价格基础上另加收15％服务费。
            <br>9.疗程使用期限：会员购买疗程后，获得相应项目服务券，会员可在标明的使用期限内使用项目服务券享受相应服务。项目服务券可转赠亲友使用，但均不得超出使用期限。</b>
            <br>第四条 当事人权利义务
            <br>1.泰美好或相关售卡企业要求会员按法律规定提供真实有效的个人、单位身份信息，对于提供虚假信息的个人、单位，泰美好或关联公司有权暂停其所购会员卡的使用。
            <br>2.若存在以下情形的，泰美好或相关售卡企业有权暂停或终止会员卡的使用，并有权进一步要求持卡人承担损害赔偿责任：
            <br>（1）会员在购买、使用、挂失补办会员卡及办理换发新卡、退卡时存在欺诈或其他不诚实行为，或其通过不正当手段获取会员卡及卡内金额的。
            <br>（2）会员违反国家法律法规规定进行非法交易的。
            <br>（3）泰美好依法核实会员身份信息及会员卡交易信息等，遭拒绝的。
            <br>（4）如在本网站通过不正当手段获得的会员卡，泰美好有权关闭该使用人的账户或要求其通过其他方式支付费用，并保留追究该使用人法律责任的权利。
            <br>（5）会员及会员邀请接受泰美好服务的客人，须遵守泰美好的规章制度，如：尊重泰美好的员工和其他消费者、禁烟禁酒、不得有违法行为等。如会员及其邀请的客人在泰美好店面有任何不当或有悖于公共道德的行为，经泰美好工作人员劝阻后，仍不能改正，泰美好有权拒绝向该会员及其邀请客人提供服务，并有权终止其会员资格。
            <br>（6）会员有其他损害泰美好及其他合法会员合法权益行为的。
            <br>3.若存在以下情形，致使会员不能正常使用会员卡的，泰美好可协助会员解决问题，提供必要的帮助，但无需就会员卡的不正常使用及会员的损失承担任何责任：
            <br>（1）泰美好经公示后，系统停机维护的。
            <br>（2）电信、电力、银行或第三方数据处理平台的系统、设备、网站故障、不稳定、升级维护等原因导致数据传输及处理失败、中断或不稳定的。
            <br>（3）因台风、地震、海啸、洪水、停电、战争、恐怖袭击等不可抗力原因，造成系统障碍不能运行业务的。
            <br>4.泰美好保留随时修改上述条款和条件的权利，所有条款和条件将在法律允许的限度内适用。
            <br>5.泰美好有权调整服务及产品的收费标准，收费标准以泰美好官方网站发布或店面展示的价格表为准。
            <br><b>6.会员的义务
            <br>（1）会员应尽量避免携带贵重物品到店，如携带应自行保管，店面不提供任何保管服务，会员认可店面对贵重财物的丢失不承担任何责任。
            <br>（2）会员如有心脏病、高血压、过敏糖尿病等病症，或存在饮酒过多、怀孕、有过敏史、手术后未愈、扭伤、身体疼痛等其他身体不适等情况，出于保障会员个人健康的考虑，请会员务必事先咨询医生并在接受服务前及时、明确告知店面，如会员不及时告知，视为会员认可店面对此不承担任何责任。
            <br>（3）会员应当向泰美好或相关售卡企业提供真实有效的身份信息及证明文件，不得冒用他人身份或使用伪造、变造身份证明文件。
            <br>（4）为保证会员利益不受侵犯，会员理解并同意，负责保管自己的账号及密码，因会员保管账号、密码不当造成的所有后果，将由会员自行承担。凡经会员账号及密码登录并使用会员卡的，即视为会员的使用行为，会员应当对账户的所有活动及后果负法律责任。因会员主动泄露、出借账号、密码信息或因会员遭受他人攻击、诈骗等行为导致的损失及后果，泰美好及关联公司不负任何责任。会员可通过司法、行政等救济途径向侵权人主张损失。
            <br>（5）会员以其姓名及在本客户端中预留的手机号作为会员身份凭证，若手机号发生变化，会员应及时携带身份证件到店面办理变更登记，以免权益受损。直营店会员可在任一iSpa/Escape Spa店面办理变更登记。</b>
            <br>第五条 隐私政策
            <br>泰美好深知个人信息对会员的重要性，并会尽全力保护会员的个人信息安全。泰美好致力于维持会员对泰美好的信任，恪守以下原则，保护会员的个人信息：权责一致原则、目的明确原则、选择同意原则、最少够用原则、确保安全原则、主体参与原则、公开透明原则等。同时，泰美好承诺，泰美好将按业界成熟的安全标准，采取相应的安全保护措施来保护会员的个人信息。
            <br>泰美好保证仅会处于本协议所述目的收集和使用会员的个人信息。会员同意泰美好在以下情况获取会员的个人信息：
            <br>（1）在获取会员明确同意的情况下。
            <br>（2）根据法律规定，或按政府主管部门的强制性要求，对外共享会员的个人信息。
            <br>（3）仅为实现本协议的目的，泰美好的某些服务将由授权合作伙伴提供。泰美好可能会与合作伙伴共享会员的某些个人信息，以提供更好的客户服务和用户体验。
            <br>对泰美好与之共享个人信息的公司、组织和个人，泰美好会与其签署严格的保密协议，要求他们按照泰美好的说明、本协议和安全措施来处理个人信息。
            <br>第六条 争议解决
            <br>任何由本协议引起的争议，各方当事人应协商解决。如未能协商一致，双方就本协议相关解释、争议均适用中华人民共和国法律，并应提交北京市朝阳区有管辖权的法院提起诉讼解决。

            <br>（温馨提示：在点击同意前，请您确认已完全理解并同意本协议的内容。）
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" id="agree_agreement">同意</button>
      </div>
    </div>
  </div>
</div>

<script>

//弹框默认加载
$('#myModal').modal({
     show:true,
     keyboard: false,
     backdrop:'static'
})
$('#agree_agreement').click(function(){

    var url = '<?php echo base_url('index/actionReadAgreement');?>';
	loadMod(url, {read:'yes'}, function(data){
		$('#myModal').modal('hide');
		
	});
	
	
})

</script>

<?php endif;?>
<script>
    
    $(".ib_what").click(function(){
        $(".ib_aount_box").fadeIn();
        $(".mask_layer").show();
    })
    $(".ib_close").click(function(){
        $(".ib_aount_box").hide();
        $(".mask_layer").hide();
    })
    $(".mask_layer").click(function(){
        $(this).hide();
        $(".ib_aount_box").hide();
    })
</script>
</body>
</html>