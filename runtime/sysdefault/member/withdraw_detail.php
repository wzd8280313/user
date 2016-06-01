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
	<div class="position"><span>会员</span><span>></span><span>提现管理</span><span>></span><span>提现申请</span></div>
</div>
<div class="content_box">
	<div class="content">
		<div class='red_box'>修改前请确认财务人员已经把款打给了申请的用户</div>
		<form action='<?php echo IUrl::creatUrl("/member/withdraw_status");?>' method='post' name='withdraw_detail'>
			<table class="form_table">
				<input type='hidden' name='id' value='<?php echo isset($this->withdrawRow['id'])?$this->withdrawRow['id']:"";?>' />
				<col width="150px" />
				<col />
				<tr>
					<th>会员名称：</th>
					<td><?php echo isset($this->userRow['username'])?$this->userRow['username']:"";?></td>
				</tr>
				<tr>
					<th>真实姓名：</th>
					<td><?php echo isset($this->userRow['true_name'])?$this->userRow['true_name']:"";?></td>
				</tr>
				<tr>
					<th>当前余额：</th>
					<td><?php echo isset($this->userRow['balance'])?$this->userRow['balance']:"";?></td>
				</tr>
				<tr>
					<th>收款人姓名：</th>
					<td><?php echo isset($this->withdrawRow['name'])?$this->withdrawRow['name']:"";?></td>
				</tr>
				<tr>
					<th>提现金额：</th>
					<td><?php echo isset($this->withdrawRow['amount'])?$this->withdrawRow['amount']:"";?></td>
				</tr>
				<tr>
					<th>申请时间：</th>
					<td><?php echo isset($this->withdrawRow['time'])?$this->withdrawRow['time']:"";?></td>
				</tr>
				<tr>
					<th>备注：</th>
					<td><?php echo isset($this->withdrawRow['note'])?$this->withdrawRow['note']:"";?></td>
				</tr>
				<tr>
					<th>状态：</th>
					<td><?php echo Common::getWithdrawStatus($this->withdrawRow['status']);?></td>
				</tr>

				<?php if($this->withdrawRow['status']==0){?>
				<tr>
					<th>修改状态：</th>
					<td>
						<label class='attr'><input type='radio' name='status' value='-1' /><?php echo Common::getWithdrawStatus(-1);?></label>
						<label class='attr'><input type='radio' name='status' value='2' /><?php echo Common::getWithdrawStatus(2);?></label>
						<label>当选择 “成功” 状态后，用户的余额会自动被扣除，请确保您的财务人员已经通过线下转账汇款等方式完成了汇款操作</label>
					</td>
				</tr>
				<?php }?>
				<tr>
					<th>回复用户：</th>
					<td>
						<textarea class='textarea' name='re_note' <?php if($this->withdrawRow['status']!=0){?>disabled='disabled'<?php }?>></textarea>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<?php if($this->withdrawRow['status']==0){?>
						<button class="submit" type="submit"><span>修 改</span></button>
						<?php }?>
						<button class="submit" type="button" onclick="event_link('<?php echo IUrl::creatUrl("/member/withdraw_list");?>');"><span>返回列表</span></button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script type='text/javascript'>
	var formObj = new Form('withdraw_detail');
	formObj.init({
		'status':'<?php echo isset($this->withdrawRow['status'])?$this->withdrawRow['status']:"";?>',
		're_note':'<?php echo isset($this->withdrawRow['re_note'])?$this->withdrawRow['re_note']:"";?>'
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
