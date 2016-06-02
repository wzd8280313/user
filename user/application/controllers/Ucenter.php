<?php
/**
 * 用户中心
 * User: weipinglee
 * Date: 2016/3/4 0004
 * Time: 上午 9:35
 */
use \Library\checkRight;
use \Library\photoupload;
use \Library\json;
use \Library\url;
use \Library\safe;
use \Library\Thumb;
use \Library\tool;
class UcenterController extends UcenterBaseController {



    /**
     * 个人中心首页
     */
    public function indexAction(){

    }

    protected function  getLeftArray(){
        return array(
            array('name' => '账户管理', 'list' =>'' ),
            array('name' => '账户管理', 'list' => array(
                array(
                    'url' => url::createUrl('/ucenter/baseinfo'),
                    'title' => '基本信息' ,
                    'action'=>array('info','baseinfo','baseedit')
                ),
                array('url' => url::createUrl('/ucenter/password'), 'title' => '修改密码' ,'action'=>array('password')),
            )),
            array('name' => '资质认证', 'list' => array(
                array('url' => url::createUrl('/ucenter/dealCert'), 'title' => '交易商','action'=>array('dealcert') ),
                array('url' => url::createUrl('/ucenter/storeCert'), 'title' => '仓库管理员','action'=>array('storecert')  ),
            )),
            array('name' => '子账户管理', 'list' => array(
                array('url' => url::createUrl('/ucenter/subAcc'), 'title' => '添加子账户' ),
            )),

            array('name' => '开票信息管理', 'url' => url::createUrl('/ucenter/invoice'),'action'=>array('invoice')),
        );
    }


    public function baseInfoAction(){
        $userModel = new userModel();
        $userData = $userModel->getUserInfo($this->user_id);
        $this->getView()->assign('user',$userData);
    }

    public function baseEditAction(){
        $userModel = new userModel();
        $userData = $userModel->getUserInfo($this->user_id);
        $this->getView()->assign('user',$userData);
    }

    public function dobaseAction(){
        $data = array();
        $data['id'] = $this->user_id;
        $data['username'] = safe::filterPost('username');
        $data['email'] = safe::filterPost('email');

        $userModel = new userModel();
        $res = $userModel->updateUserInfo($data);
       die(json::encode($res));
    }
    /**
     * 基本信息修改
     */
    public function infoAction(){
        $user_id = $this->user_id;
        $userModel = new userModel();
        if($this->user_type==0){
            $user_data = $userModel->getPersonInfo($user_id);
            if($user_data['birth']==0)$user_data['birth'] = '';
            if($user_data['head_photo']!='')
                $user_data['head_photo_thumb'] = Thumb::get($user_data['head_photo'],180,180);
            if($user_data['identify_front']!='')
             $user_data['identify_front_thumb'] = Thumb::get($user_data['identify_front'],180,180);
            if($user_data['identify_back']!='')
            $user_data['identify_back_thumb'] = Thumb::get($user_data['identify_back'],180,180);

        }
        else{
            $user_data = $userModel->getCompanyInfo($user_id);
            if($user_data['head_photo']!='')
                $user_data['head_photo_thumb'] = Thumb::get($user_data['head_photo'],180,180);
            if($user_data['cert_bl']!='')
                $user_data['cert_bl_thumb'] = Thumb::get($user_data['cert_bl'],180,180);
            if($user_data['cert_oc']!='')
                $user_data['cert_oc_thumb'] = Thumb::get($user_data['cert_oc'],180,180);
            if($user_data['cert_tax']!='')
                $user_data['cert_tax_thumb'] = Thumb::get($user_data['cert_tax'],180,180);

        }

        $this->getView()->assign('user',$user_data);
        $this->getView()->assign('type',$this->user_type);
        $this->getView()->assign('id',$user_id);


    }

    /**
     * 修改密码页面
     *
     */
    public function passwordAction(){
        $this->getView()->assign('id',$this->user_id);
    }

    /**
     * 修改密码动作
     */
    public function chgPassAction(){
        $user_id = $this->user_id;
        $pass = array('old_pass'=>$_POST['old_pass'],'password'=>$_POST['new_pass'],'repassword'=>$_POST['new_repass']);

        $userModel = new userModel();
        $res = $userModel->changePass($pass,$user_id);
       echo JSON::encode($res);
        return false;
    }



