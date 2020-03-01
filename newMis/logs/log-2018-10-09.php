<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-10-09 17:43:21 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-09 17:43:31 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-09 17:49:37 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-09 17:49:54 --> Query error: Champ 'b.id' inconnu dans field list - Invalid query: SELECT `a`.`id`, `b`.`id` as `userid`, `b`.`nickname`, `a`.`phone`, `a`.`platform`, `a`.`service_number`, `a`.`woman`, `a`.`man`, `a`.`prestatus_time`, `a`.`iusetime`, `a`.`adviser`, `a`.`is_roomorder`, `b`.`user_type`, `d`.`cardname` `card_id`, `ucard_no`, `a`.`paytype`, `a`.`status`, `f`.`couponname` `coupon_code`, `a`.`adjust_price`, `a`.`adjustment`, `a`.`cover_charge`, `a`.`tip`, `a`.`order_price`, `a`.`type`, `a`.`remark`, `a`.`coupon_price`, `a`.`service_price`, `a`.`discount_price`, `a`.`actual_price`, `a`.`order_code` `oid`, `g`.`sname`, `a`.`create_time`, `a`.`store_id` `sid`, `a`.`free_order`, `card_gift_money`, `package_id`, `package_money`, `package_name`, `a`.`source`, `a`.`source_detail`
FROM (`s_order` `a`, `o2o_users` `b`)
LEFT JOIN `o2o_mycard` `c` ON `a`.`card_id` = `c`.`mycardid`
LEFT JOIN `o2o_card` `d` ON `c`.`cardid` = `d`.`cardid`
LEFT JOIN `o2o_mycoupon` `e` ON `e`.`mycouponid` = `a`.`coupon_code`
LEFT JOIN `o2o_coupon` `f` ON `e`.`couponid` = `f`.`couponid`
LEFT JOIN `o2o_store` `g` ON `g`.`sid` = `a`.`store_id`
LEFT JOIN `s_mypackage` `m` ON `m`.`mypackageid` = `a`.`package_id`
LEFT JOIN `s_package` `p` ON `p`.`id` = `m`.`packageid`
WHERE `a`.`order_code` = 'O20181008173146567'
AND `a`.`user_id` = `b`.`uid`
ORDER BY `a`.`id` DESC
ERROR - 2018-10-09 17:54:14 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-09 17:54:27 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-09 17:55:07 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-09 17:57:31 --> 404 Page Not Found: Orderlist/40358
ERROR - 2018-10-09 17:57:51 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-09 17:58:23 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-09 17:58:47 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-09 17:59:09 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-09 18:02:20 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-09 18:02:30 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-09 18:05:46 --> 404 Page Not Found: Usercard/uploads
