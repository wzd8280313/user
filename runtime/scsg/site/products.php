<?php 
	$seo_data=array();
	$site_config=new Config('site_config');
	$seo_data['title']=$name."_".$site_config->name;
	$seo_data['keywords']=$keywords;
	$seo_data['description']=$description;
	seo::set($seo_data);
	
?>

<script type="text/javascript" charset="UTF-8" src="/iweb2/runtime/_systemjs/cookie/jquery.cookie.js"></script>
<?php $breadGuide = goods_class::catRecursion($category);$promotion=Api::run('getProrule');?>
<?php foreach($promotion as $key => $item){?>
	<?php if($item['type']==6){?><!--获取免配送费的信息-->
	<?php $freightInfo=$item['info']?>
	<?php }?>
<?php }?>
<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/index1.css";?>">
<link rel="stylesheet" type='text/css' href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/detail.css";?>"/>
<link rel="stylesheet" type='text/css' href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/css.css";?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/jquery.bxSlider/jquery.bxslider.css";?>" />
<script type="text/javascript" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/jquery.bxSlider/jquery.bxSlider.min.js";?>"></script>
<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/piczoom.js";?>"></script>
<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/detail.js";?>" ></script>
<script type='text/javascript' >
	var product = <?php echo isset($product)?$product:"";?>;
	var buy_now_url = '<?php echo IUrl::creatUrl("/simple/cart2/id/@id@/num/@buyNums@/type/@type@");?>';
	var join_cart_url = '<?php echo IUrl::creatUrl("/simple/joinCart");?>';
	var goods_id = <?php echo isset($id)?$id:"";?>;
	var show_cart_url = '<?php echo IUrl::creatUrl("/simple/showCart");?>';
	var get_product_url = '<?php echo IUrl::creatUrl("/site/getProduct");?>';
	var spec_show_obj = new Spec_show();
	//获取地区
	var area_url = '<?php echo IUrl::creatUrl("/block/area_child");?>';
	var delivery_fee_url = '<?php echo IUrl::creatUrl("/block/order_delivery");?>';
	

</script>

