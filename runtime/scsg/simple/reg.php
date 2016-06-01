<?php 
	$siteConfig = new Config("site_config");
	$callback = IReq::get('callback')?IReq::get('callback') :'/' 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="tp_page" content="3.0">
<title><?php echo $siteConfig->name;?></title>
<script type="text/javascript" charset="UTF-8" src="/iweb2/runtime/_systemjs/jquery/jquery-1.11.3.min.js"></script><script type="text/javascript" charset="UTF-8" src="/iweb2/runtime/_systemjs/jquery/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/reg/jquery.cookie.js";?>"></script>
<script type="text/javascript" async="" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/reg/captcha.js";?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/reg/layer.css";?>" id="skinlayercss"></head>
<link type="text/css" rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/log.css";?>">
<body style="text-align:left;">
	    <link rel="shortcut icon" href="#">
	
  <div class="regist_header clearfix">
	<div class="wrap">
        <a href="<?php echo IUrl::creatUrl("/");?>" class="logo"><img src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/reg/loginlogo.png";?>" height="55" alt=""></a>
        <div class="regist_header_right clearfix">
        	<!--<a href="#" class="english_edition" id="edition" style="display:none">English</a>-->
            <div class="help_wrap">
                <a class="hd_menu" href="#" target="_blank"><s class="help_ico"></s>帮助中心</a>
                <div class="hd_menu_list">
                    <ul>
                        <li><a href="<?php echo IUrl::creatUrl("/site/help_list/id/9");?>" target="_blank">常见问题</a></li>
                        <li><a href="<?php echo IUrl::creatUrl("/site/help_list/id/4");?>" target="_blank">支付帮助</a></li>
                        <li><a href="<?php echo IUrl::creatUrl("/site/help_list/id/6");?>" target="_blank">配送范围</a></li>
                    </ul>
                </div>
            </div>
            <span class="fr">您好，欢迎光临山城速购！ <a href="<?php echo IUrl::creatUrl("/simple/login");?>" class="blue_link">请登录</a></span>
        </div>
    </div>
  </div>

   <?php $seo_data=array(); $site_config=new Config('site_config');$site_config=$site_config->getInfo();?>
<?php $seo_data['title']="用户注册_".$site_config['name']?>
<?php seo::set($seo_data);?>
<link type="text/css" rel="stylesheet" href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/reg/layer.css";?>" id="skinlayercss"></head>
<link href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/reg/register-2.0.css";?>" rel="stylesheet" type="text/css">
<script src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/reg/register.js";?>" type="text/javascript"></script>

	
  
