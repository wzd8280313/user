<?php
/**
 * @date 2016-3-21
 * 后台会员管理
 *
 */
use \Library\M;
use \Library\Query;
class MemberModel{

	/**
	 *获取用户列表
     */
	public function getList($page){
		$Q = new Query('user');
		$Q->page = $page;
		$Q->pagesize = 5;
		$data = $Q->find();
		$pageBar =  $Q->getPageBar();
		return array('data'=>$data,'bar'=>$pageBar);
	}

}