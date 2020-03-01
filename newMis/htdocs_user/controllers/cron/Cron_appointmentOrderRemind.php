<?php
/**
     * 消费订单提醒 
     */
class Cron_appointmentOrderRemind extends Cron_Controller
{
	
	private static $key = 'appointmentOrderRemind';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	     * 执行入口
	     * 命令行执行  cd /appRoot && /alidata/server/php/bin/php index.php cron cron_appointmentOrderRemind index
	     * @param 
	     * @return return_type
	     * @author liujing<liukai5455@163.com>
	     */
	public function index ()
	{
		$get = $this->get(self::$key);
		if(  $get['val'] === 'success' || empty($get['val']) ) {
			//开关正常 可以执行
			$set = $this->set(self::$key, 'running');
			if ( !$set ) {
				exit;
			}
			$result = $this->run();
			if( $result['msg'] === 'success' ) {
				$this->set(self::$key, 'success');
			}  elseif( $result['msg'] === 'error' ) {
				//$this->set(self::$key, 'error');
				//错误也继续
				$this->set(self::$key, 'success');
				
		    }
		}
	}
	
	protected function run()
	{
		$this->load->service('order_remind_service');
		while (1) {
			$result = $this->order_remind_service->oneAppointmentOrderRemind();
			if( $result['msg'] === 'continue' ) {
				
				//继续执行
			} elseif( $result['msg'] === 'block' ) {
				
				//跳出循环
				return array('msg' => 'success');
			} elseif( $result['msg'] === 'error' ) {
				//跳出循环
				return array('msg' => 'error');
			}else{
				return array('msg' => 'error');
			}
			
		}
		
		
	}
	
	
	
	
	
	
}	