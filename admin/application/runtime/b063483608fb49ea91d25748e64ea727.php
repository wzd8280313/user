<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>

	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/min.css" />
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="http://localhost/nn2/admin/public/views/pc/css/H-ui.min.css">
</head>
<body>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 系统管理</h1>
<div class="bloc">
    <div class="title">
        分组列表
    </div>
    <div class="content">
        <div class="pd-20">
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a class="btn btn-primary radius" href="http://localhost/nn2/admin/public/system/rbac/roleAdd/"><i class=" icon-plus"></i> 添加分组</a> </span>  </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="80">ID</th>
				<th width="100">分组名</th>
				<th width="100">备注</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($data as $key => $item){?>
			<tr class="text-c">
				<td><?php echo isset($item['id'])?$item['id']:"";?></td>
				<td><?php echo isset($item['name'])?$item['name']:"";?></td>
				<td><?php echo isset($item['remark'])?$item['remark']:"";?></td>
				<td class="td-status">
					<?php if($item['status'] == 0){?>
						<span class="label label-success radius">已启用</span>
					<?php }else{?>
						<span class="label label-error radius">停用</span>
					<?php }?>
				</td>
				<td class="td-manage">
					<?php if($item['status'] == 0){?>
					<a style="text-decoration:none" href="javascript:;" title="停用" ajax_status=1 ajax_url="http://localhost/nn2/admin/public/system/rbac/setStatus/id/<?php echo isset($item['id'])?$item['id']:"";?>"><i class="icon-pause"></i></a>
					<?php }elseif($item['status'] == 1){?>
					<a style="text-decoration:none" href="javascript:;" title="启用" ajax_status=0 ajax_url="http://localhost/nn2/admin/public/system/rbac/setStatus/id/<?php echo isset($item['id'])?$item['id']:"";?>"><i class="icon-play"></i></a>
					<?php }?>
				 <a title="编辑" href="http://localhost/nn2/admin/public/system/rbac/roleUpdate/id/<?php echo isset($item['id'])?$item['id']:"";?>" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a> 
				 <a title="删除" href="javascript:;" ajax_status=-1 ajax_url="http://localhost/nn2/admin/public/system/rbac/roleDel/id/<?php echo isset($item['id'])?$item['id']:"";?>" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>

				 
			</tr>
		<?php }?>
		</tbody>

	</table>
		<?php echo isset($bar)?$bar:"";?>
	</div>
</div>
<script type="text/javascript">
	;$(function(){
		$('.search-admin').click(function(){
			var name = $(this).siblings('input').val();
			window.location.href = "http://localhost/nn2/admin/public/system/admin/adminList/"+"?name="+name;
		});
	})
</script>




</body>
</html>