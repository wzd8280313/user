<?php 
	$siteConfig = new Config("site_config");
	$callback = IReq::get('callback')?IReq::get('callback') :'/' 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="tp_page" content="3.0">
<title><?php echo $siteConfig->name;?></title>
<script type="text/javascript" charset="UTF-8" src="/xinde/scsg/runtime/_systemjs/jquery/jquery-1.11.3.min.js"></script><script type="text/javascript" charset="UTF-8" src="/xinde/scsg/runtime/_systemjs/jquery/jquery-migrate-1.2.1.min.js"></script>
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
                <a class="hd_menu" href="#"><s class="help_ico"></s>帮助中心</a>
                <div class="hd_menu_list">
                    <ul>
                        <li><a href="<?php echo IUrl::creatUrl("/site/help_list/id/9");?>">常见问题</a></li>
                        <li><a href="<?php echo IUrl::creatUrl("/site/help_list/id/4");?>">支付帮助</a></li>
                        <li><a href="<?php echo IUrl::creatUrl("/site/help_list/id/6");?>">配送范围</a></li>
                    </ul>
                </div>
            </div>
            <span class="fr">您好，欢迎光临山城速购！ <a href="<?php echo IUrl::creatUrl("/simple/login");?>" class="blue_link">请登录</a></span>
        </div>
    </div>
  </div>

   <?php 
	$seo_data    = array();
	$site_config = new Config('site_config');
	$site_config = $site_config->getInfo();
	$seo_data['title'] = "用户登录_".$site_config['name'];
	seo::set($seo_data);
?>

	<link href="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/log/pc_login.css";?>" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/log/login.js";?>"></script>
<script>
	var logPath = '<?php echo IUrl::creatUrl("/simple/login_act");?>';
	var checkErrTimesUrl = '<?php echo IUrl::creatUrl("/simple/checkErrTimes");?>';
	var returnUrl = '<?php echo IUrl::creatUrl("".$callback."");?>';
	var servicePhone = '<?php echo isset($site_config["phone"])?$site_config["phone"]:"";?>';
	
	
	var LOGIN_RESULT = {SUCCESS:0,FAIL:1};                  
	var REGISTER_RESULT = {SUCCESS:10,FAIL:11};             
	var DOMAIN_TYPE = {YHD:1,MALL:2,YW_111:3};              
	var LOGIN_SOURCE={NORMAL:1,FRAME:2};  
	var URLPrefix = {"mymall":"#","passport_statics":"#","yiwangauth":"#","yaowang":"#","tracker":"","passport":"#","my":"#","central":"#","validCodeShowUrl":"#","mall":"#","passportother":"#"}; 
	var currSiteId = 1;                         
	           
	var autoLoginFlag= "1";        
	var valid_code_service_flag="1"; 
	var showValidCode = "0"; 
	var mUrl = "#"; 
