<?php

class Orderinfo_model extends CI_Model{

   public function getOrderInfo($uid, $stime, $etime)
   {
       $where = "o.status = 8105 AND o.paytype = 8002 AND user_id = '{$uid}' AND o.prestatus_time > {$stime} AND o.prestatus_time < {$etime}";
       $this->db->select('o.order_code,o.id,o.prestatus_time,GROUP_CONCAT(d.iname) as iname,GROUP_CONCAT(d.count) AS count ,GROUP_CONCAT(d.actual_price) as money');
       $this->db->from('s_order AS o');
       $this->db->join('s_order_detail AS d ',' d.order_code = o.order_code', 'left');
       $this->db->where($where);
       $this->db->group_by('o.id');
       $this->db->order_by('o.prestatus_time', 'desc');
       $query = $this->db->get();
       return $query->result_array();
   }

   public function getRechargeOrderInfo($uid, $stime, $etime)
   {
       $where = "o.status = 1 AND o.userid = '{$uid}' AND o.time_pay > {$stime} AND o.time_pay < {$etime}";
       $this->db->select("o.oid,o.time_pay,o.type,o.money_true,IF(o.type = 3,'礼券卡',c.cardname)as cardname,IF(o.type = 3,(SELECT GROUP_CONCAT(gift_code) FROM `s_gift_card` WHERE oid = o.oid),m.ucard_no) as ucard_no,
	                      count(o.oid) as count,(SELECT GROUP_CONCAT(price+cover_charge) FROM `s_gift_card` WHERE oid = o.oid) as gift_money");
       $this->db->from('s_ucard_order AS o');
       $this->db->join('o2o_card AS c ',' c.cardid = o.card_type', 'left');
       $this->db->join('o2o_mycard AS m ',' m.mycardid = o.ucard_id', 'left');
       $this->db->where($where);
       $this->db->group_by('o.oid');
       $this->db->order_by('o.time_pay', 'desc');
       $query = $this->db->get();
       return $query->result_array();
   }


   public function getOrderDetails($oid)
   {
       $sql = "SELECT
                o.order_code,s.sname,o.prestatus_time, GROUP_CONCAT(DISTINCT e.nickname) as aid_name,
                GROUP_CONCAT(DISTINCT b.nickname) AS bid_name,GROUP_CONCAT(DISTINCT sr.srname) as room_name,
                GROUP_CONCAT(DISTINCT d.iname) as iname,GROUP_CONCAT(DISTINCT d.actual_price) as price,
                o.order_price,o.tip,o.cover_charge,o.actual_price,o.discount_price,
                GROUP_CONCAT(DISTINCT re.money) as money,GROUP_CONCAT(DISTINCT re.paytype) as paytype
            FROM s_order as o
            LEFT JOIN o2o_store AS s ON s.sid = o.store_id
            LEFT JOIN s_order_adviser AS a ON a.order_code = o.order_code
            LEFT JOIN s_employees_manage AS e ON e.id = a.adviser_id
            LEFT JOIN s_order_detail AS d ON d.order_code = o.order_code
            LEFT JOIN o2o_beautician AS b on b.beauticianid = d.service_bid
            LEFT JOIN o2o_store_rtime AS r ON r.oid = o.order_code
            LEFT JOIN o2o_store_room as sr ON sr.srid = r.srid
            LEFT JOIN s_settlement_record AS re ON re.oid = o.id AND re.type = 1
            WHERE o.order_code = '{$oid}'  GROUP BY o.order_code";
       $query = $this->db->query($sql);
       return $query->result_array();
   }

   public function getRechargeOrderDetails($oid)
   {
       $sql = "SELECT
                o.oid,o.type,s.sname,o.time_pay,o.money_full,o.money_true,o.cost,o.free_num,o.consultant_id,
                IF(o.type = 3,(SELECT GROUP_CONCAT(gift_code) FROM `s_gift_card` WHERE oid = o.oid),o.ucard_no) as ucard_no,
                (SELECT GROUP_CONCAT(price+cover_charge) FROM `s_gift_card` WHERE oid = o.oid) as gift_money,
                GROUP_CONCAT(re.money) as d_money,GROUP_CONCAT(re.paytype) as pay
            FROM s_ucard_order as o
            LEFT JOIN o2o_store as s ON s.sid = o.sid
            LEFT JOIN s_settlement_record AS re ON re.oid = o.oid AND re.type = 2
            WHERE o.oid = {$oid} GROUP BY o.oid";
       $query = $this->db->query($sql);
       return $query->result_array();
   }

   public function getAidInfo($aid)
   {
       $this->db->select('nickname');
       $query = $this->db->get_where('s_employees_manage',array('id' => $aid));
       return $query->row_array();
   }

   public function getOrderCollectionInfo($oid)
   {
       $this->db->select('o.user_id,s.sname,s.storeid,s.adress,GROUP_CONCAT(a.adviser_id) as aid,GROUP_CONCAT(em.nickname) as nickname');
       $this->db->from('s_order AS o');
       $this->db->join('o2o_store AS s ',' s.sid = o.store_id', 'left');
       $this->db->join('s_order_adviser AS a ',' a.order_code = o.order_code', 'left');
       $this->db->join('s_employees_manage as em ',' em.id = a.adviser_id', 'left');
       $this->db->where('o.order_code', $oid);
       $this->db->group_by('o.order_code');
       $query = $this->db->get();
       return $query->result_array();

   }
}