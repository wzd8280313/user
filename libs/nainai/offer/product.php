<?php
/**
 * 商品管理类
 * author: weipinglee
 * Date: 2016/4/19
 * Time: 13:31
 */
namespace nainai\offer;
use \Library\M;
use \Library\Time;
use \Library\Query;
use \Library\Thumb;
use \Library\log;
use \Library\tool;
class product{

    private $product_limit = 5;

    protected $errorCode = array(
        'fundLess' => array('code'=>-1,'info'=>'账户余额不足'),
        'dataWrong' => array('code'=>1,'info'=>''),
        'server'   => array('code'=>2,'info'=>'网络错误')
    );

    //是否可拆分
    const DIVIDE = 0;//可拆分
    const UNDIVIDE = 1;//不可拆分
    //报盘类型
    const FREE_OFFER  = 1;
    const DEPOSIT_OFFER = 2;
    const DEPUTE_OFFER  = 3;
    const STORE_OFFER = 4;

    private $_errorInfo = '';

    protected $user_id = '';

    //报盘状态
    const OFFER_APPLY = 0;
    const OFFER_OK    = 1;
    const OFFER_NG    = 2;
    const OFFER_EXPIRE = 3;//过期

    //获取状态信息
    public function getStatus($status){
        switch ($status) {
            case self::OFFER_APPLY:
                $st = '待审核';
                break;
            case self::OFFER_OK:
                $st = '已通过';
                break;
            case self::OFFER_NG:
                $st = '未通过';
                break;
            case self::OFFER_EXPIRE:
                $st = '已过期';
                break;
            default:
                $st = '未知';
                break;
        }
        return $st;
    }

    //获取报盘模式文本
    public function getMode($mode){
        switch ($mode) {
            case self::FREE_OFFER:
                $mode_txt = '自由报盘';
                break;
            case self::DEPOSIT_OFFER:
                $mode_txt = '保证金报盘';
                break;
            case self::STORE_OFFER:
                $mode_txt = '仓单报盘';
                break;
            case self::DEPUTE_OFFER :
                $mode_txt = '委托报盘';
                break;
            default:
                $mode_txt = '未知';
                break;
        }
        return $mode_txt;
    }

    //获取交易方式
    public function getType($type){
        switch ($type) {
            case 1:
                $tp = '卖盘';
                break;
            case 2:
                $tp = '买盘';
                break;

            default:
                $tp = '未知';
                break;
        }
        return $tp;
    }
    /**
     * 商品验证规则
     * @var array
     */
    protected $productRules = array(
        array('name','require','商品名称必须填写'),
        array('cate_id','number','商品类型id错误'),
        array('price','double','商品价格必须是数字'),
        array('quantity','double','供货总量必须是整数'),
        array('attribute', 'require', '请选择商品属性'),
        array('note', 'require', '商品描述必须填写')
    );

    /**
     * 报盘验证规则
     * @var array
     */
    protected $productOfferRules = array(
        array('product_id', 'number', '必须有商品id'),
        array('mode', 'number', '必须有报盘类型'),
        array('divide', 'number','是否可拆分的id错误'),
        array('acc_type','/^[\d+,?]+$/','账户类型错误'),
        array('offer_fee','currency','金额错误'),
        array('sign','/^[a-zA-Z0-9_@\.\/]+$/','请上传图片'),
        array('accept_area', 'require', '交收地点必须填写'),
        array('accept_day', 'number', '交收时间必须填写')
    );

    /**
     * pdo的对象
     * @var [Obj]
     */
    protected $_productObj;

    /**
     * @param int $user_id 用户id
     */
    public function __construct($user_id=0){
        $this->_productObj = new M('products');
        if($user_id!=0){
            $this->user_id = $user_id;
        }
    }

    public function getErrorMessage(){
        return $this->_errorInfo;
    }

    public function setErrorMessage($mess){
        $this->_errorInfo = $mess;
    }

    /**
     * 获取分级的分类
     * @param int $gid
     * @return array array('chain'=>,'default'=>,1=>,2=>);
     */
    public function getCategoryLevel($pid = 0){
        $where  = array('status' => 1);
        $category = $this->_productObj->table('product_category')->fields('id,pid, name, unit, childname, attrs')->where($where)->select();

        $res = $this->generateTree($category);

        return  $this->getCateChain($pid,$res);

    }

