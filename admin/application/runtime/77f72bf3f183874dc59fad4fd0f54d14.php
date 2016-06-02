<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>

	<link rel="stylesheet" href="http://localhost/nn2-new_master/admin/public/views/pc/css/min.css" />
	<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="http://localhost/nn2-new_master/admin/public/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="http://localhost/nn2-new_master/admin/public/views/pc/css/H-ui.min.css">
</head>
<body>

        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2-new_master/admin/public/views/pc/img/icons/posts.png" alt="" /> 线下入金</h1>
<div class="bloc">
    <div class="title">
        线下列表
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
		<?php foreach($offlineInfo as $key => $item){?>
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><u style="cursor:pointer" class="text-primary" ><?php echo isset($item['username'])?$item['username']:"";?></u></td>
				<td><?php echo isset($item['order_no'])?$item['order_no']:"";?></td>
				<td><?php echo isset($item['amount'])?$item['amount']:"";?></td>


				<td><?php echo \fundInModel::getOffLineStatustext($item['status']);?></td>
				<td><?php echo isset($item['create_time'])?$item['create_time']:"";?></td>
				<td class="td-manage">
					<a title="审核" href="http://localhost/nn2-new_master/admin/public/balance/fundin/offlineEdit/?id=<?php echo isset($item['id'])?$item['id']:"";?>" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>
					<a title="删除" href="javascript:void(0);" onclick="delOffline(<?php echo isset($item['id'])?$item['id']:"";?>,this)" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
			</tr>
		<?php }?>
		</tbody>
	<script type="text/javascript">
	function delOffline(id,obj){
		var obj=$(obj);
		var url="http://localhost/nn2-new_master/admin/public/balance/fundin/del/";
		if(confirm("确定要删除吗")){
			$.ajax({
				type:'get',
				cache:false,
				data:{id:id},
				url:url,
				success:function(msg){
					if(msg==1){
						obj.parents("tr").remove();	
					}else{
						alert('删除失败');
					}
				}			
			});
		}
	}
</script>
	</table>
		<?php echo isset($reBar)?$reBar:"";?>
	</div>
</div>

</body>
</html>