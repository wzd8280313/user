<?php

use \Library\url;
use \nainai\store;
use \Library\Safe;
use \Library\Thumb;
use \nainai\offer\product;
use \Library\json;
/**
 * 仓单管理的的控制器类
 */
class ManagerStoreController extends UcenterBaseController{

	protected  $certType = 'store';
	/**
	 * 获取左侧菜单数据
	 * @var name [<菜单名称>]
	 * @var url   [<菜单url>]
	 * @var list [<子菜单的数据，key和父级菜单一致>]
	 * @return [Array]
	 */
	protected function  getLeftArray(){
	        return array(
	            array('name' => '仓单管理', 'list' => array()),
	            array('name' => '仓单管理', 'url' => url::createUrl('/ManagerStore/applyStoreList?type=2'),  'list' => array()),
	            array('name' => '仓单审核', 'url' => url::createUrl('/ManagerStore/applyStoreList?type=1'),  'list' => array())
	        );
	    }

	public function indexAction(){}

	public function addSuccessAction(){}

	/**
	 * 审核仓单列表
	 */
	public function applyStoreListAction(){
		$page = Safe::filterGet('page', 'int', 0);
		$type = $this->getRequest()->getParam('type');
		$type = Safe::filter($type,'int',1);
		$store = new store();
		if($type==1)
			$data = $store->getManagerApplyStoreList($page,$this->user_id);
		else
			$data = $store->getManagerStoreList($page,$this->user_id);

		$this->getView()->assign('statuList', $store->getStatus());
		$this->getView()->assign('storeList', $data['list']);
		$this->getView()->assign('attrs', $data['attrs']);
		$this->getView()->assign('pageHtml', $data['pageHtml']);
	}



	/**
	 * 审核仓单后，仓单签发的详情页面
	 */
	public function applyStoreSignAction(){
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);
		if (intval($id) > 0) {
			$store = new store();
			$data = $store->getManagerStoreDetail($id,$this->user_id);

			$productModel = new product();

			$this->getView()->assign('storeDetail', $data);
			$this->getView()->assign('photos', $productModel->getProductPhoto($data['pid']));
		}else{
			$this->redirect('/ManagerStore/ApplyStoreList');
		}
	}


	/**
	 * 仓单审核页面
	 */
	public function applyStoreCheckAction(){
		$category = array();
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);
		if (intval($id) > 0) {
			$store = new store();
			$data = $store->getManagerStoreDetail($id,$this->user_id);
			//获取商品分类信息，默认取第一个分类信息
		        $productModel = new product();
		        $attr_ids = array();
		        $data['attribute'] = unserialize($data['attribute']);
		        foreach ($data['attribute'] as $key => $value) {
		        		$attr_ids[] = $key;
		        }

		       $this->getView()->assign('detail', $data);
	                $this->getView()->assign('attrs', $productModel->getHTMLProductAttr($attr_ids));
	               $this->getView()->assign('photos', $productModel->getProductPhoto($data['pid']));
		}
	        
	}

	public function applyStoreDetailAction(){
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);
		if (intval($id) > 0) {
			$store = new store();
			$data = $store->getManagerStoreDetail($id,$this->user_id);

			$this->getView()->assign('storeDetail', $data);
			$this->getView()->assign('photos', $data['photos']);
		}else{
			$this->redirect('/ManagerStore/ApplyStoreList');
		}
	}

	/**
	 * 处理审核
	 * @return 
	 */
	public function doApplyStoreAction(){
		$id = Safe::filterPost('id', 'int', 0);
		if (IS_POST && intval($id) > 0) {
			$apply = array();
			$apply['status'] = (Safe::filterPost('apply', 'int', 0) == 1) ? 1 : 0;//获取审核状态

			$store = new store();
			$res = $store->storeManagerCheck($apply, $id,$this->user_id);
			die(json::encode($res)) ;
		}
		$this->redirect('ApplyStore');
	}

	/**
	 * 处理仓单签发
	 */
	public function doStoreSignAction(){
		$id = Safe::filterPost('id', 'int', 0);
		if (IS_POST && intval($id) > 0) {
			$apply = array(
				'store_pos' => safe::filterPost('pos'),
				'cang_pos'  => safe::filterPost('cang'),
				'in_time' => safe::filterPost('inTime'),
				'rent_time' => safe::filterPost('rentTime'),
				'check_org' => safe::filterPost('check'),
				'check_no'  => safe::filterPost('check_no')
			);

			if (!empty(safe::filterPost('packNumber'))) {
				$apply['package_num'] = safe::filterPost('packNumber', 'float');
				$apply['package_weight'] = safe::filterPost('packWeight', 'float');
			}

			$productData = array('quantity'=>safe::filterPost('quantity','float'));

			$store = new store();
			$res = $store->storeManagerSign($apply, $productData,$id,$this->user_id);
			die(json::encode($res)) ;
		}
		$this->redirect('ApplyStoreDetails');
	}

	/**
	 * 仓单管理页面
	 */
	public function ManagerStoreListAction(){
		$page = Safe::filterGet('page', 'int', 0);
		$store = new store();
		$data = $store->getApplyStoreList($page, $this->pagesize, $this->user_id);

		$this->getView()->assign('statuList', $store->getStatus());
		$this->getView()->assign('storeList', $data['list']);
		$this->getView()->assign('attrs', $data['attrs']);
		$this->getView()->assign('pageHtml', $data['pageHtml']);
	}

}