<?php 

/**
 * 保证金摘牌控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;
use \Library\M;

class DepositController extends OrderController{

	protected function  getLeftArray(){
        return array(
			array('name' => '交易管理', 'list' => array()),
			array('name' => '销售管理', 'list' => array(
				array('url' => url::createUrl('/ManagerDeal/productlist'), 'title' => '销售列表','action'=>array('productlist') ),
				array(
					'url' => url::createUrl('/ManagerDeal/indexOffer'),
					'title' => '发布产品' ,
					'action' => array('indexoffer','freeoffer','depositoffer','deputeoffer','storeoffer'),//action都用小写

				),
			)),
			array('name' => '仓单管理', 'list' => array(
				array('url' => url::createUrl('/ManagerDeal/storeProduct'), 'title' => '申请仓单','action'=>array('storeproduct') ),
				array('url' => url::createUrl('/ManagerDeal/storeProductList'), 'title' => '仓单列表','action'=>array('storeproductlist','storeproductdetail') ),
			)),
			array('name' => '采购管理', 'list' => array(
				array('url' => '', 'title' => '采购列表' ),
				array('url' => '', 'title' => '发布采购' ),
			)),
			array('name' => '合同管理', 'list' => array(
				array('url' => url::createUrl('/Contract/sellerList'), 'title' => '销售合同' ,'action'=>array('depositlist')),
				array('url' => url::createUrl('/Contract/buyerList'), 'title' => '购买合同' ),
			)),
            array('name' => '提货管理', 'list' => array(
                array('url' => url::createUrl('/Delivery/buyerDeliveryList'), 'title' => '购买提单列表' ),
                array('url' => url::createUrl('/Delivery/sellerDeliveryList'), 'title' => '销售提单列表' ),
            ))
		);
    }

	//卖家支付保证金
	public function sellerDepositAction(){
		$pay = safe::filter($this->_request->getParam('pay'));
		$order_id = intval($this->_request->getParam('order_id'));
		if($pay){
			// $pay = safe::filter('pay');
			$pay = true;
			$user_id = $this->user_id;
			$res = $this->deposit->sellerDeposit($order_id,$pay,$user_id);
			if($res['success'] == 1)
				$this->redirect(url::createUrl('/Deposit/suc'));
			else
				$this->error($res['info']);
			return false;
		}else{
			$data = $this->deposit->contractDetail($order_id,'seller');
			$sys_percent_obj = new M('scale_offer');//后台配置保证金基数比例
			$sys_percent = $sys_percent_obj->where(array('id'=>1))->getField('deposite');
			//获取当前用户等级保证金比例
			$user = new \nainai\member();
			$user_percent = $user->getUserGroup($this->user_id);//当前用户id
			if($user_percent === false){
				$this->error('用户错误');
			}

			$percent = floatval($sys_percent) * floatval($user_percent['caution_fee']);
			$data['seller_percent'] = $percent / 100;
			$data['seller_deposit'] = number_format($data['amount'] * $percent / 10000,2);
			$this->getView()->assign('data',$data);
		}
	}

	//支付保证金成功页面
	public function sucAction(){}

}