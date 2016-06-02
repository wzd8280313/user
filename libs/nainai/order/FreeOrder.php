<?php
/**
 * @author panduo
 * @date 2016-4-25
 * @brief 自由摘牌订单表 暂只支持余额支付
 *
 */
namespace nainai\order;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;
class FreeOrder extends Order{
	
	public function __construct(){
		parent::__construct(parent::ORDER_FREE);
	}
}




