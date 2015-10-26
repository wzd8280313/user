<?php 
	$siteConfig = new Config("site_config");
	$callback = IReq::get('callback')?IReq::get('callback') :'/' 
?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">        
        <link rel="apple-touch-icon-precomposed" href="">
        <title>注册</title>
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
<script type="text/javascript">
var returnUrl = '<?php echo IUrl::creatUrl("".$callback."");?>';
var logPath = '<?php echo IUrl::creatUrl("/simple/login");?>';
var regPath = '<?php echo IUrl::creatUrl("/simple/reg_act");?>';
var checkPhoneIsOneUrl = '<?php echo IUrl::creatUrl("/simple/checkPhoneIsOne");?>';
var checkEmailIsOneUrl = '<?php echo IUrl::creatUrl("/simple/checkEmailIsOne");?>';
var getMobileCodeUrl = '<?php echo IUrl::creatUrl("/simple/getMobileValidateCode");?>';

</script>
    <body data-mps="PA4101">
        <div id="page">
            <header class="wap-header">
    <div class="wap-topbar">
        <div class="h-left"><a href="javascript:history.go(-1);" title="返回"></a></div>
        <div class="h-center">
            <h1>注册</h1>
        </div>
    </div>
</header><link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/loglist.css";?>">


  <div id="formbackground" style=" width:100%; height:100%; z-index:-1">  
	<img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/1-15010H20146430.jpg";?>"  width="100%"/>  
</div>                                   

<section class="reg-main">  

    <form id="register-form" class="reg-form" method="post" novalidate>
		<div class="reg-error-box" id='errorInfo'></div>
        <div class="field username">
            <div class="field-relative">
                <input id="mobile" class="reg-input icon-reg icon-reg-phone" type="text" name="mobile" onblur='showPhoneTipWhenBlur()' onfocus='hideErrInfo()' placeholder="请输入手机号" value="" autocomplete="off">
                <a href="javascript:void(0);" class="icon-reg reg-empty" title="清空" style="display:none;">清空</a>
            </div>
        </div>
        <div class="field code mt10">
            <div class="field-relative cf">
                <input id="code" class="reg-input reg-disabled fl" type="text" name="code" placeholder="请输入验证码" value="" onfocus='hideErrInfo()' autocomplete="off" maxlength="6" >
                <a href="javascript:void(0);" class="icon-reg reg-empty" title="清空" style="display:none;">清空</a>
                <a id="getCode" type="button" onclick='receiveCode()' class="receive_code  reg-btn dark-btn get-code get-code-register fr" >获取验证码</a>
            </div>
        </div>
        <div class="field psw mt10">
            <div class="field-relative">
                <input class="reg-input reg-disabled icon-reg icon-reg-psw" type="password" name="password" placeholder="请输入密码" onfocus='hideErrInfo()' value="" autocomplete="off" onpaste="return false;" oncopy="return false;" oncut="return false;" disabled="disabled">
                <a href="javascript:void(0);" class="icon-reg reg-empty" title="清空" style="display:none;">清空</a>
            </div>
        </div>
        <div class="field protocol">
            <input id="protocol" type="checkbox" checked="checked">
            <label for="protocol">我已阅读并同意<a id="toProtocol" href="<?php echo IUrl::creatUrl("/simple/help/id/58");?>">《用户注册协议》</a></label>
        </div>
        <div class="field submit-btn">
            <input type="button" id="registerBtn" class="reg-btn dark-btn" onclick='registerByPhoneSubmit()' value="注册">
        </div>
        <input type="hidden" id="relate" name="relate" value="">
    </form>
</section>
<input type="hidden" id="sendRedirect" name="sendRedirect" value="#">
<input type="hidden" id="referer" name="referer" value="">
<input type="hidden" id="relate" name="relate" value="">
<input type="hidden" id="is_app" value="">
<script src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/js/validate.min.js";?>"></script>
<script src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/js/user.js";?>"></script>
<script>
    $(function(){
        window.B5M_UC = {
            rootPath : '#'
        };
        wapReg.regFun();
    });
</script>        </div>
        <input type="hidden" id="is_login" name="is_login" value="">
        <input type="hidden" id="show_nav" value="1">
        <input type="hidden" data-isnew="" data-isold="" id="is_app" value="">
        <img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/images/files/hm.gif";?>" width="0" height="0">
        <script type="text/javascript" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/js/stat3.min.js";?>"></script>
		<div style="display: none;">
		<script type="text/javascript" async src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/javascript/js/h.js";?>"></script>
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