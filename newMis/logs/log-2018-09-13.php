<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-13 11:06:02 --> Severity: Notice --> Undefined property: Usercard::$Userdetail_service E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 19
ERROR - 2018-09-13 11:06:02 --> Severity: Error --> Call to a member function userlist() on a non-object E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Usercard.php 19
ERROR - 2018-09-13 12:27:09 --> Severity: Error --> Call to undefined method Userdetail_model::getOrderByUid() E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 21
ERROR - 2018-09-13 12:58:13 --> Severity: Notice --> Undefined property: Usercard::$Userdetail_model E:\wamp\www\newMis\newMis\htdocs_shop\core\MY_Service.php 12
ERROR - 2018-09-13 12:58:13 --> Severity: Error --> Call to a member function getUcardListByUserid() on a non-object E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 22
ERROR - 2018-09-13 12:58:16 --> Severity: Notice --> Undefined property: Usercard::$Userdetail_model E:\wamp\www\newMis\newMis\htdocs_shop\core\MY_Service.php 12
ERROR - 2018-09-13 12:58:16 --> Severity: Error --> Call to a member function getUcardListByUserid() on a non-object E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 22
ERROR - 2018-09-13 14:09:11 --> Severity: Notice --> Undefined property: Usercard::$Userdetail_model E:\wamp\www\newMis\newMis\htdocs_shop\core\MY_Service.php 12
ERROR - 2018-09-13 14:09:11 --> Severity: Error --> Call to a member function getUcardListByUserid() on a non-object E:\wamp\www\newMis\newMis\common\services\Userdetail_service.php 22
ERROR - 2018-09-13 14:21:52 --> Severity: Notice --> Undefined property: Usercard::$table_mycoupon E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-13 14:21:52 --> Severity: Notice --> Undefined property: Usercard::$table_coupon E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-13 14:21:52 --> Severity: Notice --> Undefined property: Usercard::$table_order E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-13 14:21:52 --> Severity: Notice --> Undefined property: Usercard::$table_users E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-13 14:21:52 --> Query error: La table 'test.a' n'existe pas - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `b`.`couponname`, `b`.`money`, `a`.`addtime`, `a`.`expiratime`, `a`.`state`, `a`.`usetime`, `c`.`order_code`
FROM (`a`, (Select (@rowNum :=0) ) B, `d`)
LEFT JOIN `b` ON `b`.`couponid` = `a`.`couponid`
LEFT JOIN `c` ON `a`.`mycouponid` = `c`.`coupon_code`
WHERE `d`.`userid` = '40358'
AND `a`.`state` != 'COUPON_WAITSEND'
AND `a`.`uid` = `d`.`uid`
ORDER BY `a`.`state` DESC, `a`.`addtime` DESC
ERROR - 2018-09-13 14:27:03 --> Severity: Notice --> Undefined property: Usercard::$table_mycoupon E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-13 14:27:03 --> Severity: Notice --> Undefined property: Usercard::$table_coupon E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-13 14:27:03 --> Severity: Notice --> Undefined property: Usercard::$table_order E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-13 14:27:03 --> Severity: Notice --> Undefined property: Usercard::$table_users E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-13 14:27:03 --> Query error: La table 'test.a' n'existe pas - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `b`.`couponname`, `b`.`money`, `a`.`addtime`, `a`.`expiratime`, `a`.`state`, `a`.`usetime`, `c`.`order_code`
FROM (`a`, (Select (@rowNum :=0) ) B, `d`)
LEFT JOIN `b` ON `b`.`couponid` = `a`.`couponid`
LEFT JOIN `c` ON `a`.`mycouponid` = `c`.`coupon_code`
WHERE `d`.`userid` = '40358'
AND `a`.`state` != 'COUPON_WAITSEND'
AND `a`.`uid` = `d`.`uid`
ORDER BY `a`.`state` DESC, `a`.`addtime` DESC
ERROR - 2018-09-13 16:14:11 --> 404 Page Not Found: Faviconico/index
ERROR - 2018-09-13 16:15:13 --> Query error: Erreur de syntaxe près de 'AND `a`.`state` != 2
ORDER BY `a`.`registtime` DESC' à la ligne 6 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`userid`, `a`.`uid`, `a`.`mobile`, `a`.`backup_mobile1`, `a`.`backup_mobile2`, `a`.`nickname` `name`, `a`.`sex`, `a`.`country`, `a`.`costmoney`, `a`.`costcount`, `a`.`user_type`, `d`.`sname`, `a`.`source`, `a`.`by_consultant` `consultant`, `a`.`bid`, `a`.`state`, `a`.`registtime`, `d`.`sid`
FROM (`o2o_users` `a`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_userinfo` `b` ON `a`.`uid` = `b`.`uid`
LEFT JOIN `o2o_store` `d` ON `a`.`storefront` = `d`.`sid`
WHERE `a`.`consultant_id`=
AND `a`.`state` != 2
ORDER BY `a`.`registtime` DESC
ERROR - 2018-09-13 16:17:51 --> Query error: Erreur de syntaxe près de 'AND `a`.`state` != 2
ORDER BY `a`.`registtime` DESC' à la ligne 6 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`userid`, `a`.`uid`, `a`.`mobile`, `a`.`backup_mobile1`, `a`.`backup_mobile2`, `a`.`nickname` `name`, `a`.`sex`, `a`.`country`, `a`.`costmoney`, `a`.`costcount`, `a`.`user_type`, `d`.`sname`, `a`.`source`, `a`.`by_consultant` `consultant`, `a`.`bid`, `a`.`state`, `a`.`registtime`, `d`.`sid`
FROM (`o2o_users` `a`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_userinfo` `b` ON `a`.`uid` = `b`.`uid`
LEFT JOIN `o2o_store` `d` ON `a`.`storefront` = `d`.`sid`
WHERE `a`.`consultant_id`=
AND `a`.`state` != 2
ORDER BY `a`.`registtime` DESC
