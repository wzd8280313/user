        <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
        <script type="text/javascript" src="{views:js/validform/validform.js}"></script>
        <script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <script type="text/javascript" src="{views:js/layer/layer.js}"></script>
        <!--            
              CONTENT 
                        -->
        <script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
        <script type="text/javascript" src="{root:js/area/Area.js}" ></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />仓单管理
</h1>

<div class="bloc">
    <div class="title">
       仓单信息
    </div>
     <div class="pd-20">
	 	 <table class="table table-border table-bordered table-bg">
	 		<tr>
	 			<th>仓库</th>
	 			<td>{$detail['store_name']}</td>
	 			<th>库位</th>
	 			<td>{$detail['store_pos']}</td>
	 			<th>用户</th>
	 			<td>{$detail['user_id']}</td>
	 		</tr>
            <tr>
                <th>申请日期</th>
                <td>{$detail['create_time']}</td>
                <th>入库日期</th>
                <td>{$detail['in_time']}</td>
                <th>租库日期</th>
                <td>{$detail['rent_time']}</td>

            </tr>
      	 		<tr>
                    <th>商品名称</th>
                    <td>{$detail['product_name']}</td>
      	 			<th>商品分类</th>
      	 			<td>
                        {foreach:items=$detail['cate']}
                            {if:$key==0}
                                {$item['name']}
                            {else:}
                               / {$item['name']}
                            {/if}
                        {/foreach}
                    </td>
      	 			<th>产地</th>
      	 			<td id="areabox">{areatext:data=$detail['produce_area'] id=areabox }</td>

      	 		</tr>
            <tr>
                <th>数量</th>
                <td>{$detail['quantity']}</td>
              <th>计量单位</th>
              <td>{$detail['unit']}</td>
                <th>属性</th>
                <td>{$detail['attrs']}</td>
              
            </tr>
            <tr>

              <th>状态</th>
              <td>{$detail['status']}</td>
                <th></th>
                <td></td>
                <th></th>
                <td></td>
            </tr>
             <tr>

                 <th>图片</th>
                 <td>
                     {if:!empty($detail['photos'])}
                        {foreach:items=$detail['photos']}
                            <img src="{$item}" width="100"/>
                        {/foreach}
                     {/if}
                 </td>
                 <th></th>
                 <td></td>
                 <th></th>
                 <td></td>
             </tr>
             <tr>

                 <th>仓库审核时间</th>
                 <td>
                     {$detail['manager_time']}
                 </td>
                 <th>仓单签发时间</th>
                 <td>{$detail['sign_time']}</td>
                 <th>用户确认时间</th>
                 <td>{$detail['user_time']}</td>

             </tr>
             <tr>
                 <th>市场审核时间</th>
                 <td>{$detail['market_time']}</td>
                 <th scope="col" colspan="6">
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>
                 </th>
             </tr>

	 	</table>
 	</div>
</div>
</div>

        
    </body>
</html>