<?php
/**
 * @author panduo
 * @date 2016-05-13 10:41:04
 * @brief 保证金提货
 *
 */
namespace nainai\delivery;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;

use nainai\order;
class DepositDelivery extends Delivery{
	
	public function __construct(){
		parent::__construct(order\Order::ORDER_DEPOSIT);
		$this->order = new M('order_sell');
		$this->orderObj = new order\Order();
	}

	/**
	 * 卖家发货
	 * @param  int $delivery_id 提货表id
	 * @param  int $user_id     当前操作用户,须与对应报盘表product_offer中的用户id一致
	 * @return mix  $res        true:成功 string:错误信息
	 */
	public function sellerConsignment($delivery_id,$seller_id){
		//获取提货id对应报盘信息
		$query = new Query('product_delivery as pd');
		$query->join = 'left join product_offer as po on pd.offer_id = po.id';
		$query->fields = 'pd.*,po.user_id,po.mode';
		$query->where = 'pd.id=:id';
		$query->bind = array('id'=>$delivery_id);
		$res = $query->getObj();

		if($res['user_id'] != $seller_id) $error = '当前操作用户有误';

		if($res['mode'] != order\Order::ORDER_DEPOSIT) $error = '订单类型须为保证金订单';

		if($res['status'] != parent::DELIVERY_APPLY) $error =  '提货状态错误';

		if(!isset($error)){
			$deliveryData['id'] = $delivery_id;
			$deliveryData['status'] = parent::DELIVERY_BUYER_CONFIRM;//提货状态置为已发货，等待买家确认
			return $this->deliveryUpdate($deliveryData);
		}else{
			return tool::getSuccInfo(0,$error);
		}
	
	}

	/**
	 * 买家确认收货
	 * @param  itn $delivery_id 提货表id
	 * @param  int $buyer_id    当前操作用户,须与order_sell中用户id一致		
	 * @return mix $res         true:成功 string:错误信息
	 */
	public function buyerConfirm($delivery_id,$buyer_id){
		//获取对应订单信息
		$query = new Query('product_delivery as pd');
		$query->join = 'left join order_sell as po on pd.order_id = po.id';
		$query->fields = 'pd.*,po.user_id,po.mode,po.id as order_id,po.num as total_num';
		$query->where = 'pd.id=:id';
		$query->bind = array('id'=>$delivery_id);

		$res = $query->getObj();
		if($res['user_id'] != $buyer_id) $error = '当前操作用户有误';

		if($res['mode'] != order\Order::ORDER_DEPOSIT) $error =  '订单类型须为保证金订单';

		if($res['status'] != parent::DELIVERY_BUYER_CONFIRM) $error =  '提货状态错误';

		if(!isset($error)){
			try {
				$this->order->beginTrans();
				//计算货物余量
				$left = $this->orderNumLeft($res['order_id'],true,true);
				if(is_float($left)){
					$left -= floatval($res['num']) / floatval($res['total_num']);
					$deliveryData['id'] = $delivery_id;
					if($left > 0.2){
						//货物余量大于20% 本次提货结束 等待买家进行第二次提货
						$deliveryData['status'] = parent::DELIVERY_AGAIN;
					}else{
						//货物余量小于等于20% 提货流程结束 
						$deliveryData['status'] = parent::DELIVERY_COMPLETE;
						$order_res = $this->orderObj->orderUpdate(array('id'=>$res['order_id'],'contract_status'=>order\Order::CONTRACT_DELIVERY_COMPLETE));
					}

					$res = $this->deliveryUpdate($deliveryData);
					if($res['success'] == 1){
						if(isset($order_res)){
							$error = $order_res['success'] == 1 ? '' : $order_res['info'];							
						}
						if(empty($error)){
							$this->order->commit();
							return tool::getSuccInfo();
						}
					}else{
						$error = $res['info'];
					}
				}else{
					$error = $left;
				}
			} catch (\PDOException $e) {
				$error = $e->getMessage();
				$this->order->rollBack();
			}
			
		}
		
		return tool::getSuccInfo(0,$error);

	}



}