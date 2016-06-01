<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台管理</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/admin.css";?>" />
	<meta name="robots" content="noindex,nofollow">
	<link rel="shortcut icon" href="favicon.ico" />
	<script type="text/javascript" charset="UTF-8" src="/iweb2/runtime/_systemjs/jquery/jquery-1.11.3.min.js"></script><script type="text/javascript" charset="UTF-8" src="/iweb2/runtime/_systemjs/jquery/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iweb2/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iweb2/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/iweb2/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/iweb2/runtime/_systemjs/artdialog/artDialog.js"></script><script type="text/javascript" charset="UTF-8" src="/iweb2/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/iweb2/runtime/_systemjs/artdialog/skins/default.css" />
	<script type="text/javascript" charset="UTF-8" src="/iweb2/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iweb2/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/common.js";?>"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/admin.js";?>"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/menu.js";?>"></script>
	<script type='text/javascript'>
		//DOM加载完毕执行
		$(function(){
			//隔行换色
			$(".list_table tr:nth-child(even)").addClass('even');
			$(".list_table tr").hover(
				function () {
					$(this).addClass("sel");
				},
				function () {
					$(this).removeClass("sel");
				}
			);

			//后台菜单创建
			<?php $menu = new Menu($this->admin);?>
			var data = <?php echo $menu->submenu();?>;
			var current = '<?php echo $menu->current;?>';
			
			var url='<?php echo IUrl::creatUrl("/");?>';
			initMenu(data,current,url);
		});
	</script>
</head>
<body>
	<div class="container">
		<div id="header">
			<div class="logo">
				<a href="<?php echo IUrl::creatUrl("/system/default");?>"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/logo.png";?>" height="43" /></a>
			</div>
			<div id="menu">
				<ul name="menu">
				</ul>
			</div>
			<p><a href="<?php echo IUrl::creatUrl("/systemadmin/logout");?>">退出管理</a> <a href="<?php echo IUrl::creatUrl("/system/admin_repwd");?>">修改密码</a> <a href="<?php echo IUrl::creatUrl("/system/default");?>">后台首页</a> <a href="<?php echo IUrl::creatUrl("");?>" target='_blank'>商城首页</a> <span>您好 <label class='bold'><?php echo isset($this->admin['admin_name'])?$this->admin['admin_name']:"";?></label>，当前身份 <label class='bold'><?php echo isset($this->admin['admin_role_name'])?$this->admin['admin_role_name']:"";?></label></span></p>
		</div>
		<div id="info_bar">
			<label class="navindex"><a href="<?php echo IUrl::creatUrl("/system/navigation");?>">快速导航管理</a></label>
			<span class="nav_sec">
			<?php $adminId = $this->admin['admin_id']?>
			<?php $query = new IQuery("quick_naviga");$query->where = "admin_id = $adminId and is_del = 0";$items = $query->find(); foreach($items as $key => $item){?>
			<a href="<?php echo isset($item['url'])?$item['url']:"";?>" class="selected"><?php echo isset($item['naviga_name'])?$item['naviga_name']:"";?></a>
			<?php }?>
			</span>
		</div>

		<div id="admin_left">
			<ul class="submenu"></ul>
		</div>

		<div id="admin_right">
			<script type="text/javascript" charset="UTF-8" src="/iweb2/runtime/_systemjs/my97date/wdatepicker.js"></script>
