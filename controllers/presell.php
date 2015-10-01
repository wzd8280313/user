<?php
class Presell extends IController
{
	public $checkRight  = 'all';
	public $layout = 'admin';

	function init()
	{
		IInterceptor::reg('CheckRights@onCreateAction');
	}
	
	public function presell_edit(){
		$id = IFilter::act(IReq::get('id'),'int');
		if($id){
			$presell_db = new IModel('presell');
			$presellRow = $presell_db->getObj('id='.$id);
			if(empty($presellRow)){
				$this->redirect('presell_list');
			}
			
			$goodsObj = new IModel('goods');
			$goodsRow = $goodsObj->getObj('id = '.$presellRow['goods_id'],'id as goods_id,name,sell_price,img');
			if($goodsRow)
			{
				$result = array(
						'isError' => false,
						'data'    => $goodsRow,
				);
			}
			else
			{
				$result = array(
						'isError' => true,
						'message' => '关联商品被删除，请重新选择要预售的商品',
				);
			}
			
			$presellRow['goodsRow'] = JSON::encode($result);
			$this->presellRow = $presellRow;
		}
		
		
		$this->redirect('presell_edit');
	}
	
	//预售提交处理
	public function presell_edit_act(){
		$id = IFilter::act(IReq::get('id'),'int');
		
		$dataArray = array(
			'name'  => IFilter::act(IReq::get('name')),
			'money_rate' => IFilter::act(IReq::get('money_rate'),'float'),
			'yu_end_time' => IFilter::act(IReq::get('yu_end_time')),
			'wei_start_time' => IFilter::act(IReq::get('wei_start_time')),
			'wei_end_time' => IFilter::act(IReq::get('wei_end_time')),
			'is_close' => IFilter::act(IReq::get('is_close'),'int'),
			'intro' => IFilter::act(IReq::get('intro')),
			'goods_id' => IFilter::act(IReq::get('goods_id'),'int'),
		);
		if(isset($_FILES['presell_img'])&&$_FILES['presell_img']['name']!='')
			$dataArray['presell_img'] = uploadHandle('presell_img');
		
		$presell_db = new IModel('presell');
		
		
		if($id){
			$presell_db->setData($dataArray);
			$presell_db->update('id='.$id);
		}else{
			$dataArray['create_time'] = ITime::getDateTime();
			$presell_db->setData($dataArray);
			$presell_db->add();
		}
		$this->redirect('presell_list');
	}
	//删除
	public function presell_del(){
		$id = IFilter::act(IReq::get('id'),'int');
		if(!empty($id))
		{
			$presellObj = new IModel('presell');
			if(is_array($id))
			{
				$idStr = join(',',$id);
				$where = ' id in ('.$idStr.')';
			}
			else
			{
				$where = 'id = '.$id;
			}
			$presellObj->del($where);
			$this->redirect('presell_list');
		}
		else
		{
			$this->redirect('presell_list',false);
			Util::showMessage('请选择要删除的id值');
		}
	}
	
}