    /**
     * ajax上传图片
     * @return bool
     */
    public function uploadAction(){

            //调用文件上传类
            $photoObj = new photoupload();
            $photoObj->setThumbParams(array(180,180));
            $photo = current($photoObj->uploadPhoto());

            if($photo['flag'] == 1)
            {
                $result = array(
                    'flag'=> 1,
                    'img' => $photo['img'],
                    'thumb'=> $photo['thumb'][1]
                );
            }
            else
            {
                $result = array('flag'=> $photo['flag'],'error'=>$photo['errInfo']);
            }
            echo JSON::encode($result);

        return false;
    }

    /**
     * 修改用户信息
     */
    public function personUpdateAction(){
        if(!IS_POST || !isset($_POST['id'])){
            $this->redirect('index');
            return false;
        }

        $userData['user_id'] = safe::filterPost('id','int');
        if($this->user_id == $userData['user_id']){
            $userData['username'] = safe::filterPost('username');
            $userData['email'] = safe::filterPost('email','email');
            $userData['head_photo'] = tool::setImgApp(safe::filterPost('imgfile3'));
            $personData['true_name'] = safe::filterPost('true_name');
            $personData['sex'] = safe::filterPost('sex','int',0);
            $personData['birth'] = safe::filterPost('birth','date');
            $personData['education'] = safe::filterPost('education','int');
            $personData['qq'] = safe::filterPost('qq');
            $personData['zhichen'] = safe::filterPost('zhichen');
            $personData['identify_no'] = safe::filterPost('identify_no');
            $personData['identify_front'] = tool::setImgApp(safe::filterPost('imgfile1'));
            $personData['identify_back'] = tool::setImgApp(safe::filterPost('imgfile2'));

            $um = new userModel();
            $res = $um->personUpdate($userData,$personData);
            if(isset($res['success']) && ($res['success']==1 || $res['success']==2)){
                if($res['success']==1){//数据发生变化，更改认证状态
                    $certObj = new \nainai\certificate();
                    $certObj->certInit($this->user_id);
                }
                $this->redirect('info');
            }
            else{
                echo $res['info'];
            }

        }
        return false;
    }

    /**
     * 修改企业用户信息
     */
    public function companyUpdateAction(){
        if(!IS_POST || !isset($_POST['id']))
            $this->redirect('index');
        $userData['user_id'] = $_POST['id'];
        if($this->user_id == $userData['user_id']){
            $userData['username'] = safe::filterPost('username');
            $userData['email'] = safe::filterPost('email','email');
            $userData['head_photo'] = tool::setImgApp(safe::filterPost('imgfile4'));

            $companyData['company_name'] = safe::filterPost('company_name');
            $companyData['area'] = safe::filterPost('area','/\d{4,6}/');
            $companyData['address'] = safe::filterPost('address');
            $companyData['category'] = safe::filterPost('category','int');
            $companyData['nature'] = safe::filterPost('nature','int');
            $companyData['legal_person'] = safe::filterPost('legal_person');
            $companyData['reg_fund'] = safe::filterPost('reg_fund','float');
            $companyData['contact'] = safe::filterPost('contact');
            $companyData['contact_duty'] = safe::filterPost('contact_duty','int');
            $companyData['contact_phone'] = safe::filterPost('contact_phone','/^\d+$/');
            $companyData['check_taker'] = safe::filterPost('check_taker');
            $companyData['check_taker_phone'] = safe::filterPost('check_taker_phone','/^\d+$/');
            $companyData['check_taker_add'] = safe::filterPost('check_taker_add');
            $companyData['deposit_bank'] = safe::filterPost('deposit_bank');
            $companyData['bank_acc'] =safe::filterPost('bank_acc','/^\d+$/');
            $companyData['tax_no'] = safe::filterPost('tax_no');
            $companyData['qq'] = safe::filterPost('qq','/^\d{4,20}$/');
            $companyData['cert_bl'] = tool::setImgApp(safe::filterPost('imgfile1'));
            $companyData['cert_oc'] = tool::setImgApp(safe::filterPost('imgfile2'));
            $companyData['cert_tax'] = tool::setImgApp(safe::filterPost('imgfile3'));

            //  print_r($personData);exit;
            $um = new userModel();
            $res = $um->companyUpdate($userData,$companyData);

            if(isset($res['success']) && ($res['success']==1 || $res['success']==2)){
                if($res['success']==1){//数据发生变化，更改认证状态
                    $certObj = new \nainai\certificate();
                    $certObj->certInit($this->user_id);
                }
                $this->redirect('info');
            }
            else{
                echo $res['info'];
            }

        }
        return false;
    }


