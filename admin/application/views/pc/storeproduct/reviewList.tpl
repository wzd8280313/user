
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 仓单管理</h1>
<div class="bloc">
    <div class="title">
        仓单审核
    </div>
    <div class="content">
        <div class="pd-20">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker()" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker()" id="datemax" class="input-text Wdate" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search"></i> 搜会员</button>
	</div>
	 <div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="80">商品名称</th>
				<th width="100">市场分类</th>
				<th width="150">规格</th>
				<th width="150">重量</th>
				<th width="130">仓库</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$list}
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>{$item['id']}</td>
				<td>{$item['pname']}</td>
				<td><u style="cursor:pointer" class="text-primary" >{$item['cname']}</u></td>

				<td>{if:!empty($item['attribute'])}
					{foreach:items=$item['attribute'] key=$k item=$v}
						{$attr[$k]}:{$v}</br>
					{/foreach}
					{/if}

				</td>
				<td>{$item['quantity']}</td>
				<td>{$item['sname']}</td>
				<td>{$item['status_txt']}</td>
				<td class="td-manage">
					<a title="编辑" href="{url:store/storeProduct/reviewDetails?id=$item['id']}" class="ml-5" style="text-decoration:none">
						<i class="icon-edit"></i>
					</a>
					<a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i>
					</a>

				</td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$bar}
	</div>
</div>
