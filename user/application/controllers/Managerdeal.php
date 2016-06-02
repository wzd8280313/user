<?php

use \Library\checkRight;
use \Library\PlUpload;
use \Library\photoupload;
use \Library\json;
use \Library\url;
use \Library\safe;
use \Library\Thumb;
use \Library\tool;
use \nainai\store;
use \nainai\offer\product;
use \nainai\offer\freeOffer;
use \nainai\offer\depositOffer;
use \nainai\offer\deputeOffer;
/**
 * 交易管理的控制器类
 */
class ManagerDealController extends UcenterBaseController {
    /**
     * 设置分类多少以后有展开
     * @var integer
     */
    private $_limiteProduct = 2;


    /**
     * 提示mode对应的类型
     * @var array
     */
    private $_mode = array(
        1 => '自由报盘',
        2 => '保证金报盘',
        3 => '委托报盘',
        4 => '仓单报盘'
    );

    protected  $certType = 'deal';//需要的认证类型

    //买家不能操作的方法
    protected $sellerAction = array('productlist','indexoffer','freeOffer','dofreeoffer','depositoffer','dodepositoffer',
        'deputeoffer','dodeputeoffer','storeoffer','dostoreoffer');

    /**
     * 获取左侧菜单
     * @return array
     */
    protected function  getLeftArray(){
        $left = array();
        $left[] = array('name' => '交易管理', 'list' => array());
        if($this->user_type==1){
            $left[] =  array('name' => '销售管理', 'list' => array(
                array('url' => url::createUrl('/ManagerDeal/productlist'), 'title' => '销售列表','action'=>array('productlist') ),
                array(
                    'url' => url::createUrl('/ManagerDeal/indexOffer'),
                    'title' => '发布产品' ,
                    'action' => array('indexoffer','freeoffer','depositoffer','deputeoffer','storeoffer'),//action都用小写

                ),
            ));
        }
        $left[] =  array('name' => '仓单管理', 'list' => array(
            array('url' => url::createUrl('/ManagerDeal/storeProduct'), 'title' => '申请仓单','action'=>array('storeproduct') ),
            array('url' => url::createUrl('/ManagerDeal/storeProductList'), 'title' => '仓单列表','action'=>array('storeproductlist','storeproductdetail') ),
        ));
        $left[] =  array('name' => '采购管理', 'list' => array(
            array('url' => '', 'title' => '采购列表' ),
            array('url' => '', 'title' => '发布采购' ),
        ));

        $left[] = array('name' => '合同管理', 'list' => array(
            array('url' => url::createUrl('/Contract/sellerList'), 'title' => '销售合同' ),
            array('url' => '', 'title' => '购买合同' ),
        ));
       return $left;

    }
    /**
     * 个人中心首页
     */
    public function indexAction(){

    }

    /**
     * 产品发布页面展示
     * @return
     */
    public function indexOfferAction(){

    }

    public function addSuccessAction(){

    }

   /**
     * 商品添加页面展示
     */
    private function productAddAction(){
        
        $category = array();

        //获取商品分类信息，默认取第一个分类信息
        $productModel = new product();
        $category = $productModel->getCategoryLevel();

        $attr = $productModel->getProductAttr($category['chain']);
        //上传图片插件
        $plupload = new PlUpload(url::createUrl('/ManagerDeal/swfupload'));

        //注意，js要放到html的最后面，否则会无效
        $this->getView()->assign('plupload',$plupload->show());
        $this->getView()->assign('categorys', $category['cate']);
        $this->getView()->assign('attrs', $attr);
        $this->getView()->assign('unit', $category['unit']);
        $this->getView()->assign('cate_id', $category['default']);
    }

    /**
     * 自由报盘申请页面
     *
     */
    public function freeOfferAction(){
        $freeObj = new freeOffer();
        $freeFee = $freeObj->getFee();
        $this->getView()->assign('fee',$freeFee);
        $this->productAddAction();
    }


