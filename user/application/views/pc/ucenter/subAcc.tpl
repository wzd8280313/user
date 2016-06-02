
<script type="text/javascript" src="{root:js/ajaxfileupload.js}"></script>
<script type="text/javascript" src="{views:js/upload.js}"></script>

			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>账号管理</a>><a>添加子账户</a></p>
					</div>
					<input type="hidden" name="uploadUrl"  value="{url:/ucenter/upload}" />

				<form method="post" action="{url:/ucenter/doSubAcc}" >
					<div style="float:left">

						<input type="hidden" name="id" value="{$user['id']}"/>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>用户名：</span>
							<span><input class="text" type="text" name="username" pattern="/^[a-zA-Z0-9_]{3,30}$/" value="{$user['username']}" /></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>手机号：</span>
							<span><input class="text" type="text" name="mobile" pattern="mobile" value="{$user['mobile']}" /></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit">邮箱：</span>
							<span><input class="text" type="text" name="email" empty pattern="email" value="{$user['email']}" /></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit">密码：</span>
							<span><input class="text" type="password" name="password" empty bind="repassword" pattern="/^\S{6,20}$/" alt="6-20位非空字符" /></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit">重复密码：</span>
							<span><input class="text" type="password" name="repassword" empty bind="password"  pattern="/^\S{6,20}$/" alt="6-20位非空字符"  /></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit">状态：</span>
							<span>
									<input type="radio" name="status" {if:$user['status']==1}checked{/if} value="1"/>开启
									<input type="radio" name="status" {if:$user['status']==0}checked{/if} value="0"/>关闭
							</span>
						</div>






						<div class="zhxi_con">
							<span><input class="submit" type="submit" value="保存"/></span>
						</div>
						<!--身份信息结束-->


					</div>
					<div class="zhxi_upimg">
						<div id="dd" class="up_img"><img name="file1" src="{if:isset($user['head_photo_thumb'])}{$user['head_photo_thumb']}{else:}{views:/images/icon/wt.jpg}{/if}"/></div>
						<div>
							<input type="file" name="file1" id="file1"  onchange="javascript:uploadImg(this);" />
							<input type="hidden" name="imgfile1" value="{$user['head_photo']}"/>
						</div>
					</div>
				</form>

					<div style="clear:both;"></div>
				</div>

			</div>

