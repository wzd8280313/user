<?php 
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;

class OrderController extends UcenterBaseController{

	public function init(){
		parent::init();
        // $right = new checkRight();
        // $right->checkLogin($this);//未登录自动跳到登录页
        // $this->getView()->setLayout('ucenter');
        $this->order = new \nainai\order\Order;
        $this->free = new \nainai\order\FreeOrder();
		$this->deposit = new \nainai\order\DepositOrder();
		$this->store = new \nainai\order\StoreOrder();
		$this->entrust = new \nainai\order\EntrustOrder();
	}

	//买家支付尾款
	public function buyerRetainageAction(){

		if(IS_POST){
			$order_id = safe::filterPost('order_id','int');
			$type = safe::filterPost('payment');
			$proof = safe::filterPost('imgproof');

			$user_id = $this->user_id;
			$res = $this->order->buyerRetainage($order_id,$user_id,$type,$proof);
			if($res['success'] == 1){
				$title = $type == 'offline' ? '已上传支付凭证' : '已支付尾款';
				$info = $type == 'offline' ? '请等待卖家确认凭证' : '合同已生效，可申请提货';

				$this->redirect(url::createUrl('/Order/payRetainageSuc')."/title/$title/info/$info");
			}else{
				$this->error($res['info']);
			}
			return false;
		}else{
			$order_id = safe::filter($this->_request->getParam('order_id'),'int');
			$data = $this->order->contractDetail($order_id);
			$data['pay_retainage'] = number_format(floatval($data['amount']) - floatval($data['pay_deposit']),2);
			$this->getView()->assign('show_online',$data['mode'] == \nainai\order\Order::ORDER_DEPOSIT || $data['mode'] == \nainai\order\Order::ORDER_STORE ? 1 : 0);
			$this->getView()->assign('data',$data);
		}
	}
	
	//支付尾款成功
	public function payRetainageSucAction(){
		$this->getView()->assign('title',safe::filter($this->_request->getParam('title')));
		$this->getView()->assign('info',safe::filter($this->_request->getParam('info')));
	}

	//确认线下支付凭证页面
	public function confirmProofPageAction(){
		$order_id = intval($this->_request->getParam('order_id'));
		$info = $this->order->contractDetail($order_id);
		$info['proof_thumb'] = \Library\Thumb::get($info['proof'],400,400);
		$this->getView()->assign('data',$info);
	}

	//卖家确认买方线下支付凭证
	public function confirmProofAction(){
		$order_id = intval($this->_request->getParam('order_id'));
		$type = safe::filter('type');//0:未确认 1：确认
		$type = true;
		$user_id = $this->user_id;
		$res = $this->order->confirmProof($order_id,$user_id,$type);
		if($res['success'] == 1)
			$this->success('操作成功',url::createUrl("/Contract/sellerlist"));
		else
			$this->error($res['info']);

		return false;
	}

	//扣减货款页面
	public function verifyQaulityPageAction(){
		$order_id = safe::filter($this->_request->getParam('order_id'),'int',0);		
		$this->getView()->assign('order_id',$order_id);
	}

	//提货完成后买家确认订单货物质量
	public function verifyQaulityAction(){
		if(IS_POST){
			$order_id = safe::filterPost('order_id');
			$info = $this->order->orderInfo($order_id);
			$amount = $info['amount'];
			$reduce_amount = safe::filterPost('amount','floatval');
			$reduce_amount = !$reduce_amount || $reduce_amount > $amount || $reduce_amount < 0 ? 0 : $reduce_amount;
			if(!$reduce_amount){
				die('扣款金额错误');
			}
			$reduceData['reduce_amount'] = $reduce_amount;
			$reduceData['reduce_remark'] = safe::filterPost('remark');
			$res = $this->order->verifyQaulity($order_id,$reduceData);
		}else{
			$order_id = safe::filter($this->_request->getParam('order_id'));
			$res = $this->order->verifyQaulity($order_id);
		}

		if($res['success'] == 1)
			$this->success('已确认货物质量',url::createUrl('/Contract/buyerlist'));
		else
			$this->error($res['info']);
		return false;
	}

	//卖家确认质量 
	public function sellerVerifyAction(){
		$reduce = safe::filter($this->_request->getParam('reduce'));
		$order_id = safe::filter($this->_request->getParam('order_id'));

		if(!$reduce){
			$res = $this->order->sellerVerify($order_id);
			if($res['success'] == 1)
				$this->success('已确认货物质量',url::createUrl('/Contract/sellerlist'));
			else 
				$this->error($res['info']);
			return false;
		}else{
			$info = $this->order->orderInfo($order_id);
			$this->getView()->assign('data',$info);	
		}
	}

	//买家确认合同结束
	public function contractCompleteAction(){
		$order_id = safe::filter($this->_request->getParam('order_id'));
		$res = $this->order->contractComplete($order_id);
		if($res['success'] == 1)
			$this->success('合同已结束',url::createUrl("/Contract/buyerlist"));
		else
			$this->error($res['info']);
		return false;
	}
}
