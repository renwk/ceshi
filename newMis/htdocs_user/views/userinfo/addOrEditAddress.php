    <style>
        .address_edit{
            padding-top: 0;
            padding-bottom: 0;
        }
        .address_edit .from_row{
            height: 44px;
            line-height: 44px;
        }
        .address_edit .textarea_row{
            height: 58px;
        }
        .address_edit .from_row input{
            margin: 0;
            width: 100%;
            border: none;
            font-size: 16px;
            outline: none;
            vertical-align: middle;
        }
        .address_edit .textarea_row textarea{
            margin: 0;
            width: 100%;
            border: none;
            font-size: 16px;
            outline: none;
            vertical-align: middle;
        }
        .address_edit .from_row .weui-cell__bd{
            font-size: 16px;
        }
        .address_edit .weui-cell{
            padding: 0;
        }
        .address_edit .weui-switch-cp{
            padding: 0;
            position: relative;
            top: 11px;
        }
        .address_edit .weui-switch-cp__input:checked~.weui-switch-cp__box,
        .address_edit .weui-switch:checked {
            border-color: #cfba93;
            background-color: #cfba93;
        }
        .address_edit .del{
            font-size: 16px;
            color: #e94d3e;
        }
        .address_edit .del:visited,
        .address_edit .del:hover,
        .address_edit .del:active{
            text-decoration: none;
        }
        /* 确认按钮 */
        .btn_wrap{
            padding: 70px 36px;
        }
        .btn_big{
            width: 100%;
            padding-top: 6px;
            padding-bottom: 6px;
            border-radius: 10px;
            font-size: 16px;
        }
        /* 确认弹框 */
        .weui-dialog{
            border-radius: 10px;
        }
        .weui-dialog__btn_primary{
            color: #e94d3e;
        }
        .weui-picker__action{
            color: #cfba93;
        }
    </style>
<body class="p12">
    <div class="con_box address_edit">
        <div class="from_row">
            <input type="text" placeholder="收货人" id="receiver_name" value="<?php if(isset($address)&&$address){echo $address['receiver_name'];}?>">
        </div>
        <div class="from_row">
            <input type="text" placeholder="手机号码" id="receiver_mobile" value="<?php if(isset($address)&&$address){echo $address['receiver_mobile'];}?>">
        </div>
        <!-- div class="from_row">
            <input type="text" placeholder="省市县" id="city_select">
        </div -->
        <div class="textarea_row">
            <textarea placeholder="省+市+区+详细地址" id="address"><?php if(isset($address)&&$address){echo $address['address'];}?></textarea>
        </div>
    </div>
    <div class="con_box address_edit">
        <div class="from_row">
            <div class="weui-cell weui-cell_switch">
                <div class="weui-cell__bd">设为默认</div>
                <div class="weui-cell__ft">
                    <label for="switchCP" class="weui-switch-cp">
                        <input id="switchCP" class="weui-switch-cp__input" type="checkbox" <?php if( isset($address)&&$address ):?> <?php if( $address['is_default'] == 'yes' ):?>checked="checked"<?php endif;?><?php else:?>checked="checked"<?php endif;?> />
                        <div class="weui-switch-cp__box"></div>
                    </label>
                </div>
            </div>
        </div>
        <?php if(isset($address)&&$address):?>
        <div class="from_row del_address">
            <a href="javascript:;" class="del" id="deleteSubmit">删除地址</a>
        </div>
        <script>
            // 确认删除框
        var delFlag = true;
    $(".del_address").click(function(){
        if( !delFlag ) {
			return false;
        }
        delFlag = false;
        weui.dialog({
            title: '是否确认删除该地址？',
            content: '',
            className: 'dialog',
            buttons: [{
                label: '取消',
                type: 'default',
                onClick: function () {
                    //取消回调
                    delFlag = true;
                }
            }, {
                label: '删除',
                type: 'primary',
                onClick: function () { 
                    //确认回调
					var url = "<?php echo base_url('userinfo/actionDelAddress')?>"
					var addressid = '<?php echo $address['id']?>';
					var param = {id:addressid};
					loadMod(url, param, function(data){
						delFlag = true;
						if(data == 'success') {
							href('<?php echo base_url('userinfo/address?cardid='.$cardid)?>');
						}else{
							Xalert(data, 1000);
						}	
					})

					

                    
                }
            }]
        });
    });
        </script>
        <?php endif;?>
    </div>
    <div class="btn_wrap">
        <a href="javascript:;" class="btn btn_big" id="addressSubmit">确定</a>
    </div>

