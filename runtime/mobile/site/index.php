<!DOCTYPE html>
<!-- saved from url=(0017)http://m.#.com/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">        
        <link rel="apple-touch-icon-precomposed" href="http://static-web.#.com/wap/img/collect-logo/#-collect-logo.png">
        <title>山城速购</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no, email=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <!-- uc强制竖屏 -->
        <meta name="screen-orientation" content="portrait">
        <meta name="full-screen" content="yes">
        <meta name="browsermode" content="application">
        <!-- QQ强制竖屏 -->
        <meta name="x5-orientation" content="portrait">
        <meta name="x5-fullscreen" content="true">
        <meta name="x5-page-mode" content="app">
        <meta name="keywords" content="山城速购">
        <meta name="description" content="山城速购">
        <link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/common.css";?>" type="text/css">
		<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/index.css";?>" type="text/css">
		<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/dialog.css";?>" type="text/css">
		<script src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/jquery-1.9.1.min.js";?>'></script>
		<script src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/touchslider.min.js";?>'></script>
		<script src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/index.js";?>'></script>
		<script src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/imglazyload.js";?>'></script>
		<script src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/common.js";?>'></script>
		<script src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/scrollTop.js";?>'></script>
		<script src='<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/dialog.js";?>'></script>            
		</head>

    <body data-mps="PA4101">
        <div id="page">
      <section class="search_wrap ">
        <div class="search_title">
            <div class="logo">
                <a href="<?php echo IUrl::creatUrl("/site/category?");?>">
				<img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/wap/top_nav_order_icon.png";?>" style="width:25px;height:25px;"></a>
            </div>
            <div class="search_input_wrap">
			<a href="<?php echo IUrl::creatUrl("/site/search");?>"class="search_input_wrap_a">
                <form id="sForm" action="list.html" method="get">
                    <input type="text" name="keyword" id="keyword" class="search_input" value="" placeholder="你要的，就在这里~">
                    <input type="submit" class="search_icon" value="">
                </form>
			</a>
            </div>
            <a href="<?php echo IUrl::creatUrl("/site/mail");?>" class="search_nav_icon_none">
			<img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/wap/app_mail_nav.png";?>" style="width:35px;height:35px;"></a>

        </div>
        <style>
        	
        </style>
  
    </section>
    <div class="search_placeholder"></div>
    <div class="search_placeholder"></div>
    <div style="height:60px;"></div>
    
<!--banner-->
<section class="banner" style="overflow: hidden; visibility: visible; list-style: none; position: relative;">
     

		<ul class="homebanner" id="pro-banner" style="position: relative; overflow: hidden; -webkit-transition: left 600ms ease; transition: left 600ms ease; width: 7420px; left: 0px;">
               <?php foreach($this->index_slide as $key => $item){?>
			   <?php $num=$key;?>
			    <li style="float: left; display: block; width: 1855px;">
                    <a href="<?php echo IUrl::creatUrl("")."".$item['url']."";?>">
                        <img src="<?php echo IUrl::creatUrl("")."".$item['img']."";?>">
                    </a>
                </li>
				<?php }?>
         </ul>

        <div class="slider-page">
                <span class="cur"></span>
				<?php for($i = 1 ; $i<=$num ; $i = $i+1){?>
                <span class=""></span>
				<?php }?>
        </div>
</section>
<section class="top_menu">
    <ul class="clear-fix">

        <li class="fl">
            <a href="<?php echo IUrl::creatUrl("/simple/reg?callback=");?>">
                <i class="icon_0_reg"></i>
                <span>注册有礼</span>
            </a>
        </li>

        <li class="fl">
            <a href="<?php echo IUrl::creatUrl("/ucenter");?>">
                <i class="icon_2_wd"></i>
                <span>我的山城</span>
            </a>
        </li>

        <li class="fl">
            <a href="<?php echo IUrl::creatUrl("/ucenter/order");?>">
                <i class="icon_3"></i>
                <span>我的订单</span>
            </a>
        </li>


        <li class="fl">
            <a href="<?php echo IUrl::creatUrl("/ucenter/favorite");?>">
                <i class="icon_7"></i>
                <span>我的关注</span>
            </a>
        </li>

         <li class="fl">
            <a href="<?php echo IUrl::creatUrl("/site/tuangou");?>">
                <i class="icon_4_qwds"></i>
                <span>山城团购</span>
            </a>
        </li>

         <li class="fl">
            <a href="<?php echo IUrl::creatUrl("/pregoods/presell_list");?>">
                <i class="icon_5"></i>
                <span>山城预售</span>
            </a>
        </li>

         <li class="fl">
            <a href="<?php echo IUrl::creatUrl("/simple/cart?");?>">
                <i class="icon_1"></i>
                <span>购物车</span>
            </a>
        </li>

         <li class="fl">
            <a href="<?php echo IUrl::creatUrl("/site/category");?>">
                <i class="icon_6"></i>
                <span>分类查询</span>
            </a>
        </li>

    </ul>
