<?php 
/*
登录
 */
class MobileUser extends IController{
	public function init(){

		IInterceptor::reg('test@test5');
		IInterceptor::run('test5');

	}

	public function MobileReg(){
		$data = array('errorCode'=>0);
    		$phone = IFilter::act(IReq::get('phone','post'));
    		$password   = IFilter::act(IReq::get('password','post'));
    		$password2 = IFilter::act(IReq::get('password2','post'));
    		$validPhoneCode = IFilter::act(Ireq::get('validPhoneCode','post'),'int');
    		$type = IFilter::act(IReq::get('type','post'));
    		$email = '';
    		 //邮箱注册
    		if($type==1){//邮箱注册
    		$email = IFilter::act(IReq::get('email','post'));
    		if(!IValidate::email($email))
                 		 //邮箱格式不正确的话
    			$data['errorCode']=3;

    		}
    		if(!IValidate::phone($phone))
    		{  //手机格式不 正确的话
    			$data['errorCode']=15;
    		}
		  	else if($password != $password2)
		  	{       //两次密码输入不一致的话
		   		$data['errorCode']=4;
		  	}
		  	
           		 //如果上面的验证都听过
       		if($data['errorCode']==0){
                       	 //验证手机验证码 41是过期 0 是正确 2是错误  7是没有验证码
       		$data['errorCode'] = self::checkMobileValidateCode($validPhoneCode);
       		}  	
       		if($data['errorCode']==0 ){
    		$userObj = new IModel('user');
    		//判断邮箱是否存在
    		if($type==1 && !!$userObj->getObj(" email = '".$email."'",'id')){
    			$data['errorCode']=18;
    		}
                        //判断手机是否存在
    		else if($userObj->getObj('phone = '.$phone,'id')){
    			$data['errorCode']=16;
    		}
    		else
    			{
    				$userArray = array(
    						'email'    => $email,
    						'phone'    => $phone,
    						'password' => md5($password),
    				);
                                                    //插入注册用户数据
    				$userObj->setData($userArray);
    				$user_id = $userObj->add();
    				//$userObj->commit();
                                                     //插入成功
    				if($user_id)
    				{
                                                                //实例化用户组表，
    					$group = new IModel('user_group');
                                                                //获得默认的分组id；
    					$group_id =$group->getField('is_default=1','id');
    					
    					//member表  
    					$memberArray = array(
    							'user_id' => $user_id,
    							'time'    => ITime::getDateTime(),
    							'status'  => 1,
    					);

    					if($group_id)$memberArray['group_id']=$group_id;
    					if($type==1)$memberArray['status'] = 4;
                                                                //用户信息表
    					$memberObj = new IModel('member');
                                                                //把用户信息放到用户信息表
    					$memberObj->setData($memberArray);
    					$memberObj->add();
    			
    					//邮箱激活帐号
    					if($type == 1)
    					{
    						//$data['sendRes']=$this->send_check_mail();
    						
    					}
    					/*ISafe::set('phone',$phone);
    					ISafe::set('email',$email);
    					ISafe::set('user_id',$user_id);
    					ISafe::set('user_pwd',$userArray['password']);*/
    				}else{
                                                                //插入失败 
    					$data['errorCode']=13;
    				}
    				 
    			}
    		
    		}
    			echo JSON::encode($data);

	}

	public function getMobileValidateCode(){
		$result=IClient::getIP();
		var_dump($result);
		$phone = IFilter::act(IReq::get('phone'));
		//var_dump($phone);
		$res = array('errorCode'=>0);
		//如果没有输入手机号
		if($phone=='')$res['errorCode']==1;
		if(!$phone)$res['errorCode']==15;
		if($res['errorCode']==0){
			$text = rand(100000,999999);
			//var_dump($text);
			ISafe::set('mobileValidate',array('num'=>$text,'time'=>time()));
			$text = smsTemplate::checkCode(array('{mobile_code}'=>$text));
			//echo $text;
			//如果发送失败的话
			if(!hsms::send($phone,$text))
				$res['errorCode']=-1;
		}
		echo JSON::encode($res);
		
		
	}

