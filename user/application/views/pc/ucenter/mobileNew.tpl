
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>账号管理</a>><a> 更换新手机号</a></p>
					</div>
					<div>
						<form action="{url:/ucenter/MobileSuccess}" method="post" auto_submit redirect_url="{url:/ucenter/MobileSuccess}">
                        <div class="jd_img"><img src="{views:images/center/yz_jd2.jpg}"></div>
						<div class="zhxi_con">
							<span class="con_tit"><i></i>手机号码：</span>
							<span>{$userInfo['mobile']}</span>
						</div>
						<div class="zhxi_con">
                            <span class="con_tit"><i></i>验证码：</span>
                              <div>

                                <input id="inputCode" placeholder="请输入验证码" type="text" class="gradient">
                                <img id="image" width="" height="45" src="{url:/index/getCaptcha}" onclick="this.src='{url:/index/getCaptcha}?'+Math.random()" />
                            </div>
                        </div>   
                        <div class="zhxi_con">
                            <span class="con_tit"><i></i>新手机号码：</span>
                            <span><input class="text" placeholder="请输入手机" type="text" id='mobile_no' name="mobile"> </span>
                            <div><input type="text" readonly="readonly" name="checkh" class="mobile_no"/></div>
                           
                        </span></div>

						<div class="zhxi_con">
                            <span class="con_tit"><i></i>短信验证码：</span>
                            <span><input type="text" id="phoneCode" name='mobileCode' class="infos text" placeholder="请输入验证码"></span><input class="send1" id="btnSendCode" type="button" value="免费获取短信验证码" onClick="getMobileCode()" />
                            <div><input type="text" readonly="readonly" name="checkCode" class="mobile_no"/></div>
                        </div>
						<div class="zhxi_con">
							<span><!-- <a href="mobile_success.html"> --><input class="submit" type="submit" value="下一步"/></a></span>
						</div>
						</form>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
<script type="text/javascript">
      function getMobileCode(){
        var phone=$('#mobile_no').val();
        if(phone==''){
            $("input[name='checkh']").val('请输入手机号');
            return false;
        }

        if(phone.length!=11){
            $("input[name='checkh']").val("手机号不正确");
            return false;
        }
        var code=$('#inputCode').val();
        if(code==''){
            $("input[name='checkCode']").val('请输入验证码');
            return false;
        }
        if(code.length!=4){
            $("input[name='checkCode']").val('验证码不正确');
            return false;          
        }
        $.ajax(
                {
                    type:'post',
                    url:"{url:/ucenter/getNewMobileCode}",
                   data:{mobileCode:code,mobile:phone},
                    cache:false,
                    dataType:'json',
                    success:function(msg){
                        if(msg.success==0){
                            $('#image').click();
                           alert(msg.info);
                        }else{
                            $('#image').click();
                            alert(msg.info);
                        }
                    }
                }

            );
    }
    function checkMobileCode(){
        var code=$('phoneCode').val();
        if(code==""){
            $("input[name='checkCode']").val('请输入验证码');
            return false;
        }
        $.ajax({
            type:'post',
            url:"{url:/ucenter/checkMobileCode}",
            data:{mobileCode:code},
            dataType:'json',
            success:function(msg){
                if(msg.success==0){
                    $("input[name='checkCode']").val(msg['info']);
                }else{

                }
            }
        });
    }

</script>