<div class="regist_wrap">
    <div class="mod_regist_wrap">
    	<div class="regist_border clearfix">
        	<div class="regist_left">
	        	<input type="hidden" name="activities" value="0" id="activities">
	        	<input type="hidden" id="lockEmail" name="lockEmail" value="0">
	        	
	        	<input id="emailValidateSig" type="hidden" value="tvxzlk6RYdjICwzP5QRWnhe4CaVJIbdpJ8XVHFjpuV5MChP3">
	        	<input id="validateSig" type="hidden">
	        	
	        	<input type="hidden" name="returnUrl" value="" id="returnUrl">
	        	 <div class="regist_tab">
	                <ul class="clearfix">
	                    <li class="cur"><i class="r_mobile"></i><span>手机注册</span></li>
	                    <li><i class="r_mail"></i><span>邮箱注册</span></li>
	                </ul>
	                <p class="cur_tab cur" style="left: 0px;"><em></em></p>
	            </div>
	            
	            <div class="regist_form mobile_register_form" style="display: block;">
                    <ul class="clearfix">
                        <li>
                            <div class="form_item">
                                <label>手机号：</label>
                                <input type="text" class="ipt gay_text ipt_phone" value="请输入手机号码" id="phone" onkeyup="showPhoneTipWhenKeyUp();" onfocus="hideOtherTips(&#39;phone&#39;)">
                            </div>
                            <div class="tips_box regist_tips" id="phone_tip">
                                <u></u>
                                                                                      请填写正确的手机号码，以便 接收订单通知，找回密码等。
                            </div>
                            <div class="tips_box regist_tips_error" id="phone_error"></div>
                            <div class="tips_box username_ok" id="phone_desc"></div>
                        </li>
                        <li class="clearfix recv_mobile_code">
                        	<div class="code_wrap">
	                        	<div class="mb_code_box">
                                    <div class="form_item">
		                                <label>验证码：</label>
		                                <input type="text" class="ipt gay_text ipt_phonecode" value="6位验证码" id="validPhoneCode" onkeydown="showoff(&#39;validPhoneCode_wrong&#39;);" maxlength="6">
		                                <span class="code_right" id="validPhoneCode_right"></span>
		                                <span class="code_wrong" id="validPhoneCode_wrong" style="display:none"></span>
		                            </div>
		                            <a href="javascript:" tabindex="-1" class="receive_code reacquire_code">获取验证码</a>
		                            <div class="form_item form_item2">
                                        <input type="text" tabindex="-1" id="validCodeMobile" class="ipt gay_text ipt_code" value="验证码" maxlength="4" onblur="javascript: checkValidCodeOnBlurForMobileRegister()" onkeyup="javascript: checkRegisterParamForMobile();" onfocus="javascript: checkValidCodeOnFocusForMobileRegister()">
                                        <span class="code_right" id="m_code_right" style="display:none"></span>
                                        <span class="code_wrong" id="m_code_wrong"></span>
                                    </div>
                                    <span class="check_code">
                                        <img name="valid_code_pic">
                                        <i class="btn_change" tabindex="-1" onclick="refresh_valid_code();return false;">换一张</i>
                                    </span>
	                            </div>
                            </div>
                            <div id="mobile_validcode_error" class="tips_box">
                                <u></u><p></p>
                            </div>
                            <div class="tips_box regist_tips">
                                <u></u>如无法接收验证码，请重启手机并确认短信未被拦截！4G用户请关闭4G网络进行接收！
                            </div>
                        </li>

                        <li>
                            <div class="form_item">
                                <label>设置密码：</label>
                                <input type="text" class="ipt gay_text" name="pwd" value="6-20个大小写英文字母、符号或数字">
                                <input type="password" class="ipt password none" id="password_mobile" name="user.password" oncopy="return false;" oncut="return false;" onpaste="return false;" onblur="checkPasswordOnBlur(&#39;password_mobile&#39;);" onfocus="passwordOnFocus(&#39;password_mobile&#39;);" onkeyup="changePassStrong(&#39;password_mobile&#39;);">
                            </div>
                            <div class="tips_box regist_tips_error" id="password_mobile_error">
                            </div>
                            <div class="tips_box paswd_strength" id="password_mobile_Level">
                                <i id="arrow_mobile" style="-webkit-transform: rotate(0deg);-webkit-transform:rotate(0deg);"></i>
                            </div>
                        </li>
                        <li>
                            <div class="form_item">
                                <label>确认密码：</label>
                                <input type="text" class="ipt gay_text" name="pwd" value="请再次输入密码">
                                <input type="password" class="ipt password none" id="password_mobile2" name="password2" onblur="checkPassword2OnBlur(&#39;password_mobile&#39;);" oncopy="return false;" oncut="return false;" onpaste="return false;" onfocus="hideOtherTips(&#39;password_mobile2&#39;)" onkeyup="showoff(&#39;password_mobile2_desc&#39;);showoff(&#39;password_mobile2_error&#39;)" readonly="readonly" style="background-color: rgb(192, 193, 196);">
                                <div class="tips_box regist_tips_error" id="password_mobile2_error">
                            	</div>
								<div class="tips_box username_ok" id="password_mobile2_desc"></div>
                            </div>
                        </li>
                        <!--
                        <li class="service_agreement">
                            <a href="#" class="check_agreement">我已阅读并同意 《<a href="#" class="blue_link" target="_blank">山城速购服务协议</a>》</a>
                            <div class="tips_box agreement_tips">
                            </div>
                        </li>
                        -->
                        
                        <li class="service_agreement">点击注册，表示您同意山城速购
                            <a href="<?php echo IUrl::creatUrl("/site/help/id/58");?>" class="blue_link" target="_blank">《服务协议》</a>
                        </li>
                        
                        <li class="regist_btn">
                            <button id="phone_btn" type="button" onclick="javascript:registerByPhoneSubmit();return false;">注册</button>
                        </li>
                    </ul>
                </div>
	          
	            
	            <div class="regist_form email_register_form none" style="display: none;">
	                <ul class="clearfix">
	                    <li>
	                        <div class="form_item">
	                            <label>邮箱：</label>
	                            <input type="text" class="ipt gay_text ipt_username" value="请输入邮箱地址" id="email" name="user.email" autocomplete="off" maxlength="100" onkeyup="showoff(&#39;email_desc&#39;);" onblur="checkEmailOnBlur();" onfocus="hideOtherTips(&#39;email&#39;)" ;="">
	                        </div>
	                        <div class="tips_box regist_tips" id="email_tip">
	                            <u></u>
	                           	 请填写正确的常用邮箱地址，以便 接收订单通知，找回密码等。
	                        </div>
	                        <div class="tips_box regist_tips_error" id="email_error"></div>
	                        <div class="tips_box username_ok" id="email_desc"></div>
	                    </li>
	                    <li>
	                        <div class="form_item">
	                            <label>设置密码：</label>
	                            <input type="text" class="ipt gay_text" name="pwd" value="6-20个大小写英文字母、符号或数字">
	                            <input type="password" class="ipt password none" id="password_email" name="user.password" oncopy="return false;" oncut="return false;" onpaste="return false;" onkeyup="changePassStrong(&#39;password_email&#39;);">
	                        </div>
	                        <div class="tips_box regist_tips_error" id="password_email_error">
	                        </div>
	                        <div class="tips_box paswd_strength" id="password_email_Level">
	                            <i id="arrow_email" style="-webkit-transform: rotate(0deg);"></i>
	                        </div>
	                    </li>
	                    <li>
	                        <div class="form_item">
	                            <label>确认密码：</label>
	                            <input type="text" class="ipt gay_text" name="pwd" value="请再次输入密码">
	                            <input type="password" class="ipt password none" id="password_email2" name="password2" onblur="checkPassword2OnBlur(&#39;password_email&#39;);" oncopy="return false;" oncut="return false;" onpaste="return false;" onfocus="hideOtherTips(&#39;password_email2&#39;)" onkeyup="showoff(&#39;password_email2_desc&#39;);showoff(&#39;password_email2_error&#39;)" readonly="readonly" style="background-color: rgb(192, 193, 196);">
	                        	<div class="tips_box regist_tips_error" id="password_email2_error">
	                        	</div>
								<div class="tips_box username_ok" id="password_email2_desc"></div>
	                        </div>
	                    </li>
	                    
	                    
	                    <li class="phone_num_wrap">
	                        <div class="form_item">
	                            <label>手机号：</label>
	                            <input type="text" class="ipt gay_text phone_num" value="请输入手机号">
	                        </div>
	                        <div class="tips_box regist_tips_error" id="ephoneDesc">
	                        	<u></u>该手机号已存在，<a href="#" class="blue_link">登录</a>
	                        </div>
	                    </li>
	                    <li class="verify_code cur_right img_code" style="display: none;">
	                        <div class="form_item">
	                            <label>验证码：</label>
	                            <input type="text" id="validCodeEmail" class="ipt ipt_code gay_text" value="" tabindex="1">
	                            <!--验证码正确-->
	                            <span class="code_right" tabindex="-1" style="display: none;"></span>
	                            <!--验证码错误-->
	                            <span class="code_wrong" tabindex="-1"></span>
	                        </div>
	                        <span class="verify_code_box" tabindex="-1"><img name="valid_code_pic" tabindex="-1" src="reg/getjpg.do"></span>
	                        <i class="change_code" tabindex="-1">换一张</i>
	                    </li>
	                    <!--手机验证码 begin -->
	                    <li class="verify_code phone_code clearfix" style="display: list-item;">
	                        <div class="form_item">
	                            <label>验证码：</label>
	                            <input type="text" class="ipt ipt_code gay_text" value="" tabindex="1">
	                            <!--验证码正确-->
	                            <span class="code_right" tabindex="-1"></span>
	                            <!--验证码错误-->
	                            <span class="code_wrong" id="validPhoneCodewrong" tabindex="-1"></span>
	                        </div>
	                        <a href="javascript: void(0);" class="receive_code reacquire_code">获取验证码</a>
	                        <div id="emial_validcode_error" class="tips_box">
                                <u></u><p></p>
                            </div>
	                        <div class="tips_box regist_tips">
                                <u></u>如无法接收验证码，请重启手机并确认短信未被拦截！4G用户请关闭4G网络进行接收！
                            </div>
	                    </li>
	                    
	                    <!--
	                    <li class="service_agreement">
	                        <a href="#" class="check_agreement">我已阅读并同意 《<a href="#" class="blue_link" target="_blank">山城速购服务协议</a>》</a>
	                        <div class="tips_box agreement_tips">
	                            <u></u><p></p>
	                        </div>
	                    </li>
	                    -->
	                    <li class="service_agreement">点击注册，表示您同意山城速购
	                    	<a href="#" class="blue_link" target="_blank">《服务协议》</a>
	                    </li>
	                    <li class="regist_btn">
	                        <button id="email_btn" type="button" onclick="javascript:registerSubmit();return false;">注册</button>
	                    </li>
	                </ul>
	            </div>
            </div>
            
        </div>
	</div>
	
