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
			<div class="headbar">
	<div class="position"><span>商品</span><span>></span><span>标签管理</span><span>></span><span>标签列表</span></div>
	<div class="operating">
		<a href="javascript:;"><button class="operating_btn" type="button" onclick="window.location='<?php echo IUrl::creatUrl("/brand/tags_edit");?>'"><span class="addition">添加标签</span></button></a>
	</div>
	<div class="searchbar">
		<form action="<?php echo IUrl::creatUrl("/");?>" method="get" name="tags_list">
			<input type='hidden' name='controller' value='brand' />
			<input type='hidden' name='action' value='tags_list' />
			<select name="search[show_index]" class="auto">
				<option value="-1">是否在首页显示</option>
				<option value="0">否</option>
				<option value="1">是</option>
			</select>

			<button class="btn" type="submit"  ><span class="sel">筛 选</span></button>
		</form>
	</div>
	<div class="field">
		<table class="list_table">
			<col width="100px" />
			<col width="150px" />
			<col width="150px" />
			<col width="150px" />
			<col />
			
			<col width="150px" />
			<thead>
				<tr>
					<th>排序</th>
					<th>标签名称</th>
					<th>标签图片</th>
					<th>是否关闭</th>
					<th>是否在首页显示</th>
					<th>操作</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div class="content">
	<table id="list_table" class="list_table">
		<col width="100px" />
		<col width="150px" />
		<col width="150px" />
		<col width="150px" />
		<col />
		<col width="150px" />
		<tbody>
			
			<?php foreach($this->tags as $key => $item){?>
			<tr>
				<td><input class="tiny" id="sort<?php echo isset($item['id'])?$item['id']:"";?>" type="text" onblur="toSort(<?php echo isset($item['id'])?$item['id']:"";?>);" value="<?php echo isset($item['sort'])?$item['sort']:"";?>" pattern='int' /></td>
				<td><?php echo isset($item['name'])?$item['name']:"";?></td>
				<td>
					<img height='20px' src='<?php echo IUrl::creatUrl("")."".$item['img']."";?>' />
				</td>
				<td>
					<?php if($item['is_close']==0){?>开启<?php }else{?>关闭<?php }?>
				</td>
				<td>
					<?php if($item['show_index']==1){?>是<?php }else{?>否<?php }?>
				</td>
				<td><a href="<?php echo IUrl::creatUrl("/brand/tags_edit/id/".$item['id']."");?>"><img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_edit.gif";?>" alt="修改" /></a><a href="javascript:void(0)" onclick="delModel({link:'<?php echo IUrl::creatUrl("/brand/tags_del/id/".$item['id']."");?>'})"><img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_del.gif";?>" alt="删除" /></a></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>

<script language="javascript">
//排序
function toSort(id)
{
	if(id!='')
	{
		var va = $('#sort'+id).val();
		var part = /^\d+$/i;
		if(va!='' && va!=undefined && part.test(va))
		{
			$.get("<?php echo IUrl::creatUrl("/goods/brand_sort");?>",{'id':id,'sort':va}, function(data)
			{
				if(data=='1')
				{
					alert('修改商品品牌排序成功!');
				}else
				{
					alert('修改商品品牌排序错误!');
				}
			});
		}
	}
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