</script>
  
   
	<input type="hidden" id="isAutoLogin" value="0">
	<input type="hidden" id="autoLoginFlag" value="1">
	<div class="login_wrap">
		<div class="wrap clearfix">
			<div class="mod_login_wrap login_entry_css">
				<div class="clearfix" style="position: relative;">
	            	<div style="position: relative; padding-left: 160px; padding-right: 160px; height: 40px;">
	            		<h3 style="margin: 0 auto;float: none; width: 100%;">山城速购用户登录</h3>
	            	</div>
	            	<!--
	            	-->
	            	<a style="position: absolute; right: 15px; top: 0px;" href="<?php echo IUrl::creatUrl("/simple/reg");?>" class="regist_new blue_link">注册新账号</a>
	            </div>
				<div class="login_form">
					<input id="login_source" type="hidden" value="1">
					<input id="login_pc_home_page" type="hidden" value="1">
	
					<i class="arraow">&nbsp;</i>
					<p id="error_tips" class="error_tips" style="display:none">您填写的账户名不存在请核对后重新填写</p>
					<div class="form_item_wrap">
					    <div class="form_item cur">
					        <label class="user_ico">&nbsp;</label>
					        <input id="un" type="text" name="credentials.username" spellcheck="false" tabindex="1" class="ipt ipt_username" style="outline: none;" value="">
					    </div>
					    <div class="form_item">
					        <label class="paswd_ico">&nbsp;</label>
					        <input id="pwd" type="password" name="credentials.password" tabindex="2" class="ipt ipt_password" style="outline: none;">
					        <a href="<?php echo IUrl::creatUrl("/simple/find_password");?>" target="_blank" class="forget_pswd" tabindex="-1">忘记密码？</a>
					
					    </div>
					    <div id="vcd_div" class="verify_code" style="display: none;">
					    	<input id="validateSig" type="hidden">
					    	<div class="form_item">
					        	<label>验证码：</label>
					        	<input id="vcd" type="text" name="validCode" value="" tabindex="-1" class="ipt ipt_code" style="width: 50px; outline: none;" maxlength="5" onblur="javascript: checkValidCodeOnBlur()" onkeyup="javascript: login_param_validate();">
					        	<span class="code_right" id="code_right" style="display:none"></span>
                                <span class="code_wrong" id="code_wrong"></span>
					        </div>
					    	<span class="verify_code_box" style="margin: 0px 15px 0px 15px;"><img src='<?php echo IUrl::creatUrl("/simple/getCaptcha/w/122/h/55/s/15");?>' onclick="changeCaptcha('<?php echo IUrl::creatUrl("/simple/getCaptcha/w/122/h/55/s/15");?>')" id='captchaImg' /></span>
					    </div>
					    
					    <p id="autoLoginDiv" class="auto_login">
					    	<a id="check_agreement" class="uncheck_agreement" href="#">自动登录</a>
					    	<input id="autoLoginCheck" type="hidden">
					    	<label id="agreement_tips" style="display:none;color:red;">请勿在公用电脑上启用。</label>
					    </p>
					    
					    <p class="service_agreement" style="">点击登录，表示您同意山城速购<a href="#" class="blue_link" target="_blank">《服务协议》</a>
                    	</p>
                    	
					    <button id="login_button" type="button" class="login_btn" onclick="javascript:double_submit();return false;">登录</button>
					
					</div>
					
					<div class="login_entry">
						<p>合作网站账号登录</p>
						<ul class="account_list_big clearfix">
							<li><a href="#" target="_blank" class="qq" title="QQ"></a></li>
							<li><a href="#" target="_blank" class="sina" title="新浪微博"></a></li>
							<li><a href="#" target="_blank" class="alipay" title="支付宝"></a></li>
							<li><a href="#" target="_blank" class="weixin" title="微信"></a></li>
						</ul>
				
					</div>
					
				
				</div>
			</div>
			<div class="mod_left_banner"><a id="imgLink" target="_blank"><img id="img1" src="<?php echo IUrl::creatUrl("")."views/".$this->theme."/skin/".$this->skin."/css/log/login_pic.jpg";?>" width="400" height="300"></a></div>
		</div>
	</div>
	
	<!--绑定手机送积分 begin -->
	<div class="mod_login_bindmb_point"></div>
	<!--绑定手机送积分 end -->
<script>	
	pageInit();
	function getPageTag(){
        return 1;	 
    }
    
    $(document).ready(function(){
		loadImageUrl("1","Passport_Login_Ad_Click");
		$(document).keydown(function(e){
		if(e.keyCode==13)
			double_submit();
	})
	});
	
</script>
	
<div  class="copyright">
			<div class="footer" style="text-align:center">
				<p class="links">
					<a href="">关于我们</a>|
					<a href="">常见问题</a>|
					<a href="">安全交易</a>|
					<a href="">购买流程</a>|
					<a href="">如何付款</a>|
					<a href="">联系我们</a>|
					<a href="">合作提案</a>
				</p>
				<p class="copyright">Powered by 
					<a href="http:///">耐耐云商科技</a>
				</p>Copyright © 2005-2014 
				<a class="copyys" target="_blank" href="http://www.miibeian.gov.cn/">晋ICP备01000010号</a>
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