<div class="position"><span>您当前的位置：</span><a href="<?php echo IUrl::creatUrl("");?>">首页</a><?php foreach($breadGuide as $key => $item){?> » <a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$item['id']."");?>"><?php echo isset($item['name'])?$item['name']:"";?></a><?php }?> » <?php echo isset($name)?$name:"";?></div>
<div class="wrapper clearfix">
	
	<div class="summary" style='margin-right:15px;'>

		<!--货品ID，当为商品时值为空-->
		<input type='hidden' id='product_id' alt='货品ID' value='' />
		<!--基本信息区域-->
		<div id='detail'>
			<div id="J_DetailMeta" class="tm-detail-meta tm-clear">
			<div class="tb-wrap">
				<div class="tb-detail-hd">
					<h1 data-spm="1000983">	<?php echo isset($name)?$name:"";?> </h1>
					<h2 data-spm="1000983" style="color:#e05757;">	<?php echo isset($short_desc)?$short_desc:"";?> </h2>
					<p> </p>
				</div>
				<div class="tm-fcs-panel" id='price_panel'>
					
				</div>
				<script  type='text/html' id='priceTemplate'>
					<dl id="J_PromoPrice" class="tm-promo-panel"  >
							<dt class="tb-metatit">市场价</dt>
							<dd><em class="tm-yen">¥</em>
								<span class="tm-price" style='text-decoration:line-through;'><%=market_price%></span>
								<div class="staticPromoTip"> </div>
							</dd>
						</dl>
					<%if (group_price) {%>
						<dl id="J_PromoPrice" class="tm-promo-panel"  >
							<dt class="tb-metatit">原价格</dt>
							<dd><em class="tm-yen">¥</em>
								<span class="tm-price" style='text-decoration:line-through;'><%=sell_price%></span>
								<div class="staticPromoTip"> </div>
							</dd>
						</dl>
						<dl id="J_StrPriceModBox" class="tm-price-panel tm-price-cur">
							<dt class="tb-metatit">会员价</dt>
							<dd>
								<em class="tm-yen">¥</em>
								<span class="tm-price" id='real_price'><%=group_price%></span>
								<div class="staticPromoTip"> </div>
							</dd>
						</dl>
						
					<%}else{%>
						<dl id="J_StrPriceModBox" class="tm-price-panel tm-price-cur">
							<dt class="tb-metatit">价格</dt>
							<dd>
								<em class="tm-yen">¥</em>
								<span class="tm-price" id='real_price'><%=sell_price%></span>
								<div class="staticPromoTip"> </div>
							</dd>
						</dl>
						
					<%}%>
				</script>
				<?php if(!empty($regiment)){?>
				<div class="tb-meta">
					<dl id="J_RSPostageCont" class="tm-delivery-panel">
						<dt class="tb-metatit">团购信息</dt>
						<dd>
							<div class="det_tuan " >
								<span class='sell_sum' style='margin-left:5px;'>正在团购(<span >￥<?php echo isset($regiment['regiment_price'])?$regiment['regiment_price']:"";?></span>)</span>
								<a href='<?php echo IUrl::creatUrl("/site/tuan_product/active/".$regiment["id"]."");?>' style='color:blue;'>去团购</a>
							</div>
						</dd>
					</dl>
				</div>
				<?php }?>
				<div class="tb-meta">
					<dl id="J_RSPostageCont" class="tm-delivery-panel">
						<dt class="tb-metatit">配送至</dt>
						<dd>
							<div class="tb-postAge" style='color:#666;padding-top:0px;'>
								<!-- 配送地址开始 -->
								<ul id="list1">
									<li id="summary-stock">
										<div class="dd">
											<div id="store-selector" >
											</div><!--store-selector end-->
											<div id="store-prompt"><strong></strong></div><!--store-prompt end--->
										</div>
									</li>
								</ul>

								<!-- 配送地址结束 -->


								<?php echo isset($freightInfo)?$freightInfo:"";?>
								<a href="<?php echo IUrl::creatUrl("/site/help/id/73");?>" style='color:red;display:inline-block;' target="_blank">配送说明</a>
							</div>
						</dd>
					</dl>
				</div>
				<div class="tb-meta">
					<dl id="J_RSPostageCont" class="tm-delivery-panel">
						<dt class="tb-metatit">服务</dt>
						<dd>
							<div class="tb-postAge">
							由<?php if(isset($seller)){?>
							<?php echo isset($seller['true_name'])?$seller['true_name']:"";?>
							<?php }else{?>
							山城速购
							<?php }?>
							配送,并提供售后服务
							</div>
						</dd>
					</dl>
				</div>
					<ul class="tm-ind-panel">
						<li class="tm-ind-item tm-ind-sellCount canClick" >
							<div class="tm-indcon" onclick="jumpTo('buyHistory')">
									<span class="tm-label">销售记录</span>
								<span class="tm-count"><?php echo isset($buy_num)?$buy_num:"";?></span>
							</div>
						</li>
						<li id="J_ItemRates" class="tm-ind-item tm-ind-reviewCount canClick tm-line3">
							<div class="tm-indcon"  onclick="jumpTo('point')">
								<span class="tm-label">累计评价</span>
								<span class="tm-count"><?php echo isset($comments)?$comments:"";?></span>
							</div>
						</li>
						<li class="tm-ind-item tm-ind-emPointCount" >
							<div class="tm-indcon">
								<a target="_blank" href="" >
									<span class="tm-label">送积分</span>
									<span class="tm-count"><?php echo isset($point)?$point:"";?></span>
								</a>
							</div>
						</li>
					</ul>
					<div class="tb-key">
						<div class="tb-skin">
							<div class="tb-sku">
								
								<?php if($spec_array){?>
								<?php $specArray = JSON::decode($spec_array);?>
								<?php foreach($specArray as $key => $item){?>
								<dl class="m_10 clearfix" name="specCols">
									<dt><?php echo isset($item['name'])?$item['name']:"";?></dt>
									<dd class="w_45" style="margin-left:67px;" id="specList<?php echo isset($item['id'])?$item['id']:"";?>">
										<?php $specVal=explode(',',trim($item['value'],','))?>
										<?php foreach($specVal as $key => $spec_value){?>
										<?php if($item['type'] == 1){?>
										<div class="item w_27"><a href="javascript:void(0);" class='allowed' onclick="spec_show_obj.sele_spec(this);get_delivery_fee()" value='{"id":"<?php echo isset($item['id'])?$item['id']:"";?>","type":"<?php echo isset($item['type'])?$item['type']:"";?>","value":"<?php echo isset($spec_value)?$spec_value:"";?>","name":"<?php echo isset($item['name'])?$item['name']:"";?>"}' ><?php echo isset($spec_value)?$spec_value:"";?><span></span></a></div>
										<?php }else{?>
										<div class="item"><a href="javascript:void(0);" onclick="spec_show_obj.sele_spec(this);get_delivery_fee()" value='{"id":"<?php echo isset($item['id'])?$item['id']:"";?>","type":"<?php echo isset($item['type'])?$item['type']:"";?>","value":"<?php echo isset($spec_value)?$spec_value:"";?>","name":"<?php echo isset($item['name'])?$item['name']:"";?>"}' ><img src="<?php echo IUrl::creatUrl("")."".$spec_value."";?>" width='30px' height='30px' /><span></span></a></div>
										<?php }?>
										<?php }?>
									</dd>
								</dl>
								<?php }?>
								<?php }?>
																								
								<dl class="tb-amount tm-clear">
									<dt class="tb-metatit">数量</dt>
									<dd id="J_Amount">
										<input class="gray_t f_l" type="text" id="buyNums" onblur="spec_show_obj.checkBuyNums();get_delivery_fee()" value="1" maxlength="5" />
											<div class="resize">
												<a class="add" href="javascript:spec_show_obj.modified(1);get_delivery_fee()"></a>
												<a class="reduce" href="javascript:spec_show_obj.modified(-1);get_delivery_fee()"></a>
											</div>
											<span class="mui-amount-unit">&nbsp;件</span>
										<em id="J_EmStock" class="tb-hidden" style="display: inline; margin-left:20px;">库存<label id="data_storeNums"><?php echo isset($store_nums)?$store_nums:"";?></label>件</em>
										<span id="J_StockTips"> </span>
									</dd>
								</dl>
							</div>
						</div>
					</div>
					
					
				</div>
			</div>
		</div>

		<!--购买区域-->
		<div class="current">
			<?php if($store_nums <= 0){?>
				该商品已售完，不能购买，您可以看看其它商品！(<a href="<?php echo IUrl::creatUrl("/simple/arrival/goods_id/".$id."");?>" class="orange" style="#f15a24">到货通知</a>)
			<?php }else{?>

			<input class="submit_buy" type="button" id="buyNowButton" onclick="spec_show_obj.buy_now();" value="立即购买" />


			<div class="shop_cart" style="z-index:1">
				<input class="submit_join" type="button" id="joinCarButton" onclick="spec_show_obj.joinCart();" value="加入购物车" />


				<div class="shopping" id="product_myCart" style="z-index:1;display:none">
					<dl class="cart_stats">
						<dt class="gray f14 bold">
							<a class="close_2 f_r" href="javascript:closeCartDiv();" title="关闭">关闭</a>
							<img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/right_s.gif";?>" width="24" height="24" alt="" />成功加入购物车
						</dt>
						<dd class="gray">目前选购商品共<b class="orange" name='mycart_count'></b>件<span>合计：<b name='mycart_sum'></b></span></dd>
						<dd><a class="btn_blue bold" href="<?php echo IUrl::creatUrl("/simple/cart");?>" target='_blank'>进入购物车</a><a class="btn_blue bold" href="javascript:void(0)" onclick="closeCartDiv();">继续购物>></a></dd>
					</dl>
				</div>
			</div>
			<?php }?>
		</div>
		
		<div class="tm-ser tm-clear" style="z-index:-1000">
			<dl class="tm-clear">
				<dt class="tb-metatit">服务承诺</dt>
				<dd class="tm-laysku-dd">
				<ul class="tb-serPromise">
					<?php $config = new Config('site_config');?>
					<?php $server_product = unserialize(IFilter::stripSlash($config->product_page))?>
					<?php if(!empty($server_product)){?>
					<?php foreach($server_product as $key => $item){?>
					<li>
						<a target="_blank"  href="<?php echo isset($item['link'])?$item['link']:"";?>" target="_blank"> <?php echo isset($item['server_name'])?$item['server_name']:"";?> </a>
					</li>
					<?php }?>
					<?php }?>
				</ul>
			</dl>
		</div>

	</div>
		<!--图片放大器-->
		<div class="tb-gallery">
		<div class="tb-booth" id='bigPic'>
			<?php if($tag_data){?>
				<?php foreach($tag_data as $key => $item){?>
				<?php $right=$key*60?>
			 		<img src="<?php echo IUrl::creatUrl("")."".$item['img']."";?>" style='right:<?php echo isset($right)?$right:"";?>px' class="mark">
				<?php }?>
			<?php }?>
				
			<a target="_blank" rel="nofollow" href="" >
			<span class="ks-imagezoom-wrap">		
			
				<img id="J_ImgBooth"  name="bigpro"  src="" style='cursor:crosshair;'>
				<span class="ks-imagezoom-lens" style="position: absolute; border:1px solid blue;left:1px;"></span>
			</span>
			</a>
		</div>
		<div id='detShow' class="ks-overlay ks-imagezoom-viewer" style="width: 435px; height: 435px; left: 480px; top: 20px;display:none;">
			<div id="detPic" class="ks-overlay-content">
				<img style="position: absolute; top: 0px; left: 0px;" src="">
			</div>
		</div>
		<ul id="J_UlThumb" class="tb-thumb tm-clear">
			<?php if(count($photo)!=0){?>
			<?php foreach($photo as $key => $item){?>
			<li class="">
				<a href="#" onmouseover='showBig("<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/435/h/435");?>","<?php echo IUrl::creatUrl("")."".$item['img']."";?>")'>
					<img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/60/h/60");?>">
				</a>
			</li>
			<?php }?>
			<?php }else{?>
				<li class="">
					<a href="#" onclick='javascript:void(0)'>
						<img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/nopic_435_435.gif";?>">
					</a>
				</li>
			<?php }?>
		</ul>
		<div style="margin-top:10px;margin-left:50px;">			
			<!-- JiaThis Button BEGIN -->
				<style>
					.bdshare_popup_box{z-index:100000000;}
					.bdshare_dialog_box{z-index:100000000;}
					.bd_weixin_popup_bg{z-index:100000000;}
					.bd_weixin_popup{z-index:100000000;}
				</style>

				
			<div class="bdsharebuttonbox">
				<a href="#" class="bds_more" data-cmd="more">分享到：</a>
				<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博">新浪微博</a>
			</div>
			<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{"bdSize":16}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

