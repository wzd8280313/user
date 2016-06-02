   <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
    <script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
  <script language="javascript" type="text/javascript" src="{views:js/My97DatePicker/WdatePicker.js}"></script>

        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 代理商管理</h1>
<div class="bloc">
    <div class="title">
		代理商列表
    </div>
    <div class="content">
        <div class="pd-20">
        <form action="{url:member/agent/agentList}">
	<div class="text-c"> <input type="text" name="username" class="input-text" style="width:250px" placeholder="输入会员名称">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search"></i> 搜会员</button>
	</div>
	</form>
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l">
			 <a class="btn btn-primary radius" href="{url:member/agent/addAgent/}"><i class=" icon-plus"></i> 添加代理商</a> </span>
	 </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="90">手机</th>
				<th width="150">邮箱</th>
				<th width="130">公司名称</th>
				<th width="130">联系人名称</th>
				<th width="130">联系电话</th>
				<th width="70">状态</th>
				<th width="130">加入时间</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$agentData key=$k}
		{set:$k++}
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>{$k}</td>
				<td><u style="cursor:pointer" class="text-primary" onclick="member_show('张三','member-show.html','10001','360','400')">{$item['username']}</u></td>

				<td>{$item['mobile']}</td>
				<td>{$item['email']}</td>
				<td>{$item['company_name']}</td>
				<td>{$item['contact']}</td>
				<td>{$item['contact_phone']}</td>
				<td class="td-status">
				{if:$item['status'] == 1}
				<span class="label label-success radius">已启用</span>
				{else:}
					<span class="label label-error radius">停用</span>
				{/if}
				</td>
				<td>{$item['create_time']}</td>
				<td class="td-manage">
				{if:$item['status'] == 1}
				<a style="text-decoration:none" ajax_status=0  ajax_url="{url:member/agent/ajaxUpdateAgentStatus?id=$item['id']}"  href="javascript:;" title="停用"><i class="icon-pause"></i></a>
				{else:}
				<a style="text-decoration:none" ajax_status=1  ajax_url="{url:member/agent/ajaxUpdateAgentStatus?id=$item['id']}"  href="javascript:;" title="启用"><i class="icon-play"></i></a>
				{/if}
				<a title="编辑" href="{url:member/agent/addAgent?id=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>
				<a title="删除" href="javascript:;" ajax_status=-1 ajax_url="{url:member/agent/deleteAgent?id=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$bar}
	</div>
</div>
