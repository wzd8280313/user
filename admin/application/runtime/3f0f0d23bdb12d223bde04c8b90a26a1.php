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
    <h1><img src="http://localhost/nn2-new_master/admin/public/views/pc/img/icons/posts.png" alt="" /> 推荐商户</h1>
    <div class="bloc">
        <div class="title">
            推荐列表
        </div>
        <div class="content">
            <div class="pd-20">

                <div class="mt-20">
                    <table class="table table-border table-bordered table-hover table-bg table-sort">
                        <thead>
                        <tr class="text-c">
                            <th width="25"><input type="checkbox" name="" value=""></th>
                            <th width="100">用户名</th>
                            <th width="90">企业名</th>
                            <th width="60">推荐类型</th>
                            <th width="50">开始时间</th>
                            <th width="80">结束时间</th>
                            <th width="80">状态</th>
                            <th width='100'>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($recList as $key => $item){?>
                            <tr class="text-c">
                                <td><input type="checkbox" value="" name=""></td>
                                <td><u style="cursor:pointer" class="text-primary" ><?php echo isset($item['username'])?$item['username']:"";?></u></td>
                                <td><?php echo isset($item['company_name'])?$item['company_name']:"";?></td>
                                <td><?php echo  \nainai\companyRec::getRecType($item['type']);?></td>
                                <td><?php echo isset($item['start_time'])?$item['start_time']:"";?></td>
                                <td><?php echo isset($item['end_time'])?$item['end_time']:"";?></td>
                                <td><?php if($item['status']==1){?>开启<?php }else{?>关闭<?php }?></td>
                                <td class="td-manage">
                                    <a title="审核" href="http://localhost/nn2-new_master/admin/public/member/companyrec/recEdit/?id=<?php echo isset($item['id'])?$item['id']:"";?>" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>
                                    <a title="删除" href="javascript:void(0);" onclick="delRec(<?php echo isset($item['id'])?$item['id']:"";?>,this)" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
                            </tr>
                        <?php }?>
                        </tbody>
                        <script type="text/javascript">
                            function delRec(id,obj){
                                var obj=$(obj);
                                var url="http://localhost/nn2-new_master/admin/public/member/companyrec/del/";
                                if(confirm("确定要删除吗")){
                                    $.ajax({
                                        type:'get',
                                        cache:false,
                                        data:{id:id},
                                        url:url,
                                        dataType:'json',
                                        success:function(ms){
                                            if(msg['code']==1){
                                                layer.msg(ms['info'],{time:2000});
                                                obj.parents("tr").remove();
                                            }else{
                                                layer.msg(ms['info'],{time:2000,btn:['OK']});
                                            }
                                        }
                                    });
                                }
                            }
                        </script>
                    </table>
                    <?php echo isset($pageBar)?$pageBar:"";?>
                </div>
            </div>
</body>
</html>