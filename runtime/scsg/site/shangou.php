<link href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/tm.css";?>" rel="stylesheet">

<div class="cnt w1190">

<style type="text/css">
	h1{font-family:"微软雅黑";font-size:20px;margin-top:20px;letter-spacing:2px;}

	.time-item strong{background:#C71C60;color:#fff;line-height:49px;font-size:18px;font-family:Arial;padding:0 5px;margin-right:5px;}
	.time-item a:hover{color:#c71c60}
	#day_show{float:left;line-height:49px;color:#c71c60;font-size:14px;margin:0 5px;font-family:Arial, Helvetica, sans-serif;}
	.item-title .unit{background:none;line-height:49px;font-size:12px;padding:0 5px;float:left;}
	
	.pp_tm_show li{
		position: relative;
		float: left;
		width: 435px;
		height: 300px;
		margin: 20px 10px 0 0;
		padding: 10px;
		border: 1px solid #ccc;
		background: #fff;overflow:hidden;
		font-size:16px;
		
	}
	.pp_tm_show li:hover {
		background: #f15a24;
		border: 1px solid #f15a24;
	}
	.pp_tm_show dd{margin-top:15px;}

	.pp_tm_show .pl{float:left;}
	.pp_tm_show .pr{float:right;}
	ul.shan_count li,b{display:inline;}
	ul.shan-all-li p.name{
		max-height: 38px;
    	overflow: hidden;
	}

</style>

<link rel="stylesheet" type="text/css" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/base.css";?>">
<link rel="stylesheet" type="text/css" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/index_sg.css";?>">
<script type="text/javascript" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/shan/shan.js";?>"></script>

		<div class="pp_tm_con">
				  <div class="pp_tm_con_fr"><a name="floor-1"></a>
					<h3>品牌闪购<i>TOP</i></h3>
				  </div>
			<div class="pp_tm_con_se">
				<div class="pp_tm_con_se_l">
				  <!--品牌特卖 -->
	<div class="shan-brand width">
		<input type='hidden' name='start' value='<?php echo isset($this->count)?$this->count:"";?>'/>
		<ul class="shan-all-li" style='width:1000px;'>
			<?php foreach($this->shan_list as $key => $item){?>
			<?php $end=strtotime($item['end_time'])?>
					<li  style="margin-top:0;float:left;">
						<dl>
							<dt class="brand-img">
								<a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['goods_id']."");?>"  target="_blank" title="<?php echo isset($item['goods_name'])?$item['goods_name']:"";?>">
									<img class="lazyload img"  src="<?php echo IUrl::creatUrl("".$item['shan_img']."");?>" alt="">
								</a>
							</dt>
							<dd>
								<div class="fl" style='width:220px;'>
									<p class="name">
										<a style='text-decoration:none' href="<?php echo IUrl::creatUrl("/site/products/id/".$item['goods_id']."");?>" title="<?php echo isset($item['goods_name'])?$item['goods_name']:"";?>" target="_blank"><?php echo isset($item['goods_name'])?$item['goods_name']:"";?></a>
									</p>
											<p class="explain" title="&#160;">
												<span class="gzmc_k"></span>
												<span class="gzmc_z"></span>
											</p>
											<p class="prom" title="">
												<?php $zhe = 10*round($item['award_value']/$item['sell_price'],2)?>
													<span class="dazhe"><?php echo isset($zhe)?$zhe:"";?></span>折
											</p>
								</div>
								<div class="fr">
									<p class="brand-logo"></p>
									<p class="surplus countdown" id="timeRemaining-<?php echo isset($key)?$key:"";?>">
									剩余 
										<span id='cd_day_<?php echo isset($key)?$key:"";?>'></span>天
										<span id='cd_hour_<?php echo isset($key)?$key:"";?>'></span>小时
										<span id='cd_minute_<?php echo isset($key)?$key:"";?>'></span>分
										<span id='cd_second_<?php echo isset($key)?$key:"";?>'></span>秒	
										<input name='endTime' type='hidden' value='<?php echo isset($end)?$end:"";?>' />
									</p>
								<div class="clear"></div>
							</dd>
						</dl>
						<div class="brand-icon" id="brandsale_sold-out-_0">
							<div class="clear"></div>
						</div>
						
					</li>
					
				<?php }?>
		</ul>

<div class="clear"></div>
		</div>
<script type="text/javascript" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javsscript/jquery.lazyload.js";?>">
</script>

				</div>

				<div class="pp_tm_con_se_r">
			  <div class="tm_cn">
				<img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/shan/tm_t1.jpg";?>" width="246" height="40">
				<img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/shan/tm_07.jpg";?>" width="246" height="132">
				<img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/shan/tm_08.jpg";?>" width="246" height="146">
			  </div>
					
				<div class="tm_wb"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/shan/tm_wb_20.jpg";?>" width="248" height="120"></div>
					
			</div>
					<div class="clear"></div>
		  </div>
	
	
	</div>
</div>
		<div class="pp_tm_con"><br/>
				  
				  <div class="pp_tm_con_se">
					<div class="pp_tm_con_se_l" id="brandlist">
						
						<div class="next_more" style='margin-top:20px;'>
						
							<span class="next_more_btn" id="nextgroup" onclick="loadPromotion('<?php echo IUrl::creatUrl("/site/getMoreShan");?>');">
								<span class="next_more_text">查看下一组</span>
							</span>
						</div>        
					</div>
				</div>
					<div class="clear"></div>
				  </div>
				</div>
    
 
</div>
<script type='text/html' id='promotion_box'>
	<li  style="margin-top:0;float:left;">
		<dl>
			<dt class="brand-img">
				<a href="<?php echo IUrl::creatUrl("/site/products/id/");?>/<%=goods_id%>"  target="_blank" title="<%=goods_name%>">
					<img class="lazyload img"  src="<?php echo IUrl::creatUrl("<%=shan_img%>");?>" alt="">
				</a>
			</dt>
			<dd>
				<div class="fl" style='width:220px;'>
					<p class="name">
						<a style='text-decoration:none' href="<?php echo IUrl::creatUrl("/site/products/id/");?>/<%=goods_id%>" title="<%=goods_name%>" target="_blank"><%=goods_name%></a>
					</p>
							<p class="explain" title="&#160;">
								<span class="gzmc_k"></span>
								<span class="gzmc_z"></span>
							</p>
							<p class="prom" title="">
								
									<span class="dazhe"><%=zhe%></span>折
							</p>
				</div>
				<div class="fr">
					<p class="brand-logo"></p>
					<p class="surplus countdown" id="timeRemaining-<%=key%>">
					剩余 
						<span id='cd_day_<%=key%>'></span>天
						<span id='cd_hour_<%=key%>'></span>小时
						<span id='cd_minute_<%=key%>'></span>分
						<span id='cd_second_<%=key%>'></span>秒	
						<input name='endTime' type='hidden' value='<%=end%>' />
					</p>
				<div class="clear"></div>
			</dd>
		</dl>
		<div class="brand-icon" id="brandsale_sold-out-_0">
			<div class="clear"></div>
		</div>
	</li>
</script>