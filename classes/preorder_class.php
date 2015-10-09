<?php
class Preorder_Class extends Order_Class{
	
	/**
	 * @brief 获取预售订单扩展数据资料
	 * @param $order_id int 订单的id
	 * @param $user_id int 用户id
	 * @return array()
	 */
	public function getOrderShow($order_id,$user_id = 0)
	{
		$where = 'id = '.$order_id;
		if($user_id !== 0)
		{
			$where .= ' and user_id = '.$user_id;
		}
	
		$data = array();
	
		//获得对象
		$tb_order = new IModel('order_presell');
		$data = $tb_order->getObj($where);
		if($data)
		{
			$data['order_id'] = $order_id;
	
			//获取配送方式
			$tb_delivery = new IModel('delivery');
			$delivery_info = $tb_delivery->getObj('id='.$data['distribution']);
			if($delivery_info)
			{
				$data['delivery'] = $delivery_info['name'];
	
				//自提点读取
				if($data['takeself'])
				{
					$data['takeself'] = self::getTakeselfInfo($data['takeself']);
				}
			}
	
			$areaData = area::name($data['province'],$data['city'],$data['area']);
			$data['province_str'] = $areaData[$data['province']];
			$data['city_str']     = $areaData[$data['city']];
			$data['area_str']     = $areaData[$data['area']];
	
			//物流单号
			$tb_delivery_doc = new IQuery('delivery_doc as dd');
			$tb_delivery_doc->join   = 'left join freight_company as fc on dd.freight_id = fc.id';
			$tb_delivery_doc->fields = 'dd.delivery_code,fc.freight_name';
			$tb_delivery_doc->where  = 'order_id = '.$order_id;
			$delivery_info = $tb_delivery_doc->find();
			if($delivery_info)
			{
				$temp = array('freight_name' => array(),'delivery_code' => array());
				foreach($delivery_info as $key => $val)
				{
					$temp['freight_name'][]  = $val['freight_name'];
					$temp['delivery_code'][] = $val['delivery_code'];
				}
				$data['freight']['freight_name']  = join(",",$temp['freight_name']);
				$data['freight']['delivery_code'] = join(",",$temp['delivery_code']);
			}
	
			//获取支付方式
			$tb_payment = new IModel('payment');
			$payment_info = $tb_payment->getObj('id='.$data['pay_type']);
			if($payment_info)
			{
				$data['payment'] = $payment_info['name'];
				$data['paynote'] = $payment_info['note'];
			}
	
			//获取商品总重量和总金额
			$tb_order_goods = new IModel('order_goods');
			$order_goods_info = $tb_order_goods->query('order_id='.$order_id);
			$data['goods_amount'] = 0;
			$data['goods_weight'] = 0;
	
			if($order_goods_info)
			{
				foreach ($order_goods_info as $value)
				{
					$data['goods_amount'] += $value['real_price']   * $value['goods_nums'];
					$data['goods_weight'] += $value['goods_weight'] * $value['goods_nums'];
				}
			}
	
			//获取用户信息
			$query = new IQuery('user as u');
			$query->join = ' left join member as m on u.id=m.user_id ';
			$query->fields = 'u.username,u.email,m.mobile,m.contact_addr,m.true_name';
			$query->where = 'u.id='.$data['user_id'];
			$user_info = $query->find();
			if($user_info)
			{
				$user_info = current($user_info);
				$data['username']     = $user_info['username'];
				$data['email']        = $user_info['email'];
				$data['u_mobile']     = $user_info['mobile'];
				$data['contact_addr'] = $user_info['contact_addr'];
				$data['true_name']    = $user_info['true_name'];
			}
		}
		return $data;
	}
	/**
	 * @brief 订单退款操作
	 * @param int $refundId 退款单ID
	 * @param int $authorId 操作人ID
	 * @param string $type admin:管理员;seller:商家
	 * @return
	 */
	public static function refund($refundId,$authorId,$type = 'admin')
	{
		$orderGoodsDB= new IModel('order_goods');
		$refundDB    = new IModel('refundment_doc');
		$orderDB     = new IModel('order_presell');
	
		
		//获取goods_id和product_id用于给用户减积分，经验
		$refundsRow = $refundDB->getObj('id = '.$refundId);
		$order_id   = $refundsRow['order_id'];
		$order_no   = $refundsRow['order_no'];
		$amount     = $refundsRow['amount'];
		$user_id    = $refundsRow['user_id'];
	
		//获取支付方式
		$pay_type = $orderDB->getField('id='.$order_id,'pay_type');
		if($pay_type==0 || $pay_type==1){//货到付款，余额支付退款到余额
			$obj = new IModel('member');
			$memberObj = $obj->getObj('user_id = '.$user_id,'balance');
			$balance = $memberObj['balance'] + $amount;
			$setData['balance'] = $balance;
			$obj->setData($setData);
			$isSuccess = $obj->update('user_id = '.$user_id);
			if($isSuccess)
			{
				//用户余额进行的操作记入account_log表
				$log = new AccountLog();
				$config = array(
						'user_id'  => $user_id,
						'event'    => 'drawback', //withdraw:提现,pay:余额支付,recharge:充值,drawback:退款到余额
						'num'      => $amount, //整形或者浮点，正为增加，负为减少
						'order_no' => $order_no // drawback类型的log需要这个值
				);
					
				if($type == 'admin')
				{
					$config['admin_id'] = $authorId;
				}
				else if($type == 'seller')
				{
					$config['seller_id'] = $authorId;
				}
					
				$re = $log->write($config);
					
			}else return false;
		}
		else if(in_array($pay_type,array(3))){
			$paymentInstance = Payment::createPaymentInstance($pay_type);
			$paymentData = Payment::getPaymentInfoForPresellRefund($pay_type,$refundId,$order_id,$amount);
			
			if(!$res=$paymentInstance->refund($paymentData[1])) return false;//验签失败
			if(!$res=$paymentInstance->refund($paymentData[0])) return false;
			
		}
		
		
		//更新退款表
		$updateData = array(
				'pay_status'   => 2,
				'dispose_time' => ITime::getDateTime(),
		);
		$refundDB->setData($updateData);
		$refundDB->update('id = '.$refundId);
	
		$orderGoodsRow = $orderGoodsDB->getObj('order_id = '.$order_id.' and goods_id = '.$refundsRow['goods_id'].' and product_id = '.$refundsRow['product_id']);
		$order_goods_id = $orderGoodsRow['id'];
	
		
		//更新退款状态，改为已退货
		$orderGoodsDB->setData(array('is_send' => 2));
		$orderGoodsDB->update('id = '.$order_goods_id);
		//更新order表状态
		$orderStatus = 10;//全部退款
		
		$orderDB->setData(array('status' => $orderStatus));
		$orderDB->update('id='.$order_id);
	
	
		//生成订单日志
		$authorName = $type == 'admin' ? ISafe::get('admin_name') : ISafe::get('seller_name');
		if($type=='system')$authorName='系统自动';
		$tb_order_log = new IModel('order_log');
		$tb_order_log->setData(array(
				'order_id' => $order_id,
				'user'     => $authorName,
				'action'   => '退款',
				'result'   => '成功',
				'note'     => '订单【'.$order_no.'】退款，退款金额：￥'.$amount,
				'addtime'  => ITime::getDateTime(),
		));
		$tb_order_log->add();
		return true;
	}
	//获取订单状态
	public static function getOrderStatus($orderRow){
		switch($orderRow['status']){
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
			case 11 : {
				return '已完成';
			}
		}
		return '未知';
	}
	//获取发货状态
	public static function getOrderDistributionStatusText($orderRow){
		
		 if($orderRow['distribution_status'] == 1)
		{
			return '已发货';
		}
		else if($orderRow['distribution_status'] == 0)
		{
			return '未发货';
		}
		
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
	/**
	 * @breif 订单的流向
	 * @param $orderRow array 订单数据
	 * @return array('时间' => '事件')
	 */
	public static function orderStep($orderRow)
	{
		$result = array();
	
		//1,创建订单
		$result[$orderRow['create_time']] = '订单创建';
	
		//2,订单支付
		if($orderRow['pay_time'])
		{
			$result[$orderRow['pay_time']] = '支付预付款  '.$orderRow['pre_amount'];
		}
	
		
		if($orderRow['confirm_time'])
		{
			$result[$orderRow['confirm_time']] = '管理员确认订单';
		}
	
		//4,订单完成
		if($orderRow['pay_time2'])
		{
			$result[$orderRow['pay_time2']] = '支付尾款   '.(number_format($orderRow['order_amount']-$orderRow['pre_amount'],2));
		}
		if($orderRow['send_time'])
		{
			$result[$orderRow['send_time']] = '订单发货完成';
		}
		if($orderRow['completion_time'])
		{
			$result[$orderRow['completion_time']] = '订单完成';
		}
		ksort($result);
		return $result;
	}
	
	/**
	 * 添加评论商品的机会
	 * @param $order_id 订单ID
	 */
	public static function addGoodsCommentChange($order_id)
	{
		//获取订单对象
		$orderDB  = new IModel('order_presell');
		$orderRow = $orderDB->getObj('id = '.$order_id);
	
		//获取此订单中的商品种类
		$orderGoodsDB        = new IQuery('order_goods');
		$orderGoodsDB->where = 'order_id = '.$order_id;
		$orderGoodsDB->group = 'goods_id';
		$orderList           = $orderGoodsDB->find();
	
		//可以允许进行商品评论
		$commentDB = new IModel('comment');
	
		//对每类商品进行评论开启
		foreach($orderList as $val)
		{
			$attr = array(
					'goods_id' => $val['goods_id'],
					'order_no' => $orderRow['order_no'],
					'user_id'  => $orderRow['user_id'],
					'time'     => date('Y-m-d H:i:s')
			);
			$commentDB->setData($attr);
			$commentDB->add();
		}
	}
}