</div>

<script id="regist_popWin" type="text/viewscript">
<!--注册成功begin -->
<div class="regist_success regist_popWin" style="display: none;">
    <div class="regist_popWin_con">
        <!--title-->
        <div class="regist_popWin_title">
            <a href="javascript:void(0)" class="regist_popWin_closeBtn"></a>
        </div>
        <!--/title-->
        <!--con-->
        <div class="regist_popWin_Info clearfix">
            <div class="regist_popWin_main">
                <div class="regist_popWin_mainCon">
                    <p class="tit"><i></i>注册成功</p>
                </div>
            </div>
        </div>
        <!--/con-->
        <div class="popWin_tips">
            <span>3</span>s后跳转至首页
        </div>
    </div>
</div>
<!--注册成功end -->
</script>
<script type="text/javascript">
var returnUrl = '<?php echo IUrl::creatUrl("".$callback."");?>';
var logPath = '<?php echo IUrl::creatUrl("/simple/login");?>';
var regPath = '<?php echo IUrl::creatUrl("/simple/reg_act");?>';
var checkPhoneIsOneUrl = '<?php echo IUrl::creatUrl("/simple/checkPhoneIsOne");?>';
var checkEmailIsOneUrl = '<?php echo IUrl::creatUrl("/simple/checkEmailIsOne");?>';
var getMobileCodeUrl = '<?php echo IUrl::creatUrl("/simple/getMobileValidateCode");?>';

