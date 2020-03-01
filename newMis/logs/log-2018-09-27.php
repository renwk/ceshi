<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-27 13:59:16 --> Severity: Notice --> Undefined property: Index::$beautician_model E:\wamp\www\newMis\newMis\htdocs_shop\core\MY_Service.php 12
ERROR - 2018-09-27 13:59:16 --> Severity: Error --> Call to a member function performanceSumTime() on a non-object E:\wamp\www\newMis\newMis\common\services\Performance_service.php 57
ERROR - 2018-09-27 13:59:46 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\common\models\Beautician_model.php 200
ERROR - 2018-09-27 13:59:47 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT COUNT(*)+1 FROM 
(SELECT A.`bid` ,sum(A.`compane_time`+A.`clock_time` +A.`add_bell_time` +A.`add_bell_reward_time` +A.`upgrade_bell_time` ) as K   FROM `s_order_beautician` A 
LEFT JOIN `s_order` B ON A.`order_code` =B.`order_code` 
WHERE B.`prestatus_time` > '1538006400'  AND B.`store_id`='bcc671f7_e54b_5578_92c8_022a586a9ed7'  AND B.`type` IN ('8602','8604','8606','8606') AND B.`status` =8105  GROUP BY A.`bid`) as M WHERE M.K>Array
ERROR - 2018-09-27 14:17:07 --> Severity: Parsing Error --> syntax error, unexpected '=' E:\wamp\www\newMis\newMis\common\services\Performance_service.php 57
ERROR - 2018-09-27 14:18:07 --> Severity: Notice --> Undefined variable: sortperformance E:\wamp\www\newMis\newMis\common\services\Performance_service.php 58
ERROR - 2018-09-27 14:18:07 --> Query error: Erreur de syntaxe près de '' à la ligne 4 - Invalid query: SELECT COUNT(*)+1 as sort FROM 
(SELECT A.`bid` ,sum(A.`compane_time`+A.`clock_time` +A.`add_bell_time` +A.`add_bell_reward_time` +A.`upgrade_bell_time` ) as K   FROM `s_order_beautician` A 
LEFT JOIN `s_order` B ON A.`order_code` =B.`order_code` 
WHERE B.`prestatus_time` > '1537833600'  AND B.`store_id`='d9b8ae67_f901_95c4_e020_ffa444e101de'  AND B.`type` IN ('8602','8604','8606','8606') AND B.`status` =8105  GROUP BY A.`bid`) as M WHERE M.K>
ERROR - 2018-09-27 15:07:07 --> Severity: Parsing Error --> syntax error, unexpected '+', expecting '}' E:\wamp\www\newMis\newMis\common\models\Beautician_model.php 217
ERROR - 2018-09-27 15:14:16 --> Severity: Warning --> Missing argument 5 for Beautician_model::performancelMoneyStore(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 62 and defined E:\wamp\www\newMis\newMis\common\models\Beautician_model.php 224
ERROR - 2018-09-27 15:14:16 --> Severity: Notice --> Undefined variable: type1 E:\wamp\www\newMis\newMis\common\models\Beautician_model.php 230
ERROR - 2018-09-27 15:14:16 --> Query error: Erreur de syntaxe près de ') and time >'1537920000' GROUP BY b.bid,p.type
) as s  GROUP BY bid
) as p whe' à la ligne 6 - Invalid query: SELECT COUNT(*)+1 as store FROM (
select bid,SUM(pMoney) as M from
(SELECT b.bid,if(p.type=1,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN o2o_beautician as b on p.bid = b.bid
where b.sid = 'd9b8ae67_f901_95c4_e020_ffa444e101de' and p.type in () and time >'1537920000' GROUP BY b.bid,p.type
) as s  GROUP BY bid
) as p where p.M > 
ERROR - 2018-09-27 15:15:09 --> Query error: Erreur de syntaxe près de '' à la ligne 8 - Invalid query: SELECT COUNT(*)+1 as store FROM (
select bid,SUM(pMoney) as M from
(SELECT b.bid,if(p.type=5,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN o2o_beautician as b on p.bid = b.bid
where b.sid = 'd9b8ae67_f901_95c4_e020_ffa444e101de' and p.type in (5,6) and time >'1537920000' GROUP BY b.bid,p.type
) as s  GROUP BY bid
) as p where p.M > 
ERROR - 2018-09-27 15:17:37 --> Query error: Erreur de syntaxe près de '' à la ligne 8 - Invalid query: SELECT COUNT(*)+1 as store FROM (
select bid,SUM(pMoney) as M from
(SELECT b.bid,if(p.type=5,sum(pMoney),-SUM(pMoney)) as pMoney
FROM s_ucard_order_performance as p
LEFT JOIN o2o_beautician as b on p.bid = b.bid
where b.sid = 'd9b8ae67_f901_95c4_e020_ffa444e101de' and p.type in (5,6) and time >'1537920000' GROUP BY b.bid,p.type
) as s  GROUP BY bid
) as p where p.M > 
ERROR - 2018-09-27 15:20:58 --> Severity: Notice --> Undefined index: card E:\wamp\www\newMis\newMis\common\services\Performance_service.php 81
ERROR - 2018-09-27 15:25:25 --> Severity: Notice --> Undefined index: SumTime E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 84
ERROR - 2018-09-27 15:25:25 --> Severity: Notice --> Undefined index: SumTime E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 85
ERROR - 2018-09-27 15:25:25 --> Severity: Notice --> Undefined index: SumTime E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 86
ERROR - 2018-09-27 17:19:52 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 63
ERROR - 2018-09-27 17:19:52 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 64
ERROR - 2018-09-27 17:19:52 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 65
ERROR - 2018-09-27 17:19:52 --> Severity: Notice --> Undefined index: sMoney E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 67
ERROR - 2018-09-27 17:19:52 --> Severity: Notice --> Undefined index: sMoney E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 68
ERROR - 2018-09-27 17:19:52 --> Severity: Notice --> Undefined index: sMoney E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 69
ERROR - 2018-09-27 17:19:52 --> Severity: Notice --> Undefined index: lMoney E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 71
ERROR - 2018-09-27 17:19:52 --> Severity: Notice --> Undefined index: cardMoney E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 75
ERROR - 2018-09-27 17:19:52 --> Severity: Notice --> Undefined index: cardMoney E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 76
ERROR - 2018-09-27 17:19:52 --> Severity: Notice --> Undefined index: cardMoney E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 77
ERROR - 2018-09-27 17:19:52 --> Severity: Notice --> Undefined index: reception E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 79
ERROR - 2018-09-27 17:19:52 --> Severity: Notice --> Undefined index: reception E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 80
ERROR - 2018-09-27 17:19:52 --> Severity: Notice --> Undefined index: reception E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Index.php 81
ERROR - 2018-09-27 19:24:29 --> Severity: Notice --> Undefined variable: stime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 23
ERROR - 2018-09-27 19:24:29 --> Severity: Notice --> Undefined variable: stime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 24