    /**
     * 获取所有顶级分类
     */
    public function getTopCate(){
        $where  = array('status' => 1,'pid'=>0);
        $category = $this->_productObj->table('product_category')->fields('id,pid, name, unit, childname, attrs')->where($where)->select();
        return $category;
    }


    /**
     * 获取下级所有分类，以及分类链
     * @param $pid
     * @param $category
     * @return mixed
     */
    private function getCateChain($pid,$category){
         static $chain = array();
        static $res = array();
        $len = count($category);
        $step = 0;
        if($pid!=0){
            foreach($category as $k=>$v){
                $step += 1;
                $chain[] = $k;
                if($k!=$pid && !empty($category[$k]['child'])){
                    $this->getCateChain($pid,$category[$k]['child']);
                }
                else if($k!=$pid && empty($category[$k]['child'])){//不等于pid且无下级分类
                    array_pop($chain);
                }
                else if($k==$pid){
                    $pidChain = $chain;
                    $cate = $this->getchildCate($category[$k]['child']);
                    if(empty($cate)){
                        $res['chain'] = $pidChain;
                        $res['cate']  = array();
                        $res['default'] = $pid;
                        $res['unit'] = $v['unit'];
                    }
                    else{
                        $res['chain'] = array_merge($pidChain,$cate[1]);
                        $res['cate']  = $cate[0];
                        $res['default'] = $cate[1][count($cate[1])-1];
                        $res['unit'] = $cate[2];
                    }

                }
                if($len==$step)array_pop($chain);
            }
        }
        else{
            $cate = $this->getchildCate($category);
            $res['chain'] = $cate[1];
            $res['cate']  = $cate[0];
            $res['default'] = $cate[1][count($cate[1])-1];
            $res['unit'] = $cate[2];

        }


        return $res;
    }

    /**
     * 获取下级所有分类，以及下级所有第一个分类id,单位
     * @param array
     */
    private function getChildCate($cate,$level=1){
        if(empty($cate))return array();
        static $cateChild = array();
        static $cateFirst = array();
         static $step = 0;
        static $unit = '';
        $step1 = 0;
        foreach($cate as $k=>$v){

            if($step==0){//记录第一个分类序列
                $cateFirst[] = $k;
                $unit = $v['unit'];
            }

            if(isset($cate[$k]['child'])){
                $temp = $cate[$k]['child'];
                unset($cate[$k]['child']);
                $cateChild[$level]['show'][] = $cate[$k];//所有分类写入

                if($step1==0 ) {//只有第一个分类才遍历子分类
                    $this->getChildCate($temp,$level+1);
                }

            }
            else{
                $cateChild[$level]['show'][] = $cate[$k];//所有分类写入
            }

            $step1 +=1;
            $step += 1;
        }
        return array($cateChild,$cateFirst,$unit);
    }
    /**
     * 获取递归数组
     * @param array $items
     * @param int $pid 父类id
     * @return array
     */
    private  function generateTree(&$items,$pid=0,$unit=''){
         $tree = array();

        foreach($items as $key=>$item){
            if($item['pid']==$pid){
                $v = $items[$key];
                $v['unit'] = $items[$key]['unit'] =='' ? $unit : $items[$key]['unit'] ;

                $tree[$item['id']] = $v;
                unset($items[$key]);
                $tree[$item['id']]['child'] = $this->generateTree($items,$item['id'],$v['unit']);

            }
        }

         return  $tree;
    }


    /**
     *获取所有分类的属性，去除重复
     * @param array $cates 分类数组,array(2,3)
     * @return mixed
     */
    public function getProductAttr($cates=array()){
        if(empty($cates))
            return array();
        $attrs = $this->_productObj->table('product_category')->fields('attrs')->where('id in ('.join(',',$cates).')')->select();

        $attr_arr = array();
        foreach($attrs as $v){
            if($v['attrs']!='')
                $attr_arr = array_merge($attr_arr,explode(',',$v['attrs']));
        }
        if(empty($attr_arr))
            return array();
        return $this->_productObj->table('product_attribute')->where('id in ('.join(',',$attr_arr).')')->select();
    }

    /**
     * 验证商品数据是否正确
     * @param array $productData 商品数据
     * @return bool
     */
    public function proValidate($productData){
        if($this->_productObj->validate($this->productRules,$productData)){
            return true;
        }

        return false;
    }

