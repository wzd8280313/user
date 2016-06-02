<!DOCTYPE html>
<html>
<head>
  <title>登录</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
  <link href="{views:css/home.css?v=2}" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="{root:js/jquery/jquery-1.7.2.min.js}"></script>
  <script type="text/javascript" src="{views:js/login.js}"></script>
  <script type="text/javascript" src="{views:js/common.js}"></script>
</head>
<body>
<script type="text/javascript" >
  var logPath = '{url:/login/doLog}';
</script>

<div class="wrap">
  <div class="banner-show" id="js_ban_content">
    <div class="cell bns-01">
      <div class="con"> </div>
    </div>
    <div class="cell bns-02" style="display:none;">
      <div class="con"> <a href="#" target="_blank" class="banner-link"> <i>圈子</i></a> </div>
    </div>
    <div class="cell bns-03" style="display:none;">
      <div class="con">
        <a href="#" target="_blank" class="banner-link"> <i>企业云</i></a>
      </div>
    </div>
  </div>
  <div class="banner-control" id="js_ban_button_box">
     <a href="javascript:;" class="left">左</a> 
     <a href="javascript:;" class="right">右</a>
  </div>
  <div class="container">
    <div class="register-box">
      <div class="reg-slogan">登录</div>
      <div class="reg-form" id="js-form-mobile"> <br>
        <span id="error_info"></span>
        <br>
        <input type="hidden" name="callback" value="{$callback}" />
        <div class="cell">
           <input type="text" name="mobile" id="js-mobile_ipt" class="text" maxlength="20" placeholder="用户名/手机号"/>
        </div>
        <div class="cell">
          <input type="password" name="passwd" id="js-mobile_pwd_ipt" class="text" placeholder="密码"/>
        </div>
        <!-- !验证码 -->
        <div class="cell vcode">
          <input type="text" name="code" id="js-mobile_vcode_ipt" class="text" maxlength="4" placeholder="验证码"/>
       <a id='chgCode' href="javascript:void(0)" onclick="changeCaptcha('{url:/login/getCaptcha}',$(this).find('img'))"><img src="{url:/login/getCaptcha}" /></a>
        </div>
        <div class="bottom">
          <a id="js-mobile_btn" href="javascript:void(0);" class="button btn-green" onclick="double_submit()"> 立即登录</a>
        </div>
		<div class="mm_reg"><a href="{url:/login/PasswordReset}">忘记密码</a><a href="{url:/login/register}">注册>></a></div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
