<?php 
/*
登录
 */
class MobileUser extends IController
{

	public function MobileReg()
	{

		$data = array('code' => 1);
		$phone = IFilter::act(IReq::get('phone', 'post'));
		$password = IFilter::act(IReq::get('password', 'post'));
		$validPhoneCode = IFilter::act(Ireq::get('validPhoneCode','post'));
		$type = IFilter::act(IReq::get('type', 'post'));
		if (!IValidate::phone($phone)) {  //手机格式不 正确的话
			$data['code'] = 0;
			$data['info']='手机格式不正确';
		}
		if (!IValidate::required($password)) {
			//密码不能为空
			$data['code'] = 0;
			$data['info']='密码不能为空';
		}

		//如果上面的验证都听过
		if ($data['code'] == 1) {
			//验证手机验证码 41是过期 0 是正确 2是错误  7是没有验证码
			$data = self::checkMobileValidateCode($phone,$validPhoneCode);
		}
		if ($data['code'] == 1) {
			$userObj = new IModel('user');
			//判断手机是否存在
			if ($userObj->getObj('phone = ' . $phone, 'id')) {
				$data['code'] = 0;
				$data['info']='该手机号已注册';
			} else {
				$userArray = array(
					'phone' => $phone,
					'password' => md5($password),
				);
				//插入注册用户数据
				$userObj->setData($userArray);
				$user_id = $userObj->add();
				//$userObj->commit();
				//插入成功
				if ($user_id) {
					//实例化用户组表，
					$group = new IModel('user_group');
					//获得默认的分组id；
					$group_id = $group->getField('is_default=1', 'id');

					//member表
					$memberArray = array(
						'user_id' => $user_id,
						'time' => ITime::getDateTime(),
						'status' => 1,
					);
					if ($group_id) $memberArray['group_id'] = $group_id;
					if ($type == 1) $memberArray['status'] = 4;
					//用户信息表
					$memberObj = new IModel('member');
					//把用户信息放到用户信息表
					$memberObj->setData($memberArray);
					$memberObj->add();
				} else {
					//插入失败
					$data['code'] = 0;
					$data['info']='插入失败';
				}

			}

		}

		echo JSON::encode($data);

	}

	public function getMobileValidateCode()
	{
		$phone = IFilter::act(IReq::get('phone','post'));
		$res = array('code' => 1);
		if ($phone == '') {
			$res['code'] = 0;
			$res['info']='手机号码不能为空';
		}
		if (!IValidate::phone($phone)) {
			$res['code'] = 0;
			$res['info']='手机号不正确';
		}
		if ($res['code'] == 1) {
			$text = rand(100000, 999999);
			$mobileObj=new IModel('mobile_code');
			$where='phone='.$phone;
			$mobileRes=$mobileObj->getObj('phone='.$phone);
			$data=array(
				'phone'=>$phone,
				'code'=>$text,
				'time'=>ITime::getDateTime()
			);
			if($mobileRes) {
				$mobileObj->setData($data);
				$mobileObj->update('phone='.$phone);
			}else{
				$mobileObj->setData($data);
			}

			$text = smsTemplate::checkCode(array('{mobile_code}' => $text));
			$sms=new ChuanglanSMS('N9081709','9fd2cd94');
			$result=$sms->send($phone,$text);
			$result=JSON::decode($result);
			if($result['success']==true){
				//发送成功
				$res['code']=1;
				$res['info']='发送成功';
			}else{
				//发送失败
				$res['code']=0;
				$res['info']='发送失败';
			}
		}
		echo JSON::encode($res);


	}

	//验证手机验证码
	public function checkMobileValidateCode($phone,$num)
	{
		$mobileObj=new IModel('mobile_code');
		$mobileValidateSess=$mobileObj->getObj('phone='.$phone);
		//return array('code'=>1,'info'=>'验证码正确');
		if($mobileValidateSess){
			if(time()-strtotime($mobileValidateSess['time'])>=1800){//session过期

				 $res=array('code'=>0,'info'=>'验证码超时');
				return $res;
			} else if ($mobileValidateSess['code'] != $num) {
					$res=array('code'=>0,'info'=>'验证码错误');//错误
					return $res;
			} else {
				$res=array('code'=>1,'info'=>'验证码正确');
				//正确以后清空
						$data=array(
						'code'=>'',
					);
				$mobileObj->setData($data);
				$mobileObj->update('phone='.$phone);
					return $res;
			}//正确
		} else return array('code'=>0,'info'=>'没有验证码');//没有验证码
	}

