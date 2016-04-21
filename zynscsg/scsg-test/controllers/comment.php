<?php
/**
 * @class Comment
 * @brief 评论模块
 * @note  后台
 */
class Comment extends IController
{
	public $checkRight  = 'all';
    public $layout='admin';
	private $data = array();

	function init()
	{
		IInterceptor::reg('CheckRights@onCreateAction');
	}

	function suggestion_list()
	{
		$where = ' 1 ';
		//筛选
        $replyStatus = IReq::get('replyStatus');
		$username = IFilter::act(IReq::get('username'));
		$beginTime = IFilter::act(IReq::get('beginTime'));
		$endTime = IFilter::act(IReq::get('endTime'));
		$this->data['username'] = $username;
		$this->data['beginTime'] = $beginTime;
		$this->data['endTime'] = $endTime;
		if($username)
		{
			$where .= ' and b.username like "%'.$username.'%"';
		}
		if($beginTime)
		{
			$where .= ' and a.time > "'.$beginTime.'"';
		}
		if($endTime)
		{
			$where .= ' and a.time < "'.$endTime.'"';
		}
        if($replyStatus)
        {
            $where .= ' and a.re_time IS NULL';
        }
        $this->replyStatus = $replyStatus;
		$this->where = $where;
		$this->setRenderData($this->data);

		$this->redirect("suggestion_list",false);
	}

	/**
	 * @brief 显示建议信息
	 */
	function suggestion_edit()
	{
		$id = intval(IReq::get('id'));
		if(!$id)
		{
			$this->comment_list();
			return false;
		}
		$query = new IQuery("suggestion as a");
		$query->join = "left join user AS b ON a.user_id=b.id";
		$query->where = "a.id={$id}";
		$query->fields = "a.*,b.username";
		$items = $query->find();

		if(is_array($items) && $items)
		{
			$this->suggestion = $items[0];
			$this->redirect('suggestion_edit');
		}
		else
		{
			$this->suggestion_list();
		}
	}

	/**
	 * @brief 回复建议
	 */
	function suggestion_edit_act()
	{
		$id = intval(IReq::get('id','post'));
		$re_content = IFilter::act( IReq::get('re_content','post') ,'string');
		$tb = new IModel("suggestion");
		$data = array('admin_id'=>$this->admin['admin_id'],'re_content'=>$re_content,'re_time'=>date('Y-m-d H:i:s'));
		$tb->setData($data);
		$tb->update("id={$id}");
		$this->redirect("/comment/suggestion_list");
	}


	/**
	 * @brief 删除要删除的建议
	 */
	function suggestion_del()
	{
		$suggestion_ids = IReq::get('check');
		$suggestion_ids = is_array($suggestion_ids) ? $suggestion_ids : array($suggestion_ids);
		if($suggestion_ids)
		{
			$suggestion_ids = IFilter::act($suggestion_ids,'int');

			$ids = implode(',',$suggestion_ids);
			if($ids)
			{
				$tb_suggestion = new IModel('suggestion');
				$where = "id in (".$ids.")";
				$tb_suggestion->del($where);
			}
		}
		$this->redirect('suggestion_list');
	}

	/**
	 * @brief 评论信息列表
	 */
	function comment_list()
	{                                                                
		$search = IFilter::act(IReq::get('search'),'strict');
        $plat = IReq::get('plat');          
        $replyStatus = IReq::get('replyStatus');
        if($replyStatus)
        {
            $search['c.recomment_time'] = '=0';
        }      
		$where  = ' status<>0 and pid = 0';
        if($plat == 'plat')
        {
            $where .= ' and sellerid=0';
        }
        elseif($plat == 'seller')
        {
            $where .= ' and sellerid <> 0';
        }
		if($search && $appendString = Util::search($search))
		{
			$where .= " and ".$appendString;
		}                                          
        $search['plat'] = $plat;               
		$this->data['where'] = $where;
		$this->data['search']= $search;
		$this->setRenderData($this->data);
		$this->redirect('comment_list',false);
	}   
    
    //平台评论
    function comment_list_plat()
    {
        $this->redirect('comment_list/plat/plat/replyStatus/'.IReq::get('replyStatus'));
    }
    
    //商户评论
    function comment_list_seller()
    {
        $this->redirect('comment_list/plat/seller/replyStatus/'.IReq::get('replyStatus'));
    }

