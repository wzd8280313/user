<?php

namespace nainai\user;

use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;

class UserInvoice extends \nainai\Abstruct\ModelAbstract {

	public $pk = 'user_id';

	/**
	 * 添加开票验证规程
	 * @var array
	 */
	protected $Rules = array(
	    array('title','s{2,30}','必须填写发票抬头'),
	    array('tax_no','/^[a-zA-Z0-9_]{6,40}$/','必须填写纳税人识别号'),
	    array('address','/^[\S]{2,40}$/','必须填写地址'),
	    array('phone','/^[0-9\-]{6,12}$/','必须填写电话'),
	    array('bank_name','s{2,20}','必须填写银行名称'),
	    array('bank_no','s{6,20}','必须填写银行卡号')
	);

}