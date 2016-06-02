<?php
/**
 * 出入金管理类
 * User: weipinglee
 * Date: 2016/5/10 0010
 * Time: 下午 1:27
 */
use \Library\M;
use \Library\tool;
class fundModel{

    private $outFundRules = array(
        array('id','number','id错误',0,'regex'),
        array('user_id','number','',0,'regex'),
        array('request_no','require','不为空'),
        array('amount','currency','货币错误',0,'regex'),
       // array('note','mobile','手机号码错误',2,'regex'),
    );

    //开户信息规则
    protected $bankRules = array(
        array('user_id','number',''),
        array('bank_name','/\S{2,20}/i','请填写开户银行'),
        array('card_type',array(1,2),'卡类型错误',0,'in'),
        array('card_no','/[0-9a-zA-Z]{15,22}/','请填写银行账号'),
        array('true_name','/.{2,20}/','请填写开户名'),
        array('identify_no','/^\d{14,17}(\d|x)$/i','身份证号码错误'),
        array('proof','/^[a-zA-Z0-9_@\.\/]+$/','请上传打款凭证')

    );



    public function getCardType(){
        return  array(
            1=>'借记卡',
            2=>'信用卡'
        );
    }
    /**
     *
     * @param $user_id
     * @param $data
     * @return bool
     */
    public function fundOutApply($user_id,$data){

        $fundModel = \nainai\fund::createFund(1);
        $userFund = $fundModel->getActive($user_id);

        $amount = $data['amount'];
        $withdrawRequest = new M('withdraw_request');
        if ($userFund != 0 && $userFund > $amount) {
            $check = $withdrawRequest->validate($this->outFundRules,$data);
            if(false == $check)
                 return tool::getSuccInfo(0,$withdrawRequest->getError());

            $withdrawRequest->beginTrans();
            $withdrawRequest->data($data)->add();

            //冻结资金
            $fundModel->freeze($user_id, $amount);

            $res = $withdrawRequest->commit();
            if($res){
                return tool::getSuccInfo();
            }
            else{
                return tool::getSuccInfo(0,'提现失败');
            }

        } else {

            return tool::getSuccInfo(0,'账户资金不足');
        }
    }


    /**
     * 插入更新开户信息
     * @param $data
     * @return \Library\查询结果|string
     */
    public function bankUpdate($data){
        $userBank=new M('user_bank');
        if($userBank->validate($this->bankRules,$data)){
            $res = $userBank->insertUPdate($data,$data);
        }
        else{
            $res = $userBank->getError();
        }

        if(is_int($res)){
            return tool::getSuccInfo();
        }
        else{
            return tool::getSuccInfo(0,is_string($res)?$res : '操作失败');
        }
    }

    public function getBankInfo($user_id){
        $userBank=new M('user_bank');
        return $userBank->where(array('user_id'=>$user_id))->getObj();
    }
}