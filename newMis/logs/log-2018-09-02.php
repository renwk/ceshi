<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-02 02:45:13 --> Severity: Notice --> Undefined index: bid E:\wamp\www\newMis\newMis\common\services\User_service.php 283
ERROR - 2018-09-02 02:45:13 --> Query error: Erreur de syntaxe près de ')
  AND u.`status` = '1'
	AND s.`prestatus_time` >'1535760000'
GROUP BY confi' à la ligne 10 - Invalid query: select u.oid,u.bid,u.`position`
, sum(u.waterMoney) as waterMoney, sum(u.pMoney) as pMoney
,u.`time`, u.`type` ,u.`status`
,sum(o.reception) as reception
,s.`type` as config_type,
if(u.position = 1 ,(SELECT nickname FROM s_employees_manage as m WHERE m.id = u.bid),(SELECT nickname FROM o2o_beautician as b where b.bid = u.bid)) as nickname
	from s_ucard_order_performance as u
	LEFT JOIN s_order as s on u.oid = s.order_code
	left JOIN s_order_adviser as o on u.oid =o.order_code AND	u.bid = o.adviser_id
	where bid in ()
  AND u.`status` = '1'
	AND s.`prestatus_time` >'1535760000'
GROUP BY config_type
ERROR - 2018-09-02 02:45:22 --> Severity: Notice --> Undefined index: bid E:\wamp\www\newMis\newMis\common\services\User_service.php 283
ERROR - 2018-09-02 02:45:22 --> Query error: Erreur de syntaxe près de ')
  AND u.`status` = '1'
	AND s.`prestatus_time` >'1535760000'
GROUP BY confi' à la ligne 10 - Invalid query: select u.oid,u.bid,u.`position`
, sum(u.waterMoney) as waterMoney, sum(u.pMoney) as pMoney
,u.`time`, u.`type` ,u.`status`
,sum(o.reception) as reception
,s.`type` as config_type,
if(u.position = 1 ,(SELECT nickname FROM s_employees_manage as m WHERE m.id = u.bid),(SELECT nickname FROM o2o_beautician as b where b.bid = u.bid)) as nickname
	from s_ucard_order_performance as u
	LEFT JOIN s_order as s on u.oid = s.order_code
	left JOIN s_order_adviser as o on u.oid =o.order_code AND	u.bid = o.adviser_id
	where bid in ()
  AND u.`status` = '1'
	AND s.`prestatus_time` >'1535760000'
