<?php
class Collect extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * index
     * @param  userid;
     * @return exit(json_encode( array('status'=>true/false,'msg'   => 'success'/'错误信息','data'  => array()) ,true));
     * @author rwk
     */
    public function index(){
        $uid = $this->input->post_get('uid', true);
        $type = $this->input->post_get('type', true);

        if (isset($uid)) {
            $this->load->service('collect_service');
            $data = $this->collect_service->ls($uid, $type);
            $collect = $data['data'];
            foreach ($collect as $kk =>$vv){
                if($vv['type']=='adviser'){
                    $collect[$kk]['utype'] = '顾问';
                }else{
                    $collect[$kk]['utype']='理疗师';
                }
            }
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = $collect;
        }else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }

        exit(json_encode($data,true));
    }
    public function collectdel(){
        $uid = $this->input->post_get('uid', true);
        $id = $this->input->post_get('id', true);
        if(!empty($uid) && !empty($id)) {
            $this->load->service('collect_service');
            $result = $this->collect_service->deleteById($uid, $id);
            $data['status'] = true;
            $data['msg'] = 'success';
            $data['data'] = "删除成功";
        }else {
            $data['status'] = false;
            $data['msg'] = '获取信息失败';
            $data['data'] = array();
        }

        exit(json_encode($data,true));
    }

}