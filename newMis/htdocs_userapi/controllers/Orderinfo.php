<?php
class Orderinfo extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->service('orderinfo_service');
    }

    public function getOrderInfo()
    {
        $uid  = $this->input->post('uid',true);
        $idx  = $this->input->post('idx',true);
        $info = $this->orderinfo_service->getOrderInfo($uid, $idx);
        echo json_encode($info,true);
    }

    public function getOrderDetails()
    {
        $oid  = $this->input->post_get('oid',true);
        $type = $this->input->post_get('type',true);
        $info = $this->orderinfo_service->getOrderDetails($oid,$type);
        echo json_encode($info,true);
    }

    public function getOrderCollectionInfo()
    {
        $oid=$this->input->post_get('oid',true);
        $info = $this->orderinfo_service->getOrderCollectionInfo($oid);
        
        echo json_encode($info,true);
    }
    public function actionCollect()
    {
        $id = $this->input->post('id', true);
        $type = $this->input->post('type', true);
        $action = $this->input->post('action', true);
        $uid = $this->input->post('uid', true);

        $this->load->service('collect_service');
        if(  $action === 'add' ) {
            $result = $this->collect_service->add($uid, $id, $type);
        } elseif ( $action === 'delete' ) {
            $result = $this->collect_service->delete($uid, $id, $type);
        }else{
            $data['status'] = false;
            $data['msg'] = '网络链接错误，请稍后再试1';
            $data['data'] = array();
            exit(json_encode($data,true));
        }

        if( $result['msg'] == 'success' ) {
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $result;
        }else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败3';
            $data['data'] = array();
        }

        exit(json_encode($data,true));

    }
}