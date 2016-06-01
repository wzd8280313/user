<?php $seo_data=array();$site_config=new Config('site_config');$site_config=$site_config->getInfo();?>
<?php $seo_data['title']="商品搜索_".$site_config['name']?>
<?php seo::set($seo_data);?>
<?php $defaultWhere = array('search' => $this->word , 'category_extend' => $this->cat_id )?>
<?php $goodsObj = search_goods::find($defaultWhere);$resultData = $goodsObj->find();
$seller = new IModel('seller');
$seller_arr = array();
$seller_arr[0]='平台自营';
?>
<?php foreach($resultData as $key => $item){?>
	<?php if(!isset($seller_arr[$item['seller_id']])){?>
	<?php $seller_arr[$item['seller_id']]=$seller->getField('id='.$item['seller_id'],'true_name')?>
	<?php }?>
<?php }?>
<div class="position"> <span>全部结果：</span> <a href="javascript:void(0)"><?php echo isset($this->word)?$this->word:"";?></a> </div>
<div class="wrapper clearfix container_2">

	<div class="search_list main f_r">
		<strong class="result">"<span class="red"><?php echo isset($this->word)?$this->word:"";?></span>" 搜索结果</strong>
		<p class="t_l gray m_10">你是不是想找：
			<?php foreach(Api::run('getKeywordByWord',array('#word#',$this->word)) as $key => $item){?>
			<?php $tmpWord=urlencode($item['word']);?>
			<a href="<?php echo IUrl::creatUrl("/site/search_list/word/".$tmpWord."");?>" class='orange'><?php echo isset($item['word'])?$item['word']:"";?></a>
			<?php }?>
		</p>

		<!--商品条件检索-->
		<div class="box m_10">
			<div class="cont">

				<!--品牌展示-->
				<?php $brandList = search_goods::$brandSearch?>
				<?php if($brandList){?>
				<dl class="sorting">
					<dt>品牌：</dt>
					<dd id='brand_dd'>
						<a class="nolimit current" href="<?php echo search_goods::searchUrl('brand','');?>">不限</a>
						<?php foreach($brandList as $key => $item){?>
						<a href="<?php echo search_goods::searchUrl('brand',$item['id']);?>" id='brand_<?php echo isset($item['id'])?$item['id']:"";?>'><?php echo isset($item['name'])?$item['name']:"";?></a>
						<?php }?>
					</dd>
				</dl>
				<?php }?>
				<!--品牌展示-->

				<!--商品属性-->
				<?php $attrSearch = search_goods::$attrSearch;$modelSearch = search_goods::$modelSearch?>
		
				<?php if( !empty($attrSearch)){?>
					<?php foreach($attrSearch as $key => $item){?>
					<dl class="sorting">
						<dt><?php echo isset($item['name'])?$item['name']:"";?>：</dt>
						<dd id='attr_dd_<?php echo isset($item['id'])?$item['id']:"";?>'>
							<a class="nolimit current" href="<?php echo search_goods::searchUrl('attr['.$item["id"].']','');?>">不限</a>
							<?php foreach($item['value'] as $key => $attr){?>
							<a href="<?php echo search_goods::searchUrl('attr['.$item["id"].']',$attr);?>" id="attr_<?php echo isset($item['id'])?$item['id']:"";?>_<?php echo md5($attr);?>"><?php echo isset($attr)?$attr:"";?></a>
							<?php }?>
						</dd>
					</dl>
					<?php }?>
				<?php }elseif( !empty($modelSearch)){?>
						<dl class="sorting">
							<dt>分类：</dt>
							<dd >
								<a class="nolimit current" >不限</a>
								
								<?php foreach($modelSearch as $key => $item){?>
								<a href="<?php echo search_goods::searchUrl(array('1'=>'model'),$item['id']);?>" id="model_<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></a>
								<?php }?>
							</dd>
						</dl>

				<?php }?>
				<!--商品属性-->

				<!--商品价格-->
				<dl class="sorting">
					<dt>价格：</dt>
					<dd id='price_dd'>
						<p class="f_r"><input type="text" class="mini" name="min_price" value="<?php echo IFilter::act(IReq::get('min_price'),'url');?>" onchange="checkPrice(this);"> 至 <input type="text" class="mini" name="max_price" onchange="checkPrice(this);" value="<?php echo IFilter::act(IReq::get('max_price'),'url');?>"> 元

						<label class="btn_gray_s"><input class='btn_gray btn_mini' type="button" onclick="priceLink();" value="确定"></label></p>

						<a class="nolimit current" href="<?php echo search_goods::searchUrl(array('min_price','max_price'),'');?>">不限</a>
						<?php foreach(search_goods::$priceSearch as $key => $item){?>
						<?php $priceZone = explode('-',$item)?>
						<a href="<?php echo search_goods::searchUrl(array('min_price','max_price'),array($priceZone[0],$priceZone[1]));?>" id="<?php echo isset($priceZone[0])?$priceZone[0]:"";?>-<?php echo isset($priceZone[1])?$priceZone[1]:"";?>"><?php echo isset($item)?$item:"";?></a>
						<?php }?>
					</dd>
				</dl>
				<!--商品价格-->
			</div>
		</div>
		<!--商品条件检索-->

		<div class="display_title m_10">
			<span class="l"></span>
			<span class="r"></span>
			<span class="f_l">排序：</span>
			<ul>
				<?php foreach(search_goods::getOrderType() as $key => $item){?>
				<?php $next = search_goods::getOrderValue($key)?>
				<li class="<?php echo search_goods::isOrderCurrent($key) ? 'current':'';?>">
					<span class="l"></span><span class="r"></span>
					<a href="<?php echo search_goods::searchUrl('order',$next);?>"><?php echo isset($item)?$item:"";?><span class="<?php echo search_goods::isOrderDesc() ? 'desc':'';?>">&nbsp;</span></a>
				</li>
				<?php }?>
			</ul>
			<span class="f_l">显示方式：</span>
			<a class="show_b" href="<?php echo search_goods::searchUrl('show_type','win');?>" title='橱窗展示' alt='橱窗展示'><span class='<?php echo search_goods::getListShow(IReq::get('show_type')) == 'win' ? 'current':'';?>'></span></a>
			<a class="show_s" href="<?php echo search_goods::searchUrl('show_type','list');?>" title='列表展示' alt='列表展示'><span class='<?php echo search_goods::getListShow(IReq::get('show_type')) == 'list' ? 'current':'';?>'></span></a>
		</div>

		<?php if($resultData){?>
		<?php $listSize = search_goods::getListSize(IFilter::act(IReq::get('show_type')))?>
		<ul class="display_list clearfix m_10">
			<?php foreach($resultData as $key => $item){?>
			<li class="clearfix <?php echo search_goods::getListShow(IFilter::act(IReq::get('show_type')));?>">
				<div class="pic">
					<a title="<?php echo isset($item['name'])?$item['name']:"";?>" href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>" target="_blank"><img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/".$listSize['width']."/h/".$listSize['height']."");?>" width="<?php echo isset($listSize['width'])?$listSize['width']:"";?>" height="<?php echo isset($listSize['height'])?$listSize['height']:"";?>" alt="<?php echo isset($item['name'])?$item['name']:"";?>" title="<?php echo isset($item['name'])?$item['name']:"";?>" /></a>
				</div>
				<h3 class="title" >
					<span style='display:inline;color:red;'><?php if($item['is_del']==4){?>[预售]<?php }?></span>
					<a title="<?php echo isset($item['name'])?$item['name']:"";?>" style='display:inline;' class="p_name" href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>" target="_blank">
						<?php echo str_replace($this->word,'<b class="red">'.$this->word.'</b>',$item['name']);?>
					</a>
					<span>总销量：<?php echo isset($item['sale'])?$item['sale']:"";?>
						<a class="blue" href="<?php echo IUrl::creatUrl("/site/comments_list/id/".$item['id']."");?>">( <?php echo isset($item['comments'])?$item['comments']:"";?>人评论 )</a>
					</span>
					<span class='grade'>
						<i style='width:<?php echo Common::gradeWidth($item['grade'],$item['comments']);?>px'>
						</i>
					</span>
					<span style='margin-top:2px;'>
						<a  style='margin-left:5px;text-decoration:none;'><?php echo isset($seller_arr[$item['seller_id']])?$seller_arr[$item['seller_id']]:"";?></a>
					</span>
				</h3>
				
				<div class="price" >￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?><s>￥<?php echo isset($item['market_price'])?$item['market_price']:"";?></s></div>
			</li>
			<?php }?>
		</ul>
		<?php echo $goodsObj->getPageBar();?>
		<?php }else{?>
		<p class="display_list mt_10" style='margin-top:50px;margin-bottom:50px'>
			<strong class="gray f14">对不起，没有找到相关商品</strong>
		</p>
		<?php }?>
	</div>