    /**
     * 自由报盘提交处理
     *
     */
    public function doFreeOfferAction(){
        if(IS_POST){
            $offerData = array(
                'apply_time'  => \Library\Time::getDateTime(),
                'divide'      => Safe::filterPost('divide', 'int'),
                'minimum'     => ($this->getRequest()->getPost('divide') == 0) ? Safe::filterPost('minimum', 'int') : 0,

                'accept_area' => Safe::filterPost('accept_area'),
                'accept_day' => Safe::filterPost('accept_day', 'int'),
                'price'        => Safe::filterPost('price', 'float'),
                'acc_type'   => 1,//现在写死了，就是代理账户
            );

            $offerObj = new freeOffer($this->user_id);
            $productData = $this->getProductData();
            $res = $offerObj->doOffer($productData,$offerData);

            echo json::encode($res);
            exit;
        }
        return false;

    }

    /**
     * 保证金报盘申请页面
     *
     */
    public function depositOfferAction(){
        $depositObj = new \nainai\offer\depositOffer();
        $rate = $depositObj->getDepositRate($this->user_id);
        $this->getView()->assign('rate',$rate);
        $this->productAddAction();
    }

    /**
     * 保证金报盘提交处理
     *
     */
    public function doDepositOfferAction(){
        if(IS_POST){
            $offerData = array(
                'apply_time'  => \Library\Time::getDateTime(),
                'divide'      => safe::filterPost('divide', 'int'),
                'minimum'     => ($this->getRequest()->getPost('divide') == 0) ? safe::filterPost('minimum', 'int') : 0,

                'accept_area' => safe::filterPost('accept_area'),
                'accept_day' => safe::filterPost('accept_day', 'int'),
                'price'        => safe::filterPost('price', 'float'),
               // 'acc_type'   => 1,
            );

            $depositObj = new depositOffer($this->user_id);
            $productData = $this->getProductData();
            $res = $depositObj->doOffer($productData,$offerData);

            echo json::encode($res);
            exit;
        }
        else
        echo \Library\json::encode(tool::getSuccInfo(0,'操作失败'));
        exit;

    }



    /**
     * 委托报盘申请页面
     *
     */
    public function deputeOfferAction(){
        $Obj = new \nainai\offer\deputeOffer();
        $rate = $Obj->getFeeRate($this->user_id);
        $this->getView()->assign('rate',$rate);
        $this->productAddAction();
    }

    /**
     * 保证金报盘提交处理
     *
     */
    public function doDeputeOfferAction(){
        if(IS_POST){
            $offerData = array(
                'apply_time'  => \Library\Time::getDateTime(),
                'divide'      => Safe::filterPost('divide', 'int'),
                'minimum'     => ($this->getRequest()->getPost('divide') == 0) ? Safe::filterPost('minimum', 'int') : 0,

                'accept_area' => Safe::filterPost('accept_area'),
                'accept_day' => Safe::filterPost('accept_day', 'int'),
                'price'        => Safe::filterPost('price', 'float'),
                'sign'        => Tool::setImgApp(Safe::filterPost('imgfile1')),//委托书照片
                // 'acc_type'   => 1,
            );

            $deputeObj = new deputeOffer($this->user_id);
            $productData = $this->getProductData();
            $res = $deputeObj->doOffer($productData,$offerData);

            echo json::encode($res);
            exit;
        }
        return false;

    }

    /**
     * 仓单报盘
     * @return 
     */
    public function storeOfferAction(){
        $storeModel = new \nainai\store();
        $storeList = $storeModel->getUserActiveStore($this->user_id);

        $this->getView()->assign('storeList', $storeList['list']);
    }

    /**
     * 申请仓单页面
     */
    public function storeProductAction(){
        $store_list = store::getStoretList();
        $this->getView()->assign('storeList',$store_list);
        $this->productAddAction();
    }



