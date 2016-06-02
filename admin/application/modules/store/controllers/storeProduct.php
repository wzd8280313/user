<?php
/**
 * @name storeController
 * @author weipinglee
 * @desc 用户管理控制器
 */
use \Library\safe;
use \Library\Thumb;
use \nainai\subRight;
use \Library\tool;
class storeProductController extends Yaf\Controller_Abstract{

    public function init(){
        $this->getView()->setLayout('admin');
        //echo $this->getViewPath();
    }

    /**
     * 获取仓单列表
     */
   public function getListAction(){
       $page = safe::filterGet('page','int',1);
        $obj = new storeProductModel();
       $data = $obj->getList($page);
       $this->getView()->assign('list',$data['list']);
       $this->getView()->assign('attr',$data['attrs']);
       $this->getView()->assign('bar',$data['pageHtml']);
    }

    /**
     * 待审核仓单
     */
    public function reviewListAction(){
        $page = safe::filterGet('page','int',1);
        $obj = new storeProductModel();
        $data = $obj->getApplyList($page);
        $this->getView()->assign('list',$data['list']);
        $this->getView()->assign('attr',$data['attrs']);
        $this->getView()->assign('bar',$data['pageHtml']);
    }

    /**
     * 待审核仓单详情
     */
    public function reviewDetailsAction(){
        $id = $this->getRequest()->getParam('id');
        $id = safe::filter($id,'int');
        if($id){
            $obj = new storeProductModel();
            $detail = $obj->getUserStoreDetail($id);

            $detail['status'] = $obj->getStatusText($detail['status']);

            $this->getView()->assign('detail',$detail);

        }
    }

    /**
     * 仓单详情
     */
    public function detailsAction(){
        $id = $this->getRequest()->getParam('id');
        $id = safe::filter($id,'int');
        if($id){
            $obj = new storeProductModel();
            $detail = $obj->getUserStoreDetail($id);

            $detail['status'] = $obj->getStatusText($detail['status']);

            $this->getView()->assign('detail',$detail);

        }
    }

    public function setStatusAction(){
        if(IS_AJAX){
            $id = safe::filterPost("id","int");
            if(!$id) $id = intval($this->_request->getParam('id'));
            $status = safe::filterPost("status","int");
            $obj = new storeProductModel();
            $res = $obj->marketCheck($id,$status);
            die(\Library\JSON::encode($res));
        }
        return false;
    }






}