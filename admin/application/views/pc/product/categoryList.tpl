
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 分类管理</h1>
<div class="bloc">
    <div class="title">
        分类列表
    </div>
    <div class="content">
        <div class="pd-20">

	 <div class="cl pd-5 bg-1 bk-gray">
		 <span class="l">

			 <a class="btn btn-primary radius" href="{url:trade/product/categoryAdd}">
				 <i class=" icon-plus"></i> 添加分类
			 </a>
		 </span>

	 </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="100">名称</th>
				<th width="90">属性</th>
				<th width="150">排序</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$cate}
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><u style="cursor:pointer" class="text-primary" >{$item['name']}</u></td>

				<td>{$item['attrs']}</td>
				<td>{$item['sort']}</td>
				<td class="td-status">
					{if:$item['status'] == 1}
						<span class="label label-success radius">已启用</span>
					{else:}
						<span class="label label-error radius">停用</span>
					{/if}
				</td>
				<td class="td-manage">
					{if:$item['status'] == 1}
					<a style="text-decoration:none" href="javascript:;" title="停用" ajax_status=0 ajax_url="{url:trade/product/setStatusCate?id=$item['id']}"><i class="icon-pause"></i></a>
					{elseif:$item['status'] == 0}
					<a style="text-decoration:none" href="javascript:;" title="启用" ajax_status=1 ajax_url="{url:trade/product/setStatusCate?id=$item['id']}"><i class="icon-play"></i></a>
					{/if}<a title="编辑" href="{url:trade/product/categoryAdd?cid=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>

					<a title="删除" href="javascript:;"  class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$bar}
	</div>
</div>
