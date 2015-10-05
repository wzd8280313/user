<?php
class Preorder extends IController
{
	public $checkRight  = 'all';
	public $layout='admin';
	function init()
	{
		IInterceptor::reg('CheckRights@onCreateAction');
	}
	/**
	 * @brief 预售订单列表
	 */
	public function preorder_list()
	{
		//搜索条件
		$search = IFilter::act(IReq::get('search'),'strict');
		$page   = IReq::get('page') ? IFilter::act(IReq::get('page'),'int') : 1;
		//条件筛选处理
		list($join,$where) = order_class::getSearchCondition($search);
		//拼接sql
		$orderHandle = new IQuery('order_presell as o');
		$orderHandle->order  = "o.id desc";
		$orderHandle->fields = "o.*,d.name as distribute_name,u.username,p.name as payment_name";
		$orderHandle->page   = $page;
		$orderHandle->where  = $where;
		$orderHandle->join   = $join;
	
		$this->search      = $search;
		$this->orderHandle = $orderHandle;
	
		$this->redirect("preorder_list");
	}
	/**
	 * @brief 预售订单删除功能_删除到回收站
	 */
	public function preorder_del()
	{
		//post数据
		$id = IFilter::act(IReq::get('id'),'int');
	
		//生成order对象
		$tb_order = new IModel('order_presell');
		$tb_order->setData(array('if_del'=>1));
		if($id)
		{
			$id = $tb_order->update(Util::joinStr($id));
	
			//获取订单编号
			$orderRs   = $tb_order->query('id in ('.$id.')','order_no');
			$orderData = array();
			foreach($orderRs as $val)
			{
				$orderData[] = $val['order_no'];
			}
	
			$logObj = new log('db');
			$logObj->write('operation',array("管理员:".ISafe::get('admin_name'),"预售订单移除到回收站内",'订单号：'.join(',',$orderData)));
	
			$this->redirect('preorder_list');
		}
		else
		{
			$this->redirect('preorder_list',false);
			Util::showMessage('请选择要删除的数据');
		}
	}
	/**
	 * @brief 订单删除功能_删除回收站中的数据，彻底删除
	 */
	public function order_recycle_del()
	{
		//post数据
		$id = IFilter::act(IReq::get('id'),'int');
	
		//生成order对象
		$tb_order = new IModel('order_presell');
	
		if($id)
		{
			$id = is_array($id) ? join(',',$id) : $id;
	
			Order_class::resetOrderProp($id);
	
			//删除订单
			$tb_order->del('id in ('.$id.')');
	
			//记录日志
			$logObj = new log('db');
			$logObj->write('operation',array("管理员:".ISafe::get('admin_name'),"删除回收站中退货单",'退货单ID：'.$id));
	
			$this->redirect('preorder_recycle_list');
		}
		else
		{
			$this->redirect('preorder_recycle_list',false);
			Util::showMessage('请选择要删除的数据');
		}
	}
	/**
	 * @brief 还原订单列表
	 */
	public function order_recycle_restore()
	{
		//post数据
		$id = IFilter::act(IReq::get('id'),'int');
		//生成order对象
		$tb_order = new IModel('order_presell');
		$tb_order->setData(array('if_del'=>0));
		if(!empty($id))
		{
			$tb_order->update(Util::joinStr($id));
			$this->redirect('preorder_recycle_list');
		}
		else
		{
			$this->redirect('preorder_recycle_list',false);
			Util::showMessage('请选择要还原的数据');
		}
	}
	
}