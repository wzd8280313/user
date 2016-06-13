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
	<div class="position"><span>系统</span><span>></span><span>权限管理</span><span>></span><span><?php if(isset($this->rightRow['id'])){?>编辑<?php }else{?>添加<?php }?>权限</span></div>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo IUrl::creatUrl("/system/right_edit_act");?>"  method="post" name='right_edit'>
			<input type='hidden' name='id' />
			<table class="form_table">
				<col width="150px" />
				<col />
				<tr>
					<th>权限名称：</th>
					<td><input type='text' class='normal' name='name' pattern='required' alt='请填写权限名称' /><label>* 权限名称，如 [商品]商品管理，程序会根据中括号里面的字符进行权限分组</label></td>
				</tr>

				<tr>
					<th>权限码集合：</th>
					<td>
						<table class='border_table' style='width:310px'>
							<thead>
								<tr><th>权限码</th><th>操作</th></tr>
							</thead>
							<tbody id='rightBox'>
								<?php $rightArray = explode(',',trim($this->rightRow['right'],','))?>
								<?php if($rightArray){?>
									<?php foreach($rightArray as $key => $item){?>
									<tr><td><input type='text' class='middle' value='<?php echo isset($item)?$item:"";?>' name='right[]' pattern="^\w+@\w+$" /></td><td><img class="operator" onclick="$(this).parent().parent().remove();" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_del.gif";?>" alt="删除" title="删除" /></td></tr>
									<?php }?>
								<?php }else{?>
								<tr><td><input type='text' class='middle' value='' name='right[]' pattern="^\w+@\w+$" /></td><td><img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_del.gif";?>" alt="删除" title="删除" /></td></tr>
								<?php }?>
							</tbody>
							<tfoot>
								<tr><td colspan='2'><button type="button" class="btn" onclick='create_right();'><span class="add">添 加</span></button></td></tr>
							</tfoot>
						</table>
						<label>* 此码是由 [ 控制器名称 ] @ [ 动作名称 ] 组成，例如 管理员列表的权限码：system@admin_list </label>
					</td>
				</tr>

				<tr>
					<th>添加权限码：</th>
					<td>
						<select class='auto' id='ctrl' name='ctrl' onchange="get_list_action(this.value);"><option value='' selected=selected>请选择</option></select> @ <select class='auto' name='action' id='action'></select>
						<button type="button" class="btn" onclick='create_right_auto();'><span class="add">添 加</span></button>
					</td>
				</tr>
				<tr><td></td><td><button class="submit" type='submit'><span>保 存</span></button></td></tr>
			</table>
		</form>
	</div>
</div>

<script type='text/javascript'>
	//动态获取动作列表
	function get_list_action(ctrlId)
	{
		$('#action').empty();
		$.getJSON('<?php echo IUrl::creatUrl("/system/list_action");?>',{ctrlId:ctrlId},function(content){
			for(pro in content)
			{
				var optionStr = '<option value="'+content[pro]+'">'+content[pro]+'</option>';
				$('#action').append(optionStr);
			}
		});
	}

	jQuery(function(){
		//动态获取控制器文件列表
		$.getJSON('<?php echo IUrl::creatUrl("/system/list_controller");?>',function(content){
			for(pro in content)
			{
				var optionStr = '<option value="'+content[pro]+'">'+content[pro]+'</option>';
				$('#ctrl').append(optionStr);
			}
			get_list_action($('#ctrl').val());
		});
	});

	//添加权限码
	function create_right(val)
	{
		var val = (val == undefined) ? '':val;
		var rightStr = '<tr><td><input type="text" class="middle" value="'+val+'" name="right[]" /></td><td><img class="operator" onclick="$(this).parent().parent().remove();" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_del.gif";?>" alt="删除" title="删除" /></td></tr>';
		$('#rightBox').prepend(rightStr);
	}

	//自动添加权限码
	function create_right_auto()
	{
		var ctrlVal   = $('#ctrl').val();
		var actionVal = $('#action').val();
		if(ctrlVal && actionVal)
		{
			create_right(ctrlVal+'@'+actionVal);
		}
		else
		{
			alert('控制器或者动作不能为空');
		}
	}

	var formObj = new Form('right_edit');
	formObj.init({
		'id':'<?php echo isset($this->rightRow['id'])?$this->rightRow['id']:"";?>',
		'name':'<?php echo isset($this->rightRow['name'])?$this->rightRow['name']:"";?>'
	});
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
