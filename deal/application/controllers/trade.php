<?php
/**
 *
 * @author panduo
 * @desc 报盘列表
 * @date 2016-05-05 10:07:47
 */
use \tool\http;
use \Library\url;
use \Library\safe;
use \Library\tool;
use \nainai\order;
class tradeController extends \nainai\controller\Base {

	private $offer;

	protected $certType = 'deal';
	public function init(){
		parent::init();
		$this->offer = new OffersModel();
	}

	//付款
	public function buyerPayAction(){
		$id = safe::filterPost('id','int');
		$num = safe::filterPost('num');
		$paytype = safe::filterPost('paytype');
		$account = safe::filterPost('account');

		$offer_type = $this->offer->offerType($id);

		switch ($offer_type) {
			case order\Order::ORDER_FREE:
				//自由报盘
				$order_mode = new order\FreeOrder($offer_type);
				break;
			case order\Order::ORDER_DEPOSIT:
				//保证金报盘
				$order_mode = new order\DepositOrder($offer_type);
				break;
			case order\Order::ORDER_STORE:
				//仓单报盘
				$order_mode = new order\StoreOrder($offer_type);
				break;
			case order\Order::ORDER_ENTRUST:
				//仓单报盘
				$order_mode = new order\EntrustOrder($offer_type);
				break;
			default:
				die('无效报盘方式');
				break;
		}

		
		//判断用户账户类型
		switch ($account) {
			case 1:
				//代理账户 直接余额扣款
				$payment = 1;
				break;
			case 2:
				die('票据账户支付暂时未开通，请选择代理账户');
				//票据账户
				break;
			case 3:
				die('签约账户支付暂时未开通，请选择代理账户');
				//签约账户
				break;
			default:
				die('无效账户类型');
				break;
		}

		$user_id = $this->user_id;
		$orderData['offer_id'] = $id;
		$orderData['num'] = $num;
		$orderData['order_no'] = tool::create_uuid();
		$orderData['user_id'] = $user_id;
		$orderData['create_time'] = date('Y-m-d H:i:s',time());
		$orderData['mode'] = $offer_type;
		$gen_res = $order_mode->geneOrder($orderData);

		if($gen_res['success'] == 1){
			if($order_mode instanceof order\FreeOrder || $order_mode instanceof order\EntrustOrder){
				$this->redirect(url::createUrl('/trade/paySuccess?order_no='.$orderData['order_no'].'&amount=111&payed=0&info=等待上传线下支付凭证'));
			}else{		
				$pay_res = $order_mode->buyerDeposit($gen_res['order_id'],$paytype,$user_id);
				if($pay_res['success'] == 1){
					$this->redirect(url::createUrl('/trade/paySuccess?order_no='.$orderData['order_no'].'&amount='.$pay_res['amount'].'&payed='.$pay_res['pay_deposit']));
				}else{
					die('预付定金失败:'.$pay_res['info']);	
				}
			}
		}else{
			die('生成订单失败:'.$gen_res['info']);
		}
		return false;
	}

	//支付成功页面
	public function paySuccessAction(){
		$order_no = safe::filter($this->_request->getParam('order_no'));
		$amount = safe::filter($this->_request->getParam('amount'));
		$pay_deposit = safe::filter($this->_request->getParam('payed'));
		$info = safe::filter($this->_request->getParam('info'));

		$this->getView()->assign('order_no',$order_no);
		$this->getView()->assign('amount',$amount);
		$this->getView()->assign('info',$info);
		$this->getView()->assign('pay_deposit',$pay_deposit);
	}


}