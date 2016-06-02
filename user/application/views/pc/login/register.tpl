<!DOCTYPE html>
<html>
<head>
  <title>注册</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
  <link href="{views:css/reg.css}" rel="stylesheet" type="text/css" />
  <link href="{views:css/city.css}" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="{root:js/jquery/jquery-1.7.2.min.js}"></script>
  <script type="text/javascript" src="{views:js/reg.js}"></script>
  <script type="text/javascript" src="{root:js/area/Area.js}" ></script>
  <script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
    <script type="text/javascript" src="{root:js/form/formacc.js}" ></script>
  <script type="text/javascript" src="{root:js/form/validform.js}" ></script>
    <script type="text/javascript" src="{root:js/layer/layer.js}"></script>
</head>
<body>


<div class="wrap">
<img src="{views:images/mid_banner/banner_01.png}" style="position: fixed;
    width: 100%;"/>
  <!-- <div class="banner-show" id="js_ban_content">
    <div class="cell bns-01">
      <div class="con"> </div>
    </div>
  </div> -->
  <div>
    {url:/login/doReg}
    <div class="register">
      <div class="reg_top">
      <div class="register_top">
          <div class="reg_zc register_l border_bom">个人注册</div>
          <span class="jg">|</span>
          <div class="reg_zc register_r">企业注册</div>
      </div>
      </div>
      <!--个人注册-->
      <div class="reg_cot gr_reg">
        <input name="checkUrl" value="{url:/login/checkIsOne}" type="hidden" />
        <form action="{url:/login/doReg}" method="post" auto_submit redirect_url="{url:/ucenter/baseinfo}">
          <input type="hidden" name="type" value="0"/>
          <div class="cot">
            <span class="cot_tit"><i>*</i>用户名：</span>
            <span><input class="text" type="text" name="username" datatype="/^[a-zA-Z0-9_]{3,30}$/" nullmsg="请填写用户名" errormsg="请使用3-30位字母数字下划线的组合"/></span>
            <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>密码：</span>
            <span><input class="text" type="password" name="password" datatype="/^[\S]{6,15}$/" nullmsg="请填写密码" errormsg="请使用6-15位字符" /></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>确认密码：</span>
            <span><input class="text" type="password" name="repassword" datatype="*" recheck="password" nullmsg="请重复填写密码" errormsg="两次密码输入不一致" /></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>手机号：</span>
            <span><input class="text" type="text" name="mobile" maxlength="11" datatype="mobile" nullmsg="请填写手机号" errormsg="手机号格式错误"/></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i></i>邮箱：</span>
            <span><input class="text" type="text" name="email" ignore="ignore" datatype="e" errormsg="邮箱格式错误"/></span>
              <span></span>
          </div>
            <div class="cot">
                <span class="cot_tit"><i></i>选择代理商：</span>
            <span> <select class="select sel_d" name="agent"  >
                    <option value="0">市场</option>
                    {foreach:items=$agent}
                        <option value="{$item['id']}">{$item['company_name']}</option>
                    {/foreach}
                </select>
            </span>
                <span></span>
            </div>
            <div class="cot">
                <span class="cot_tit"><i></i>代理商密码：</span>
                <span><input class="text" type="text" name="agent_pass"/></span>
                <span></span>
            </div>
           <div class="cot">
            <span class="zc"><input class="but" type="submit"value="完成注册"/></span>
          </div>
        </form>
      </div>
       <!--个人注册结束-->
        <!--企业注册-->
      <div class="reg_cot qy_reg">
        <form action="{url:/login/doReg}" method="post" auto_submit redirect_url="{url:/ucenter/baseinfo}" >
          <input type="hidden" name="type" value="1"/>
         <div class="cot">
            <span class="cot_tit"><i>*</i>用户名：</span>
            <span><input class="text" type="text" name="username" callback="checkUser"  datatype="/^[a-zA-Z0-9_]{3,30}$/" errormsg="请填写3-30位英文字母、数字" /></span>
            <span></span>
		  </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>密码：</span>
            <span><input class="text" type="password" name="password" datatype="/^\S{6,15}$/" errormsg="6-15位非空字符"  /></span>
            <span></span>
		  </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>确认密码：</span>
            <span><input class="text" type="password" name="repassword" datatype="*" errormsg="两次密码输入不一致" recheck="password" /></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>手机号：</span>
            <span><input class="text" type="text" name="mobile" datatype="m"  /></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i></i>邮箱：</span>
            <span><input class="text" type="text" name="email" ignore="ignore" datatype="e" errormsg="邮箱格式错误"/ /></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>公司名称：</span>
            <span><input class="text" type="text" name="company_name"  datatype="s2-20" errormsg="请填写公司名称" /></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>公司地址：</span>
            <div >
              <span>{area:  inputName=area pattern=area }</span>
                <span></span>
            </div>
          </div>

          <div class="cot">
            <span class="cot_tit"><i>*</i>法人：</span>
            <span><input class="text" type="text" name="legal_person" datatype="s2-20" errormsg="请填写法人名称"/></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>注册资金：</span>
            <span>
              <input class="text" type="text" name="reg_fund" datatype="float" errormsg="请正确填写注册资金"/>万
           </span>
		   <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>企业类型：</span>
            <span> 
              <select class="select sel_d" name="category" datatype="/[1-9]\d{0,}/" errormsg="请选择企业类型">
              <option value="0">请选择...</option>
                  {foreach:items=$comtype}
                      <option value="{$item['id']}">{$item['name']}</option>
                  {/foreach}
             </select>
           </span>
		   <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>企业性质：</span>
            <span> 
              <select class="select sel_d" name="nature" datatype="/^[1-9]\d{0,}$/" errormsg="选择企业性质">
                  <option value="0">请选择...</option>
                  {foreach:items=$comNature}
                    <option value="{$key}">{$item}</option>
                  {/foreach}
             </select>
           </span>
		   <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>联系人姓名：</span>
            <span><input class="text" type="text" name="contact" datatype="s2-20" errormsg="请填写联系人姓名" /></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>电话：</span>
            <span><input class="text" type="text" name="contact_phone" datatype="m" errormsg="请填写联系人电话"/></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>职务：</span>
            <span>
                {foreach:items=$duty}
                    <input name="contact_duty" type="radio" value="{$key}" {if:$key==1} checked{/if}/>
                    <span class="tit_zw">{$item}</span>
                {/foreach}

            </span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i></i>选择代理商：</span>
            <span> <select class="select sel_d" name="agent" >
                    <option value="0">市场</option>
                    {foreach:items=$agent}
                        <option value="{$item['id']}">{$item['company_name']}</option>
                    {/foreach}
                </select>
            </span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i></i>代理商密码：</span>
            <span><input class="text" type="text" name="agent_pass"/></span>
			<span></span>
          </div>

           <div class="cot">
            <span class="zc"><input class="but" type="submit" value="完成注册"/></span>
          </div>
        </form>
      </div>
       <!--企业注册结束-->
    </div>
  </div>
  <div style=" clear:both"></div>
</div>
<script type="text/javascript">

    $(function(){
        var validObj = formacc;

        //为地址选择框添加验证规则
        var rules = [{
            ele:"input[name=area]",
            datatype:"n4-6",
            nullmsg:"请选择地址！",
            errormsg:"请选择地址！"
        }];
        validObj.addRule(rules);

    })
</script>
</body>
</html>
