<?php
/**
 * @author panduo
 * @date 2016-05-12 15:41:58
 * @brief 提货基类
 *
 */
namespace nainai\delivery;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;
use nainai\order;
class Delivery{

	//提货状态常量
	const DELIVERY_APPLY = 0;//买方申请提货
	const DELIVERY_BUYER_CONFIRM = 1;//卖方已发货，等待买方确认 （保证金）
	const DELIVERY_MANAGER_CHECKOUT = 2;//卖方支付仓库费,等待仓库管理员确认出库（仓单）
	const DELIVERY_ADMIN_CHECK = 3;//等待后台管理员审核（仓单）
	const DELIVERY_AGAIN = 4;//余量大于20% 需再次提货
	const DELIVERY_COMPLETE = 5;//余量小于20%，提货结束，等待买方确认质量
	
	protected $delivery;//提货表M对象
	protected $order;//订单表M对象
	protected $order_type;//订单类型
	protected $offer;//报盘表
	protected $account;//用户资金类
	protected $paylog;//日志

	/**
	 * 规则
	 */
	protected $deliveryRules = array(
		array('id','number','id错误',0,'regex'),
		array('offer_id','number','报盘id错误',0,'regex'),
		array('delivery_id','number','订单id错误',0,'regex'),
		array('delivery_man','require','请填写提货人',0),
		array('phone','require','请填写联系电话',0),
		array('idcard','require','请填写身份证号',0),
		array('plate_number','require','请填写车牌号',0),
	);


	public function __construct($order_type = 0){
		$this->order = new M('order_sell');
		$this->order_type = $order_type;
		$this->delivery = new M('product_delivery');
		$this->offer = new M('product_offer');
		$this->account = new \nainai\fund\agentAccount();
	}	

	/**
	 * 根据提货表id获取相应记录信息		
	 * @param  int $delivery_id 提货表id	
	 * @return array $res  信息数组
	 */
	public function deliveryInfo($delivery_id){
		return empty($delivery_id) ? array() : $this->delivery->where(array('id'=>$delivery_id))->getObj();
	}
	
	/**
	 * 获取当前用户可提货与已提货列表			
	 * @param  int $user_id 用户id
	 * @param  int $page 当前页
	 * @param  boolean  $is_seller 是否为卖家,默认为买家
	 * @return array  结果数组
	 */
	public function deliveryList($user_id,$page,$is_seller = false){
		$t = $is_seller ? 'off' : 'po';
		$query = new Query('order_sell as po');
		$query->join = 'left join product_delivery as pd on po.id = pd.order_id left join product_offer as off on po.offer_id = off.id left join products as p on off.product_id = p.id left join store_products as sp on sp.product_id = off.product_id left join store_list as sl on sl.id = sp.store_id';
		$query->where = $t.'.user_id=:user_id and po.mode in ('.order\Order::ORDER_DEPOSIT.','.order\Order::ORDER_STORE.') and po.contract_status in ('.order\Order::CONTRACT_COMPLETE.','.order\Order::CONTRACT_EFFECT.','.order\Order::CONTRACT_VERIFY_QAULITY.','.order\Order::CONTRACT_DELIVERY_COMPLETE.')';
		$query->fields = 'po.*,pd.num as delivery_num,pd.create_time as delivery_time,pd.status,pd.id as delivery_id,p.name,p.unit,sl.name as store_name';
		$query->order = 'pd.create_time desc';
		// $query->order = 'po.order_no,pd.status asc';
		$query->bind = array('user_id'=>$user_id);
		$query->page  = $page;
		$query->pagesize = 5;
		$data = $query->find();
		$pageBar =  $query->getPageBar();
		$arr = array();

		foreach ($data as $key => &$value) {
			$href = '';
			$action = array();
			$value['status'] = $value['status'] == null ? -1 : $value['status'];
			$value['delivery_id'] = empty($value['delivery_id']) ? '-' : $value['delivery_id'];
			$value['delivery_num'] = number_format($value['delivery_num'],2);
			$value['num'] = number_format($value['num'],2);
			$value['store_name'] = $value['mode'] == order\Order::ORDER_DEPOSIT ? '-' : (empty($value['store_name']) ? '无效仓库' : $value['store_name']);

			switch ($value['status']) {
				case -1:
					if(!$is_seller){
						$title = '可提货';
						$href = url::createUrl("/delivery/newDelivery?order_id={$value['id']}");
						$action []= array('name'=>'提货','url'=>$href);
					}else{
						$title = '等待买家提货';
					}
					break;
				case self::DELIVERY_APPLY:
					if(!$is_seller){
						$title = '已申请提货';
					}else{
						$title = '买家申请提货';
						if($value['mode'] == order\Order::ORDER_DEPOSIT){
							//卖家发货（保证金提货）
							$href = url::createUrl("/depositDelivery/sellerConsignment?id={$value['delivery_id']}");
							$action []= array('name'=>'发货','url'=>$href);
						}else{
							//支付仓库费用（仓单提货）
							$href = url::createUrl("/storeDelivery/storeFees?id={$value['delivery_id']}");
							$action []= array('name'=>'支付仓库费用（余额）','url'=>$href);
						}
					}
					break;
				case self::DELIVERY_BUYER_CONFIRM:
					if(!$is_seller){
						$title = '确认收货';
						$href = url::createUrl('/depositDelivery/buyerConfirm?id='.$value['delivery_id']);
						$action []= array('name'=>'确认本轮收货','url'=>$href);
					}else{
						$title = '等待买家收货';
					}
					break;
				case self::DELIVERY_AGAIN:
					$title = '本轮提货完成';

					break;
				case self::DELIVERY_MANAGER_CHECKOUT:
					$title = '等待仓库管理确认';
					break;
				case self::DELIVERY_ADMIN_CHECK:
					$title = '等待后台管理员审核';
					break;
				case self::DELIVERY_COMPLETE:
					$title = '全部提货完成';
					break;
				default:
					$title = '未知状态';
					break;
			}
			// $this->addNewDelivery($value);
			$value['action'] = $action;
			$value['title'] = $title;
			$value['href'] = $href;
		}
		// foreach ($arr as $key => $v) {
		// 	array_splice($data, $key,0,array($v));
		// }
		// var_dump($data);
		return array('data'=>$data,'bar'=>$pageBar);
	}

