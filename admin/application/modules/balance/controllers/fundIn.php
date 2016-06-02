<?php
/*
入金审核
author  wzd
Date:2016/5/4
 */
use Library\adminrbac\rbac;
use Library\JSON;
use Library\M;
use Library\Query;
use Library\safe;
use nainai\fund;
use \Library\url;
use \Library\tool;

class fundInController extends Yaf\Controller_Abstract {


	public function init() {
		$this->getView()->setLayout('admin');
	}
	//线上列表
	public function onlineListAction() {
		$page = safe::filterGet('page', 'int');
		$fundObj = new fundInModel();
		$data = $fundObj->getOnlineList($page);

		//分配数据
		$this->getView()->assign('onlineInfo', $data[0]);
		$this->getView()->assign('reBar', $data[1]);
		//
	}
	//线下列表
	public function offlineListAction() {
		$page = safe::filterGet('page', 'int');
		$fundObj = new fundInModel();
		$data = $fundObj->getOffLineList($page);
		//分配数据
		$this->getView()->assign('offlineInfo', $data[0]);
		$this->getView()->assign('reBar', $data[1]);

	}
	//线下详情页
	public function offlineEditAction() {
		//判断当前用户有没有终审的权限

		$id = safe::filterGet('id', 'int');
		$fundObj = new fundInModel();
		$data = $fundObj->offLineDetail($id);
		$data['proot'] = \Library\Thumb::get($data['proot'],300,200);
		$controllerName = $this->getRequest()->getControllerName();
		$moduleName = $this->getRequest()->getModuleName();
		$data['url'] = \Library\url::createUrl($moduleName.'/'.$controllerName.'/'.$data['action']);


		$this->getView()->assign('reInfo', $data);

	}
	//初审
	public function offlineFirstAction() {

		$id = safe::filterPost('re_id', 'int');
		$status = safe::filterPost('status', 'int');
		$mess  = safe::filterPost('message');
		$fundObj = new fundInModel();

		$res = $fundObj->offLineFirst($id,$status,$mess);//初审操作

		die(json::encode($res));
	}
	//终审
	public function offlineFinalAction() {
		$id = safe::filterPost('re_id', 'int');
		$status = safe::filterPost('status', 'int');
		$mess  = safe::filterPost('message');

		$fundObj = new fundInModel();

		$res = $fundObj->offLineFinal($id,$status,$mess);//终审操作

		die(json::encode($res));

	}

	/**
	 *
	 */
	public function delAction() {
		$id = safe::filterGet('id', 'int');

		$fundObj = new fundInModel();

		if($fundObj->logicDel($id)){

		}



	}
}

?>