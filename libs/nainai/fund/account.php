<?php
/**
 * 用户账户管理类
 * author: weipinglee
 * Date: 2016/4/20
 * Time: 16:18
 */
namespace nainai\fund;
abstract class account{

    /**
     * 获取可用余额
     * @param int $user_id
     */
    protected function getActive($user_id){

    }

    /**
     * 获取冻结资金金额
     * @param int $user_id 用户id
     */
    protected function getFeeze($user_id){

    }
    /**
     * 入金操作
     * @param int $user_id 用户id
     * @param $num float 入金金额
     */
    protected function in($user_id,$num){

    }



    /**
     * 资金冻结
     * @param int $user_id 用户id
     * @param float $num 冻结金额
     */
    protected function freeze($user_id,$num){

    }

    /**
     * 冻结资金释放
     * @param int $user_id
     * @param float $num 释放金额
     */
    protected function freezeRelease($user_id,$num){

    }

    /**
     * 冻结资金支付
     * 将冻结资金解冻，支付给另外一个用户
     * @param int $from 冻结账户用户id
     * @param int $to  转到的账户用户id
     * @param float $num 转账的金额
     *
     */
    protected function freezePay($from,$to,$num){

    }

    /**
     * 可用余额直接付款给市场
     * @param int $user_id 支付用户id
     * @param float $num 转账的金额
     */
    protected function payMarket($user_id,$num){

    }


}