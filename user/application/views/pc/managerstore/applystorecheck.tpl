
			<!--end左侧导航-->	
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>仓单管理</a>><a>仓单审核</a></p>
					</div>
					<div class="center_tabl">

                    <form action="{url:/ManagerStore/doApplyStore}" method="POST" auto_submit redirect_url="{url:/managerstore/applystorelist?type=1}">
						<table border="0">
                        <tr>
                            <th colspan="3">商品类型和规格</th>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品类型:</td>
                                <td>
                                    {$detail['cname']}
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>

                            {foreach: items=$detail['attribute'] item=$c key=$k}
                            <tr>
                                <td nowrap="nowrap"><span></span>{$attrs[$k]}:</td>
                                <td>
                                    {$c}
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>
                            {/foreach}
                            
                               <th colspan="3">基本商品信息</th>
                                <tr>
                                <td nowrap="nowrap"><span></span>商品名称:</td>
                                <td>
                                    {$detail['pname']}
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
                                <td nowrap="nowrap"><span></span>挂牌数量:</td>
                                <td>
                                    {$detail['quantity']}({$detail['unit']})
                                </td>
                                <td> 
                                   
                                </td>
                            </tr>
                           
          					
                            <tr>
                                <td>图片预览：</td>
                                <td colspan="2">
    								<span class="zhs_img">
    								  {foreach: items=$photos item=$photo}
                                                                            <img src="{$photo}"/>
                                                                        
                                                                        {/foreach}  
    							</span>
                                </td>              
                            </tr>
              				

                        <tr>
                            <td nowrap="nowrap">仓库:</td>
                            <td colspan="2">
                                {$detail['sname']}
                            </td>
                        </tr>
                        <tr>
                            <td>产品描述：</td>
                            <td colspan="2">
                                {$detail['note']}
                            </td>
                        </tr>
                         <tr>
                            <td>是否通过审核：</td>
                            <td colspan="2">
                                <input type="radio" name="apply" checked value="1"> 通过
                                <input type="radio" name="apply" value="0"> 驳回
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td colspan="2" class="btn">
                            <input type="hidden" value="{$detail['sid']}" name="id">
                               <input type="submit" value="确认">
                                <!-- <span class="color">审核将收取N元/条的人工费用，请仔细填写</span> -->
                                
                            </td>
                        </tr>
                         
                 </table>
            	</form>
						
					</div>
				</div>
			</div>
			<!--end中间内容-->	
			
		</div>
      <script type="text/javascript" src="{views:js/product/attr.js}" ></script>