	/**
	 * @brief 显示评论信息
	 */
	function comment_edit()
	{
		$cid = IFilter::act(IReq::get('cid'),'int');

		if(!$cid)
		{
			$this->comment_list();
			return false;
		}                       
        
        $comment = new IQuery('comment as c');
        $comment->join = 'left join goods as goods on c.goods_id = goods.id left join user as u on c.user_id = u.id';
        $comment->where = "c.id = {$cid}";   
        $comment->fields = 'u.id as uid,u.username,u.head_ico,c.*,goods.name';                                        
        $commentInfo = $comment->find();
        
        //查询评论图片
        $photo = new IModel('comment_photo');
        $commentInfo[0]['photo'] = $photo->query('comment_id='.$cid, 'img', 'sort', 'desc');
        
        //追评 
        $comment_DB = new IModel('comment');
        $temp = $comment_DB->getObj("id='{$commentInfo[0]['recontents']}'");        
        if($temp)
        {
            $commentInfo[0]['replySelf'] = $temp;
            $commentInfo[0]['replySelfPhoto'] = $photo->query('comment_id='.$temp['id'], 'img', 'sort', 'desc');
        }                               
		$query = new IQuery("comment as c");
		$query->join = "left join user as u on c.user_id = u.id";
		$query->fields = "c.*,u.username";
		$query->where = "c.p_id LIKE '%,{$cid},%'";
		$commentList = $query->find();        
        foreach($commentList as $key => $val)
        {
            if($val['user_id'] == '-1')
            {
                $seller_name = API::run('getSellerInfo',$val['sellerid'],'true_name');              
                $commentList[$key]['username'] = isset($seller_name['true_name']) ? $seller_name['true_name'] : '山城速购';
            }                          
            
            if(!$commentList[$key]['username'])
            {
                $commentList[$key]['username'] = '游客';
            }                                                                                                                                                
        }                        
        $this->comment = $commentInfo[0];                         
        $this->commentList = $commentList;
		$this->redirect('comment_edit');
	}

	/**
	 * @brief 删除要删除的评论
	 */
	function comment_del()
	{
		$comment_ids = IReq::get('check');
		$comment_ids = is_array($comment_ids) ? $comment_ids : array($comment_ids); 
		if($comment_ids)
		{
			$comment_ids =  IFilter::act($comment_ids,'int');

			$ids = implode(',',$comment_ids);
			if($ids)
			{
				$tb_comment = new IModel('comment');
				$where = "id in (".$ids.")";
				$tb_comment->del($where);
			}
		}
		$this->redirect('comment_list');
	}

	/**
	 * @brief 回复评论
	 */
	function comment_update()
	{
		$id = IFilter::act(IReq::get('id'),'int');
		$recontent = IFilter::act(IReq::get('recontents'), 'text');  
        if(!trim($recontent, ' '))
        {   
            $message = array('status' => 0, 'msg' => '回复不能为空');            
            echo JSON::encode($message);exit;
        }
        
        $comment = new IModel('comment');
        $data = $comment->getObj('id='.$id);
        if(!$data)
        {
            $message = array('status' => 0, 'msg' => '系统错误');
            echo JSON::encode($message);exit;
        }
        unset($data['id']);
        $data['pid'] = $id;
        $data['p_id'] = $data['p_id'].$id.',';
        $data['contents'] = $recontent;
        
        $data['status'] = 1;
        $data['user_id'] = -1;
        $data['point'] = 0;
        $data['sellerid'] = 0;
        $data['comment_time'] = ITime::getDateTime();

        $comment->setData($data);
        $res = $comment->add(); 
        if($res)
        {
            $comment->setData(array('recomment_time'=>ITime::getDateTime('Y-m-d')));
            $comment->update('id='.$id);
            $this->redirect('comment_list');
        }
	}

	/**
	 * @brief 讨论信息列表
	 */
	function discussion_list()
	{
		$search = IFilter::act(IReq::get('search'),'strict');
		$keywords = IFilter::act(IReq::get('keywords'),'text');
		$where = ' 1 ';
		if($search && $keywords)
		{
			$where .= " and $search like '%{$keywords}%' ";
		}
		$this->data['search'] = $search;
		$this->data['keywords'] = $keywords;
		//筛选
		$username = IFilter::act(IReq::get('username'));
		$goodsname = IFilter::act(IReq::get('goodsname'));
		$beginTime = IFilter::act(IReq::get('beginTime'));
        $endTime = IFilter::act(IReq::get('endTime'));
		$plat = IFilter::act(IReq::get('plat'));
		$this->data['username'] = $username;
		$this->data['goodsname'] = $goodsname;
		$this->data['beginTime'] = $beginTime;
        $this->data['endTime'] = $endTime;
		$this->data['plat'] = $plat;
		if($username)
		{
			$where .= ' and u.username like "%'.$username.'%"';
		}
		if($goodsname)
		{
			$where .= ' and goods.name like "%'.$goodsname.'%"';
		}
		if($beginTime)
		{
			$where .= ' and d.time > "'.$beginTime.'"';
		}
		if($endTime)
		{
			$where .= ' and d.time < "'.$endTime.'"';
		}
        if($plat == 'plat')
        {
            $where .= ' and goods.seller_id = 0';
        }
        elseif($plat == 'seller')
        {
            $where .= ' and goods.seller_id <> 0';
        }
		$this->data['where'] = $where;
		$this->setRenderData($this->data);
		$this->redirect('discussion_list',false);
	}
    
