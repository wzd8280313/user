<?php 
namespace Admin\Controller;
use Think\Upload;

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
				$this->logo_deal($data);
				$data['introduce']=\fanXSS($_POST['introduce']);
				if($goodsObj->add($data)){
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
	//处理图片
	private function logo_deal(&$data){
		$uploadObj=new \Think\Upload();
		$uploadObj->rootPath='./Public/Upload/';
		$res=$uploadObj->uploadOne($_FILES['goods_big_logo']);
		if(!$res) {
			$error = $uploadObj->getError();
			$this->error('图片错误,'.$error,U('Goods/tianjia',2));
			die;
		}
		$data['goods_big_logo']=$uploadObj->rootPath.$res['savepath'].$res['savename'];
		$thumb=new \Think\Image();
		$thumb->open($data['goods_big_logo']);
		$thumb->thumb(160,160,2);
		$smallimg=$uploadObj->rootPath.$res['savepath'].'s_'.$res['savename'];
		$thumb->save($smallimg);
		$data['goods_small_logo']=$smallimg;
	}
}

?>