<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-01-17 11:56:23 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-01-17 14:22:04 --> Query error: Champ 'tag_code' inconnu dans field list - Invalid query: INSERT INTO `s_config_system` (`tag_code`, `tag_name`, `status`, `describe`, `tag_type`, `create_account_id`, `create_time`) VALUES ('b689dd1362', '25岁以下', 1, '年龄', '1101', 1, 1547706124)
ERROR - 2019-01-17 16:34:56 --> Query error: Champ 'o.uid' inconnu dans on clause - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`userid`, `a`.`uid`, `a`.`mobile`, `a`.`backup_mobile1`, `a`.`backup_mobile2`, `a`.`nickname` `name`, `a`.`sex`, `a`.`country`, `a`.`costmoney`, `a`.`costcount`, `a`.`user_type`, `d`.`sname`, `a`.`source`, `a`.`by_consultant` `consultant`, `a`.`bid`, `a`.`state`, `a`.`registtime`, `d`.`sid`
FROM (`o2o_users` `a`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_userinfo` `b` ON `a`.`uid` = `b`.`uid`
LEFT JOIN `o2o_store` `d` ON `a`.`storefront` = `d`.`sid`
LEFT JOIN `s_order` `o` ON `a`.`uid` = `o`.`uid`
WHERE `a`.`state` != 2 and user_type = 1
and (1=1 and `d`.`sname` = '测试门店')
ORDER BY `o`.`prestatus_time` ASC
ERROR - 2019-01-17 16:35:08 --> Query error: Champ 'o.uid' inconnu dans on clause - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`userid`, `a`.`uid`, `a`.`mobile`, `a`.`backup_mobile1`, `a`.`backup_mobile2`, `a`.`nickname` `name`, `a`.`sex`, `a`.`country`, `a`.`costmoney`, `a`.`costcount`, `a`.`user_type`, `d`.`sname`, `a`.`source`, `a`.`by_consultant` `consultant`, `a`.`bid`, `a`.`state`, `a`.`registtime`, `d`.`sid`
FROM (`o2o_users` `a`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_userinfo` `b` ON `a`.`uid` = `b`.`uid`
LEFT JOIN `o2o_store` `d` ON `a`.`storefront` = `d`.`sid`
LEFT JOIN `s_order` `o` ON `a`.`uid` = `o`.`uid`
WHERE `a`.`state` != 2 and user_type = 1
and (1=1 and `a`.`consultant_id`=166 and `d`.`sname` = '测试门店')
ORDER BY `o`.`prestatus_time` ASC
ERROR - 2019-01-17 16:38:27 --> 404 Page Not Found: Api/Usercard
ERROR - 2019-01-17 17:09:54 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'FROM (`o2o_users` `a`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_userinfo` `b` ' at line 5 - Invalid query: SELECT (@rowNum:=@rowNum+1) as rowNo, `a`.`userid`, `a`.`uid`, `a`.`mobile`, `a`.`backup_mobile1`,
 `a`.`backup_mobile2`, `a`.`nickname` `name`, `a`.`sex`, `a`.`country`, `a`.`costmoney`, `a`.`costcount`, `a`.`user_type`,
  `d`.`sname`, `a`.`source`, `a`.`by_consultant` `consultant`, `a`.`bid`, `a`.`state`, `a`.`registtime`, `d`.`sid`,
  max(`o`.`prestatus_time`),
FROM (`o2o_users` `a`, (Select (@rowNum :=0) ) B)
LEFT JOIN `o2o_userinfo` `b` ON `a`.`uid` = `b`.`uid`
LEFT JOIN `o2o_store` `d` ON `a`.`storefront` = `d`.`sid`
LEFT JOIN `s_order` `o` ON  `o`.`user_id` = `a`.`uid`
WHERE `a`.`state` != 2 and user_type = 1
and (1=1 and `d`.`sname` = '测试门店')
GROUP BY `a`.`uid`
ORDER BY `o`.`prestatus_time` DESC
ERROR - 2019-01-17 18:31:34 --> Severity: Warning --> Missing argument 1 for Buy::gotoPay() E:\wamp\www\newMis\newMis\htdocs_user\controllers\Buy.php 26
ERROR - 2019-01-17 18:31:34 --> Severity: Notice --> Undefined variable: cardid E:\wamp\www\newMis\newMis\htdocs_user\controllers\Buy.php 41
