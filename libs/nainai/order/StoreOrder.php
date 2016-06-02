<?php
/**
 * @author panduo
 * @date 2016-4-25
 * @brief 仓单订单表 暂只支持余额支付
 *
 */
namespace nainai\order;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;
class StoreOrder extends Order{
	
	public function __construct(){
		parent::__construct(parent::ORDER_STORE);
	}

	/**
	 * 买方预付定金(全款或定金)
	 * @param array $info 订单信息数组
	 * @param int $type 0:定金1:全款 默认定金支付
	 * @param int $user_id 当前session用户id
	 */
	public function buyerDeposit($order_id,$type,$user_id){
		$info = $this->orderInfo($order_id);
		if(is_array($info) && isset($info['contract_status'])){
			if($info['contract_status'] != self::CONTRACT_NOTFORM)
				return tool::getSuccInfo(0,'合同状态有误');
			if($info['user_id'] != $user_id)
				return tool::getSuccInfo(0,'订单买家信息有误');
			$orderData['id'] = $order_id;
			if($type == 0){
				//定金支付
				$orderData['contract_status'] = self::CONTRACT_BUYER_RETAINAGE;//合同状态置为等待买方支付尾款
				$pay_deposit = $this->payDeposit($info);
				if(is_float($pay_deposit)){
					$orderData['pay_deposit'] = $pay_deposit;
				}else{
					return tool::getSuccInfo(0,$pay_deposit);
				}
			}else{
				//全款
				$orderData['contract_status'] = self::CONTRACT_EFFECT;//合同状态置为已生效
				$amount = floatval($info['amount']);
				if($amount>0){
					$orderData['pay_deposit'] = $amount;
				}else{
					return tool::getSuccInfo(0,'无效订单');
				}
			}

			try {
				$this->order->beginTrans();
				$upd_res = $this->orderUpdate($orderData);
				if($upd_res['success'] == 1){
					//冻结买方帐户资金  payment=1 余额支付
					$acc_res = $this->account->freeze($info['user_id'],$orderData['pay_deposit']);
					if($acc_res === true){
						$pro_res = $this->productsFreeze($this->offerInfo($info['offer_id']),$info['num']);
						if($pro_res === true){
							$log_res = $this->payLog($order_id,$user_id,0,'买方预付定金--'.$type == 0 ? '定金' : '全款');
							if($log_res === true){
								$res = $this->order->commit();
							}else{
								$this->order->rollBack();
								$res = $log_res;
							}
						}else{
							$this->order->rollBack();
							$res = $pro_res;
						}
					}else{
						$this->order->rollBack();
						$res = $acc_res['info'];
					}	
				}else{
					$this->order->rollBack();
					$res = $upd_res['info'];
				}
			} catch (\PDOException $e) {
				$this->order->rollBack();
				$res = $e->getMessage();
			}
		}else{
			$res = '无效订单id';
		}
		return $res === true ? array_merge(tool::getSuccInfo(),array('amount'=>$info['amount'],'pay_deposit'=>$orderData['pay_deposit'])) : tool::getSuccInfo(0,$res ? $res : '未知错误');
	}


}




