<?php
/**
 * 将多个键值对的数组转换为搜索条件
 * @$search array 
 * @return str
 */

function getSearchCondition($search){
	if(is_array($search)){
		$where='';
		foreach($search as $key =>$v){
			if($v!='')$where .= $key.' = "'.$v.'" AND ';
		}
		$where = substr($where,0,-4);
		return $where != ''? $where : 1;
	}else{
		return 1;
	}
}