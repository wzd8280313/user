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
use \Library\M;
class storeOffer extends product{


    /**
     * 报盘申请插入数据
     * @param array $productData  商品数据
     * @param array $offerData 报盘数据
     *
     */
    public function doOffer($offerData){
        $user_id = $this->user_id;
        $acc_type = $offerData['acc_type'];
        $fund = fund::createFund($acc_type);
        $active = $fund->getActive($this->user_id);//获取用户可用金额
        $fee = $this->getFee();//获取自由报盘费用
        if($active >= $fee){
            $offerData['offer_fee'] = $fee;
            $offerData['user_id'] = $user_id;
            $offerData['mode'] = self::FREE_OFFER;
            $this->_productObj->beginTrans();
            $insert = $this->insertOffer($productData,$offerData);

            if($insert===true){
                $fund->freeze($user_id,$fee);
                if($this->_productObj->commit()){
                    return true;
                }
                else return $this->errorCode['server'];
            }
            else{
                $this->_productObj->rollBack();
                $this->errorCode['dataWrong']['info'] = $insert;
                return $this->errorCode['dataWrong'];
            }

        }
        else{//资金不足
            return $this->errorCode['fundLess'];
        }

    }

    /**
     * 仓单报盘数据添加
     * @param int $id 仓单id
     * @param  [Array] $productOffer [报盘的数据]
     * @return [Array]
     */
    public function insertStoreOffer($id, & $productOffer){
        if ($this->_productObj->validate($this->productOfferRules, $productOffer)) {
            $productOffer['mode'] = self::STORE_OFFER;

            $obj = new M('store_products');
            $obj->beginTrans();
            $obj->data(array('is_offer'=>1))->where(array('id'=>$id))->update();//更改为已报盘
            $this->_productObj->table('product_offer')->data($productOffer)->add();
            $res = $obj->commit();
        }else{
            $res = $this->_productObj->getError();
        }

        if ($res===true) {
            return Tool::getSuccInfo(1, '报盘成功');
        }else{
            return Tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
        }
    }

}