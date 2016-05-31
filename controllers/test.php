<?php 
/*
练习
 */
class test extends IController{
	public $checkRight  =array('check'=> 'addlist');
/*
	public function init(){

		IInterceptor::reg('CheckRights@onCreateAction');
		//IInterceptor::reg('themeroute@onCreateController');
	}*/

	public $layout='site';
	public function test1(){
		$test=new shoptest();
		//$result=$test->show();
		//echo '欢迎使用Iweb框架';
		$result='wangzhande';
		$this->redirect('test1');

	}
	public function addlist(){
		$this->redirect('addlist');
	}
	public function insert(){
		$m_test=IDBFactory::getDB();
		var_dump($m_test);
		//$controller=Iweb::$_classes;
		/*$controller=IWeb::createWebApp();
		var_dump($controller);*/
		$app=new IWeb();
		var_dump($app);
		$result=$this->ctrlId;
		/*$app=$this->app;
		var_dump($app);*/
		$ac=$this->getAction();
		var_dump($ac);
		var_dump($result);

	}
	public function insert2(){
		//var_dump($_POST);
		//获取数据并过滤
		$result=IFilter::act(IReq::get('name'));
		//实例对象
		$m_test=new IModel('test');
		var_dump($m_test);
		$date['name']=$result;

		$m_test->setData($date);
		$res=$m_test->add();		
		var_dump($result);
		var_dump($res);
	}
	public function insert3(){
		$date['name']=IFilter::act(IReq::get('name'));
		//实例化模型
		$m_test=new IModel('test');
		//获得配置文件中的数据
		
		//new Config("site_config");

		$upload=new PhotoUpload();
		$result=$upload->run();
		var_dump($result);
		echo 1;

	}
	public function del(){
		//获取主键id
		$id=IFilter::act(IReq::get('id'));
		//var_dump($id);
		//实例化test模型

		$m_test=new IModel('test');
		//拼接where语句
		$where='id ='.$id;
		//调用del方法进行删除
		$result=$m_test->del($where);
		if($result){
			echo 1;
		}else{
			echo 0;
			var_dump(IClient::isAjax());
			Util::showMessage('请选择要操作的数据');
		}

	}
	public function test3(){
		$result=call_user_func(array(__CLASS__,'insert3'));	
		$res=method_exists(__CLASS__,'test');
		var_dump($res);
	}
	public function test4(){
		echo 'test4';
	}
	public function client(){
		$ip=IClient::getIp();
		//$url=IClient::getPreUrl();
		$su=IClient::supportClient();
		ICookie::set('name','wangzhande');
		var_dump(ICookie::get('user_id'));
	}
	public function apitest(){
		$result=Api::run('test1');
		var_dump($result);
	}
	public function apiQuery(){
		$result=Api::run('test2');
		var_dump($result);

	}
	public function app1(){
		var_dump($this);
		//$this->redirect('app1');
		setcookie('app1','ceshi');
		setcookie('app2','ceshi3');
	}
	public function app2(){
		var_dump($_COOKIE);
		$result=session_id();
	
	}
	public static function test5(){
		echo 'jinlaile';
	}
	public function mailtest(){
		$phpMailerDir = IWEB_PATH.'core/util/phpmailer/PHPMailerAutoload.php';
			include_once($phpMailerDir);
		$mail=new PHPMailer();
		try {
			//$mail = new PHPMailer(true); 
			$mail->IsSMTP();
			$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
			$mail->SMTPAuth   = true;                  //开启认证
			$mail->Port       = 25;                    
			$mail->Host       = "smtp.163.com"; 
			$mail->Username   = "15313086535@163.com";    
			$mail->Password   = "wzd8280313";            
			//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
			//$mail->AddReplyTo("15313086535@163.com","mckee");//回复地址
			$mail->From       = "15313086535@163.com";
			$mail->FromName   = "www.phpddt.com";
			$to = "279020473@qq.com";
			$mail->AddAddress($to);
			$mail->Subject  = "phpmailer测试标题";
			$mail->Body = "<h1>phpmail演示</h1>对phpmailer的测试内容";
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
			$mail->WordWrap   = 80; // 设置每行字符串的长度
			//$mail->AddAttachment("f:/test.png");  //可以添加附件
			$mail->IsHTML(true); 
			for($i=0;$i<=10;$i++){
			$result=$mail->Send();
			var_dump($mail->ErrorInfo);
			if($result){
			echo '邮件已发送';}
			else{
				return false;
			}
			}
		} catch (phpmailerException $e) {
			echo "邮件发送失败：".$e->errorMessage();
		}
	}

}
?>