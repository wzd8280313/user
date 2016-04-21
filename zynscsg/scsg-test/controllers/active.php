<?php 
/*
活动
 */
class active extends IController{
	public $layout='site';
	public function active_list(){
		$m_active=new IQuery('active');
		//echo time();
		$m_active->where='is_close=0 and create_time <"'.date('Y-m-d H:i:s',time()).'" and end_time >"'.date('Y-m-d H:i:s',time()).'"';
		$activeinfo=$m_active->find();
		$this->activeinfo=$activeinfo;
		//var_dump($activeinfo);
		//判断type值选择哪个模版
		foreach($this->activeinfo as $k=>$value){
			//echo $value['name'];
			//var_dump($value);
		}

		if($activeinfo[0]['type']==0){
		$this->redirect('active_list');
		}elseif($activeinfo[0]['type'==1]){
			$this->redirect('active_list1');
		}

	}


}



?>