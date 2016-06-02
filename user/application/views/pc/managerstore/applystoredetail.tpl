
			<!--end左侧导航-->	
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>仓单管理</a>><a>仓单详情</a></p>
					</div>
					<div class="center_tabl">
                    <div class="lx_gg">
                        <b>入库详细信息</b>
                    </div>
                    <div class="list_names">
                        <span>仓库名称:</span>
                        <span>{$storeDetail['sname']}</span>
                    </div>

						<table border="0">
                            <tr>
                                <td nowrap="nowrap"><span></span>状态：</td>
                                <td colspan="2">
                                   {$storeDetail['status_txt']}
                                </td>
                            </tr>
                            <tr>
              					<td nowrap="nowrap"><span></span>库位：</td>
                				<td colspan="2">
                                    {$storeDetail['store_pos']}
                                </td>
           				 	</tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>仓位：</td>
                                <td colspan="2">
                                    {$storeDetail['cang_pos']}
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>入库日期：</td>
                                <td colspan="2">
                                    {$storeDetail['in_time']}
                                </td>
                            </tr>
                             <tr>
                                <td nowrap="nowrap"><span></span>租库日期：</td>
                                <td colspan="2">
                                    {$storeDetail['rent_time']}
                                </td>
                            </tr>
                            <tr >
                                <td nowrap="nowrap"><span></span>检测机构：</td>
                                <td colspan="2">
                                    {$storeDetail['check_org']}
                                </td>
                            </tr>
                            <tr >
                                <td nowrap="nowrap"><span></span>质检证书编号：</td>
                                <td colspan="2">
                                    {$storeDetail['check_no']}
                                </td>
                            </tr>
                               <tr >
                                <td nowrap="nowrap"><span></span>是否包装：</td>
                                <td colspan="2"> 
                                    {if: $storeDetail['package'] == 1} 是 {else:} 否{/if}
                                </td>
                            </tr>
                            <tr >
                                <td nowrap="nowrap"><span></span>总重量：</td>
                                <td colspan="2"> 
                                    {$storeDetail['quantity']}({$storeDetail['unit']})
                                </td>
                            </tr>
                                    {if: $storeDetail['package'] == 1} 
                                            <tr id="packUnit" >
                                                 <td>包装单位：</td>
                                            <td colspan="2">
                                                {$storeDetail['package_unit']}
                                            </td>
                                            </tr>
                                            <tr id='packNumber'>
                                            <td>包装数量：</td>
                                            <td colspan="2">
                                                {$storeDetail['package_num']}
                                            </td>
                                            </tr>
                                            <tr id='packWeight' >
                                            <td>包装重量：</td>
                                            <td colspan="2">
                                                {$storeDetail['package_weight']}
                                            </td>
                                            </tr>
                                  {/if}
          					

              				
                      

                        <tr>
                            <td></td>
                            <td colspan="2" class="btn">


                                
                            </td>
                        </tr>
                         
                 </table>
                        <div class="lx_gg">
                            <b>商品信息</b>
                        </div>
                        <table border="0">
                            <tr>
                                <td nowrap="nowrap"><span></span>商品名称：</td>
                                <td colspan="2">
                                    {$storeDetail['pname']}
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品属性：</td>
                                <td colspan="2">
                                    {$storeDetail['attrs']}
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品分类：</td>
                                <td colspan="2">
                                    {foreach:items=$storeDetail['cate'] item=$cate key=$k}
                                        {if:$k==0}
                                            {$cate['name']}
                                            {else:}
                                           > {$cate['name']}
                                        {/if}

                                    {/foreach}
                                </td>
                            </tr>
                            <tr>
                                <td>图片预览：</td>
                                <td colspan="2">
    				<span class="zhs_img">
                                    {foreach: items=$photos item=$url}
                                        <img src="{$url}"/>
                                    {/foreach}
    				</span>
                                </td>
                            </tr>





                        </table>
					</div>
				</div>
			</div>
			