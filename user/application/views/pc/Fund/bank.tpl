
			<!--start中间内容-->	

<script type="text/javascript" src='{root:js/upload/ajaxfileupload.js}'></script>
<script type="text/javascript" src='{root:js/upload/upload.js}'></script>
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>资金管理</a>><a>开户信息管理</a></p>
					</div>
					<div>
						<form action="{url:/fund/bank}" enctype="multipart/form-data" method='post' auto_submit>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>开户银行：</span>
								<span><input class="text" type="text" datatype="s2-10" nullmsg="填写开户行" name="bank_name" value="{$bank['bank_name']}"></span>
								<span></span>

							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>银行卡类型：</span>
								<span><select class="text" type="text" name="card_type" datatype="n1-2" >
										{foreach:items=$type}
										<option value="{$key}" {if:$key==$bank['bank_type']}selected{/if}>{$item}</option>
										{/foreach}
										</select>
								</span>
								<span></span>
								
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>姓名：</span>
								<span><input class="text" type="text" datatype="s2-20" name="true_name" value="{$bank['true_name']}"></span>
								<span></span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>身份证：</span>
								<span>
									<input class="text" type="text" name="identify" datatype="/^\d{14,17}(\d|x)$/i" value="{$bank['identify_no']}">
								</span>
								<span></span>
								
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>银行卡号：</span>
								<span><input class="text" type="text" name="card_no" datatype="/[0-9a-zA-Z]{15,22}/" value="{$bank['card_no']}"></span>
								<span></span>
								
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>打款凭证： </span>
								<span>
									 <input type="hidden" name="uploadUrl"  value="{url:/fund/upload@user}" />
                        			<input type='file' name="file2" id="file2"  onchange="javascript:uploadImg(this);" />

								</span>
								<p class="con_title">请向上海公司总部账户打款0.1元并上传打款凭证</p>
							</div>
							 <div class="zhxi_con">
								 <span  class="con_tit">图片预览：</span>
								 <span>
									 <img name="file2" src="{$bank['proof_thumb']}"/>
					                    <input type="hidden" name="imgfile2" value="{$bank['proof']}" />
								 </span>


					          </div>
							<div class="zhxi_con">	
								<span><input class="submit_zz" type="submit" value="提交"></span>
							</div>
						</form>
					</div>
					
				
					<div style="clear:both;"></div>
				</div>
			</div>
	<!--end中间内容-->		

