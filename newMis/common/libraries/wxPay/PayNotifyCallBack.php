<?php

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);

		$config = new WxPayConfig();
		$result = WxPayApi::orderQuery($config, $input);
		if(array_key_exists("return_code", $result)
				&& array_key_exists("result_code", $result)
				&& $result["return_code"] == "SUCCESS"
				&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}

	/**
	 *
	 * 回包前的回调方法
	 * 业务可以继承该方法，打印日志方便定位
	 * @param string $xmlData 返回的xml参数
	 *
	 **/
	public function LogAfterProcess($xmlData)
	{
		//Log::DEBUG("call back， return xml:" . $xmlData);
		return;
	}

	//重写回调处理函数
	/**
	* @param WxPayNotifyResults $data 回调解释出的参数
	* @param WxPayConfigInterface $config
	* @param string $msg 如果回调处理失败，可以将错误信息输出到该方法
	* @return true回调出来完成不需要继续回调，false回调处理未完成需要继续回调
	*/
	public function NotifyProcess($objData, $config, &$msg)
	{
		$data = $objData->GetValues();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}

		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		
		$CI = &get_instance();
		
		$CI->load->service('event_order_service');
		$add = $CI->event_order_service->addWxPayNotifyLog($data);
		
		if( $add['msg'] !== 'success' ) {
			$msg = '记录通知添加错误';
			return false;
		}
		
		//TODO 2、进行签名验证
		try {
			$checkResult = $objData->CheckSign($config);
			if($checkResult == false){
				//签名错误
				$msg = '签名错误';
				$CI->event_order_service->updateWxPayNotifyLogState($add['data']['id'], 'error', $msg);
				return false;
			}
		} catch(Exception $e) {
			$msg = $e->getMessage();
			$CI->event_order_service->updateWxPayNotifyLogState($add['data']['id'], 'error', $msg);
			return false;
		}
		
		
		return true;
	}
}
