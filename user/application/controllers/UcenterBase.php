<?php


use \Library\checkRight;
use \Library\PlUpload;
use \Library\photoupload;
use \Library\json;
use \Library\url;
use \Library\Safe;
use \Library\Thumb;
use \Library\tool;

/**
 * 用户中心的抽象基类
 */
class UcenterBaseController extends \nainai\controller\Base{

	/**
	 * 所有的用户中心列表的分页是这个
	 * @var integer
	 */
	protected $pagesize = 10;

	protected $certType = null;

	private static $certPage = array(
		'deal'=>'dealcert',
		'store'=>'storecert'
	);


	protected function init(){
		parent::init();//继承父类的方法，检测是否登录和角色
		$this->getView()->setLayout('ucenter');
		$this->cert['deal'] = 1;
		$this->user_type = 1;
		// 获取登录信息
		if(isset($this->user_id) && $this->user_id>0){
			$this->getView()->assign('login',1);
			$this->getView()->assign('username',$this->username);
		}

		else $this->getView()->assign('login',0);
		$this->getView()->assign('topArray', $this->getTopArray());
		$this->getView()->assign('leftArray', $this->getLeftArray());
		$action = $this->getRequest()->getActionName();

		// 判断该方法买家是否能操作，如果不能，跳转到用户中心首页
		if($this->user_type==0 && isset($this->sellerAction) && in_array($action,$this->sellerAction)){
			$this->redirect(url::createUrl('/ucenter/index'));
		}
		$this->getView()->assign('action', $action);
	}
    	/**
    	 * 获取头菜单的数据
    	 * @return [Array]
    	 */
    	private function getTopArray(){
    		$topArray = array(
				'UcenterIndex'      => array('url' => url::createUrl('/ucenterindex/index'), 'title' => '首页'),
				'Ucenter'  => array('url' => url::createUrl('/ucenter/baseinfo'), 'title' => '账户信息')
    		);
			if($this->cert['deal']==1){
				$topArray['Fund'] = array('url' => url::createUrl('/Fund/index'), 'title' => '资金管理');
				$topArray['Managerdeal'] = array('url' => url::createUrl('/ManagerDeal/storeProductList'), 'title' => '交易管理');
			}

			if($this->cert['store']==1){
				$topArray['Managerstore'] = array('url' => url::createUrl('/ManagerStore/ApplyStoreList'), 'title' => '仓单管理');
			}
			if(isset($this->cert['car'])&& $this->car ==1){
				$topArray['Managercar'] = array('url' => '', 'title' => '车辆管理');
			}

			$topArray['Attentioncenter'] = array('url' => '', 'title' => '关注中心');
    		$controller = $this->getRequest()->getControllerName();
    		if (!empty($topArray[$controller])) {
    			$topArray[$controller]['isSelect'] = 1;
    		}else{
    			$topArray['UcenterIndex']['isSelect'] = 1;
    		}
    		return $topArray;
    	}

    	/**
         * 获取左侧菜单数据
         * @var name [<菜单名称>]
         * @var url   [<菜单url>]
         * @var list [<子菜单的数据，key和父级菜单一致>]
         * @return [Array]
         */
    	protected function getLeftArray(){
    		return array();
    	}


    	protected function success($info = '操作成功！',$redirect = ''){
    		if(isset($redirect)){
    			$redirect = str_replace('%','_',urlencode($redirect));
    		}
    		
    		$this->redirect(url::createUrl("/Oper/success?info={$info}&redirect={$redirect}"));
    	}

    	protected function error($info = '操作失败！',$redirect = ''){

    		if(isset($redirect)){
    			$redirect = str_replace('%','_',urlencode($redirect));
    		}
    		$this->redirect(url::createUrl("/Oper/error?info={$info}&redirect={$redirect}"));
    	}
}