    /**
     * 交易商认证页面
     *
     */
    public function dealCertAction(){
        $cert = new certDealerModel($this->user_id,$this->user_type);
        $certData = $cert->getCertData($this->user_id);
        $certShow = $cert->getCertShow($this->user_id);

       $this->getView()->assign('certData',$certData);
        $this->getView()->assign('certShow',$certShow);
        $this->getView()->assign('userType',$certData['type']);
    }
    /**
     * 仓库认证
     */
    public function storeCertAction(){
        $cert = new certStoreModel($this->user_id,$this->user_type);
        $store = nainai\store::getStoretList();

        $certData = $cert->getDetail();
        $certData = $certData[0];
        if(isset($certData['store_id'])){
            $this->getView()->assign('store_id',$certData['store_id']);
        }

        $certShow = $cert->getCertShow();
        $this->getView()->assign('store',$store);
        $this->getView()->assign('userType',$certData['type']);
        $this->getView()->assign('certData',$certData);
        $this->getView()->assign('certShow',$certShow);

    }


    /**
     *交易商认证处理
     *
     */
    public function doDealCertAction(){

        if(IS_AJAX){
            $user_id = $this->user_id;

            $accData = array();

            if($this->user_type==1){
                $accData['company_name'] = safe::filterPost('company_name');
                $accData['legal_person'] = safe::filterPost('legal_person');
                $accData['contact'] = safe::filterPost('contact');
                $accData['contact_phone'] = safe::filterPost('phone');
                $accData['area'] = safe::filterPost('area');
                $accData['address'] = safe::filterPost('address');
                $accData['cert_bl'] = Tool::setImgApp(safe::filterPost('imgfile1'));
                $accData['cert_tax'] = Tool::setImgApp(safe::filterPost('imgfile2'));
                $accData['cert_oc'] = Tool::setImgApp(safe::filterPost('imgfile3'));
                $accData['business'] = safe::filterPost('zhuying');
            }
            else{
                $accData['true_name'] = safe::filterPost('name');
                $accData['area'] = safe::filterPost('area');
                $accData['address'] = safe::filterPost('address');
                $accData['identify_no'] = safe::filterPost('no');
                $accData['identify_front'] = Tool::setImgApp(safe::filterPost('imgfile1'));
                $accData['identify_back'] = Tool::setImgApp(safe::filterPost('imgfile2'));
            }

            $cert = new \nainai\cert\certDealer($user_id,$this->user_type);

            $res = $cert->certDealApply($accData);

            die(json::encode($res));
        }
        return false;

    }

    /**
     * 仓储认证处理
     * @return bool
     */
    public function doStoreCertAction(){
        if(IS_AJAX){
            $user_id = $this->user_id;

            $accData = array();

            if($this->user_type==1){
                $accData['company_name'] = Safe::filterPost('company_name');
                $accData['legal_person'] = Safe::filterPost('legal_person');
                $accData['contact'] = Safe::filterPost('contact');
                $accData['contact_phone'] = Safe::filterPost('phone');
                $accData['area'] = Safe::filterPost('area');
                $accData['address'] = Safe::filterPost('address');

            }
            else{
                $accData['true_name'] = Safe::filterPost('true_name');
                $accData['area'] = Safe::filterPost('area');
                $accData['address'] = Safe::filterPost('address');
            }

            $cert = new \nainai\cert\certStore($user_id,$this->user_type);

            $res = $cert->certStoreApply($accData);
            echo JSON::encode($res);

        }
        return false;
    }

    /**
     * 添加子账户页面
     */
    public function subAccAction(){

        $arr = $this->getRequest()->getParams();
        $uid = safe::filter($arr['uid'],'int','');
        $user_data = array(
            'id'      => $uid,
            'username'=>'',
            'email'   => '',
            'mobile'  => '',
            'head_photo' => '',
            'status'     => 1,

        );
        if($uid){

            $userModel = new UserModel();
            $user_data = $userModel->getUserInfo($uid,$this->user_id);

            if(empty($user_data))
                $this->redirect('subAccList');
            if($user_data['head_photo']!='')
            $user_data['head_photo_thumb'] = Thumb::get($user_data['head_photo'],180,180);
        }


        $this->getView()->assign('user',$user_data);

    }



