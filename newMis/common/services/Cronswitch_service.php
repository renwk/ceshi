<?php

/**
 *  crontab 开关操作相关
 *
 */
class Cronswitch_service extends MY_Service {

    //允许执行的key开关
    public static $defAllowKey = array(
        'consumptionOrderRemind' => array(
            'desc' => '消费订单消息提醒'
        ),
    	'appointmentOrderRemind' => array(
    		'desc' => '预约订单消息提醒'
    	),
    	'wxpayNotifyHandle' => array(
    		'desc' => '微信支付通知后台事件处理'
    	),
    	'giveIbExpired' => array(
    		'desc' => '赠送爱币自动过期'
    	),
    );

    public function __construct() {
        parent::__construct();
    }

    /**
     * 查询是否为允许的开关
     * @param $key
     * @return bool
     * @author liujing<liukai5455@163.com>
     */
    private static function isDefKey($key) {
        if ( array_key_exists($key, self::$defAllowKey) ) {
            return self::$defAllowKey[$key];
        } else {
            return false;
        }
    }

    /**
     * 设置开关的值
     * @param $key
     * @return bool
     * @author liujing<liukai5455@163.com>
     */
    public function set($key, $val) {
        if (!self::isDefKey($key)) {
            return false;
        }
        $data = array(
            'val' => $val,
            'tm' => time(),
        );

        $this->load->driver('cache');
        return $this->cache->file->save($key, serialize($data), 20 * 24 * 3600);
    }

    /**
     * 获取开关的值
     * @param $key
     * @return array(
     *     'val' => '',
     *     'tm' =>
     * )
     * @author liujing<liukai5455@163.com>
     */
    public function get($key) {
        if (!self::isDefKey($key)) {
            return array('val' => 'error_def');
        }

        $this->load->driver('cache');

        $get = $this->cache->file->get($key);
        if (!$get) {
            return array('val' => '', 'tm' => time());
        }
        $data = unserialize($get);
        return $data;
    }

}
