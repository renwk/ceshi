<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Buy extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        
        $this->load->service('card_service');
        $card = $this->card_service->lsCard();
        
        $data = array();
        $data['card'] = $card['data'];
        
        $this->load->view('glob/header');
        $this->load->view('buy/index', $data);
        $this->load->view('glob/footer');
        
    }
    
    public function gotoPay($cardid)
    {
        
        $addressid = $this->input->get('addressid', true);
        
        $this->load->service('user_service');
        if( !isId($addressid) ) {
           $address = $this->user_service->oneDefaultAddress($this->user['uuid']);
           $chooseExpress = false;
        } else {
           $address = $this->user_service->oneAddressByUuidAndId($this->user['uuid'], $addressid);
           $chooseExpress = true;
        }
        
        $this->load->service('card_service');
        $card = $this->card_service->oneCard($cardid);
        
        if( empty($card['data']) ) {
            exit('error');
        }
        
        $data = array();    
        $data['card'] = $card['data'];
        $data['cardid'] = $cardid;
        $data['address'] = $address['data'];
        $data['chooseExpress'] = $chooseExpress;
        
        $this->load->view('glob/header');
        $this->load->view('buy/gotoPay', $data);
        $this->load->view('glob/footer');
        
    }
    
    
    public function pay()
    {
        $cardid = $this->input->post('cardid', true);
        $addressId = $this->input->post('address_id', true);
        $getWay = $this->input->post('get_way', true);
        
        //添加充值订单
        $this->load->service('event_order_service');
        $add = $this->event_order_service->buyCard($this->user['userid'], $this->user['uuid'], $this->wechat['openid'], $cardid);
        
        
        if( $add['msg'] !== 'success' || empty($add['data']['jsApiParameters']) ) {
            exit('error_pay');
        }
        
        //添加购卡邮寄地址和提货码等扩展信息
        $this->load->service('card_service');
        $this->card_service->addBuyCardExtension($this->user['uuid'], $add['data']['mycardid'], $cardid, $add['data']['ucardOrderId'], $getWay, $addressId);
            
        $data['jsApiParameters'] = $add['data']['jsApiParameters'];
        
        $this->load->view('glob/header.php');
        $this->load->view('buy/pay', $data);
        
    }
    
    
}    
    