    /**
     * 子账户添加处理
     */
    public function doSubAccAction(){
        if(IS_POST){
            $data = array();
            $data['user_id'] = safe::filterPost('id','int',0);
            $data['pid'] = $this->user_id;
            $data['username'] = safe::filterPost('username');
            $data['mobile'] = safe::filterPost('mobile','/^\d+$/');
            $data['email']    = safe::filterPost('email','email');
            $data['password'] = safe::filterPost('password','/^\S{6,20}$/');
            $data['repassword'] = safe::filterPost('repassword','/^\S{6,20}$/');
            $data['head_photo'] = tool::setImgApp(safe::filterPost('imgfile1'));
            $data['status']     = safe::filterPost('status','int');
            $userModel = new UserModel();
            if($data['user_id']==0)//新增子账户
                 $res = $userModel->subAccReg($data);
            else{//更新子账户
                if($data['password'] == ''){//账户密码为空则不修改密码
                    unset($data['password']);
                    unset($data['repassword']);
                }

                $res = $userModel->subAccUpdate($data);
            }

            die(json::encode($res));
        }
        return false;
    }


        /**
         * [开票信息管理]
         */
        public function invoiceAction(){
            $invoiceModel = new \nainai\user\UserInvoice();
            if (IS_POST) {
                $invoiceData = array(
                    'user_id'=> $this->user_id,
                    'title' => Safe::filterPost('title'),
                    'tax_no' => Safe::filterPost('tax_no'),
                    'address' => Safe::filterPost('address'),
                    'phone' => Safe::filterPost('tel', 'int'),
                    'bank_name' => Safe::filterPost('bankName'),
                    'bank_no' => Safe::filterPost('bankAccount')
                );



                $returnData = $invoiceModel->addUserInvoice($invoiceData);

                die(json::encode($returnData));
            }
            else{
                $invoiceData = $invoiceModel->getUserInvoice($this->user_id);
                $this->getView()->assign('data',$invoiceData);
            }
        }


    //=================================================================================

    //修改手机号码部分

    //==================================================================================



    /**
     * [mobileEditAction 用户手机修改界面]
     */
    public function mobileEditAction(){
        $userId=$this->user_id;
        $userObj=new userModel();
        $userInfo=$userObj::getUserInfo($userId);
        $this->getView()->assign('userInfo',$userInfo);

    }
    //获取旧手机验证码
    public function getOldMobileCodeAction(){
        if(IS_AJAX||IS_POST){
            $code=safe::filterPost('mobileCode');

            $userObj=new userModel();
            $res = $userObj->getOldMobileCode($this->user_id,$code);

            die(JSON::encode($res));
        }else{
            return false;
        }

    }
    //获取新手机验证码
    public function getNewMobileCodeAction(){
        if(IS_AJAX||IS_POST){

            $userObj=new userModel();
            $mobile=safe::filterPost('mobile','/^\d+$/');
            $code=safe::filterPost('mobileCode');
            $res=$userObj->getNewMobileCode($this->user_id,$code,$mobile);
            die(JSON::encode($res));
        }else{
            return false;
        }

    }
    //初次检查手机验证码
    public function checkMobileCodeAction(){
        if(IS_POST||IS_AJAX) {
            $code = safe::filterPost('mobileCode', 'int');
            $userObj = new userModel();
            $res = $userObj->checkMobileFirst($this->user_id,$code);
            die(JSON::encode($res));
        }else{
            return false;
        }
    }
    //验证第一步是否通过
    private function checkFirstStep(){
        $userObj=new userModel();
        return $userObj->checkFirst($this->user_id);
    }
    //更换新手机
    public function MobileNewAction(){
        $firstCheck = $this->checkFirstStep();
        if($firstCheck){
            $userId=$this->user_id;
            $userObj=new userModel();
            $userInfo=$userObj::getUserInfo($userId);
            $this->getView()->assign('userInfo',$userInfo);
        }else{
            $this->redirect('mobileEdit');
            return false;
        }


    }
    //手机修改成功
    public function MobileSuccessAction(){
        if(IS_POST||IS_AJAX){
            $userObj=new userModel();
            $code=safe::filterPost('mobileCode');
            $newMobile= safe::filterPost('mobile','/^\d+$/');
            $res = $userObj->checkMobileSecond($this->user_id,$code,$newMobile);
            die(json::encode($res));
        }else{
            $userObj=new userModel();
            $userInfo=$userObj->getUserInfo($this->user_id);
            $checkRes=\Library\session::get('mobileValidRes2');
            if($checkRes['mobile']==$userInfo['mobile']&&time()-$checkRes['time']<1800){
                //清除验证结果
                \Library\session::clear('mobileValidRes2');
                $this->getView()->assign('userInfo',$userInfo);
            }else{
                //var_dump($_SESSION);
                $this->forward('mobileEdit');
                return false;
            }
        }

    }





}