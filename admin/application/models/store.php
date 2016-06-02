<?php
/**
 * @date 2016-4-5
 * 后台仓库管理
 *
 */
use \Library\M;
use \Library\Query;
use \Library\tool;
class StoreModel extends \baseModel{

	/**
	 * 验证规则：
	 * array(字段，规则，错误信息，条件，附加规则，时间）
	 * 条件：0：存在字段则验证 1：必须验证 2：不为空时验证
	 *
	 */
	/**
	 * @var
	 */
	protected $rules = array(
		array('id','number','id错误',0,'regex'),
		array('name','require','仓库名必填'),
		array('area','number','地区错误'),
		array('address','require','填写详细地址'),
		array('service_phone','/[\d\-]{6,15}/','电话号码错误'),
		array('service_address','require','请填写服务点地址'),
		array('contact','require','请填写联系人'),
		array('contact_phone','/[\d\-]{6,15}/','请填写联系人电话'),
		array('type',array(0,1),'请正确选择仓库类型',0,'in'),
		array('status',array(0,1),'请正确选择仓库类型',0,'in'),
		array('img','/^[a-zA-Z0-9_@\.\/]+$/','请上传图片',2),
	);

	protected $table = 'store_list';
	/**
	 * @param int $type 仓库类型
	 */
	public function getStoreType($type=-1){
		$typeArr = array(
			0=>'正常仓库',
			1=>'监管仓库'
		);
		if($type==-1)
			return $typeArr;
		else if(isset($typeArr[$type]))
			return $typeArr[$type];
		else return '未知';

	}

	/**
	 * 获取仓库列表
	 * @param int $page 页码
	 * @return array 分页数据和分页bar
	 */
	public function getStoreList($page){
		$Q = new Query('store_list');
		$Q->page = $page;
		$Q->pagesize = 5;
		$data = $Q->find();
		$pageBar =  $Q->getPageBar();
		return array('data'=>$data,'bar'=>$pageBar);
	}

	/**
	 * 获取一条仓库数据
	 * @param int $id
	 */
	public function getStoreInfo($id){
		$storeObj = new M('store_list');
		return $storeObj->where(array('id'=>$id))->getObj();
	}



}