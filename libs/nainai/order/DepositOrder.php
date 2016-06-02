<?php
/**
 * @author panduo
 * @date 2016-4-25
 * @brief 保证金订单表 暂只支持余额支付
 *
 */
namespace nainai\order;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;

class DepositOrder extends Order{
	
	public function __construct(){
		parent::__construct(parent::ORDER_DEPOSIT);
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
			$orderData['contract_status'] = self::CONTRACT_SELLER_DEPOSIT;//合同状态置为等待卖方保证金支付
			if($type == 0){
				//定金支付
				$pay_deposit = $this->payDeposit($info);
				if(is_float($pay_deposit)){
					$orderData['pay_deposit'] = $pay_deposit;
				}else{
					return tool::getSuccInfo(0,$pay_deposit);
				}
			}else{
				//全款
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

	/**
	 * 卖方支付保证金
	 * @param  int  $order_id 订单id
	 * @param  boolean $pay      卖方是否支付保证金 若未支付则取消合同 同时扣除卖方信誉值
	 * @param  int $user_id session中用户id
	 * @return array   结果信息数组
	 */
	public function sellerDeposit($order_id,$pay = true,$user_id){
		$info = $this->orderInfo($order_id);
		if(is_array($info) && isset($info['contract_status'])){
			$orderData['id'] = $order_id;
			$seller = $this->sellerUserid($order_id);//获取卖方帐户id
			if($info['contract_status'] != self::CONTRACT_SELLER_DEPOSIT)
				return tool::getSuccInfo(0,'合同状态有误');
			if($seller != $user_id)
				return tool::getSuccInfo(0,'订单卖家信息有误');
			try {
				$this->order->beginTrans();
				if($pay === false){
					//未支付 合同取消
					
					//扣除信誉值
					$configs_credit = new \nainai\CreditConfig();
					$configs_credit->changeUserCredit($seller,'cancel_contract');
					
					//将买方冻结资金解冻
					$acc_res = $this->account->freezeRelease($info['user_id'],floatval($info['pay_deposit']));
					//将商品数量解冻
					$pro_res = $this->productsFreezeRelease($this->offerInfo($info['offer_id']),$info['num']);

					$log_res = $this->payLog($order_id,$user_id,1,'卖方未支付保证金,合同作废,扣除信誉值');
					$orderData['contract_status'] = self::CONTRACT_CANCEL;

				}elseif($pay === true){
					//卖方支付保证金
					
					if(is_int($seller)){
						//获取卖方保证金数值 
						$sys_percent_obj = new M('scale_offer');//后台配置保证金基数比例
						$sys_percent = $sys_percent_obj->where(array('id'=>1))->getField('deposite');

						//获取当前用户等级保证金比例
						$user = new \nainai\member();
						$user_percent = $user->getUserGroup($seller);
						if($user_percent['caution_fee'] === false) return tool::getSuccInfo(0,'用户等级未知');
						$percent = (floatval($sys_percent) * floatval($user_percent['caution_fee'])) / 10000;
						$seller_deposit = floatval($info['amount'] * $percent);
						//冻结卖方帐户保证金
						$acc_res = $this->account->freeze($seller,$seller_deposit);
						$orderData['seller_deposit'] = $seller_deposit;
						//判断此订单是否支付全款
						if($info['amount'] === $info['pay_deposit']){
							//全款 合同生效 等待提货
							$orderData['contract_status'] = self::CONTRACT_EFFECT;
						}else{
							//定金 等待支付尾款
							$orderData['contract_status'] = self::CONTRACT_BUYER_RETAINAGE;
						}
						$pro_res = true;
						$log_res = $this->payLog($order_id,$user_id,1,'卖方支付保证金');
					}else{
						$res = $seller;
					}
				}else{
					$res = '参数错误';
				}

				if($acc_res === true){
					$upd_res = $this->orderUpdate($orderData);
					if($upd_res['success'] == 1){
						$res = $pro_res === true && $log_res === true ? $this->order->commit() : ($pro_res === true ? $log_res : $pro_res);
					}else{
						$this->order->rollBack();
						$res = $upd_res['info'];
					}
				}else{
					$this->order->rollBack();
					$res = isset($acc_res['info']) ? $acc_res['info'] : $res;
				}
			} catch (\PDOException $e) {
				$res = $e->getMessage();
				$this->order->rollBack();
			}
		}else{
			$res = '无效订单id';
		}

		return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res ? $res : '未知错误');
	}


	/**
	 * 获取用户所有合同信息(含商品信息与买家信息)  误*
	 * @param  int $user_id 卖家id
	 */
	public function depositContractList($user_id,$page,$where = array()){
		$query = new Query('order_deposit as do');
		$query->join  = 'left join product_offer as po on do.offer_id = po.id left join user as u on u.id = do.user_id left join products as p on po.product_id = p.id';
		$query->where = 'po.user_id = :user_id';
		// $bind = array();
		// if($where){
		// 	foreach ($where as $key => $value) {
		// 		$query->where .= $value[0];	
		// 		$bind = array_merge($bind,$value[1]);
		// 	}
		// }
		$query->fields = 'u.username,do.*,p.name as product_name,p.unit';
		// $query->bind  = array_merge($bind,array('user_id'=>$user_id));
		$query->bind  = array('user_id'=>$user_id);
		$query->page  = $page;
		$query->pagesize = 2;
		// $query->order = "sort";
		$data = $query->find();
		foreach ($data as $key => &$value) {
			//根据合同状态得出对应操作
			$contract_status = $value['contract_status'];
			$href = '';
			switch ($contract_status) {
				case self::CONTRACT_NOTFORM:
					$title = '等待买方付款';
					break;
				case self::CONTRACT_SELLER_DEPOSIT:
					$title = '支付保证金';
					$href  = url::createUrl('/Deposit/sellerDeposit?order_id='.$value['id']);
					break;
				case self::CONTRACT_CANCEL:
					$title = '合同已作废';
					break;
				case self::CONTRACT_EFFECT:
					$title = '合同生效,待提货';
					break;
				case self::CONTRACT_BUYER_RETAINAGE:
					if(empty($value['proof'])){
						$title = '等待支付尾款';
					}else{
						$title = '确认线下凭证';
						$href  = url::createUrl('/Deposit/confirmProof?order_id='.$value['id']);
					}
					break;
				case self::CONTRACT_COMPLETE:
					$title = '合同已完成';
					break;
				default:
					$title = '无效状态';
					break;
			}

			$value['action'] = $title;
			$value['action_href'] = $href;
		}
		// tool::pre_dump($data);
		$pageBar =  $query->getPageBar();
		return array('data'=>$data,'bar'=>$pageBar);
	}
}




