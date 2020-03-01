<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WxpayCallback extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function notify()
    {
        
        $this->load->service('wechat_jsapi_pay_service');
        
        $this->wechat_jsapi_pay_service->backgroundCallback();
        
        
    }
    
    
    
}    