</div>

<script type='text/javascript'>
//价格跳转
function priceLink()
{
	var minVal = $('[name="min_price"]').val();
	var maxVal = $('[name="max_price"]').val();
	if(isNaN(minVal) || isNaN(maxVal))
	{
		alert('价格填写不正确');
		return '';
	}
	var urlVal = "<?php echo IFilter::act(preg_replace('|&min_price=\w*&max_price=\w*|','',search_goods::searchUrl(array('min_price','max_price'),'')),'url');?>";
	window.location.href=urlVal+'&min_price='+minVal+'&max_price='+maxVal;
}

//价格检查
function checkPrice(obj)
{
	if(isNaN(obj.value))
	{
		obj.value = '';
	}
}

//筛选条件按钮高亮
jQuery(function(){
	<?php 
		$brand = IFilter::act(IReq::get('brand'),'int');
	?>

	<?php if($brand){?>
	$('#brand_dd>a').removeClass('current');
	$('#brand_<?php echo isset($brand)?$brand:"";?>').addClass('current');
	<?php }?>

	<?php $tempArray = IFilter::act(IReq::get('attr'),'url')?>
	<?php if($tempArray){?>
		<?php $json = JSON::encode(array_map('md5',$tempArray))?>
		var attrArray = <?php echo isset($json)?$json:"";?>;
		for(val in attrArray)
		{
			if(attrArray[val])
			{
				$('#attr_dd_'+val+'>a').removeClass('current');
				document.getElementById('attr_'+val+'_'+attrArray[val]).className = 'current';
			}
		}
	<?php }?>

	<?php if(IReq::get('min_price') != ''){?>
	$('#price_dd>a').removeClass('current');
	$('#<?php echo IReq::get('min_price');?>-<?php echo IReq::get('max_price');?>').addClass('current');
	<?php }?>
});
</script>