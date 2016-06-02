<?php
/**
 * @author panduo
 * @date 2016-05-13 10:42:05
 * @brief 仓单提货
 *
 */
namespace nainai\delivery;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;

use nainai\order;
class StoreDelivery extends Delivery{
	
	public function __construct(){
		parent::__construct(order\Order::ORDER_STORE);
	}

	/**
	 * 卖方支付仓库管理费用
	 * @param  int $delivery_id 提货表id	
	 * @param  int $user_id     当前操作用户id
	 * @return array $res       返回信息数组
	 */
	public function storeFees($delivery_id,$seller_id){
		//获取提货id对应报盘信息
		$query = new Query('product_delivery as pd');
		$query->join = 'left join product_offer as po on pd.offer_id = po.id';
		$query->fields = 'pd.*,po.user_id,po.mode';
		$query->where = 'pd.id=:id';
		$query->bind = array('id'=>$delivery_id);
		$res = $query->getObj();

		if($res['user_id'] != $seller_id) $error = '当前操作用户有误';

		if($res['mode'] != order\Order::ORDER_STORE) $error = '订单类型须为仓单订单';

		if($res['status'] != parent::DELIVERY_APPLY) $error =  '提货状态错误';

		if(!isset($error)){
			$deliveryData['id'] = $delivery_id;
			$deliveryData['status'] = parent::DELIVERY_MANAGER_CHECKOUT;//提货状态置为等待仓库管理员确认出库
			try {
				$this->delivery->beginTrans();
				$upd_res = $this->deliveryUpdate($deliveryData);
				if($upd_res['success'] == 1){
					//卖方支付仓库费 TODO计算仓库费用
					$store_fee = 22;
					$acc_res = $this->account->freeze($res['user_id'],$store_fee);//?支付到市场？
					if($acc_res === true){
						$this->delivery->commit();
						return tool::getSuccInfo();
					}else{
						$error = $acc_res['info'];
					}
				}else{
					$error = $upd_res['info'];
				}
			} catch (PDOException $e) {
				$error = $e->getMessage();
				$this->delivery->rollBack();
			}
		}

		return tool::getSuccInfo(0,$error);
		
	}

	/**
	 * 仓库管理员确认出库
	 * @param  int $delivery_id 提货表Id
	 * @return array $res  返回结果信息
	 */
	public function managerCheckout($delivery_id){
		$delivery = $this->deliveryInfo($delivery_id);
		if($delivery && $delivery['status'] == parent::DELIVERY_MANAGER_CHECKOUT){
			$deliveryData['id'] = $delivery_id;
			$deliveryData['status'] = parent::DELIVERY_ADMIN_CHECK;//等待后台管理员进行审核
			return $this->deliveryUpdate($deliveryData);
		}else{
			return tool::getSuccInfo(0,'无效订单');
		}
	}

	/**
	 * 后台管理员进行审核
	 * @param  int $delivery_id 提货表Id
	 * @return array $res  返回结果信息
	 */
	public function adminCheck($delivery_id){
		//获取对应订单信息
		$query = new Query('product_delivery as pd');
		$query->join = 'left join order_sell as po on pd.order_id = po.id';
		$query->fields = 'pd.*,po.user_id,po.mode,po.id as order_id,po.num as total_num';
		$query->where = 'pd.id=:id';
		$query->bind = array('id'=>$delivery_id);

		$delivery = $query->getObj();
		if($delivery && $delivery['status'] == parent::DELIVERY_ADMIN_CHECK && $delivery['mode'] == order\Order::ORDER_STORE){
			//计算货物余量
			$left = $this->orderNumLeft($delivery['order_id'],true,true);
			if(is_float($left)){
				$left -= floatval($delivery['num']) / floatval($delivery['total_num']);
				$deliveryData['id'] = $delivery_id;
				if($left > 0.20){
					//货物余量大于20% 本次提货结束 等待买家进行第二次提货
					$deliveryData['status'] = parent::DELIVERY_AGAIN;
				}else{
					//货物余量小于等于20% 提货流程结束 
					$deliveryData['status'] = parent::DELIVERY_COMPLETE;
				}
				return $this->deliveryUpdate($deliveryData);
			}else{
				return tool::getSuccInfo(0,$left);
			}
		}else{
			return tool::getSuccInfo(0,'无效订单');
		}
	}
}