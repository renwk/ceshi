<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//自定义常量
//公共目录地址
defined('__PUBLIC__') OR define('__PUBLIC__', 'http://localhost/newMis/newMis/public/shop/');
defined('V') OR define('V', '003');

//短信接口定义 阿里云
defined('ALIYUN_ACCESS_KEY_ID') OR define('ALIYUN_ACCESS_KEY_ID', 'LTAIOVTV3LKnu0kL'); //阿里云短信服务账号id
defined('ALIYUN_ACCESS_KEY_SECRET') OR define('ALIYUN_ACCESS_KEY_SECRET', 'lBqQce2nxv5zaIFi8gGBnLbDFYsNYX'); //阿里云短信服务key

defined('SMS_MAX_TIMES_BY_MOBILE') OR define('SMS_MAX_TIMES_BY_MOBILE', 20);//在一段时间内同一个手机号最多能发送的短信次数
defined('SMS_MINUTES_BY_MOBILE') OR define('SMS_MINUTES_BY_MOBILE', 60*24); //在SMS_MINUTES_BY_MOBILE分内同一个手机号最多能发送SMS_MAX_TIMES_BY_MOBILE次
defined('SMS_MINUTES_EXPIRE') OR define('SMS_MINUTES_EXPIRE', 30);//验证码有效分钟数

defined('SMS_MAX_TIMES_BY_IP') OR define('SMS_MAX_TIMES_BY_IP', 50);//在一段时间内同一个ip最多能发送的短信次数
defined('SMS_MINUTES_BY_IP') OR define('SMS_MINUTES_BY_IP', 60*24);




defined('PHONE_KEFU') OR define('PHONE_KEFU', '010-57179167');//客服电话