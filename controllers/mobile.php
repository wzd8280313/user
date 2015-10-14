<?php
class Mobile extends IController
{
	public $layout='site';

	function init()
	{
		CheckRights::checkUserRights();
	}
	
	function getMoreProlist(){
		$childCat = IFilter::act(IReq::get('childCat'));
		$pagesize = 3;
		$goodsObj = search_goods::find(array('category_extend' => $childCat),$pagesize);
		$resultData = $goodsObj->find();
		
		if($goodsObj->page==0){
			echo 0;exit;
		}
		$seller = new IModel('seller');
		$seller_arr = array();
		$seller_arr[0]='平台自营';
		foreach($resultData as $k=>$v){
			if(!isset($seller_arr[$v['seller_id']])){
				$seller_arr[$v['seller_id']]=$seller->getField('id='.$v['seller_id'],'true_name');
			}
		}
		
		echo JSON::encode($resultData);
	}
	
}