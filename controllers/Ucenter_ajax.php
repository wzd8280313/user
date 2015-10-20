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
	/**
	 * 获取订单数据
	 * 
	 */
	public function get_orderlist(){
		$userid = $this->user['user_id'];
		$page = IReq::get('page') ? IFilter::act(IReq::get('page'),'int') : 1;
		$order_db = new IQuery('order as o');
		$order_db->where = 'user_id='.$userid.' and o.if_del=0';
		$order_db->fields = 'o.*';
		$order_db->order ='o.id DESC';
		$order_db->page = $page;
		$order_data = $order_db->find();
		$ids = '';
		foreach($order_data as $k=>$v){
			$ids .=$v['id'].',';
		}
		$ids = substr($ids,0,-1);
		
		//$order_db->join = 'left join order_goods as og on o.id=og.order_id left join goods as g on og.goods_id=g.id left join seller as s on g.seller_id=s.id';
		$order_db->where = 'o.user_id='.$userid.' and o.if_del=0';
		//$order_db->fields = 'o.*,og.goods_id,og.img,og.real_price,og.goods_array,og.is_send,og.delivery_id,og.delivery_fee,g.name,s.true_name';
		$order_db->fields = ' o.*,(select og.order_id ,og.id from shop_order_goods as og  where og.order_id=389)';
		$order_db->limit = '10';
		$order_db->order ='o.id DESC';
		$data = $order_db->find();print_r($data);exit;
		$arr = JSON::decode($data[0]['goods_array']);
		foreach($data as $k=>$v){
			$goods_info = JSON::decode($v['goods_array']);
			$data[$k]['spec'] = $goods_info['value'];
		}
		print_r($data);
		echo JSON::encode($data);
	} 
	
	
}