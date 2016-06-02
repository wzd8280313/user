        <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
        <script type="text/javascript" src="{views:js/validform/validform.js}"></script>
        <script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <script type="text/javascript" src="{views:js/layer/layer.js}"></script>
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />报盘管理
</h1>

<div class="bloc">
    <div class="title">
       报盘信息
    </div>
     <div class="pd-20">
	 	 <table class="table table-border table-bordered table-bg">
	 		<tr>

	 			<th>委托方</th>
	 			<td>{$info['user']}</td>
	 		</tr>
            <tr>
                <th>交易方式</th>
                <td>{$info['type']}</td>
                <th>报盘类型</th>
                <td>{$info['mode_txt']}</td>
                <th></th>
                <td></td>
            </tr>
      	 		<tr>
                    <th>商品大类</th>
                    <td>{$info['topcate_name']}</td>
      	 			<th>商品种类</th>
      	 			<td>{$info['parent_cates']}</td>
      	 			<th>可否拆分</th>
      	 			<td>{if:$info['divide'] == 0}可拆分{else:}否{/if}</td>

      	 		</tr>
            <tr>
                <th>报盘数量</th>
                <td>{$info['quantity']}</td>
              <th>计量单位</th>
              <td>{$info['unit']}</td>
                <th></th>
                <td></td>
              
            </tr>
            <tr>

              <th>挂牌价</th>
              <td>{$info['price']}</td>
              <th>状态</th>
              <td>{$info['status_txt']}</td>
                <th></th>
                <td></td>
            </tr>


            <tr>
              <th scope="col" colspan="6">
                 <a href="javascript:;" class="btn btn-danger radius pass"><i class="icon-ok"></i> 通过</a> 
                 <a href="javascript:;" class="btn btn-primary radius ref"><i class="icon-remove"></i> 不通过</a>
                 <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>
              </th>
            </tr>
	 	</table>
 	</div>
</div>
</div>
      <script type="text/javascript">
        $(function(){
          var formacc = new nn_panduo.formacc();
          var status = '';
          $('a.pass').click(function(){
            $(this).unbind('click');
            msg = '已通过';
            setStatus(1,msg);
          })

          $('a.ref').click(function(){
            $(this).unbind('click');
            msg = '已驳回';
            setStatus(0,msg);
          })

          function setStatus(status,msg){
            formacc.ajax_post("{url:trade/OfferManage/setStatus}",{status:status,id:{$info['id']}},function(){
              layer.msg(msg+"稍后自动跳转");
                  setTimeout(function(){
                      window.location.href = "{url:trade/OfferManage/offerReview}";
                  },1500);
            });
          }
        })

      </script>
        
    </body>
</html>