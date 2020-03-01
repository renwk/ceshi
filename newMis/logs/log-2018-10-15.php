<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-10-15 11:54:01 --> 404 Page Not Found: Faviconico/index
ERROR - 2018-10-15 12:07:02 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-15 12:15:00 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-15 16:07:01 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-15 16:08:16 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-15 18:42:16 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-15 18:58:31 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-15 19:09:39 --> 404 Page Not Found: Usercard/uploads
ERROR - 2018-10-15 19:24:37 --> Query error: Champ 'c.name' inconnu dans field list - Invalid query: SELECT `a`.`visit_time`, `a`.`addtime`, `a`.`type`, `a`.`mode`, `a`.`purpose`, `a`.`content`, `a`.`tag_code`, `b`.`nickname`, `c`.`name`
FROM `s_customer` as `a`
LEFT JOIN `o2o_users` as `b` ON `b`.`userid` = `a`.`userid`
WHERE `a`.`userid` = '40402'
