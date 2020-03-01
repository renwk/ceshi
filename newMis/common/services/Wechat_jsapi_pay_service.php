<?php
require_once COMMONPATH."libraries/wxPay/lib/WxPay.Config.Interface.php";

require_once COMMONPATH."libraries/wxPay/WxPay.Config.php";
require_once COMMONPATH."libraries/wxPay/WxPay.JsApiPay.php";

require_once COMMONPATH."libraries/wxPay/lib/WxPay.Api.php";

require_once COMMONPATH."libraries/wxPay/lib/WxPay.Data.php";
require_once COMMONPATH."libraries/wxPay/lib/WxPay.Exception.php";
require_once COMMONPATH."libraries/wxPay/lib/WxPay.Notify.php";

require_once COMMONPATH.'libraries/wxPay/PayNotifyCallBack.php';


class Wechat_jsapi_pay_service extends MY_Service{
	
	private $notifyUrl ;
	public function __construct() {
		parent::__construct();
		$this->notifyUrl = base_url('wxpayCallback/notify');
	}
	
	/**
	 * jsapi 微信支付
	 * @param
	 * @return return_type
	 * @author liujing<liukai5455@163.com>
	 */
	public function unifiedOrder($openId, $productName, $orderIdCode, $amount){
		try{
			
			$tools = new JsApiPay();
			
			$input = new WxPayUnifiedOrder();
			
			$input->SetBody( $productName );			// 商品描述
			//		$input->SetAttach("test");			// 附加数据，在查询API和支付通知中原样返回，可作为自定义参数使用。
			$input->SetOut_trade_no( $orderIdCode );		// 商户系统内部订单号，要求32个字符内，只能是数字、大小写字母_-|*@ ，且在同一个商户号下唯一。
			$input->SetTotal_fee( $amount );									// 订单总金额，单位为分
			$input->SetTime_start( date("YmdHis") ); // [订单生成时间]
			$input->SetTime_expire(date("YmdHis", time() + 600));		// [订单失效时间, 最短失效时间间隔必须大于5分钟]
			//		$input->SetGoods_tag("test");								// [商品标记，使用代金券或立减优惠功能时需要的参数]
			$input->SetNotify_url( $this->notifyUrl );			// 异步接收微信支付结果通知的回调地址，通知url必须为外网可访问的url，不能携带参数。
			$input->SetTrade_type("JSAPI");								// 取值如下：JSAPI，NATIVE，APP等
			$input->SetOpenid( $openId );
			
			$config = new WxPayConfig();
			$order = WxPayApi::unifiedOrder($config, $input);
			$jsApiParameters = $tools->GetJsApiParameters($order);
			$return  = array(
				'order' => $order,
				'jsApiParameters' => $jsApiParameters	
			);
			return returnMsg('success',  $return);
		} catch(Exception $e) {
				$return = array(
					'error_msg' => $e->getMessage()
				);
				return returnMsg('error_pay', $return);
		}
	
	}
	
	
	/**
	     * 微信支付 回调
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function backgroundCallback()
	{
		$config = new WxPayConfig();
		$notify = new PayNotifyCallBack();
		$notify->Handle($config, false);
	}
	
	
	
}