<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-11-29 15:20:33 --> Query error: Erreur de syntaxe près de 'AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='1543449600'
AND `a`.`time_pa' à la ligne 8 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`id`, `a`.`oid`, `f`.`cardname`, `c`.`ucard_no`, `b`.`nickname` `name`, `b`.`mobile`, `a`.`type`, `g`.`sname`, `a`.`money_full`, `a`.`money_true`, `a`.`time_pay`, `b`.`by_consultant` `consultant`, `a`.`consultant_id`, `a`.`bid`, `a`.`status`
FROM (`s_ucard_order` `a`, `o2o_users` `b`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_mycard` `c` ON `a`.`ucard_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `f` ON `a`.`card_type` = `f`.`cardid`
LEFT JOIN `o2o_store` `g` ON `a`.`sid` = `g`.`sid`
WHERE 
b.userid = 
AND `a`.`userid` = `b`.`uid`
AND `a`.`time_pay`>='1543449600'
AND `a`.`time_pay`<'1543536000'
and ( 1=1 )
ORDER BY `a`.`id` DESC
ERROR - 2018-11-29 16:44:27 --> Severity: Notice --> Undefined index: sid E:\wamp\www\newMis\newMis\common\services\Order_service.php 615
ERROR - 2018-11-29 17:49:51 --> 404 Page Not Found: Faviconico/index
ERROR - 2018-11-29 17:59:05 --> Severity: Notice --> Undefined index: orderinfo E:\wamp\www\newMis\newMis\htdocs_api\controllers\api\Apiorder.php 67
ERROR - 2018-11-29 17:59:10 --> Severity: Notice --> Undefined index: orderinfo E:\wamp\www\newMis\newMis\htdocs_api\controllers\api\Apiorder.php 67
ERROR - 2018-11-29 17:59:38 --> Severity: Notice --> Undefined index: orderinfo E:\wamp\www\newMis\newMis\htdocs_api\controllers\api\Apiorder.php 67
ERROR - 2018-11-29 18:00:07 --> Severity: Notice --> Undefined index: orderinfo E:\wamp\www\newMis\newMis\htdocs_api\controllers\api\Apiorder.php 67
ERROR - 2018-11-29 18:00:49 --> Severity: Notice --> Undefined index: orderinfo E:\wamp\www\newMis\newMis\htdocs_api\controllers\api\Apiorder.php 67
ERROR - 2018-11-29 18:03:24 --> Severity: Notice --> Undefined index: orderinfo E:\wamp\www\newMis\newMis\htdocs_api\controllers\api\Apiorder.php 67
ERROR - 2018-11-29 18:04:19 --> Severity: Notice --> Undefined index: orderinfo E:\wamp\www\newMis\newMis\htdocs_api\controllers\api\Apiorder.php 67
ERROR - 2018-11-29 18:06:36 --> Severity: Notice --> Undefined index: orderinfo E:\wamp\www\newMis\newMis\htdocs_api\controllers\api\Apiorder.php 67
ERROR - 2018-11-29 18:07:19 --> Severity: Notice --> Undefined index: orderinfo E:\wamp\www\newMis\newMis\htdocs_api\controllers\api\Apiorder.php 67
ERROR - 2018-11-29 18:09:27 --> Severity: Notice --> Undefined index: orderinfo E:\wamp\www\newMis\newMis\htdocs_api\controllers\api\Apiorder.php 67
ERROR - 2018-11-29 18:10:34 --> Severity: Notice --> Undefined index: orderinfo E:\wamp\www\newMis\newMis\htdocs_api\controllers\api\Apiorder.php 67
ERROR - 2018-11-29 18:10:45 --> Severity: Notice --> Undefined index: orderinfo E:\wamp\www\newMis\newMis\htdocs_api\controllers\api\Apiorder.php 67
ERROR - 2018-11-29 18:11:51 --> Severity: Notice --> Undefined index: orderinfo E:\wamp\www\newMis\newMis\htdocs_api\controllers\api\Apiorder.php 67
