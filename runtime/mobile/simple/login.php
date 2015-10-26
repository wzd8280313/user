<?php 
	$siteConfig = new Config("site_config");
	$callback = IReq::get('callback')?IReq::get('callback') :'/' 
?>
<?php 
	$seo_data    = array();
	$site_config = new Config('site_config');
	$site_config = $site_config->getInfo();
	$seo_data['title'] = "用户登录_".$site_config['name'];
	seo::set($seo_data);
	$callback = IReq::get('callback')?IReq::get('callback') :'/ucenter/' ;
?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">        
        <link rel="apple-touch-icon-precomposed" href="">
        <title>登录</title>
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
		<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/center.css";?>" type="text/css">            
		<script src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/jquery-1.9.1.min.js";?>"></script>
		<script src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/common.js";?>"></script>     
		<script src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/reg/register.js";?>"></script>    
		<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/csshide1.css";?>">
		<style>#sell-ad{display:none!important;}</style>
		<script type="text/javascript">window.onerror=function(){return true;}</script></head>

    <body data-mps="PA4101">
        <div id="page">
            <header class="wap-header">
    <div class="wap-topbar">
        <div class="h-left"><a href="javascript:history.go(-1);" title="返回"></a></div>
        <div class="h-center">
            <h1>登录</h1>
        </div>
    </div>
</header>
<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/loglist.css";?>">
<script>
	var logPath = '<?php echo IUrl::creatUrl("/simple/login_act");?>';
	var checkErrTimesUrl = '<?php echo IUrl::creatUrl("/simple/checkErrTimes");?>';
	var returnUrl = '<?php echo IUrl::creatUrl("".$callback."");?>';
	var servicePhone = '<?php echo isset($site_config["phone"])?$site_config["phone"]:"";?>';
	

</script>
<section class="reg-main">
    <form id="login-form" class="reg-form" method="post" novalidate>
        <div class="field username  field-login field-login-username">
            <div class="field-relative">
                <input class="reg-input" type="text" name="username"  placeholder="请输入手机号/邮箱/用户名" value="" autocomplete="off"> 
                <a href="javascript:void(0);" class="icon-reg reg-empty" title="清空" style="display: none;">清空</a>
            </div>
        </div>
        <div class="field psw field-login field-login-psw">
            <div class="field-relative">
                <input class="reg-input" type="password" name="password" placeholder="请输入密码" value="" autocomplete="off" onpaste="return false;" oncopy="return false;" oncut="return false;"> 
                <a href="javascript:void(0);" class="icon-reg reg-empty" title="清空" style="display: none;">清空</a>
            </div>
        </div>
		 <div class="field valid_code_box  field-login" style='display:none;'>
            <div class="field-relative">
                <input class="reg-input" type="text" name="validCode" placeholder="请输入验证码" value="" autocomplete="off"> 
            </div>
				<span class="verify_code_box" style="margin: 0px 15px 0px 15px;"><img src='<?php echo IUrl::creatUrl("/simple/getCaptcha/w/122/h/55/s/15");?>' onclick="changeCaptcha('<?php echo IUrl::creatUrl("/simple/getCaptcha/w/122/h/55/s/15");?>')" id='captchaImg' /></span>
			
        </div>
		 		   
            <div class="field forget">
                <div class="reg-error-box" id='errorInfo'></div>
                <a href="<?php echo IUrl::creatUrl("/simple/find_password?tp=");?>" id="toForget">忘记密码？</a>
            </div>
                <div class="field submit-btn">
                    <input type="button" id="loginBtn" onclick='loginSubmit()' class="reg-btn dark-btn" value="登录">
                   <a href='<?php echo IUrl::creatUrl("simple/reg");?>'> <input type="button" id="regLink" class="reg-btn light-btn mt10" value="注册">  </a>                  
				</div>
    </form>
    
            <div class="other-login">
            <strong>第三方帐号快速登录</strong>
        </div>
        <div class="qq-login">
            <a href="" class="qq"><i>qq登录</i><p>qq登录</p>
            </a>
			<a  href="" class="yq"><i>无线阳泉</i><p>无线阳泉</p>
            </a>
            <a  href="" class="wx"><i>微信登录</i><p>微信登录</p>
            </a>
			
        </div>        
      
</section>
<input type="hidden" id="sendRedirect" name="sendRedirect" value="#">
<input type="hidden" id="referer" name="referer" value="">
<script src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/validate.min.js";?>"></script>
<script src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/user.js";?>"></script>

        </div>
        <input type="hidden" id="is_login" name="is_login" value="">
        <input type="hidden" id="show_nav" value="1">
        <input type="hidden" data-isnew="" data-isold="" id="is_app" value="">
        <img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/log_files/hm.gif";?>" width="0" height="0">
        <script type="text/javascript" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/stat3.min.js";?>"></script>
		<div style="display: none;">
		<script type="text/javascript" async src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/h.js";?>"></script>
		</div><img id="stat_image" src="log_files/__utm.gif" style="display: none;">

 
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