var showValidCodeWhenRegistByMobile = 0; 
	var registerValidateUserBehaviorSwitcher = 1;
	var showValidCodeWhenRegistByEmail = 0; 	$(".email_register_form .img_code").hide();
	$(".phone_code").show();
	jsRegistFed.loadFunRegist();
	$(document).ready(function(){
		onload();
		loadImageUrl("2","Passport_Register_Ad_Click");
		bindEvent();
		refresh_valid_code(window, email_captcha_callback);
	});
</script>
<div class="tips">错误信息<br>文字文字</div>



<div  class="copyright">
			<div class="footer" style="text-align:center">
				<p class="links">
					<a href="<?php echo IUrl::creatUrl("/site/help/id/69");?>" target="_blank">关于我们</a>|
					<a href="<?php echo IUrl::creatUrl("/site/help_list/id/9");?>" target="_blank">常见问题</a>|
					<a href="<?php echo IUrl::creatUrl("/site/help_list");?>" target="_blank">安全交易</a>|
					<a href="<?php echo IUrl::creatUrl("/site/help/id/54");?>" target="_blank">购买流程</a>|
					<a href="<?php echo IUrl::creatUrl("/site/help_list/id/4");?>" target="_blank">如何付款</a>|
					<a href="<?php echo IUrl::creatUrl("/site/help/id/70");?>" target="_blank">联系我们</a>|
					<a href="<?php echo IUrl::creatUrl("/site/help_list/id/9");?>" target="_blank">合作提案</a>
				</p>
				<p class="copyright">Powered by 
					<a href="http://www.nainaiwang.com/" target="_blank">耐耐云商科技</a>
				</p>Copyright © 2005-2014 
				<a class="copyys" target="_blank" href="http://www.miibeian.gov.cn/" target="_blank">晋ICP备01000010号</a>
			</div>
		</div>
		

<script type="text/javascript" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/reg/global_tracker.js";?>"></script>

	<script type="text/javascript" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/reg/api.js";?>"></script>

<script type='text/javascript' >
//切换验证码
function changeCaptcha(urlVal)
{
	var radom = Math.random();
	if( urlVal.indexOf("?") == -1 )
	{
		urlVal = urlVal+'/'+radom;
	}
	else
	{
		urlVal = urlVal + '&random'+radom;
	}
	$('#captchaImg').attr('src',urlVal);
}
</script>

<script src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/reg/layer-lib.js";?>" type="text/javascript"></script>

<script src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/reg/layer.min.js";?>" type="text/javascript"></script>

<div id="__yct_container__" style="display: none; visibility: hidden;"><script src=""></script></div><input type="hidden" id="__yct_str__" name="__yct_str__" value="wqksbzsJsKu7rAvKpSMPiW2It8ZaDTmKFsyUCJjPwLBzt2ZdRAU3fnEWnzwvR8nBT9ncxud0jKf4sv9ZSOb3xdT0i9EUbvDG6A5g9f2gVdyLeNUCep3l43%2F2F13Kwzp%2BmBbfGXYXRsWrMgCZMNBkMyCLpzpRo5pyul78xR8n2tHRIwK3IFYfvIVA4IVmLpom8XXSQjhU%2FTQkBwus%2FQlVqgreEQ2vTBRMej0y69BX48KvDGVuVLTUYL5A94U4zcFztsZFA1bGELRnDWesFasQF2SNOyheJnP2x%2FSfULH53AxUI1Hwl%2FLnqMh%2BnLLPrX36Nt7rtv7ClY7Re2UFiFKiIfWnw8kx2pJf8g8unNjAveU6DrH1zQ2aiw%3D%3D">
</body></html>