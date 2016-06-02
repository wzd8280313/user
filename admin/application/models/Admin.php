<?php
/**
 * @date 2016-4-7
 * 后台管理员操作
 *
 */

use \Library\M;
use \Library\Query;
use \Library\tool;
class AdminModel{

	//模型对象实例
	private $adminObj;
	public function __construct(){
		$this->adminObj = new M('admin');
	}
	/**
	 * 管理员账户规则
	 * @var array
	 */
	protected $adminRules = array(
		array('id','number','id错误',0,'regex'),
		array('password','/^\S{6,40}$/','密码格式错误',0,'regex'),
		array('email','email','邮箱格式错误',0,'regex'),
		array('role','/^[1-9]\d*$/','分组id错误',0,'regex'),
	);

	/**
	 * 获取管理员列表
	 * @param  int $page 当前页index
	 * @return array
	 */
	public function getList($page,$name){
		$super_admin = tool::getConfig(array("rbac","super_admin"));
		$Q = new Query('admin as a');
		$Q->join = 'left join admin_role as r on a.role = r.id';
		$Q->page = $page;
		$Q->pagesize = 5;
		$Q->fields = "a.*,r.name as role_name";
		$Q->order = "a.create_time desc";
		$Q->where = "a.name <> '$super_admin' and a.status >= 0 ".($name ? " and a.name like '%$name%'" : '');
		$data = $Q->find();
		$pageBar =  $Q->getPageBar();
		return array('data'=>$data,'bar'=>$pageBar);
	}
	
	/**
	 * 新增或编辑后台管理员
	 * @param  array 操作数据数组
	 * @return mixed
	 */
	public function adminUpdate($data){
		$admin = $this->adminObj;
		if($admin->data($data)->validate($this->adminRules)){
			if(isset($data['id']) && $data['id']>0){
				$id = $data['id'];
				if(isset($data['name']) && $this->existAdmin(array('name'=>$data['name'],'id'=>array('neq',$id))))
					return tool::getSuccInfo(0,'用户名已注册');

				if(isset($data['email']) && $this->existAdmin(array('email'=>$data['email'],'id'=>array('neq',$id))))
					return tool::getSuccInfo(0,'邮箱已注册');
				//编辑
				unset($data['id']);
				$res = $admin->where(array('id'=>$id))->data($data)->update();
				$res = is_int($res) && $res>0 ? true : ($admin->getError() ? $admin->getError() : '数据未修改');
			}else{
				if($this->existAdmin(array('name'=>$data['name'])))
					return tool::getSuccInfo(0,'用户名已注册');

				if($this->existAdmin(array('email'=>$data['email'])))
					return tool::getSuccInfo(0,'邮箱已注册');
				$admin->password = $data['password'] = sha1($data['password']);
				$admin->beginTrans();
				$aid = $admin->add();
				//权限添加TODO
				$res = $admin->commit();
			}
		}else{
			$res = $admin->getError();
		}
	
		
		if($res===true){
			$resInfo = tool::getSuccInfo();
		}
		else{
			$resInfo = tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
		}
		return $resInfo;
	}

	/**
	 * 验证用户是否已注册
	 * @param array $userData 用户数据
	 * @return bool  存在 true 否则 false
     */
	public function existAdmin($adminData){
		$data = $this->adminObj->fields('id')->where($adminData)->getObj();
		if(empty($data))
			return false;
		return true;
	}

	/**
	 * 根据id获取管理员信息
	 * 
	 * @param  int $id 管理员id
	 * @return array  管理员信息
	 */
	public function getAdminInfo($id){
		$info = $this->adminObj->where(array('id'=>$id))->getObj();
		return $info ? $info : array();
	}

	//管理员操作记录 默认登陆
	public function adminLog($admin_id,$ip,$type = 'login'){
		if(intval($admin_id) > 0 && !empty($type)){
			$admin_log = new M('admin_log');
			return $admin_log->data(array('admin_id'=>$admin_id,'ip'=>$ip,'type'=>$type,'time'=>date('Y-m-d H:i:s',time())))->add();
		}else{
			return '参数错误';
		}
	}

	//获取管理员操作记录
	public function logList($page,$name='')
	{
		$Q = new Query('admin as a');
		$Q->join = 'right join admin_log as l on a.id = l.admin_id';
		$Q->page = $page;
		$Q->pagesize = 5;
		$Q->fields = "l.*,a.name";
		$Q->order = "l.time desc";
		$Q->where = "a.status >= 0 ".($name ? " and a.name like '%$name%'" : '');
		$data = $Q->find();
		foreach ($data as $key => &$value) {
			switch ($value['type']) {
				case 'login':
					$type = '登录';
					break;
				
				default:
					$type = '登录';
					break;
			}
			$value['type_txt'] = $type;
		}
		$pageBar =  $Q->getPageBar();
		return array('data'=>$data,'bar'=>$pageBar);
	}

}