	// private function addNewDelivery($value){
	// 	static $arr;
	// 	if($value['status'] != -1 && $value['status'] != self::DELIVERY_COMPLETE && !$is_seller){
	// 		//判重
	// 		$flag = true;
	// 		foreach ($arr as $k => $v) {
	// 			echo $v['order_no'].'/'.$value['order_no'].'---';
	// 			if($value['id'] == $v['id']) {
	// 				$flag = false;
	// 				break;
	// 			}
	// 		}
	// 		var_dump($flag);
	// 		if($flag){
	// 			//判断是否可以提货
	// 			$left = $this->orderNumLeft($value['id']);
	// 			if($left > 0.2){
	// 				$tmp = $value;
	// 				$tmp['delivery_id'] = '-';
	// 				$tmp['delivery_num'] = '-';
	// 				$tmp['unit'] = '';
	// 				$tmp['create_time'] = '-';
	// 				$tmp['status'] = -1;
	// 				$tmp['title'] = '可提货';
	// 				$tmp['action'] []= array('name'=>'提货','url'=>url::createUrl("/delivery/newDelivery?order_id={$value['id']}"));
	// 				$arr [$key]= $tmp;
	// 			}
	// 		}
	// 	}
	// }

	/**
	 * 提货相关仓库信息
	 * @param  int $order_id 订单id
	 * @return array  结果数组
	 */
	public function deliveryStore($order_id){
		$query = new Query('order_sell as os');
		$query->join = 'left join product_offer as po on po.id = os.offer_id left join products as p on po.product_id = p.id left join store_products as sp on sp.product_id = p.id left join store_list as sl on sl.id = sp.store_id';
		$query->where = 'os.id=:order_id';
		$query->bind = array('order_id'=>$order_id);
		$query->fields = 'os.id,p.name,sl.name as store_name,os.num,p.unit';

		$res = $query->getObj();
		return $res;
	}

	/**
	 * 新增或更新提货数据	
	 * @param  array $data 数据
	 * @return array $res  返回结果信息
	 */
	final protected function deliveryUpdate($data){
		$delivery = $this->delivery;
		if($delivery->data($data)->validate($this->deliveryRules)){
			if(isset($data['id']) && $data['id']>0){
				$id = $data['id'];
				//编辑
				unset($data['id']);
				$res = $delivery->where(array('id'=>$id))->data($data)->update();
				$res = $res>0 ? true : ($delivery->getError() ? $delivery->getError() : '数据未修改');
			}else{
				try {
					$delivery->beginTrans();
					$delivery_id = $delivery->data($data)->add();
					
					$res = $delivery->commit();	
				} catch (PDOException $e) {
					$delivery->rollBack();
					$res = $e->getMessage();
				}
			}
		}else{
			$res = $delivery->getError();
		}
		
		if($res === true){
			$resInfo = tool::getSuccInfo();
			if(isset($delivery_id)){
				$resInfo['delivery_id'] = $delivery_id;
			}
		}else{
			$resInfo = tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
		}
		return $resInfo;
	}

