<?php
/**
 * 推荐商户管理
 * Created by PhpStorm.
 * User: wangzhande
 * Date: 2016/6/2
 * Time: 11:49
 */
use \Library\json;
use \Library\safe;
class companyRecController extends Yaf\Controller_Abstract {
    public function init() {
        $this->getView()->setLayout('admin');
    }

    /**
     *推荐商户列表
     */
    public function recListAction(){
        $page=\Library\safe::filterGet('page','int');
        $recModel=new \nainai\companyRec();
        $res=$recModel->getRecList($page);
        $this->getView()->assign('recList',$res[0]);
        $this->getView()->assign('pageBar',$res[1]);
    }
    public function recEditAction(){
        if(IS_POST&&IS_AJAX){
            $data=array(
                'id'=>safe::filterPost('id','int'),
                'user_id'=>safe::filterPost('user_id','int'),
                'type'=>safe::filterPost('type','int'),
                'status'=>safe::filterPost('status','int'),
                'start_time'=>safe::filterPost('start_time'),
                'end_time'=>safe::filterPost('end_time')
            );
            $recModel=new \nainai\companyRec();
            $result=$recModel->editRec($data);
            echo json::encode($result);
            return false;
        }
        $id=\Library\safe::filterGet('id','int');
        $res=\nainai\companyRec::getRecDetail($id);
        $this->getView()->assign('recInfo',$res);

    }
}