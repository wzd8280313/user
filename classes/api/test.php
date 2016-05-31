<?php 
/*
自定义接口类
 */
class ApiTest{
	public function test1(){
		$m_model=new IModel('test');
		$where='id = 8';
		$result=$m_model->getObj($where,'id,name');

		return $result;
	}
	
}

?>