    //平台讨论
    function discussion_list_plat()
    {
        $this->redirect('discussion_list/plat/plat');
    }
    
    //商户讨论
    function discussion_list_seller()
    {
        $this->redirect('discussion_list/plat/seller');
    }

	/**
	 * @brief 显示讨论信息
	 */
	function discussion_edit()
	{
		$did = intval(IReq::get('did'));
		if(!$did)
		{
			$this->discussion_list();
			return false;
		}
		$query = new IQuery("discussion as d");
		$query->join = "right join goods as goods on d.goods_id = goods.id left join user as u on d.user_id = u.id";
		$query->fields = "d.id,d.time,d.contents,u.id as userid,u.username,goods.id as goods_id,goods.name as goods_name";
		$query->where = "d.id=".$did;
		$items = $query->find();

		if($items)
		{
			$this->discussion = $items[0];
			$this->redirect('discussion_edit');
		}
		else
		{
			$this->discussion_list();
			$msg = '没有找到相关记录！';
			Util::showMessage($msg);
		}
	}

	/**
	 * @brief 删除讨论信息
	 */
	function discussion_del()
	{
		$discussion_ids = IReq::get('check');
		$discussion_ids = is_array($discussion_ids) ? $discussion_ids : array($discussion_ids);
		if($discussion_ids)
		{
			$ids = implode(',',$discussion_ids);
			if($ids)
			{
				$tb_discussion = new IModel('discussion');
				$where = "id in (".$ids.")";
				$tb_discussion->del($where);
			}
		}
		$this->discussion_list();
	}

	/**
	 * @brief 咨询信息列表
	 */
	function refer_list()
	{
		$search   = IFilter::act(IReq::get('search'),'strict');
		$keywords = IFilter::act(IReq::get('keywords'),'text');
        $replyStatus = IReq::get('replyStatus');
		/*$status   = IFilter::act(IReq::get('status'),'int');*/
		$where = ' pid=0 ';
		if($search && $keywords)
		{
			$where .= " and $search like '%{$keywords}%' ";
		}
		$this->data['search'] = $search;
		$this->data['keywords'] = $keywords;
		//筛选
		$username = IFilter::act(IReq::get('username'));
		$goodsname = IFilter::act(IReq::get('goodsname'));
		$beginTime = IFilter::act(IReq::get('beginTime'));
        $endTime = IFilter::act(IReq::get('endTime'));
		$plat = IFilter::act(IReq::get('plat'));
		$this->data['username'] = $username;
		$this->data['goodsname'] = $goodsname;
		$this->data['beginTime'] = $beginTime;
        $this->data['endTime'] = $endTime;
        $this->data['plat'] = $plat;
		$this->data['replyStatus'] = $replyStatus;
		if($username)
		{
			$where .= ' and u.username like "%'.$username.'%"';
		}
		if($goodsname)
		{
			$where .= ' and goods.name like "%'.$goodsname.'%"';
		}
		if($beginTime)
		{
			$where .= ' and r.time > "'.$beginTime.'"';
		}
		if($endTime)
		{
			$where .= ' and r.time < "'.$endTime.'"';
		}
        if($replyStatus)
        {
            $where .= ' and r.status = 0';
        }
        if($plat == 'plat')
        {
            $where .= ' and r.seller_id = 0';
        }
        elseif($plat == 'seller')
        {
            $where .= ' and r.seller_id <> 0';
        }
		/*if($status=='0')
		{
			$where .= ' and r.status = 0';
		}  */                         
		$this->data['where'] = $where;
		$this->setRenderData($this->data);
		$this->redirect('refer_list',false);
	}
    
    //平台咨询
    public function refer_list_plat()
    {
        $this->redirect('refer_list/plat/plat/replyStatus/'.IReq::get('replyStatus'));
    }
    
    //商户咨询
    public function refer_list_seller()
    {
        $this->redirect('refer_list/plat/seller/replyStatus/'.IReq::get('replyStatus'));
    }
    
