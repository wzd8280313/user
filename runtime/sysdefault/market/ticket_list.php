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
			<?php 
$search = IFilter::act(IReq::get('search'),'strict');

?>
<?php if(isset($search['name'])&&$search['name']){?>
<?php $where='name="'.$search['name'].'"'?>
<?php }else{?>
<?php $where=1?>
<?php }?>
<div class="headbar">
	<div class="position"><span>营销</span><span>></span><span>代金券管理</span><span>></span><span>代金券列表</span></div>
	<div class="operating">
		<a href="javascript:;" onclick="event_link('<?php echo IUrl::creatUrl("/market/ticket_edit");?>')"><button class="operating_btn" type="button"><span class="addition">添加代金券</span></button></a>
		<a href="javascript:void(0)" onclick="selectAll('id[]');"><button class="operating_btn" type="button"><span class="sel_all">全选</span></button></a>
		<a href="javascript:void(0)" onclick="document.forms[0].action='<?php echo IUrl::creatUrl("/market/ticket_excel");?>';delModel({msg:'是否要生成excel表格'});"><button class="operating_btn" type="button"><span class="export">生成EXCEL</span></button></a>
	</div>
	<div class="searchbar">
		<form action="<?php echo IUrl::creatUrl("/");?>" method="get" name="">
			<input type='hidden' name='controller' value='market' />
			<input type='hidden' name='action' value='ticket_list' />
			
			名称<input class="small" name="search[name]" type="text" value="" />
			<button class="btn" type="submit"  ><span class="sel">筛 选</span></button>
		</form>
	</div>
	<div class="field">
		<table class="list_table">
			<col width="40px" />
			<col width="150px" />
			<col width="80px" />
			<col width="80px" />
			<col width="80px" />
			<col />
			<thead>
				<tr>
					<th>选择</th>
					<th>名称</th>
					<th>面值</th>
					<th>数量</th>
					<th>兑换积分</th>
					<th>有效期</th>
					<th>操作</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<div class="content">
	<form method='post' action='#'>
		<table class="list_table">
			<col width="40px" />
			<col width="150px" />
			<col width="80px" />
			<col width="80px" />
			<col width="80px" />
			<col />
			<tbody>
				<?php $propObj = new IModel('prop')?>
				<?php $query = new IQuery("ticket");$query->where = "$where";$items = $query->find(); foreach($items as $key => $item){?>
				<?php $ticket_num = $this->getTicketCount($propObj,$item['id'])?>
				<tr>
					<td><input type='checkbox' name='id[]' value='<?php echo isset($item['id'])?$item['id']:"";?>' /></td>
					<td><?php echo isset($item['name'])?$item['name']:"";?></td>
					<td><?php echo isset($item['value'])?$item['value']:"";?> 元</td>
					<td><?php echo isset($ticket_num)?$ticket_num:"";?> 张</td>
					<td><?php echo ($item['point']==0) ? '不可兑换':$item['point'];?></td>
					<td><?php echo isset($item['start_time'])?$item['start_time']:"";?> ～ <?php echo isset($item['end_time'])?$item['end_time']:"";?></td>
					<td>
						<a href='<?php echo IUrl::creatUrl("/market/ticket_edit/id/".$item['id']."");?>'>
							<img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_edit.gif";?>" alt="修改" title="修改" />
						</a>

						<a href='<?php echo IUrl::creatUrl("/market/ticket_more_list/ticket_id/".$item['id']."");?>'>
							<img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_check.gif";?>" alt="查看详情" title="查看详情" />
						</a>

						<a href='javascript:create_dialog("<?php echo isset($item['id'])?$item['id']:"";?>");'>
							<img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_add.gif";?>" alt="生成实体代金券" title="生成实体优惠券" />
						</a>

						<?php if($ticket_num > 0){?>
						<a href='javascript:void(0)' onclick="delModel({msg:'是否要生成excel表格？',link:'<?php echo IUrl::creatUrl("/market/ticket_excel/id/".$item['id']."");?>'});">
							<img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_down.gif";?>" alt="生成EXCEL" title="生成EXCEL" />
						</a>
						<?php }?>

						<a href='javascript:void(0)' onclick="delModel({link:'<?php echo IUrl::creatUrl("/market/ticket_del/id/".$item['id']."");?>'});">
							<img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_del.gif";?>" alt="删除" title="删除" />
						</a>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</form>
</div>

<script type='text/javascript'>
	//创建优惠券
	function create_dialog(ticket_id)
	{
		art.dialog.prompt('请输入生成线下实体代金券数量：',function(num)
		{
			var num = parseInt(num);
			if(isNaN(num) || num <= 0)
			{
				alert('请填写正确的数量');
				return false;
			}

			var url = '<?php echo IUrl::creatUrl("/market/ticket_create/ticket_id/@ticket_id@/num/@num@");?>';
			    url = url.replace('@ticket_id@',ticket_id).replace('@num@',num);
			window.location.href = url;
		});
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
