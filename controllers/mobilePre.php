<?php 
/*
预售类
 */
class mobilePre extends IController{
	public function preList(){
		$m_pro=new IQuery('presell as p');
	        $m_pro->join='left join goods as g on g.id=p.goods_id';
	        $m_pro->where='p.is_close=0 and TIMESTAMPDIFF(second,p.yu_end_time,NOW())<0 and  g.is_del=4';
	        $m_pro->fields='p.*,(unix_timestamp(p.yu_end_time)-unix_timestamp(now())) as end_timestamp,g.sell_price as price,g.img';
	        $m_pro->limit=8;
	        $m_pro->order='p.id desc';
	        $preList=$m_pro->find();
	        if($preList){
	        		//获取评论数
		   foreach ($preList as $k=>$v){
		         $data=  Comment_Class::get_comment_info($v['goods_id']);
		         $data = Comment_Class::get_comment_info($v['goods_id']);
		         $preList[$k]['comment_num'] = $data['comment_total'] ;
                	         $preList[$k]['comment_rate'] = $data['comment_total'] ? (round($data['point_grade']['good']/$data['comment_total'],4))*100 : 0;
		        }
	        }
	        echo JSON::encode($preList);


	}
	public function preInfo()
	{
		$this->logoUrl = 'images/yulogo.png';
		$id = IFilter::act(IReq::get('id'),'int');
		
		
		$presell = new IModel('presell');
		$preData = $presell->getObj('goods_id='.$id.' and  TIMESTAMPDIFF(second,yu_end_time,NOW()) <0 ','*,unix_timestamp(yu_end_time)-UNIX_TIMESTAMP(now()) as end_time');
		
		
		if(!$id || !$preData = $presell->getObj('goods_id='.$id.' and  TIMESTAMPDIFF(second,yu_end_time,NOW()) <0 ','*,unix_timestamp(yu_end_time)-UNIX_TIMESTAMP(now()) as end_time'))
		{
			IError::show(403,"预售商品不存在");
			exit;
		}
		$money_rate = $preData['money_rate']/100;
		$goods_id = $preData['goods_id'];
		$user_id = $this->user ? $this->user['user_id'] : 0;
		user_like::set_user_history($goods_id,$user_id);
	
		//使用商品id获得商品信息
		$tb_goods = new IModel('goods');
		$goods_info = $tb_goods->getObj('id='.$goods_id." AND is_del=4");
		//
	
		//print_r($goods_info);
		if(!$goods_info)
		{
			IError::show(403,"这件预售商品不存在");
			exit;
		}
		$sell_price = $goods_info['sell_price'];
		//品牌名称
		if($goods_info['brand_id'])
		{
			$tb_brand = new IModel('brand');
			$brand_info = $tb_brand->getObj('id='.$goods_info['brand_id']);
			if($brand_info)
			{
				$goods_info['brand'] = $brand_info['name'];
			}
		}
		$commend = new IModel('commend_goods');
		$goods_info['commend'] = $commend->getFields(array('goods_id'=>$goods_id),'commend_id');
	
		//获取商品分类
		$categoryObj = new IModel('category_extend as ca,category as c');
		$categoryRow = $categoryObj->getObj('ca.goods_id = '.$goods_id.' and ca.category_id = c.id','c.id,c.name');
		$goods_info['category'] = $categoryRow ? $categoryRow['id'] : 0;
	
		//商品图片
		$tb_goods_photo = new IQuery('goods_photo_relation as g');
		$tb_goods_photo->fields = 'p.id AS photo_id,p.img ';
		$tb_goods_photo->join = 'left join goods_photo as p on p.id=g.photo_id ';
		$tb_goods_photo->where =' g.goods_id='.$goods_id;
		$goods_info['photo'] = $tb_goods_photo->find();
		foreach($goods_info['photo'] as $key => $val)
		{
			//对默认第一张图片位置进行前置
			if($val['img'] == $goods_info['img'])
			{
				$temp = $goods_info['photo'][0];
				$goods_info['photo'][0] = $val;
				$goods_info['photo'][$key] = $temp;
			}
		}
	
	
	
		//获得扩展属性
		$tb_attribute_goods = new IQuery('goods_attribute as g');
		$tb_attribute_goods->join  = 'left join attribute as a on a.id=g.attribute_id ';
		$tb_attribute_goods->fields=' a.name,g.attribute_value ';
		$tb_attribute_goods->where = "goods_id='".$goods_id."' and attribute_id!=''";
		$tb_attribute_goods->order = "g.id asc";
		$goods_info['attribute'] = $tb_attribute_goods->find();
	
			//评论条数
	        $comment = new IModel('comment');
	        $temp = $comment->query('status <> 0 and goods_id = '.$goods_id.' and pid = 0', 'count(1) as num');
	        $goods_info['comment_num'] = !!$temp ? $temp[0]['num'] : 0;
	        
	        $temp = $comment->query('status <> 0 and goods_id = '.$goods_id.' and point=5 and pid = 0 ', 'count(1) as num');
	        $goods_info['good_comment'] = !!$temp ? $temp[0]['num'] : 0;
	        
	        $temp = $comment->query('status <> 0 and goods_id = '.$goods_id.' and point < 5 and point > 1 and pid = 0', 'count(1) as num');
	        $goods_info['middle_comment'] = !!$temp ? $temp[0]['num'] : 0;
	        
	        $temp = $comment->query('status <> 0 and goods_id = '.$goods_id.' and point<2 and pid = 0', 'count(1) as num');
	        $goods_info['bad_comment'] = !!$temp ? $temp[0]['num'] : 0;
	
		//购买记录
		$tb_shop = new IQuery('order_goods as og');
		$tb_shop->join = 'left join order as o on o.id=og.order_id';
		$tb_shop->fields = 'count(*) as totalNum';
		$tb_shop->where = 'og.goods_id='.$goods_id.' and o.status = 5';
		$shop_info = $tb_shop->find();
		$goods_info['buy_num'] = 0;
		if($shop_info)
		{
			$goods_info['buy_num'] = $shop_info[0]['totalNum'];
		}
	
		$tb_refer    = new IModel('refer');
	        //咨询条数
	        $num = $tb_refer->getObj('goods_id='.$goods_id.' and pid=0','count(*) as totalNum');
	        $goods_info['refer_num'] = $num ? $num['totalNum'] : 0;
	        //咨询类型
	        $refer_type = new IModel('refer_type');
	        $dataList = $refer_type->query('is_open=1', '*', 'sort', 'ASC');
	        if($dataList)
	        {
	            foreach($dataList as $k => $v)
	            {
	                $refer_info = $tb_refer->getObj('goods_id='.$goods_id.' and pid=0 and type='.$v['id'],'count(*) as totalNum');
	                $dataList[$k]['num'] = $refer_info ? $refer_info['totalNum'] : 0;
	            }
	            $temp = $dataList[0];
	            $this->type = $temp['id'];
	        }
	        $goods_info['refer'] = $dataList;
		
	
		//获得商品的价格区间
		$tb_product = new IModel('products');
		$goods_info['maxSellPrice']   = '';
		$goods_info['minSellPrice']   = '';
	
		$product_info = $tb_product->getObj('goods_id='.$goods_id,'max(sell_price) as maxSellPrice ,min(sell_price) as minSellPrice');
		if($product_info)
		{
			$goods_info['maxSellPrice']   = $product_info['maxSellPrice'];
			$goods_info['minSellPrice']   = $product_info['minSellPrice'];
			$goods_info['maxPresellPrice']= self::getPrePrice($product_info['maxSellPrice'],$money_rate);
			$goods_info['minPresellPrice']= self::getPrePrice($product_info['minSellPrice'],$money_rate);
		}
		$goods_info['presellPrice'] = number_format(ceil($money_rate * $goods_info['sell_price']),2);
	
		//获得会员价
		$countsumInstance = new countsum();
		$group_price = $countsumInstance->getGroupPrice($goods_id,'goods');
		if($group_price !==null){
			$group_price = floatval($group_price);
			if($group_price < $goods_info['sell_price']){
				$goods_info['group_price'] = $group_price;
				$goods_info['presellPrice'] = number_format(ceil($money_rate * $goods_info['group_price']),2);
			}
		}
		
		
		//获取尾款支付时间
		if($preData['wei_type']==1){
			$preData['wei_text'] = $preData['wei_start_time'].'至'.$preData['wei_end_time'].'支付尾款';
			
		}else{
			$preData['wei_text'] = '预付款支付后'.$preData['wei_days'].'天内支付尾款';
		}
		$goods_info['preData'] = $preData;
		//获取标签
		$tb_tag = new IQuery('commend_tags as t');
		$tb_tag->join = 'left join commend_goods as go on t.id = go.commend_id';
		$tb_tag->where = 'go.goods_id = '.$goods_id;
		$tb_tag->fields = 't.name,t.img';
		$tb_tag->limit = 5;
		$goods_info['tag_data'] = $tb_tag->find();
	
	
		//获取商家信息
		if($goods_info['seller_id'])
		{
			$sellerDB = new IModel('seller');
			$goods_info['seller'] = $sellerDB->getObj('id = '.$goods_info['seller_id'],'id,true_name,email,mobile,logo_img,server_num,point,num');
		}
	
		//增加浏览次数
		$visit    = ISafe::get('visit');
		$checkStr = "#".$goods_id."#";
		if($visit && strpos($visit,$checkStr) !== false)
		{
		}
		else
		{
			$tb_goods->setData(array('visit' => 'visit + 1'));
			$tb_goods->update('id = '.$goods_id,'visit');
			$visit = $visit === null ? $checkStr : $visit.$checkStr;
			ISafe::set('visit',$visit);
		}
		user_like::add_like_cate($goods_id,$this->user['user_id']);
		
        //组合销售
        /*$combine = new IModel('combine_goods');
        $combineList = $combine->query('goods_id = '.$goods_id.' and status = 1', '*', 'sort', 'asc');
        foreach($combineList as $k => $v)
        {
            if(!$v['combine'])
            {
                unset($combineList[$k]);
                continue;
            }
            $goodsList = $tb_goods->query('id in ('.$v['combine'].") AND (is_del=0 or is_del=4)", 'id,name,combine_price,sell_price,img');
            if($goodsList)
            {
                $combineList[$k]['goodsList'] = $goodsList;
            }
            else
            {
                unset($combineList[$k]);
            }   
        }                       
        $this->combineList = $combineList; */
		//$this->setRenderData($goods_info);

		echo JSON::encode($goods_info);
		//var_dump($goods_info);
	}
	



}


?>