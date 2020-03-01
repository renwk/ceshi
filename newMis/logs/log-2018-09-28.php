<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-28 10:31:51 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\common\models\Employees_manage_model.php 213
ERROR - 2018-09-28 10:31:51 --> Query error: Champ 'Array' inconnu dans where clause - Invalid query: SELECT COUNT(*)+1 as store FROM (
select bid,SUM(pMoney) as M from
(SELECT b.bid,if(p.type=3,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN o2o_beautician as b on p.bid = b.bid
LEFT JOIN s_order as o on p.oid = o.order_code
where b.sid = 'd9b8ae67_f901_95c4_e020_ffa444e101de' and p.type in (3,4) AND p.`status`=1 and o.prestatus_time >'1538092800' GROUP BY b.bid,p.type
) as s  GROUP BY bid
) as p where p.M > Array
ERROR - 2018-09-28 12:28:49 --> Query error: Champ 'id' inconnu dans field list - Invalid query: SELECT COUNT(*)+1 as store FROM (
select id,SUM(pMoney) as M from
(SELECT b.bid,if(p.type=3,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN o2o_beautician as b on p.bid = b.bid
LEFT JOIN s_order as o on p.oid = o.order_code
where b.sid = 'd9b8ae67_f901_95c4_e020_ffa444e101de' and p.type in (3,4) AND p.`status`=1 and o.prestatus_time >'1538092800' GROUP BY b.bid,p.type
UNION ALL
SELECT b.id,if(p.type=3,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN s_employees_manage as b on p.bid = b.id
LEFT JOIN s_order_refund as o on p.oid = o.rid 
where b.sid = 'd9b8ae67_f901_95c4_e020_ffa444e101de' and p.type in (3,4) AND p.`status`=1 and o.create_time >'1538092800' GROUP BY b.id,p.type
) as s  GROUP BY s.id
) as p where p.M > 1099.50
ERROR - 2018-09-28 12:31:12 --> Query error: Champ 'id' inconnu dans field list - Invalid query: SELECT COUNT(*)+1 as store FROM (
select id,SUM(pMoney) as M from
(SELECT b.bid,if(p.type=3,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN o2o_beautician as b on p.bid = b.bid
LEFT JOIN s_order as o on p.oid = o.order_code
where b.sid = 'd9b8ae67_f901_95c4_e020_ffa444e101de' and p.type in (3,4) AND p.`status`=1 and o.prestatus_time >'1538092800' GROUP BY b.bid,p.type
UNION ALL
SELECT b.id,if(p.type=3,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN s_employees_manage as b on p.bid = b.id
LEFT JOIN s_order_refund as o on p.oid = o.rid 
where b.sid = 'd9b8ae67_f901_95c4_e020_ffa444e101de' and p.type in (3,4) AND p.`status`=1 and o.create_time >'1538092800' GROUP BY b.id,p.type
) as s  GROUP BY s.id
) as p where p.M > 1099.50
ERROR - 2018-09-28 12:31:28 --> Query error: Champ 'id' inconnu dans field list - Invalid query: SELECT COUNT(*)+1 as store FROM (
select id,SUM(pMoney) as M from
(SELECT b.bid,if(p.type=3,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN o2o_beautician as b on p.bid = b.bid
LEFT JOIN s_order as o on p.oid = o.order_code
where b.sid = 'd9b8ae67_f901_95c4_e020_ffa444e101de' and p.type in (3,4) AND p.`status`=1 and o.prestatus_time >'1538092800' GROUP BY b.bid,p.type
UNION ALL
SELECT b.id,if(p.type=3,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN s_employees_manage as b on p.bid = b.id
LEFT JOIN s_order_refund as o on p.oid = o.rid 
where b.sid = 'd9b8ae67_f901_95c4_e020_ffa444e101de' and p.type in (3,4) AND p.`status`=1 and o.create_time >'1538092800' GROUP BY b.id,p.type
) as s  GROUP BY s.id
) as p where p.M > 1099.50
ERROR - 2018-09-28 14:22:36 --> Severity: Notice --> Undefined index: brand E:\wamp\www\newMis\newMis\common\services\Performance_service.php 31
ERROR - 2018-09-28 14:26:35 --> Severity: Notice --> Undefined index: sort E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 80
ERROR - 2018-09-28 14:28:04 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 4 - Invalid query: SELECT COUNT(*)+1 as store FROM 
(SELECT A.`bid` ,sum(A.`compane_time`+A.`clock_time` +A.`add_bell_time` +A.`add_bell_reward_time` +A.`upgrade_bell_time` ) as K   FROM `s_order_beautician` A 
LEFT JOIN `s_order` B ON A.`order_code` =B.`order_code` 
WHERE B.`prestatus_time` > '1538092800'  AND B.`store_id`='bcc671f7_e54b_5578_92c8_022a586a9ed7'  AND B.`type` IN ('8602','8604','8606','8606') AND B.`status` =8105  GROUP BY A.`bid`) as M WHERE M.K>
ERROR - 2018-09-28 14:30:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 5 - Invalid query: SELECT COUNT(*)+1 as store FROM 
(SELECT A.`bid` ,sum(A.`compane_time`+A.`clock_time` +A.`add_bell_time` +A.`add_bell_reward_time` +A.`upgrade_bell_time` ) as K   FROM `s_order_beautician` A 
LEFT JOIN `s_order` B ON A.`order_code` =B.`order_code` 
WHERE B.`prestatus_time` > '1538092800'  AND B.`store_id`='bcc671f7_e54b_5578_92c8_022a586a9ed7'  AND B.`type` IN ('8602','8604','8606','8606') 
AND B.`status` =8105  GROUP BY A.`bid`) as M WHERE M.K>
ERROR - 2018-09-28 14:32:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 5 - Invalid query: SELECT COUNT(*)+1 as store FROM 
(SELECT A.`bid` ,sum(A.`compane_time`+A.`clock_time` +A.`add_bell_time` +A.`add_bell_reward_time` +A.`upgrade_bell_time` ) as K   FROM `s_order_beautician` A 
LEFT JOIN `s_order` B ON A.`order_code` =B.`order_code` 
WHERE B.`prestatus_time` > '1538092800'  AND B.`store_id`='bcc671f7_e54b_5578_92c8_022a586a9ed7'  AND B.`type` IN ('8602','8604','8606','8606') 
AND B.`status` =8105  GROUP BY A.`bid`) as M WHERE M.K>
ERROR - 2018-09-28 14:33:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 6 - Invalid query: SELECT COUNT(*)+1 as brand FROM 
(SELECT A.`bid` ,sum(A.`compane_time`+A.`clock_time` +A.`add_bell_time` +A.`add_bell_reward_time` +A.`upgrade_bell_time` ) as K   FROM `s_order_beautician` A 
LEFT JOIN `s_order` B ON A.`order_code` =B.`order_code` 
LEFT JOIN `o2o_store` C ON B.`store_id` =C.`sid` 
WHERE B.`prestatus_time` > '1538092800'  AND C.`brand` ='ispa' AND B.`type` IN ('8602','8604','8606','8606') 
AND B.`status` =8105  GROUP BY A.`bid` ) as M WHERE M.K>
ERROR - 2018-09-28 15:00:45 --> Severity: Notice --> Undefined index: openid E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 14
ERROR - 2018-09-28 15:00:57 --> Severity: Notice --> Undefined index: openid E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 14
ERROR - 2018-09-28 15:01:57 --> Severity: Notice --> Undefined index: openid E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 14
ERROR - 2018-09-28 15:03:53 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-09-28 15:04:52 --> Severity: Notice --> Undefined offset: 0 E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 88
ERROR - 2018-09-28 15:05:25 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\framework\database\DB_driver.php:654) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-28 15:05:25 --> Severity: Notice --> Undefined offset: 0 E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 88
ERROR - 2018-09-28 15:05:46 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\framework\database\DB_driver.php:654) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-28 15:06:08 --> Severity: Notice --> Undefined offset: 0 E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 88
ERROR - 2018-09-28 15:06:17 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\framework\database\DB_driver.php:654) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-28 15:09:11 --> Severity: Notice --> Undefined variable: cardInfo E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 92
ERROR - 2018-09-28 15:09:11 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 165
ERROR - 2018-09-28 15:09:11 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 169
ERROR - 2018-09-28 15:09:11 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 173
ERROR - 2018-09-28 15:09:11 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 177
ERROR - 2018-09-28 15:09:11 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 181
ERROR - 2018-09-28 15:09:11 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 185
ERROR - 2018-09-28 15:09:11 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 189
ERROR - 2018-09-28 15:14:29 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-09-28 17:18:01 --> Severity: Notice --> Undefined variable: wechat E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 106
ERROR - 2018-09-28 17:18:01 --> Severity: Notice --> Undefined variable: info E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 108
ERROR - 2018-09-28 17:18:01 --> Severity: Notice --> Undefined variable: info E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 115
ERROR - 2018-09-28 17:18:01 --> Severity: Notice --> Undefined variable: uid E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 116
ERROR - 2018-09-28 17:18:01 --> Severity: Notice --> Undefined variable: info E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 117
ERROR - 2018-09-28 17:18:01 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 118
ERROR - 2018-09-28 17:18:01 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 126
ERROR - 2018-09-28 17:18:01 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 126
ERROR - 2018-09-28 17:18:01 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 161
ERROR - 2018-09-28 17:18:01 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 186
ERROR - 2018-09-28 17:18:01 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 219
ERROR - 2018-09-28 17:18:01 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 236
ERROR - 2018-09-28 17:18:27 --> Severity: Notice --> Undefined variable: wechat E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 106
ERROR - 2018-09-28 17:18:27 --> Severity: Notice --> Undefined variable: info E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 108
ERROR - 2018-09-28 17:18:27 --> Severity: Notice --> Undefined variable: info E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 115
ERROR - 2018-09-28 17:18:27 --> Severity: Notice --> Undefined variable: uid E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 116
ERROR - 2018-09-28 17:18:27 --> Severity: Notice --> Undefined variable: info E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 117
ERROR - 2018-09-28 17:18:27 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 118
ERROR - 2018-09-28 17:18:27 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 126
ERROR - 2018-09-28 17:18:27 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 126
ERROR - 2018-09-28 17:18:27 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 161
ERROR - 2018-09-28 17:18:27 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 186
ERROR - 2018-09-28 17:18:27 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 219
ERROR - 2018-09-28 17:18:27 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 236
ERROR - 2018-09-28 17:18:36 --> Severity: Notice --> Undefined variable: wechat E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 106
ERROR - 2018-09-28 17:18:36 --> Severity: Notice --> Undefined variable: info E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 108
ERROR - 2018-09-28 17:18:36 --> Severity: Notice --> Undefined variable: info E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 115
ERROR - 2018-09-28 17:18:36 --> Severity: Notice --> Undefined variable: uid E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 116
ERROR - 2018-09-28 17:18:36 --> Severity: Notice --> Undefined variable: info E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 117
ERROR - 2018-09-28 17:18:36 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 118
ERROR - 2018-09-28 17:18:36 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 126
ERROR - 2018-09-28 17:18:36 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 126
ERROR - 2018-09-28 17:18:36 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 161
ERROR - 2018-09-28 17:18:36 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 186
ERROR - 2018-09-28 17:18:36 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 219
ERROR - 2018-09-28 17:18:36 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 236
ERROR - 2018-09-28 19:04:57 --> Severity: Notice --> Undefined variable: days E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Beauticiansort.php 94
ERROR - 2018-09-28 19:05:19 --> Severity: Notice --> Undefined variable: days E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Beauticiansort.php 94
