<?php
/**
 * @name MemberController
 * @author weipinglee
 * @desc 用户管理控制器
 */
use \Library\safe;
use \nainai\certificate;
use \Library\Thumb;
use \nainai\subRight;
use \Library\url;
class MemberController extends Yaf\Controller_Abstract {


	public function init(){
		$this->getView()->setLayout('admin');
		//echo $this->getViewPath();
	}
	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/yar-demo/index/index/index/name/root 的时候, 你就会发现不同
     */
	public function indexAction() {


	}

	/**
	 * 获取会员列表
	 */
	public function memberListAction(){

		$m = new MemberModel();
		$page = safe::filterGet('page','int');
		$pageData = $m->getList($page);
		$this->getView()->assign('member',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);
	}



	/**
	 *角色添加页面，如果传递参数id，则为更新
	 *
	 */
	public function roleAddAction(){
		$id = $this->getRequest()->getParam('id',0);
		$id = safe::filter($id,'int',0);
		$subModel = new subRight();
		if($id){//编辑情形
			$roleData = $subModel->getRoleData($id);
			$this->getView()->assign('roleData',$roleData);
		}
		$dataTree = $subModel->getSubRights();
		$this->getView()->assign('tree',$dataTree);

	}

	/**
	 * 子账户角色添加处理
	 * @return bool
	 */
	public function doRoleAddAction(){
		if(IS_POST){
			$role['id']   = safe::filterPost('role_id','int',0);
			$role['name'] = safe::filterPost('role_name');
			$role['status'] = safe::filterPost('status','int');
			$role['note'] = safe::filterPost('role_note');
			$first_role_id = isset($_POST['first_role_id'])?$_POST['first_role_id'] : array();
			$second_role_id = isset($_POST['second_role_id'])?$_POST['second_role_id'] : array();
			$third_role_id = isset($_POST['third_role_id'])?$_POST['third_role_id'] : array();

			//如果存在某个应用级权限，则删除其下的子权限（控制器级和方法级)，同时将应用及权限代码写入数组
			$right_ids = array();
			if(!empty($first_role_id)){
				foreach($first_role_id as $key=>$v){
					if(is_numeric($v))$right_ids[] = $v;
					if(isset($second_role_id[$v])){
						unset($second_role_id[$v]);
					}
					if(isset($third_role_id[$v])){
						unset($third_role_id[$v]);
					}
				}
			}
			//如果存在某个控制器权限，则删除其下的子权限（方法级)，同时将控制器级权限写入数组
			if(!empty($second_role_id)){
				foreach($second_role_id as $key=>$val){
					foreach($second_role_id[$key] as $k=>$v){
						if(is_numeric($v))$right_ids[] = $v;
						if(isset($third_role_id[$key][$v])){
							unset($third_role_id[$key][$v]);
						}
					}

				}
			}
			//将剩下的方法级权限写入数组
			if(!empty($third_role_id)){
				foreach($third_role_id as $k=>$v){
					foreach($third_role_id[$k] as $k1=>$v1){
						foreach($third_role_id[$k][$k1] as $k2 =>$v2){
							if(is_numeric($v2))$right_ids[] = $v2;
						}
					}
				}
			}
			$role['right_id'] = $right_ids;


			$subRight = new subRight();
			if($role['id']==0){
				$res = $subRight->addRole($role);
			}
			else{
				$res = $subRight->updateRole($role);
			}

			if($res['success']==1){
				$this->redirect('subRoleList');
			}
			else{
				echo $res['info'];
			}
		}

		return false;
	}



	/**
	 * 子账户角色列表
	 *
	 */
	public function subRoleListAction(){
		$m = new subRight();
		$page = safe::filterGet('page','int');
		$pageData = $m->getRoleList($page);
		$this->getView()->assign('subroles',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);
	}

	/**
	 * 子账户角色删除
	 */
	public function subRoleDelAction(){
		$id = $this->getRequest()->getParam('id',0);
		$id = safe::filter($id,'int',0);
		if($id){
			$m = new subRight();
			$res = $m->delRoleData($id);

				$this->redirect(url::createUrl('/member/subRoleList'));
			
		}
		return false;
	}







}
