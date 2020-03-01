<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends MY_Controller {


	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		
		$this->load->service('order_service');
		$list = $this->order_service->appointmentList($this->user['uuid']);
		
		$data = array();
		$data['list'] = $list['data'];
		
		$this->load->view('glob/header.php');
		$this->load->view('appointment/index.php', $data);
		$this->load->view('glob/footer.php');
	}
	
	
	
	
	
}