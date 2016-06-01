<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台管理</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."css/admin.css";?>" />
	<meta name="robots" content="noindex,nofollow">
	<link rel="shortcut icon" href="favicon.ico" />
	<script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/jquery/jquery-1.11.3.min.js"></script><script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/jquery/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/artdialog/artDialog.js"></script><script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/iweb/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/iweb/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
	<script type='text/javascript' src="<?php echo $this->getWebViewPath()."javascript/common.js";?>"></script>
	<script type='text/javascript' src="<?php echo $this->getWebViewPath()."javascript/admin.js";?>"></script>
	<script type='text/javascript' src="<?php echo $this->getWebViewPath()."javascript/menu.js";?>"></script>
</head>
<body>
	<div class="container">
		<div id="header">
			<div class="logo">
				<a href="<?php echo IUrl::creatUrl("/system/default");?>"><img src="<?php echo $this->getWebSkinPath()."images/admin/logo.png";?>" width="303" height="43" /></a>
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
			<div id="copyright"></div>
		</div>

		<div id="admin_right">
			<div class="headbar">
	<div class="position"><span>系统</span><span>></span><span>网站管理</span><span>></span><span>主题设置</span></div>
</div>

<form action="<?php echo IUrl::creatUrl("/system/applyTheme");?>" method="post">
<div class="content">
	<?php foreach(Common::getSitePlan('theme') as $theme => $item){?>
	<table class='list_table th_right'>
		<colgroup>
			<col width='175px' />
			<col width='60px' />
			<col />
		</colgroup>

		<tbody>
			<tr>
				<th rowspan='7'>
					<div class="thumbnail">
						<img src="<?php echo $item['thumb'];?>" width='160px' height='210px' />
						<?php if(Common::isThemeUsed($theme)){?>
						<div class="sel"><span>正在使用</span></div>
						<?php }?>
					</div>
				</th>
				<th>名称：</th><td><?php echo isset($item['name'])?$item['name']:"";?></td>
			</tr>
			<tr><th>目录：</th><td><?php echo IWeb::$app->getWebViewPath();?><?php echo isset($theme)?$theme:"";?></td></tr>
			<tr><th>版本：</th><td><?php echo isset($item['version'])?$item['version']:"";?></td></tr>
			<tr><th>时间：</th><td><?php echo isset($item['time'])?$item['time']:"";?></td></tr>
			<tr><th>简介：</th><td><?php echo isset($item['info'])?$item['info']:"";?></td></tr>
			<tr><th>类型：</th><td class="<?php echo common::themeType($theme);?>"><?php echo common::themeTypeTxt(common::themeType($theme));?></td></tr>
			<tr>
				<th>启用：</th>
				<td>
					<?php foreach(IClient::supportClient() as $key => $client){?>
					选择应用于<?php echo isset($client)?$client:"";?>端：
					<select name="<?php echo isset($client)?$client:"";?>[<?php echo isset($theme)?$theme:"";?>]" title='当客户用<?php echo isset($client)?$client:"";?>端访问网站时候，此主题模板会进行呈现'>
						<option value="" selected="selected">不启用</option>
						<?php foreach(Common::getSitePlan('skin',$theme) as $skin => $skinItem){?>
						<option value="<?php echo isset($skin)?$skin:"";?>" data="<?php echo isset($client)?$client:"";?><?php echo isset($theme)?$theme:"";?><?php echo isset($skin)?$skin:"";?>"><?php echo isset($skinItem['name'])?$skinItem['name']:"";?></option>
						<?php }?>
					</select>
					&nbsp;&nbsp;&nbsp;
					<?php }?>
					<a href='<?php echo IUrl::creatUrl("/system/conf_skin/theme/".$theme."");?>' class='orange' title='选择主题模板的皮肤颜色'>查看皮肤详情</a>
				</td>
			</tr>
		</tbody>
	</table>
	<br />
	<?php }?>
</div>
<div class="pages_bar">
	<div class="t_c">
		<button type="submit" class="submit"><span>保存主题设置</span></button>
	</div>
</div>
</form>

<script type="text/javascript">
//主题模板数据初始化
jQuery(function()
{
	var theme = <?php echo JSON::encode(IWeb::$app->config['theme']);?>;
	if(theme)
	{
		for(var k in theme)
		{
			var childObj = theme[k];
			for(var i in childObj)
			{
				var checkKey = k+i+childObj[i];
				$("option[data='"+checkKey+"']").attr("selected",true);
			}
		}
	}
});
</script>

<style type="text/css">
.site{color:red;font-weight:bold;}
.system{color:green;font-weight:bold;}
.seller{color:orange;font-weight:bold;}
</style>
		</div>
	</div>

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
</body>
</html>
