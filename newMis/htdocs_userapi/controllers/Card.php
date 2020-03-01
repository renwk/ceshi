<?php
class Card extends MY_Controller {

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
        $uid = $this->input->post_get('uid', true);
        $state = $this->input->post_get('state', true);

        if (isset($uid)) {
            $this->load->service('card_service');
            $card = $this->card_service->lsMy($uid, $state, 'balance');//储值卡
            if(!empty($card['data'])) {
                foreach ($card['data'] as $kk => $vv) {
                    $card['data'][$kk]['validity_time'] = date('Y-m-d', $vv['time_validity']);
                }
            }
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $card['data'];
        }else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败1';
            $data['data'] = array();
        }
        exit(json_encode($data,true));
    }

}