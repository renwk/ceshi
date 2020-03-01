<?php

/**
     * 图片处理类 
     * @param 
     * @return return_type
     * @author liujing<liukai5455@163.com>
     */
class Photo{
	protected $domain;
	
	
	public function __construct(){
		$this->domain = PHOTO_DOMAIN;
	}
	
	public function makeUrl($path){
		return $this->domain.'/'.rtrim($path, '/');
	}
	
	
}