<div class="headbar">
	<div class="position"><span>会员</span><span>></span><span>信息处理</span><span>></span><span>站内消息</span></div>
	<div class="operating">
		<a href="javascript:void(0)" onclick="sendMessage();"><button class="operating_btn" type="button"><span class="send">发信</span></button></a>
		<a href="javascript:void(0)" onclick="selectAll('check[]')"><button class="operating_btn" type="button"><span class="sel_all">全选</span></button></a>
		<a href="javascript:void(0)" onclick="delModel({form:'message_list',msg:'确定要删除选中的记录吗？'})"><button class="operating_btn" type="button"><span class="delete">批量删除</span></button></a>
	</div>
	<form name="filter_form" id="filter_form" method="get" action="<?php echo IUrl::creatUrl("/");?>">
		<input type='hidden' name='controller' value='comment' />
		<input type='hidden' name='action' value='message_list' />
		<div class="searchbar">
			开始时间：<input class="small" type="text" name="beginTime" onfocus="WdatePicker()" value="<?php echo isset($beginTime)?$beginTime:"";?>" />
			截止时间：<input class="small" type="text" name="endTime" onfocus="WdatePicker()" value="<?php echo isset($endTime)?$endTime:"";?>" />
			<button class="btn" type="submit"><span class="sel">筛 选</span></button>
		</div>
	</form>
	<div class="field">
		<table class="list_table">
			<col width="40px" />
			<col width="250px" />
			<col width="150px" />
			<col  />
			<thead>
				<tr>
					<th>选择</th>
					<th>标题</th>
					<th>时间</th>
					<th>操作</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<form action="<?php echo IUrl::creatUrl("/comment/message_del");?>" method="post" name="message_list" onsubmit="return checkboxCheck('check[]','尚未选中任何记录！')">
<div class="content">
	<table id="list_table" class="list_table">
		<col width="40px" />
		<col width="250px" />
		<col width="150px" />
		<col  />
		<tbody>
			<?php $page=(isset($_GET['page'])&&(intval($_GET['page'])>0))?intval($_GET['page']):1;?>
			<?php $query = new IQuery("message");$query->page = "$page";$query->where = "$this->where";$items = $query->find(); foreach($items as $key => $item){?>
			<tr>
				<td><input name="check[]" type="checkbox" value="<?php echo isset($item['id'])?$item['id']:"";?>" /></td>
				<td><?php echo isset($item['title'])?$item['title']:"";?></td>
				<td><?php echo isset($item['time'])?$item['time']:"";?></td>
				<td>
					<a href="<?php echo IUrl::creatUrl("/comment/message_show/id/".$item['id']."");?>"><img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_check.gif";?>" title="查看" /></a>
					<a href="javascript:void(0)" onclick="delModel({link:'<?php echo IUrl::creatUrl("/comment/message_del/check/".$item['id']."");?>'})"><img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_del.gif";?>" alt="删除" /></a>
				</td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>
<?php echo $query->getPageBar();?>
</form>

<script language="javascript">
//发送短消息
function sendMessage()
{
	art.dialog.open('<?php echo IUrl::creatUrl("/comment/message_send");?>',{
		'id':'sendWindow',
		'title':'站内消息',
		'width':'790px',
		'ok':function(iframeWin, topWin)
		{
			var iframeObj = $(iframeWin.document);
			var toUser    = art.dialog.data('toUser');
			if(toUser)
			{
				iframeObj.find('[name="toUser"]').val(toUser);
			}
			iframeWin.kindEditorObj.sync();
			iframeObj.find('form').submit();
	    	return false;
		}
	});
}

//发送短消息后回调
function startMessageCallback(isSuccess)
{
	if(isSuccess == 1)
	{
		tips('发送短信成功');
		setTimeout(function(){
			window.location.reload();
		},1200);
	}
	else
	{
		alert('请填写标题和内容');
	}
	art.dialog({'id':'sendWindow'}).close();
}

//筛选用户回调函数
function searchUserCallback(userIds)
{
	var defaultText = '默认为所有用户';
	if(userIds)
	{
		defaultText = '已选择部分用户';
	}
	art.dialog.data('toUser',userIds);
	art.dialog({'id':'userCondition'}).close();
}
</script>

		</div>
	</div>

<script type='text/javascript'>
	//DOM加载结束
$(function(){
	<?php if(isset($this->search)&&$this->search){?>
	<?php $search=$this->search?>
	<?php }?>
	<?php if(isset($search)&&$search){?>
	var searchData = <?php echo JSON::encode($search);?>;
	for(var index in searchData)
	{
		$('[name="search['+index+']"]').val(searchData[index]);
	}
	<?php }?>

});
</script>
</body>
</html>
