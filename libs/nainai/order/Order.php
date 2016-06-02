<?php
/**
 * @author panduo
 * @date 2016-5-2
 * @brief 合同订单基类
 *
 */
namespace nainai\order;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;
class Order{

	//合同制状态常量
	const CONTRACT_NOTFORM = 0;//合同未形成
	const CONTRACT_SELLER_DEPOSIT = 1;//合同等待卖家缴纳保证金
	const CONTRACT_CANCEL = 2;//卖家未按时支付保证金合同作废
	const CONTRACT_BUYER_RETAINAGE = 3;//卖家支付保证金后等待接受尾款
	const CONTRACT_EFFECT = 4;//支付完成合同生效
	const CONTRACT_DELIVERY_COMPLETE = 5; //提货量超过80%，提货完成
	const CONTRACT_VERIFY_QAULITY = 6;//买家已确认货物质量（保证金/仓单） 提货
	const CONTRACT_SELLER_VERIFY = 7; //卖家确认  包含买方扣减款项
	const CONTRACT_COMPLETE = 8;//合同完成

	//订单类型常量定义 
	const ORDER_FREE = 1;//自由报盘订单
	const ORDER_DEPOSIT = 2;//保证金报盘订单

	const ORDER_ENTRUST = 3;//委托报盘
	const ORDER_STORE = 4;//仓单报盘订单


	protected $order_table;//订单表名
	protected $order;//订单表M对象
	protected $order_type;//订单表类型
	protected $offer;//报盘表
	protected $account;//用户资金类
	protected $products;//商品表
	protected $paylog;//日志
	protected $mess;//消息表

	/**
	 * 规则
	 */
	protected $orderRules = array(
		array('id','number','id错误',0,'regex'),
		array('offer_id','number','报盘id错误',0,'regex'),
		array('user_id','number','买方id错误',0,'regex'),
	);



	public function __construct($order_type){
		$this->order_type = $order_type;
		$this->order_table = 'order_sell';
		$this->order = new M($this->order_table);
		$this->offer = new M('product_offer');
		$this->products = new M('products');
		$this->paylog = new M('pay_log');
		$this->account = new \nainai\fund\agentAccount();
	}	


	/**
	 * 新增或更新订单数据
	 * @param  object $order 订单表对象	
	 * @param  array $data  订单数据
	 * @return array $res  返回结果信息
	 */
	public function orderUpdate($data){
		$order = $this->order;
		if($order->data($data)->validate($this->orderRules)){
			if(isset($data['id']) && $data['id']>0){
				$id = $data['id'];
				//编辑
				unset($data['id']);
				$res = $order->where(array('id'=>$id))->data($data)->update();
				$res = $res>0 ? true : ($order->getError() ? $order->getError() : '数据未修改');
			}else{
				while($this->existOrderData($order,array('order_no'=>$data['order_no']))){
					$data['order_no'] = tool::create_uuid();
				}
				try {
					$order->beginTrans();
					$order_id = $order->data($data)->add();
					$this->payLog($order_id,$data['user_id'],0,'买方下单');
					
					$res = $order->commit();	
				} catch (\PDOException $e) {
					$order->rollBack();
					$res = $e->getMessage();
				}
			}
		}else{
			$res = $order->getError();
		}
		
		if($res === true){
			$resInfo = tool::getSuccInfo();
			if(isset($order_id)){
				$resInfo['order_id'] = $order_id;
			}
		}else{
			$resInfo = tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
		}
		return $resInfo;
	}

	/**
	 * 验证订单数据是否已存在
	 * @param object $order 订单表对象
	 * @param array $orderData 订单数据
	 * @return bool  存在 true 否则 false
     */
	private function existOrderData($order,$orderData){
		$data = $order->fields('id')->where($orderData)->getObj();
		if(empty($data))
			return false;
		return true;
	}


