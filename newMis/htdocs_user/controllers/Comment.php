<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($orderId)
	{
		$this->load->service('order_service');
		$order = $this->order_service->oneConsumption($orderId, $this->user['uuid']);
		
		if(  $order['msg'] !== 'success' || empty($order['data']) ) {
			exit('error_order');
		}
		
		$storeBrand = $order['data']['store']['brand'];
		
		$this->load->service('comment_service');
		$questions = $this->comment_service->lsQuestionsByBrand($storeBrand);
		
		$data = array();
		$data['order'] = $order['data'];
		$data['questions'] = $questions['data'];
		
		$this->load->view('glob/header.php');
		$this->load->view('comment/index.php', $data);
		$this->load->view('glob/footer.php');
	}
	
	public function actionComment()
	{
		$scoreJson    = $this->input->post('score');
		$answerJson = $this->input->post('answer');
		$orderId       = $this->input->post('order_id');
		$content       = $this->input->post('content');
		
		$scoreArray = json_decode($scoreJson, true);
		$answerArray = json_decode($answerJson, true);
		
		$this->load->service('comment_service');
		$add = $this->comment_service->addComment($this->user['uuid'], $orderId, $content, $scoreArray, $answerArray);
		switch ($add['msg']) {
			case 'success':
				exit('success');
				break;
			case 'error_scoreArray':
				exit('请对服务进行评分');
			case 'error_already_comment':
				exit('您已经评过分了');	
			default:
				exit('网络链接错误，请稍后再试');
				break;
		}
	}
	
	
	
}