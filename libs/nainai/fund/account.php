<?php
/**
 * �û��˻�������
 * author: weipinglee
 * Date: 2016/4/20
 * Time: 16:18
 */
namespace nainai\fund;
abstract class account{

    /**
     * ��ȡ�������
     * @param int $user_id
     */
    protected function getActive($user_id){

    }

    /**
     * ��ȡ�����ʽ���
     * @param int $user_id �û�id
     */
    protected function getFeeze($user_id){

    }
    /**
     * ������
     * @param int $user_id �û�id
     * @param $num float �����
     */
    protected function in($user_id,$num){

    }



    /**
     * �ʽ𶳽�
     * @param int $user_id �û�id
     * @param float $num ������
     */
    protected function freeze($user_id,$num){

    }

    /**
     * �����ʽ��ͷ�
     * @param int $user_id
     * @param float $num �ͷŽ��
     */
    protected function freezeRelease($user_id,$num){

    }

    /**
     * �����ʽ�֧��
     * �������ʽ�ⶳ��֧��������һ���û�
     * @param int $from �����˻��û�id
     * @param int $to  ת�����˻��û�id
     * @param float $num ת�˵Ľ��
     *
     */
    protected function freezePay($from,$to,$num){

    }

    /**
     * �������ֱ�Ӹ�����г�
     * @param int $user_id ֧���û�id
     * @param float $num ת�˵Ľ��
     */
    protected function payMarket($user_id,$num){

    }


}