	//验证手机验证码
	public function checkMobileValidateCode($num){
		if($mobileValidateSess = Isafe::get('mobileValidate')){
			if(time() - $mobileValidateSess['time']>=1800){//session过期
				return 41;
			}else if($mobileValidateSess['num']!=$num){
				return 2;//错误
			}else return 0;//正确
		}
		else return 7;//没有验证码
	}
	//用户登录
	public function login_act(){

		   	$login_info = IFilter::act(IReq::get('login_info','post'));
		    	$password   = IFilter::act(IReq::get('password','post'));
		    	//$remember   = IFilter::act(IReq::get('remember','post'));
		    	$autoLogin  = IFilter::act(IReq::get('isAutoLogin','post'));
		
			$password   = md5($password);
			$captcha = IFilter::act(IReq::get('validCode'),'str');
			$errTimes = $this->getErrTimes($login_info);
				$data=array('errorCode'=>0);
	    	if($login_info == '')
	    	{
	    		$data['errorCode'] = 1;
	    		$data['msg']='用户名不能为空';
	    	}
	    	else if($password==''){
	    		$data['errorCode'] = 2;
	    		$data['msg']='密码不能为空';
	    	}
	//     	else if(($errTimes = $this->getErrTimes($login_info))>7){//帐户锁定，打电话解冻
	//     		$data['errorCode'] = 13;
	//     	}
	//     	//如果密码错误次数超过3次
	    	else if($errTimes>3){//二次添加
	    			$data['errorCode'] = 10;
	    	}
	    	else
	    	{	//验证已注册用户是否合法

	    		if($userRow = CheckRights::isValidUser($login_info,$password))
	    		{	//验证成功后把密码错误次数改为0
	    			$M = new IModel('user');
	    			$where = 'phone = "'.$login_info.'" OR email = "'.$login_info.'" OR username = "'.$login_info.'"';
	    			$M->setData(array('err_times'=>0));
	    			$M->update($where);
    			 	  //用户登录后，
				//CheckRights::loginAfter($userRow);
				//保存用户信息
				//$data['user_id']=ISafe::setMobileCode('user_id',$userRow['id']);
				$data['token']=self::setToken($userRow['id']);

				
				//要生成一个token保存起来 
					
				

	    			$memberObj = new IModel('member');
	    			//设置最后登录时间
				$dataArray = array(
					'last_login' => ITime::getDateTime(),
				);
				$memberObj->setData($dataArray);
				$where     = 'user_id = '.$userRow["id"];
				$memberObj->update($where);
				$memberRow = $memberObj->getObj($where,'exp');

				//根据经验值分会员组
				$groupObj = new IModel('user_group');
				$groupRow = $groupObj->getObj($memberRow['exp'].' between minexp and maxexp and minexp > 0 and maxexp > 0','id','discount','desc');
				if(!empty($groupRow))
				{
					$dataArray = array('group_id' => $groupRow['id']);
					$memberObj->setData($dataArray);
					$memberObj->update('user_id = '.$userRow["id"]);
				}
// 				//记住帐号
// 				if($remember == 1)
// 				{
// 					ICookie::set('loginName',$login_info);
// 				}

				//自动登录
				if($autoLogin == 1)
				{

					//ICookie::set('autoLogin',$autoLogin);
					
				}

				
    			}
    			else
    			{
	    			//邮箱未验证
	    			$userDB = new IModel('user as u,member as m');
	    			$userRow= $userDB->getObj(" (u.username = '{$login_info}' or u.email = '{$login_info}' or u.phone = '{$login_info}') and password = '{$password}' and u.id = m.user_id");

				if($userRow)
				{
					if($userRow['status']==4)//邮箱未验证
					{
						$message = "您的邮箱还未验证，请点击下面的链接发送您的邮箱验证邮件！";
						$data['returnUrl'] = IUrl::creatUrl('/site/success?message='.urlencode($message).'&email='.$userRow['email']);
					}
					else if($userRow['status']==3){//后台锁定
						$data['errorCode'] = 9;
					}
					else if($userRow['status']==2){
						$data['errorCode'] = 15;
					}
				}
				else
				{
					$M = new Imodel('user');
					$M->addNum(array('username'=>$login_info,'phone'=>$login_info,'email'=>$login_info),array('err_times'=>1),0);//zi
					$data['errorCode'] = 7;//密码账号不匹配
					$data['errorTimes'] = $errTimes + 1;
				}
    			}
    		}
		echo JSON::encode($data);
    	


	}
	protected  function setToken($user_id){
		
		$encryptKey  = isset(IWeb::$app->config['encryptKey']) ? IWeb::$app->config['encryptKey'] : self::$defaultKey;
		$token=ICrypt::encode($user_id,$encryptKey);
		
		/*$user_id=IFilter::act(IReq::get('user_id'));
		$data['user_id']=ICookie::setMobileCode('user_id',$user_id);
		var_dump($data);
		$password=IFilter::act(IReq::get('user_pwd'));
		$data['password']=ICookie::setMobileCode('password',$password);
		var_dump($data);*/



	}
	public function test(){
		//var_dump($this->view);
		//var_dump($_GET['action']);
/*	//这是跳转方法
		$this->redirect('/site/ceshi');*/
		$this->redirect('ceshi');
	}
	public function test2(){
		//var_dump($this->module);
		//var_dump($this->themeDir());
		//var_dump($this->module->getBasePath());
		var_dump($this->getViewPath());
		//var_dump($this->module->config);
		var_dump($this->theme);
		$this->redirect('/site/ceshi');
	}
	

}


?>