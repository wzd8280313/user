<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{views:js/product/attr.js}" ></script>
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>产品管理</a>><a>商品分类</a></p>
					</div>
					<div class="center_tabl">
                    {if: empty($storeList)}
                        请先申请仓单
                    {else:}
                    <input type="hidden" id='ajaxGetStoreUrl' value="{url:/Managerdeal/ajaxGetStore}">
                    <form action="{url:/Managerdeal/doStoreOffer}" method="POST" auto_submit redirect_url="{url:/managerdeal/indexoffer}">
						<table border="0">
                            <tr>
                                <th colspan="3">选择仓单</th>
           		</tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>可选仓单:</td>
                                <td colspan="2"> 
                                    <select id="storeList" name="storeproduct">
                                       {foreach: items=$storeList item=$list}
                                        <option value="{$list['id']}">{$list['sname']}-{$list['pname']}</option>
                                       {/foreach}
                                    </select>
                                </td>
                            </tr>
                            <tr >
                                <td class="spmx" colspan="3">
                                    <table class="table2" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="spmx_title" colspan="2">商品明细</td>
                                        </tr>
                                      
                                        <tr>
                                            <td>商品名称</td>
                                            <td id="pname"> 
    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>产品大类</td>
                                            <td id="cname">  

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>规格</td>
                                            <td id="attrs">
    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>产地</td>
                                            <td id="area"> 

                                            </td>
                                        </tr>
                                        <tr>
                                            <td >生产日期</td>
                                            <td id="create_time"> 

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="end_td">产品数量（<span id="unit"></span>）</td>
                                            <td class="end_td" id="quantity"> 
                          
                                            </td>
                                        </tr>
                                    </table>
                                    
                                </td>
                            </tr>
                            

                            <tr>
                               <th colspan="3">基本挂牌信息</th>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品单价:</td>
                                <td> 
                                    <input class="text" type="text" datatype="float" errormsg="价格错误" name="price">
                                    
                                </td>
                               <!--  <td> 
                                   请选择付款方式：
                                   <input type ="radio" name ="safe" checked="checked" style="width:auto;height:auto;"> 线上
                                   <input type ="radio" name ="safe" style="width:auto;height:auto;"> 线下
                               </td> -->
                            </tr>
                           <tr>
                            <td><span>*</span>是否可拆分：</td>
                            <td>
                                <select name="divide" id="divide">
                                    <option value="0"  selected>可以</option>
                                    <option value="1"  >不可以</option>
                                </select>
                            </td>
                            </tr>
                            <tr id='nowrap'>
                            <td><span>*</span>最小起订量：</td>
                            <td>
                                <input name="minimum" id="" type="text" />
                            </td>
                        </tr>
          					
                            <tr>
                                <td>图片预览：</td>
                                <td colspan="2">
    							<span class="zhs_img" id="photos">

    							</span>
                                </td>              
                            </tr>
                            <tr>
                        <td>交收地点：</td>
                            <td colspan="2">
                                <input type="text" class='text' datatype="s2-100" errormsg="请填写交收地址" name="accept_area">
                            </td>
                            </tr>
                            <td>交收时间：</td>
                            <td colspan="2">
                                <input type="text" class='text' datatype="n" errormsg="请填写交收时间" name="accept_day">
                            </td>
                            </tr>
              			                      

                        <tr>
                            <td></td>
                            <td colspan="2" class="btn">
                            <input type="hidden" name="mode" value="3">
                            <input type="hidden" name="product_id" id="product_id" value="{$storeDetail['pid']}">
                        <input type="submit" value="提交审核">

                                
                            </td>
                        </tr>
                         
                 </table>
            	</form>
                {/if}
						
					</div>
				</div>
			</div>
		