<?php 

/**
 * 提货
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;

class DeliveryController extends UcenterBaseController {

	protected function  getLeftArray(){
        return array(
            array('name' => '交易管理', 'list' => array()),
            array('name' => '销售管理', 'list' => array(
                array('url' => '', 'title' => '销售列表' ),
                array('url' => url::createUrl('/ManagerDeal/indexOffer'), 'title' => '发布产品' ),
            )),
            array('name' => '仓单管理', 'list' => array(
                array('url' => url::createUrl('/ManagerDeal/storeProduct'), 'title' => '申请仓单' ),
                array('url' => '', 'title' => '仓单列表' ),
            )),
            array('name' => '采购管理', 'list' => array(
                array('url' => '', 'title' => '采购列表' ),
                array('url' => '', 'title' => '发布采购' ),
            )),
            array('name' => '合同管理', 'list' => array(
                array('url' => url::createUrl('/Contract/sellerList'), 'title' => '销售合同' ),
                array('url' => url::createUrl('/Contract/buyerList'), 'title' => '购买合同' ),
            )),
            array('name' => '提货管理', 'list' => array(
                array('url' => url::createUrl('/Delivery/deliveryList?is_seller=0'), 'title' => '购买提单列表' ),
                array('url' => url::createUrl('/Delivery/deliveryList?is_seller=1'), 'title' => '销售提单列表' ),
            ))
        );
    }

    //提货页面
    public function newDeliveryAction(){
        $order_id = safe::filter($this->_request->getParam('order_id'));

        $delivery = new \nainai\delivery\Delivery();

        //获取此订单可以提取货物数量
        $left = $delivery->orderNumLeft($order_id,false);//返回数值
        if(!is_float($left)){
            //报错
            $this->error($left);exit;
        }

        $info = $delivery->deliveryStore($order_id);
        $info['left'] = $left;
        $this->getView()->assign('data',$info);
    }

    //生成提货表
    public function geneDeliveryAction(){
        $deliveryData['order_id'] = safe::filterPost('order_id','int');
        $deliveryData['num'] = safe::filterPost('num');
        $deliveryData['delivery_man'] = safe::filterPost('delivery_man');
        $deliveryData['phone'] = safe::filterPost('phone');
        $deliveryData['idcard'] = safe::filterPost('idcard');
        $deliveryData['plate_number'] = safe::filterPost('plate_number');
        $deliveryData['expect_time'] = date('Y-m-d H:i:s',strtotime(safe::filterPost('expect_time')));
        $deliveryData['remark'] = safe::filterPost('remark');

        $deliveryData['user_id'] = $this->user_id;

        $delivery = new \nainai\delivery\Delivery();
        $res = $delivery->geneDelivery($deliveryData);

        if($res['success'] == 1){
            $this->redirect(url::createUrl('/Delivery/deliveryList'));
        }else{
            $this->error($res['info']);
        }
    }

	//获取当前登陆用户的提货列表
    public function deliveryListAction(){
        $delivery = new \nainai\delivery\Delivery();
        $is_seller = safe::filter($this->_request->getParam('is_seller'),'int');
        $page = safe::filterGet('page','int',1);
        $user = $this->user_id;
        $list = $delivery->deliveryList($user,$page,$is_seller == 1 ? true : false);

        $this->getView()->assign('data',$list['data']);
        $this->getView()->assign('page',$list['bar']);
    }

}