</section>
    <section class="suggestion">
        <header class="title clear-fix">
            <h2 class="fl">掌上团购</h2>
            <span class="fl"></span>
        </header>
        <div class="content">
            <ul class="clear-fix">
            	<?php foreach(Api::run('getRegimentList','3') as $key => $item){?>
                     <li class="fl">
                        <a href="<?php echo IUrl::creatUrl("/site/tuan_product/active/".$item['id']."");?>}">
                            <div class="img_wrap">
                                <img src="<?php echo IUrl::creatUrl("".$item['img']."");?>">
                            </div>
                            <div class="price_wrap">
                                <strong>￥<?php echo isset($item['regiment_price'])?$item['regiment_price']:"";?></strong>
                                <del>￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></del>
                            </div>
                        </a>
                    </li>
				<?php }?>
             </ul>
        </div>
    </section>
	
	<section class="activity_floor">
		<?php echo Ad::show("手机端首页");?>
	</section>
    <section class="activity_floor">
		<header class="title clear-fix">
            <h2 class="fl">加盟商户</h2>
        </header>
		<?php $seller=Api::run('getSellerList2');?>
        <div class="first_floor clear-fix">
            <div class="left fl">

            	<?php for($i = 0 ; $i<=1 ; $i = $i+1){?>
                 <div class="top" style='border-bottom: 1px solid #eee;'>
                    <a href="javascript:voie(0)"><img src="<?php echo IUrl::creatUrl("".$seller[$i]['logo_img']."");?>"></a>
               	 </div>
               	<?php }?>
            </div>
            <div class="right fl">
            	<?php for($i = 2 ; $i<=3 ; $i = $i+1){?>
                 <div class="top">
                    <a href="javascript:voie(0)"><img src="<?php echo IUrl::creatUrl("".$seller[$i]['logo_img']."");?>"></a>
               	 </div>
				 <?php }?>
             </div>

        </div>
		
		<header class="title clear-fix">
            <h2 class="fl">商品分类</h2>
        </header>
        <div class="second_floor">
            <ul class="clear-fix">

            	<?php foreach(Api::run('getCategoryListTop',6) as $key => $item){?>
                <li class="fl" style='width:33%;'>       
					 <a href="<?php echo IUrl::creatUrl("site/pro_list/cat/".$item['id']."");?>">
					 <img src="<?php echo IUrl::creatUrl("".$item['img']."");?>">
					 </a>
				</li>
				<?php }?>

            </ul>
        </div>
    </section>
    <section class="guess_u_like">
        <header class="title clear-fix">
            <h2 class="fl">猜你喜欢</h2>
            <span class="fr"></span>
        </header>
        <div class="content">
            <ul class="clear-fix">
            	<?php foreach($this->user_like_goods as $key => $item){?>
              <li class="fl">
               			 <a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>" class="goods-one">
                   			 <div class="li-wrap">
								<div class="img_wrap">
                         		   <img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/170/h/170");?>">
                       			 </div>
                       			  <p><?php echo isset($item['name'])?$item['name']:"";?></p>
                              		  <div class="price_wrap clear-fix">
                                 		   <strong>￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></strong>
                                       </div>
                           	 </div>
                        </a>

                 </li>
				 <?php }?>
             </ul>

        </div>
        <div class="loading-ctn loading-imgS">
            <p>下拉查看更多</p>
            <img alt="" src="files/loading.gif">
        </div>
    </section>
    <!-- <input type="hidden" id="count" name="count" value="26"> -->

        </div>
        <input type="hidden" id="is_login" name="is_login" value="">
        <input type="hidden" data-isnew="" data-isold="" id="is_app" value="">
                <img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/files/hm.gif";?>" width="0" height="0">
        <script type="text/javascript" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/jsstat3.min.js";?>"></script>
		<div style="display: none;">
		<script type="text/javascript" async="" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/h.js";?>"></script>
		</div>
		<img id="stat_image" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/files/__utm.gif";?>" style="display: none;">

   <footer id="footer">
	<div class="f-qk-tl">
		<?php if(!isset($this->user)){?>
		<div class="f-login">
			<a href="<?php echo IUrl::creatUrl("/simple/login?callback=");?>">登录</a><span>|</span>
			<a href="<?php echo IUrl::creatUrl("/simple/reg?callback=");?>">注册</a>
		<!--<div class="f-go-top" id="goTop"><a href="#">TOP</a></div>-->
		</div>
		<?php }?>
	</div>
	<div class="f-ch-cp">
		<div class="item">
		<a href="<?php echo IUrl::creatUrl("/site/index/client/pc");?>">桌面版</a></div>
		<div class="item"><span class="copyright_1">Copyright</span> <span class="copyright_2">2012-2015</span><span class="copyright_3">NAI.COM</span><span class="copyright_4">版权所有</span></div></div>
</footer>

<!--底部浮动-->
		<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/bottom_nav.css";?>" type="text/css"/> 

     <section class="sr-s">
            <div class="s-btn" data="sales">
				<a href="<?php echo IUrl::creatUrl("/site/index?callback=");?>">
              <img  src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/m_xiabiao/imgs1.png";?>" width="50" height="50" alt="首页"></a>
            </div>
            <div class="s-btn" data="price">
				<a href="<?php echo IUrl::creatUrl("/site/category?");?>"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/m_xiabiao/img2.png";?>" width="50" height="50" alt="分类"></a>
            </div>
            <div class="s-btn" data="hot">
				<a href="<?php echo IUrl::creatUrl("/site/tuangou");?>"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/m_xiabiao/img3.png";?>" width="50" height="50" alt="团购"></a>
            </div>
            <div class="s-btn" data="default">
				<a href="<?php echo IUrl::creatUrl("/simple/cart?callback=");?>"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/m_xiabiao/img4.png";?>" width="50" height="50" alt="购物车"></a>
            </div>
            <div class="s-btn" data="default">
				<a href="<?php echo IUrl::creatUrl("/ucenter");?>"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/m_xiabiao/img5.png";?>" width="50" height="50" alt="我的山城"></a>
            </div>
        </section>

</body></html> 

