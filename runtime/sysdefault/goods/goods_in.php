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
<script type="text/javascript" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/event.js";?>"></script>
<div class="headbar">
	<div class="position"><span>商品</span><span>></span><span>商品管理</span><span>></span><span>添加库存</span></div>
</div>
<div class="content_box">
	<div class="content form_content">
			<form action="<?php echo IUrl::creatUrl("/goods/store_add");?>"  method="post" name='store_num'>
			<table class="form_table">
				<col width="150px" />
				<col />
				<tr>
					<th>设置商品库存：</th>
					<td>
					
						<table class='border_table' style='width:65%'>
							<col width="100px" />
							<col width="200px" />
							<col />
							<thead>
								<tr>
									<th>图片</th>
									<th>商品ID</th>
									<th>名称</th>
									<th>规格</th>
									<th>原库存</th>
									<th>新增库存</th>
								</tr>
							</thead>
							<tbody id='store_list'>
								
							</tbody>
						</table>
					</td>
				</tr>
				
				<tr><td></td><td><button type='button' onclick="searchGoods('<?php echo IUrl::creatUrl("/block/search_goods/type/checkbox/is_products/1/seller_id/0");?>',storeNumsCallback);" class='btn'><span>选择商品</span></button></td></tr>
				<tr><td></td><td><button class="submit" ><span>确 定</span></button></td></tr>
			</table>
		</form>
	</div>
</div>
<script type='text/javascript'>
	//ajax提交数据
	$('form[name=store_num').submit(function(){
			$.ajax({
				type:'post',
				async:false,
				data:$('form[name=store_num]').serialize(),
				//dataType:'json',
				url:$('form[name=store_num]').attr('action'),
				beforeSend:function(){
				},
				success:function(data){
						var con = '';
						if(data == 1)con = '添加成功';
						else con = '操作失败';
						art.dialog({content:con,
									width:'300px',
									height:'80px',
									lock : true,
									time : '3',
									},
									function(){location.reload();},
									function(){},
									function(){location.reload();}
						);
				},
				error:function(){
					
				},
				complete:function(){
					
				},
			})
			return false;
		
	})
	
	//输入筛选商品的条件
	function storeNumsCallback(goodsList)
	{
		goodsList.each(function()
		{
			var temp = $.parseJSON($(this).attr('data'));
			if(!temp.product_id)temp.product_id = 0;
			var spec_str = getSpec(temp.spec_array);
			var content = {
				"data":
				{
					"goods_id":temp.goods_id,
					"goods_no":temp.goods_no,
					"product_id":temp.product_id,
					"name":temp.name,
					"img":temp.img,
					"spec":spec_str,
					"store_nums":temp.store_nums
				}
			};
			//window.realAlert(key);
			relationCallBack(content);
		});
	}

	//关联商品回调处理函数
	function relationCallBack(content)
	{
		var appendTo = $('#store_list');
		var n = $('#store_list>tr').length;
		if(content)
		{
			$('[name="condition"]').val(content['data']['id']);
			var imgUrl = "<?php echo IUrl::creatUrl("")."@url@";?>";
			imgUrl     = imgUrl.replace("@url@",content['data']['img']);

			var html =  '<tr  class="td_c">'+
			 '<td><img src="'+imgUrl+'" title="'+content['data']['name']+'" style="max-width:140px;max-height:50px;" /></td>'
						+'<td>'+content['data']['goods_no']+'</td>'
						+'<td>'+content['data']['name']+'</td>'
						+'<td>'+content['data']['spec']+'</td>'
						+'<td>'+content['data']['store_nums']+'</td>'
						+'<td><input type="hidden" name="'+n+'[goods_id]" value="'+content['data']['goods_id']+'"/>'+
								'<input type="hidden" name="'+n+'[product_id]" value="'+content['data']['product_id']+'"/>'+
								'<input text="text" class="small" name="'+n+'[add_num]" required alt="请填写一个数字" /></td>'
						+'</tr>';
			appendTo.append(html);
		}
	}

	//选择参与人群
	function select_all()
	{
		var is_checked = $('[name="group_all"]').attr('checked');
		if(is_checked ==  true)
		{
			var checkedVal  = true;
			var disabledVal = true;
		}
		else
		{
			var checkedVal  = false;
			var disabledVal = false;
		}

		$('input:checkbox[name="user_group[]"]').each(
			function(i)
			{
				$(this).attr('checked',checkedVal);
				$(this).attr('disabled',disabledVal);
			}
		);
	}

	//预定义商品绑定
	relationCallBack(<?php echo isset($this->promotionRow['goodsRow'])?$this->promotionRow['goodsRow']:"";?>);

	//表单回填
	var formObj = new Form('pro_edit');
	formObj.init
	({
		'id':'<?php echo isset($this->promotionRow['id'])?$this->promotionRow['id']:"";?>',
		'name':'<?php echo isset($this->promotionRow['name'])?$this->promotionRow['name']:"";?>',
		'start_time':'<?php echo isset($this->promotionRow['start_time'])?$this->promotionRow['start_time']:"";?>',
		'end_time':'<?php echo isset($this->promotionRow['end_time'])?$this->promotionRow['end_time']:"";?>',
		'group_all':"<?php echo isset($this->promotionRow['user_group'])?$this->promotionRow['user_group']:"";?>",
		'is_close':'<?php echo isset($this->promotionRow['is_close'])?$this->promotionRow['is_close']:"";?>',
		'condition':'<?php echo isset($this->promotionRow['condition'])?$this->promotionRow['condition']:"";?>',
		'award_value':'<?php echo isset($this->promotionRow['award_value'])?$this->promotionRow['award_value']:"";?>'
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