    //咨询详情
    public function refer_edit()
    {
        $id = IFilter::act(IReq::get('id'), 'int');
        if(!$id)
        {
            $this->refer_list();
            return false;
        }
        $refer = new IQuery('refer as r');
        $refer->join = 'left join user as u on r.user_id = u.id';
        $refer->where = "r.id = {$id}";   
        $refer->fields = 'u.id as uid,u.username,u.head_ico,r.*';                                        
        $reply = $refer->find();
        
        $referDB = new IQuery('refer as r');
        $referDB->join = 'left join user as u on r.user_id = u.id';
        $referDB->where = "r.p_id LIKE '%,{$id},%'";
        $referDB->order = 'r.p_id asc';
        $referDB->fields = 'u.id as uid,u.username,u.head_ico,r.*';                                        
        $replyList = $referDB->find();
        foreach($replyList as $key => $val)
        {
            if($val['user_id'] == '-1')
            {
                $seller_name = API::run('getSellerInfo',$val['seller_id'],'true_name');              
                $replyList[$key]['username'] = isset($seller_name['true_name']) ? $seller_name['true_name'] : '山城速购';
            }                          
            
            if(!$replyList[$key]['username'])
            {
                $replyList[$key]['username'] = '游客';
            }                                                    
        }                        
        $this->reply = $reply[0];                         
        $this->replyList = $replyList;                            
        $this->redirect('refer_edit',false);
    }

	/**
	 * @brief 删除咨询信息
	 */
	function refer_del()
	{
		$refer_ids = IReq::get('check');
		$refer_ids = is_array($refer_ids) ? $refer_ids : array($refer_ids);
		if($refer_ids)
		{
			$refer_ids = IFilter::act($refer_ids,'int');
			$ids = implode(',',$refer_ids);
			if($ids)
			{
				$tb_refer = new IModel('refer');
				$where = "id in (".$ids.")";
				$tb_refer->del($where);
			}
		}
		$this->redirect('refer_list');
	}
	/**
	 * @brief 回复咨询信息
	 */
	function refer_reply()
	{
        $rid     = IFilter::act(IReq::get('refer_id'),'int');
        $content = IFilter::act(IReq::get('content'),'text');   
        if(!trim($content, ' '))
        {
            $message = array('status' => 0, 'msg' => '回复不能为空');
            echo JSON::encode($message);exit;
        }
        
        $refer = new IModel('refer');
        $data = $refer->getObj('id='.$rid);
        if(!$data)
        {
            $message = array('status' => 0, 'msg' => '系统错误');
            echo JSON::encode($message);exit;
        }
        $admin_id = $this->admin['admin_id'];//管理员id
        unset($data['id']);
        $data['question'] = $content;
        $data['pid'] = $rid;
        $data['admin_id'] = $admin_id;
        $data['p_id'] = $data['p_id'].$rid.',';
        $data['status'] = 1;
        $data['user_id'] = -1;
        $data['seller_id'] = 0;
        $data['time'] = ITime::getDateTime();

        $refer->setData($data);
        $res = $refer->add(); 
        if($res)
        {  
            $refer->setData(array('reply_time'=>ITime::getDateTime(), 'status'=>1));
            $refer->update('id='.$rid, array('id'));
            $this->redirect('refer_list');
        }       
		
	}
	/**
	 * 添加、编辑咨询类型
	 */
	public function refer_type_edit(){
		$refer_type_id = IFilter::act(IReq::get('id'),'int');
		if($refer_type_id)
		{
			$refer_type_obj = new IModel('refer_type');
			$this->referTypeRow = $refer_type_obj->getObj('id = '.$refer_type_id);
		}
		$this->redirect('refer_type_edit');
	} 
	/**
	 * @添加咨询类型
	 */
	function refer_type_act(){
		$typeId = IFilter::act(IReq::get('id'),'int');
		$name = IFilter::act(IReq::get('name'));
		$is_open = IFilter::act(IReq::get('is_open'));
		$sort = IFilter::act(IReq::get('sort'),'int');
		$description = IFilter::act(IReq::get('description'));
		if(!$name)
		{
			$this->redirect('refer_type_list');
			exit;
		}
		
		$refer_type = new IModel('refer_type');
		$typeInfo = array(
					'id'=>$typeId,
					'name'=>$name,
					'is_open'=>$is_open,
					'sort'=>$sort,
					'description'=>$description
		);
		
		$refer_type->setData($typeInfo);
		if($typeId){
			$refer_type->update('id='.$typeId);
		}else{
			$refer_type->add();
		}
		$this->redirect('refer_type_list');
		
	}
	/**
	 * 咨询类型列表
	 */
	public function refer_type_list(){
		$refer_type = new IModel('refer_type');
		$this->typeData = $refer_type->query(false,'*','sort');
		$this->redirect('refer_type_list');
	}
	/**
	 * 咨询类型删除
	 */
	public function refer_type_del(){
		$id = IFilter::act(IReq::get('id'),'int');
		$idstr = is_array($id) ? implode(',',$id) : $id;
		$refer_type = new IModel('refer_type');
		$refer_type->del(' id in('.$idstr.')');
		$this->redirect('refer_type_list');
	}
    
