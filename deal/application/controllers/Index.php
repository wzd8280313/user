<?php
/**
 * @name IndexController
 * @author root
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
use \DB\M;
use \tool\http;
use \common\url;
use \common\tool;
class IndexController extends Yaf\Controller_Abstract {


	public function init(){

		//echo $this->getViewPath();
	}
	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/yar-demo/index/index/index/name/root 的时候, 你就会发现不同
     */
	public function indexAction() {

	}

	public function showAction(){

	}

	public function urlAction(){
		$url = '  cli/test/index   name =45   address = shanxi';
		$createUrl = url::createUrl($url);
		echo url::getUri();
		return false;

	}
}
