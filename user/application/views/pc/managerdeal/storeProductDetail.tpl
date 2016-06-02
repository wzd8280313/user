
			<!--end左侧导航-->	
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>仓单管理</a>><a>仓单详情</a></p>
					</div>
					<div class="center_tabl">


						<table border="0">
                            <tr>
                                <th colspan="3">仓库</th>
                            </tr>
                            <tr>
                                <td nowrap="nowrap">状态:</td>
                                <td colspan="2">
                                    {$detail['status_txt']}
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap">仓库:</td>
                                <td colspan="2">
                                    {$detail['store_name']}
                                </td>
                            </tr>
                            {if:$detail['store_pos']}
                            <tr>
                                <td nowrap="nowrap">库位:</td>
                                <td colspan="2">
                                    {$detail['store_pos']}
                                </td>
                            </tr>
                            {/if}
                            {if:$detail['cang_pos']}
                                <tr>
                                    <td nowrap="nowrap">仓位:</td>
                                    <td colspan="2">
                                        {$detail['cang_pos']}
                                    </td>
                                </tr>
                            {/if}
                            {if:$detail['check_org']}
                                <tr>
                                    <td nowrap="nowrap">检测机构:</td>
                                    <td colspan="2">
                                        {$detail['check_org']}
                                    </td>
                                </tr>
                            {/if}
                            {if:$detail['check_no']}
                                <tr>
                                    <td nowrap="nowrap">证书号码:</td>
                                    <td colspan="2">
                                        {$detail['check_no']}
                                    </td>
                                </tr>
                            {/if}
                            {if:$detail['create_time']}
                                <tr>
                                    <td nowrap="nowrap">申请时间:</td>
                                    <td colspan="2">
                                        {$detail['create_time']}
                                    </td>
                                </tr>
                            {/if}
                            {if:$detail['manager_time']}
                                <tr>
                                    <td nowrap="nowrap">仓库审核时间:</td>
                                    <td colspan="2">
                                        {$detail['manager_time']}
                                    </td>
                                </tr>
                            {/if}
                            {if:$detail['sign_time']}
                                <tr>
                                    <td nowrap="nowrap">签发时间:</td>
                                    <td colspan="2">
                                        {$detail['sign_time']}
                                    </td>
                                </tr>
                            {/if}
                            {if:$detail['user_time']}
                                <tr>
                                    <td nowrap="nowrap">用户确认时间:</td>
                                    <td colspan="2">
                                        {$detail['user_time']}
                                    </td>
                                </tr>
                            {/if}
                            {if:$detail['market_time']}
                                <tr>
                                    <td nowrap="nowrap">市场审核时间:</td>
                                    <td colspan="2">
                                        {$detail['market_time']}
                                    </td>
                                </tr>
                            {/if}
                            {if:$detail['rent_time']}
                                <tr>
                                    <td nowrap="nowrap">租库时间:</td>
                                    <td colspan="2">
                                        {$detail['rent_time']}
                                    </td>
                                </tr>
                            {/if}
                            {if:$detail['in_time']}
                                <tr>
                                    <td nowrap="nowrap">入库时间:</td>
                                    <td colspan="2">
                                        {$detail['in_time']}
                                    </td>
                                </tr>
                            {/if}
                        <tr>
                            <th colspan="3">商品类型和规格</th>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品类型:</td>
                                <td>
                                    {foreach:items=$detail['cate']}
                                        {if:$key==0}
                                            {$item['name']}

                                        {else:}
                                           >{$item['name']}
                                        {/if}
                                    {/foreach}
                                    
                                </td>

                            </tr>

                            {foreach: items=$detail['attr_arr'] item=$c key=$k}
                            <tr>
                                <td nowrap="nowrap"><span></span>{$k}:</td>
                                <td>
                                   {$c}
                                    
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>
                            {/foreach}
                            
                               <th colspan="3">商品详情</th>
                                <tr>
                                <td nowrap="nowrap"><span></span>商品名称:</td>
                                <td>
                                    {$detail['product_name']}
                                    
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品单价:</td>
                                <td>
                                    {$detail['price']}
                                    
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>数量:</td>
                                <td>
                                    {$detail['quantity']} ({$detail['unit']})
                                <td> 
                                   
                                </td>
                            </tr>
                           
          					
                            <tr>
                                <td>图片预览：</td>
                                <td colspan="2">
    								<span class="zhs_img">
    								  {foreach: items=$detail['photos'] item=$photo}
                                                                            <img src="{$photo}"/>
                                                                        
                                                                        {/foreach}  
    							</span>
                                </td>              
                            </tr>
              				


                        <tr>
                            <td>产品描述：</td>
                            <td colspan="2">
                                {$detail['note']}
                            </td>
                        </tr>
                            {if:$detail['status']==23}
                                <form method="post" action="{url:/Managerdeal/userMakeSure}" auto_submit >
                                    <tr>
                                    <td>用户确认：</td>
                                    <td colspan="2">
                                        <input type="radio" name="status" checked value="1"> 通过
                                        <input type="radio" name="status" value="0"> 驳回
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td colspan="2" class="btn">
                                        <input type="hidden" value="{$detail['id']}" name="id">
                                        <input type="submit" value="提交">

                                    </td>
                                </tr>
                                </form>
                            {/if}

                         
                 </table>

						
					</div>
				</div>
			</div>
			<!--end中间内容-->	
			
		</div>
      <script type="text/javascript" src="{views:js/product/attr.js}" ></script>