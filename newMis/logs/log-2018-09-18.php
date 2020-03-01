<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-18 10:55:20 --> Query error: Champ 'ad.userphoto' inconnu dans field list - Invalid query: SELECT `ad`.`aid`, `ad`.`username`, `ad`.`name` as `nickname`, `ad`.`phone`, `ad`.`userphoto` as `photo`, `s`.`sname`, `s`.`sid`
FROM `o2o_admin` as `ad`
INNER JOIN `o2o_store` as `s` ON `ad`.`role_storeid` = `s`.`sid`
WHERE `ad`.`phone` = '15201186181'
AND `ad`.`status` =0
ERROR - 2018-09-18 12:14:22 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-09-18 14:26:37 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-09-18 14:30:21 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-09-18 14:31:18 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-09-18 18:11:35 --> 404 Page Not Found: Orderlist/orders
ERROR - 2018-09-18 18:56:54 --> Severity: Error --> Call to undefined method Order_model::lsbySid() E:\wamp\www\newMis\newMis\common\services\Order_service.php 822
ERROR - 2018-09-18 18:57:34 --> Severity: Error --> Call to undefined method Order_model::lsbySid() E:\wamp\www\newMis\newMis\common\services\Order_service.php 822
