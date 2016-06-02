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
<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/layer/layer.js"></script>
<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/validform/formacc.js"></script>
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2-new_master/admin/public/views/pc/img/icons/posts.png" alt="" /> 报盘审核</h1>
<div class="bloc">
    <div class="title">
     审核信息
    </div>
    <div class="content">
        <div class="pd-20">
			 <div class="text-c"> 
			<input type="text" class="input-text" style="width:250px" placeholder="输入标号" id="" name="">
			<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜标号</button>
		</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量删除</a> </span> <span class="r">共有数据：<strong><?php echo isset($count)?$count:"";?></strong> 条</span> </div>
    <table class="table table-border table-bordered table-hover table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="12">报盘信息</th>
            </tr>
            <tr class="text-c">
                <th><input type="checkbox" value="" name=""></th>
                <th>ID</th>
                <th>用户名</th>
                <th>交易方式</th>
                <th>类型</th>
                <th>可否拆分</th>
                <th>数量</th>
                <th>挂牌价</th>
                <th>状态</th>

				<th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $key => $item){?>
                <tr class="text-c">
                    <td><input type="checkbox" value="" name=""></td>
                    <td><?php echo isset($item['id'])?$item['id']:"";?></td>
                    <td><a href="#"><?php echo isset($item['username'])?$item['username']:"";?></a></td>
                    <td><?php echo isset($item['type_txt'])?$item['type_txt']:"";?></td>
                    <td><?php echo isset($item['mode_txt'])?$item['mode_txt']:"";?></td>
                    <td><?php if($item['divide'] == 0){?>可拆分<?php }else{?>否<?php }?></td>
                    <td><?php echo isset($item['quantity'])?$item['quantity']:"";?></td>
                    <td><?php echo isset($item['price'])?$item['price']:"";?></td>
                    <td><?php echo isset($item['status_txt'])?$item['status_txt']:"";?></td>

                     <td class="td-manage"> <a title="查看" href="http://localhost/nn2-new_master/admin/public/trade/offermanage/reviewdetails/id/<?php echo $item['id'];?>/user/<?php echo $item['username'];?>" class="ml-5" style="text-decoration:none"><i class="icon-eye-open"></i></a> <a title="删除" href="javascript:;" ajax_status=-1 ajax_url="http://localhost/nn2-new_master/admin/public/trade/offermanage/logicdel/id/<?php echo $item['id'];?>"    class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
                </tr>
           <?php }?>
           
        </tbody>
    </table>
            <?php echo isset($bar)?$bar:"";?>
</div>


     
        
    </body>
</html>
</body>
</html>