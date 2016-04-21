<?php
/**
 * 与评论相关的
 *
 * @author walu
 * @packge 
 */

class Comment_Class
{
	/**
	 * 检测用户是否能够评论
	 *
	 * @param int $comment_id 评论id
	 * @param int $user_id 用户id
	 * @return array() array(成功or失败,数据)
	 */
	public static function can_comment($comment_id,$user_id)
	{
		$comment_id = intval($comment_id);
		$user_id = intval($user_id);

		$tb_comment = new IQuery("comment as c");
		$tb_comment->join = 'left join order_goods as og on c.order_id=og.order_id and c.goods_id=og.goods_id';
		$tb_comment->where = 'c.id='.$comment_id.' AND c.user_id='.$user_id;
		$tb_comment->fields = 'c.*';
		$comment = $tb_comment->getObj();
		
		if(!$comment)
		{
			return array(-1,"没有这条数据");
		}

		if($comment['status'] == 2)
		{
			return array(-2,$comment);
		}

		$time=strtotime($comment['time']);
		if($time < 3600*24*30*6 )
		{
			return array(-3,$comment);
		}
		return array(1,$comment);
	}

	/**
	 * 获取某个商品的有关分数的评论数据,根据comment表里面的评价分数做分析
	 *
	 * 获取好评、中评、差评数量及平均分
	 * 返回的值里包含以下几个计算出来的索引
	 *	<ul>
	 *		<li>point_total，总分</li>
	 *		<li>comment_total，评论总数</li>
	 *		<li>average_point，平均分</li>
	 *	</ul>
	 *
	 * @param int $id  goods_id
	 * @return array()
	 */
	public static function get_comment_info($id)
	{
		$data  = array();
		$query = new IQuery("comment");
		$query->fields = "COUNT(*) AS num,point";
		$query->where  = "goods_id = {$id} AND status<>0 AND pid = 0";
		$query->group  = "point";

		$data['point_grade'] = array('none'=>0,'good'=>0,'middle'=>0,'bad'=>0);
		$config = array(0=>'bad',1=>'bad',2=>'middle',3=>'middle',4=>'middle',5=>'good');
		$data['point_total'] = 0;            
		foreach( $query->find() AS $key => $value )
		{
			if($value['point']>=0 && $value['point']<=5)
			{
				$data['point_total']+=$value['point']*$value['num'];
				$data['point_grade'][$config[$value['point']] ] += $value['num'];
			}
		}
		$data['comment_total']=array_sum($data['point_grade']);
		$data['average_point']=0;
		if($data['point_total']>0)
		{
			$data['average_point'] = round($data['point_total'] / $data['comment_total'],1);
		}
		return $data;
	}
	/**
	 * 获取评论数据
	 * 
	 */
	public static function get_comment_byid($id,$type,$pageSize=3,$controller=null){
		
		$type_config = array('bad'=>'1,0','middle'=>'2,3,4','good'=>'5');
		
		if(!isset($type_config[$type]))
		{
			$type = null;
		}
		else
		{
			$type=$type_config[$type];
		}
		
		$data['comment_list']=array();
		
		$query = new IQuery("comment AS a");
		$query->fields = "a.*,b.username,b.email,b.phone,b.head_ico";
		$query->join = "left join user AS b ON a.user_id=b.id";
		$query->where = " a.goods_id = {$id} AND a.pid=0 ";
		
		if($type!==null)
			$query->where = " a.goods_id={$id} AND a.status<>0  AND a.point IN ($type) AND a.pid=0 ";
		else
			$query->where = "a.goods_id={$id} AND a.status<>0 AND a.pid=0";
		
		$query->order    = "a.id DESC";
		$query->page     = IReq::get('page') ? intval(IReq::get('page')):1;
		$query->pagesize = $pageSize;
		
		$data['comment_list']= $query->find();
		if($query->page==0){return 0;}
		if($controller){
			$controller->comment_query = $query;
		}                                
        $photo = new IModel('comment_photo');
		if($data['comment_list'])
		{
            $comment = new IModel('comment');
			$user_ids = array();
			foreach($data['comment_list'] as $key=>$value)
			{
				$user_ids[]=$value['user_id'];
				if($value['username']){
					$data['comment_list'][$key]['user_show'] = $value['username'];
				}else if($value['email']){
					$data['comment_list'][$key]['user_show'] = user_like::getSecretEmail($value['email']);
				}else 
				{
                      $data['comment_list'][$key]['user_show'] = user_like::getSecretPhone($value['phone']);
                }
                $data['comment_list'][$key]['photo'] = $photo->query('comment_id='.$value['id'], 'img', 'sort', 'desc');
                if(!!$value['recontents'])
                {
                    $temp = $comment->getObj("id='{$value['recontents']}'");
                    if($temp)
                    {
                        $data['comment_list'][$key]['replySelf'] = $temp;
                        $data['comment_list'][$key]['replySelfPhoto'] = $photo->query('comment_id='.$temp['id'], 'img', 'sort', 'desc');
                    }
                }
                
			}
			$user_ids = implode(",", array_unique( $user_ids ) );
			$query = new IQuery("member AS a");
			$query->join = "left join user_group AS b ON a.user_id IN ({$user_ids}) AND a.group_id=b.id";
			$query->fields="a.user_id,b.group_name";
			$user_info = $query->find();
			
			$user_info = Util::array_rekey($user_info,'user_id');
		
			foreach($data['comment_list'] as $key=>$value)
			{
				$data['comment_list'][$key]['user_group_name']=isset($user_info[$value['user_id']]['group_name']) ? $user_info[$value['user_id']]['group_name'] : '';
			}
		}                                
		return array_merge($data, self::get_comment_info($id) );
	}
}