    /**
     * @brief 短信列表
     */
    function short_message_list()
    {
        $where = ' 1 and status=1 and type=2';
        //筛选、
        $beginTime = IFilter::act(IReq::get('beginTime'));
        $endTime = IFilter::act(IReq::get('endTime'));
        $this->data['beginTime'] = $beginTime;
        $this->data['endTime'] = $endTime;
        if($beginTime)
        {
            $where .= ' and time > "'.$beginTime.'"';
        }
        if($endTime)
        {
            $where .= ' and time < "'.$endTime.'"';
        }
        
        $this->where = $where;
        $this->setRenderData($this->data);
        $tb_user_group = new IModel('user_group');
        $data_group = $tb_user_group->query();
        $data_group = is_array($data_group) ? $data_group : array();
        $group      = array();
        foreach($data_group as $value)
        {
            $group[$value['id']] = $value['group_name'];
        }
        $this->data['group'] = $group;

        $this->setRenderData($this->data);
        $this->redirect('short_message_list');
    }
    
	/**
	 * @brief 站内消息列表
	 */
	function message_list()
	{
		$where = ' 1 and status=1 and type=1';
		//筛选、
		$beginTime = IFilter::act(IReq::get('beginTime'));
		$endTime = IFilter::act(IReq::get('endTime'));
		$this->data['beginTime'] = $beginTime;
		$this->data['endTime'] = $endTime;
		if($beginTime)
		{
			$where .= ' and time > "'.$beginTime.'"';
		}
		if($endTime)
		{
			$where .= ' and time < "'.$endTime.'"';
		}
		
		$this->where = $where;
		$this->setRenderData($this->data);
		$tb_user_group = new IModel('user_group');
		$data_group = $tb_user_group->query();
		$data_group = is_array($data_group) ? $data_group : array();
		$group      = array();
		foreach($data_group as $value)
		{
			$group[$value['id']] = $value['group_name'];
		}
		$this->data['group'] = $group;

		$this->setRenderData($this->data);
		$this->redirect('message_list');
	}

	/**
	 * @brief 删除咨询信息
	 */
	function message_del()
	{
		$refer_ids = IReq::get('check');
		$refer_ids = is_array($refer_ids) ? $refer_ids : array($refer_ids);
        $type = IReq::get('type');
		if($refer_ids)
		{
			$ids = implode(',',$refer_ids);
			if($ids)
			{
				$tb_refer = new IModel('message');
                $tb_refer->setData(array('status'=>0));
				$where = "id in (".$ids.")";
				$tb_refer->update($where, array('status'));
			}
		}                    
        if($type == 2)
        {
            $this->short_message_list(); 
        }
        else
        {
            $this->message_list();
        }  
	}

	/**
	 * 发送消息
	 */
	function message_send()
	{
		$this->layout = '';
		$this->redirect('message_send');
	}   
    
    /**
     * 发送短信
     */
    function short_message_send()
    {
        $this->layout = '';
        $this->redirect('short_message_send');
    }

	/**
	 * @brief 发送信件
	 */
	function start_message()
	{
		$toUser  = IFilter::act(IReq::get('toUser'));
		$title   = IFilter::act(IReq::get('title'));
		$content = IFilter::act(IReq::get('content'),'text');

		if(!$title || !$content)
		{
			die('<script type="text/javascript">parent.startMessageCallback(0);</script>');
		}

		Mess::sendToUser($toUser,array('title' => $title,'content' => $content));
		die('<script type="text/javascript">parent.startMessageCallback(1);</script>');
	}
    
    /**
     * @brief 发送短信
     */
    function send_short_message()
    {
        $toUser  = IFilter::act(IReq::get('toUser'));  
        $content = IFilter::act(IReq::get('content'),'text');           
        if(!$content)
        {
            die('<script type="text/javascript">parent.startMessageCallback(0);</script>');
        }
        Mess::sendShortMessageToUser($toUser,$content);             
        die('<script type="text/javascript">parent.startMessageCallback(1);</script>');
    }
}