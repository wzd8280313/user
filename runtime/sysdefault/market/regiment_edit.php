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
	<div class="position"><span>营销</span><span>></span><span>营销活动管理</span><span>></span><span><?php if(isset($this->regimentRow['id'])){?>编辑<?php }else{?>添加<?php }?>团购</span></div>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo IUrl::creatUrl("/market/regiment_edit_act");?>"  method="post" name='regiment_edit' enctype='multipart/form-data'>
			<input type='hidden' name='id' value=''/>
			<table class="form_table">
				<col width="150px" />
				<col />
				<tr>
					<th>团购标题：</th>
					<td><input type='text' class='normal' name='title' pattern='required' alt='请填写团购标题' /><label>* 填写团购名称</label></td>
				</tr>
				<tr>
					<th>团购时间：</th>
					<td>
						<input type='text' name='start_time' class='Wdate' onblur="FireEvent(this,'onchange');" pattern='datetime' onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" alt='请填写一个日期' /> ～
						<input type='text' name='end_time' class='Wdate' onblur="FireEvent(this,'onchange');" pattern='datetime' onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" alt='请填写一个日期' />
						<label>* 此团购的时间段</label>
					</td>
				</tr>
				<tr>
					<th>是否开启：</th>
					<td>
						<label class='attr'><input type='radio' name='is_close' value='0' />是</label>
						<label class='attr'><input type='radio' name='is_close' value='1' checked=checked />否</label>
					</td>
				</tr>
				<tr>
					<th>是否区分规格：</th>
					<td>
						<label class='attr' name='spec_diff'><input type='radio' name='spec' value='0' />是</label>
						<label class='attr' name='spec_diff'><input type='radio' name='spec' value='1' checked=checked />否</label>
					</td>
				</tr>
				<tr>
					<th>设置团购商品：</th>
					<td>
						<table class='border_table'>
							<col width="100px" />
							<col />
							<input type='hidden' name='goods_id' />

							<tbody id='regiment_box'>
							</tbody>

							<tr><td colspan=2><button type='button' class='btn' onclick=''><span>添加商品</span></button><label>* 添加要团购的商品</label></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<th>排序：</th>
					<td>
						<input type='text' class='small' name='sort' />
					</td>
				</tr>
				<tr>
					<th>介绍：</th>
					<td>
						<textarea class='textarea' name='intro'><?php echo isset($this->regimentRow['intro'])?$this->regimentRow['intro']:"";?></textarea>
					</td>
				</tr>
				<tr><td></td><td><button class="submit" type='submit'><span>确 定</span></button><span class='red'></span></td></tr>
			</table>
		</form>
	</div>
</div>

<script type='text/javascript'>
	//输入筛选商品的条件
	function searchGoodsCallback(goodsList)
	{
		goodsList.each(function()
		{
			var temp = $.parseJSON($(this).attr('data'));
			
			if (!temp.product_id) {
				temp.product_id = 0;
				var spec_str = '所有';
			}else{
				var spec_str = getSpec(temp.spec_array);
			}
			var goods_id = temp.goods_id;
			var is_presell = 0;
			$.ajax({
				type:'post',
				async:false,
				data:{'goods_id':goods_id},
				url:'<?php echo IUrl::creatUrl("market/is_presell");?>',
				beforeSend:function(){
					
				},
				success:function(data){
					if(data==1){
						$('.red').text('该商品已参加预售，不能参加团购');
						is_presell = 1;
					}
				},
				error:function(){
					
				},
				complete:function(){
				
				},
				timeout:1000,
				
			})
			if(is_presell==1)return false;
			var content = {
				"data":
				{
					"goods_id":temp.goods_id,
					"product_id":temp.product_id,
					"name":temp.name,
					"img":temp.img,
					"spec":spec_str,
					"sell_price":temp.sell_price,
					"store_nums":temp.store_nums
				}
			};
			relationCallBack(content);
		});
	}

	//关联商品回调处理函数
	function relationCallBack(content,regimentImg)
	{
		if(content)
		{
			regimentImg = !regimentImg ? content['data']['img'] : regimentImg;

			var imgUrl = "<?php echo IUrl::creatUrl("")."@url@";?>";
			imgUrl     = imgUrl.replace("@url@",regimentImg);

			var html = '<input type="hidden" name="goods_id" value="'+content['data']['goods_id']+'"/>'+
							'<input type="hidden" name="product_id" value="'+content['data']['product_id']+'"/>'+
						'<tr><th>商品名称：</th><td>'+content['data']['name']+'</td></tr>'
						  +'<tr><th>展示图片：</th><td><img src="'+imgUrl+'" title="'+content['data']['name']+'" style="max-width:140px;" /><br /><input type="file" class="file" name="img" /></td></tr>'
					  	  +'<tr><th>商品规格：</th><td>'+content['data']['spec']+'<label></label></td></tr>'
							+'<tr><th>团购价格：</th><td><input type="text" class="small" name="regiment_price" pattern="float" alt="填写数字" />，  目前原价：'+content['data']['sell_price']+'<label>* 设置团购价格</label></td></tr>'
							 +'<tr><th>团购库存量：</th><td><input type="text" class="small" name="store_nums" pattern="int" alt="填写数字" />，  目前库存：'+content['data']['store_nums']+'<label>* 团购出售的最大数量</label></td></tr>'
						  +'<tr><th>每人团购最小量：</th><td><input type="text" class="small" name="limit_min_count" pattern="int" alt="填写数字" />，<label>限制每个用户购买的最小数量，少于这个数量则无法购买，0表示不限制</label></td></tr>'
						  +'<tr><th>每人团购最大量：</th><td><input type="text" class="small" name="limit_max_count" pattern="int" alt="填写数字" />，<label>限制每个用户购买的最大数量，大于这个数量则无法购买，0表示不限制</label></td></tr>';

			$('#regiment_box').html(html);
		}
	}

	//关联商品信息
	<?php if(isset($this->regimentRow['goodsRow'])){?>
	var goodsRow = <?php echo isset($this->regimentRow['goodsRow'])?$this->regimentRow['goodsRow']:"";?>;
	goodsRow['data']['spec'] = getSpec(goodsRow['data']['spec_array']);
	goodsRow['data']['spec'] = goodsRow['data']['spec'] ? goodsRow['data']['spec'] : '所有';
	relationCallBack(goodsRow,"<?php echo isset($this->regimentRow['img'])?$this->regimentRow['img']:"";?>");
	<?php }?>

	//表单回填
	var formObj = new Form('regiment_edit');
	formObj.init(<?php echo JSON::encode($this->regimentRow);?>);
	
	$(function(){
		$('label[name=spec_diff]').click(function(){
			var is_spec = $(this).find('input[type=radio]').val();
			$('button.btn').off('click');
			if(is_spec==0){
				$('button.btn').on('click',function(){searchGoods('<?php echo IUrl::creatUrl("/block/search_goods/type/radio/is_products/1/seller_id/0");?>',searchGoodsCallback);})
			}else{
				$('button.btn').on('click',function(){searchGoods('<?php echo IUrl::creatUrl("/block/search_goods/type/radio/seller_id/0");?>',searchGoodsCallback);})
			}
			
		})
		<?php if(isset($this->regimentRow['product_id'])&&$this->regimentRow['product_id']>0){?>
			$('label[name=spec_diff]').eq(0).trigger('click');
		<?php }else{?>
			$('label[name=spec_diff]').eq(1).trigger('click');
		<?php }?>
		
	})
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
