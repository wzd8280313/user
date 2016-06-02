<script type="text/javascript" src="{root:js/upload/ajaxfileupload.js}"></script>
<script type="text/javascript" src="{root:js/upload/upload.js}"></script>
<!--start中间内容-->
			<div class="user_c">
				<!--start代理账户充值-->
				<div class="user_pay">
				<form method='post' action="{url:/fund/doFundIn}"enctype="multipart/form-data" auto_submit redirect_url="{url:/fund/index}">
					<div class="zhxi_tit">
						<p><a>资金管理</a>><a>代理账户管理</a>><a>充值</a>
						</p>
					</div>
					<div class="pay_cot">
						<div class="zhxi_con font_set">
							<span class="con_tit">账户余额：</span>
							<span><i>￥</i><i class="bold">10.00</i></span>
						</div>
						<div class="zhxi_con font_set">
							<span class="con_tit">充值金额：</span>
							<span><input class="text potwt" type="text" datatype="float" name='recharge'/>元</span>
						</div>
		<!--TAB切换start  -->
            <div class="tabs_total">

                <div class="tabPanel">
            		<ul>
            			<li class="hit">支付宝支付</li>
            			<li>银行在线支付</li>
            			<li>线下支付</li>
            		</ul>
            		<div class="panes">
            			<div class="pane" style="display:block;">
            				<div class="zhxi_con">
            					<span class="con_tit">充值方式一：</span>
            					<span>支付宝</span>
            				</div>
            				<div class="zhxi_con">
            					<span class="con_tit"><i></i></span>
            					<label><input name="payment_id" type="radio" value="2" /> 
            						<img src="{views:images/center/zhifu.jpg}">
            					</label> 
            					<p class="zf_an"><input class="zf_button" type="submit" value="立即支付"/></p>

            				</div>
            			</div>
            			<div class="pane">
            				<div class="zhxi_con">
            					<span class="con_tit">充值方式二：</span>
            					<span>银行在线支付</span>
            				</div>
            				<div class="zhxi_con">
            					<span class="con_tit">选择银行类型：</span>
            					<span>
            						<input name="payment_id" type="radio" value="3"  />  个人网上银行支付
            						<input name="payment_id" type="radio" value="" /> 企业网上银行支付
            					</span>
            				</div>
            				<div class="zhxi_con">
            					<span class="con_tit">选择支付银行：</span>
            					<div class="zf_two">
            						<span>
            							<input name="zhifu" type="radio" value=""  /> <img src="{views:images/center/g_bank.jpg}"/>
            						</span>
            						<span>
            							<input name="zhifu" type="radio" value=""/> <img src="{views:images/center/n_bank.jpg}"/>
            						</span>
            						<span>
            							<input name="zhifu" type="radio" value=""/> <img src="{views:images/center/j_bank.jpg}"/>
            						</span>
            						<span>
            							<input name="zhifu" type="radio" value=""/> <img src="{views:images/center/j_bank.jpg}"/>
            						</span>
            						<span>
            							<input name="zhifu" type="radio" value=""/> <img src="{views:images/center/j_bank.jpg}"/>
            						</span>
            					</div>
            				</div>
            				<div class="zhxi_con">
            					<span><input class="submit" type="submit" value="下一步"/></span>
            				</div>
            			</div>
            			<div class="pane">
            				<div class="zhxi_con">
            					<span class="con_tit">充值方式三：</span>
            					<span>转账汇款</span>
            				</div>
            				<div class="zhxi_con">
            					<p class="zf_an">开户名：xxx科技有限公司</p>
            					<p class="zf_an">开户银行：中国建设银行</p>
            					<p class="zf_an">账户：2902 20222 2200 4433 6767</p>
            				</div>

            				<!-- 单据上传start -->
							<input type="hidden" name="uploadUrl"  value="{url:/ucenter/upload}" />
            				<div class="huikod">

            				  <label for="female">上传汇款单据</label>
								<input type="file" name="file1" id="file1"  onchange="javascript:uploadImg(this);" />
								<div id="preview">
									<img name="file1" src=""/>
									<input type="hidden"  name="imgfile1" datatype="*"  />

								</div>
							</div>


            				<!-- 单据上传end -->
            				<div class="zhxi_con">
            					<span><input class="submit" type="submit" value="提交"/></span>
            				</div>
            			</div>
            		</div>
                </div>

            </div>  

           <script type="text/javascript">
           $(function(){	
           	$('.tabPanel ul li').click(function(){
           		$(this).addClass('hit').siblings().removeClass('hit');
           		$('.panes>div:eq('+$(this).index()+')').show().siblings().hide();	
           	})
           })
           </script>

		<!--TAB切换end  -->
					</div>
				</form>
				</div>
			</div>
			
	<!--end中间内容-->	