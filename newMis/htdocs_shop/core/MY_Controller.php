<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    protected $user;
    protected $wechat;

    public function __construct()
    {
        parent::__construct();

        $this->load->service('session_service');
        $this->user = $this->session_service->getUserSession();
        $this->wechat = $this->session_service->getWechatSession();
    }
}
    /**
     *
     * 用于crontab的基类控制器 只能在cli下运行
     *
     * @date  2017-7-21
     * @author liujing<liukai5455@163.com>
     * @history
     * -
     *  2017-7-21  Create by liujing
     * -
     * @copyright Copyright  (c) 2017 - 2017 liujing Inc. All Rights Reserved.
     */
class Cron_Controller extends CI_Controller {

    public function __construct() {

        parent::__construct();
        if (!is_cli()) {
            exit('NOT CLI' . PHP_EOL);
        }
        set_time_limit(0); //cli执行 不过期
        //可以执行的开关需要在cronswitch_service里面设置 只有定义的开关才能够执行
        $this->load->service('cronswitch_service');
    }

    /**
     * 设置开关的值
     * @param $key
     * @return bool
     * @author liujing<liukai5455@163.com>
     */
    public function set($key, $val) {
        return $this->cronswitch_service->set($key, $val);
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
        return $this->cronswitch_service->get($key);
    }
}

