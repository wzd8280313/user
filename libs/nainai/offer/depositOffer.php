<?php
/**
 * ��֤���̹�����
 * author: weipinglee
 * Date: 2016/5/7
 * Time: 23:16
 */
namespace nainai\offer;
use \Library\tool;
class depositOffer extends product{

    /**
     * ��ȡ��֤����ȡ���� TODO
     */
    public function getDepositRate($user_id){
        return 10;
    }

    /**
     * ���������������
     * @param array $productData  ��Ʒ����
     * @param array $offerData ��������
     */
    public function doOffer($productData,$offerData){
        $offerData['mode'] = self::DEPOSIT_OFFER;
        $this->_productObj->beginTrans();
        $offerData['user_id'] = $this->user_id;
        $insert = $this->insertOffer($productData,$offerData);

        if($insert===true){
            if($this->_productObj->commit()){
                return tool::getSuccInfo();
            }
            else return tool::getSuccInfo(0,$this->errorCode['server']['info']);
        }
        else{
            $this->_productObj->rollBack();
            $this->errorCode['dataWrong']['info'] = $insert;
            return tool::getSuccInfo(0,$this->errorCode['dataWrong']['info']);
        }

    }
}