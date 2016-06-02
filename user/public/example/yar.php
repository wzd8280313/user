<?php
/**
 * @date 2015-9-13 
 * @author zhengyin <zhengyin.name@gmail.com>
 * @blog http://izhengyin.com
 *
 */
class Server{
	
	public function get(){
		return __METHOD__;
	}
	
	public function add(){
		return __METHOD__;
	}
	
	public function update(){
		return __METHOD__;
	}
	
	public function delete(){
		return __METHOD__;
	}
}





$server = new Yar_Server(new Server());
$server->handle();