<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2018-09-11 11:40:49 --> 404 Page Not Found: Orderlist/getUserCard
ERROR - 2018-09-11 11:40:51 --> 404 Page Not Found: Orderlist/bespeakInfo
ERROR - 2018-09-11 11:42:13 --> 404 Page Not Found: Orderlist/orderList
ERROR - 2018-09-11 11:50:17 --> 404 Page Not Found: Orderlist/orderList
ERROR - 2018-09-11 14:26:17 --> Severity: Parsing Error --> syntax error, unexpected end of file E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderlist.php 574
ERROR - 2018-09-11 14:50:22 --> 404 Page Not Found: Orderlist/undefined
ERROR - 2018-09-11 14:51:05 --> 404 Page Not Found: Orderlist/undefined
ERROR - 2018-09-11 14:51:33 --> 404 Page Not Found: Orderlist/undefined
ERROR - 2018-09-11 15:31:11 --> Severity: Notice --> Undefined index: sid E:\wamp\www\newMis\newMis\common\services\Order_service.php 556
ERROR - 2018-09-11 15:32:08 --> Severity: Notice --> Undefined index: sid E:\wamp\www\newMis\newMis\common\services\Order_service.php 560
ERROR - 2018-09-11 15:32:24 --> Severity: Notice --> Undefined index: sid_room E:\wamp\www\newMis\newMis\common\services\Order_service.php 560
ERROR - 2018-09-11 15:55:09 --> 404 Page Not Found: Orderlist/orderInfo
ERROR - 2018-09-11 15:57:32 --> 404 Page Not Found: Orderlist/orderInfo
ERROR - 2018-09-11 15:57:36 --> 404 Page Not Found: Orderlist/orderInfo
ERROR - 2018-09-11 15:58:21 --> 404 Page Not Found: Orderlist/orderInfo
ERROR - 2018-09-11 15:58:52 --> Severity: Notice --> Undefined index: id E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 29
ERROR - 2018-09-11 15:58:52 --> Severity: Notice --> Undefined property: orderlist::$table_order_detail E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-11 15:58:52 --> Severity: Notice --> Undefined property: orderlist::$table_item E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-11 15:58:52 --> Severity: Notice --> Undefined property: orderlist::$table_beautician E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-11 15:58:52 --> Query error: La table 'test.a' n'existe pas - Invalid query: SELECT `a`.`order_code`, `a`.`id`, `a`.`iname`, `a`.`type`, `a`.`detail_type`, `a`.`now_price`, `a`.`discount_price`, `a`.`actual_price`, `a`.`count`, `a`.`refund_num`, `a`.`refund_status`, `b`.`iusetime`, `a`.`customer`, `a`.`item_id`, `c`.`nickname` `service_bid`, `a`.`bid`, `a`.`consultant_id`, `a`.`reception_aid`, `a`.`category`, `a`.`member_discount`, `a`.`performance_money`, `course_id`, `gift_card_id`
FROM `a`
LEFT JOIN `b` ON `a`.`item_id` = `b`.`iid`
LEFT JOIN `c` ON `a`.`service_bid` = `c`.`beauticianid`
WHERE `order_code` IS NULL
ORDER BY `id` DESC
ERROR - 2018-09-11 15:59:07 --> Severity: Notice --> Undefined index: id E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 29
ERROR - 2018-09-11 15:59:07 --> Severity: Notice --> Undefined property: orderlist::$table_order_detail E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-11 15:59:07 --> Severity: Notice --> Undefined property: orderlist::$table_item E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-11 15:59:07 --> Severity: Notice --> Undefined property: orderlist::$table_beautician E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-11 15:59:07 --> Query error: La table 'test.a' n'existe pas - Invalid query: SELECT `a`.`order_code`, `a`.`id`, `a`.`iname`, `a`.`type`, `a`.`detail_type`, `a`.`now_price`, `a`.`discount_price`, `a`.`actual_price`, `a`.`count`, `a`.`refund_num`, `a`.`refund_status`, `b`.`iusetime`, `a`.`customer`, `a`.`item_id`, `c`.`nickname` `service_bid`, `a`.`bid`, `a`.`consultant_id`, `a`.`reception_aid`, `a`.`category`, `a`.`member_discount`, `a`.`performance_money`, `course_id`, `gift_card_id`
FROM `a`
LEFT JOIN `b` ON `a`.`item_id` = `b`.`iid`
LEFT JOIN `c` ON `a`.`service_bid` = `c`.`beauticianid`
WHERE `order_code` IS NULL
ORDER BY `id` DESC
ERROR - 2018-09-11 16:00:32 --> 404 Page Not Found: Orderlist/index
ERROR - 2018-09-11 16:01:08 --> 404 Page Not Found: Orderlist/index
ERROR - 2018-09-11 16:01:36 --> Severity: Notice --> Undefined index: id E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 29
ERROR - 2018-09-11 16:01:36 --> Severity: Notice --> Undefined property: orderlist::$table_order_detail E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-11 16:01:36 --> Severity: Notice --> Undefined property: orderlist::$table_item E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-11 16:01:36 --> Severity: Notice --> Undefined property: orderlist::$table_beautician E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-11 16:01:36 --> Query error: La table 'test.a' n'existe pas - Invalid query: SELECT `a`.`order_code`, `a`.`id`, `a`.`iname`, `a`.`type`, `a`.`detail_type`, `a`.`now_price`, `a`.`discount_price`, `a`.`actual_price`, `a`.`count`, `a`.`refund_num`, `a`.`refund_status`, `b`.`iusetime`, `a`.`customer`, `a`.`item_id`, `c`.`nickname` `service_bid`, `a`.`bid`, `a`.`consultant_id`, `a`.`reception_aid`, `a`.`category`, `a`.`member_discount`, `a`.`performance_money`, `course_id`, `gift_card_id`
FROM `a`
LEFT JOIN `b` ON `a`.`item_id` = `b`.`iid`
LEFT JOIN `c` ON `a`.`service_bid` = `c`.`beauticianid`
WHERE `order_code` IS NULL
ORDER BY `id` DESC
ERROR - 2018-09-11 16:03:57 --> Severity: Notice --> Undefined index: id E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 29
ERROR - 2018-09-11 16:03:57 --> Severity: Notice --> Undefined property: orderlist::$table_order_detail E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-11 16:03:57 --> Severity: Notice --> Undefined property: orderlist::$table_item E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-11 16:03:57 --> Severity: Notice --> Undefined property: orderlist::$table_beautician E:\wamp\www\newMis\newMis\framework\core\Model.php 77
ERROR - 2018-09-11 16:03:58 --> Query error: La table 'test.a' n'existe pas - Invalid query: SELECT `a`.`order_code`, `a`.`id`, `a`.`iname`, `a`.`type`, `a`.`detail_type`, `a`.`now_price`, `a`.`discount_price`, `a`.`actual_price`, `a`.`count`, `a`.`refund_num`, `a`.`refund_status`, `b`.`iusetime`, `a`.`customer`, `a`.`item_id`, `c`.`nickname` `service_bid`, `a`.`bid`, `a`.`consultant_id`, `a`.`reception_aid`, `a`.`category`, `a`.`member_discount`, `a`.`performance_money`, `course_id`, `gift_card_id`
FROM `a`
LEFT JOIN `b` ON `a`.`item_id` = `b`.`iid`
LEFT JOIN `c` ON `a`.`service_bid` = `c`.`beauticianid`
WHERE `order_code` IS NULL
ORDER BY `id` DESC
ERROR - 2018-09-11 16:32:43 --> Severity: Notice --> Undefined variable: cashier E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderlist.php 323
ERROR - 2018-09-11 16:32:43 --> Severity: Warning --> Invalid argument supplied for foreach() E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderlist.php 323
ERROR - 2018-09-11 16:38:51 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\views\orderlist\orderlist.php 290
ERROR - 2018-09-11 17:20:51 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:22:12 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:23:28 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:23:39 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:23:56 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:25:20 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:25:26 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:25:53 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:26:31 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:27:38 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:30:49 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:31:01 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:34:07 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:34:18 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:34:20 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:34:22 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 26
ERROR - 2018-09-11 17:37:40 --> Severity: Error --> Call to undefined method orderlist::post_get() E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 17
ERROR - 2018-09-11 17:40:08 --> Severity: Error --> Call to undefined method orderlist::post_get() E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 17
ERROR - 2018-09-11 18:14:36 --> Severity: Notice --> Undefined variable: role E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 39
ERROR - 2018-09-11 18:45:30 --> Severity: Notice --> Undefined index: cashier E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 41
ERROR - 2018-09-11 18:45:30 --> Severity: Notice --> Undefined index: charge E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 46
ERROR - 2018-09-11 18:45:33 --> Severity: Notice --> Undefined index: cashier E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 41
ERROR - 2018-09-11 18:45:33 --> Severity: Notice --> Undefined index: charge E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 46
ERROR - 2018-09-11 18:45:35 --> Severity: Notice --> Undefined index: cashier E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 41
ERROR - 2018-09-11 18:45:35 --> Severity: Notice --> Undefined index: charge E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 46
ERROR - 2018-09-11 18:45:38 --> Severity: Notice --> Undefined index: cashier E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 41
ERROR - 2018-09-11 18:45:38 --> Severity: Notice --> Undefined index: charge E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 46
ERROR - 2018-09-11 18:49:20 --> Severity: Error --> Call to undefined method orderlist::mktable() E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 43
ERROR - 2018-09-11 18:49:58 --> Severity: Error --> Call to undefined method orderlist::mktable() E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 43
ERROR - 2018-09-11 19:17:04 --> Severity: Notice --> Undefined index: charge E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 51
ERROR - 2018-09-11 19:40:29 --> Severity: Notice --> Undefined index: charge E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 49
ERROR - 2018-09-11 20:01:22 --> Severity: Notice --> Undefined index: order_code E:\wamp\www\newMis\newMis\htdocs_shop\controllers\Orderlist.php 52