    /**
     * Ajax获取仓单报盘页面的商品详情
     * @return 
     */
    public function ajaxGetStoreAction(){
        $return_json = array();
        $pid = Safe::filterPost('pid', 'int');

        if (IS_AJAX && intval($pid) > 0) {
            $storeModel = new \nainai\store();
            $return_json = $storeModel->getUserStoreDetail($pid,$this->user_id);

        }

        echo JSON::encode($return_json);
        return false;
    }

        /**
         * AJax获取产品分类信息
         * @return [Json]
         */
        public function ajaxGetCategoryAction(){
            $pid = Safe::filterPost('pid', 'int',0);

            if($pid){
                $productModel = new product();
                $cate = $productModel->getCategoryLevel($pid);

                $cate['attr'] = $productModel->getProductAttr($cate['chain']);
                unset($cate['chain']);
                echo JSON::encode($cate);
            }
            return false;
        }



    /**
     * 获取POST提交上来的商品数据,报盘处理和申请仓单处理都会用到
     * @return array 商品数据数组
     */
    private function getProductData(){
        $attrs = Safe::filterPost('attribute');
        foreach($attrs as $k=>$v){
            if(!is_numeric($k)){
                echo JSON::encode(tool::getSuccInfo(0,'属性错误'));
                exit;
            }
        }
        $time = date('Y-m-d H:i:s', time());


        $detail = array(
            'name'         => Safe::filterPost('warename'),
            'cate_id'      => Safe::filterPost('cate_id', 'int'),
            'price'        => Safe::filterPost('price', 'float'),
            'quantity'     => Safe::filterPost('quantity', 'int'),
            'attribute'    => serialize($attrs),
            'note'         => Safe::filterPost('note'),
            'produce_area' => Safe::filterPost('area'),
            'create_time'  => $time,
            //'unit'         => Safe::filterPost('unit'),
            'user_id' => $this->user_id
        );

        //图片数据
        $imgData = Safe::filterPost('imgData');

        $resImg = array();
        if(!empty($imgData)){

            foreach ($imgData as $imgUrl) {
                if (!empty($imgUrl) && is_string($imgUrl)) {
                    array_push($resImg, array('img' => tool::setImgApp($imgUrl)));
                }
            }
        }

        return array($detail,$resImg);
    }


    /**
     * 处理仓单报盘
     * @return
     */
    public function doStoreOfferAction(){
        if (IS_POST) {
            $id = Safe::filterPost('storeproduct', 'int', 0);//仓单id
            $storeObj = new \nainai\store();

            if ($storeObj->judgeIsUserStore($id, $this->user_id)) { //判断是否为用户的仓单
                // 报盘数据
                $offerData = array(
                    'apply_time'  => \Library\Time::getDateTime(),
                    'divide'      => Safe::filterPost('divide', 'int'),
                    'minimum'     => ($this->getRequest()->getPost('divide') == 0) ? Safe::filterPost('minimum', 'int') : 0,
                    'status'      => 0,
                    'accept_area' => Safe::filterPost('accept_area'),
                    'accept_day' => Safe::filterPost('accept_day', 'int'),
                    'price'        => Safe::filterPost('price', 'float'),
                    'user_id'     => $this->user_id,
                );
                
                $offerObj = new \nainai\offer\storeOffer($this->user_id);
                $offerData['product_id'] = Safe::filterPost('product_id', 'int');
                $res = $offerObj->insertStoreOffer($id,$offerData);
                die(json::encode($res)) ;
            }
            die(json::encode(tool::getSuccInfo(0,'仓单不存在'))) ;
        }

        $this->redirect('indexoffer');
    }

    /**
     * 申请仓单处理
     */
    public function doStoreProductAction(){
        if(IS_POST){
            $productData = $this->getProductData();//获取商品数据
            $storeList = array(
                'store_id' => Safe::filterPost('store_id', 'int'),
                'package'  => Safe::filterPost('package','int'),
                'package_num' => Safe::filterPost('package_num'),
                'package_unit' => Safe::filterPost('package_unit'),
                'package_weight' => Safe::filterPost('package_weight'),
                'apply_time'  => \Library\Time::getDateTime(),
                'user_id' => $this->user_id
            );
            $storeObj = new store();
            $res = $storeObj->createStoreProduct($productData,$storeList);
            echo json::encode($res);

        }
        return false;
    }

