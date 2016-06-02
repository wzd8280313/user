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
        信誉制配置列表
    </div>
    <div class="content">
        <div class="pd-20">
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a class="btn btn-primary radius" href="http://localhost/nn2/admin/public/system/confsystem/creditOper/oper_type/1"><i class=" icon-plus"></i> 添加配置</a> </span>  </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<!-- <th width="25"><input type="checkbox" name="" value=""></th> -->
				<th width="80">参数名</th>
				<th width="100">中文名</th>
				<th width="100">参数类型</th>
				<th width="70">处理方式</th>
				<th width="50">参数值</th>
				<th width="50">排序</th>
				<th width="120">创建日期</th>
				<th width="170">解释说明</th>
				<th width="60">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($data as $key => $item){?>
			<tr class="text-c">
				<!-- <td><input type="checkbox" value="" name=""></td> -->
				<td><?php echo isset($item['name'])?$item['name']:"";?></td>
				<td><?php echo isset($item['name_zh'])?$item['name_zh']:"";?></td>
				<td><?php if($item['type'] == 1){?>百分比<?php }else{?>数值<?php }?></td>
				<td><?php if($item['sign'] == 1){?>减少<?php }else{?>增加<?php }?></td>
				<td><?php echo isset($item['value'])?$item['value']:"";?></td>
				<td><?php echo isset($item['sort'])?$item['sort']:"";?></td>
				<td><?php echo isset($item['time'])?$item['time']:"";?></td>
				<td><?php echo isset($item['note'])?$item['note']:"";?></td>
				<td class="td-manage">
				<a title="编辑" href="http://localhost/nn2/admin/public/system/confsystem/creditOper/oper_type/2/name/<?php echo isset($item['name'])?$item['name']:"";?>" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a> 
				<a title="删除" href="javascript:;" ajax_status=-1 ajax_url="http://localhost/nn2/admin/public/system/confsystem/creditDel/name/<?php echo isset($item['name'])?$item['name']:"";?>" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
			</tr>
		<?php }?>
		</tbody>

	</table>
		<?php echo isset($bar)?$bar:"";?>
	</div>
</div>

</body>
</html>