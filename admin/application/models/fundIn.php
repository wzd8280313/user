<?php
/**
 * 入金管理
 * author: weipinglee
 * Date: 2016/5/5 0005
 * Time: 下午 1:51
 */

use \Library\M;
use \Library\Query;
use \nainai\fund;
use \Library\tool;
class fundInModel{


    CONST OFFLINE = 1;//线下入金类型编码
    CONST DIRECT  = 2;//支付宝
    CONST UNION   = 3;//银联

    CONST OFFLINE_APPLY = 0;
    CONST OFFLINE_FIRST_OK = 2;//初审通过
    CONST OFFLINE_FIRST_NG = 3;//初审驳回
    CONST OFFLINE_FINAL_OK = 1;//终审通过，入金成功
    CONST OFFLINE_FINAL_NG = 4;//终审驳回

    /**
     * 获取支付类型
     * @param $payID 支付ID
     */
    public static function getPayType($payID){
        switch(intval($payID)){
            case self::OFFLINE : {
                return '线下';
            }
            break;
            case self::DIRECT : {
                return '支付宝即时到账';
            }
            break;
            case self::UNION : {
                return '银联支付';
            }
            break;

            default : {
                return '未知';
            }
            break;
        }
    }

    /**
     * 线下入金订单状态获取
     * @param int $status 状态
     * @return string 状态文字
     */
    public static function getOffLineStatustext($status){
        switch(intval($status)){
            case self::OFFLINE_APPLY : {
                return '申请入金';
            }
            break;
            case self::OFFLINE_FIRST_OK : {
                return '初审通过';
            }
            break;
            case self::OFFLINE_FIRST_NG : {
                return '初审驳回';
            }
            break;
            case self::OFFLINE_FINAL_OK : {
                return '入金成功';
            }
                break;
            case self::OFFLINE_FINAL_NG : {
                return '终审驳回';
            }
            break;

            default : {
                return '未知';
            }
            break;
        }
    }
    /**
     * 获取在线入金的列表
     */
    public function getOnlineList($page=1){
        $reModel = new Query('recharge_order as r');
        //线上
        $reModel->join = 'left join user as u on r.user_id = u.id';
        $reModel->fields = 'r.order_no,r.amount,r.proot,r.pay_type,r.status as recharge_status,r.create_time,u.username,u.mobile,u.type';
        $reModel->where = 'pay_type <>'.self::OFFLINE.'  AND is_del = 0';
        $reModel->page = $page;
        $onlineInfo = $reModel->find();
        $reBar = $reModel->getPageBar();
        return array($onlineInfo,$reBar);

    }

    /**
     * 线下入金申请列表
     * @param int $page
     */
    public function getOffLineList($page=1){

        $reModel = new Query('recharge_order as r');
        //线下
        $reModel->join = 'left join user as u on u.id=r.user_id';
        $reModel->fields = 'u.username,r.*';
        $reModel->where = 'pay_type = '.self::OFFLINE.'  AND is_del = 0';
        $reModel->page = $page;
        $offlineInfo = $reModel->find();
        $reBar = $reModel->getPageBar();
        return array($offlineInfo,$reBar);
    }

    /**
     * @param $rid 充值订单id
     */
    public function offLineDetail($rid){
        $reModel = new Query('recharge_order as r');
        $reModel->join = 'left join user as u on u.id=r.user_id';
        $reModel->fields = 'u.username,u.mobile,r.*';
        $reModel->where = 'pay_type =1 and r.id= :id';
        $reModel->bind = array('id'=>$rid);
        $data = $reModel->getObj();
        $data['statusText'] = self::getOffLineStatustext($data['status']);
        //获取审核提交的方法
        $data['action'] = '';
        if($data['status']==self::OFFLINE_APPLY)
            $data['action'] = 'offlineFirst';
        else if($data['status']==self::OFFLINE_FIRST_OK){
            $data['action'] = 'offlineFinal';
        }

        return $data;

    }

    /**
     * 线下入金初审
     * @param int $rid 充值订单id
     * @param int $status 审核状态 0：驳回，1：通过
     * @param string $mess 意见
     */
    public function offLineFirst($rid,$status,$mess=''){
        $reModel = new M('recharge_order');
        $where = array('id'=>$rid);
        $reInfo = $reModel->where($where)->getObj();
        if ($reInfo['status'] == self::OFFLINE_APPLY) {//只有处于申请状态的才可以
            $data = array();

            if($status==1){
                $data['status'] = self::OFFLINE_FIRST_OK;
            }
            else{
                $data['status'] = self::OFFLINE_FIRST_NG;
            }
            $data['first_time'] = \Library\Time::getDateTime();
            $data['first_message'] = $mess;
            $reModel->beginTrans();
            $reModel->where($where)->data($data)->update();
            $res = $reModel->commit();

            if($res===true){
                return tool::getSuccInfo();
            }
            else{
                return tool::getSuccInfo(0,'操作失败');
            }

        } else {
            return tool::getSuccInfo(0,'无效操作');
        }
    }

    /**
     * 线下入金终审
     * @param int $rid 充值订单id
     */

    public function offLineFinal($rid,$status,$mess=''){
        $reModel = new M('recharge_order');
        $where = array('id'=>$rid);
        $reInfo = $reModel->where($where)->getObj();

        if ($reInfo['status'] == self::OFFLINE_FIRST_OK) {//只有处于初审通过的才可以
            $data = array();
            $reModel->beginTrans();
            $fundRes = true;
            if($status==1){
                $data['status'] = self::OFFLINE_FINAL_OK;
                $fundObj = fund::createFund(1);//实例化代理账户对象

                $fundRes = $fundObj->in($reInfo['user_id'],floatval($reInfo['amount']));//入金操作

            }
            else{
                $data['status'] = self::OFFLINE_FINAL_NG;
            }
            $data['final_time'] = \Library\Time::getDateTime();
            $data['final_message'] = $mess;

            if($fundRes===true){
                $reModel->where($where)->data($data)->update();
            }

            $res = $reModel->commit();
            if($res===true){
                return tool::getSuccInfo();
            }

        } else {
            return tool::getSuccInfo(0,'无效操作');
        }
    }

    /**
     * 逻辑删除
     * @param $id
     *
     */
    public function logicDel($id){
        $reModel = new M('recharge_order');
        $where = array('id'=>$id);

        return $reModel->data(array('is_del'=>1))->where($where)->update();

    }
}