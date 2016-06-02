<?php
/**
 * @author panduo
 * @date 2016-5-9
 * @brief 委托订单表 暂只支持余额支付
 *
 */
namespace nainai\order;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;
class entrustOrder extends Order{
	
	public function __construct(){
		parent::__construct(parent::ORDER_ENTRUST);
	}
	
}




