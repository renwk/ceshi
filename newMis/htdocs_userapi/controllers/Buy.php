<?php
class Buy extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * index
     * @param  uid state;
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function index(){

            $this->load->service('card_service');
            $card = $this->card_service->lsCard();
            if ($card['msg'] == 'success'){
                $data['status'] = true;
                $data['msg'] = 'success';
                $data['data'] = $card['data'];
            }else{
                $data['status'] = false;
                $data['msg'] = '网络错误';
                $data['data'] = array();
            }

            exit(json_encode($data,true));
    }
    public function getcards(){
        $uid = $this->input->post_get('uid');
        if(isset($uid)){
            $exceptIbCard = true;
            $this->load->service('card_service');
            $card = $this->card_service->lsMy($uid, 'normal', 'balance', $exceptIbCard);
            if(!empty($card['data'])){
                foreach ($card['data'] as $kk=>$vv){
                    $card['data'][$kk]['validitytime'] = date('Y-m-d', $vv['time_validity']);
                }
            }else{
                $card['data'] = null;
            }

            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $card['data'];
        }else{
            $data['status'] = false;
            $data['msg'] = '网络错误';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }
    public function gotoPay()
    {

        $cardid = $this->input->post_get('cardid', true);
        $uid = $this->input->post_get('uid', true);
        if(!empty($cardid)){
            $this->load->service('user_service');

            $address = $this->user_service->oneDefaultAddress($uid);
            $chooseExpress = false;

            $this->load->service('card_service');
            $card = $this->card_service->oneCard($cardid);

            if( empty($card['data']) ) {
                $data['status'] = false;
                $data['msg'] = '网络错误';
                $data['data'] = array();
            }else{
                $arr = array();
                $arr['card'] = $card['data'];
                $arr['cardid'] = $cardid;
                $arr['address'] = $address['data'];
                $arr['chooseExpress'] = $chooseExpress;

                $data['status'] = true;
                $data['msg'] = 'success';
                $data['data'] = $arr;
            }
        }else{
            $data['status'] = false;
            $data['msg'] = '信息错误';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }

}