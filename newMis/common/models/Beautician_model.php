<?php
class Beautician_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function one($beauticianid)
	{
		$field = "
				o2o_beautician.beauticianid,
				o2o_beautician.bid,
				o2o_beautician.nickname,
				o2o_beautician.intro,
				o2o_beautician.photonew,
				o2o_store.sname
				";
		$this->db->select($field);
		$this->db->from('	o2o_beautician');
		$this->db->join('o2o_store', 'o2o_beautician.sid = o2o_store.sid', 'inner');
		$this->db->where('o2o_beautician.beauticianid', $beauticianid);
		$query = $this->db->get();
		return $query->row_array();
	}

    public function oneBybid($bid)
    {
        $field = "
				o2o_beautician.beauticianid,
				o2o_beautician.bid,
				o2o_beautician.nickname,
				o2o_beautician.intro,
				o2o_beautician.photonew,
				o2o_store.sname,
				o2o_store.sid
				";
        $this->db->select($field);
        $this->db->from('	o2o_beautician');
        $this->db->join('o2o_store', 'o2o_beautician.sid = o2o_store.sid', 'inner');
        $this->db->where('o2o_beautician.bid', $bid);
        $query = $this->db->get();
        return $query->row_array();
    }

	public function oneByMobile($mobile){
        $field = "
				o2o_beautician.beauticianid,
				o2o_beautician.bid,
				o2o_beautician.nickname,
				o2o_beautician.intro,
				o2o_beautician.photonew as photo,
				o2o_store.sname,
				o2o_store.sid,
				o2o_store.brand,
				o2o_beautician.brithday,
				o2o_beautician.jointime
				";
        $this->db->select($field);
        $this->db->from('	o2o_beautician');
        $this->db->join('o2o_store', 'o2o_beautician.sid = o2o_store.sid', 'inner');
        $this->db->where('o2o_beautician.phone', $mobile);
        $this->db->where('o2o_beautician.state = ',1);
        $this->db->where('o2o_store.state = ',1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getBeauticianBySid($sid){
        $field = "
				o2o_beautician.beauticianid,
				o2o_beautician.bid,
				o2o_beautician.nickname,
				o2o_beautician.intro,
				o2o_beautician.sid,
				o2o_beautician.photonew as photo,
				o2o_beautician.brithday,
				o2o_beautician.jointime
				";
        $this->db->select($field);
        $this->db->from('o2o_beautician');
        $this->db->where('o2o_beautician.sid',$sid);
        $this->db->where('o2o_beautician.state = ',1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getlevel($bid,$time){
	    $sql = "select g.*, l.level_name,gr.grade_month,b.nickname
from s_beautician_gradedetailed as g
left JOIN s_beautician_level as l on g.level_id = l.id
LEFT JOIN s_beautician_grade as gr on g.gradeid = gr.id 
LEFT JOIN o2o_beautician as b on g.beautician_id = b.beauticianid
where bid = '{$bid}'
AND grade_month = '{$time}'
AND `status`=0";
        $query = $this->db->query($sql);
        return $query->row_array();
    }


    //理疗师绩效 零售
    public function beauticianPerformance($bids,$stime,$etime){
        $sql = "select p.oid,p.bid,sum(p.pMoney)as pMoney,p.type,b.nickname
from s_ucard_order_performance as p
LEFT JOIN o2o_beautician as b on p.bid=b.bid
LEFT JOIN s_order as o on p.oid = o.order_code
where
b.bid = '{$bids}'
and p.type in ('5','6')
and p.`status`='1'
and p.position = '2'
and o.prestatus_time >'{$stime}'
and o.prestatus_time <='{$etime}'
GROUP BY p.bid,p.type";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    //零售退款
    public function refundbeauticianPerformance($bids,$stime,$etime){
        $sql = "select p.oid,p.bid,sum(p.pMoney)as pMoney,p.type,b.nickname
from s_ucard_order_performance as p
LEFT JOIN o2o_beautician as b on p.bid=b.bid
LEFT JOIN s_order_refund as r on p.oid = r.rid
where
b.bid = '{$bids}'
and 
p.type in ('5','6')
and
p.`status`='1'
and p.position = '2'
and r.`status`='3'
and r.type = '1'
and r.operate_time >'{$stime}'
and r.operate_time <='{$etime}'
GROUP BY p.bid,p.type";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    //售卡
    public function getCards($bids,$stime,$etime){
        $sql ="SELECT  u.oid, u.bid,  u.pMoney, u.`type` as otype,u.`status`, if(o.type = 3, 'gift',c.accounts) as accounts1
FROM	s_ucard_order as o
left JOIN s_ucard_order_performance as u on o.oid = u.oid
left JOIN o2o_card as c ON o.card_type = c.cardid
WHERE u.`position` = '2'
AND u.bid = '{$bids}'
AND u.`status` = '1'  
and o.time_pay >'{$stime}'
and o.time_pay <='{$etime}'
ORDER BY u.oid DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    //理疗师工时
    public function getTime($bids,$stime,$etime){
        $sql = "SELECT
                d.nickname,a.order_code,d.bid,a.level,COUNT(DISTINCT a.level) as levlNum,
                -- 排钟时长
                SUM(DISTINCT a.compane_time) AS rowTime,
                -- 排钟人数
                IF(a.service_type = 0,count(DISTINCT c.customer),0) AS rowNum,
                -- 点钟时长
                SUM(DISTINCT IF(a.service_type = 1,(a.clock_time),0)) AS spotTime,
                -- 点钟人数
                IF(a.service_type = 1,count(DISTINCT c.customer),0) AS spotNum,
                --    加钟时长
                a.add_bell_time,
                -- 升级加钟时长
             a.upgrade_bell_time,
              -- 升级加钟人数
             group_concat(c.detail_type) as bell_num
        FROM
                 s_order_beautician AS a
        LEFT JOIN s_order AS b ON b.order_code = a.order_code
        LEFT JOIN s_order_detail AS c ON c.order_code = a.order_code
        LEFT JOIN o2o_beautician AS d ON d.beauticianid = a.bid
        WHERE b.status = 8105 AND b.paytype = 8002 AND b.type in (8602,8604,8605,8606) 
         AND b.prestatus_time > '{$stime}' AND b.prestatus_time <= '{$etime}'  AND d.bid = '{$bids}' GROUP BY a.level,d.nickname,b.order_code ORDER BY b.prestatus_time DESC";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
    //
    public function getBelRewardTime($bid,$stime,$etime)
    {
        $sql1 ="SELECT A.bid,A.add_bell_reward_time,A.overtime,ob.bid as ids FROM s_order_beautician A LEFT JOIN s_order B ON A.order_code=B.order_code 
 LEFT JOIN o2o_beautician as ob on ob.beauticianid=A.bid
                WHERE B.status = 8105 AND B.paytype = 8002 AND B.type in (8602,8604,8605,8606) AND (A.add_bell_reward_time> 0 or A.overtime>0)";
        //union
        $sql2 = "SELECT A.bid,A.add_bell_reward_time,A.overtime,ob.bid as ids FROM s_recommend_beautician A LEFT JOIN s_order B ON A.order_code=B.order_code 
 LEFT JOIN o2o_beautician as ob on ob.beauticianid=A.bid
                WHERE B.status = 8105 AND B.paytype = 8002 AND B.type in (8602,8604,8605,8606) AND (A.add_bell_reward_time> 0 or A.overtime>0)";
        $sql = 'SELECT M.ids,M.bid,sum(M.add_bell_reward_time) as abtime ,count(M.add_bell_reward_time) as numab,sum(M.overtime) as overtime ,count(M.overtime) as num_over from (';
        if(!empty($stime) && !empty($etime)){
            $sql .= $sql1." AND b.prestatus_time >= '{$stime}' and b.prestatus_time < '{$etime}'"." union all ".$sql2." AND b.prestatus_time >= '{$stime}' and b.prestatus_time < '{$etime}'";
        }
        else {
            $sql .= $sql1." union ".$sql2;
        }
        $sql .= ") AS M where ids = '{$bid}' GROUP BY M.bid";

        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function performanceSumTime($bid,$stime,$etime){
        $sql = "SELECT sum(A.`compane_time`+A.`clock_time` +A.`add_bell_time` +A.`add_bell_reward_time` +A.`upgrade_bell_time` ) as Sumtime  FROM `s_order_beautician` A 
LEFT JOIN `s_order` B ON A.`order_code` =B.`order_code` 
LEFT JOIN `o2o_beautician` as be on A.bid = be.beauticianid
WHERE B.`prestatus_time` > '{$stime}'  AND be.`bid` ='{$bid}' AND B.`type` IN ('8602','8604','8606','8606') 
AND B.`status` =8105";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function performanceSumTimeStore($sid,$sumtime,$stime){
        $sql = "SELECT COUNT(*)+1 as store FROM 
(SELECT A.`bid` ,sum(A.`compane_time`+A.`clock_time` +A.`add_bell_time` +A.`add_bell_reward_time` +A.`upgrade_bell_time` ) as K   FROM `s_order_beautician` A 
LEFT JOIN `s_order` B ON A.`order_code` =B.`order_code` 
WHERE B.`prestatus_time` > '{$stime}'  AND B.`store_id`='{$sid}'  AND B.`type` IN ('8602','8604','8606','8606') 
AND B.`status` =8105  GROUP BY A.`bid`) as M WHERE M.K>{$sumtime}";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function performanceSumTimeBrand($brand,$SumTime,$stime){
        $sql = "SELECT COUNT(*)+1 as brand FROM 
(SELECT A.`bid` ,sum(A.`compane_time`+A.`clock_time` +A.`add_bell_time` +A.`add_bell_reward_time` +A.`upgrade_bell_time` ) as K   FROM `s_order_beautician` A 
LEFT JOIN `s_order` B ON A.`order_code` =B.`order_code` 
LEFT JOIN `o2o_store` C ON B.`store_id` =C.`sid` 
WHERE B.`prestatus_time` > '{$stime}'  AND C.`brand` ='{$brand}' AND B.`type` IN ('8602','8604','8606','8606') 
AND B.`status` =8105  GROUP BY A.`bid` ) as M WHERE M.K >{$SumTime}";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function cardMoney($bid,$stime){
        $sql = "select SUM(pMoney) as lMoney from
(SELECT p.bid,if(p.type=1,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p 
LEFT JOIN s_ucard_order as o on p.oid = o.oid
where p.bid = '{$bid}' and p.type in (1,2) AND p.`status`=1
and o.time_pay >'{$stime}' GROUP BY p.type
) as a ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function cardMoneyStore($sid,$lMoney,$stime){
        $sql = "SELECT COUNT(*)+1 as store FROM (
select bid,SUM(pMoney) as M from
(SELECT b.bid,if(p.type=1,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN o2o_beautician as b on p.bid = b.bid
LEFT JOIN s_ucard_order as o on p.oid = o.oid
where b.sid = '{$sid}' and p.type in (1,2) AND p.`status`=1 and o.time_pay >'{$stime}' GROUP BY b.bid,p.type
) as s  GROUP BY bid
) as p where p.M >{$lMoney}";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function cardMoneyBrand($brand,$lMoney,$stime){
        $sql = "SELECT COUNT(*)+1 as brand FROM (
select bid,SUM(pMoney) as M from
(SELECT b.bid,if(p.type=1,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN o2o_beautician as b on p.bid = b.bid
LEFT JOIN `o2o_store` C ON b.`sid` =C.`sid` 
LEFT JOIN s_ucard_order as o on p.oid = o.oid
where C.`brand` ='{$brand}' and p.type in (1,2) AND p.`status`=1 and o.time_pay >'{$stime}' GROUP BY b.bid,p.type
) as s  GROUP BY bid
) as p where p.M >{$lMoney}";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function retailMoney($bid,$stime){
        $sql = "select SUM(pMoney) as lMoney from
(SELECT p.bid,if(p.type=5,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p 
LEFT JOIN s_order as o on p.oid = o.order_code
where p.bid = '{$bid}' and p.type in (5,6) AND p.`status`=1
and o.prestatus_time >'{$stime}' GROUP BY p.type
) as a ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function retailMoneyStore($sid,$lMoney,$stime){
        $sql = "SELECT COUNT(*)+1 as store FROM (
select bid,SUM(pMoney) as M from
(SELECT b.bid,if(p.type=5,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN o2o_beautician as b on p.bid = b.bid
LEFT JOIN s_order as o on p.oid = o.order_code
where b.sid = '{$sid}' and p.type in (5,6) AND p.`status`=1 and o.prestatus_time >'{$stime}' GROUP BY b.bid,p.type
) as s  GROUP BY bid
) as p where p.M >{$lMoney}";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function retailMoneyBrand($brand,$lMoney,$stime)
    {
        $sql = "SELECT COUNT(*)+1 as brand FROM (
select bid,SUM(pMoney) as M from
(SELECT b.bid,if(p.type=5,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN o2o_beautician as b on p.bid = b.bid
LEFT JOIN `o2o_store` C ON b.`sid` =C.`sid` 
LEFT JOIN s_order as o on p.oid = o.order_code
where C.`brand` ='{$brand}' and p.type in (5,6) AND p.`status`=1 and o.prestatus_time >'{$stime}' GROUP BY b.bid,p.type
) as s  GROUP BY bid
) as p where p.M >{$lMoney}";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    //理疗师工时排序
    public function requestBidHoursAllInfo($sid)
    {
        $this->db->select('bid');
        $res = $this->db->get_where('o2o_beautician', array('sid' => $sid,'state' => 1,'display' => 1))->result_array();
        return $res ? $res : array();
    }
    public function requestBidHoursSort($bid)
    {
        $month = date('Ym');
        $this->db->select('b.nickname,e.actual_time,e.initial_time,e.thrown_time,e.training_time,e.add_bell_time,e.clock_time,e.add_bell_reward_time,e.overtime');
        $this->db->from('s_employee_hours as e');
        $this->db->join('o2o_beautician AS b ',' b.bid = e.bid');
        $this->db->where('e.bid', $bid);
        $this->db->where('e.time', $month);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function requestBidOverTimeInfo($bid, $date)
    {
        $sql = "SELECT o.otime_date,o.bid,o.otm_time,o.ott_time,a.username 
                FROM s_overtime AS o 
                LEFT JOIN o2o_admin AS a ON a.aid = o.create_id
                WHERE o.status = 1 AND o.post = 2
                AND (SELECT beauticianid FROM o2o_beautician where bid = '{$bid}') = o.bid  
                AND FROM_UNIXTIME(o.otime_date,'%Y-%m') = '{$date}'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function consultantBidOverTimeInfo($bid, $date)
    {
        $sql = "SELECT o.otime_date,o.bid,o.otm_time,o.ott_time,a.username 
                FROM s_overtime AS o 
                LEFT JOIN o2o_admin AS a ON a.aid = o.create_id
                WHERE o.status = 1 AND o.post = 1
                AND o.bid = '{$bid}'
                AND FROM_UNIXTIME(o.otime_date,'%Y-%m') = '{$date}'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function requestBidOverTimeTotal($bid, $ymd)
    {
        $sql = "SELECT sum(o.otm_time) as OTM,SUM(o.ott_time) as OTT 
                FROM s_overtime AS o 
                LEFT JOIN o2o_admin AS a ON a.aid = o.create_id
                WHERE  o.status = 1 AND o.post = 2
                AND (SELECT beauticianid FROM o2o_beautician where bid = '{$bid}') = o.bid  
                AND FROM_UNIXTIME(o.otime_date,'%Y-%m') = '{$ymd}'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function consultantBidOverTimeTotal($bid, $ymd)
    {
        $sql = "SELECT sum(o.otm_time) as OTM,SUM(o.ott_time) as OTT 
                FROM s_overtime AS o 
                LEFT JOIN o2o_admin AS a ON a.aid = o.create_id
                WHERE  o.status = 1 AND o.post = 1
                AND o.bid = '{$bid}'
                AND FROM_UNIXTIME(o.otime_date,'%Y-%m') = '{$ymd}'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function requestBidLeaveTime($bid, $ymd)
    {
        $sql = "SELECT
                l.stime,l.ott,l.otm,l.time,a.username,l.type
            FROM
                s_leave AS l
            LEFT JOIN o2o_admin as a ON a.aid = l.uid
            WHERE 
            FROM_UNIXTIME(l.stime,'%Y-%m') = '{$ymd}' AND l.post = 2 AND l.`status` = 1
            AND (SELECT beauticianid FROM o2o_beautician where bid = '{$bid}') = l.bid
            ORDER BY l.stime DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function consultantBidLeaveTime($bid, $ymd)
    {
        $sql = "SELECT
                l.stime,l.ott,l.otm,l.time,a.username,l.type
            FROM
                s_leave AS l
            LEFT JOIN o2o_admin as a ON a.aid = l.uid
            WHERE 
            FROM_UNIXTIME(l.stime,'%Y-%m') = '{$ymd}' AND l.post = 1 AND l.`status` = 1
            AND l.bid = '{$bid}'
            ORDER BY l.stime DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function requestBidLeaveTimeTotal($bid, $ymd)
    {
        $sql = "SELECT
            SUM(l.ott) AS OTT,SUM(l.otm) AS OTM,SUM(l.time) AS ltime
            FROM
                s_leave AS l
            LEFT JOIN o2o_admin as a ON a.aid = l.uid
            WHERE 
            FROM_UNIXTIME(l.stime,'%Y-%m') = '{$ymd}' AND l.post = 2 AND l.`status` = 1
            AND (SELECT beauticianid FROM o2o_beautician where bid = '{$bid}') = l.bid
            ORDER BY l.stime DESC";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function consultantBidLeaveTimeTotal($bid, $ymd)
    {
        $sql = "SELECT
            SUM(l.ott) AS OTT,SUM(l.otm) AS OTM,SUM(l.time) AS ltime
            FROM
                s_leave AS l
            LEFT JOIN o2o_admin as a ON a.aid = l.uid
            WHERE 
            FROM_UNIXTIME(l.stime,'%Y-%m') = '{$ymd}' AND l.post = 1 AND l.`status` = 1
            AND l.bid = '{$bid}'
            ORDER BY l.stime DESC";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function getSchedulType($sid) {
        $this->db->select('a.id,a.sid,b.config_description,b.config_note');
        $this->db->from('s_scheduling_type' . ' a');
        $this->db->join('s_config_system' . ' b', 'a.type=b.config_value', 'left');
        $this->db->where('a.sid', $sid);
        $this->db->where('status',0);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getSchedulInfo($query) {
        $this->db->select('date,config_note');
        $this->db->from('s_scheduling' . ' a');
        $this->db->from('s_scheduling_type' . ' b');
        $this->db->from('s_config_system' . ' c');
        $this->db->where(' a.scheduling_id = b.id and b.type=c.config_value');
        $this->db->where('a.beautician_id', $query['bid']);
        $this->db->where('DATE_FORMAT (a.date, "%Y-%m") = DATE_FORMAT ("'.$query['date'].'", "%Y-%m")');

        $result = $this->db->get();
        return $result->result_array();
    }
    //虚拟工时
    public function getThrowntime($bid,$time){
        $this->db->select('thrown_time');
        $this->db->from('s_employee_hours' . ' a');
        $this->db->where('a.bid', $bid);
        $this->db->where('a.time', $time);
        $result = $this->db->get();
        return $result->row_array();
    }
    // 获取理疗师流水目标
    public function getTargetWaterInfo($bid, $newmonth)
    {
        $this->db->select('a.aid,b.nickname,b.bid,cast((a.total_time/60) as decimal(10,2)) as total_time');
        $this->db->from('s_target_water AS a');
        $this->db->join('o2o_beautician AS b ',' b.beauticianid = a.aid','left');
        $this->db->where('a.`month`',$newmonth);
        $this->db->where('b.bid ',$bid);
        $this->db->where('a.type',2);
        $query = $this->db->get();
        return $query->row_array();
    }
}