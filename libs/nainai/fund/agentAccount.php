<?php
/**
 * 代理账户管理类
 * author: weipinglee
 * Date: 2016/4/20
 * Time: 17:25
 */

namespace nainai\fund;
use \Library\M;
use \Library\Time;
 class agentAccount extends account{


     private $agentModel = null;
     private $flowModel  = null;
     private $agentTable = 'user_account';//代理账户数据表名
     private $fundFlowTable = 'user_fund_flow';//资金流水表

     private $errorCode = array(
         'fundLess' => array('code'=>-1,'info'=>'账户余额不足'),
         'fundWrong'=> array('code'=>-2,'info'=>'金额数据错误'),
         'freezeLess' => array('code'=>-3,'info'=>'冻结金额不足'),
     );


     /**
      * 生成流水数据
      * @param int $user_id 用户id
      * @param float $num 更改金额
      * @param string $type 类型
      *
      */
     private function createFlowData($user_id,$num,$type){

         $flow_data = array();

         $flow_data['flow_no'] = date('YmdHis').rand(100000,999999);
         $flow_data['user_id'] = $user_id;
         $flow_data['time']    = Time::getDateTime();
         $flow_data['acc_type'] = 1;
         $fund = $this->agentModel->where(array('user_id'=>$user_id))->fields('fund,freeze')->getObj();//如金前的总金额

        switch($type){
            case 'in' : {
                $flow_data['fund_in'] = $num;
                $flow_data['total']   = $fund['fund'] + $fund['freeze'];
                $flow_data['active']  = $fund['fund'] ;
            }
            break;

            case 'freeze' : {
                $flow_data['freeze']  = $num;//负数代表释放
                $flow_data['total']   = $fund['fund'] + $fund['freeze'] ;
                $flow_data['active']  = $fund['fund'] - $flow_data['freeze'];
            }
            break;
            case 'freezePay' : {
                $flow_data['freeze']   = -$num;
                $flow_data['total']    = $fund['fund'] + $fund['freeze'] ;
                $flow_data['active']   = $fund['fund'];
                $flow_data['fund_out'] = $num;
            }
            break;
            case 'pay' : {
                $flow_data['total']    = $fund['fund'] + $fund['freeze'] ;
                $flow_data['active']   = $fund['fund'];
                $flow_data['fund_out'] = $num;
            }
            break;
        }

         return $this->flowModel->data($flow_data)->add(1);

     }

     public function __construct(){
        $this->agentModel = new M($this->agentTable);
        $this->flowModel  = new M($this->fundFlowTable);
     }
    /**
     * 获取可用余额
     * @param int $user_id
     */
    public function getActive($user_id){
        $agentData = $this->agentModel->fields('fund')->where(array('user_id'=>$user_id))->getObj();
        if(!empty($agentData)){
            $active = $agentData['fund'];
            return $active>0 ? $active : 0;
        }
        return 0;
    }

    /**
     * 获取冻结资金金额
     * @param int $user_id 用户id
     */
    public function getFreeze($user_id){
        $agentData = $this->agentModel->fields('freeze')->where(array('user_id'=>$user_id))->getObj();
        if(!empty($agentData)){
            return $agentData['freeze']>0 ? $agentData['freeze'] : 0;
        }
        return 0;
    }

     /**
      * 获取资金流水表
      * @param int $user_id
      * @param int $day 天数
      */
     public function getFundFlow($user_id=0,$day=7){
         if($user_id){
             $time = Time::getDateTime('',time() - $day*24*3600);
              $where = array('user_id'=>$user_id,'time'=>array('gt'=>$time));
             return $this->flowModel->where($where)->order('time DESC')->select();
         }
     }
    /**
  * 入金操作
  * @param int $user_id 用户id
  * @param $num float 入金金额
  */
     public function in($user_id,$num){
         if(is_integer($num) || is_float($num)){

             $this->agentModel->table($this->agentTable)->where(array('user_id'=>$user_id))->setInc('fund',$num);//总帐户增加金额
             $this->createFlowData($user_id,$num,'in');
             return true;
         }
         else{
             return $this->resWrong('fundWrong');
         }


     }

     /**
      * 出金操作
      * @param int $user_id 用户id
      * @param $num float 入金金额
      */
     public function out($user_id,$num){
         if(is_integer($num) || is_float($num)){
             //获取账户可用资金总额
             $fund = $this->agentModel->table($this->agentTable)->where(array('user_id'=>$user_id))->getField('freeze');
             if($fund===false || $fund<$num)
                 return $this->resWrong('fundLess');
             $this->agentModel->table($this->agentTable)->where(array('user_id'=>$user_id))->setDec('freeze',$num);//冻结资金帐户减少金额
             $this->createFlowData($user_id,$num,'freezePay');
             return true;
         }
         else{
             return $this->resWrong('fundWrong');
         }


     }


    /**
     * 资金冻结
     * @param int $user_id 用户id
     * @param float $num 冻结金额
     */
    public function freeze($user_id,$num){
        if(is_integer($num) || is_float($num)){
            $fund = $this->agentModel->table($this->agentTable)->where(array('user_id'=>$user_id))->getField('fund');
            if($fund===false || $fund<$num)

                return $this->resWrong('fundLess');

            $res = $this->createFlowData($user_id,$num,'freeze');
            if($res){
                $this->agentModel->table($this->agentTable);
                $sql = 'UPDATE '.$this->agentModel->table().
                    ' SET fund = fund - :fund ,freeze = freeze + :fund  WHERE user_id = :user_id';
                $this->agentModel->query($sql,array('fund'=>$num,'user_id'=>$user_id));
                return true ;
            }
            else{
                return $this->resWrong();
            }

        }
        else{
            return $this->resWrong('fundWrong');
        }
    }

     private function resWrong($type=''){
         $text = ($type=='' || isset($this->errorCode[$type])) ? $this->errorCode[$type]['info'] : '服务器异常';

        return $text;
     }

    /**
     * 冻结资金释放
     * @param int $user_id
     * @param float $num 释放金额
     */
    public function freezeRelease($user_id,$num){
        if(is_integer($num) || is_float($num)){
            $freeze = $this->agentModel->table($this->agentTable)->where(array('user_id'=>$user_id))->getField('freeze');
            if($freeze===false || $freeze<$num)

                return $this->resWrong('freezeLess');

            $this->createFlowData($user_id,-$num,'freeze');
            $this->agentModel->table($this->agentTable);
            $sql = 'UPDATE '.$this->agentModel->table().
                ' SET fund = fund + :fund ,freeze = freeze - :fund  WHERE user_id = :user_id';
            $this->agentModel->query($sql,array('fund'=>$num,'user_id'=>$user_id));


            return true;


        }
        else{
            return $this->resWrong('fundWrong');
        }
    }

    /**
     * 冻结资金支付
     * 将冻结资金解冻，支付给另外一个用户
     * @param int $from 冻结账户用户id
     * @param int $to  转到的账户用户id,0代表市场
     * @param float $num 转账的金额
     *
     */
    public function freezePay($from,$to=0,$num){
        if(is_integer($num) || is_float($num)){

            $fromFreeze = $this->agentModel->where(array('user_id'=>$from))->getField('freeze');

            if($fromFreeze>=$num){

                if($to==0){//付款到市场

                }
                else{
                    //收款人入金
                    $this->agentModel->where(array('user_id'=>$to))->setInc('fund',$num);//总帐户增加金额

                    $this->createFlowData($to,$num,'in');
                }
                //付款人减少冻结
                $this->agentModel->where(array('user_id'=>$from))->setDec('freeze',$num);
                $this->createFlowData($from,$num,'freezePay');
                return true;

            }
            else{
                return $this->resWrong('freezeLess');
            }
        }
        else{
            return $this->resWrong('fundWrong');
        }
    }

    /**
     * 可用余额直接付款给市场
     * @param int $user_id 支付用户id
     * @param float $num 转账的金额
     */
    public function payMarket($user_id,$num){
        if(is_integer($num) || is_float($num)){

            $fund = $this->agentModel->where(array('user_id'=>$user_id))->getField('fund');

            if($fund>=$num){//可以付款

                //市场账户增加


                //付款人减少冻结
                $this->agentModel->where(array('user_id'=>$user_id))->setDec('fund',$num);
                $this->createFlowData($user_id,$num,'pay');
                return true;
            }
            else{
                return $this->resWrong('fundLess');
            }
        }
        else{
            return $this->resWrong('fundWrong');
        }
    }


}