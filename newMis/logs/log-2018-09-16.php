<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-16 18:31:19 --> Severity: Notice --> Undefined index: status E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 118
ERROR - 2018-09-16 18:31:19 --> Severity: Notice --> Undefined index: time_pay E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 119
ERROR - 2018-09-16 21:56:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\helpers\common_helper.php:12) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-16 21:56:55 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\helpers\common_helper.php:12) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-16 21:56:56 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\helpers\common_helper.php:12) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-16 21:58:07 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\helpers\common_helper.php:12) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-16 21:58:32 --> Severity: Notice --> Undefined index: status E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 118
ERROR - 2018-09-16 21:58:32 --> Severity: Notice --> Undefined index: time_pay E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 119
ERROR - 2018-09-16 22:03:24 --> Severity: Notice --> Undefined index: status E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 118
ERROR - 2018-09-16 22:03:24 --> Severity: Notice --> Undefined index: time_pay E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 119
ERROR - 2018-09-16 22:04:00 --> Severity: Notice --> Undefined index: status E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 118
ERROR - 2018-09-16 22:04:00 --> Severity: Notice --> Undefined index: time_pay E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 119
ERROR - 2018-09-16 22:04:46 --> Severity: Notice --> Undefined index: status E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 118
ERROR - 2018-09-16 22:04:46 --> Severity: Notice --> Undefined index: time_pay E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 119
ERROR - 2018-09-16 22:06:09 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 124
ERROR - 2018-09-16 22:15:10 --> Severity: Notice --> Undefined index: status E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 118
ERROR - 2018-09-16 22:15:10 --> Severity: Notice --> Undefined index: time_pay E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 119
ERROR - 2018-09-16 22:15:55 --> Severity: Notice --> Undefined index: status E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 118
ERROR - 2018-09-16 22:15:55 --> Severity: Notice --> Undefined index: time_pay E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 119
ERROR - 2018-09-16 22:15:59 --> Severity: Notice --> Undefined index: status E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 118
ERROR - 2018-09-16 22:15:59 --> Severity: Notice --> Undefined index: time_pay E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 119
ERROR - 2018-09-16 22:16:04 --> Severity: Notice --> Undefined index: status E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 118
ERROR - 2018-09-16 22:16:04 --> Severity: Notice --> Undefined index: time_pay E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 119
ERROR - 2018-09-16 22:19:07 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\framework\database\DB_query_builder.php 669
ERROR - 2018-09-16 22:19:07 --> Query error: Champ 'Array' inconnu dans where clause - Invalid query: SELECT `a`.*, `b`.`nickname`, `b`.`mobile`, `c`.`cardname`, `c`.`accounts`, `d`.`total`, `d`.`used_times`, `d`.`occupy_times`, `d`.`id` `mycourse_id`, `e`.`sname`, `f`.`nickname` `cname`, `b`.`balance`, (SELECT GROUP_CONCAT(DISTINCT if(money> 0, `money`, null)separator '/')  FROM `s_mycourse_log` WHERE `mycourse_id`=d.id ORDER BY f.`id` DESC LIMIT 0, 1) `one_cost`
FROM (`o2o_mycard` `a`, `o2o_users` `b`, `o2o_card` `c`)
LEFT JOIN `s_mycourse` `d` ON `a`.`mycardid` = `d`.`ucard_id`
LEFT JOIN `o2o_store` `e` ON `a`.`sid` = `e`.`sid`
LEFT JOIN `s_employees_manage` `f` ON `a`.`consultant_id` = `f`.`id`
WHERE `a`.`mycardid` = `Array`
AND `a`.`uid` = `b`.`uid`
AND `a`.`cardid` = `c`.`cardid`
ORDER BY `a`.`mycardid` DESC
ERROR - 2018-09-16 22:19:37 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\framework\database\DB_query_builder.php 669
ERROR - 2018-09-16 22:19:37 --> Query error: Champ 'Array' inconnu dans where clause - Invalid query: SELECT `a`.*, `b`.`nickname`, `b`.`mobile`, `c`.`cardname`, `c`.`accounts`, `d`.`total`, `d`.`used_times`, `d`.`occupy_times`, `d`.`id` `mycourse_id`, `e`.`sname`, `f`.`nickname` `cname`, `b`.`balance`, (SELECT GROUP_CONCAT(DISTINCT if(money> 0, `money`, null)separator '/')  FROM `s_mycourse_log` WHERE `mycourse_id`=d.id ORDER BY f.`id` DESC LIMIT 0, 1) `one_cost`
FROM (`o2o_mycard` `a`, `o2o_users` `b`, `o2o_card` `c`)
LEFT JOIN `s_mycourse` `d` ON `a`.`mycardid` = `d`.`ucard_id`
LEFT JOIN `o2o_store` `e` ON `a`.`sid` = `e`.`sid`
LEFT JOIN `s_employees_manage` `f` ON `a`.`consultant_id` = `f`.`id`
WHERE `a`.`mycardid` = `Array`
AND `a`.`uid` = `b`.`uid`
AND `a`.`cardid` = `c`.`cardid`
ORDER BY `a`.`mycardid` DESC
ERROR - 2018-09-16 22:20:16 --> Severity: Notice --> Array to string conversion E:\wamp\www\newMis\newMis\framework\database\DB_query_builder.php 669
ERROR - 2018-09-16 22:20:16 --> Query error: Champ 'Array' inconnu dans where clause - Invalid query: SELECT `a`.*, `b`.`nickname`, `b`.`mobile`, `c`.`cardname`, `c`.`accounts`, `d`.`total`, `d`.`used_times`, `d`.`occupy_times`, `d`.`id` `mycourse_id`, `e`.`sname`, `f`.`nickname` `cname`, `b`.`balance`, (SELECT GROUP_CONCAT(DISTINCT if(money> 0, `money`, null)separator '/')  FROM `s_mycourse_log` WHERE `mycourse_id`=d.id ORDER BY f.`id` DESC LIMIT 0, 1) `one_cost`
FROM (`o2o_mycard` `a`, `o2o_users` `b`, `o2o_card` `c`)
LEFT JOIN `s_mycourse` `d` ON `a`.`mycardid` = `d`.`ucard_id`
LEFT JOIN `o2o_store` `e` ON `a`.`sid` = `e`.`sid`
LEFT JOIN `s_employees_manage` `f` ON `a`.`consultant_id` = `f`.`id`
WHERE `a`.`mycardid` = `Array`
AND `a`.`uid` = `b`.`uid`
AND `a`.`cardid` = `c`.`cardid`
ORDER BY `a`.`mycardid` DESC
ERROR - 2018-09-16 22:34:48 --> Severity: Notice --> Undefined index: id E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 134
ERROR - 2018-09-16 22:35:39 --> Severity: Notice --> Undefined index: status E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 247
ERROR - 2018-09-16 23:04:15 --> 404 Page Not Found: Usercard/css
ERROR - 2018-09-16 23:04:15 --> 404 Page Not Found: Usercard/js
ERROR - 2018-09-16 23:04:15 --> 404 Page Not Found: Usercard/js
ERROR - 2018-09-16 23:04:15 --> 404 Page Not Found: Usercard/js
ERROR - 2018-09-16 23:04:15 --> 404 Page Not Found: Usercard/css
ERROR - 2018-09-16 23:04:15 --> 404 Page Not Found: Usercard/js
ERROR - 2018-09-16 23:27:09 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 165
ERROR - 2018-09-16 23:27:09 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 169
ERROR - 2018-09-16 23:27:09 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 173
ERROR - 2018-09-16 23:27:09 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 177
ERROR - 2018-09-16 23:27:09 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 181
ERROR - 2018-09-16 23:27:09 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 185
ERROR - 2018-09-16 23:27:09 --> Severity: Notice --> Undefined variable: mycourse_info E:\wamp\www\newMis\newMis\htdocs_shop\views\usercard\cardPower.php 189
ERROR - 2018-09-16 23:28:07 --> 404 Page Not Found: Usercard/cardSpecial.html
ERROR - 2018-09-16 23:29:22 --> Severity: Parsing Error --> syntax error, unexpected 'cardSpecial' (T_STRING), expecting function (T_FUNCTION) E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 168
ERROR - 2018-09-16 23:29:25 --> Severity: Parsing Error --> syntax error, unexpected 'cardSpecial' (T_STRING), expecting function (T_FUNCTION) E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 168
ERROR - 2018-09-16 23:29:26 --> Severity: Parsing Error --> syntax error, unexpected 'cardSpecial' (T_STRING), expecting function (T_FUNCTION) E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 168
ERROR - 2018-09-16 23:29:27 --> Severity: Parsing Error --> syntax error, unexpected 'cardSpecial' (T_STRING), expecting function (T_FUNCTION) E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 168
ERROR - 2018-09-16 23:29:28 --> Severity: Parsing Error --> syntax error, unexpected 'cardSpecial' (T_STRING), expecting function (T_FUNCTION) E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 168
ERROR - 2018-09-16 23:44:10 --> 404 Page Not Found: Usercard/cardCoupon.html
ERROR - 2018-09-16 23:45:06 --> 404 Page Not Found: Usercard/cardCoupon.html
