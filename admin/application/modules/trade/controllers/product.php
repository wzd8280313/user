<?php
/**
 * @name storeController
 * @author weipinglee
 * @desc 用户管理控制器
 */
use \Library\safe;
use \nainai\certificate;
use \Library\Thumb;
use \nainai\subRight;
use \Library\json;
class productController extends InitController{


    /**
     *分类添加
     */
    public function categoryAddAction(){
        $productModel = new productModel();

        if(IS_POST){//编辑或新增
            $cate['id'] = safe::filterPost('id','int',0);
            $cate['name'] = safe::filterPost('name');
            $cate['childname'] = safe::filterPost('childname');
            $cate['unit'] = safe::filterPost('unit');
            $cate['percent'] = safe::filterPost('percent','int',100);
            $cate['pid']       = safe::filterPost('pid','int',0);
            $cate['sort']      = safe::filterPost('sort','int',0);
            $cate['note']      = safe::filterPost('note');

            $attrs = safe::filterPost('attr_id','int','');
            $cate['attrs']     = $attrs=='' ? '' : implode(',',array_unique($attrs));

            $res = $productModel->updateCate($cate);
            die(json::encode($res));


        }else{

            $cate_id  = $this->getRequest()->getParam('cid',0);
            $cate_id = safe::filter($cate_id,'int');
            //获取所有属性
            $attr = $productModel->getAttr();
            if($cate_id){
                $cateData = $productModel->getCateInfo($cate_id);
                if(!empty($cateData)){
                    $attr_arr = explode(',',$cateData['attrs']);
                    $attr_sel = array();
                    foreach($attr_arr as $v){
                        if($v=='')
                            continue;
                        $attr_sel[$v] = $attr[$v]['name'];
                    }
                    $this->getView()->assign('attr_sel',$attr_sel);
                    $this->getView()->assign('cate',$cateData);
                }


            }
            $cateTree = $productModel->getCateTree();//获取分类树



            $this->getView()->assign('tree',$cateTree);
            $this->getView()->assign('attr',$attr);
        }
    }

    /**
     * 分类列表
     *
     */
    public function categoryListAction(){
        $productModel = new productModel();
        $cateTree = $productModel->getCateTree();//获取分类树
        $attrs    = $productModel->getAttr();//获取所有属性

        //各个分类的属性id转换为属性名称
        foreach($cateTree as $key=>$val){
            $temp = '';
            $attr = explode(',',$val['attrs']);
            foreach($attr as $k=>$v){
                $temp .= isset($attrs[$attr[$k]]['name']) ? $attrs[$attr[$k]]['name'] .',' : '';
            }
            $temp = rtrim($temp,',');
            $cateTree[$key]['attrs'] =$temp;

        }

        $this->getView()->assign('cate',$cateTree);
    }

    /**
     * 属性添加
     */
    public function attributeAddAction(){
        $productModel = new productModel();
        if(IS_POST){
            $attr['id']    = safe::filterPost('id','int',0);
            $attr['name']  = safe::filterPost('name');
            $attr['value'] = safe::filterPost('value');
            $attr['type']  = safe::filterPost('type','int',1);
            $attr['sort']  = safe::filterPost('sort','int',0);
            $attr['note']  = safe::filterPost('note');
            $res = $productModel->updateAttr($attr);
            die(json::encode($res));
        }
        else{
            $attr_id  = $this->getRequest()->getParam('aid',0);
            $attr_id = safe::filter($attr_id,'int',0);
            if($attr_id){
                $attrData = $productModel->getAttrInfo($attr_id);
                if(!empty($attrData))
                    $this->getView()->assign('attr',$attrData);
            }
        }
    }

    /**
     * 属性列表
     */
    public function attributeListAction(){
        $page = safe::filterGet('page','int',1);
        $productModel = new productModel();
        $attrs    = $productModel->getAttr($page);//获取所有属性


        $this->getView()->assign('attr',$attrs[0]);
        $this->getView()->assign('bar',$attrs[1]);
    }

    /**
     * 设置分类开关
     */
    public function setStatusCateAction(){
        if(IS_AJAX){
            $data['status'] = intval(safe::filterPost('status'));
            $data['id'] = intval($this->_request->getParam('id'));
            $storeModel = new productModel();

            $res = $storeModel->updateCate($data);

            echo JSON::encode($res);
            return false;
        }
        return false;
    }
    /**
     * 设置属性开关
     */
    public function setStatusAttrAction(){
        if(IS_AJAX){
            $data['status'] = intval(safe::filterPost('status'));
            $data['id'] = intval($this->_request->getParam('id'));
            $storeModel = new productModel();

            $res = $storeModel->updateAttr($data);

            echo JSON::encode($res);
            return false;
        }
        return false;
    }

    /**
     * 分类删除
     */
    public function logicDelCateAction(){
        if(IS_AJAX){
            $data['is_del'] = 1;
            $data['id'] = intval($this->_request->getParam('id'));
            $storeModel = new productModel();

            $res = $storeModel->updateCate($data);

            echo JSON::encode($res);
            return false;
        }
        return false;
    }

    /**
     * 分类删除
     */
    public function logicDelAttrAction(){
        if(IS_AJAX){
            $data['is_del'] = 1;
            $data['id'] = intval($this->_request->getParam('id'));
            $storeModel = new productModel();

            $res = $storeModel->updateAttr($data);

            echo JSON::encode($res);
            return false;
        }
        return false;
    }





}