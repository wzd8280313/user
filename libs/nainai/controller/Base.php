<?php

namespace nainai\controller;
use \Library\checkRight;
use \Library\url;

/**
 * 用户中心的抽象基类
 */
class Base extends \Yaf\Controller_Abstract{

	protected $certType = null;

	//认证页面方法，检测到未认证跳转到该位置
	private static $certPage = array(
		'deal'=>'dealcert',
		'store'=>'storecert'
	);

	 protected function init(){
		$right = new checkRight();
		$right->checkLogin($this);//未登录自动跳到登录页


		 // 需要认证的方法未认证则跳转到认证页面
		 // if($this->certType!==null  && (!isset($this->cert[$this->certType]) || $this->cert[$this->certType]==0))
		 // {
			//  $this->redirect(url::createUrl('/ucenter/'.self::$certPage[$this->certType].'@user'));exit;
		 // }


    }



}
