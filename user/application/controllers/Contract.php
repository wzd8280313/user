<?php
/**
 * 卖方合同管理
 * @author: panduo 
 * @Date: 2016-04-28 10:20:57
 */
use \Library\json;
use \Library\url;
use \Library\Safe;
use \Library\Thumb;
use \Library\tool;
class ContractController extends UcenterBaseController{

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
                array('url' => url::createUrl('/Delivery/deliveryList?is_seller=0'), 'title' => '购买提单列表' ),
                array('url' => url::createUrl('/Delivery/deliveryList?is_seller=1'), 'title' => '销售提单列表' ),
            ))
		);
    }

	public function sellerListAction(){
		$user_id = $this->user_id;
		$order = new \nainai\order\Order();
		// $page = $this->_request->getParam('page');
		$page = safe::filterGet('page','int',1);
		$name = safe::filterPost('name');
		$where = array();
		if(!empty($name)){
			$where []= array(" and p.name = :name ",array('name'=>$name)); 
		}
		$list = $order->sellerContractList($user_id,$page,$where);
		$this->getView()->assign('data',$list['data']);
		$this->getView()->assign('page',$list['bar']);
	}


	public function depositListAction(){
		$user_id = $this->user_id;
		$deposit = new \nainai\order\DepositOrder();

		// $page = $this->_request->getParam('page');
		$page = safe::filterGet('page','int',1);
		$name = safe::filterPost('name');
		$where = array();
		if(!empty($name)){
			$where []= array(" and p.name = :name ",array('name'=>$name)); 
		}
		$list = $order->sellerContractList($user_id,$page,$where);
		$this->getView()->assign('data',$list['data']);
		$this->getView()->assign('page',$list['bar']);
	}

	public function storeListAction(){
		$user_id = $this->user_id;
		$store = new \nainai\order\StoreOrder();
		// $page = $this->_request->getParam('page');
		$page = safe::filterGet('page','int',1);
		$name = safe::filterPost('name');
		$where = array();
		if(!empty($name)){
			$where []= array(" and p.name = :name ",array('name'=>$name)); 
		}
		$list = $store->storeContractList($user_id,$page,$where);
		$this->getView()->assign('data',$list['data']);
		$this->getView()->assign('page',$list['bar']);
	}

	public function sellerDetailAction(){
		$id = safe::filter($this->_request->getParam('id'),'int');
		$order = new \nainai\order\Order();
		$info = $order->contractDetail($id,'seller');
		$this->getView()->assign('info',$info);
	}

	//购买合同列表
	public function buyerListAction(){
		$user_id = $this->user_id;
		$order = new \nainai\order\Order();
		// $page = $this->_request->getParam('page');
		$page = safe::filterGet('page','int',1);
		$name = safe::filterPost('name');
		$where = array();
		if(!empty($name)){
			$where []= array(" and p.name = :name ",array('name'=>$name)); 
		}
		$list = $order->buyerContractList($user_id,$page,$where);
		$this->getView()->assign('data',$list['data']);
		$this->getView()->assign('page',$list['bar']);
	}

	//购买合同详情
	public function buyerDetailAction(){
		$id = safe::filter($this->_request->getParam('id'),'int');
		$order = new \nainai\order\Order();
		$info = $order->contractDetail($id);
		$this->getView()->assign('info',$info);
	}

}