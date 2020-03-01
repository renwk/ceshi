<?php
class Userdetail_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lsStore()
    {
        $field = "
        		storeid,
				sid,
				sname,
				intro";
        $this->db->select($field);
        $this->db->from('	o2o_store');
        $this->db->where('state = 1');
        $this->db->order_by('storeid', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getUserDetail($userid)
    {
        $this->db->select('a.userid,a.uid,a.mobile,a.userphoto,a.nickname name,a.birthday,a.sex,a.source,a.by_consultant consultant,a.bid,d.sname,a.registtime,a.balance,a.score,a.remark,a.costmoney,a.country,a.summary,a.costcount,count(e.uid) coupon_num,a.consultant_id');
        $this->db->from('o2o_users a');
        $this->db->join('o2o_mycoupon e', 'a.uid = e.uid', 'left');
        $this->db->join('o2o_store d', 'a.storefront = d.sid', 'left');
        $this->db->where('a.userid', $userid);

        $query = $this->db->get();
        return $query->row_array();
    }

    //获取config
    public function getConfigSystemList($where_key=null)
    {
        if(!empty($where_key))
        {
            $this->db->where('config_key', $where_key);
        }
        $this->db->select('config_value,config_description');
        $this->db->from('s_config_system');
        $query = $this->db->get();
        $rs    = $query->result_array();
        $re    = array();
        foreach($rs as $val)
        {
            $re[$val['config_value']] = $val['config_description'];
        }
        return $re;
    }

    //会员卡列表
    public function getUcardListByUserid($uid,$type_array=null)
    {
        if(!empty($type_array) && is_array($type_array))
        {
            $this->db->where_in('c.accounts',$type_array);
        }
        $this->db->select('a.mycardid,c.cardname,a.ucard_no');
        $this->db->from('o2o_mycard a');
        $this->db->from('o2o_users b');
        $this->db->from('o2o_card c');

        $this->db->where('b.userid', $uid);
        $this->db->where('a.uid = b.uid');
        $this->db->where('a.cardid = c.cardid');
        $this->db->where("(a.`state` = 'orderstate_complete' and a.`status` != 5)",'',false);
        $this->db->where('c.display = 0');//卡类型：正常
        $this->db->order_by('a.mycardid','DESC');
        $query = $this->db->get();
        $re    = $query->result_array();
        return $re;
    }

    //疗程
    public function getMycourse($uid,$type_arr=null)
    {
        $this->db->select('(@rowNum:=@rowNum+1) as rowNo,b.cardname,d.ucard_id,d.time_active,d.time_validity,a.total,a.used_times,a.occupy_times');
        $this->db->from('s_mycourse a');
        $this->db->join('o2o_card b', 'b.cardid = a.service_id', 'left');
        $this->db->join('o2o_users c', 'a.user_phone = c.mobile and c.userid='.$uid, 'left');
        $this->db->join('o2o_mycard d', 'a.ucard_id = d.mycardid', 'left');

        $this->db->from('(Select (@rowNum :=0) ) B');
        $this->db->order_by('a.id','DESC');

        $query = $this->db->get();
        $re    = $query->result_array();
        return $re;
    }
    //优惠券
    public function getMycoupon($uid)
    {
        $this->db->select('(@rowNum:=@rowNum+1) as rowNo,b.couponname,b.money,a.addtime,a.expiratime,a.state,a.usetime,c.order_code');
        $this->db->from('o2o_mycoupon a');
        $this->db->from('(Select (@rowNum :=0) ) B');
        $this->db->join('o2o_coupon b', 'b.couponid = a.couponid', 'left');
        $this->db->join('s_order c', 'a.mycouponid = c.coupon_code', 'left');
        $this->db->from('o2o_users d');
        $this->db->where('d.userid', $uid);
        $this->db->where('a.state !=', 'COUPON_WAITSEND');
        $this->db->where('a.uid = d.uid');
        $this->db->order_by('a.state,a.addtime','DESC');//a.addtime

        $query = $this->db->get();
        $re    = $query->result_array();
        return $re;
    }
    //
    public function getGiveCount($mobile)
    {
        $this->db->select('b.id');
        $this->db->from('s_give as a');
        $this->db->join('s_give_details AS b ',' b.give_id = a.id','left');
        $this->db->where('a.phone', $mobile);
        $this->db->where('b.status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    //用户消费订单消费记录
    public function getOrderByUid($uid,$stime, $etime, $condition)
    {
        $where = "1=1";
        if(!empty($condition)){
            $where = "`a`.`order_code` LIKE '%{$condition}%' or  `a`.`phone` LIKE '%{$condition}%' ";
        }
        $sql = "SELECT `a`.`id`, `a`.`order_code`, `d`.`sname`
, `a`.`phone`, `b`.`nickname` `name`, `a`.`platform`, `a`.`type`
, `a`.`status`,conf.config_description as `state`, `a`.`prestatus_time`, `a`.`service_number`
, `b`.`user_type`, `a`.`actual_price`, `a`.`discount_price`
, `a`.`create_time` as `time`, `is_refund`,GROUP_CONCAT(DISTINCT s.srid) AS sid_room
FROM `s_order` `a`
LEFT JOIN `o2o_users` `b` ON `a`.`user_id` = `b`.`uid`
LEFT JOIN `o2o_store` `d` ON `d`.`sid` = `a`.`store_id`
LEFT JOIN o2o_store_rtime as s ON s.oid = a.order_code 
LEFT JOIN `s_config_system` as conf on  `a`.`status` = conf.`config_value`
WHERE `a`.`user_id` = '{$uid}'
AND `a`.`prestatus_time` >='{$stime}'
AND `a`.`prestatus_time` <'{$etime}'
AND `b`.`uid` = `a`.`user_id`

AND `a`.`type` != 8601  AND `a`.`status` != -100
AND ({$where})
GROUP BY a.order_code
ORDER BY `a`.`prestatus_time` DESC";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getUcardStoreName($oid)
    {
        $this->db->select('b.sname');
        $this->db->from('s_ucard_order as a');
        $this->db->join('o2o_store AS b ',' b.sid = a.sid','left');
        $this->db->where('a.oid',$oid);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getOderStoreName($oid)
    {
        $this->db->select('b.sname');
        $this->db->from('s_order AS a');
        $this->db->join('o2o_store AS b ',' b.sid = a.store_id','left');
        $this->db->where('a.order_code',$oid);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getOderRefundStoreName($oid)
    {
        $this->db->select('c.sname');
        $this->db->from('s_order_refund AS a');
        $this->db->join('s_order AS b ',' b.order_code = a.oid','left');
        $this->db->join('o2o_store AS c ',' c.sid = b.store_id','left');
        $this->db->where('a.rid',$oid);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getUcardRefundStoreName($oid)
    {
        $this->db->select('c.sname');
        $this->db->from('s_ucard_refund AS a');
        $this->db->join('o2o_store AS c ',' c.sid = a.sid','left');
        $this->db->where('a.rid',$oid);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getMyCardInfo($mycardid)
    {
        $this->db->where('a.mycardid',$mycardid);

        $this->db->select("a.*,b.nickname,b.mobile,c.cardname,c.accounts,d.total,d.used_times,d.occupy_times,d.id mycourse_id,e.sname,f.nickname cname,b.balance,". "(SELECT GROUP_CONCAT(DISTINCT if(money> 0,money,null)separator '/')  FROM `s_mycourse_log` WHERE `mycourse_id`=d.id ORDER BY f.`id` DESC LIMIT 0,1) `one_cost`");
        $this->db->from('o2o_mycard a');
        $this->db->from('o2o_users b');
        $this->db->from('o2o_card c');
        $this->db->join('s_mycourse d', 'a.mycardid = d.ucard_id', 'left');
        $this->db->join('o2o_store e', 'a.sid = e.sid', 'left');
        $this->db->join('s_employees_manage f', 'a.consultant_id = f.id', 'left');

        $this->db->where('a.uid = b.uid');
        $this->db->where('a.cardid = c.cardid');
        $this->db->order_by('a.mycardid','DESC');
        $query = $this->db->get();
        $re    = $query->row_array();
        return $re;
    }

    public function getMyCardLog($mycardid,$mycourseid=null)
    {
        $this->db->where('a.mycardid',$mycardid);
        if(!empty($mycourseid))
        {
            $this->db->or_where('a.musourseid',$mycourseid);
        }

        $this->db->select('a.*,b.username,c.type pay_type');
        $this->db->from('s_card_cost_log a');
        $this->db->join('o2o_admin b', 'a.create_id = b.aid', 'left');
        $this->db->join('s_ucard_order c', 'a.oid = c.oid', 'left');
        $this->db->order_by('a.id','DESC');
        $query = $this->db->get();
        $re    = $query->result_array();

        return $re;
    }


    public function getGiveInfo($phone)
    {
        $sql = "SELECT
                c.sname,d.nickname,a.time as gtime,a.long,b.count,e.config_description as type,IF(b.`status` = 1,'未使用','已使用') AS status,
                IF(b.type = 8301,(SELECT service_name from s_service_info WHERE id = b.service_id),(SELECT name FROM `o2o_product` WHERE pid = b.service_id)) AS service_name,
                IF(b.type = 8301,(SELECT FORMAT(time/60,0) from s_service_info WHERE id = b.service_id),(SELECT standard FROM `o2o_product` WHERE pid = b.service_id)) AS time,
                IF(b.type = 8301,(SELECT FORMAT(now_price/100,2) FROM s_service_store WHERE service_id = b.service_id AND store_id =a.sid ),(SELECT FORMAT(current_price/100,2) FROM `o2o_product` WHERE pid = b.service_id)) AS price          
            FROM
                `s_give` AS a
            LEFT JOIN s_give_details AS b ON b.give_id = a.id
            LEFT JOIN s_employees_manage AS d ON d.id = a.aid
            LEFT JOIN o2o_store AS c ON c.sid = a.sid
            LEFT JOIN s_config_system AS e ON e.config_value = b.type AND e.config_key = 'SERVICETYPE'
            WHERE 
                b.`status` IN (1,2)AND a.phone = '{$phone}'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function getCustomer($uid)
    {
        $query = $this->db->select('*')->get_where('s_customer', array('userid' => $uid, 'type' => 1));
        return $query->row_array();
    }
    /**
     * 获取标签
     * getUserTag
     */
    public function getUserTag($costmoney)
    {
        if(!empty($costmoney)){
            $this->db->like('tag_name', $costmoney, 'both');
        }
        $this->db->select('tag_code, tag_name, tag_type, config_description');
        $this->db->from('s_user_tag as a');
        $this->db->join('s_config_system as b','b.config_value = a.tag_type','left');
        $this->db->where('status = ',1);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getTagType(){
        $this->db->select('config_value,config_description');
        $this->db->from('s_config_system ');
        $this->db->where('config_key = ','TAGTYPE');
        $query = $this->db->get();
        return $query->result_array();
    }
    /**
     * 获取会员标签名称
     * getUserTagCode
     */
    public function getUserTagCode($tag_code)
    {
        $this->db->select('tag_code,tag_name,tag_type');
        $this->db->from('s_user_tag');
        $this->db->where('status',1);
        $this->db->where_in('tag_code',$tag_code);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getTagInfo($tag_code)
    {
        $query = $this->db->select('tag_name, tag_code')->get_where('s_user_tag' , array('tag_code' => $tag_code));
        return $query->row_array();
    }
    public function usertaginfo($userid,$tagcode){
        $this->db->select('*');
        $this->db->from('s_customer as a');
        $this->db->where('userid = ',$userid);
        $this->db->like('tag_code', $tagcode, 'both');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function myContent($userid){
        $this->db->select('a.id,a.visit_time, a.addtime,a.type, a.mode, a.purpose, a.content,a.tag_code,b.nickname,if(LENGTH(a.employeeid)=36,
(select nickname from o2o_beautician as be where be.bid = a.employeeid),c.nickname) as aname');
        $this->db->from('s_customer as a');
        $this->db->join('o2o_users as b','b.userid = a.userid','left');
        $this->db->join('s_employees_manage as c','c.id = a.employeeid','left');
        $this->db->where('a.userid',$userid);
        $this->db->where('a.type =',0);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();

        return $query->result_array();
    }
    public function upTagData($data,$id){
        $this->db->where('id',$id);
        return $this->db->update("s_customer",$data);
    }
    public function upUserRemark($userid,$data){
        $this->db->where('userid',$userid);
        return $this->db->update("o2o_users",$data);
    }


    public function userComment($userid){
        $sql = "select a.content,a.datetime,b.uid,b.userid
from o2o_comment as a
LEFT JOIN  o2o_users as b on a.uid = b.uid
where b.userid = '{$userid}'
and a.state = '0'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function getUserTagInsert($data){
        $res = $this->db->insert('s_customer', $data);
        return $res;
    }
//判断是否有会员标签数据
    public function getUserTagOne($user_id)
    {
        $query = $this->db->select(' COUNT(*) as count')->get_where('s_customer', array('userid' => $user_id,'type'=>'1'));
        return $query->row_array();
    }
    public function getUserTagUpdate($id,$e_data){
        $this->db->where('id',$id);
        return $this->db->update("s_customer",$e_data);
    }
}