	//生成摘牌订单
	public function geneOrder($orderData){
		if(in_array($orderData['mode'],array(self::ORDER_FREE,self::ORDER_ENTRUST))){
			$orderData['contract_status'] = self::CONTRACT_BUYER_RETAINAGE;
		}else{
			$orderData['contract_status'] = self::CONTRACT_NOTFORM;	
		}
		
		$offer_info = $this->offerInfo($orderData['offer_id']);
		if(isset($offer_info['price']) && $offer_info['price']>0){
			$product_valid = $this->productNumValid($orderData['num'],$offer_info);
			if($product_valid !== true)
				return tool::getSuccInfo(0,$product_valid);
			$orderData['amount'] = $offer_info['price'] * $orderData['num'];
			// if($orderData['payment'] == 1){
				//代理账户,判断用户买家余额是否足够
				$user_id = $orderData['user_id'];
				$balance = $this->account->getActive($user_id);
				if(floatval($balance) < $orderData['amount']){
					return tool::getSuccInfo(0,'代理账户余额不足');
				}
			// }
			$upd_res = $this->orderUpdate($orderData);
			if($offer_info['mode'] == self::ORDER_DEPOSIT){
				$mess = new \nainai\message($offer_info['user_id']);
				$mess->send('depositPay',$upd_res['order_id']);
			}
			$res = isset($res) ? tool::getSuccInfo(0,$res) : $upd_res;
		}else{
			$res = tool::getSuccInfo(0,'无效报盘');
		}
		return $res;
	}

	/**
	 * 根据订单id获取报盘用户的id
	 * @param  int $order_id 订单id
	 * @return int:用户id string:错误信息
	 */
	protected function sellerUserid($order_id){
		$query = new Query($this->order_table.' as o');
		$query->join = 'left join product_offer as po on po.id = o.offer_id';
		$query->fields = 'po.user_id';
		$query->where = 'o.id=:id';
		$query->bind = array('id'=>intval($order_id));
		$res = $query->getObj();
		$user_id = intval($res['user_id']);
		return $user_id ? $user_id : '用户不存在';
	}

	//根据订单id获取订单内容	
	public function orderInfo($order_id){
		return empty($order_id) ? array() : $this->order->where(array('id'=>$order_id))->fields()->getObj();
	}

	//根据报盘id获取相应信息
	protected function offerInfo($offer_id){
		$query = new Query('product_offer as po');
		$query->join = 'left join user as u on po.user_id = u.id';
		$query->where = " po.id = :id";
		$query->bind = array('id'=>$offer_id);
		$query->fields = "po.*,u.username";
		$res = $query->getObj();
		return $res ? $res : array();
	}

	

