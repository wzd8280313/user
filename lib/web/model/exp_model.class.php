<?php
class expImodel extends IModel{
	
	public function update($where){
		
		//获取更新数据
		$tableObj  = $this->tableData;
		$updateStr = '';
		$where     = (strtolower($where) == 'all') ? '' : ' WHERE '.$where;
		
		foreach($tableObj as $key => $val)
		{
				$updateStr.= '`'.$key.'` = '.$val;
		}
		$sql = 'UPDATE '.$this->tableName.' SET '.$updateStr.$where;
		return $this->db->query($sql);
	}
	//某个字段累加一个数
	/*
	 * @$where array or str条件
	 * @$addArr array 累加的字段和数量array('field'=>$num)
	 */
	public function addNum($where,$addArr){
		$con = ' WHERE ';
		if(isset($where) && is_array($where)){
			foreach($where as $key=>$val){
				$con .= $key . ' = "'.$val.'" AND ';
			}
			$con = substr($con,0,-4);
		}else{
			$con .= $where;
		}
		$str='';
		foreach($addArr as $key=>$val){
			$str .= '`'.$key.'`' .'='.$key .' + '.$val. ',';
		}
		$str = substr($str,0,-1);
		$sql = 'UPDATE '.$this->tableName.' SET '.$str.$con;
		return $this->db->query($sql);
		
	}
	//获取一个字段的值
	public function getField($where,$field){
		$res = $this->getObj($where,$field);
		return $res[$field];
	}
	//开启事务
	public function begin_trans(){
		return $this->db->autoCommit();
	}
	//提交事务
	public function commit(){
		return $this->db->commit();
	}
	//回滚
	public function rollback(){
		return $this->db->rollback();
	}
}