	//用户登录
	public function login_act()
	{

		$login_info = IFilter::act(IReq::get('login_info', 'post'));
		$password = IFilter::act(IReq::get('password', 'post'));
		//$remember   = IFilter::act(IReq::get('remember','post'));
		$autoLogin = IFilter::act(IReq::get('isAutoLogin', 'post'));

		$password = md5($password);
		$captcha = IFilter::act(IReq::get('validCode'), 'str');
		$errTimes = $this->getErrTimes($login_info);
		$data = array('code' => 0);
		if ($login_info == '') {
			$data['code'] = 1;
			$data['msg'] = '用户名不能为空';
		} else if ($password == '') {
			$data['code'] = 2;
			$data['msg'] = '密码不能为空';
		}
		//     	else if(($errTimes = $this->getErrTimes($login_info))>7){//帐户锁定，打电话解冻
		//     		$data['code'] = 13;
		//     	}
		//     	//如果密码错误次数超过3次
		else if ($errTimes > 3) {//二次添加
			$data['code'] = 10;
		} else {    //验证已注册用户是否合法

			if ($userRow = CheckRights::isValidUser($login_info, $password)) {    //验证成功后把密码错误次数改为0
				$M = new IModel('user');
				$where = 'phone = "' . $login_info . '" OR email = "' . $login_info . '" OR username = "' . $login_info . '"';
				$M->setData(array('err_times' => 0));
				$M->update($where);
				//用户登录后，
				//CheckRights::loginAfter($userRow);
				//保存用户信息
				//$data['user_id']=ISafe::setMobileCode('user_id',$userRow['id']);
				$data['token'] = self::setToken($userRow['id']);


				//要生成一个token保存起来 


				$memberObj = new IModel('member');
				//设置最后登录时间
				$dataArray = array(
					'last_login' => ITime::getDateTime(),
				);
				$memberObj->setData($dataArray);
				$where = 'user_id = ' . $userRow["id"];
				$memberObj->update($where);
				$memberRow = $memberObj->getObj($where, 'exp');

				//根据经验值分会员组
				$groupObj = new IModel('user_group');
				$groupRow = $groupObj->getObj($memberRow['exp'] . ' between minexp and maxexp and minexp > 0 and maxexp > 0', 'id', 'discount', 'desc');
				if (!empty($groupRow)) {
					$dataArray = array('group_id' => $groupRow['id']);
					$memberObj->setData($dataArray);
					$memberObj->update('user_id = ' . $userRow["id"]);
				}
// 				//记住帐号
// 				if($remember == 1)
// 				{
// 					ICookie::set('loginName',$login_info);
// 				}

				//自动登录
				if ($autoLogin == 1) {

					//ICookie::set('autoLogin',$autoLogin);

				}


			} else {
				//邮箱未验证
				$userDB = new IModel('user as u,member as m');
				$userRow = $userDB->getObj(" (u.username = '{$login_info}' or u.email = '{$login_info}' or u.phone = '{$login_info}') and password = '{$password}' and u.id = m.user_id");

				if ($userRow) {
					if ($userRow['status'] == 4)//邮箱未验证
					{
						$message = "您的邮箱还未验证，请点击下面的链接发送您的邮箱验证邮件！";
						$data['returnUrl'] = IUrl::creatUrl('/site/success?message=' . urlencode($message) . '&email=' . $userRow['email']);
					} else if ($userRow['status'] == 3) {//后台锁定
						$data['code'] = 9;
					} else if ($userRow['status'] == 2) {
						$data['code'] = 15;
					}
				} else {
					$M = new Imodel('user');
					$M->addNum(array('username' => $login_info, 'phone' => $login_info, 'email' => $login_info), array('err_times' => 1), 0);//zi
					$data['code'] = 7;//密码账号不匹配
					$data['errorTimes'] = $errTimes + 1;
				}
			}
		}
		echo JSON::encode($data);


	}

	protected function setToken($user_id)
	{

		$encryptKey = isset(IWeb::$app->config['encryptKey']) ? IWeb::$app->config['encryptKey'] : self::$defaultKey;
		$token = ICrypt::encode($user_id, $encryptKey);

		/*$user_id=IFilter::act(IReq::get('user_id'));
		$data['user_id']=ICookie::setMobileCode('user_id',$user_id);
		var_dump($data);
		$password=IFilter::act(IReq::get('user_pwd'));
		$data['password']=ICookie::setMobileCode('password',$password);
		var_dump($data);*/


	}



	public function test2()
	{
		//var_dump($this->module);
		//var_dump($this->themeDir());
		//var_dump($this->module->getBasePath());
		//var_dump($this->getViewPath());
		//var_dump($this->module->config);
		//var_dump($this->theme);
		$this->redirect('/site/ceshi');
	}

	public function test3()
	{	$userId=IFilter::act(IReq::get('userId','post'));
		if($userId==""){
			$result['code']=false;
			$result['info']='用户id不存在';
			die(JSON::encode($result));
		}
		if(isset($_FILES['attach']['name'])&&$_FILES['attach']['name']!=''){
			$photoObj=new PhotoUpload();
			$photo=$photoObj->run();
			if($photo['attach']['img']){
				$userObj=new IModel('user');
				$dataArray=array('head_ico'=>$photo['attach']['img']);
				$userObj->setData($dataArray);
				$where="id=".$userId;
				if($userObj->update($where)){
					die(JSON::encode(array('code'=>true,'info'=>'上传成功')));
				}else{
					die(JSON::encode(array('code'=>false,'info'=>'上传失败')));
				}
			}else{
				die(JSON::encode(array('code'=>false,'info'=>'上传失败')));
			}
		}else{
			die(JSON::encode(array('code'=>false,'info'=>'请选择图片')));
		}
	}
	public function sms(){
		$phone=IFilter::act(IReq::get('phone','get'));
		$password=IFilter::act(IReq::get('password'),'get');
		$chuanglan=new ChuanglanSMS($phone,$password);
		$res=$chuanglan->send(15313086535,'验证码');
		var_dump($res);
	}
}


?>