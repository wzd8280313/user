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
﻿<script type="text/javascript" src="http://localhost/nn2/admin/public/js/area/Area.js" ></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/js/area/AreaData_min.js" ></script>
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 仓库管理</h1>
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
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"><a class="btn btn-primary radius" href="http://localhost/nn2/admin/public/store/store/storeadd"><i class=" icon-plus"></i> 添加仓库</a> </span>  </div>
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
		<?php foreach($store as $key => $item){?>
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><?php echo isset($item['id'])?$item['id']:"";?></td>
				<td><img widht="180" height="180" src="<?php echo \Library\thumb::get($item['img'],180,180);?>"/> </td>
				<td><u style="cursor:pointer" class="text-primary" ><?php echo isset($item['name'])?$item['name']:"";?></u></td>

				<td><?php echo isset($item['short_name'])?$item['short_name']:"";?></td>
				<td> <span id="areaText">                <script type="text/javascript">
                 areaTextObj = new Area();

                  $(function () {
                    var text = areaTextObj.getAreaText('<?php echo $item['area'] ; ?>',' ');
                    $('#areaText').html(text);
                  });
                </script>
</span></td>
				<td><?php echo $store_type[$item['type']];?></td>
				<td class="td-status">
					<?php if($item['status'] == 1){?>

						<span class="label label-success radius">已启用</span>
					<?php }else{?>
						<span class="label label-error radius">停用</span>
					<?php }?>
				</td>
				<td class="td-manage">
					<?php if($item['status'] == 1){?>
						<a style="text-decoration:none" href="javascript:;" title="停用" ajax_status=0 ajax_url="http://localhost/nn2/admin/public/store/store/setstatus/id/<?php echo $item['id'];?>"><i class="icon-pause"></i></a>
					<?php }elseif($item['status'] == 0){?>
						<a style="text-decoration:none" href="javascript:;" title="启用" ajax_status=1 ajax_url="http://localhost/nn2/admin/public/store/store/setstatus/id/<?php echo $item['id'];?>"><i class="icon-play"></i></a>
					<?php }?>
					<a title="编辑" href="http://localhost/nn2/admin/public/store/store/storeadd/id/<?php echo $item['id'];?>" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i>

					<a title="删除" href="javascript:;"  ajax_status=1 ajax_url="http://localhost/nn2/admin/public/store/store/logicdel/id/<?php echo $item['id'];?>" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
			</tr>
		<?php }?>
		</tbody>

	</table>
		<?php echo isset($bar)?$bar:"";?>
	</div>
</div>

</body>
</html>