<?php
/*
 *充值类
 * author：wzd
 * Date:2016/4/30
 */

//use Library\payments\payment;
use \Library\M;
use \Library\Payment;
use \Library\safe;
use \Library\JSON;
use \Library\Session;

class FundController extends UcenterBaseController {

	protected  $certType = 'deal';
	public function indexAction() {

		$fundObj = \nainai\fund::createFund(1);

		$active = $fundObj->getActive($this->user_id);
		$freeze = $fundObj->getFreeze($this->user_id);
		$flowData = $fundObj->getFundFlow($this->user_id);

		$this->getView()->assign('freeze',$freeze);
		$this->getView()->assign('active',$active);
		$this->getView()->assign('flow',$flowData);
		//$obj = new \nainai\fund();
	}


	protected function  getLeftArray(){
		return array(

			array('name' => '资金管理', 'list' => array()),
			array('name'=>'开户信息管理','url'=>\Library\url::createUrl('/Fund/bank'),'action'=>array('bank')),
			array('name' => '资金账户管理', 'list' => array(
				array('url' => \Library\url::createUrl('/Fund/index'), 'title' => '市场代理账户' ,'action'=>array('tx','cz')),
				array('url' => '', 'title' => '票据账户' ),
			)),

		);
	}
	//处理充值操作
	public function doFundInAction() {

		$payment_id = safe::filterPost('payment_id', 'int');
		$recharge = safe::filterPost('recharge', 'float');

		//在线充值

		if (isset($payment_id) && $payment_id != '') {
			$paymentInstance = Payment::createPaymentInstance($payment_id);
			$paymentRow = Payment::getPaymentById($payment_id);

			//account:充值金额; paymentName:支付方式名字
			$reData = array('account' => $recharge, 'paymentName' => $paymentRow, 'payType' => $payment_id);

			$sendData = $paymentInstance->getSendData(Payment::getPaymentInfo($payment_id, 'recharge', $reData));

			$paymentInstance->doPay($sendData);
		}
		//线下支付
		else {

			$payment_id = 1;
			//处理图片
			$proof = safe::filterPost('imgfile1');

			if (!isset($recharge) || $recharge <= 0) {
				die(json::encode(0,'金额不正确'))  ;
			}
			//var_dump($_FILES);
			if ($proof) {

				$rechargeObj = new M('recharge_order');
				$reData = array(
					//'user_id' => Session::get('user_id'),
					'user_id' => $this->user_id,
					'order_no' => Payment::createOrderNum(),
					//资金
					'amount' => $recharge,
					'create_time' => Payment::getDateTime(),
					'proot' => \Library\Tool::setImgApp($proof),
					'status' => '0',
					//支付方式
					'pay_type' => $payment_id,
				);

				$r_id = $rechargeObj->data($reData)->add();
				if($r_id){
					die(json::encode(\Library\tool::getSuccInfo()));
				}

			} else {
				die(json::encode(\Library\tool::getSuccInfo(0,'请上传凭证')));
				//请上传支付凭证

			}
		}

	}
	//充值视图
	public function czAction() {

	}

	//提现视图
	public function txAction() {
		$fund = new fundModel();
		$bankData = $fund->getBankInfo();
		if(empty($bankData)){
			$this->redirect('bank');
		}
		$token =  \Library\safe::createToken();
		$this->getView()->assign('token',$token);
	}
	//提现提交处理
	public function dofundOutAction() {
		$user_id = $this->user_id;
		$token = safe::filterPost('token');
		if(!safe::checkToken($token))
			return false;
		//提现申请表
		$data = array(
			'user_id' => $user_id,
			'request_no' => self::createRefundNum(),
			'amount' => safe::filterPost('amount', 'float'),
			'note' => safe::filterPost('note'),
			'create_time' => \Library\Time::getDateTime(),
		);
		$fundModel = new fundModel();
		$res = $fundModel->fundOutApply($user_id,$data);

		die(json::encode($res));

	}
	//退款订单
	public static function createRefundNum() {
		return 'gold_' . date('YmdHis') . rand(100000, 999999);
	}

	/**
	 * [bankAction 添加开户信息]
	 * @return    [type]      [description]
	 */
	public function bankAction(){
		$fundModel = new fundModel();
		if(IS_POST||IS_AJAX){
			$data=array(
				'user_id'=>$this->user_id,
				'bank_name'=>safe::filterPost('bank_name'),
				'card_type'=>safe::filterPost('card_type'),
				'card_no'=>safe::filterPost('card_no'),
				'true_name'=>safe::filterPost('true_name'),
				'identify_no'=>safe::filterPost('identify'),
				'proof'=>\Library\tool::setImgApp(safe::filterPost('imgfile2'))
			);

			$res = $fundModel->bankUpdate($data);
			die(json::encode($res));
		}
		else{//获取数据
			$data = $fundModel->getbankInfo($this->user_id);
			$data['proof_thumb'] = \Library\thumb::get($data['proof'],180,180);
			$type = $fundModel->getCardType();
			$this->getView()->assign('bank',$data);
			$this->getView()->assign('type',$type);
		}
	}

	/**
	 * [upload ajax上传]
	 * @return    [type]      [description]
	 */
	public function uploadAction(){

		//调用文件上传类
		$photoObj = new \Library\photoupload();
		$photoObj->setThumbParams(array(180,180));
		$photo = current($photoObj->uploadPhoto());

		if($photo['flag'] == 1)
		{
			$result = array(
				'flag'=> 1,
				'img' => $photo['img'],
				'thumb'=> $photo['thumb'][1]
			);
		}
		else
		{
			$result = array('flag'=> $photo['flag'],'error'=>$photo['errInfo']);
		}
		echo JSON::encode($result);

		return false;
	}

}
?>