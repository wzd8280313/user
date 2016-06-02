<?php
/*
出金审核操作类
author: wangzhande
Date:2016-5-6
 */
use Library\JSON;
use Library\safe;
use Library\tool;

class fundOutController extends Yaf\Controller_Abstract {
	public function init() {
		$this->getView()->setLayout('admin');
	}
	//出金列表
	public function fundOutListAction() {
		$page = safe::filterGet('page', 'int');
		$fundOutModel = new fundOutModel();
		$data = $fundOutModel->getFundOutList($page);

		//分配数据
		$this->getView()->assign('outInfo', $data[0]);
		$this->getView()->assign('outBar', $data[1]);

	}
	//出金详情页
	public function fundOutEditAction() {
		$id = safe::filterGet('id', 'int');

		$fundOutModel = new fundOutModel();
		$data = $fundOutModel->fundOutDetail($id);
		$controllerName = $this->getRequest()->getControllerName();
		$moduleName = $this->getRequest()->getModuleName();
		$data['url'] = \Library\url::createUrl($moduleName . '/' . $controllerName . '/' . $data['action']);
		$data['proot'] = \Library\Thumb::get($data['proot'],180,180);
		$data['bank_proof'] = \Library\Thumb::get($data['bank_proof'],180,180);
		$this->getView()->assign('outInfo', $data);
	}
	//出金初审
	public function firstCheckAction() {
		if(IS_AJAX && IS_POST){
			$id = safe::filterPost('out_id', 'int');
			$status = safe::filterPost('status', 'int');
			$message = safe::filterPost('message');
			$fundOutModel = new fundOutModel();
			$res = $fundOutModel->fundOutFirst($id, $status, $message);
			die(JSON::encode(tool::getSuccInfo($res['code'], $res['info'])));
		}

	}
	//出金终审
	public function finalCheckAction() {
		if(IS_AJAX && IS_POST){
			$id = safe::filterPost('out_id', 'int');
			$status = safe::filterPost('status', 'int');
			$message = safe::filterPost('message');
			$fundOutModel = new fundOutModel();
			$res = $fundOutModel->fundOutFinal($id, $status, $message);
			die(JSON::encode(tool::getSuccInfo($res['code'], $res['info'])));
		}

	}
	//上传凭证
	public function transferAction() {
		if(IS_AJAX && IS_POST){
			$id = safe::filterPost('out_id', 'int',0);
			$proof = safe::filterPost('imgfile2');


			if(!$id || $proof==''){
				die(JSON::encode(tool::getSuccInfo(0,'请上传打款凭证'))) ;
			}

			$proof = tool::setImgApp($proof);
			$fundOutModel = new fundOutModel();
			$res = $fundOutModel->fundOutTransfer($id,$proof);
			die(JSON::encode(tool::getSuccInfo($res['code'], $res['info'])));
		}
	}

	public function delAction() {
		if(IS_AJAX && IS_POST) {
			$id = safe::filterGet('id', 'int');
			$fundOutModel = new fundOutModel();
			$res = $fundOutModel->logicDel($id);
			echo JSON::encode($res);
			return false;
		}
	}

	/**
	 * ajax上传图片
	 * @return bool
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