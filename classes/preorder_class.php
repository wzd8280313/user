<?php
class Preorder_Class extends Order_Class{
	
	
	//获取订单状态
	public static function getOrderStatus($status){
		switch($status){
			case 1 : {
				return '提交订单';
			}
			case 2 : {
				return '订单取消';
				
			}
			case 3 : {
				return '支付预付款';
			}
			case 4 : {
				return '订单确认';
			}
			case 5 : {
				return '后台未确认，作废';
			}
			case 6 : {
				return '后台确认未通过，作废';
				
			}
			case 7 : {
				return '支付尾款';
				
			}
			case 8 : {
				return '超期未付尾款';
				
			}
			case 9 : {
				return '已发货';
			}
			case 10 : {
				return '已退款';
			}
		}
		return '未知';
	}
	//获取订单支付状态
	public static function getOrderPayStatusText($orderRow)
	{
		if($orderRow['pay_status'] == 0)
		{
			return '未付款';
		}
		else if($orderRow['pay_status'] == 1)
		{
			return '支付预付款';
		}
		else if($orderRow['pay_status'] == 2){
			return '支付尾款';
		}
		return '未知';
	}
	/**
	 * 支付成功后修改订单状态
	 * @param $orderNo  string 订单编号
	 * @param $admin_id int    管理员ID
	 * @param $note     string 收款的备注
	 * @return false or int order_id
	 */
	public static function updateOrderStatus($orderNo,$admin_id = '',$note = '')
	{
		if(stripos($orderNo,'pre') !== false)
		{
			$type    = 1;
			$orderNo = str_replace('pre','',$orderNo);
			$dataArray = array(
					'status'     => 3,
					'pay_time'   => ITime::getDateTime(),
					'pay_status' => 1
			);
			
		}else{
			$type    = 0;
			$orderNo = str_replace('wei','',$orderNo);
			$dataArray = array(
					'status'     => 7,
					'pay_time2'   => ITime::getDateTime(),
					'pay_status' => 2
			);
		}
		
		//获取订单信息
		$orderObj  = new IModel('order_presell');
		$orderRow  = $orderObj->getObj('order_no = "'.$orderNo.'"');
	
		if(empty($orderRow))
		{
			return false;
		}
	
		if($orderRow['pay_status'] == 2)
		{
			return $orderRow['id'];
		}
		else
		{
			$orderObj->setData($dataArray);
			$is_success = $orderObj->update('order_no = "'.$orderNo.'"');
			if($is_success == '')
			{
				return false;
			}
	
			//删除订单中使用的道具
			$ticket_id = trim($orderRow['prop']);
			if($ticket_id != '')
			{
				$propObj  = new IModel('prop');
				$propData = array('is_userd' => 1);
				$propObj->setData($propData);
				$propObj->update('id = '.$ticket_id);
			}
	
			if(intval($orderRow['user_id']) != 0)
			{
				$user_id = $orderRow['user_id'];
	
				//获取用户信息
				$memberObj  = new IModel('member');
				$memberRow  = $memberObj->getObj('user_id = '.$user_id,'prop,group_id');
	
				//(1)删除订单中使用的道具
				if($ticket_id != '')
				{
					$finnalTicket = str_replace(','.$ticket_id.',',',',','.trim($memberRow['prop'],',').',');
					$memberData   = array('prop' => $finnalTicket);
					$memberObj->setData($memberData);
					$memberObj->update('user_id = '.$user_id);
				}
	
				
			}
	
			//插入收款单
			$collectionDocObj = new IModel('collection_doc');
			$collectionData   = array(
					'order_id'   => $orderRow['id'],
					'user_id'    => $orderRow['user_id'],
					'time'       => ITime::getDateTime(),
					'payment_id' => $orderRow['pay_type'],
					'if_del'     => 0,
					'note'       => $note,
					'admin_id'   => $admin_id ? $admin_id : 0
			);
			if($type ==1){
				$collectionData['amount'] = $orderRow['pre_amount'];
				$collectionData['pay_status'] = 3;
			}else{
				$collectionData['amount'] = $orderRow['pre_amount'];
				$collectionData['pay_status'] = 3;
			}
			$collectionDocObj->setData($collectionData);
			$collectionDocObj->add();
	
			return $orderRow['id'];
		}
		
	}
}