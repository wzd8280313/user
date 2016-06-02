<?php
/**
 * 会员操作类
 * author: weipinglee
 * Date: 2016/5/3 0003
 * Time: 下午 5:17
 */
namespace nainai;
use \Library\M;
class member{

    protected static $userType = array(
        0=>'个人',
        1=>'企业'
    );



    /**
     * 获取会员类型
     * @param $type
     * @return string
     */
    public static function getType($type){
        return isset(self::$userType[$type]) ? self::$userType[$type] : '未知';
    }

    //获取企业所有性质
    public function getComNature(){
        return $compNature = array(
            1=>'国有企业',
            2=>'私人企业'
        );
    }

    //获取企业联系人职务
    public function getComDuty(){
        return array(
            1=>'负责人',
            2=>'高级管理',
            3=>'员工'
        );
    }

    /**
     * 获取所有企业类型，以后台商品大类算
     */
    public function getComType(){
        $product = new \nainai\offer\product();
        $cate = $product->getTopCate();
        $type = array();
        foreach($cate as $key=>$v){
            $type[$key]['id'] = $cate[$key]['id'];
            $type[$key]['name'] = $cate[$key]['name'];
        }
        return $type;
    }


    /**
     * 获取会员等级
     * @param int $user_id 会员id
     */
    public  function getUserGroup($user_id){
        $userObj = new M('user');
        $credit = $userObj->where(array('id'=>$user_id))->getField('credit');
        if($credit!==false){
            $group = $userObj->table('user_group')->where('credit <=:credit')->bind(array('credit'=>$credit))->fields('group_name,icon,caution_fee,free_fee,depute_fee')->order('credit DESC')->getObj();
           $group['icon'] = \Library\thumb::get($group['icon'],25,25);
            return $group;
        }
        else
            return false;
    }

    /**
     * 获取即将获取的会员组信誉值和当前信誉值得差值
     */
    public function getGroupCreditGap($user_id){
        $userObj = new M('user');
        $credit = $userObj->where(array('id'=>$user_id))->getField('credit');
        if($credit!==false){
            $group = $userObj->table('user_group')->where('credit >:credit')->bind(array('credit'=>$credit))->fields('credit')->order('credit ASC')->getObj();
           if(empty($group)){//已是最高级
               return 0;
           }
            else
            return $group['credit']-$credit;
        }
        else
            return 0;
    }

    /**
     * 获取所有代理商
     */
    public function getAgentList(){
        $agent = new M('agent');
        return $agent->where(array('status'=>1))->fields('id,company_name')->select();
    }


}