<?php
/**
 * 自由报盘管理类
 * author: weipinglee
 * Date: 2016/5/7
 * Time: 21:59
 */

namespace nainai\offer;
use nainai\fund;
use \Library\tool;
class freeOffer extends product{



    /**
     * 获取自由报盘费率 TODO
     *
     */
    public function getFee(){
        $m = new \nainai\member();
        $group = $m->getUserGroup($this->user_id);
        if(empty($group)){
            return 0;
        }
        else{
            return $group['free_fee'];
        }
    }

    /**
     * 报盘申请插入数据
     * @param array $productData  商品数据
     * @param array $offerData 报盘数据
     *
     */
    public function doOffer($productData,$offerData){
        $user_id = $this->user_id;
        $acc_type = $offerData['acc_type'];
        $fund = fund::createFund($acc_type);
        $active = $fund->getActive($this->user_id);//获取用户可用金额
        $fee = $this->getFee();//获取自由报盘费用

        $total = bcmul($productData[0]['quantity'],$offerData['price']);
        $fee = bcmul($total,$fee)/100;
        if($active >= $fee){
            $offerData['offer_fee'] = $fee;
            $offerData['user_id'] = $user_id;
            $offerData['mode'] = self::FREE_OFFER;
            $this->_productObj->beginTrans();
            $insert = $this->insertOffer($productData,$offerData);

            if($insert===true){
                $fund->freeze($user_id,$fee);
                if($this->_productObj->commit()){
                    return tool::getSuccInfo();
                }
                else  return tool::getSuccInfo(0,$this->errorCode['server']['info']);
            }
            else{
                $this->_productObj->rollBack();
                $this->errorCode['dataWrong']['info'] = $insert;
                return tool::getSuccInfo(0,$this->errorCode['dataWrong']['info']);
            }

        }
        else{//资金不足
            return tool::getSuccInfo(0,$this->errorCode['fundLess']);
        }

    }

}