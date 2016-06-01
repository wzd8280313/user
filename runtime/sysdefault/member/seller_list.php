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
			<?php $where = $this->where;?>
<div class="headbar">
	<div class="position">
		<span>会员</span><span>></span><span>商户管理</span><span>></span><span>商户列表</span>
	</div>
	<div class="operating">
		<div class="search f_r">
			<form name="searchseller" action="<?php echo IUrl::creatUrl("/");?>" method="get">
				<input type='hidden' name='controller' value='member' />
				<input type='hidden' name='action' value='seller_list' />
				<select class="auto" name="search">
					<option value="seller_name">登录名</option>
					<option value="true_name">真实名称</option>
					<option value="phone">电话</option>
					<option value="mobile">手机</option>
					<option value="email">Email</option>
				</select>
				<input class="small" name="keywords" type="text" value="<?php echo isset($keywords)?$keywords:"";?>" />
				<button class="btn" type="submit"><span class="sch">搜 索</span></button>
			</form>
		</div>
		<a href="javascript:void(0);"><button class="operating_btn" type="button" onclick="window.location='<?php echo IUrl::creatUrl("/member/seller_edit");?>'"><span class="addition">添加商户</span></button></a>
		<a href="javascript:void(0);" onclick="selectAll('id[]')"><button class="operating_btn" type="button"><span class="sel_all">全选</span></button></a>
		<a href="javascript:void(0);"><button class="operating_btn" type="button" onclick="sellerCommend();"><span class="grade">商户推荐</span></button></a>
		<a href="javascript:void(0);" onclick="delModel({form:'seller_list',msg:'确定要删除所选中的商户吗？<br />删除的商户可以从回收站找回。'})"><button class="operating_btn" type="button"><span class="delete">批量删除</span></button></a>
		<a href="javascript:void(0);"><button class="operating_btn" type="button" onclick="window.location='<?php echo IUrl::creatUrl("/member/seller_recycle_list");?>'"><span class="recycle">回收站</span></button></a>
	</div>
	
	<div class="searchbar">
		<form action="<?php echo IUrl::creatUrl("/");?>" method="get" name="searchListForm">
			<input type='hidden' name='controller' value='member' />
			<input type='hidden' name='action' value='seller_list' />
			<select class="auto" name="search[is_recom]">
				<option value="">选择会员</option>
				<option value="1">推荐商户</option>
			</select>
			<button class="btn" type="submit"  ><span class="sel">筛 选</span></button>
		</form>
	</div>
	<div class="field">
		<table class="list_table">
			<colgroup>
				<col width="40px" />
				<col width="140px" />
				<col width="140px" />
				<col width="100px" />
				<col width="110px" />
				<col width="70px" />
				<col width="80px" />
				<col width="80px" />
				<col width="80px" />
				<col width="150px"/>
				<col />
			</colgroup>
			<thead>
				<tr>
					<th class="t_c">选择</th>
					<th>登录用户名</th>
					<th>真实名称</th>
					<th>座机</th>
					<th>移动电话</th>
					<th>VIP</th>
					<th>推荐</th>
					<th>销量</th>
					<th>评分</th>
					<th>状态</th>
					<th>注册日期</th>
					<th>操作</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<form action="<?php echo IUrl::creatUrl("/member/seller_del");?>" method="post" name="seller_list" onsubmit="return checkboxCheck('id[]','尚未选中任何记录！')">
	<div class="content">
		<table class="list_table">
			<colgroup>
				<col width="40px" />
				<col width="140px" />
				<col width="140px" />
				<col width="100px" />
				<col width="110px" />
				<col width="70px" />
				<col width="70px" />
				<col width="80px" />
				<col width="80px" />
				<col width="80px" />
				<col width="150px"/>
				<col />
			</colgroup>
			<tbody>
				<?php $page=(isset($_GET['page'])&&(intval($_GET['page'])>0))?intval($_GET['page']):1;?>
				<?php $query = new IQuery("seller");$query->where = "is_del = 0 and $where";$query->order = "id desc";$query->page = "$page";$query->pagesize = "20";$items = $query->find(); foreach($items as $key => $item){?>
				<tr>
					<td class="t_c"><input name="id[]" type="checkbox" value="<?php echo isset($item['id'])?$item['id']:"";?>" /></td>
					<td title="<?php echo isset($item['seller_name'])?$item['seller_name']:"";?>"><?php echo isset($item['seller_name'])?$item['seller_name']:"";?></td>
					<td title="<?php echo isset($item['true_name'])?$item['true_name']:"";?>"><?php echo isset($item['true_name'])?$item['true_name']:"";?></td>
					<td title="<?php echo isset($item['phone'])?$item['phone']:"";?>"><?php echo isset($item['phone'])?$item['phone']:"";?></td>
					<td title="<?php echo isset($item['mobile'])?$item['mobile']:"";?>"><?php echo isset($item['mobile'])?$item['mobile']:"";?></td>
					<td><?php if($item['is_vip']==1){?>
						<a class='red2' href='javascript:void(0);' onclick='set_type("<?php echo isset($item['id'])?$item['id']:"";?>","is_vip","seller",this);'>是</a>
						<?php }else{?>
						<a class='blue' href='javascript:void(0);' onclick='set_type("<?php echo isset($item['id'])?$item['id']:"";?>","is_vip","seller",this);'>否</a>
						<?php }?>
					</td>
					<td>
						<?php if($item['is_recom']==1){?>
						<a class='red2' href='javascript:void(0);' onclick='set_type("<?php echo isset($item['id'])?$item['id']:"";?>","is_recom","seller",this);'>是</a>
						<?php }else{?>
						<a class='blue' href='javascript:void(0);' onclick='set_type("<?php echo isset($item['id'])?$item['id']:"";?>","is_recom","seller",this);'>否</a>
						<?php }?>
					</td>
					<td><?php echo statistics::sellCountSeller($item['id']);?> 件</td>
					<td><?php echo statistics::gradeSeller($item['id']);?> 分</td>
					<td>
						<select onchange="changeStatus(<?php echo isset($item['id'])?$item['id']:"";?>,this)">
							<option value="0" <?php if($item['is_lock'] == 0){?>selected="selected"<?php }?>>正常</option>
							<option value="1" <?php if($item['is_lock'] == 1){?>selected="selected"<?php }?>>待审核</option>
						</select>
					</td>
					<td title="<?php echo isset($item['create_time'])?$item['create_time']:"";?>"><?php echo isset($item['create_time'])?$item['create_time']:"";?></td>
					<td>
						<a href="<?php echo IUrl::creatUrl("/member/seller_edit/id/".$item['id']."");?>"><img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_edit.gif";?>" alt="修改" /></a>
						<a href="javascript:void(0)" onclick="delModel({link:'<?php echo IUrl::creatUrl("/member/seller_del/id/".$item['id']."");?>'})"><img class="operator" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/admin/icon_del.gif";?>" alt="删除" /></a>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
	<?php echo $query->getPageBar();?>
</form>

<script language="javascript">
//预加载
$(function(){
	var formObj = new Form('searchseller');
	formObj.init({'search':'<?php echo isset($search)?$search:"";?>'});
})
//商户推荐(新增）
function sellerCommend(){
	if($('input:checkbox[name="id[]"]:checked').length > 0)
	{
		var urlVal = "<?php echo IUrl::creatUrl("/member/seller_commend/");?>";
		$("form[name='seller_list']").attr('action',urlVal);
		//confirm('确定将选中的商品进行操作吗？',"formSubmit('orderForm')");
		formSubmit('seller_list');
	}
	else
	{
		alert('请选择要操作的商户!');
		return false;
	}
}
//商品导入或查询切换(新增）
function changeAction(excel)
{
	if(excel)
	{
		$("input[name=\"action\"]").val("seller_report");
		$("form[name=\"searchListForm\"]").attr("target", "_blank");
	}
	else
	{
		$("input[name=\"action\"]").val("seller_list");
		$("form[name=\"searchListForm\"]").attr("target", "_self");
	}
}
//商户状态修改
function changeStatus(sid,obj)
{
	var lockVal = obj.value;
	$.getJSON("<?php echo IUrl::creatUrl("/member/ajax_seller_lock");?>",{"id":sid,"lock":lockVal});
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
