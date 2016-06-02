<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/upload/ajaxfileupload.js}"></script>
<script type="text/javascript" src="{root:js/upload/upload.js}"></script>
<div class="class_jy" id="cate_box" style="display:none;">
    <span class="jy_title"></span>
    <ul>
        <!-- <li value=""   class="a_choose" ><a></a></li>
-->
    </ul>

    <ul class="infoslider" style="display: none;">
        <li value=""   class="a_choose"  ><a></a></li>

    </ul>
    <div class="sl_ext">
        <a href="javascript:;" class="sl_e_more info-show" style="visibility: visible;">展开</a>
    </div>

</div>

       <input type="hidden" name="attr_url" value="{url:/ManagerDeal/ajaxGetCategory}"  />
<script type="text/javascript" src="{views:js/product/attr.js}" ></script>
            <!--start中间内容-->    
            <div class="user_c">
                <div class="user_zhxi pro_classify">
                    <div class="zhxi_tit">
                        <p><a>产品管理</a>><a>委托报盘</a></p>
                    </div>
                    <div class="center_tabl">
                    <div class="lx_gg">
                        <b>商品类型和规格</b>
                    </div>

                    {if: !empty($categorys)}
                        {foreach: items=$categorys item=$category key=$level}   
                            <div class="class_jy" id="level{$level}">
                                <span class="jy_title">市场类型：</span>
                                <ul>
                                    {foreach: items=$category['show'] item=$cate}
                                    <li value="{$cate['id']}"  {if: $key==0} class="a_choose" {/if} ><a>{$cate['name']}</a></li>
                                    {/foreach}
                                </ul>

                                    {if: !empty($category['hide'])}
                                    <ul class="infoslider" style="display: none;">
                                        {foreach: items=$category['hide'] item=$cate}
                                        <li value="{$cate['id']}"  ><a>{$cate['name']}</a></li>
                                        {/foreach}
                                    </ul>
                                        <div class="sl_ext">
                                        <a href="javascript:;" class="sl_e_more info-show" style="visibility: visible;">展开</a>
                                        </div>
                                    {/if}
                            </div>
                        {/foreach}
                        {/if}

                        <input type="hidden" name="uploadUrl"  value="{url:/ucenter/upload}" />
                    <form action="{url:/ManagerDeal/doDeputeOffer}" method="POST" auto_submit redirect_url="{url:/managerdeal/indexoffer}">
                        {include:/layout/product.tpl}
                            <tr>
                                <td></td>
                                <td>
                                    <span>
                                        <div>请您下载<a href="" style="color:#1852ca;font-size:14px;">《耐耐网自由报盘委托协议书》</a>，并签字扫描上传
                                         </div>
                                       <div class="zhxi_con">

                                           <div>
                                               <input type="file" name="file1" id="file1"  onchange="javascript:uploadImg(this);" />

                                           </div>
                                           <div  >
                                               <img name="file1" src=""/>
                                               <input type="hidden"  name="imgfile1" value=""  alt="请上传图片" />
                                           </div><!--img name属性与上传控件id相同-->


                                       </div>
                                    </span>
                                </td>
                            </tr>
                        <tr>
                            <td></td>
                            <td colspan="2" class="btn">
                            <input type="hidden" name='cate_id' id="cate_id" value="{$cate_id}">
                                <input  type="submit"  value="提交审核" />
                                <span class="color">委托金比例：{$rate}%</span>
                            </td>
                        </tr>
                         
                 </table>
                </form>
                        
                    </div>
                </div>
            </div>

            {$plupload}



