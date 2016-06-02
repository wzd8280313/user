<?php
/**
 * @author panduo
 * @desc 报盘列表offers
 * @date 2016-05-05 10:07:47
 */
use \tool\http;
use \Library\url;
use \Library\safe;
use \Library\tool;
use \nainai\order\Order;
use \Library\checkRight;
class OffersController extends \Yaf\Controller_Abstract {

	private $offer;


	public function init(){
		$this->offer = new OffersModel();
	}


	//列表
	public function offerListAction(){
		$page = safe::filterGet('page','int');

		$pageData = $this->offer->getList($page);

		$this->getView()->assign('data',$pageData['data']);
		$this->getView()->assign('page',$pageData['bar']);
	}

	//支付页面
	public function checkAction(){

		$id = safe::filter($this->_request->getParam('id'),'int',1);
		$info = $this->offer->offerDetail($id);

		if(empty($info)){
			return false;
		}
		$info['amount'] = $info['minimum'] * $info['price'];
		$order_mode = new Order($info['mode']);
		$info['pay_deposit'] = $order_mode->payDepositCom($info['id'],$info['amount']);

		// $user_id = 49;//$this->user_id;
		// $orderData['offer_id'] = $id;
		// $orderData['num'] = $num;
		// $orderData['order_no'] = tool::create_uuid();
		// $orderData['user_id'] = $user_id;
		// $orderData['create_time'] = date('Y-m-d H:i:s',time());
		// $orderData['offer_type'] = $offer_type;
		// $orderData['payment'] = $payment;
		// $gen_res = $order_mode->geneOrder($orderData);
		// if($gen_res['success'] == 1){
		// 	if($order_mode instanceof order\FreeOrder || $order_mode instanceof order\EntrustOrder){
		// 		$this->redirect(url::createUrl('/Offers/paySuccess?order_no='.$orderData['order_no'].'&amount=111&payed=0&info=等待上传线下支付凭证'));
		// 	}else{
		// 		$pay_res = $order_mode->buyerDeposit($gen_res['order_id'],$paytype,$user_id);
		// 		if($pay_res['success'] == 1){
		// 			$this->redirect(url::createUrl('/Offers/paySuccess?order_no='.$orderData['order_no'].'&amount='.$pay_res['amount'].'&payed='.$pay_res['pay_deposit']));
		// 		}else{
		// 			die('预付定金失败:'.$pay_res['info']);
		// 		}
		// 	}
		// }else{
		// 	die('生成订单失败:'.$gen_res['info']);
		// }
		$this->getView()->assign('data',$info);

	}


}