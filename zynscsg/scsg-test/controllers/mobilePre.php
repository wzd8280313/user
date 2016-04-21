<?php

/*
预售商品接口
 *  */
class mobilePre extends IController{
    //预售商品页信息
    public function preList(){
        $m_pro=new IQuery('presell as p');
        $m_pro->join='left join goods as g on g.id=p.goods_id';
        $m_pro->where='p.is_close=0 and TIMESTAMPDIFF(second,p.yu_end_time,NOW())<0 and  g.is_del=4';
        $m_pro->fields='p.*,(unix_timestamp(p.yu_end_time)-unix_timestamp(now())) as end_timestamp,g.sell_price as price,g.img';
        $m_pro->limit=8;
        $m_pro->order='p.id desc';
        $preList=$m_pro->find();
        //获取某个商品的总分，
        foreach ($preList as $k=>$v){
         $data=  Comment_Class::get_comment_info($v['goods_id']);
         var_dump($data);
        
        }
        echo JSON::encode($preList);
       
   }
   public function getIndexSlide2(){
        $siteConfigObj = new Config("site_config");
        $site_config   = $siteConfigObj->getInfo();
        $index_slide = isset($site_config['index_slide'])? unserialize($site_config['index_slide']) :array();
        $tem=array();
        foreach($index_slide as $k=>$v){
            $index_slide[$k]['img']='http://192.168.2.114/iweb2/'.$v['img'];
            $index_slide[$k]['name']=$v['name'];
            $index_slide[$k]['url']=$v['url'];
        }
        //var_dump($index_slide);
        //var_dump($index_slide);
        echo JSON::encode($index_slide);
    }
   
    
}
 ?>