<!-- JiaThis Button END -->
			<?php $cls=isset($favorite_id_arr)&&in_array($id,$favorite_id_arr) ? 'guanzhu' : 'quguan'?>
				<div class='<?php echo isset($cls)?$cls:"";?>' onclick='favorite_add(this)' style="line-height:26px;position:absolute; left:300px;bottom:1px; padding-left:17px; " id="gz"><a href='javascript:void(0)' onclick='favorite_add(this)'>我的关注：(<?php echo isset($favorite)?$favorite:"";?>人气)</a></div>
		</div>
	</div>

</div>
	
<script type='text/javascript'>
	$("#gz").click(function(){$(this).removeClass('quguan').addClass('guanzhu');});
</script>


<div class="wrapper clearfix container_2">

	<!--左边栏-->
	<div class="sidebar f_l">
		<?php if(isset($seller)){?>
		<!--商家-->
		<div class="box m_10">
			<div class="title"><a target='blank' href='<?php echo IUrl::creatUrl("/site/home/id/".$seller['id']."");?>'><?php echo isset($seller['true_name'])?$seller['true_name']:"";?></a></div>
			<div class="cont">
				<ul class="list">
					<?php $ave = statistics::getSellerGrade($seller['id']);$ave = $ave*70/5;?>
					<li style='background:none;'>评分：<span class="grade"><i style="width:<?php echo isset($ave)?$ave:"";?>px"></i></span></li>
					<li style='background:none;'>客服QQ:
						<a target="_blank" href="<?php echo Sonline::getChatUrl($seller['server_num']);?>" >
							<img border="0"  src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/qq.jpg";?>"/>
						</a>
					</li>
					<li style='background:none;'>
					<a class="btn_blue bold" href="<?php echo IUrl::creatUrl("/site/home/id/".$seller['id']."");?>" target="_blank">进入店铺</a>
					</li>
				</ul>
			</div>
		</div>
		<?php }?>
				<!--促销规则-->
		<div class="box m_10">
			<div class="title">促销活动</div>
			<div class="cont">
				<ul class="list">
				<?php foreach($promotion as $key => $item){?>
					<li><?php echo isset($item['info'])?$item['info']:"";?></li>
				<?php }?>
				</ul>
			</div>
		</div>
		<!--促销规则-->

		<!--购买推荐-->
		<?php if(isset($buyer_id) && $buyer_id){?>
				<div class="box m_10">
			<div class="title">购买本商品的用户还购买过</div>
			<div class="content" style='width:100%;'>
				<ul class="ranklist">
					<?php foreach(Api::run('getOrderGoodsByBuyerid',array('#buyer_id#',$buyer_id)) as $key => $item){?>
					<li class="current">
						<a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>" target="_blank"><img width="58px" height="58px" src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/58/h/58");?>"></a>
						<a title="<?php echo isset($item['name'])?$item['name']:"";?>" class="p_name" href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>" target="_blank"><?php echo isset($item['name'])?$item['name']:"";?></a>
						<b>￥<?php echo isset($item['price'])?$item['price']:"";?></b>
					</li>
					<?php }?>
				</ul>
			</div>
		</div>
		<?php }?>
				<!--购买推荐-->

		<!--热卖商品-->
		<div class="box m_10">
			<div class="title">热卖商品</div>
			<div class="content" style='width:100%;'>
				<ul class="ranklist">
					<?php foreach(Api::run('getCommendHot') as $key => $item){?>
									<li class="current">
						<a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>" target="_blank"><img width="58px" height="58px" alt="苹果" src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/58/h/58");?>" /></a>
						<a title="<?php echo isset($item['name'])?$item['name']:"";?>" class="p_name" href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>" target="_blank"><?php echo isset($item['name'])?$item['name']:"";?></a>
						<b>￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></b>
					</li>
					<?php }?>
				</ul>
			</div>
		</div>
		<!--热卖商品-->
	</div>

	<!--滑动面tab标签-->
	<div class="main f_r" style="overflow:hidden; width:950px;">

		<div class="uc_title" name="showButton">
			<label class="current"><span>商品详情</span></label>
			<?php if(($attribute)){?>
			<label class="spec"><span>规格参数</span></label>
			<?php }?>
			<label id='point'><span>顾客评价(<?php echo isset($comments)?$comments:"";?>)</span></label>
			<label id='buyHistory'><span>购买记录(<?php echo isset($buy_num)?$buy_num:"";?>)</span></label>
			<label><span>购买前咨询(<?php echo isset($refer)?$refer:"";?>)</span></label>
		</div>

		<div name="showBox">
			<!-- 商品详情 start -->
			<div>
				<ul class="saleinfos m_10 clearfix">
					<li>商品名称：<?php echo isset($name)?$name:"";?></li>

					<?php if(isset($brand) && $brand){?>
					<li>品牌：<?php echo isset($brand)?$brand:"";?></li>
					<?php }?>
					
					<?php if(isset($weight) && $weight){?>
					<li>商品毛重：<label id="data_weight"><?php echo isset($weight)?$weight:"";?></label></li>
					<?php }?>
					
					<?php if(isset($unit) && $unit){?>
					<li>单位：<?php echo isset($unit)?$unit:"";?></li>
					<?php }?>

					<?php if(isset($up_time) && $up_time){?>
					<li>上架时间：<?php echo isset($up_time)?$up_time:"";?></li>
					<?php }?>
					
					
				</ul>
				<?php if(isset($content) && $content){?>
				<div class="salebox">
					<strong class="saletitle block">产品描述：</strong>
					<p class="saledesc"><?php echo isset($content)?$content:"";?></p>
				</div>
				<?php }?>
			</div>
			<!-- 商品详情 end -->
			<?php if(($attribute)){?>
			<div id='spec_box' class='hidden'>
				<div>
				<ul class="saleinfos m_10 clearfix">
				
					<?php foreach($attribute as $key => $item){?>
					<li><?php echo isset($item['name'])?$item['name']:"";?>：<?php echo isset($item['attribute_value'])?$item['attribute_value']:"";?></li>
					<?php }?>
					
				</ul>
				</div>
			</div>
			<?php }?>
			<!-- 顾客评论 start -->
			<div class="hidden comment_list box">
				<div class="title3">
					<span class="f_r f12 light_gray normal">
						只有购买过该商品的用户才能进行评价
						<?php if(isset($this->user['user_id']) && $user_id = $this->user['user_id']){?>
						<?php foreach(Api::run('getCommentByGoodsid',array('#id#',$id),array('#user_id#',$user_id),1) as $key => $item){?>
						<a class="comm_btn" href="<?php echo IUrl::creatUrl("/site/comments/id/".$item['id']."");?>"  target="_blank">我要评论</a>
						<?php }?>
						<?php }?>
					</span>
					<img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/comm.gif";?>" width="16px" height="16px" />商品评论<span class="f12 normal">（已有<b class="red2"><?php echo isset($comments)?$comments:"";?></b>条）</span>
				</div>

				<div id='commentBox'></div>

				<!--评论JS模板-->
				<script type='text/html' id='commentRowTemplate'>
				<div class="item">
					<div class="user">
						<div class="ico">
							<a href="javascript:void(0)">
								<img src="<?php echo IUrl::creatUrl("")."<%=head_ico%>";?>" width="70px" height="70px" onerror="this.src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/user_ico.gif";?>'" />
							</a>
						</div>
						<span class="blue"><%=username%></span>
					</div>
					<dl class="desc">
						<% var widthPoint = 14 * point;%>
						<p class="clearfix">
							<b>评分：</b>
							<span class="grade"><i style="width:<%=widthPoint%>px"></i></span>
							<span class="light_gray"><%=comment_time%></span><label></label>
						</p>
						<hr />
						<p><b>评价：</b><span class="gray"><%=contents%></span></p>
						<%if(recontents){%>
						<p><b>回复：</b><span class="red"><%=recontents%></span></p>
						<%}%>
					</dl>
					<div class="corner b"></div>
				</div>
				<hr />
				</script>
			</div>
			<!-- 顾客评论 end -->

			<!-- 购买记录 start -->
			<div class="hidden box" >
				<div class="title3" >
					<img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/cart.gif";?>" width="16" height="16" alt="" />
					购买记录<span class="f12 normal">（已有<b class="red2"><?php echo isset($buy_num)?$buy_num:"";?></b>购买）</span>
				</div>

				<table width="100%" class="list_table m_10 mt_10">
					<col width="150" />
					<col width="120" />
					<col width="120" />
					<col width="150" />
					<col />
					<thead class="thead">
						<tr>
							<th>购买人</th>
							<th>出价</th>
							<th>数量</th>
							<th>购买时间</th>
							<th>状态</th>
						</tr>
					</thead>
				</table>

				<table width="100%" class="list_table m_10">
					<col width="150" />
					<col width="120" />
					<col width="120" />
					<col width="150" />
					<col />
					<tbody class="dashed" id="historyBox"></tbody>

					<!--购买历史js模板-->
					<script type='text/html' id='historyRowTemplate'>
					<tr>
						<td><%=show%></td>
						<td><%=goods_price%></td>
						<td class="bold orange"><%=goods_nums%></td>
						<td class="light_gray"><%=completion_time%></td>
						<td class="bold blue">成交</td>
					</tr>
					</script>
				</table>
			</div>
			<!-- 购买记录 end -->

			<!-- 购买前咨询 start -->
			<div class="hidden comment_list box">
				<div class="title3">
					<span class="f_r f12 normal"><a class="comm_btn" href="<?php echo IUrl::creatUrl("/site/consult/id/".$id."");?>" target="_blank">我要咨询</a></span>
					<img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/cart.gif";?>" width="16" height="16" />购买前咨询<span class="f12 normal">（共<b class="red2"><?php echo isset($refer)?$refer:"";?></b>记录）</span>
				</div>

				<div id='referBox'></div>

				<!--购买咨询JS模板-->
				<script type='text/html' id='referRowTemplate'>
				<div class="item">
					<div class="user">
						<div class="ico"><img src="<?php echo IUrl::creatUrl("")."<%=head_ico%>";?>" width="70px" height="70px" onerror="this.src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/user_ico.gif";?>'" /></div>
						<span class="blue"><%=username%></span>
						<p class="gray"><%=rtime%></p>
					</div>
					<dl class="desc gray">
						<p>
							<img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/ask.gif";?>" width="16px" height="17px" />
							<b>咨询内容：</b><span class="f_r"><%=time%></span>
						</p>
						<p class="indent"><%=question%></p>
						<hr />
						<%if(answer){%>
						<p class="bg_gray"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/answer.gif";?>" width="16px" height="17px" />
						<b class="orange"><?php echo $siteConfig->name;?>回复：</b><span class="f_r"><%=reply_time%></span></p>
						<p class="indent bg_gray"><%=answer%></p>
						<%}%>
					</dl>
					<div class="corner b"></div>
					<div class="corner tl"></div>
				</div>
				<hr />
				</script>
			</div>
			<!-- 购买前咨询 end -->

			
		</div>
	</div>
