<?php
class Session_service extends MY_Service{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function setUserSession($data)
	{
		$this->session->set_userdata('user', $data);
		return true;
	}
	
	public function getUserSession()
	{
		return $this->session->userdata('user');
	}
	
	public function clearUserSession()
	{
		return $this->session->unset_userdata('user');
		return true;
	}
	
	
	public function setWechatSession($data)
	{
		$this->session->set_userdata('wechat', $data);
		return true; 
	}
	
	public function getWechatSession()
	{
		return $this->session->userdata('wechat');
	}
	
	public function clearWechatSession()
	{
		return $this->session->unset_userdata('wechat');
		return true;
	}
	
}