    /**
     * 仓单列表
     */
    public function storeProductListAction(){
        $page = Safe::filterGet('page', 'int', 0);
        $store = new store();

        $data = $store->getUserStoreList($page,$this->user_id);
        $this->getView()->assign('statuList', $store->getStatus());
        $this->getView()->assign('storeList', $data['list']);
        $this->getView()->assign('attrs', $data['attrs']);
        $this->getView()->assign('pageHtml', $data['pageHtml']);

    }

    /**
     * 仓单详情
     * @return bool
     */
    public function storeProductDetailAction(){
        $id = $this->getRequest()->getParam('id');
        $id = Safe::filter($id,'int',0);
        if($id){
            $stObj = new store();
            $detail = $stObj->getUserStoreDetail($id,$this->user_id);

            $this->getView()->assign('detail', $detail);
        }

        else
        return false;
    }

    /**
     * 仓单确认
     */
    public function userMakeSureAction(){
        if(IS_POST){
            $storeProductID = safe::filterPost('id','int',0);
            $status = safe::filterPost('status','int',0);
            $store = new store();
           $res = $store->userCheck($status,$storeProductID,$this->user_id);
           die(json::encode($res));

        }
        return false;

    }
    //上传接口
    public function swfuploadAction(){
        //调用文件上传类
        $photoObj = new photoupload();
        $photoObj->setThumbParams(array(180,180));
        $photo = current($photoObj->uploadPhoto());

        if($photo['flag'] == 1)
        {
            $result = array(
                'flag'=> 1,
                'img' => $photo['img'],
                'thumb'=> $photo['thumb'][1]
            );
        }
        else
        {
            $result = array('flag'=> $photo['flag'],'error'=>$photo['errInfo']);
        }
        echo JSON::encode($result);

        return false;
    }



    /**
     * 产品列表页面
     */
    public function productListAction(){
        $page = Safe::filterGet('page', 'int', 0);
        $name = Safe::filterGet('name');
        $status = Safe::filterGet('status', 'int', 9);
        $beginDate = Safe::filterGet('beginDate');
        $endDate = Safe::filterGet('endDate');

        //查询组装条件
        $where = 'c.user_id=:uid';
        $bind = array('uid' => $this->user_id);

        if (!empty($name)) {
            $where .= ' AND a.name like"%'.$name.'%"';
            $this->getView()->assign('name', $name);
        }

        if (!empty($status) && $status != 9 || $status==0) {
            $where .= ' AND c.status=:status';
            $bind['status'] = $status;

        }

        if (!empty($beginDate)) {
            $where .= ' AND apply_time>=:beginDate';
            $bind['beginDate'] = $beginDate;
            $this->getView()->assign('beginDate', $beginDate);
        }

        if (!empty($endDate)) {
            $where .= ' AND apply_time<=:endDate';
            $bind['endDate'] = $endDate;
            $this->getView()->assign('endDate', $endDate);
        }

        $productModel = new productModel();
        $productList = $productModel->getOfferProductList($page, $this->pagesize,  $where, $bind);

        $this->getView()->assign('status', $status);
        $this->getView()->assign('mode', $this->_mode);
        $this->getView()->assign('productList', $productList['list']);
        $this->getView()->assign('pageHtml', $productList['pageHtml']);
    }


    /**
     * 产品详情页面
     */
    public function productDetailAction(){

        $id = $this->getRequest()->getParam('id');
        $id = Safe::filter($id, 'int', 0);

        if (intval($id) > 0) {
            $productModel = new productModel();
            $offerDetail = $productModel->getOfferProductDetail($id,$this->user_id);

            $this->getView()->assign('offer', $offerDetail[0]);
            $this->getView()->assign('product', $offerDetail[1]);
        }

    }









}