</div>
<script type='text/javascript' src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/area_show.js";?>'></script>
<script type="text/javascript">

$(function(){

//图片初始化
var goodsSmallPic = "<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/nopic_435_435.gif";?>";
var goodsBigPic   = "<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/front/nopic_435_435.gif";?>";

//存在图片数据时候
<?php if(isset($photo) && $photo){?>
goodsSmallPic = "<?php echo IUrl::creatUrl("")."";?><?php echo Thumb::get($photo[0]['img'],435,435);?>";
goodsBigPic   = "<?php echo IUrl::creatUrl("")."";?><?php echo isset($photo[0]['img'])?$photo[0]['img']:"";?>";
<?php }?>
$('#J_ImgBooth').attr('src',goodsSmallPic);
$('#detShow img').attr('src',goodsBigPic);

spec_show_obj.init(product);

//城市地域选择按钮事件
$('.sel_area').hover(
	function(){
		$('.area_box').show();
	},function(){
		$('.area_box').hide();
	}
);
$('.area_box').hover(
	function(){
		$('.area_box').show();
	},function(){
		$('.area_box').hide();
	}
);

//获取地址的ip地址
getAddress();

//生成商品价格
var priceHtml = template.render('priceTemplate',{"group_price":"<?php echo isset($group_price)?$group_price:"";?>","minSellPrice":"<?php echo isset($minSellPrice)?$minSellPrice:"";?>","maxSellPrice":"<?php echo isset($maxSellPrice)?$maxSellPrice:"";?>","sell_price":"<?php echo isset($sell_price)?$sell_price:"";?>","market_price":"<?php echo isset($market_price)?$market_price:"";?>"});
$('#price_panel').html(priceHtml);


//按钮绑定
$('[name="showButton"]>label').click(function(){
	$(this).siblings().removeClass('current');
	if($(this).hasClass('current') == false)
	{
		$(this).addClass('current');
	}
	$('[name="showBox"]>div').addClass('hidden');
	$('[name="showBox"]>div:eq('+$(this).index()+')').removeClass('hidden');
	var add = $('[name="showButton"]').find('.spec').length>0 ? 1 : 0;
	
			switch($(this).index())
			{
				case (1+add):
				{
					comment_ajax();
				}
				break;
		
				case (2+add):
				{
					history_ajax();
				}
				break;
		
				case (3+add):
				{
					refer_ajax();
				}
				break;
		
			}


});


});