GROUP BY config_type
ERROR - 2018-09-02 02:46:59 --> Severity: Notice --> Undefined index: bid E:\wamp\www\newMis\newMis\common\services\User_service.php 283
ERROR - 2018-09-02 02:46:59 --> Severity: Notice --> Undefined variable: userinfo E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 108
ERROR - 2018-09-02 02:48:40 --> Severity: Notice --> Undefined variable: userinfo E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 108
ERROR - 2018-09-02 02:49:34 --> Severity: Notice --> Undefined variable: userinfo E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 108
ERROR - 2018-09-02 03:02:51 --> Severity: Notice --> Undefined variable: userinfo E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 108
ERROR - 2018-09-02 20:18:57 --> Severity: error --> Exception: Unable to locate the model you have specified: S_employees_manage E:\wamp\www\newMis\newMis\htdocs_shop\core\MY_Loader.php 352
ERROR - 2018-09-02 20:23:44 --> Severity: Compile Error --> Cannot redeclare Employees_manage_model::getConsultant() E:\wamp\www\newMis\newMis\common\models\Employees_manage_model.php 82
ERROR - 2018-09-02 20:24:18 --> Query error: Erreur de syntaxe près de 'IN(1)
AND `a`.`position` = 1
GROUP BY `id`' à la ligne 6 - Invalid query: SELECT `a`.`id`, `a`.`nickname`, `a`.`position`, `b`.`sname`
FROM `s_employees_manage` as `a`
LEFT JOIN `o2o_store` as `b` ON `b`.`sid` = `a`.`sid`
WHERE (`a`.`quit_time` >= '1535760000' OR `a`.`quit_time` IS NULL OR `a`.`quit_time` =0)
AND `a`.`sid` IN('d9b8ae67_f901_95c4_e020_ffa444e101de')
AND `a`.`status` = IN(1)
AND `a`.`position` = 1
GROUP BY `id`
ERROR - 2018-09-02 21:03:19 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 156
ERROR - 2018-09-02 21:04:22 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 153
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:05 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:19:06 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 21
ERROR - 2018-09-02 21:45:57 --> Query error: Champ 's.brand' inconnu dans where clause - Invalid query: SELECT `a`.`id`, `a`.`nickname`, `a`.`position`, `b`.`sname`
FROM `s_employees_manage` as `a`
LEFT JOIN `o2o_store` as `b` ON `b`.`sid` = `a`.`sid`
WHERE (`a`.`quit_time` >= '1535760000' OR `a`.`quit_time` IS NULL OR `a`.`quit_time` =0)
AND `a`.`status` = 1
AND `s`.`brand` = 'ispa'
GROUP BY `id`
ERROR - 2018-09-02 22:14:17 --> Severity: Warning --> array_multisort(): Argument #1 is expected to be an array or a sort flag E:\wamp\www\newMis\newMis\common\services\Performance_service.php 194
ERROR - 2018-09-02 22:14:23 --> Severity: Warning --> array_multisort(): Array sizes are inconsistent E:\wamp\www\newMis\newMis\common\services\Performance_service.php 194
ERROR - 2018-09-02 22:14:25 --> Severity: Warning --> array_multisort(): Array sizes are inconsistent E:\wamp\www\newMis\newMis\common\services\Performance_service.php 194
ERROR - 2018-09-02 22:18:30 --> Severity: Warning --> array_multisort(): Array sizes are inconsistent E:\wamp\www\newMis\newMis\common\services\Performance_service.php 198
ERROR - 2018-09-02 22:27:11 --> Severity: Notice --> Undefined index: sid E:\wamp\www\newMis\newMis\common\services\Performance_service.php 211
ERROR - 2018-09-02 22:27:11 --> Severity: Notice --> Undefined index: cardMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 215
ERROR - 2018-09-02 22:27:11 --> Severity: Notice --> Undefined index: sid E:\wamp\www\newMis\newMis\common\services\Performance_service.php 211
ERROR - 2018-09-02 22:27:11 --> Severity: Notice --> Undefined index: cardMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 215
ERROR - 2018-09-02 22:27:11 --> Severity: Warning --> array_multisort(): Argument #1 is expected to be an array or a sort flag E:\wamp\www\newMis\newMis\common\services\Performance_service.php 218
ERROR - 2018-09-02 22:27:11 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\framework\core\Exceptions.php:272) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-02 22:27:11 --> Severity: Error --> Call to undefined method Performance_service::sortsMoney() E:\wamp\www\newMis\newMis\common\services\Performance_service.php 29
ERROR - 2018-09-02 22:27:24 --> Severity: Notice --> Undefined index: sid E:\wamp\www\newMis\newMis\common\services\Performance_service.php 211
ERROR - 2018-09-02 22:27:24 --> Severity: Notice --> Undefined index: cardMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 215
ERROR - 2018-09-02 22:27:24 --> Severity: Notice --> Undefined index: sid E:\wamp\www\newMis\newMis\common\services\Performance_service.php 211
ERROR - 2018-09-02 22:27:24 --> Severity: Notice --> Undefined index: cardMoney E:\wamp\www\newMis\newMis\common\services\Performance_service.php 215
ERROR - 2018-09-02 22:27:24 --> Severity: Warning --> array_multisort(): Argument #1 is expected to be an array or a sort flag E:\wamp\www\newMis\newMis\common\services\Performance_service.php 218
ERROR - 2018-09-02 22:27:24 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\framework\core\Exceptions.php:272) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-02 22:27:24 --> Severity: Error --> Call to undefined method Performance_service::sortsMoney() E:\wamp\www\newMis\newMis\common\services\Performance_service.php 29
ERROR - 2018-09-02 22:28:53 --> Severity: Error --> Call to undefined method Performance_service::sortsMoney() E:\wamp\www\newMis\newMis\common\services\Performance_service.php 29
ERROR - 2018-09-02 22:54:51 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\services\Performance_service.php:31) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-02 22:54:51 --> Severity: Error --> Call to undefined method Performance_service::sortlMoney() E:\wamp\www\newMis\newMis\common\services\Performance_service.php 31
ERROR - 2018-09-02 22:55:14 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\services\Performance_service.php:31) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-02 22:55:14 --> Severity: Error --> Call to undefined method Performance_service::sortlMoney() E:\wamp\www\newMis\newMis\common\services\Performance_service.php 31
ERROR - 2018-09-02 22:55:49 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\services\Performance_service.php:32) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-02 22:55:49 --> Severity: Error --> Call to undefined method Performance_service::sortposition() E:\wamp\www\newMis\newMis\common\services\Performance_service.php 32
ERROR - 2018-09-02 22:57:06 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 125
ERROR - 2018-09-02 22:57:06 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 131
ERROR - 2018-09-02 22:57:06 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 137
ERROR - 2018-09-02 22:57:06 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 143
ERROR - 2018-09-02 22:57:06 --> Severity: Notice --> Undefined index: reception E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 149
ERROR - 2018-09-02 22:58:40 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 125
ERROR - 2018-09-02 22:58:40 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 131
ERROR - 2018-09-02 22:58:40 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 137
ERROR - 2018-09-02 22:58:40 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 143
ERROR - 2018-09-02 22:58:40 --> Severity: Notice --> Undefined index: reception E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 149
ERROR - 2018-09-02 22:59:24 --> Severity: Notice --> Undefined index: waterMoney E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 125
ERROR - 2018-09-02 22:59:24 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 131
ERROR - 2018-09-02 22:59:24 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 137
ERROR - 2018-09-02 22:59:24 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 143
ERROR - 2018-09-02 22:59:24 --> Severity: Notice --> Undefined index: reception E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 149
ERROR - 2018-09-02 22:59:46 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 131
ERROR - 2018-09-02 22:59:46 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 137
ERROR - 2018-09-02 22:59:46 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 143
ERROR - 2018-09-02 22:59:46 --> Severity: Notice --> Undefined index: reception E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 149
ERROR - 2018-09-02 23:02:08 --> Severity: Notice --> Undefined index: reception E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 149
ERROR - 2018-09-02 23:03:45 --> Severity: Notice --> Undefined index: reception E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 149
ERROR - 2018-09-02 23:03:45 --> Severity: Notice --> Undefined index: reception E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 150
ERROR - 2018-09-02 23:03:45 --> Severity: Notice --> Undefined index: reception E:\wamp\www\newMis\newMis\htdocs_shop\views\index\index.php 151
ERROR - 2018-09-02 23:05:00 --> 404 Page Not Found: Index/info
ERROR - 2018-09-02 23:22:30 --> Severity: Warning --> Missing argument 3 for Beautician_model::getBeauticianBasics(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 37 and defined E:\wamp\www\newMis\newMis\common\models\Beautician_model.php 47
ERROR - 2018-09-02 23:52:10 --> Query error: Champ '57d45d4c_6280_9387_fc69_81674193a5e3' inconnu dans where clause - Invalid query: SELECT
                d.nickname,a.order_code,d.bid,a.level,COUNT(DISTINCT a.level) as levlNum,
                -- 排钟时长
                SUM(DISTINCT a.compane_time) AS rowTime,
                -- 点钟时长
                SUM(DISTINCT IF(a.service_type = 1,(a.clock_time),0)) AS spotTime,
                --    加钟时长
                a.add_bell_time,
                -- 升级加钟时长
             a.upgrade_bell_time
        FROM
                 s_order_beautician AS a
        LEFT JOIN s_order AS b ON b.order_code = a.order_code
        LEFT JOIN s_order_detail AS c ON c.order_code = a.order_code
        LEFT JOIN o2o_beautician AS d ON d.beauticianid = a.bid
        WHERE b.status = 8105 AND b.paytype = 8002 AND b.type in (8602,8604,8605,8606) 
         AND b.prestatus_time > '1535760000'  AND d.bid in (57d45d4c_6280_9387_fc69_81674193a5e3) GROUP BY a.level,d.nickname,b.order_code ORDER BY b.prestatus_time DESC
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Notice --> Undefined index: rowTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 68
ERROR - 2018-09-02 23:54:27 --> Severity: Notice --> Undefined index: spotTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 69
ERROR - 2018-09-02 23:54:27 --> Severity: Notice --> Undefined index: bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 70
ERROR - 2018-09-02 23:54:27 --> Severity: Notice --> Undefined index: add_bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 71
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Notice --> Undefined index: rowTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 68
ERROR - 2018-09-02 23:54:27 --> Severity: Notice --> Undefined index: spotTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 69
ERROR - 2018-09-02 23:54:27 --> Severity: Notice --> Undefined index: bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 70
ERROR - 2018-09-02 23:54:27 --> Severity: Notice --> Undefined index: add_bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 71
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:27 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:28 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:28 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:28 --> Severity: Notice --> Undefined index: rowTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 68
ERROR - 2018-09-02 23:54:28 --> Severity: Notice --> Undefined index: spotTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 69
ERROR - 2018-09-02 23:54:28 --> Severity: Notice --> Undefined index: bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 70
ERROR - 2018-09-02 23:54:28 --> Severity: Notice --> Undefined index: add_bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 71
ERROR - 2018-09-02 23:54:28 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:28 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:54:28 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Notice --> Undefined index: rowTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 68
ERROR - 2018-09-02 23:56:06 --> Severity: Notice --> Undefined index: spotTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 69
ERROR - 2018-09-02 23:56:06 --> Severity: Notice --> Undefined index: bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 70
ERROR - 2018-09-02 23:56:06 --> Severity: Notice --> Undefined index: add_bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 71
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Notice --> Undefined index: rowTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 68
ERROR - 2018-09-02 23:56:06 --> Severity: Notice --> Undefined index: spotTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 69
ERROR - 2018-09-02 23:56:06 --> Severity: Notice --> Undefined index: bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 70
ERROR - 2018-09-02 23:56:06 --> Severity: Notice --> Undefined index: add_bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 71
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Notice --> Undefined index: rowTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 68
ERROR - 2018-09-02 23:56:06 --> Severity: Notice --> Undefined index: spotTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 69
ERROR - 2018-09-02 23:56:06 --> Severity: Notice --> Undefined index: bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 70
ERROR - 2018-09-02 23:56:06 --> Severity: Notice --> Undefined index: add_bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 71
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:06 --> Severity: Warning --> Missing argument 4 for Performance_service::cardInfo(), called in E:\wamp\www\newMis\newMis\common\services\Performance_service.php on line 44 and defined E:\wamp\www\newMis\newMis\common\services\Performance_service.php 146
ERROR - 2018-09-02 23:56:15 --> Severity: Notice --> Undefined index: rowTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 68
ERROR - 2018-09-02 23:56:15 --> Severity: Notice --> Undefined index: spotTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 69
ERROR - 2018-09-02 23:56:15 --> Severity: Notice --> Undefined index: bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 70
ERROR - 2018-09-02 23:56:15 --> Severity: Notice --> Undefined index: add_bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 71
ERROR - 2018-09-02 23:56:15 --> Severity: Notice --> Undefined index: rowTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 68
ERROR - 2018-09-02 23:56:15 --> Severity: Notice --> Undefined index: spotTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 69
ERROR - 2018-09-02 23:56:15 --> Severity: Notice --> Undefined index: bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 70
ERROR - 2018-09-02 23:56:15 --> Severity: Notice --> Undefined index: add_bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 71
ERROR - 2018-09-02 23:56:16 --> Severity: Notice --> Undefined index: rowTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 68
ERROR - 2018-09-02 23:56:16 --> Severity: Notice --> Undefined index: spotTime E:\wamp\www\newMis\newMis\common\services\Performance_service.php 69
ERROR - 2018-09-02 23:56:16 --> Severity: Notice --> Undefined index: bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 70
ERROR - 2018-09-02 23:56:16 --> Severity: Notice --> Undefined index: add_bell_time E:\wamp\www\newMis\newMis\common\services\Performance_service.php 71
