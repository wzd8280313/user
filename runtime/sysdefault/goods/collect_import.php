<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理后台</title>
<link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."css/admin.css";?>" />
<script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/jquery/jquery-1.11.3.min.js"></script><script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/jquery/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/artdialog/artDialog.js"></script><script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/iweb/runtime/_systemjs/artdialog/skins/aero.css" />
<script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/form/form.js"></script>
<script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/iweb/runtime/_systemjs/autovalidate/style.css" />
<script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<script type='text/javascript' src="<?php echo $this->getWebViewPath()."javascript/admin.js";?>"></script>
<script type='text/javascript' src="<?php echo $this->getWebViewPath()."javascript/common.js";?>"></script>
</head>

<body style="width:700px;height:280px;">
	<div class="pop_win">
		<ul class="red_box">
			<li>1、要采集的URL必须符合一定的规范，<a href="http://www.aircheng.com/notice-box/71-collect" target="_blank" class="blue">采集帮助说明</a></li>
			<li>2、在线商品数据采集，由于包括图片的下载，所以对网速要求比较高，需要耐心等待</li>
		</ul>

		<form action='<?php echo IUrl::creatUrl("/goods/collect_goods");?>' method='post'>
			<input type="hidden" name="seller_id" value="<?php echo IFilter::act(IReq::get('seller_id'),'int');?>" />
			<table class="form_table" width="90%" cellspacing="0" cellpadding="0" border="0">
				<colgroup>
					<col width="130px" />
					<col />
				</colgroup>

				<tbody>
					<tr>
						<td>添加到商品分类：</td>
						<td>
							<div id="__categoryBox" style="margin-bottom:8px"></div>

							<!--分类数据显示-->
							<script id="categoryButtonTemplate" type="text/html">
							<ctrlArea>
							<input type="hidden" value="<%=templateData['id']%>" name="category[]" />
							<button class="btn" type="button" onclick="return confirm('确定删除此分类？') ? $(this).parent().remove() : '';">
								<span class="del"><%=templateData['name']%></span>
							</button>
							</ctrlArea>
							</script>
							<button class="btn" type="button" onclick="selectGoodsCategory('<?php echo IUrl::creatUrl("/block/goods_category/type/checkbox");?>','category[]')"><span class="add">设置分类</span></button>
						</td>
					</tr>
					<tr>
						<td>URL类型：</td>
						<td>
							<label class='attr'><input type="radio" value="1" name="urlType" checked="checked" onchange="$('#collectNum').toggle();" />商品详情页面</label>
							<label class='attr'><input type="radio" value="2" name="urlType" onchange="$('#collectNum').toggle();" />商品列表页面</label>
							<label>选择所填写URL的类型，商品详情页面或者商品列表页面</label>
						</td>
					</tr>
					<tr>
						<td>采集URL地址：</td>
						<td>
							<input type='text' name='url[]' class='normal' pattern='url' value='' />
							<input type='text' name='url[]' class='normal' pattern='url' value='' />
							<input type='text' name='url[]' class='normal' pattern='url' value='' />
							<input type='text' name='url[]' class='normal' pattern='url' value='' />
							<input type='text' name='url[]' class='normal' pattern='url' value='' />
							<input type='text' name='url[]' class='normal' pattern='url' value='' />
						</td>
					</tr>
					<tr id="collectNum" style="display:none">
						<td>开始与截止位置：</td>
						<td>
							<input type='text' name='start' class='tiny' pattern='int' value='1' />
							--
							<input type='text' name='end' class='tiny' pattern='int' value='5' />
							<label>列表页面要采集的商品位置，如设置1-5则采集列表页面中的第1个到第5个商品</label>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</body>
</html>