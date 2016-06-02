

			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>账号管理</a>><a>开票信息管理</a></p>
					</div>
					<div>
						<form action="{url:/ucenter/invoice}" method="post" auto_submit >
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>发票抬头：</span>
								<span><input class="text" type="text" name="title" value="{$data['title']}" datatype="s2-30" errormsg="格式错误">
                                </span>
                                <span></span>

							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>纳税人识别号：</span>
								<span><input class="text" type="text" name="tax_no" value="{$data['tax_no']}" datatype="/^[a-zA-Z0-9_]{6,40}$/" errormsg="格式错误">
								</span>
                                <span></span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>地址：</span>
								<span><input class="text" type="text" name="address" value="{$data['address']}" datatype="*2-40" errormsg="格式错误">
								</span>
                                <span></span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>电话：</span>
								<span><input class="text" type="text" name="tel" value="{$data['phone']}" datatype="/^[0-9\-]{6,12}$/" errormsg="格式错误">
								</span>
                                <span></span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>开户行：</span>
								<span><input class="text" type="text" name="bankName" value="{$data['bank_name']}" datatype="s2-20" errormsg="格式错误" >
								</span>
                                <span></span>
							</div>
                            <div class="zhxi_con">
                                <span class="con_tit"><i>*</i>银行账号：</span>
								<span><input class="text" type="text" name="bankAccount" value="{$data['bank_no']}" datatype="s6-20" errormsg="格式错误">
								</span>
                                <span></span>
                            </div>
							<div class="zhxi_con">	
								<span><input class="submit_zz" type="submit" value="提交"></span>
								<span><input class="submit_zz reset_zz" type="reset" value="重置"></span>
							</div>
						</form>
					</div>
					
				
					<div style="clear:both;"></div>
				</div>
			</div>
