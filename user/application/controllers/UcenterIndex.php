<?php
/**
 * 用户中心首页
 * User: weipinglee
 * Date: 2016/5/18 0004
 * Time: 上午 9:35
 */
class UcenterIndexController extends UcenterBaseController {



    /**
     * 个人中心首页
     */
    public function indexAction(){
        $group = new \nainai\member();

        $groupData = $group->getUserGroup($this->user_id);//会员分组数据
        $creditGap = $group->getGroupCreditGap($this->user_id);//与更高等级的分组的差值

        $this->getView()->assign('username',$this->username);

        $this->getView()->assign('group',$groupData);
        $this->getView()->assign('creditGap',$creditGap);

    }






}