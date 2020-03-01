<?php
class Order_model extends CI_Model{
	protected $allowDisplayDateTime;
    
	public function __construct()
	{
		parent::__construct();
		$this->allowDisplayDateTime = strtotime('2018-12-20');
	}

	public function lsCousumption($uuid, $status)
	{
		$field = "
					id,
					order_code,
					store_id,
					user_id,
					paytype,
					actual_price,
					start_time,
					adviser			
				";
		$this->db->select($field);
		$this->db->from('s_order');
		$this->db->where('user_id', $uuid);
		$this->db->where('create_time >= '.$this->allowDisplayDateTime);
		$this->db->where_in('type', array(8602, 8603));
		if( $status === 'complete' ) {
			$this->db->where('status', 8105 );
		} else{
			return false;
		}
		
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	

	public function lsAppointment($uuid)
	{
		$field = "
				*
				";
		$this->db->select($field);
		$this->db->from('s_order');
		$this->db->where('user_id', $uuid);
		$this->db->where('type', 8601);
		$this->db->where('create_time >= '.$this->allowDisplayDateTime);
		$this->db->where_in('status', array(8101, 8102));
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
    public function Appointmentlist($uid,$times)
    {
        $field = "
				*
				";
        $this->db->select($field);
        $this->db->from('s_order');
        $this->db->where('user_id', $uid);
        $this->db->where('type', 8601);
        $this->db->where('prestatus_time >= '.$times);
        $this->db->where_in('status', array(8101, 8102));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function one($id)
	{
		$this->db->select('*');
		$this->db->from('s_order');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function confirmOrder($uuid, $id)
	{
		$data = array(
			'confirm_state' => 'confirm'
		);
		$this->db->where('user_id', $uuid);
		$this->db->where('id', $id);
		return $this->db->update('s_order', $data);
	}

	public function beauticianBespeakOrder($bid,$time,$etime){
        $sql = "SELECT o.is_bath,o.id as code_id,o.prestatus_time,o.user_id,u.nickname,u.mobile,o.service_number,o.iusetime
,GROUP_CONCAT(DISTINCT s.srid) AS sid_room
,o.order_code,o.`status`
-- ,o.source,o.source_detail
FROM `s_order` AS o 
LEFT JOIN o2o_users as u ON u.uid = o.user_id 
LEFT JOIN s_order_beautician AS b ON b.order_code = o.order_code 
LEFT JOIN o2o_beautician as be on be.beauticianid = b.bid
LEFT JOIN o2o_store_rtime as s ON s.oid = o.order_code
WHERE o.type = 8601 
and be.bid = '{$bid}'
AND o.prestatus_time >= {$time}
AND o.prestatus_time <= {$etime}
GROUP BY o.order_code 
ORDER BY o.prestatus_time ASC ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function consultantBespeakOrder($bid,$time,$etime){
        $sql = "SELECT o.is_bath,o.id as code_id,o.prestatus_time,o.user_id,u.nickname,u.mobile,o.service_number,o.iusetime,`u`.`userid`
,GROUP_CONCAT(DISTINCT s.srid) AS sid_room
,o.order_code,o.`status`
-- ,o.source,o.source_detail
FROM `s_order` AS o 
LEFT JOIN o2o_users as u ON u.uid = o.user_id 
LEFT JOIN s_order_adviser AS b ON b.order_code = o.order_code 
LEFT JOIN o2o_store_rtime as s ON s.oid = o.order_code
WHERE o.type = 8601 
and  b.adviser_id = '{$bid}'
AND o.prestatus_time >= {$time}
AND o.prestatus_time <= {$etime}
GROUP BY o.order_code 
ORDER BY o.prestatus_time ASC ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function bespeakOrderInfo($order_code){
        $sql = "SELECT o.is_bath,o.id as code_id,o.prestatus_time,o.user_id,u.nickname,u.mobile,o.service_number,u.sex,o.iusetime
,GROUP_CONCAT(DISTINCT ad.adviser_id) as abids,GROUP_CONCAT(DISTINCT be.bid) as bbids
,GROUP_CONCAT(DISTINCT s.srid) AS sid_room,o.order_code,o.`status`,GROUP_CONCAT(DISTINCT b.id) as id ,o.source,o.source_detail
FROM `s_order` AS o 
LEFT JOIN o2o_users as u ON u.uid = o.user_id 
LEFT JOIN s_order_beautician AS b ON b.order_code = o.order_code
LEFT JOIN o2o_beautician as be on be.beauticianid = b.bid
LEFT JOIN s_order_adviser AS ad ON ad.order_code = o.order_code 
LEFT JOIN o2o_store_rtime as s ON s.oid = o.order_code
WHERE o.type = 8601 
and  o.order_code = '{$order_code}'
GROUP BY o.order_code 
ORDER BY o.prestatus_time ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function requestConsultantName($bid)
    {
        $query = $this->db->select('nickname')->get_where('s_employees_manage',array('id'=>$bid));
        return $query->row_array();
    }
    public function requestBeauticianName($bid)
    {
        $query = $this->db->select('nickname')->get_where('o2o_beautician',array('bid'=>$bid));
        return $query->row_array();
    }
    public function getBeauticianName($bid)
    {
        $query = $this->db->select('nickname')->get_where('o2o_beautician',array('beauticianid'=>$bid));
        return $query->row_array();
    }
    public function getAdviser($order){//零售
        $sql = "SELECT 
GROUP_CONCAT(DISTINCT reception_aid) AS reception_aid
,GROUP_CONCAT(DISTINCT consultant_id) AS consultant_id
,GROUP_CONCAT(DISTINCT bid) AS bid
FROM `s_order_detail` as od
where order_code = '{$order}'
GROUP BY order_code";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function beauticianNameByOrder($order_code){
        $this->db->select('GROUP_CONCAT(DISTINCT be.nickname) as bname');
        $this->db->from('s_order as o');
        $this->db->join('s_order_beautician AS b','b.order_code = o.order_code','left');
        $this->db->join('o2o_beautician as be','be.beauticianid = b.bid','left');
        $this->db->where('o.order_code',$order_code);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function consultantNameByOrder($order_code){
        $this->db->select('GROUP_CONCAT(DISTINCT be.nickname) as bname');
        $this->db->from('s_order as o');
        $this->db->join('s_order_adviser AS b','b.order_code = o.order_code','left');
        $this->db->join('s_employees_manage AS be','be.id=b.adviser_id','left');
        $this->db->where('o.order_code',$order_code);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function requestBespeakRoom($room)
    {
        $query = $this->db->select('srname')->get_where('o2o_store_room',array('srid'=>$room));
        return $query->row_array();
    }
    public function getConfigSystem($config_value){
        $query = $this->db->select('config_description')->get_where('s_config_system',array('config_value'=>$config_value));
        return $query->row_array();
    }
    public function myCords($userId){
        $sql = "SELECT
	cs.config_description AS card_type,mc.ucard_no,-- mc.mycardid,
	IF(c.accounts = 'common' || c.accounts = 'other',(SELECT (total-used_times)AS num FROM s_mycourse WHERE ucard_id = mc.mycardid AND `status` = 1),mc.money_available)AS money
	FROM
			o2o_mycard AS mc
	LEFT JOIN o2o_card AS c ON c.cardid = mc.cardid
	LEFT JOIN s_config_system AS cs ON cs.config_value = c.accounts AND cs.config_key = 'MEMBERCARD'
	WHERE
			mc.uid = '{$userId}'
	AND mc.STATUS = 1
	AND mc.state = 'orderstate_complete'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function beauticianOrder($bid,$stime,$etime,$condition){
        $where = " 1=1 ";
        if(!empty($condition)){
            $where = " `a`.`order_code` LIKE '%{$condition}%' or  `a`.`phone` LIKE '%{$condition}%' ";
        }
        $sql = "SELECT `a`.`id`, `a`.`order_code`, `d`.`sname`,`b`.`userid`
, `a`.`phone`, `b`.`nickname` `name`, `a`.`platform`, `a`.`type`
, `a`.`status`,conf.config_description as `state`, `a`.`prestatus_time`, `a`.`service_number`
, `b`.`user_type`, `a`.`actual_price`, `a`.`discount_price`
, `a`.`create_time` as `time`, `is_refund`,GROUP_CONCAT(DISTINCT s.srid) AS sid_room
, IF((select count(tag_code) from s_customer as c where c.type = '0' and c.tag_code = a.order_code) > 0 , 1,0 ) as onotes
FROM `s_order` `a`
LEFT JOIN `o2o_users` `b` ON `a`.`user_id` = `b`.`uid`
LEFT JOIN `o2o_store` `d` ON `d`.`sid` = `a`.`store_id`
LEFT JOIN `s_order_beautician` `ob` ON `ob`.`order_code`=`a`.`order_code`
LEFT JOIN o2o_beautician as be on be.beauticianid = ob.bid
LEFT JOIN `s_config_system` as conf on  `a`.`status` = conf.`config_value`
LEFT JOIN o2o_store_rtime as s ON s.oid = a.order_code 
WHERE 
`be`.`bid` = '{$bid}'
AND `a`.`prestatus_time` >= {$stime}
AND `a`.`prestatus_time` < {$etime}
AND `a`.`type` != 8601 AND `a`.`status` != -100
AND ({$where})
GROUP BY a.order_code
ORDER BY `a`.`id` DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    //顾问 我的订单
    public function consultantOrder($bid,$stime,$etime,$condition){
        $where = "1=1";
        if(!empty($condition)){
            $where = "`a`.`order_code` LIKE '%{$condition}%' or  `a`.`phone` LIKE '%{$condition}%' ";
        }
        $sql = "SELECT `a`.`id`, `a`.`order_code`, `d`.`sname`,`b`.`userid`
,`od`.`bid`,`od`.`consultant_id`,`od`.`reception_aid`
, `a`.`phone`, `b`.`nickname` `name`, `a`.`platform`, `a`.`type`
, `a`.`status`,conf.config_description as `state`, `a`.`prestatus_time`, `a`.`service_number`
, `b`.`user_type`, `a`.`actual_price`, `a`.`discount_price`
, `a`.`create_time` as `time`, `is_refund`,GROUP_CONCAT(DISTINCT s.srid) AS sid_room
, IF((select count(tag_code) from s_customer as c where c.type = '0' and c.tag_code = a.order_code) > 0 , 1,0 ) as onotes
FROM `s_order` `a`
LEFT JOIN `o2o_users` `b` ON `a`.`user_id` = `b`.`uid`
LEFT JOIN `o2o_store` `d` ON `d`.`sid` = `a`.`store_id`
LEFT JOIN `s_order_detail` as od on od.order_code=a.order_code
LEFT JOIN s_order_adviser as oa on a.order_code=oa.order_code
LEFT JOIN `s_employees_manage` as em on oa.adviser_id=em.id
LEFT JOIN `s_config_system` as conf on  `a`.`status` = conf.`config_value`
LEFT JOIN o2o_store_rtime as s ON s.oid = a.order_code 
WHERE
`em`.`id` = '{$bid}'
AND `a`.`prestatus_time` >='{$stime}'
AND `a`.`prestatus_time` <'{$etime}'
AND `a`.`type` != 8601 AND `a`.`status` != -100
AND ({$where})
GROUP BY a.order_code
ORDER BY `a`.`prestatus_time` DESC";
//        echo $sql;die;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function usercharge($userid,$stime, $etime, $condition){
        $where = " 1=1 ";
        if(!empty($condition)){
            $where = "`a`.`oid` LIKE '%{$condition}%' or  `b`.`mobile` LIKE '%{$condition}%' ";
        }
        $sql = "SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`, `b`.`nickname` `name`, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
b.userid = {$userid}
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='{$stime}'
AND `a`.`time_pay`<'{$etime}'
and ({$where})
ORDER BY `a`.`id` DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function chargeOrder($bid,$stime,$role,$etime,$condition){
        $where = "1=1";
        if($role == "beautician"){
            $where = "find_in_set('{$bid}',a.bid)";
        }elseif($role =='consultant'){
            $where = "find_in_set('{$bid}',a.consultant_id)";
        }
        $where1 = " 1=1 ";
        if(!empty($condition)){
            $where1 = "`a`.`oid` LIKE '%{$condition}%' or  `b`.`mobile` LIKE '%{$condition}%' ";
        }
        $sql = "SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`
, `b`.`nickname` `name`
, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`
, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
{$where}
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='{$stime}'
AND `a`.`time_pay`<'{$etime}'
and ({$where1})
ORDER BY `a`.`id` DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /*     * *
     * 美容师列表 by 订单
     *
     */
    public function getBeauticianByOrderList($order_list) {
        $this->db->where_in('a.order_code', $order_list);
        $this->db->select('a.order_code,b.nickname,a.service_type,a.start_time,a.end_time,compane_time,clock_time,add_bell_time,training_time,level,add_bell_reward_time,overtime');
        $this->db->from('s_order_beautician as a');
        $this->db->from('o2o_beautician as b');
        $this->db->where('a.bid = b.beauticianid');
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getRecommendBeautician($order_code) {
        $this->db->where('a.order_code', $order_code);
        $this->db->select('b.nickname,compane_time,clock_time,add_bell_time,training_time,level,add_bell_reward_time,overtime');
        $this->db->from('s_recommend_beautician a');
        $this->db->from('o2o_beautician b');
        $this->db->where('a.bid = b.beauticianid');
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        $re = $query->result_array();
        return $re;
    }
    public function getOrderConts($oid) {
        $this->db->select('oa.adviser_id,em.nickname,reception');
        $this->db->from('s_order_adviser oa');
        $this->db->join('s_employees_manage em', "oa.adviser_id=em.id");
        $this->db->where(array('order_code' => $oid));
        $res = $this->db->get()->result_array();
        return $res ? $res : array();
    }
    /*     * *
     * 顾问列表 by 订单列表
     *
     */
    public function getAdviserByOrderList($order_list) {
        $this->db->where_in('a.order_code', $order_list);
        $this->db->select('a.order_code,b.nickname');
        $this->db->from('s_order_adviser as a');
        $this->db->from('s_employees_manage as b');
        $this->db->where('a.adviser_id = b.id');
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getOrderRoomByCode($order_code) {
        $this->db->where('a.oid', $order_code);
        $this->db->select('b.srname');
        $this->db->from('o2o_store_rtime a');
        $this->db->from('o2o_store_room b');
        $this->db->where('a.srid = b.srid');
        $this->db->order_by('a.srtid', 'DESC');
        $query = $this->db->get();
        $rs = $query->result_array();
        $re = '';
        foreach ($rs as $val) {
            $re .= ($val['srname'] . ' ');
        }
        return $re;
    }

    public function getOrderInfoByCode($order_code) {
        $this->db->where('a.order_code', $order_code);
        $this->db->select('a.id,b.userid,b.nickname,a.phone,a.platform,a.service_number,a.woman,a.man,a.prestatus_time,a.iusetime,a.adviser,a.is_roomorder,b.user_type,d.cardname card_id,ucard_no,a.paytype,a.status,f.couponname coupon_code,a.adjust_price,a.adjustment,a.cover_charge,a.tip,a.order_price,a.type,a.remark,a.coupon_price,a.service_price,a.discount_price,a.actual_price,a.order_code oid,g.sname,a.create_time,a.store_id sid,a.free_order,card_gift_money,package_id,package_money,package_name,a.source,a.source_detail');
        $this->db->from('s_order a');
        $this->db->from('o2o_users b');
        $this->db->join('o2o_mycard c', 'a.card_id = c.mycardid', 'left');
        $this->db->join('o2o_card d', 'c.cardid = d.cardid', 'left');
        $this->db->join('o2o_mycoupon e', 'e.mycouponid = a.coupon_code', 'left');
        $this->db->join('o2o_coupon f', 'e.couponid = f.couponid', 'left');
        $this->db->join('o2o_store g', 'g.sid = a.store_id', 'left');
        $this->db->join('s_mypackage m', 'm.mypackageid = a.package_id', 'left');
        $this->db->join('s_package p', 'p.id = m.packageid', 'left');
        $this->db->where('a.user_id = b.uid');
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        return $query->row_array();
    }

    /*     * *
     * 订单详情列表
     *
     */
    public function getOrderDetailByCode($order_code) {
        $this->db->where('order_code', $order_code);

        $this->db->select('a.order_code,a.id,a.iname,a.type,a.detail_type,a.now_price,a.discount_price,a.actual_price,a.count,a.refund_num,a.refund_status,b.iusetime,a.customer,a.item_id,c.nickname service_bid,a.bid,a.consultant_id,a.reception_aid,a.category,a.member_discount,a.performance_money,course_id,gift_card_id');
        $this->db->from('s_order_detail a');
        $this->db->join('o2o_item b', 'a.item_id = b.iid', 'left');
        $this->db->join('o2o_beautician c', 'a.service_bid = c.beauticianid', 'left');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /*     * *
     * 订单详情（项目/产品详情）列表
     *
     */
    public function getOrderDetailInfo($detail_lsit, $sid) {
        $re = array();
        foreach ($detail_lsit as $key => $val) {
            if ($key == '8301' || $key == '8303') {//8301 项目    8303 疗程
                $this->db->select('a.service_id id,a.price price,a.now_price now_price,b.time');
                $this->db->from('s_service_store a');
                $this->db->from('s_service_info b');
                $this->db->where('a.service_id = b.id');
                $this->db->where_in('a.service_id', $detail_lsit[$key]);
                $this->db->where('a.store_id = ', $sid);
                $this->db->order_by('a.service_id', 'DESC');
                $query = $this->db->get();
                $re[$key] = $query->result_array();
            } else if ($key == '8302') {//8302 产品
                $this->db->select('a.pid id,a.original_price price,a.current_price now_price');
                $this->db->from('o2o_product a');
                $this->db->where_in('a.pid', $detail_lsit[$key]);
                $this->db->order_by('a.productid', 'DESC');
                $query = $this->db->get();
                $re[$key] = $query->result_array();
            } else {
                continue;
            }
        }

        return $re;
    }

    /*     * *
     * 订单信息-支付方式
     *
     */
    public function getOrderPlayByCode($order_code) {
        $this->db->where('a.oid', $order_code);
        $this->db->select('a.paytype,a.money,a.ext_info');
        $this->db->from('s_settlement_record a');
        $this->db->where('a.status', 1);
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        $re = $query->result_array();
        return $re;
    }
    public function getPerformance($oid){
        $sql = "select u.oid,u.position,u.bid,u.waterMoney,u.aMoney,u.pMoney,
 if(position = 1 ,(SELECT nickname FROM s_employees_manage as m WHERE m.id = u.bid),(SELECT nickname FROM o2o_beautician as b where b.bid = u.bid)) as name 
from
s_ucard_order_performance u
where
u.oid  = '{$oid}' and u.status = '1'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    //判断是否是礼券卡
    public function getIsType($oid) {
        $this->db->select('card_type');
        $this->db->from('s_ucard_order');
        $this->db->where('oid', $oid);
        $query = $this->db->get();
        return $query->row_array();
    }

    /*     * *
     * 获取充值订单信息
     *
     */
    public function getUcardOrder($oid = null) {
        if (!empty($oid)) {
            $this->db->where('a.oid', $oid);
        }
        $this->db->select('a.money_true,b.userid,b.mobile,b.uid,b.nickname,b.by_consultant,b.bid by_bname,b.user_type,a.oid,a.ucard_id,a.total_num,a.status,FROM_UNIXTIME(a.create_time, "%Y-%m-%d %H:%i:%S") create_time,FROM_UNIXTIME(a.time_pay, "%Y-%m-%d %H:%i:%S") time_pay,a.consultant_id,a.bid,d.nickname ucard_consultant,e.cardname,e.accounts,a.money_full money_true,a.money_true money_true_true,a.cost,a.free_num,a.gift_coupon,e.money,c.ucard_no,f.sname,g.nickname as reception_aid,h.nickname as exclusive_aid');
        $this->db->from('s_ucard_order a');
        $this->db->from('o2o_users b');
        $this->db->join('o2o_mycard c', 'a.ucard_id = c.mycardid', 'left');
        $this->db->join('o2o_card e', 'a.card_type = e.cardid', 'left');
        $this->db->join('s_employees_manage d', 'c.consultant_id = d.id', 'left');//exclusive_aid
        $this->db->join('o2o_store f', 'a.sid = f.sid', 'left');
        $this->db->join('s_employees_manage AS g ', ' g.id = a.reception_aid', 'left');
        $this->db->join('s_employees_manage AS h ', ' h.id = a.exclusive_aid', 'left');
        $this->db->where('a.userid = b.uid');
        $this->db->order_by('a.id', 'DESC');
        $query = $this->db->get();
        $re = $query->row_array();
        return $re;
    }


    /*     * *
     * 获取充值订单 优惠券信息
     *
     */
    public function getCouponInfo($coupon_list = null) {
        if (empty($coupon_list) && !is_array($coupon_list)) {
            return array();
        }

        $this->db->select('a.couponid,a.couponname');
        $this->db->from('o2o_coupon a');
        $this->db->where_in('a.couponid', $coupon_list);
        $query = $this->db->get();
        $re = $query->result_array();
        return $re;
    }

    //获取会员信息
    public function getCardInfo($oid) {
        $this->db->select('a.`money_true`,b.userid,b.nickname,b.uid,b.mobile,b.user_type,b.by_consultant,b.bid,c.sname,a.oid,a.`status`,FROM_UNIXTIME(a.create_time, "%Y-%m-%d %H:%i:%S") create_time,FROM_UNIXTIME(a.time_pay, "%Y-%m-%d %H:%i:%S") time_pay,a.consultant_id,a.bid AS card_bid,e.nickname as ucard_consultant,f.nickname as reception_aid');
        $this->db->from('s_ucard_order AS a');
        $this->db->join('o2o_users as b ', ' b.uid = a.userid', 'left');
        $this->db->join('o2o_store AS c ', ' c.sid = a.sid', 'left');
        $this->db->join('s_gift_card AS d ', ' d.oid = a.oid', 'left');
        $this->db->join('s_employees_manage AS e ', ' e.id = d.sales_consultant', 'left');//
        $this->db->join('s_employees_manage AS f ', ' f.id = a.reception_aid', 'left');//
        $this->db->where('a.oid', $oid);
        $query = $this->db->get();
        return $query->row_array();
    }
    //获取礼券卡信息
    public function getGiftUCardInfo($oid) {
        $this->db->select("a.gift_code as cardname,a.price,a.cover_charge");
        $this->db->from('s_gift_card as a');
        $this->db->where('a.oid', $oid);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPosType($id = null) {
        if (!empty($id)) {
            $this->db->where('id', $id);
        }
        $this->db->select('a.id,a.pay_name');
        $this->db->from('o2o_order_scattered_pay a');
        $this->db->where('paytype', '0');
        $this->db->where('display', '0');

        $query = $this->db->get();
        return $query->row_array();
    }
    /*     * *
     * 获取我的会员卡列表
     *
     */
    public function getMyCardInfo($mycardid) {
        $this->db->select('a.ucard_no, b.cardname');
        $this->db->from('o2o_mycard a');
        $this->db->from('o2o_card b');
        $this->db->where('a.cardid = b.cardid ');
        $this->db->where('a.mycardid', $mycardid);
        $query = $this->db->get();
        $re = $query->row_array();
        return $re;
    }
    //获取config
    public function getConfigSystemList($where_key = null) {
        if (!empty($where_key)) {
            $this->db->where('config_key', $where_key);
        }
        $this->db->select('config_value,config_description');
        $this->db->from('s_config_system');
        $query = $this->db->get();

        $rs = $query->result_array();
        $re = array();
        foreach ($rs as $val) {
            $re[$val['config_value']] = $val['config_description'];
        }
        return $re;
    }
    /*     * *
     * 获取充值订单 推荐理疗师列表
     *
     */
    public function getBidByOrder($bid = null) {
        if (empty($bid)) {
            return '';
        }
        $bid_list = explode(',', $bid);
        $this->db->select('a.nickname');
        $this->db->from('o2o_beautician a');
        $this->db->where_in('a.bid', $bid_list);
        $query = $this->db->get();
        $rs = $query->result_array();
        $re = array();
        if (!empty($rs))
            foreach ($rs as $val) {
                $re[] = $val['nickname'];
            }

        $re = !empty($re) ? implode(',', $re) : '';
        return $re;
    }

    /*     * *
     * 获取充值订单 推荐顾问列表
     *
     */
    public function getCidByOrder($cid = null) {
        if (empty($cid)) {
            return '';
        }
        $cid_list = explode(',', $cid);
        $this->db->select('a.nickname');
        $this->db->from('s_employees_manage a');
        $this->db->where_in('a.id', $cid_list);
        $query = $this->db->get();
        $rs = $query->result_array();
        $re = array();
        if (!empty($rs))
            foreach ($rs as $val) {
                $re[] = $val['nickname'];
            }

        $re = !empty($re) ? implode(',', $re) : '';
        return $re;
    }

    //门店消费订单
    public function lsCashierbySid($sid,$stime,$etime,$where){
        $sql = "SELECT `a`.`id`, `a`.`order_code`, `d`.`sname`, `a`.`phone`, `b`.`nickname` `name`,`b`.`uid`, `a`.`platform`
, `a`.`type`, `a`.`status`, `a`.`prestatus_time`, `a`.`service_number`, `b`.`user_type`
,`a`.`actual_price`,conf.config_description as `state`
, `a`.`discount_price`, `a`.`create_time` as `time`, `is_refund`,GROUP_CONCAT(DISTINCT s.srid) AS sid_room
FROM `s_order` `a`
LEFT JOIN `o2o_users` `b` ON `a`.`user_id` = `b`.`uid`
LEFT JOIN `o2o_store` `d` ON `d`.`sid` = `a`.`store_id`
LEFT JOIN `s_config_system` as conf on  `a`.`status` = conf.`config_value`
LEFT JOIN o2o_store_rtime as s ON s.oid = a.order_code 
WHERE `a`.`store_id` = '{$sid}'
AND `a`.`prestatus_time` > {$stime}
AND `a`.`prestatus_time` <= {$etime}
AND `a`.`type` != 8601 AND `a`.`status` != -100
AND ({$where})
GROUP BY order_code
ORDER BY `a`.`id` DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function lsChargebySid($sid,$stime,$etime,$where){
        $sql = "SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`
, `b`.`nickname` `name`
, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`
, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE  `g`.`sid` = '{$sid}'
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay` > {$stime}
AND `a`.`time_pay` <= {$etime}
AND ({$where})
GROUP BY oid
ORDER BY `a`.`id` DESC";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function getchannel($code){
        $this->db->select('a.name');
        $this->db->from('s_users_channel as a');
        $this->db->where('id = ', $code);
        $query = $this->db->get();
        return $query->row_array();
    }
}