//加载根据地域获取城市
function getAddress()
{
	//根据IP查询所在地
	var ipAddress = $.cookie('ipAddress');
	if(ipAddress)
	{
		searchDelivery(ipAddress);
	}
	else
	{
		$.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js',function(){
			ipAddress = remote_ip_info['province'];
			$.cookie('ipAddress',ipAddress);
			searchDelivery(ipAddress);
		});
	}
}



/**
 * 根据省份获取运费信息
 * @param province 省份名称
 */
function searchDelivery(province)
{
	var url = '<?php echo IUrl::creatUrl("/block/searchPrivice/random/@random@");?>';
	url = url.replace("@random@",Math.random);

	$.getJSON(url,{'province':province},function(json)
	{
		if(json.flag == 'success')
		{
			delivery(json.area_id,province);
		}
	});
}


/**
 * 获取评论数据
 * @page 分页数
 */
function comment_ajax(page)
{
	if(!page && $.trim($('#commentBox').text()))
	{
		return;
	}
	page = page ? page : 1;
	var url = '<?php echo IUrl::creatUrl("/site/comment_ajax/page/@page@/goods_id/".$id."");?>';
	url = url.replace("@page@",page);
	$.getJSON(url,function(json)
	{
		//清空评论数据
		$('#commentBox').empty();

		for(var item in json.data)
		{
			var commentHtml = template.render('commentRowTemplate',json.data[item]);
			$('#commentBox').append(commentHtml);
		}
		$('#commentBox').append(json.pageHtml);
	});
}

