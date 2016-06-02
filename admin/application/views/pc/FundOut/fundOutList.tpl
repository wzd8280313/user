
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 线下出金</h1>
<div class="bloc">
    <div class="title">
        提现列表
    </div>
    <div class="content">
        <div class="pd-20">

	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="100">用户名</th>
				<th width="90">订单号</th>
				<th width="60">金额</th>
				<th width="50">状态</th>
				<th width="100">时间</th>
				<th width='100'>操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$outInfo}
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><u style="cursor:pointer" class="text-primary" >{$item['username']}</u></td>
				<td>{$item['request_no']}</td>
				<td>{$item['amount']}</td>


				<td>{echo:\fundOutModel::getFundOutStatustext($item['status'])}</td>
				<td>{$item['create_time']}</td>
				<td class="td-manage">
					<a title="审核" href="{url:/balance/fundOut/fundOutEdit}?id={$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>
					<a title="删除" href="javascript:void(0);" onclick="delFundOut({$item['id']},this)" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
			</tr>
		{/foreach}
		</tbody>
	<script type="text/javascript">
	function delFundOut(id,obj){
		var obj=$(obj);
		var url="{url:/balance/fundOut/del}";
		if(confirm("确定要删除吗")){
			$.ajax({
				type:'get',
				cache:false,
				data:{id:id},
				url:url,
				dataType:'json',
				success:function(msg){
					if(msg['code']==1){

						obj.parents("tr").remove();	
					}else{
						alert(msg['info']);
					}
				}			
			});
		}
	}
</script>
	</table>
		{$outBar}
	</div>
</div>