<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-12 11:38:58 --> Severity: Notice --> Undefined property: orderlist::$table_order_detail E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-12 11:38:58 --> Severity: Notice --> Undefined property: orderlist::$table_item E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-12 11:38:58 --> Severity: Notice --> Undefined property: orderlist::$table_beautician E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-12 11:38:58 --> Query error: La table 'test.a' n'existe pas - Invalid query: SELECT `a`.`order_code`, `a`.`id`, `a`.`iname`, `a`.`type`, `a`.`detail_type`, `a`.`now_price`, `a`.`discount_price`, `a`.`actual_price`, `a`.`count`, `a`.`refund_num`, `a`.`refund_status`, `b`.`iusetime`, `a`.`customer`, `a`.`item_id`, `c`.`nickname` `service_bid`, `a`.`bid`, `a`.`consultant_id`, `a`.`reception_aid`, `a`.`category`, `a`.`member_discount`, `a`.`performance_money`, `course_id`, `gift_card_id`
FROM `a`
LEFT JOIN `b` ON `a`.`item_id` = `b`.`iid`
LEFT JOIN `c` ON `a`.`service_bid` = `c`.`beauticianid`
WHERE `order_code` = 'O20180911124823148'
ORDER BY `id` DESC
ERROR - 2018-09-12 11:44:55 --> 404 Page Not Found: Orderlist/css
ERROR - 2018-09-12 11:44:55 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:44:55 --> 404 Page Not Found: Orderlist/css
ERROR - 2018-09-12 11:44:55 --> 404 Page Not Found: Orderlist/css
ERROR - 2018-09-12 11:44:55 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:44:55 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:44:55 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:44:56 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:44:56 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:47:20 --> 404 Page Not Found: Orderlist/css
ERROR - 2018-09-12 11:47:20 --> 404 Page Not Found: Orderlist/css
ERROR - 2018-09-12 11:47:20 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:47:20 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:47:20 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:47:20 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:47:20 --> 404 Page Not Found: Orderlist/css
ERROR - 2018-09-12 11:47:20 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:47:20 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:48:53 --> 404 Page Not Found: Orderlist/css
ERROR - 2018-09-12 11:48:53 --> 404 Page Not Found: Orderlist/css
ERROR - 2018-09-12 11:48:53 --> 404 Page Not Found: Orderlist/css
ERROR - 2018-09-12 11:48:53 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:48:53 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:48:53 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:48:54 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 11:48:54 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 12:03:51 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 12:03:51 --> 404 Page Not Found: Orderlist/css
ERROR - 2018-09-12 12:03:51 --> 404 Page Not Found: Orderlist/css
ERROR - 2018-09-12 12:03:51 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 12:03:51 --> 404 Page Not Found: Orderlist/css
ERROR - 2018-09-12 12:03:51 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 12:03:51 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 12:03:51 --> 404 Page Not Found: Orderlist/js
ERROR - 2018-09-12 12:35:28 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\services\Order_service.php:589) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-12 12:35:28 --> Severity: Error --> Call to undefined method Order_service::getPayType() E:\wamp\www\newMis\newMis\common\services\Order_service.php 589
ERROR - 2018-09-12 12:49:50 --> Severity: Notice --> Undefined property: orderlist::$orderlist_model E:\wamp\www\newMis\newMis\htdocs_shop\core\MY_Service.php 12
ERROR - 2018-09-12 12:49:50 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\services\Order_service.php:565) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-12 12:49:50 --> Severity: Error --> Call to a member function getOrderDetailInfo() on a non-object E:\wamp\www\newMis\newMis\common\services\Order_service.php 565
ERROR - 2018-09-12 14:32:10 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 754
ERROR - 2018-09-12 14:32:10 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 757
ERROR - 2018-09-12 14:32:10 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 754
ERROR - 2018-09-12 14:32:10 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 755
ERROR - 2018-09-12 14:32:10 --> Severity: Notice --> Undefined index: O20180912142844996 E:\wamp\www\newMis\newMis\common\services\Order_service.php 707
ERROR - 2018-09-12 14:32:15 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 754
ERROR - 2018-09-12 14:32:15 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 757
ERROR - 2018-09-12 14:32:15 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 754
ERROR - 2018-09-12 14:32:15 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 755
ERROR - 2018-09-12 14:32:15 --> Severity: Notice --> Undefined index: O20180912142844996 E:\wamp\www\newMis\newMis\common\services\Order_service.php 707
ERROR - 2018-09-12 14:32:27 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 754
ERROR - 2018-09-12 14:32:27 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 757
ERROR - 2018-09-12 14:32:27 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 754
ERROR - 2018-09-12 14:32:27 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 755
ERROR - 2018-09-12 14:32:27 --> Severity: Notice --> Undefined index: O20180912142844996 E:\wamp\www\newMis\newMis\common\services\Order_service.php 707
ERROR - 2018-09-12 14:32:31 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 754
ERROR - 2018-09-12 14:32:31 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 757
ERROR - 2018-09-12 14:32:31 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 754
ERROR - 2018-09-12 14:32:31 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 755
ERROR - 2018-09-12 14:32:31 --> Severity: Notice --> Undefined index: O20180912142844996 E:\wamp\www\newMis\newMis\common\services\Order_service.php 707
ERROR - 2018-09-12 14:32:39 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 754
ERROR - 2018-09-12 14:32:39 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 757
ERROR - 2018-09-12 14:32:39 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 754
ERROR - 2018-09-12 14:32:39 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 755
ERROR - 2018-09-12 14:32:39 --> Severity: Notice --> Undefined index: O20180912142844996 E:\wamp\www\newMis\newMis\common\services\Order_service.php 707
ERROR - 2018-09-12 14:35:48 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 754
ERROR - 2018-09-12 14:35:48 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 757
ERROR - 2018-09-12 14:35:48 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 754
ERROR - 2018-09-12 14:35:48 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\common\services\Order_service.php 755
ERROR - 2018-09-12 14:35:48 --> Severity: Notice --> Undefined index: O20180912142844996 E:\wamp\www\newMis\newMis\common\services\Order_service.php 707
ERROR - 2018-09-12 14:50:02 --> Severity: Notice --> Undefined index: order_price     E:\wamp\www\newMis\newMis\common\services\Order_service.php 549
ERROR - 2018-09-12 14:58:28 --> Severity: Notice --> Undefined index: tip  E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderService.php 139
ERROR - 2018-09-12 14:58:28 --> Severity: Notice --> Undefined index: actual_price  E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderService.php 143
ERROR - 2018-09-12 15:00:45 --> Severity: Parsing Error --> syntax error, unexpected end of file E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderService.php 169
ERROR - 2018-09-12 15:29:04 --> Query error: Erreur de syntaxe près de '`a`.`order_code` LIKE '%%' or  `a`.`phone` LIKE '%%'  and
`em`.`id` = '3' 
AND' à la ligne 15 - Invalid query: SELECT `a`.`id`, `a`.`order_code`, `d`.`sname`
, `a`.`phone`, `b`.`nickname` `name`, `a`.`platform`, `a`.`type`
, `a`.`status`,conf.config_description as `state`, `a`.`prestatus_time`, `a`.`service_number`
, `b`.`user_type`, `a`.`actual_price`, `a`.`discount_price`
, `a`.`create_time` as `time`, `is_refund`,GROUP_CONCAT(DISTINCT s.srid) AS sid_room
FROM `s_order` `a`
LEFT JOIN `o2o_users` `b` ON `a`.`user_id` = `b`.`uid`
LEFT JOIN `o2o_store` `d` ON `d`.`sid` = `a`.`store_id`
LEFT JOIN `s_order_detail` as od on od.order_code=a.order_code
LEFT JOIN s_order_adviser as oa on a.order_code=oa.order_code
LEFT JOIN `s_employees_manage` as em on oa.adviser_id=em.id
LEFT JOIN `s_config_system` as conf on  `a`.`status` = conf.`config_value`
LEFT JOIN o2o_store_rtime as s ON s.oid = a.order_code 
WHERE
1=1`a`.`order_code` LIKE '%%' or  `a`.`phone` LIKE '%%'  and
`em`.`id` = '3' 
AND `a`.`prestatus_time` >='1536710400'
AND `a`.`prestatus_time` <'1536796800'
AND `a`.`type` != 8601 AND `a`.`status` != -100
GROUP BY a.order_code
ORDER BY `a`.`prestatus_time` DESC
ERROR - 2018-09-12 15:30:47 --> Severity: Notice --> Undefined index: L20180905165129994 E:\wamp\www\newMis\newMis\common\services\Order_service.php 709
ERROR - 2018-09-12 15:30:47 --> Severity: Notice --> Undefined index: L20180905165129994 E:\wamp\www\newMis\newMis\common\services\Order_service.php 710
ERROR - 2018-09-12 15:30:47 --> Severity: Notice --> Undefined index: L20180904160324505 E:\wamp\www\newMis\newMis\common\services\Order_service.php 709
ERROR - 2018-09-12 15:30:47 --> Severity: Notice --> Undefined index: L20180904160324505 E:\wamp\www\newMis\newMis\common\services\Order_service.php 710
ERROR - 2018-09-12 15:30:47 --> Severity: Notice --> Undefined index: L20180902203549787 E:\wamp\www\newMis\newMis\common\services\Order_service.php 709
ERROR - 2018-09-12 15:30:47 --> Severity: Notice --> Undefined index: L20180902203549787 E:\wamp\www\newMis\newMis\common\services\Order_service.php 710
ERROR - 2018-09-12 15:30:47 --> Severity: Notice --> Undefined index: L20180831183015191 E:\wamp\www\newMis\newMis\common\services\Order_service.php 709
ERROR - 2018-09-12 15:30:47 --> Severity: Notice --> Undefined index: L20180831183015191 E:\wamp\www\newMis\newMis\common\services\Order_service.php 710
ERROR - 2018-09-12 15:30:47 --> Severity: Notice --> Undefined index: L20180831182855830 E:\wamp\www\newMis\newMis\common\services\Order_service.php 709
ERROR - 2018-09-12 15:30:47 --> Severity: Notice --> Undefined index: L20180831182855830 E:\wamp\www\newMis\newMis\common\services\Order_service.php 710
ERROR - 2018-09-12 15:30:48 --> Severity: Notice --> Undefined index: L20180830174328360 E:\wamp\www\newMis\newMis\common\services\Order_service.php 709
ERROR - 2018-09-12 15:30:48 --> Severity: Notice --> Undefined index: L20180830174328360 E:\wamp\www\newMis\newMis\common\services\Order_service.php 710
ERROR - 2018-09-12 15:30:48 --> Severity: Notice --> Undefined index: L20180807152201894 E:\wamp\www\newMis\newMis\common\services\Order_service.php 709
ERROR - 2018-09-12 15:30:48 --> Severity: Notice --> Undefined index: L20180807152201894 E:\wamp\www\newMis\newMis\common\services\Order_service.php 710
ERROR - 2018-09-12 15:30:48 --> Severity: Notice --> Undefined index: L20180807145706888 E:\wamp\www\newMis\newMis\common\services\Order_service.php 709
ERROR - 2018-09-12 15:30:48 --> Severity: Notice --> Undefined index: L20180807145706888 E:\wamp\www\newMis\newMis\common\services\Order_service.php 710
ERROR - 2018-09-12 15:45:43 --> Query error: Champ 'a.order_code' inconnu dans where clause - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`, `b`.`nickname` `name`, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
find_in_set('3',a.consultant_id)
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='1536710400'
AND `a`.`time_pay`<'1536796800'
and (`a`.`order_code` LIKE '%218693%' or  `a`.`phone` LIKE '%218693%' )
ORDER BY `a`.`id` DESC
ERROR - 2018-09-12 15:47:44 --> Severity: Notice --> Undefined variable: where1 E:\wamp\www\newMis\newMis\common\models\Order_model.php 237
ERROR - 2018-09-12 15:47:44 --> Query error: Erreur de syntaxe près de ')
ORDER BY `a`.`id` DESC' à la ligne 11 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`, `b`.`nickname` `name`, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
find_in_set('3',a.consultant_id)
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='1536710400'
AND `a`.`time_pay`<'1536796800'
and ()
ORDER BY `a`.`id` DESC
ERROR - 2018-09-12 15:47:51 --> Severity: Notice --> Undefined variable: where1 E:\wamp\www\newMis\newMis\common\models\Order_model.php 237
ERROR - 2018-09-12 15:47:51 --> Query error: Erreur de syntaxe près de ')
ORDER BY `a`.`id` DESC' à la ligne 11 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`, `b`.`nickname` `name`, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
find_in_set('3',a.consultant_id)
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='1536710400'
AND `a`.`time_pay`<'1536796800'
and ()
ORDER BY `a`.`id` DESC
ERROR - 2018-09-12 15:47:52 --> Severity: Notice --> Undefined variable: where1 E:\wamp\www\newMis\newMis\common\models\Order_model.php 237
ERROR - 2018-09-12 15:47:52 --> Query error: Erreur de syntaxe près de ')
ORDER BY `a`.`id` DESC' à la ligne 11 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`, `b`.`nickname` `name`, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
find_in_set('3',a.consultant_id)
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='1536710400'
AND `a`.`time_pay`<'1536796800'
and ()
ORDER BY `a`.`id` DESC
ERROR - 2018-09-12 15:47:56 --> Severity: Notice --> Undefined variable: where1 E:\wamp\www\newMis\newMis\common\models\Order_model.php 237
ERROR - 2018-09-12 15:47:56 --> Query error: Erreur de syntaxe près de ')
ORDER BY `a`.`id` DESC' à la ligne 11 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`, `b`.`nickname` `name`, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
find_in_set('3',a.consultant_id)
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='1536710400'
AND `a`.`time_pay`<'1536796800'
and ()
ORDER BY `a`.`id` DESC
ERROR - 2018-09-12 15:47:57 --> Severity: Notice --> Undefined variable: where1 E:\wamp\www\newMis\newMis\common\models\Order_model.php 237
ERROR - 2018-09-12 15:47:57 --> Query error: Erreur de syntaxe près de ')
ORDER BY `a`.`id` DESC' à la ligne 11 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`, `b`.`nickname` `name`, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
find_in_set('3',a.consultant_id)
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='1536710400'
AND `a`.`time_pay`<'1536796800'
and ()
ORDER BY `a`.`id` DESC
ERROR - 2018-09-12 15:47:58 --> Severity: Notice --> Undefined variable: where1 E:\wamp\www\newMis\newMis\common\models\Order_model.php 237
ERROR - 2018-09-12 15:47:58 --> Query error: Erreur de syntaxe près de ')
ORDER BY `a`.`id` DESC' à la ligne 11 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`, `b`.`nickname` `name`, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
find_in_set('3',a.consultant_id)
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='1536710400'
AND `a`.`time_pay`<'1536796800'
and ()
ORDER BY `a`.`id` DESC
ERROR - 2018-09-12 15:48:00 --> Severity: Notice --> Undefined variable: where1 E:\wamp\www\newMis\newMis\common\models\Order_model.php 237
ERROR - 2018-09-12 15:48:00 --> Query error: Erreur de syntaxe près de ')
ORDER BY `a`.`id` DESC' à la ligne 11 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`, `b`.`nickname` `name`, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
find_in_set('3',a.consultant_id)
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='1536710400'
AND `a`.`time_pay`<'1536796800'
and ()
ORDER BY `a`.`id` DESC
ERROR - 2018-09-12 15:48:28 --> Severity: Notice --> Undefined variable: where1 E:\wamp\www\newMis\newMis\common\models\Order_model.php 237
ERROR - 2018-09-12 15:48:28 --> Query error: Erreur de syntaxe près de ')
ORDER BY `a`.`id` DESC' à la ligne 11 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`, `b`.`nickname` `name`, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
find_in_set('3',a.consultant_id)
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='1536710400'
AND `a`.`time_pay`<'1536796800'
and ()
ORDER BY `a`.`id` DESC
ERROR - 2018-09-12 15:49:20 --> Severity: Notice --> Undefined variable: where1 E:\wamp\www\newMis\newMis\common\models\Order_model.php 237
ERROR - 2018-09-12 15:49:20 --> Query error: Erreur de syntaxe près de ')
ORDER BY `a`.`id` DESC' à la ligne 11 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`, `b`.`nickname` `name`, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
find_in_set('3',a.consultant_id)
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='1536710400'
AND `a`.`time_pay`<'1536796800'
and ()
ORDER BY `a`.`id` DESC
ERROR - 2018-09-12 15:50:27 --> Severity: Notice --> Undefined variable: where1 E:\wamp\www\newMis\newMis\common\models\Order_model.php 237
ERROR - 2018-09-12 15:50:27 --> Query error: Erreur de syntaxe près de ')
ORDER BY `a`.`id` DESC' à la ligne 11 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`, `b`.`nickname` `name`, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
find_in_set('3',a.consultant_id)
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='1536710400'
AND `a`.`time_pay`<'1536796800'
and ()
ORDER BY `a`.`id` DESC
ERROR - 2018-09-12 15:51:58 --> Severity: Notice --> Undefined index: sid E:\wamp\www\newMis\newMis\common\services\Order_service.php 566
ERROR - 2018-09-12 15:51:58 --> Severity: Notice --> Undefined offset: 1536738440 E:\wamp\www\newMis\newMis\common\services\Order_service.php 582
ERROR - 2018-09-12 15:51:58 --> Severity: Notice --> Undefined index: oid E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderService.php 75
ERROR - 2018-09-12 15:51:58 --> Severity: Notice --> Undefined index: phone E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderService.php 79
ERROR - 2018-09-12 15:51:58 --> Severity: Notice --> Undefined index: nickname E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderService.php 83
ERROR - 2018-09-12 15:51:58 --> Severity: Notice --> Undefined index: sname E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderService.php 87
ERROR - 2018-09-12 15:51:58 --> Severity: Notice --> Undefined index: prestatus_time E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderService.php 91
ERROR - 2018-09-12 16:14:50 --> Severity: Notice --> Undefined index: sid E:\wamp\www\newMis\newMis\common\services\Order_service.php 567
ERROR - 2018-09-12 16:14:50 --> Severity: Notice --> Undefined offset: 1536738440 E:\wamp\www\newMis\newMis\common\services\Order_service.php 583
ERROR - 2018-09-12 16:14:50 --> Severity: Notice --> Undefined index: oid E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderService.php 75
ERROR - 2018-09-12 16:14:50 --> Severity: Notice --> Undefined index: phone E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderService.php 79
ERROR - 2018-09-12 16:14:50 --> Severity: Notice --> Undefined index: nickname E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderService.php 83
ERROR - 2018-09-12 16:14:50 --> Severity: Notice --> Undefined index: sname E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderService.php 87
ERROR - 2018-09-12 16:14:50 --> Severity: Notice --> Undefined index: prestatus_time E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderService.php 91
ERROR - 2018-09-12 16:24:40 --> 404 Page Not Found: Orderlist/orderDetail
ERROR - 2018-09-12 16:48:16 --> Severity: Notice --> Undefined variable: order_info E:\wamp\www\newMis\newMis\common\services\Order_service.php 685
ERROR - 2018-09-12 17:16:29 --> Severity: Error --> Call to undefined method Order_model::getOrderPlay() E:\wamp\www\newMis\newMis\common\services\Order_service.php 691
ERROR - 2018-09-12 17:43:47 --> Severity: Notice --> A non well formed numeric value encountered E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 121
ERROR - 2018-09-12 17:43:47 --> Severity: Notice --> A non well formed numeric value encountered E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 125
ERROR - 2018-09-12 17:52:00 --> Severity: Notice --> Undefined property: orderlist::$Usercharge_model E:\wamp\www\newMis\newMis\htdocs_shop\core\MY_Service.php 12
ERROR - 2018-09-12 17:52:00 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\services\Order_service.php:724) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-12 17:52:00 --> Severity: Error --> Call to a member function getCouponInfo() on a non-object E:\wamp\www\newMis\newMis\common\services\Order_service.php 724
ERROR - 2018-09-12 17:52:05 --> Severity: Notice --> Undefined property: orderlist::$Usercharge_model E:\wamp\www\newMis\newMis\htdocs_shop\core\MY_Service.php 12
ERROR - 2018-09-12 17:52:05 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\services\Order_service.php:724) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-12 17:52:05 --> Severity: Error --> Call to a member function getCouponInfo() on a non-object E:\wamp\www\newMis\newMis\common\services\Order_service.php 724
ERROR - 2018-09-12 17:52:52 --> Severity: Notice --> Undefined property: orderlist::$orderlist_model E:\wamp\www\newMis\newMis\htdocs_shop\core\MY_Service.php 12
ERROR - 2018-09-12 17:52:52 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\services\Order_service.php:654) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-12 17:52:52 --> Severity: Error --> Call to a member function getPosType() on a non-object E:\wamp\www\newMis\newMis\common\services\Order_service.php 654
ERROR - 2018-09-12 17:52:59 --> Severity: Notice --> Undefined property: orderlist::$orderlist_model E:\wamp\www\newMis\newMis\htdocs_shop\core\MY_Service.php 12
ERROR - 2018-09-12 17:52:59 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\services\Order_service.php:654) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-12 17:52:59 --> Severity: Error --> Call to a member function getPosType() on a non-object E:\wamp\www\newMis\newMis\common\services\Order_service.php 654
ERROR - 2018-09-12 17:53:27 --> Severity: Notice --> Undefined property: orderlist::$orderlist_model E:\wamp\www\newMis\newMis\htdocs_shop\core\MY_Service.php 12
ERROR - 2018-09-12 17:53:27 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\services\Order_service.php:654) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-12 17:53:27 --> Severity: Error --> Call to a member function getPosType() on a non-object E:\wamp\www\newMis\newMis\common\services\Order_service.php 654
ERROR - 2018-09-12 17:53:28 --> Severity: Notice --> Undefined property: orderlist::$orderlist_model E:\wamp\www\newMis\newMis\htdocs_shop\core\MY_Service.php 12
ERROR - 2018-09-12 17:53:28 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at E:\wamp\www\newMis\newMis\common\services\Order_service.php:654) E:\wamp\www\newMis\newMis\framework\core\Common.php 573
ERROR - 2018-09-12 17:53:28 --> Severity: Error --> Call to a member function getPosType() on a non-object E:\wamp\www\newMis\newMis\common\services\Order_service.php 654
ERROR - 2018-09-12 17:57:37 --> Severity: Notice --> Undefined property: orderlist::$table_order_scattered_pay E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-12 17:57:37 --> Query error: La table 'test.a' n'existe pas - Invalid query: SELECT `a`.`id`, `a`.`pay_name`
FROM `a`
WHERE `id` = '48'
AND `paytype` = '0'
AND `display` = '0'
ERROR - 2018-09-12 18:04:48 --> Severity: Warning --> Invalid argument supplied for foreach() E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 163
ERROR - 2018-09-12 18:07:57 --> Severity: Warning --> Invalid argument supplied for foreach() E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 164
ERROR - 2018-09-12 18:08:06 --> Severity: Warning --> Invalid argument supplied for foreach() E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderRecharge.php 164
ERROR - 2018-09-12 19:24:47 --> 404 Page Not Found: Usercard/detail
ERROR - 2018-09-12 19:25:07 --> Severity: Error --> Call to undefined method Users_model::getUserDetail() E:\wamp\www\newMis\newMis\common\services\Usercard_service.php 18
