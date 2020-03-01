<?php
class Employees_manage_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function one($id)
	{
		$field = "
				s_employees_manage.id,
				s_employees_manage.name,
				s_employees_manage.nickname,
				s_employees_manage.phone,
				s_employees_manage.photos,
				o2o_store.sname,
				";
		$this->db->select($field);
		$this->db->from('	s_employees_manage');
		$this->db->join('o2o_store', 's_employees_manage.sid = o2o_store.sid', 'inner');
		$this->db->where('s_employees_manage.id', $id);
		$query = $this->db->get();
		return $query->row_array();	
	}
	
	
	public function lsByIdArray($idArray)
	{
		$field = "
				s_employees_manage.id,
				s_employees_manage.name,
				s_employees_manage.nickname,
				s_employees_manage.phone,
				s_employees_manage.photos,
				o2o_store.sname,
				";
		$this->db->select($field);
		$this->db->from('	s_employees_manage');
		$this->db->join('o2o_store', 's_employees_manage.sid = o2o_store.sid', 'inner');
		$this->db->where_in('s_employees_manage.id', $idArray);
        $this->db->where('s_employees_manage.status = ',1);
		$query = $this->db->get();
		return $query->result_array();
	}

    public function oneByMobile($mobile){
        $field = "
				s_employees_manage.id,
				s_employees_manage.name,
				s_employees_manage.nickname,
				s_employees_manage.phone,
				s_employees_manage.photos as photo,
				s_employees_manage.position,
				s_employees_manage.entry_time as jointime,
				o2o_store.sname,
				o2o_store.sid,
				o2o_store.brand
				";
        $this->db->select($field);
        $this->db->from('	s_employees_manage');
        $this->db->join('o2o_store', 's_employees_manage.sid = o2o_store.sid', 'inner');
        $this->db->where('s_employees_manage.phone', $mobile);
        $this->db->where('s_employees_manage.status = ',1);
//        $this->db->where('s_employees_manage.position =',1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getConsultantBySid($sid){
        $field = "
				s_employees_manage.id,
				s_employees_manage.name,
				s_employees_manage.nickname,
				s_employees_manage.phone,
				s_employees_manage.photos as photo,
				s_employees_manage.position,
				s_employees_manage.entry_time as jointime,
				s_employees_manage.sid,
				";
        $this->db->select($field);
        $this->db->from('	s_employees_manage');
        $this->db->where('s_employees_manage.sid', $sid);
        $this->db->where('s_employees_manage.status = ',1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getConsultants($brand,$time)
    {
        $this->db->select('a.id,a.nickname,a.position,b.sname,b.sid');
        $this->db->from('s_employees_manage as a');
        $this->db->join('o2o_store as b ',' b.sid = a.sid','left');
        $this->db->where("(a.quit_time >= '{$time}' OR a.quit_time IS NULL OR a.quit_time = 0)");
//        $this->db->where('a.sid = ',$sid);
        $this->db->where('a.status = ',1);
        $this->db->where('b.brand = ',$brand);
        $this->db->group_by('id');
        $query = $this->db->get();
//        echo $this->db->last_query();die;
        return $query->result_array();
    }
    // 获取顾问流水目标
    public function getTargetWaterInfo($bid, $newmonth)
    {
        $this->db->select('a.aid,b.nickname,cast((a.flowing/100) as decimal(10,2)) as flowing,cast((a.`server`/100) as decimal(10,2)) as server,cast((a.retail/100) as decimal(10,2)) as retail');
        $this->db->from('s_target_water AS a');
        $this->db->join('s_employees_manage AS b ',' b.id = a.aid','left');
        $this->db->where('a.`month`',$newmonth);
        $this->db->where_in('b.id ',$bid);
        $this->db->where('a.type',1);
        $query = $this->db->get();
        return $query->row_array();
    }

    //顾问绩效 流水 服务人数
    public function consultantPerformance($bid,$stime,$etime){
        $sql = "select u.oid,u.bid,u.`position`
, sum(u.waterMoney) as waterMoney, sum(u.pMoney) as pMoney
,u.`time`, u.`type` ,u.`status`
,sum(o.reception) as reception
,s.`type` as config_type,
if(u.position = 1 ,(SELECT nickname FROM s_employees_manage as m WHERE m.id = u.bid),(SELECT nickname FROM o2o_beautician as b where b.bid = u.bid)) as nickname
	from s_ucard_order_performance as u
	LEFT JOIN s_order as s on u.oid = s.order_code
	left JOIN s_order_adviser as o on u.oid =o.order_code AND	u.bid = o.adviser_id
	where bid = '{$bid}'
  AND u.`status` = '1'
	AND s.`prestatus_time` >'{$stime}'
	AND s.`prestatus_time` <='{$etime}'
GROUP BY config_type";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function refundconsultantPerformance($bid,$stime,$etime){
        $sql = "select u.oid,u.bid,u.`position`
,sum(u.waterMoney) as waterMoney, sum(u.aMoney) as aMoney
,r.oid as id
,u.pMoney,u.`time`, u.`type`,u.`status`
,sum(o.reception) as reception
,if(u.position = 1 ,(SELECT nickname FROM s_employees_manage as m WHERE m.id = u.bid),(SELECT nickname FROM o2o_beautician as b where b.bid = u.bid)) as nickname
,if(u.type = 4 OR u.type = 6 ,(SELECT s.`type` as config FROM s_order_refund as re LEFT JOIN s_order as s on re.oid = s.order_code  where re.rid = u.oid AND re.`status`='3'),0) as o_type
	from s_ucard_order_performance as u
LEFT JOIN s_order_refund as r on u.oid = r.rid
	LEFT JOIN s_order as s on r.rid = s.order_code
	left JOIN s_order_adviser as o on r.oid =o.order_code 
	where
	bid = '{$bid}'
    AND u.`status` = '1'
		and r.type='1' and r.`status`='3'
	AND r.`operate_time` >'{$stime}'
	AND r.`operate_time` <='{$etime}'
	GROUP BY o_type";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function getCardTypeInfo($bid,$stime,$etime){
        $sql = "SELECT  u.oid, u.bid, u.waterMoney, u.aMoney,  u.pMoney,u.`time`, u.`type` as otype ,u.`status`,o.type,if(o.type = 3, 'gift',c.accounts) as accounts1
FROM	s_ucard_order as o
left JOIN s_ucard_order_performance as u on o.oid = u.oid
left JOIN o2o_card as c ON o.card_type = c.cardid
WHERE o.time_pay >='{$stime}' AND o.time_pay <'{$etime}'
AND u.bid = '{$bid}'
AND u.`position` = '1'
AND u.`status` = '1'   ORDER BY u.oid DESC";

        $query = $this->db->query($sql);
        return $query->result_array();

    }

    public function receptionNum($bid,$stime){
        $sql = "SELECT SUM(num1) as num FROM 
(SELECT SUM(a.reception) as num1
FROM s_order_adviser as a
LEFT JOIN s_order as o on a.order_code = o.order_code 
where a.adviser_id = '{$bid}' 
AND o.prestatus_time > '{$stime}' AND o.`status` =8105
UNION ALL
SELECT -SUM(a.reception) as num1
FROM s_order_adviser as a
LEFT JOIN s_order_refund as o on a.order_code = o.oid 
where a.adviser_id = '{$bid}' 
AND o.create_time > '{$stime}' AND o.`status` =3) as a";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function receptionNumStore($sid,$num,$stime){
        $sql = "SELECT count(*)+1 as store from(
SELECT adviser_id, SUM(num) as nums from (
SELECT adviser_id, SUM(a.reception) as num
FROM s_order_adviser as a
LEFT JOIN s_order as o on a.order_code = o.order_code 
LEFT JOIN s_employees_manage as ma on a.adviser_id = ma.id
where ma.sid = '{$sid}'
AND o.prestatus_time > '{$stime}' AND o.`status` =8105 GROUP BY adviser_id
UNION ALL
SELECT adviser_id, -SUM(a.reception) as num
FROM s_order_adviser as a
LEFT JOIN s_order_refund as o on a.order_code = o.oid 
LEFT JOIN s_employees_manage as ma on a.adviser_id = ma.id
where ma.sid = '{$sid}'
AND o.create_time > '{$stime}' AND o.`status` =3 GROUP BY adviser_id
) as M GROUP BY adviser_id ) as N where N.nums > {$num}";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function receptionNumBrand($brand,$num,$stime){
        $sql = "SELECT count(*)+1 as brand from(
SELECT adviser_id, SUM(num) as nums from (
SELECT adviser_id, SUM(a.reception) as num
FROM s_order_adviser as a
LEFT JOIN s_order as o on a.order_code = o.order_code 
LEFT JOIN s_employees_manage as ma on a.adviser_id = ma.id
LEFT JOIN o2o_store as s on ma.sid = s.sid
where s.brand = '{$brand}'
AND o.prestatus_time > '{$stime}' AND o.`status` =8105 GROUP BY adviser_id
UNION ALL
SELECT adviser_id, -SUM(a.reception) as num
FROM s_order_adviser as a
LEFT JOIN s_order_refund as o on a.order_code = o.oid 
LEFT JOIN s_employees_manage as ma on a.adviser_id = ma.id
LEFT JOIN o2o_store as s on ma.sid = s.sid
where s.brand = '{$brand}'
AND o.create_time > '{$stime}' AND o.`status` =3 GROUP BY adviser_id
) as M GROUP BY adviser_id ) as N where N.nums > {$num}";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function serviceMoney($bid,$stime){
        $sql = "select SUM(pMoney) as sMoney from
(SELECT p.bid,if(p.type=3,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p 
LEFT JOIN s_order as o on p.oid = o.order_code
where p.bid = '{$bid}' and p.type in (3,4) AND p.`status`=1
and o.prestatus_time >'{$stime}' GROUP BY p.type
UNION ALL
SELECT p.bid,if(p.type=3,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p 
LEFT JOIN s_order_refund as o on p.oid = o.rid 
where p.bid = '{$bid}'  AND p.`status`=1 AND p.type in(3,4)
and o.create_time >'{$stime}' GROUP BY p.type
) as a ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function serviceMoneyStore($sid,$sMoney,$stime){
        $sql = "SELECT COUNT(*)+1 as store FROM (
select id,SUM(pMoney) as M from
(SELECT b.id,if(p.type=3,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN s_employees_manage as b on p.bid = b.id
LEFT JOIN s_order as o on p.oid = o.order_code
where b.sid = '{$sid}' and p.type in (3,4) AND p.`status`=1 and o.prestatus_time >'{$stime}' GROUP BY b.id,p.type
UNION ALL
SELECT b.id,if(p.type=3,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN s_employees_manage as b on p.bid = b.id
LEFT JOIN s_order_refund as o on p.oid = o.rid 
where b.sid = '{$sid}' and p.type in (3,4) AND p.`status`=1 and o.create_time >'{$stime}' GROUP BY b.id,p.type
) as s  GROUP BY s.id
) as p where p.M >{$sMoney}";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function serviceMoneyBrand($brand,$sMoney,$stime){
        $sql = "SELECT COUNT(*)+1 as brand FROM (
select id,SUM(pMoney) as M from
(SELECT b.id,if(p.type=3,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN s_employees_manage as b on p.bid = b.id
LEFT JOIN s_order as o on p.oid = o.order_code
LEFT JOIN `o2o_store` C ON b.`sid` =C.`sid` 
where C.`brand` ='{$brand}' and p.type in (3,4) 
AND p.`status`=1 and o.prestatus_time >'{$stime}' GROUP BY b.id,p.type
UNION ALL
SELECT b.id,if(p.type=3,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN s_employees_manage as b on p.bid = b.id
LEFT JOIN s_order_refund as r on p.oid = r.rid 
LEFT JOIN `o2o_store` C ON b.`sid` =C.`sid` 
where C.`brand` ='{$brand}' and p.type in (3,4) 
AND p.`status`=1 and r.create_time >'{$stime}' GROUP BY b.id,p.type
) as s  GROUP BY s.id
) as p where p.M > {$sMoney}";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function waterMoney($bid,$stime){
        $sql = "select SUM(waterMoney) as waterMoney from(
SELECT p.bid,if(p.type in (3,5),sum(waterMoney),-SUM(waterMoney)) as waterMoney
FROM s_ucard_order_performance as p 
LEFT JOIN s_order as o on p.oid = o.order_code 
where p.bid = '{$bid}'  AND p.`status`=1 AND p.type in(3,4,5,6)
and o.prestatus_time >'{$stime}' GROUP BY p.type,p.bid
UNION ALL
SELECT p.bid,if(p.type=1,sum(waterMoney),-SUM(waterMoney)) as waterMoney
FROM s_ucard_order_performance as p 
LEFT JOIN s_ucard_order as o on p.oid = o.oid
where p.bid = '{$bid}'  AND p.`status`=1 AND p.type in(1,2)
and o.time_pay >'{$stime}' GROUP BY p.type,p.bid
UNION ALL
SELECT p.bid,if(p.type in (3,5),sum(waterMoney),-SUM(waterMoney)) as waterMoney
FROM s_ucard_order_performance as p 
LEFT JOIN s_order_refund as o on p.oid = o.rid 
where p.bid = '{$bid}'  AND p.`status`=1 AND p.type in(3,4,5,6)
and o.create_time >'{$stime}' GROUP BY p.type,p.bid
) as a";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function waterMoneyStore($sid,$waterMoney,$stime){
        $sql = "SELECT COUNT(*)+1 as store FROM (
select bid,SUM(waterMoney) as M from(
SELECT p.bid
,if(p.type in (3,5),sum(waterMoney),-SUM(waterMoney)) as waterMoney
FROM s_ucard_order_performance as p 
LEFT JOIN s_employees_manage as ma on p.bid=ma.id
LEFT JOIN s_order as o on p.oid = o.order_code 
where ma.sid='{$sid}' AND p.`status`=1 AND p.type in(3,4,5,6)
and o.prestatus_time >'{$stime}' GROUP BY p.type,p.bid
UNION ALL
SELECT p.bid,if(p.type=1,sum(waterMoney),-SUM(waterMoney)) as waterMoney
FROM s_ucard_order_performance as p 
LEFT JOIN s_employees_manage as ma on p.bid=ma.id
LEFT JOIN s_ucard_order as o on p.oid = o.oid
where ma.sid='{$sid}'   AND p.`status`=1 AND p.type in(1,2)
and o.time_pay >'{$stime}' GROUP BY p.type,p.bid
UNION ALL
SELECT p.bid,if(p.type in (3,5),sum(waterMoney),-SUM(waterMoney)) as waterMoney
FROM s_ucard_order_performance as p 
LEFT JOIN s_employees_manage as ma on p.bid=ma.id
LEFT JOIN s_order_refund as o on p.oid = o.rid 
where ma.sid='{$sid}'  AND p.`status`=1 AND p.type in(3,4,5,6)
and o.create_time >'{$stime}' GROUP BY p.type,p.bid
) as a GROUP BY a.bid
) as S where S.M >{$waterMoney}";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function waterMoneyBrand($brand,$waterMoney,$stime){
        $sql = "SELECT COUNT(*)+1 as brand FROM (
select bid,SUM(waterMoney) as M from(
SELECT p.bid
,if(p.type in (3,5),sum(waterMoney),-SUM(waterMoney)) as waterMoney
FROM s_ucard_order_performance as p 
LEFT JOIN s_employees_manage as ma on p.bid=ma.id
LEFT JOIN o2o_store as st on ma.sid=st.sid
LEFT JOIN s_order as o on p.oid = o.order_code 
where st.brand = '{$brand}' AND p.`status`=1 AND p.type in(3,4,5,6)
and o.prestatus_time >'{$stime}' GROUP BY p.type,p.bid
UNION ALL
SELECT p.bid,if(p.type=1,sum(waterMoney),-SUM(waterMoney)) as waterMoney
FROM s_ucard_order_performance as p 
LEFT JOIN s_employees_manage as ma on p.bid=ma.id
LEFT JOIN o2o_store as st on ma.sid = st.sid
LEFT JOIN s_ucard_order as o on p.oid = o.oid
where st.brand='{$brand}'  AND p.`status`=1 AND p.type in(1,2)
and o.time_pay >'{$stime}' GROUP BY p.type,p.bid
UNION ALL
SELECT p.bid,if(p.type in (3,5),sum(waterMoney),-SUM(waterMoney)) as waterMoney
FROM s_ucard_order_performance as p 
LEFT JOIN s_employees_manage as ma on p.bid=ma.id
LEFT JOIN o2o_store as st on ma.sid = st.sid
LEFT JOIN s_order_refund as o on p.oid = o.rid 
where st.brand='{$brand}'  AND p.`status`=1 AND p.type in(3,4,5,6)
and o.create_time >'{$stime}' GROUP BY p.type,p.bid
) as a GROUP BY a.bid
) as S where S.M >{$waterMoney}";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
}