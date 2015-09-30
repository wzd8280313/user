<?php
/**
 * @file sendgoods.php
 * @brief 发货接口
 * @author 
 * @date 2014/4/18 16:22:33
 * @version 1.0.0
 */

/**
 * @class sendgoods
 * @brief 发货接口类
 */
class sendgoods
{
	/**
	 * @brief 开始发货
	 * @param $orderId int 订单ID号
	 */
	public static function run($paramArray)
	{
		$orderRow = self::getOrderInfo($paramArray['order_id']);
	
		if($orderRow['trade_no'] && $sendObj = self::createObject($orderRow['class_name']))
		{
			$freight = new IModel('freight_company');
			$orderRow['freight_type'] = $freight->getField('id='.$paramArray['freight_id'],'freight_type');
			$orderRow = array_merge($orderRow,$paramArray);
			$sendObj->send($orderRow);
		}
	}

	/**
	 * @brief 获取订单信息
	 * @param $orderId int 订单ID
	 * @return array 订单信息
	 */
	private static function getOrderInfo($orderId)
	{
		$orderDB         = new IQuery('order as o');
		$orderDB->fields = 'p.class_name,o.trade_no,o.pay_type';
		$orderDB->join   = 'left join payment as p on o.pay_type = p.id ';
		$orderDB->where  = 'o.id = '.$orderId;
		$result          = $orderDB->find();
		return current($result);
	}

	/**
	 * @brief 获取类文件路径
	 * @param $className string 支付类名称
	 * @return object 发货类实力
	 */
	private static function createObject($className)
	{
		$basePath = IWeb::$app->getBasePath().'plugins/sendGoods/';
		switch($className)
		{
			case "trade_alipay":
			case "alipay":
			{
				include($basePath.'alipay/sendgoods_alipay.php');
				return new sendgoods_alipay();
			}
			break;
		}
		return '';
	}
}