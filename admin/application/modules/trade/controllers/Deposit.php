<?php 

/**
 * 保证金摘牌控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
class DepositController extends Yaf\Controller_Abstract{

	private $offer;
	public function init(){
		$this->deposit = new \nainai\order\DepositOrder();
	}

	/**
	 * 生成订单
	 */
	public function geneOrderAction(){
		$orderData['offer_id'] = safe::filterPost('offer_id','int');
		$orderData['num'] = safe::filterPost('num');

		$orderData['offer_id'] = 1;
		$orderData['num'] = 10;
		$orderData['order_no'] = tool::create_uuid();
		$orderData['user_id'] = 32;//session
		$orderData['create_time'] = date('Y-m-d H:i:s',time());
		$res = $this->deposit->geneOrder($orderData);
		die(JSON::encode($res));
	}

	//买家支付定金
	public function buyerDepositAction(){
		$orderData['id'] = safe::filter('id','int');
		$orderData['type'] = safe::filter('type');//1:全款 0:定金

		$id = 5;
		$type = 0;//1:全款 0:定金		
		$res = $this->deposit->buyerDeposit($id,$type);
		var_dump($res);
		return false;
	}

	//卖家支付保证金
	public function sellerDepositAction(){
		$order_id = safe::filter('id','int');
		$pay = safe::filter('pay');

		$order_id = 5;
		$pay = true;
		$res = $this->deposit->sellerDeposit($order_id,$pay);
		var_dump($res);
		return false;
	}

	//买家支付尾款
	public function buyerRetainageAction(){
		$order_id = safe::filter('id','int');
		$type = safe::filter('type');//online:线上 offline:线下

		$order_id = 5;
		$type = 'online';

		$res = $this->deposit->buyerRetainage($order_id,$type);
		var_dump($res);
		return false;
	}

	//卖家确认买方线下支付凭证
	public function confirmProofAction(){
		$order_id = safe::filter('id','int');
		$type = safe::filter('type');//0:未确认 1：确认

		$order_id = 5;
		$type = true;
		$res = $this->deposit->confirmProof($order_id,$type);
		var_dump($res);
		return false;
	}
}