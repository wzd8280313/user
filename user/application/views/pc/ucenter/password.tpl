
			<div class="user_c">
				<div class="user_zhxi">
				<form method="post" action="{url:/ucenter/chgPass}" auto_submit >
					<div class="zhxi_tit">
						<p><a>账号管理</a>><a>修改密码</a></p>
					</div>
					<div style="float:left">

						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>原始密码：</span>
							<span><input class="text" type="password" datatype="*6-15" name="old_pass"/></span>
							<span></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>新密码：</span>
							<span><input class="text" type="password" datatype="*6-15" name="new_pass"/></span>
							<span></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>确认新密码：</span>
							<span><input class="text" type="password" datatype="*6-15" recheck="new_pass" errormsg="您两次输入的账号密码不一致！" name="new_repass"/></span>
							<span></span>
						</div>
						
						<div class="zhxi_con">
							<span><input class="submit" type="submit" value="保存"/></span>
						</div>
					</div>
					<div style="clear:both;"></div>
				</form>
				</div>
			</div>