/**
 * 获取购买记录数据
 * @page 分页数
 */
function history_ajax(page)
{
	if(!page && $.trim($('#historyBox').text()))
	{
		return;
	}
	page = page ? page : 1;
	var url = '<?php echo IUrl::creatUrl("/site/history_ajax/page/@page@/goods_id/".$id."");?>';
	url = url.replace("@page@",page);
	$.getJSON(url,function(json)
	{
		//清空购买历史记录
		$('#historyBox').empty();
		$('#historyBox').parent().parent().find('.pages_bar').remove();

		for(var item in json.data)
		{
			var historyHtml = template.render('historyRowTemplate',json.data[item]);
			$('#historyBox').append(historyHtml);
		}
		$('#historyBox').parent().after(json.pageHtml);
	});
}

/**
 * 获取购买记录数据
 * @page 分页数
 */
function refer_ajax(page)
{
	if(!page && $.trim($('#referBox').text()))
	{
		return;
	}
	page = page ? page : 1;
	var url = '<?php echo IUrl::creatUrl("/site/refer_ajax/page/@page@/goods_id/".$id."");?>';
	url = url.replace("@page@",page);
	$.getJSON(url,function(json)
	{
		//清空评论数据
		$('#referBox').empty();

		for(var item in json.data)
		{
			var commentHtml = template.render('referRowTemplate',json.data[item]);
			$('#referBox').append(commentHtml);
		}
		$('#referBox').append(json.pageHtml);
	});
}

