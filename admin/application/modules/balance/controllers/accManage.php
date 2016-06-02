<?php
/*
会员账户管理
author:wangzhande
Date:2016/5/10
 */
use Library\Query;
use Library\Safe;

class accManageController extends Yaf\Controller_Abstract {
	//会用账户列表
	public function init() {
		$this->getView()->setLayOut('admin');

	}
	public function userAccListAction() {
		$page = safe::filterGet('page', 'int');
		$accObj = new Query('user_account as a');
		$accObj->join = 'left join user as u on a.user_id = u.id';
		$accObj->fields = 'a.*,u.username,u.mobile,u.create_time';
		$accObj->page = $page;
		$accInfo = $accObj->find();
		$accBar = $accObj->getPageBar();
		foreach ($accInfo as $k => $v) {
			$accInfo[$k]['amount'] = $v['fund']+$v['freeze'];
		}
		//$accInfo['amount'] = $accInfo['fund']+$accInfo['freeze'];
		$this->getView()->assign('accInfo', $accInfo);
		$this->getView()->assign('accBar', $accBar);

	}
	public function userAccInfoAction() {
		echo "<br />";
		echo "<br />";
		$page = safe::filterGet('page', 'int');
		$id = safe::filterGet('user_id', 'int');

		$fundFlowObj = new Query('user_fund_flow as f');
		$fundFlowObj->join = 'left join user as u on u.id=f.user_id';
		$fundFlowObj->fields = 'u.username,f.*';
		$fundFlowObj->where = 'f.user_id= :user_id';
		$fundFlowObj->bind = array('user_id' => $id);
		$fundFlowObj->page = $page;
		$userAccInfo = $fundFlowObj->find();
		$userAccBar = $fundFlowObj->getPageBar();
		$this->getView()->assign('userAccBar', $userAccBar);
		$this->getView()->assign('userAccInfo', $userAccInfo);

	}
}

?>