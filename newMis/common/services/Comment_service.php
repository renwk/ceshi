<?php

class Comment_service extends MY_Service{
	

	public function __construct()
	{
		parent::__construct();
	}
	
	public function lsQuestionsByBrand($brand)
	{
		$brandArray = array(
			'easy',
			'ispa'	
		);
		if( !in_array($brand, $brandArray) )	{
			return returnMsg('error_brand');
		}
		
		$this->load->model('order_questions_model');
		$questions = $this->order_questions_model->lsByBrand($brand);
		if( $questions ) {
			$length = 3;//随机取3个问题
			shuffle($questions);
			$questions = array_slice($questions, 0, $length);
		}
		return returnMsg('success', $questions);
	}
	
	public function addComment($uuid, $orderId, $content, $scoreArray, $answerArray)
	{
		if( empty($uuid) ) {
			return returnMsg('error_uuid');
		}
		if( !isId($orderId) ) {
			return returnMsg('error_orderid');
		}
		if( empty($scoreArray) || !is_array($scoreArray) ) {
			return returnMsg('error_scoreArray');
		}
		
		$this->load->model('comment_model');
		$oneComment = $this->comment_model->oneByUidAndOrderid($uuid, $orderId);
		if( $oneComment ) {
			return returnMsg('error_already_comment');
		}
		//验证订单
		$this->load->model('order_model');
		$order = $this->order_model->one($orderId);
		if( empty($order) ) {
			return returnMsg('error_order');
		} 
		if( $order['user_id'] !== $uuid ) {
			return returnMsg('error_order');
		}
		
		//验证项目
		$orderCode = $order['order_code'];
		$this->load->model('order_detail_model');
		$item = $this->order_detail_model->lsByCode($orderCode);
		if( empty($item) ) {
			return returnMsg('error_item');
		}
		
		$itemIdArray = array_column($item, 'item_id');
		
		$scoreServiceEnvironment = 0;//服务环境评分
		$scoreServiceAll = 0;//整体服务评分
		$scoreItems = array();
		
		foreach ($scoreArray as $key => $val) {
			
			if( $val['item_id'] == 'service_environment' ) {
				$scoreServiceEnvironment = $val['score'];
			}
			
			if( $val['item_id'] == 'service_all' ) {
				$scoreServiceAll = $val['score'];
			}
			
			if( isId($val['item_id']) ) {
				//验证项目
				if( !in_array($val['item_id'], $itemIdArray) ) {
					return returnMsg('error_itemid');
				}
				$scoreItems[] = array(
					'item_id' => $val['item_id'],
					'score' => intval($val['score'])
				);
			}
			
		}
		
		if( empty($scoreServiceEnvironment) ) {
			return returnMsg('error_score_environment');
		}
		if( empty($scoreServiceAll) ) {
			return returnMsg('error_score_all');
		}
		if( empty($scoreItems) ) {
			return returnMsg('error_items');
		}
		
		
		
		if( !empty($answerArray) ) {
			
			foreach ($answerArray as $k => &$v) {
				
				if( !isId($v['question_id'] ) ) {
					return returnMsg('error_question_id');
				}
				$v['answer'] = $v['answer'] === 'no' ? 'no' : 'yes';
			}
			
		}
		
		$add = $this->comment_model->add($uuid, $orderId, $content, $scoreItems, $scoreServiceEnvironment, $scoreServiceAll, $answerArray);
		if( !$add ) {
			return returnMsg('error_add');
		}
		return returnMsg('success');
	}
	
	
	
	
}	