/**
 * 获取购买记录数据
 * @page 分页数
 */
function discuss_ajax(page)
{
	if(!page && $.trim($('#discussBox').text()))
	{
		return;
	}
	page = page ? page : 1;
	var url = '<?php echo IUrl::creatUrl("/site/discuss_ajax/page/@page@/goods_id/".$id."");?>';
	url = url.replace("@page@",page);
	$.getJSON(url,function(json)
	{
		//清空购买历史记录
		$('#discussBox').empty();
		$('#discussBox').parent().parent().find('.pages_bar').remove();

		for(var item in json.data)
		{
			var historyHtml = template.render('discussRowTemplate',json.data[item]);
			$('#discussBox').append(historyHtml);
		}
		$('#discussBox').parent().after(json.pageHtml);
	});
}





//添加收藏夹
function favorite_add(obj)
{
	<?php if(isset($this->user['user_id'])){?>
		$.getJSON('<?php echo IUrl::creatUrl("/simple/favorite_add");?>',{'goods_id':<?php echo isset($id)?$id:"";?>,'random':Math.random},function(content)
		{
			if(content.isError == false)
			{
				$(obj).text(content.message);
			}
			else
			{
				alert(content.message);
			}
		});
	<?php }else{?>
		window.location.href="<?php echo IUrl::creatUrl("/simple/login/?callback=/site/products/id/".$id."");?>";
	<?php }?>
}



</script>

</div>
	
