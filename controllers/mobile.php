<?php
class Mobile extends IController
{
	public $layout='site';

	function init()
	{	//校验注册信息
		CheckRights::checkUserRights();
	}
	
	function getMoreProlist(){
		$childCat = IFilter::act(IReq::get('childCat'));
		$pagesize = 10;
		$goodsObj = search_goods::find(array('category_extend' => $childCat),$pagesize);
		self::getGoodsList($goodsObj);
	}
	//获取更多搜索产品
	function getMoreSearchList(){
		$pagesize = 3;
		$word = IFilter::act(IReq::get('word'));
		$word='新西';
		$cat_id = IFilter::act(IReq::get('cat_id'),'int');
		$defaultWhere = array('search' => $word , 'category_extend' => $cat_id );
		$goodsObj = search_goods::find($defaultWhere,$pagesize);
		//var_dump($goodsObj);
		self::getGoodsList($goodsObj);
		
	}
	
	function getGoodsList($goodsObj){
		$resultData = $goodsObj->find();
		//var_dump($resultData);
		if($goodsObj->page==0){
			echo 0;exit;
		}
		$seller = new IModel('seller');
		$seller_arr = array();
		$seller_arr[0]='平台自营';
		
		foreach($resultData as $k=>$v){
			if(!isset($seller_arr[$v['seller_id']])){
				$seller_arr[$v['seller_id']]=$seller->getField('id='.$v['seller_id'],'true_name');
				var_dump($seller_arr);
			}
		}
		
		echo JSON::encode($resultData);exit;
	}
	//获取分类列表
	public function getCategoryList(){
		$m_category=new IModel('category');
		$where=array(
			'parent_id'=>0
		);
		$c_list=$m_category->query();
		
		$result=$this->getTreeList($c_list);
		echo JSON::encode($result);
		
	}
	//递归获取所有父类下子分类
	public function getTreeList($list,$pid=0,$deep=0){
		static $treeList=array();
		//var_dump($list);
		foreach($list as $k=>$v){
			if($v['parent_id']==$pid){
			$v['deep']=$deep;
				$treeList[]=$v;
			//echo 1;
			$this->getTreeList($list,$v['id'],$deep+1);
			}

		}
		return $treeList;
	}
	//获取所有品牌
	public function getBrandList(){
		$m_brand=new IModel('brand_category');
		$b_list=$m_brand->query();
		echo JSON::encode($b_list);


	}
	//获得所有商品品牌
	public function getGoodsBrand(){
		//取得品牌id
		$id=IFilter::act(IReq::get('id'));
		$m_brand=new IModel('brand');
		$result=$m_brand->query('category_ids like "%'.$id.'%"');
		//var_dump($result);
		echo JSON::encode($result);
		//$sql="select * from shop_brand as b left join shop_brand_category as c where ".$id.' in(b.category_ids)';
	}
	//获取最新，最热，商品
	public function getHotGoods(){
		$type=IFilter::act(IReq::get('type'));
		//var_dump($type);
		$m_goods=new IModel('goods');
		$where='is_del=3';
		$cols='*';
		switch($type){
			case "hot":
			$order="sale";
			break;
			case "new":
			$order="up_time";
			break;
			default :
			$order="";

		}
		//$order='visit';
		$desc='DESC';
		$limit=5;
		$hotList=$m_goods->query($where,$cols,$order,$desc,$limit);
		/*foreach($hotList as $k=>$v){
			$v['content']=IFilter::string($v['content']);

		}*/
		echo JSON::encode($hotList);
	}
/*	public function getNewGoods(){
		$m_goods=new IModel('goods');
		$where='is_del=0';
		$cols='*';
		$order='up_time';
		$desc='DESC';
		$limit=5;
		$NewList=$m_goods->query($where,$cols,$order,$desc,$limit);
		echo JSON::encode($NewList);
	}*/
	//团购数据
	public function getRegiment(){
		//实例化团购表
		$m_regiment=new IModel('regiment');
		/*$where=array(
			'is_close'=>0
		);*/
		$where='is_close=0';
		//排序
		$order='sort';
		//字段
		$cols='*';

		$re_list=$m_regiment->query($where,$cols,$order);
		
		//$result=$this->getTreeList($c_list);
		echo JSON::encode($re_list);

	}
	//特价商品
	public function getTejia(){
		$m_goods=new IQuery('goods as go');
		$m_goods->fileds='go.*';
		$m_goods->join='left join commend_goods  as c on go.id=c.goods_id';
		$m_goods->where='c.commend_id=3';
		$m_goods->limit='5';
		$result=$m_goods->find();
		echo JSON::encode($result);
	}
	public function getTuijian(){
		$comment_id=IFilter::act(IReq::get('commend_id'));
		$page=IFilter::act(IReq::get('page')) ? IFilter::act(IReq::get('page')):1;
		switch ($comment_id) {
			case '3':
				$where='c.commnet_id=3';
				break;
			
			case '1':
				$where='c.comment_id=1';
				break;
			case '3':
				$where='c.comment_id=3';
				break;
			case '4':
				$where='c.comment_id=4';
		}
		$m_goods=new IQuery('goods as go');
		$m_goods->fileds='go.*';
		$m_goods->join='left join commend_goods as c on go.id=c.goods_id';
		$m_goods->where=$where;
		$m_goods->page=$page;
		$m_goods->pagesize=1;
		$result=$m_goods->find();
		//var_dump($result);
	}
	
}