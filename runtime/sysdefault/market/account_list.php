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
			<script type='text/javascript' src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/event.js";?>' charset="UTF-8"></script>
<script type="text/javascript" charset="UTF-8" src="/iweb2/runtime/_systemjs/my97date/wdatepicker.js"></script>
<div class="headbar">
	<div class="position"><span>统计</span><span>></span><span>日志操作记录</span><span>></span><span>资金操作记录列表</span></div>
	<div class="operating">
		<div class="search f_l">
			<form name="serachuser" action="<?php echo IUrl::creatUrl("/");?>" method="get">
				<input type='hidden' name='controller' value='market' />
				<input type='hidden' name='action' value='account_list' />
				从 <input type="text" name='startDate' value='<?php echo isset($this->startDate)?$this->startDate:"";?>' class="Wdate" pattern='date' alt='' onFocus="WdatePicker()" empty onblur="FireEvent(this,'onchange')" /> 到 <input type="text" name='endDate' value='<?php echo isset($this->endDate)?$this->endDate:"";?>' empty pattern='date' class="Wdate" onFocus="WdatePicker()" onblur="FireEvent(this,'onchange')" />

				<select class="auto" name="event">
					<option value="" selected>全部</option>
					<option value="1" <?php if(IReq::get('event')==1){?>selected<?php }?>>充值</option>
					<option value="2" <?php if(IReq::get('event')==2){?>selected<?php }?>>提现</option>
					<option value="4" <?php if(IReq::get('event')==4){?>selected<?php }?>>退款</option>
				</select>
				<button class="btn" type="submit"><span class="sch">搜 索</span></button>
			</form>
		</div>

		<div class="search f_r">
			<form action="<?php echo IUrl::creatUrl("/market/clear_log/type/account");?>" method="post" name='clear_log'>
				<select name='month' class='auto' pattern='int' alt='请选择月份'>
					<option value=''>选择要删除的时间段</option>
					<option value='1'>一个月以前</option>
					<option value='3'>三个月以前</option>
					<option value='6'>六个月以前</option>
				</select>
				<button class="btn" type="button" onclick="delModel({form:'clear_log'});"><span class="sch">记录删除</span></button>
			</form>
		</div>
	</div>

	<div class="field">
		<table class="list_table">
			<col />
			<col width="50px" />
			<col width="80px" />
			<col width="150px" />
			<thead>
				<tr>
					<th>内容</th>
					<th>类型</th>
					<th>金额</th>
					<th>时间</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div class="content">
	<table class="list_table">
		<col />
		<col width="50px" />
		<col width="80px" />
		<col width="150px" />
		<tbody>

			<?php foreach($this->accountList as $key => $item){?>
			<tr>
				<td><?php echo isset($item['note'])?$item['note']:"";?></td>
				<td>
					<?php if($item['event'] == 1){?>
					充值
					<?php }elseif($item['event'] == 2){?>
					提现
					<?php }elseif($item['event'] == 4){?>
					退款
					<?php }?>
				</td>
				<td><?php echo abs($item['amount']);?> 元</td>
				<td><?php echo isset($item['time'])?$item['time']:"";?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>
<?php echo $this->accountObj->getPageBar();?>
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
