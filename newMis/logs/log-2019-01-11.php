<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-01-11 11:27:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`od`.`bid`,`od`.`consultant_id`,`od`.`reception_aid`
, `a`.`phone`, `b`.`nickna' at line 2 - Invalid query: SELECT `a`.`id`, `a`.`order_code`, `d`.`sname`,`b`.`uid`,
,`od`.`bid`,`od`.`consultant_id`,`od`.`reception_aid`
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
`em`.`id` = '277'
AND `a`.`prestatus_time` >='1546658830'
AND `a`.`prestatus_time` <'1547251200'
AND `a`.`type` != 8601 AND `a`.`status` != -100
AND (1=1)
GROUP BY a.order_code
ORDER BY `a`.`prestatus_time` DESC
ERROR - 2019-01-11 12:09:04 --> Severity: Warning --> mysqli::real_connect():  E:\wamp\www\newMis\newMis\framework\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2019-01-11 12:09:04 --> Severity: Warning --> mysqli::real_connect():  E:\wamp\www\newMis\newMis\framework\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2019-01-11 12:09:04 --> Unable to connect to the database
