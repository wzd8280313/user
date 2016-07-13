<?php 
namespace Admin\Controller;
class GoodsController extends \Think\Controller{
	public function showListAction(){
		$goodsObj=\D('Goods');
		$info=$goodsObj->select();
		$this->assign('info',$info);
		$this->display();
	}
	public function tianjiaAction(){
		$goodsObj=\D('Goods');
		if(IS_POST){
			if($data=$goodsObj->create()){
				$data['introduce']=\fanXSS($_POST['introduce']);
				if($goodsObj->add()){
					$this->success('添加商品成功',U('Goods/showList'),2);
					die;
				}else{
					$this->error('添加商品失败',U('Goods/tianjia',2));
					die;
				}
			}else{
				$this->error('添加失败',U('Goods/tianjia',2));
				die;
			}
		}
		$this->display();
	}
	public function updAction(){
		$this->display();
	}
}

?>