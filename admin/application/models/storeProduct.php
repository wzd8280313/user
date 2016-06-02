<?php
/**
 * 仓单管理
 * User: weipinglee
 * Date: 2016/5/8
 * Time: 21:26
 */
use \Library\Query;
use \Library\M;
use \Library\tool;
class storeProductModel extends \nainai\store{


    /**
     *
     * @param $page
     */
    public function getList($page){
       $data =  $this->getStoreProductList($page);
       foreach($data['list'] as $k=>$v){
           $data['list'][$k]['status_txt'] = $this->getStatusText($v['status']);
       }

        return $data;
    }

    /**
     * 获取等待后台审核的仓单
     * @param $page
     */
    public function getApplyList($page){
        $obj = new storeProductModel();
        $con = array();
        $con['where'] = 'a.status = '.self::USER_AGREE;
        $data = $obj->getStoreProductList($page,$con);
        foreach($data['list'] as $k=>$v){
            $data['list'][$k]['status_txt'] = $this->getStatusText($v['status']);
        }
        return $data;

    }


    /**
     * 市场审核
     * @param $store
     * @param $id
     * @return bool
     */
    public function marketCheck($id,$status){
        $old_status = $this->getStoreProductStatus($id);

        if($old_status == self::USER_AGREE) {
            $store['status'] = $status == 1 ? self::MARKET_AGREE : self::MARKET_REJECT;
            $store['market_time'] = \Library\Time::getDateTime();
            $obj = new M('');
            $obj->beginTrans();
            if(false === $this->UpdateApplyStore($store, array('id'=>$id))) {
                $obj->rollBack();
                return tool::getSuccInfo(0,'数据错误');
            }
            else{

            }
            $res = $obj->commit();
            if($res){
                return tool::getSuccInfo();
            }
            else return tool::getSuccInfo(0,'系统繁忙');
        }
        else
        return tool::getSuccInfo(0,'该状态不能审核');
    }

}