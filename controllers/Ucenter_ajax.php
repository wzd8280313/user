<?php
/**
 * 异步获取用户中心的数据
 * @author lenovo
 *
 */
class Ucenter_ajax extends IController
{
	public $layout = '';

	public function init()
	{
		CheckRights::checkUserRights();

		if(!$this->user)
		{
			$this->redirect('/simple/login');
		}
	}
	/*
	 * @brief 异步获取用户积分记录
	 * 
	 */
	public function get_integral(){
		$userid = $this->user['user_id'];
		$page = IReq::get('page') ? IFilter::act(IReq::get('page'),'int') : 1;
		$type = IReq::get('type') ? IFilter::act(IReq::get('type')) : 'all';
		$query = new IQuery('point_log');
		$where = '';
		if($type=='plus')$where = ' and value > 0';
		else if($type=='minus')$where = ' and value < 0';
		$query->where  = "user_id = ".$userid.$where;
		$query->page   = $page;
		$query->order= "id desc";
		$resData = $query->find();
		foreach($resData as $k=>$v){
			if($v['value']>0)$resData[$k]['value']='+'.$v['value'];
		}
		echo JSON::encode($resData);
	}
	
	
	
}