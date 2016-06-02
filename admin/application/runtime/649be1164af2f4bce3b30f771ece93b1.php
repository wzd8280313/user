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
﻿
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 仓单管理</h1>
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
		<?php foreach($list as $key => $item){?>
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><?php echo isset($item['id'])?$item['id']:"";?></td>
				<td><?php echo isset($item['pname'])?$item['pname']:"";?></td>
				<td><u style="cursor:pointer" class="text-primary" ><?php echo isset($item['cname'])?$item['cname']:"";?></u></td>

				<td><?php if(!empty($item['attribute'])){?>
					<?php foreach($item['attribute'] as $k => $v){?>
						<?php echo isset($attr[$k])?$attr[$k]:"";?>:<?php echo isset($v)?$v:"";?></br>
					<?php }?>
					<?php }?>

				</td>
				<td><?php echo isset($item['quantity'])?$item['quantity']:"";?></td>
				<td><?php echo isset($item['sname'])?$item['sname']:"";?></td>
				<td><?php echo isset($item['status_txt'])?$item['status_txt']:"";?></td>
				<td class="td-manage">
					<a title="编辑" href="http://localhost/nn2/admin/public/store/storeproduct/reviewdetails/id/<?php echo $item['id'];?>" class="ml-5" style="text-decoration:none">
						<i class="icon-edit"></i>
					</a>
					<a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i>
					</a>

				</td>
			</tr>
		<?php }?>
		</tbody>

	</table>
		<?php echo isset($bar)?$bar:"";?>
	</div>
</div>

</body>
</html>