	//买家支付尾款
	public function buyerRetainage($order_id,$user_id,$payment='online',$proof = ''){
		$info = $this->orderInfo(intval($order_id));
		if(is_array($info) && isset($info['contract_status'])){
			if($info['contract_status'] == self::CONTRACT_BUYER_RETAINAGE || $info['contract_status'] == self::CONTRACT_NOTFORM){
				if($info['user_id'] != $user_id)
					return tool::getSuccInfo(0,'订单买家信息有误');

				$amount = floatval($info['amount']);
				$buyerDeposit = floatval($info['pay_deposit']);
				$retainage = $amount - $buyerDeposit;

				if($retainage>0){
					try {
						$this->order->beginTrans();
						$orderData['id'] = $order_id;
						$payment = in_array($info['mode'],array(self::ORDER_ENTRUST,self::ORDER_FREE)) ? 'offline' : $payment;//自由与委托报盘只接受线下凭证
						if($payment == 'online'){
							//冻结买家帐户余额
							$acc_res = $this->account->freeze($info['user_id'],$retainage);

							if($acc_res === true){
								$orderData['pay_retainage'] = $retainage;
								$orderData['contract_status'] = self::CONTRACT_EFFECT;//payment为1  合同状态置为生效
								$upd_res = $this->orderUpdate($orderData);
								if($upd_res['success'] == 1){
									$log_res = $this->payLog($order_id,$user_id,0,'买家线上支付尾款');
									$seller = $this->sellerUserid($order_id);
									if(is_int($seller)){
										$mess = new \nainai\message($seller);
										$mess->send('buyerRetainage',$order_id);
									}
									$res = $log_res === true ? $this->order->commit() : $log_res;
								}else{
									$res = $upd_res['info'];
								}
							}else{
								$this->order->rollBack();
								$res = $acc_res['info'];
							}
						}elseif($payment == 'offline'){
							$orderData['proof'] = $proof;
							$upd_res = $this->orderUpdate($orderData);
							if($upd_res['success'] == 1){
								$log_res = $this->payLog($order_id,$user_id,0,'买家上传线下支付凭证');
								$res = $log_res === true ? $this->order->commit() : $log_res;
							}else{
								$res = $upd_res['info'];
							}
						}else{
							$this->order->rollBack();
							$res = '无效支付方式';
						}	
					} catch (PDOException $e) {
						$res = $e->getMessage();
						$this->order->rollBack();
					}
				}else{
					$res = '合同金额有误';
				}
			}else{
				$res = '合同状态有误';
			}
		}else{
			$res = '无效订单';
		}

		return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res ? $res : '未知错误');
	}

	/**
	 * 卖家确认买家线下支付凭证
	 * @param  int  $order_id 订单id
	 * @param  int  $user_id  session中用户id
	 * @param  boolean $confirm  true:确认收款 false:未收款 买家需重新上传凭证
	 * @return array  结果信息数组
	 */
	public function confirmProof($order_id,$user_id,$confirm = true){
		$info = $this->orderInfo($order_id);
		if(is_array($info) && isset($info['contract_status'])){
			if($info['mode'] != self::ORDER_FREE && $info['mode'] != self::ORDER_ENTRUST && $info['contract_status'] != self::CONTRACT_BUYER_RETAINAGE){
				return tool::getSuccInfo(0,'合同状态有误');
			}
			$seller = $this->sellerUserid($order_id);//获取卖方帐户id
			if($seller != $user_id)
				return tool::getSuccInfo(0,'订单卖家信息有误');

			if(empty($info['proof'])){
				return tool::getSuccInfo(0,'无效支付凭证');
			}
			$orderData['id'] = $order_id;
			if($confirm === true){
				//卖家确认收款
				
				//合同状态置为生效
				$orderData['contract_status'] = $info['mode'] != self::ORDER_FREE && $info['mode'] != self::ORDER_ENTRUST ? self::CONTRACT_EFFECT : self::CONTRACT_COMPLETE;
				$log_res = $this->payLog($order_id,$user_id,1,'卖家确认线下支付凭证');
			}elseif($confirm === false){
				//删除之前上传proof
				$orderData['proof'] = null;
				$log_res = $this->payLog($order_id,$user_id,1,'线下支付凭证无效');
				//发送提示信息买家  
				$mess = new \nainai\message($seller);
				$mess->send('buyerProof',$order_id);
			}else{
				$res = '参数错误';
			}

			if(!isset($res)){
				try {
					$this->order->beginTrans();
					$upd_res = $this->orderUpdate($orderData);
					if($upd_res['success'] == 1){
						$res = $log_res === true ? $this->order->commit() : $log_res;
					}else{
						$this->order->rollBack();
						$res = $upd_res['info'];
					}
				} catch (PDOException $e) {
					$this->order->rollBack();
					$res = $e->getMessage();
				}
			}

		}else{
			$res = '无效订单id';
		}

		return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res ? $res : '未知错误');
	}

	/**
	 * 根据订单id计算买方定金数额
	 * @param  array $info 订单信息数组
	 * @return float:定金数值 string:报错信息
	 */
	final protected function payDeposit($info){
		if(isset($info['offer_id']) && isset($info['amount'])){
			$amount = $info['amount'];
			if(($amount = floatval($amount)) > 0){
				//获取保证金比率
				$preFee = $this->payDepositCom($info['offer_id'],$amount);

				if($preFee===false){
					return '无效定金';
				}
				else{
					return $preFee;
				}

			}
			return '无效订单';
		}else{
			return '参数错误';
		}
	}

	//获取买方定金数额（通用）
	public function payDepositCom($offer_id,$amount){
		if(($amount = floatval($amount)) > 0){
			//获取保证金比率
			$query = new Query('products as p');
			$query->join = 'left join product_offer as po on po.product_id = p.id ';
			$query->fields = 'p.cate_id';
			$query->where = 'po.id=:offer_id';
			$query->bind = array('offer_id'=>$offer_id);
			$res = $query->getObj();
			$cate_id = $res['cate_id'];

			$percent = $this->getCatePercent($cate_id);
			if($percent>0 && $percent<100){
				//能否等于0或者100
				return ($percent/100)*$amount;
			}
			return false;
		}
		return false;
	}

	/**
	 * 获取分类首付款比率
	 */
	private function getCatePercent($id,$obj=null){
		if($obj==null)
			$obj = new M('product_category');
		static $percent = 0;
		$res = $obj->where(array('id'=>$id))->fields('percent,pid')->getObj();
		if($res['percent']==0 && $res['pid']!=0){
			$percent = $this->getCatePercent($res['pid'],$obj);
		}
		else
			$percent = $res['percent'];

		return $percent;

	}

	/**
	 * 查看产品数量是否合规
	 * @param  array $product 产品信息数组
	 * @return true:可以下单 string:错误信息
	 */
	public function productNumValid($num,$offer_info,$product=array()){
		if(empty($product))
			$product = $this->products->where(array('id'=>$offer_info['product_id']))->getObj();
		$quantity = floatval($product['quantity']); //商品总数量
		$sell = floatval($product['sell']); //商品已售数量
		$freeze = floatval($product['freeze']);//商品已冻结数量
		if($offer_info['divide'] == 1 && $num != $quantity)
			return '此商品不可拆分';

		$product_left = $quantity-$sell-$freeze;//商品剩余数量
		if($num > $product_left)
			return '商品存货不足';
		if($num < $offer_info['minimum'])
			return '小于最小起订量';

		return true;
	}

	/**
	 * 买家支付定金后冻结相应数量的商品
	 * @param  array $offer_info 报盘信息数组
	 * @param  float $num  商品数目
	 * @return true:冻结成功 string:报错信息
	 */
	final public function productsFreeze($offer_info,$num){
		$num = floatval($num);
		if($offer_info && is_array($offer_info) && $num > 0){
			$product = $this->products->where(array('id'=>$offer_info['product_id']))->getObj();

			if($product){
				$product_valid = $this->productNumValid($num,$offer_info,$product);
				if($product_valid !== true)
					return $product_valid;
				$res = $this->products->where(array('id'=>$product['id']))->data(array('freeze'=>floatval($product['freeze'])+$num))->update();
				return is_int($res) && $res>0 ? true : ($this->products->getError() ? $this->products->getError() : '数据未修改');
			}
			return '无效产品';
		}
		return '无效报盘';
	}
	/**
	 * 合同作废 将冻结的商品数量恢复
	 * @param  array $offer_info 报盘信息数组
	 * @param  float $num  商品数目
	 * @return true:解冻成功 string:报错信息
	 */
	final protected function productsFreezeRelease($offer_info,$num){
		$num = floatval($num);
		if($offer_info && is_array($offer_info) && $num > 0){
			$product = $this->products->where(array('id'=>$offer_info['product_id']))->getObj();
			$freeze = floatval($product['freeze']);//已冻结商品数量
			if($freeze >= $num){
				$res = $this->products->where(array('id'=>$product['id']))->data(array('freeze'=>($freeze-$num)))->update();
				return is_int($res) && $res>0 ? true : ($this->products->getError() ? $this->products->getError() : '数据未修改');
			}else{
				return '冻结商品数量有误';
			}
		}else{
			return '无效报盘';
		}
	}

	/**
	 * 订单日志记录
	 * @param  int $order_id  订单id
	 * @param  int $user_id   操作用户id
	 * @param  int $user_type 操作用户身份 0:买家 1:卖家
	 * @param  string $remark 备注
	 * @return array $res     返回结果信息
	 */
	final protected function payLog($order_id,$user_id,$user_type,$remark){
		$res = $this->paylog->data(array('pay_type'=>$this->order_table,'order_id'=>$order_id,'user_id'=>$user_id,'user_type'=>$user_type,'remark'=>$remark,'create_time'=>date('Y-m-d H:i:s',time())))->add();
		$err = $this->paylog->getError();
		return  intval($res) > 0 ? true : (!empty($err) ? $err : '日志记录失败');
	}

	/**
	 * 买方确认货物质量
	 * @param  int $order_id 订单id
	 * @param  array $reduceData 扣减货款数据 默认为空
	 * @return array  $res   返回结果
	 */
	public function verifyQaulity($order_id,$reduceData = array()){
		$order = $this->orderInfo($order_id);
		if($order && in_array($order['mode'],array(self::ORDER_DEPOSIT,self::ORDER_STORE))){
			if($order['contract_status'] == self::CONTRACT_DELIVERY_COMPLETE){
				$orderData['contract_status'] = self::CONTRACT_VERIFY_QAULITY;//状态置为买家已确认质量
				$orderData['id'] = $order_id;

				try {
					$this->order->beginTrans();
					if(!empty($reduceData)){
						$orderData = array_merge($orderData,$reduceData);
					}
					$res = $this->orderUpdate($orderData);
					//更新合同状态
					if($res['success'] == 1){
						$log_res = $this->payLog($order_id,$order['user_id'],0,'买家确认提货质量'.($reduceData['reduce_amount'] ? "（扣减款项：{$reduceData['reduce_amount']})" : ''));
						if($log_res === true){
							$this->order->commit();
							return tool::getSuccInfo();
						}else{
							$error = $log_res;
						}
					}else{
						$error = $res['info'];
					}
				}catch(PDOException $e) {
					$this->order->rollBack();
					$error = $e->getMessage();
				}
			}else{
				$error = '合同状态有误';
			}
		}else{
			$error = '无效订单';
		}

		return tool::getSuccInfo(0,$error);
	}

	/**
	 * 卖家确认买家扣减货款信息
	 * @param  int $order_id 订单Id
	 * @return array 结果数组
	 */
	public function sellerVerify($order_id){
		$order = $this->orderInfo($order_id);
		if($order && in_array($order['mode'],array(self::ORDER_DEPOSIT,self::ORDER_STORE))){
			if($order['contract_status'] == self::CONTRACT_VERIFY_QAULITY){
				$orderData['contract_status'] = self::CONTRACT_SELLER_VERIFY;//状态置为卖家已确认质量
				$orderData['id'] = $order_id;

				try {
					$this->order->beginTrans();
					$res = $this->orderUpdate($orderData);
						$buyer = $this->offer->where(array('id'=>$order['offer_id']))->getfield('user_id');
						//将订单款 减去扣减款项 后的60%支付给卖方
						$reduce_amount = floatval($order['reduce_amount']); 

						$amount = ($order['amount'] - $reduce_amount) * 0.6;
						$acc_res = $this->account->freezePay($order['user_id'],$buyer,floatval($amount));
						if($acc_res === true){
							$log_res = $this->payLog($order_id,$order['user_id'],0,'卖家确认提货质量'.($reduce_amount ? "（扣减款项：$reduce_amount)" : ''));
							if($log_res === true){
								$this->order->commit();
								return tool::getSuccInfo();
							}else{
								$error = $log_res;
							}
						}else{
							$error = $acc_res;
						}
				}catch(PDOException $e) {
					$this->order->rollBack();
					$error = $e->getMessage();
				}
			}else{
				$error = '合同状态有误';
			}
		}else{
			$error = '无效订单';
		}

		return tool::getSuccInfo(0,$error);
	}

	/**
	 * 买方确认合同完成
	 * @param  int $order_id 订单id
	 * @return array  $res   返回结果信息
	 */
	public function contractComplete($order_id){
		$order = $this->orderInfo($order_id);
		if($order && in_array($order['mode'],array(self::ORDER_DEPOSIT,self::ORDER_STORE))){
			if($order['contract_status'] == self::CONTRACT_SELLER_VERIFY){
				$orderData['contract_status'] = self::CONTRACT_COMPLETE;
				$orderData['id'] = $order_id;

				try {
					$this->order->beginTrans();
					$res = $this->orderUpdate($orderData);
					if($res['success'] == 1){
						//释放卖家保证金
						$buyer = $this->offer->where(array('id'=>$order['offer_id']))->getfield('user_id');

						//判断是否为保证金订单
						if($order['mode'] == self::ORDER_DEPOSIT){
							//如果是则需要将卖家的保证金解冻
							$accf_res = $this->account->freezeRelease($buyer,floatval($order['seller_deposit']));
						}else{
							$accf_res = true;
						}
						
						if($accf_res === true){
							//支付剩余货款 减去扣减款项 后的40%
							$reduce_amount = floatval($order['reduce_amount']); 
							$amount = ($order['amount'] - $reduce_amount) * 0.4;
							$accp_res = $this->account->freezePay($order['user_id'],$buyer,floatval($amount));
							if($accp_res === true){
								//若$reduce_amount 大于0 则将此扣减项返还买方账户
								$reduce_res = $reduce_amount > 0 ? $this->account->freezeRelease($order['user_id'],$reduce_amount) : true;
								$log_res = $this->payLog($order_id,$order['user_id'],0,'买家确认合同,合同结束'.($reduce_amount > 0 ? "(返还扣减项:$reduce_amount)" : ''));
								if($log_res === true){
									if($reduce_res === true){
										$this->order->commit();
										return tool::getSuccInfo();	
									}else{
										$error = $reduce_res;
									}
									
								}else{
									$error = $log_res;
								}
							}else{
								$error = $accp_res;
							}
						}else{
							$error = $accf_res;
						}
					}else{
						$error = $res['info'];
					}
				} catch (PDOException $e) {
					$error = $e->getMessage();
					$this->order->rollBack();
				}
			}else{
				$error = '合同状态有误';
			}
		}else{
			$error = '无效订单';
		}

		return tool::getSuccInfo(0,$error);
	}

	/**
	 * 获取用户所有销售合同信息(含商品信息与买家信息)
	 * @param  int $user_id 卖家id
	 */
	public function sellerContractList($user_id,$page,$where = array()){
		$query = new Query('order_sell as do');
		$query->join  = 'left join product_offer as po on do.offer_id = po.id left join user as u on u.id = do.user_id left join products as p on po.product_id = p.id';
		$query->where = 'po.user_id = :user_id';
		$query->fields = 'u.username,do.*,p.name as product_name,p.unit';
		// $query->bind  = array_merge($bind,array('user_id'=>$user_id));
		$query->bind  = array('user_id'=>$user_id);
		$query->page  = $page;
		$query->pagesize = 2;
		// $query->order = "sort";
		$data = $query->find();
		$this->sellerContractStatus($data);
		// tool::pre_dump($data);
		$pageBar =  $query->getPageBar();
		return array('data'=>$data,'bar'=>$pageBar);
	}

	// /**
	//  * 合同详情
	//  * @param  int $id 订单id
	//  * @param  boolean $is_seller 默认为购买合同
	//  * @return array   结果数组
	//  */
	// public function contractDetail($id,$is_seller = false){
	// 	$query = new Query('order_sell as do');
	// 	$query->join  = 'left join product_offer as po on do.offer_id = po.id left join user as u on u.id = do.user_id left join products as p on po.product_id = p.id';
	// 	$query->fields = 'do.*,p.name,po.price,do.amount,p.unit';
	// 	$query->where = 'do.id=:id';
	// 	$query->bind = array('id'=>$id);
	// 	$res = array($query->getObj());
	// 	// var_dump($res);
	// 	$this->sellerContractStatus($res);
	// 	return $res[0];
	// }

	/**
	 * 用户购买合同列表
	 * @param  int $user_id 当前登录用户Id
	 * @param  int $page    当前页
	 * @param  array  $where  条件数组
	 * @return array          列表数组
	 */
	public function buyerContractList($user_id,$page,$where = array()){
		$query = new Query('order_sell as do');
		$query->join  = 'left join product_offer as po on do.offer_id = po.id left join user as u on u.id = do.user_id left join products as p on po.product_id = p.id';
		$query->where = 'do.user_id = :user_id';
		// $bind = array();
		// if($where){
		// 	foreach ($where as $key => $value) {
		// 		$query->where .= $value[0];	
		// 		$bind = array_merge($bind,$value[1]);
		// 	}
		// }
		$query->fields = 'u.username,do.*,p.name as product_name,p.unit,po.product_id';
		// $query->bind  = array_merge($bind,array('user_id'=>$user_id));
		$query->bind  = array('user_id'=>$user_id);
		$query->page  = $page;
		$query->pagesize = 2;
		// $query->order = "sort";
		$data = $query->find();

		$this->buyerContractStatus($data);
		// tool::pre_dump($data);
		$pageBar =  $query->getPageBar();
		return array('data'=>$data,'bar'=>$pageBar);

	}

	/**
	 * 购买合同详情
	 * @param  int $id 订单id
	 * @param  string $identity buyer为购买合同 seller 为销售
	 * @return array   结果数组
	 */
	public function contractDetail($id,$identity = 'buyer'){
		$query = new Query('order_sell as do');
		$query->join  = 'left join product_offer as po on do.offer_id = po.id left join user as u on u.id = do.user_id left join products as p on po.product_id = p.id';
		$query->fields = 'do.*,p.name,po.price,do.amount,p.unit,po.product_id';
		$query->where = 'do.id=:id';
		$query->bind = array('id'=>$id);
		$res = $query->getObj();
		if($res['mode'] == self::ORDER_STORE){
			$query = new Query('store_list as s');
			$query->join = 'left join store_products as sp on s.id = sp.store_id';
			$query->where = 'sp.product_id = :product_id';
			$query->bind = array('product_id'=>$res['product_id']);
			$query->fields = 's.name as store_name';
			$data = $query->getObj();
			$res['store_name'] = $data['store_name'];
		}else{
			$res['store_name'] = '-';
		}
		$res = array($res);
		if($identity == 'seller'){
			$this->sellerContractStatus($res);
		}else{
			$this->buyerContractStatus($res);
		}
		return $res[0];
	}

	/**
	 * 获取销售合同状态
	 * @param  array &$data 销售合同订单数组
	 */
	private function sellerContractStatus(&$data){
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
						$href  = url::createUrl('/Order/confirmProofPage?order_id='.$value['id']);
					}
					break;
				case self::CONTRACT_DELIVERY_COMPLETE:
					$title = '提货已完成';
					break;
				case self::CONTRACT_VERIFY_QAULITY:
					
					if(empty($value['reduce_amount'])) {
						$title = '确认质量';
						$href = url::createUrl("/Order/sellerVerify?order_id={$value['id']}");
					}else{
						$title = '买家要求扣减货款';
						$href = url::createUrl("/Order/sellerVerify?order_id={$value['id']}&reduce=1");
					}
					break;
				case self::CONTRACT_SELLER_VERIFY:
					$title = '等待买方确认合同';
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
	}

	/**
	 * 获取购买合同状态
	 * @param  array &$data 购买合同订单数组
	 */
	private function buyerContractStatus(&$data){
		foreach ($data as $key => &$value) {
			$action = array();
			//根据合同状态得出对应操作
			$contract_status = $value['contract_status'];
			$href = '';
			switch ($contract_status) {
				case self::CONTRACT_NOTFORM:
					$title = '未支付定金';
					break;
				case self::CONTRACT_SELLER_DEPOSIT:
					$title = '等待卖家支付保证金';
					break;
				case self::CONTRACT_BUYER_RETAINAGE:
					if(empty($value['proof'])){
						$title = '支付尾款';
						$href = url::createUrl("/Order/buyerRetainage?order_id={$value['id']}");
						$action []= array('action'=>$title,'url'=>$href);
					}else{
						$title = '等待确认线下支付凭证';
					}
					break;
				case self::CONTRACT_CANCEL:
					$title = '合同已被卖家取消';
					break;
				case self::CONTRACT_EFFECT:
					//判断是否可以提货
					$delivery = new \nainai\delivery\Delivery;
					$left = $delivery->orderNumLeft($value['id']);
					if(is_float($left) && $left > 0.2){
						$title = '已生效,待提货';
						$href = url::createUrl("/delivery/newDelivery?order_id={$value['id']}");
						$action []= array('action'=>$title,'url'=>$href);
					}else{
						$title = '提货列表';
						$href = url::createUrl("/delivery/deliveryList?is_seller=0");
						$action []= array('action'=>$title,'url'=>$href);
					}
					break;
				case self::CONTRACT_COMPLETE:
					$title = '合同已完成';
					break;
				case self::CONTRACT_DELIVERY_COMPLETE:
					$title = '确认提货质量';
					$action []= array('action'=>'质量合格','url'=>url::createUrl("/Order/verifyQaulity?order_id={$value['id']}"));
					$action []= array('action'=>'扣减货款','url'=>url::createUrl("/Order/verifyQaulityPage?order_id={$value['id']}"));
					break;
				case self::CONTRACT_VERIFY_QAULITY:
					$title = '等待卖方确认质量';
					break;
				case self::CONTRACT_SELLER_VERIFY:
					$title = '确认合同结束';
					$href = url::createUrl("/Order/contractComplete?order_id={$value['id']}");
					$action []= array('action'=>$title,'url'=>$href);
					break;
				default:
					$title = '未知状态';
					break;
			}
			$value['title'] = $title;
			$value['action'] = $action;
			$value['action_href'] = $href;
		}
	}
}