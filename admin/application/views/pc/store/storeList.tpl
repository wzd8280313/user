<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 仓库管理</h1>
<div class="bloc">
    <div class="title">
        仓库列表
    </div>
    <div class="content">
        <div class="pd-20">
	<div class="text-c">
		<input type="text" class="input-text" style="width:250px" placeholder="输入仓库名称" id="" name="">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search"></i> 搜仓库</button>
	</div>
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"><a class="btn btn-primary radius" href="{url:store/store/storeAdd}"><i class=" icon-plus"></i> 添加仓库</a> </span>  </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="80">图片</th>
				<th width="100">仓库名</th>
				<th width="90">仓库简称</th>
				<th width="150">地区</th>
				<th width="130">类型</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$store}
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>{$item['id']}</td>
				<td><img widht="180" height="180" src="{echo:\Library\thumb::get($item['img'],180,180)}"/> </td>
				<td><u style="cursor:pointer" class="text-primary" >{$item['name']}</u></td>

				<td>{$item['short_name']}</td>
				<td> <span id="areaText">{areatext:data=$item['area']}</span></td>
				<td>{echo:$store_type[$item['type']]}</td>
				<td class="td-status">
					{if:$item['status'] == 1}

						<span class="label label-success radius">已启用</span>
					{else:}
						<span class="label label-error radius">停用</span>
					{/if}
				</td>
				<td class="td-manage">
					{if:$item['status'] == 1}
						<a style="text-decoration:none" href="javascript:;" title="停用" ajax_status=0 ajax_url="{url:store/store/setStatus?id=$item['id']}"><i class="icon-pause"></i></a>
					{elseif:$item['status'] == 0}
						<a style="text-decoration:none" href="javascript:;" title="启用" ajax_status=1 ajax_url="{url:store/store/setStatus?id=$item['id']}"><i class="icon-play"></i></a>
					{/if}
					<a title="编辑" href="{url:store/store/storeAdd?id=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i>

					<a title="删除" href="javascript:;"  ajax_status=1 ajax_url="{url:store/store/logicDel?id=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$bar}
	</div>
</div>