	/**
	 * 验证提货数据是否已存在
	 * @param object $delivery 提货表对象
	 * @param array $deliveryData 提货数据
	 * @return bool  存在 true 否则 false
     */
	private function existdeliveryData($delivery,$deliveryData){
		$data = $delivery->fields('id')->where($deliveryData)->getObj();
		if(empty($data))
			return false;
		return true;
	}

	//处理买方提货申请，生成提货记录
	public function geneDelivery($deliveryData){
		$deliveryData['status'] = self::DELIVERY_APPLY;
		$order_info = $this->order->where(array('id'=>$deliveryData['order_id']))->fields('contract_status,mode,user_id,offer_id')->getObj();
		if(!empty($order_info)){
			if($order_info['user_id'] == $deliveryData['user_id']){
				$contract_status = $order_info['contract_status'];
				//订单合同状态须为已生效,订单类型须为保证金或者仓单
				if(isset($contract_status) && $contract_status == order\Order::CONTRACT_EFFECT && in_array($order_info['mode'],array(order\Order::ORDER_DEPOSIT,order\Order::ORDER_STORE))){
					$product_valid = $this->orderNumValid($deliveryData['order_id'],$deliveryData['num']);
					if($product_valid !== true){
						$error = '提货数量有误';
					}else{
						unset($deliveryData['user_id']);
						$deliveryData['offer_id'] = $order_info['offer_id'];
						$deliveryData['create_time'] = date('Y-m-d H:i:s',time());
						$res = $this->deliveryUpdate($deliveryData);
					}
				}else{
					$error = '订单状态有误';
				}
			}else{
				$error = '操作用户错误';
			}
		}else{
			$error = '无效订单';
		}
		return isset($res) ? $res : tool::getSuccInfo(0,$error);
	}

	/**
	 * 检验当前提货申请货物数量是否合法		
	 * @param  int $order_id 待提货订单id
	 * @param  float $num    申请提货数量
	 * @return bool  $res    true:合法 false:不合法
	 */
	public function orderNumValid($order_id,$num){
		$num = floatval($num);
		if(empty(intval($order_id)) || $num <= 0) return false;

		//查询订单商品总数
		$total_num = $this->order->where(array('id'=>$order_id))->getfield('num');
		if(empty(floatval($total_num))) return false;

		//查询对应订单id所有提货记录
		$record = $this->delivery->where(array('order_id'=>$order_id))->select();
		if(empty($record)){
			return $num <= $total_num ? true : false;
		}else{
			$record_num = 0;
			foreach ($record as $key => $value) {
				$record_num += $value['num'];
			}
			return $total_num - $record_num < 0 ? false : ($num <= ($total_num - $record_num) ? true : false);
		}
	}

	/**
	 * 检验订单未提货物量	
	 * @param  int $order_id 订单id
	 * @param  boolean  $percent 是否返回百分比格式
	 * @param  boolean  $once_complete  是否只计提货单状态为 本轮或全部完成
	 * @return mix $res      float:百分比或数量 string:错误信息
	 */
	public function orderNumLeft($order_id,$percent = true,$once_complete = false){
		if(empty(intval($order_id))) return '参数错误';

		//查询订单商品总数
		$total_num = $this->order->where(array('id'=>$order_id))->getfield('num');
		$total_num = floatval($total_num);

		if(empty($total_num)) return '无效订单';

		//查询对应订单id所有提货记录
		$record = $this->delivery->where(array('order_id'=>$order_id))->select();

		if(empty($record)){
			return $percent ? 1.0 : $total_num;
		}else{
			$record_num = 0.0;
			foreach ($record as $key => $value) {
				if(!$once_complete){
					$record_num += $value['num'];
				}
				switch ($value['status']) {
					case self::DELIVERY_AGAIN:
						if($once_complete){
							$record_num += $value['num'];
						}
						break;
					case self::DELIVERY_COMPLETE:
						if($once_complete){
							$record_num += $value['num'];
							break;
						}else{
							return '此订单已提货完毕';
						}
					default:
						break;
				}
			}

			return $percent ? ($total_num - $record_num) / $total_num : $total_num - $record_num;
		}
	}


}