<script>
    // 切换
    $(".row_radio label").click(function(){
        $(".row_from").find('.iradio').removeClass("radio_curr");
        $(this).find(".iradio").addClass("radio_curr");
    });

    

    //
    // 城市选择
    $("#city_select").click(function(){
        weui.picker([
        {
            label: '北京省',
            value: 1,
            children: [
                {
                    label: '广州市',
                    value: 1,
                    children: [
                        {
                            label: '上下九',
                            value: 1
                        },
                        {
                            label: '湾仔区',
                            value: 2
                        },
                        {
                            label: '中环区',
                            value: 3
                        }
                    ]
                },
                {
                    label: '佛山市',
                    value: 2,
                    children: [
                        {
                            label: '上下九',
                            value: 1
                        },
                        {
                            label: '湾仔区',
                            value: 2
                        },
                        {
                            label: '中环区',
                            value: 3
                        }
                    ]
                },
                {
                    label: '高州市',
                    value: 3,
                    children: [
                        {
                            label: '上下九',
                            value: 1
                        },
                        {
                            label: '湾仔区',
                            value: 2
                        },
                        {
                            label: '中环区',
                            value: 3
                        }
                    ]
                }
            ]
        },
        {
            label: '广东省',
            value: 2,
            children: [
                {
                    label: '澳门市',
                    value: 1,
                    children: [
                        {
                            label: '上下九',
                            value: 1
                        },
                        {
                            label: '湾仔区',
                            value: 2
                        },
                        {
                            label: '中环区',
                            value: 3
                        }
                    ]
                },
                {
                    label: '香港市',
                    value: 2,
                    children: [
                        {
                            label: '上下九',
                            value: 1
                        },
                        {
                            label: '湾仔区',
                            value: 2
                        },
                        {
                            label: '中环区',
                            value: 3
                        }
                    ]
                }
            ]
        }
        ], {
        className: 'city_select_box',
        container: 'body',
        defaultValue: [1, 1, 1],
        onChange: function (result) {
            console.log(result)
        },
        onConfirm: function (result) {
            //需要用城市的key值去城市名
            $("#city_select").val(result[0]+' '+result[1]+' '+result[2]);
            console.log(result)
        },
        id: 'city_select_id'
        });

    });

	var requestFlag = true;
	$('#addressSubmit').click(function(){
			if( !requestFlag ) {
				return;
			}
				
			var name = $('#receiver_name').val();
			var mobile = $('#receiver_mobile').val();
			var address = $('#address').val();
			var default_checked = $('#switchCP').prop('checked');

			if( !name ) {
				Xalert('请填写收货人姓名', 1000);
				return;
			}

			if( !mobile ) {
				Xalert('请填写收货人电话', 1000);
				return;
			}

			if( !address ) {
				Xalert('请填写详细地址', 1000);
				return;
			}
			var is_default = default_checked ? 'yes' : 'no';
			var url = '<?php echo base_url('userinfo/actionAddOrEditAddress')?>';
			var param = {name:name, mobile:mobile, address:address, is_default:is_default};
			<?php if( isset($address)&&$address ):?>
				param.id = <?php echo $address['id']?>;
			<?php endif;?>

			
			requestFlag = false;
			loadMod(url, param, function(data){

				requestFlag = true;	
				if(data ==='success'){
					href('<?php echo base_url('userinfo/address?cardid='.$cardid)?>');
				}else{
					Xalert(data);
				}
				
			
			});	
				
			
			
	})

    
</script>
</body>
</html>