<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-25 11:14:22 --> Severity: Warning --> Missing argument 3 for Order_model::beauticianBespeakOrder(), called in E:\wamp\www\newMis\newMis\common\services\Order_service.php on line 420 and defined E:\wamp\www\newMis\newMis\common\models\Order_model.php 76
ERROR - 2018-09-25 11:14:22 --> Severity: Notice --> Undefined variable: time E:\wamp\www\newMis\newMis\common\models\Order_model.php 100
ERROR - 2018-09-25 11:14:22 --> Severity: Notice --> Undefined variable: time E:\wamp\www\newMis\newMis\common\models\Order_model.php 101
ERROR - 2018-09-25 11:14:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND o.prestatus_time <= (+86400) 
GROUP BY o.order_code 
ORDER BY o.prestatus_' at line 12 - Invalid query: SELECT o.is_bath,o.id as code_id,o.prestatus_time,o.user_id,u.nickname,u.mobile,o.service_number,o.iusetime
,GROUP_CONCAT(DISTINCT s.srid) AS sid_room
,o.order_code,o.`status`
FROM `s_order` AS o 
LEFT JOIN o2o_users as u ON u.uid = o.user_id 
LEFT JOIN s_order_beautician AS b ON b.order_code = o.order_code 
LEFT JOIN o2o_beautician as be on be.beauticianid = b.bid
LEFT JOIN o2o_store_rtime as s ON s.oid = o.order_code
WHERE o.type = 8601 
and be.bid = 'bcc671f7_e54b_5578_92c8_022a586a9ed7'
AND o.prestatus_time >= 
AND o.prestatus_time <= (+86400) 
GROUP BY o.order_code 
ORDER BY o.prestatus_time DESC
ERROR - 2018-09-25 11:34:21 --> Severity: Parsing Error --> syntax error, unexpected 'elseif' (T_ELSEIF) E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:00:35 --> Query error: Unknown column 'srname' in 'field list' - Invalid query: SELECT `srname`
FROM `s_order`
LEFT JOIN `s_order_beautician` AS `b` ON `b`.`order_code` = `o`.`order_code`
LEFT JOIN `o2o_beautician` as `be` ON `be`.`beauticianid` = `b`.`bid`
WHERE `o`.`order_code` = 'Y20180920211159613'
ERROR - 2018-09-25 12:01:11 --> Query error: Unknown column 'o.order_code' in 'where clause' - Invalid query: SELECT GROUP_CONCAT(DISTINCT be.nickname) as bname
FROM `s_order`
LEFT JOIN `s_order_beautician` AS `b` ON `b`.`order_code` = `o`.`order_code`
LEFT JOIN `o2o_beautician` as `be` ON `be`.`beauticianid` = `b`.`bid`
WHERE `o`.`order_code` = 'Y20180920211159613'
ERROR - 2018-09-25 12:11:13 --> Severity: Notice --> Undefined variable: bbids E:\wamp\www\newMis\newMis\common\services\Order_service.php 484
ERROR - 2018-09-25 12:11:13 --> Severity: Warning --> Invalid argument supplied for foreach() E:\wamp\www\newMis\newMis\common\services\Order_service.php 484
ERROR - 2018-09-25 12:11:13 --> Severity: Notice --> Undefined variable: abids E:\wamp\www\newMis\newMis\common\services\Order_service.php 488
ERROR - 2018-09-25 12:11:13 --> Severity: Warning --> Invalid argument supplied for foreach() E:\wamp\www\newMis\newMis\common\services\Order_service.php 488
ERROR - 2018-09-25 12:11:26 --> Severity: Notice --> Undefined variable: bbids E:\wamp\www\newMis\newMis\common\services\Order_service.php 484
ERROR - 2018-09-25 12:11:26 --> Severity: Warning --> Invalid argument supplied for foreach() E:\wamp\www\newMis\newMis\common\services\Order_service.php 484
ERROR - 2018-09-25 12:11:26 --> Severity: Notice --> Undefined variable: abids E:\wamp\www\newMis\newMis\common\services\Order_service.php 488
ERROR - 2018-09-25 12:11:26 --> Severity: Warning --> Invalid argument supplied for foreach() E:\wamp\www\newMis\newMis\common\services\Order_service.php 488
ERROR - 2018-09-25 12:19:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND o.prestatus_time <= 86400
GROUP BY o.order_code 
ORDER BY o.prestatus_time' at line 11 - Invalid query: SELECT o.is_bath,o.id as code_id,o.prestatus_time,o.user_id,u.nickname,u.mobile,o.service_number,o.iusetime
,GROUP_CONCAT(DISTINCT s.srid) AS sid_room
,o.order_code,o.`status`
FROM `s_order` AS o 
LEFT JOIN o2o_users as u ON u.uid = o.user_id 
LEFT JOIN s_order_adviser AS b ON b.order_code = o.order_code 
LEFT JOIN o2o_store_rtime as s ON s.oid = o.order_code
WHERE o.type = 8601 
and  b.adviser_id = '4fa741ce_92ec_cd06_69f2_5ac1d3c7f1b6'
AND o.prestatus_time >= 
AND o.prestatus_time <= 86400
GROUP BY o.order_code 
ORDER BY o.prestatus_time DESC
ERROR - 2018-09-25 12:19:30 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND o.prestatus_time <= 86400
GROUP BY o.order_code 
ORDER BY o.prestatus_time' at line 11 - Invalid query: SELECT o.is_bath,o.id as code_id,o.prestatus_time,o.user_id,u.nickname,u.mobile,o.service_number,o.iusetime
,GROUP_CONCAT(DISTINCT s.srid) AS sid_room
,o.order_code,o.`status`
FROM `s_order` AS o 
LEFT JOIN o2o_users as u ON u.uid = o.user_id 
LEFT JOIN s_order_adviser AS b ON b.order_code = o.order_code 
LEFT JOIN o2o_store_rtime as s ON s.oid = o.order_code
WHERE o.type = 8601 
and  b.adviser_id = '4fa741ce_92ec_cd06_69f2_5ac1d3c7f1b6'
AND o.prestatus_time >= 
AND o.prestatus_time <= 86400
GROUP BY o.order_code 
ORDER BY o.prestatus_time DESC
ERROR - 2018-09-25 12:19:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND o.prestatus_time <= 86400
GROUP BY o.order_code 
ORDER BY o.prestatus_time' at line 11 - Invalid query: SELECT o.is_bath,o.id as code_id,o.prestatus_time,o.user_id,u.nickname,u.mobile,o.service_number,o.iusetime
,GROUP_CONCAT(DISTINCT s.srid) AS sid_room
,o.order_code,o.`status`
FROM `s_order` AS o 
LEFT JOIN o2o_users as u ON u.uid = o.user_id 
LEFT JOIN s_order_adviser AS b ON b.order_code = o.order_code 
LEFT JOIN o2o_store_rtime as s ON s.oid = o.order_code
WHERE o.type = 8601 
and  b.adviser_id = '4fa741ce_92ec_cd06_69f2_5ac1d3c7f1b6'
AND o.prestatus_time >= 
AND o.prestatus_time <= 86400
GROUP BY o.order_code 
ORDER BY o.prestatus_time DESC
ERROR - 2018-09-25 12:19:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND o.prestatus_time <= 86400
GROUP BY o.order_code 
ORDER BY o.prestatus_time' at line 11 - Invalid query: SELECT o.is_bath,o.id as code_id,o.prestatus_time,o.user_id,u.nickname,u.mobile,o.service_number,o.iusetime
,GROUP_CONCAT(DISTINCT s.srid) AS sid_room
,o.order_code,o.`status`
FROM `s_order` AS o 
LEFT JOIN o2o_users as u ON u.uid = o.user_id 
LEFT JOIN s_order_adviser AS b ON b.order_code = o.order_code 
LEFT JOIN o2o_store_rtime as s ON s.oid = o.order_code
WHERE o.type = 8601 
and  b.adviser_id = '4fa741ce_92ec_cd06_69f2_5ac1d3c7f1b6'
AND o.prestatus_time >= 
AND o.prestatus_time <= 86400
GROUP BY o.order_code 
ORDER BY o.prestatus_time DESC
ERROR - 2018-09-25 12:19:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND o.prestatus_time <= 86400
GROUP BY o.order_code 
ORDER BY o.prestatus_time' at line 11 - Invalid query: SELECT o.is_bath,o.id as code_id,o.prestatus_time,o.user_id,u.nickname,u.mobile,o.service_number,o.iusetime
,GROUP_CONCAT(DISTINCT s.srid) AS sid_room
,o.order_code,o.`status`
FROM `s_order` AS o 
LEFT JOIN o2o_users as u ON u.uid = o.user_id 
LEFT JOIN s_order_adviser AS b ON b.order_code = o.order_code 
LEFT JOIN o2o_store_rtime as s ON s.oid = o.order_code
WHERE o.type = 8601 
and  b.adviser_id = '4fa741ce_92ec_cd06_69f2_5ac1d3c7f1b6'
AND o.prestatus_time >= 
AND o.prestatus_time <= 86400
GROUP BY o.order_code 
ORDER BY o.prestatus_time DESC
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> date() expects parameter 2 to be long, string given E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:44 --> Severity: Warning --> date() expects parameter 2 to be long, string given E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> date() expects parameter 2 to be long, string given E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> date() expects parameter 2 to be long, string given E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> date() expects parameter 2 to be long, string given E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> date() expects parameter 2 to be long, string given E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 450
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sid_room' E:\wamp\www\newMis\newMis\common\services\Order_service.php 480
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 490
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'code_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 491
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 492
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'prestatus_time' E:\wamp\www\newMis\newMis\common\services\Order_service.php 493
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'order_code' E:\wamp\www\newMis\newMis\common\services\Order_service.php 494
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'status' E:\wamp\www\newMis\newMis\common\services\Order_service.php 495
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'sex' E:\wamp\www\newMis\newMis\common\services\Order_service.php 496
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'iusetime' E:\wamp\www\newMis\newMis\common\services\Order_service.php 497
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'nickname' E:\wamp\www\newMis\newMis\common\services\Order_service.php 499
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'user_id' E:\wamp\www\newMis\newMis\common\services\Order_service.php 500
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'mobile' E:\wamp\www\newMis\newMis\common\services\Order_service.php 501
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'is_bath' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Warning --> Illegal string offset 'service_number' E:\wamp\www\newMis\newMis\common\services\Order_service.php 502
ERROR - 2018-09-25 12:38:45 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\bespeakorder\bespeakinfo.php 70
ERROR - 2018-09-25 12:38:45 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\bespeakorder\bespeakinfo.php 74
ERROR - 2018-09-25 12:39:13 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 483
ERROR - 2018-09-25 12:39:13 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 484
ERROR - 2018-09-25 12:39:13 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\bespeakorder\bespeakinfo.php 70
ERROR - 2018-09-25 12:39:13 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\bespeakorder\bespeakinfo.php 74
ERROR - 2018-09-25 12:41:50 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\bespeakorder\bespeakinfo.php 70
ERROR - 2018-09-25 12:41:50 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\bespeakorder\bespeakinfo.php 74
ERROR - 2018-09-25 12:43:30 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\bespeakorder\bespeakinfo.php 70
ERROR - 2018-09-25 12:43:30 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\bespeakorder\bespeakinfo.php 74
ERROR - 2018-09-25 12:44:15 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\bespeakorder\bespeakinfo.php 70
ERROR - 2018-09-25 12:44:15 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\bespeakorder\bespeakinfo.php 74
ERROR - 2018-09-25 13:11:19 --> Severity: Warning --> mysqli::real_connect():  E:\wamp\www\newMis\newMis\framework\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2018-09-25 13:11:19 --> Unable to connect to the database
ERROR - 2018-09-25 14:32:50 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): ip not in whitelist or in blacklist, client ip is 221.217.167.54 E:\wamp\www\newMis\newMis\framework\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2018-09-25 14:32:50 --> Unable to connect to the database
ERROR - 2018-09-25 14:33:23 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): ip not in whitelist or in blacklist, client ip is 221.217.167.54 E:\wamp\www\newMis\newMis\framework\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2018-09-25 14:33:23 --> Unable to connect to the database
ERROR - 2018-09-25 14:34:08 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): ip not in whitelist or in blacklist, client ip is 221.217.167.54 E:\wamp\www\newMis\newMis\framework\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2018-09-25 14:34:08 --> Unable to connect to the database
ERROR - 2018-09-25 14:34:12 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): ip not in whitelist or in blacklist, client ip is 221.217.167.54 E:\wamp\www\newMis\newMis\framework\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2018-09-25 14:34:12 --> Unable to connect to the database
ERROR - 2018-09-25 14:34:16 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): ip not in whitelist or in blacklist, client ip is 221.217.167.54 E:\wamp\www\newMis\newMis\framework\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2018-09-25 14:34:16 --> Unable to connect to the database
ERROR - 2018-09-25 14:38:57 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): ip not in whitelist or in blacklist, client ip is 221.217.167.54 E:\wamp\www\newMis\newMis\framework\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2018-09-25 14:38:57 --> Unable to connect to the database
ERROR - 2018-09-25 14:40:31 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): ip not in whitelist or in blacklist, client ip is 221.217.167.54 E:\wamp\www\newMis\newMis\framework\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2018-09-25 14:40:31 --> Unable to connect to the database
ERROR - 2018-09-25 14:53:19 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): ip not in whitelist or in blacklist, client ip is 221.217.167.54 E:\wamp\www\newMis\newMis\framework\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2018-09-25 14:53:19 --> Unable to connect to the database
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: data E:\wamp\www\newMis\newMis\common\services\Order_service.php 726
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 105
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 109
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 113
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 117
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 121
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 125
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 129
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_adviser E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 133
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_beautician E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 137
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 141
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 145
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 149
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 155
ERROR - 2018-09-25 15:14:15 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 193
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 105
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 109
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 113
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 117
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 121
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 125
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 129
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_adviser E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 133
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_beautician E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 137
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 141
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 145
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 149
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 155
ERROR - 2018-09-25 15:15:33 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 193
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 105
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 109
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 113
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 117
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 121
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 125
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 129
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_adviser E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 133
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_beautician E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 137
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 141
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 145
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 149
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 155
ERROR - 2018-09-25 15:16:40 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 193
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 105
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 109
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 113
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 117
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 121
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 125
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 129
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_adviser E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 133
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_beautician E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 137
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 141
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 145
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 149
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 155
ERROR - 2018-09-25 15:17:10 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 193
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 105
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 109
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 113
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 117
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 121
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 125
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 129
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_adviser E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 133
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_beautician E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 137
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 141
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 145
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 149
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 155
ERROR - 2018-09-25 15:17:14 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 193
ERROR - 2018-09-25 15:22:52 --> Severity: Notice --> Undefined variable: data E:\wamp\www\newMis\newMis\common\services\Order_service.php 726
ERROR - 2018-09-25 15:42:00 --> Severity: Notice --> Undefined property: orderlist::$Usercharge_model E:\wamp\www\newMis\newMis\htdocs_shop\core\MY_Service.php 12
ERROR - 2018-09-25 15:42:00 --> Severity: Error --> Call to a member function getOrderPlay() on a non-object E:\wamp\www\newMis\newMis\common\services\Order_service.php 727
ERROR - 2018-09-25 15:42:22 --> Severity: Error --> Call to undefined method Order_model::getOrderPlay() E:\wamp\www\newMis\newMis\common\services\Order_service.php 727
ERROR - 2018-09-25 15:43:45 --> Severity: Error --> Call to undefined method Order_service::orderPlayHandle() E:\wamp\www\newMis\newMis\common\services\Order_service.php 728
ERROR - 2018-09-25 15:50:07 --> Severity: Notice --> Undefined index: exclusive_aid E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 129
ERROR - 2018-09-25 15:50:07 --> Severity: Notice --> Undefined variable: order_adviser E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 133
ERROR - 2018-09-25 15:50:07 --> Severity: Notice --> Undefined variable: order_beautician E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 137
ERROR - 2018-09-25 15:50:07 --> Severity: Notice --> Undefined index: ucard_no E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 145
ERROR - 2018-09-25 16:01:57 --> Severity: Notice --> Undefined index: exclusive_aid E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 129
ERROR - 2018-09-25 16:01:57 --> Severity: Notice --> Undefined index: ucard_no E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 145
ERROR - 2018-09-25 16:01:57 --> Severity: Notice --> Undefined index: cardname E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 16:01:57 --> Severity: Notice --> Undefined index: accounts E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 16:01:57 --> Severity: Notice --> Undefined index: money_true_true E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 193
ERROR - 2018-09-25 16:05:01 --> Severity: Notice --> Undefined index: ucard_no E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 145
ERROR - 2018-09-25 16:05:01 --> Severity: Notice --> Undefined index: cardname E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 16:05:01 --> Severity: Notice --> Undefined index: accounts E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 16:05:01 --> Severity: Notice --> Undefined index: money_true_true E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 193
ERROR - 2018-09-25 16:06:00 --> Severity: Notice --> Undefined index: cardname E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 16:06:00 --> Severity: Notice --> Undefined index: accounts E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 16:06:00 --> Severity: Notice --> Undefined index: money_true_true E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 193
ERROR - 2018-09-25 16:06:19 --> Severity: Notice --> Undefined index: cardname E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 16:06:19 --> Severity: Notice --> Undefined index: accounts E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 154
ERROR - 2018-09-25 16:06:19 --> Severity: Notice --> Undefined index: money_true_true E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 193
ERROR - 2018-09-25 16:10:32 --> Severity: Notice --> Undefined index: money_true_true E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 196
ERROR - 2018-09-25 16:20:21 --> Severity: Notice --> Undefined index: money_true_true E:\wamp\www\newMis\newMis\common\services\Order_service.php 724
ERROR - 2018-09-25 17:16:42 --> Severity: Notice --> Undefined index: userid E:\wamp\www\newMis\newMis\common\services\User_service.php 189
ERROR - 2018-09-25 17:19:34 --> Severity: Notice --> Undefined index: userid E:\wamp\www\newMis\newMis\common\services\User_service.php 189
ERROR - 2018-09-25 17:27:57 --> Severity: Notice --> Undefined index: msg E:\wamp\www\newMis\newMis\htdocs_shop\hooks\LoginAuth.php 38
ERROR - 2018-09-25 17:28:08 --> Severity: Notice --> Undefined index: userid E:\wamp\www\newMis\newMis\common\services\User_service.php 189
ERROR - 2018-09-25 17:31:45 --> Severity: Notice --> Undefined index: userid E:\wamp\www\newMis\newMis\common\services\User_service.php 190
ERROR - 2018-09-25 17:38:10 --> Severity: Warning --> mysqli::real_connect():  E:\wamp\www\newMis\newMis\framework\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2018-09-25 17:38:10 --> Unable to connect to the database
ERROR - 2018-09-25 18:51:43 --> Severity: Notice --> Undefined property: LoginAuth::$load E:\wamp\www\newMis\newMis\htdocs_shop\hooks\LoginAuth.php 44
ERROR - 2018-09-25 18:51:43 --> Severity: Error --> Call to a member function helper() on a non-object E:\wamp\www\newMis\newMis\htdocs_shop\hooks\LoginAuth.php 44
ERROR - 2018-09-25 19:14:38 --> Severity: Parsing Error --> syntax error, unexpected ')' E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Login.php 24
ERROR - 2018-09-25 19:14:59 --> Severity: Parsing Error --> syntax error, unexpected ')' E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Login.php 24
ERROR - 2018-09-25 19:15:00 --> Severity: Parsing Error --> syntax error, unexpected ')' E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Login.php 24
ERROR - 2018-09-25 19:19:41 --> Severity: Parsing Error --> syntax error, unexpected ')' E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Login.php 24
ERROR - 2018-09-25 19:22:23 --> Severity: Notice --> Undefined index: iduu E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 15
ERROR - 2018-09-25 19:22:49 --> Severity: Notice --> Undefined index: iduu E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Bespeakorder.php 30
ERROR - 2018-09-25 19:24:14 --> Severity: Notice --> Undefined index: iduu E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Bespeakorder.php 30
ERROR - 2018-09-25 19:24:38 --> Severity: Notice --> Undefined index: iduu E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Bespeakorder.php 30
ERROR - 2018-09-25 19:25:21 --> Severity: Notice --> Undefined index: iduu E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Bespeakorder.php 30
ERROR - 2018-09-25 19:25:32 --> Severity: Notice --> Undefined index: iduu E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 15
ERROR - 2018-09-25 19:26:05 --> Severity: Notice --> Undefined index: iduu E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 15
