
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>交易管理</a>><a>购买合同详情</a></p>
					</div>
					<div class="chp_xx">
						<div class="de_ce">
							<div class="detail_chj">
								<span>{$info['create_time']}</span>
								<span>订单创建</span>
							</div>
							<div class="detail_chj">
								<b>订单号：</b><span>{$info['order_no']}</span>
								<b>下单日期:</b><span>{$info['create_time']}</span>
								<b>状态:</b><span>{$info['action']}</span>
							</div>
							<div class="detail_chj">
								<!-- <input class="qx_butt" type="button" value="取消订单"/> -->
								{if:$info['action_href']}<input class="fk_butt" type="button" url="{$info['action_href']}" value="{$info['action']}"/>{/if}
							</div>
						</div>
						<div class="sjxx">
							<p>收件人信息</p>
							<div class="sj_detal">
								<b class="sj_de_tit">收货人：</b>
								<span>&nbsp;laijjj</span>
							</div>
							<div class="sj_detal">
								<b class="sj_de_tit">地址：</b>
								<span>&nbsp;山西省晋中市xxx县</span>
							</div>
							<div class="sj_detal">
								<b class="sj_de_tit">邮编：</b>
								<span>&nbsp;045000</span>
							</div>
						</div>
						<div class="sjxx">
							<p>支付配送</p>
							<div class="sj_detal">
								<b class="sj_de_tit">收货人：</b>
								<span>&nbsp;laijjj</span>
							</div>
							<div class="sj_detal">
								<b class="sj_de_tit">地址：</b>
								<span>&nbsp;山西省晋中市xxx县</span>
							</div>
							<div class="sj_detal">
								<b class="sj_de_tit">邮编：</b>
								<span>&nbsp;045000</span>
							</div>
						</div>
						<div class="xx_center">
							<table border="0" cellpadding="" cellspacing="">
								<tbody>
								<tr class="title" >
									<td align="left" colspan="7">&nbsp;商品清单</td>
								</tr>
								<tr>
									<th>图片</th>
									<th>商品名称</th>
									<th>商品价格</th>
									<th>优惠金额</th>
									<th>商品数量</th>
									<th>小计</th>
									<th>配送</th>
								</tr>
								<tr>
									<td><img src="{views:images/banner/551b861eNe1c401dc.jpg}"/></td>
									<td>{$info['name']}</td>
									<td>{$info['price']}</td>
									<td>0</td>
									<td>{$info['num']}{$info['unit']}</td>
									<td>{$info['amount']}</td>
									<td>未发货</td>

								</tr>
							</tbody></table>
						</div>
					</div>
				</div>
			</div>
			<!--end中间内容-->	
			<!--end右侧广告-->

			<script type="text/javascript">
				$(function(){
					$('.fk_butt').click(function(){
						window.location.href = $(this).attr('url');
					});
				})
			</script>
		</div>
	</div>