    /**
     * 获取商品详情
     * @param int $product_id 商品id
     *
     */
    public function getProductDetails($product_id){
        if(!$product_id)
            return array();
        $obj = new M('products');
        $obj->fields('name as product_name,  attribute, produce_area, create_time, quantity,cate_id, unit, id as product_id, price, note');
        $obj->where(array('id'=>$product_id));
        $detail = $obj->getObj();

        $attr_ids = array();
        $detail['attribute'] = unserialize($detail['attribute']);
        if(!empty($detail['attribute'])){
            foreach ($detail['attribute'] as $key => $value) {
                $attr_ids[] = $key;
            }
        }

        //获取所属分类
        $cates = $this->getParents($detail['cate_id']);
        $detail['cate'] = array_reverse($cates);
        //获取属性
        $attrs = $this->getHTMLProductAttr($attr_ids);
        $detail['attrs'] = '';
        if(!empty($detail['attribute'])) {
            foreach ($detail['attribute'] as $key => $value) {
                $detail['attr_arr'][$attrs[$key]] = $value;
                $detail['attrs'] .= $attrs[$key] . ' : ' . $value . ';';
            }
        }
        //获取图片
        $detail['photos'] = $this->getProductPhoto($product_id);
        return $detail;

    }

    /**
     * 获取产品的属性值，对应的属性id
     * @param  array  $attr_id [属性id]
     * @return [Array]   
     */
    public function getHTMLProductAttr($attr_id = array()){
        $attrs = array();
        if (!empty($attr_id)) {
            $attrObj = new M('product_attribute');
            $attr_id = $attrObj->fields('id, name')->where('id IN (' . implode(',', $attr_id) . ')')->select();
            foreach ($attr_id as $value) {
               $attrs[$value['id']] = $value['name']; 
            }
        }

        return $attrs;
    }

        /**
         * 根据产品id获取图片
         * @param  [type] $pid [description]
         * @return [type]      [description]
         */
        public function getProductPhoto($pid = 0){
            $photos = array();
            if (intval($pid) > 0) {
                $imgObj = new M('product_photos');
                $photos = $imgObj->fields('id, img')->where(array('products_id'=>$pid))->select();

                foreach ($photos as $key => $value) {
                    $photos[$key] = Thumb::get($value['img'],180,180);
                }

            }

            return $photos;
        }

        /**
         * 添加商品数据
         * @param  [Array] &$productData [提交的商品数据]
         * @param  [Array] &$productOffer[提交的报盘数据]
         * @return [Array]               [添加是否成功，及失败信息]
         */
        protected function insertOffer(&$productData, &$productOffer){
            if ($this->_productObj->validate($this->productRules,$productData) && $this->_productObj->validate($this->productOfferRules, $productOffer)){

                $pId = $this->_productObj->data($productData[0])->add();
                $productOffer['product_id'] = $pId;

                   $this->_productObj->table('product_offer')->data($productOffer)->add(1);
                    $imgData = $productData[1];
                    if (!empty($imgData)) {
                        foreach ($imgData as $key => $imgUrl) {
                            $imgData[$key]['products_id'] = $pId;
                        }
                        $this->_productObj->table('product_photos')->data($imgData)->adds(1);
                    }
                return true;

            }else{
                 return $this->_productObj->getError();
            }

    }


    /**
     * 将小数格式化，去掉小数点后尾部的0
     * @param float $float 小数
     *
     */
    public function floatForm($float){
        $float = strval($float);
        if(strpos($float,'.')===false){//如果是整数，直接返回
            return intval($float);
        }
        else{
            $n = strlen($float);
            $i=$n-1;
            while($i>0){
                if($float[$i]!='0')
                    break;
                $i = $i-1;
            }
            $float = substr($float,0,$i+1);
            return floatval($float);
        }
    }

    /**
     * 获取某一商品分类所有父级分类
     * @param int $cate_id 分类id
     * @return array
     */
    public function getParents($cate_id){
        if(!($cate_id && $cate_id>0)) return array();
        $m = new M('product_category');
        $data = $m->select();
        $res = $this->listParents($data,$cate_id);
        return $res;
    }

    private function listParents($data,$id,$parents = array()){
        foreach ($data as $key => $value) {
            if($value['id'] == $id){
                $parents []= array('id'=>$id,'name'=>$value['name']);
                $pid = $value['pid'];
                if($pid != 0){
                    $parents = $this->listParents($data,$pid,$parents);
                }
            }
        }
        return $parents;
    }





}
