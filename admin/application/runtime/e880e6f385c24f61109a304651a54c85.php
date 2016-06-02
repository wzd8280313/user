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
<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/validform/validform.js"></script>
<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/validform/formacc.js"></script>
<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/layer/layer.js"></script>
<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/content/settings/main.js"></script>
<link rel="stylesheet" href="http://localhost/nn2-new_master/admin/public/views/pc/content/settings/style.css" />
<link rel="stylesheet" type="text/css" href="http://localhost/nn2-new_master/admin/public/views/pc/css/H-ui.admin.css">

<!--
      CONTENT
                -->
<div id="content" class="white">
    <h1><img src="http://localhost/nn2-new_master/admin/public/views/pc/img/icons/dashboard.png" alt="" />推荐管理
    </h1>

    <div class="bloc">
        <div class="title">
            推荐信息
        </div>
        <div class="pd-20">
            <table class="table table-border table-bordered table-bg">
                <tr>

                    <th>推荐类型</th>
                    <?php  $type=\nainai\companyRec::getRecType(); ?>
                    <td>
                        <select name="type" id="type">
                            <?php foreach($type as $key => $item){?>
                                <option value="<?php echo isset($key)?$key:"";?>"
                                <?php if( $key=$recInfo['type']==$key){?>"selected"<?php }?>
                                ><?php echo isset($item)?$item:"";?><option>
                            <?php }?>
                        </select>
                    </td>
                    <th>用户名</th>
                        <td><?php echo isset($recInfo['username'])?$recInfo['username']:"";?></td>
                </tr>
                <tr>
                    <th>企业名称</th>
                    <td><?php echo isset($recInfo['company_name'])?$recInfo['company_name']:"";?></td>
                    <th>手机号</th>
                    <td><?php echo isset($recInfo['mobile'])?$recInfo['mobile']:"";?></td>

                </tr>
                <tr>

                    <th>分类</th>
                    <td><?php echo isset($recInfo['pname'])?$recInfo['pname']:"";?></td>
                    <th>状态</th>
                    <td>开启
                        <input type="radio" name="status"value="1" <?php if($recInfo['status']==1){?>checked="checked"<?php }?>/>
                        关闭
                        <input type="radio" name="status" value="0"<?php if($recInfo['status']==0){?>checked="checked"<?php }?>/>
                    </td>

                </tr>
                <tr>
                    <th>开始时间：</th>
                    <td>
                        <input type="text" name="start_time" value="<?php echo isset($recInfo['start_time'])?$recInfo['start_time']:"";?>" />
                    <th>结束：</th>
                    <td><input type="text" name='end_time' value="<?php echo isset($recInfo['end_time'])?$recInfo['end_time']:"";?>" /></td>

                </tr>
                    <tr>
                        <th scope="col" colspan="6">
                            <a href="javascript:;" class="btn btn-danger radius pass"><i class="icon-ok"></i> 保存</a>
                            <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>

                        </th>

                    </tr>


            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        var formacc = new nn_panduo.formacc();


        $('a.pass').click(function(){
            //$(this).unbind('click');
            var data={
                id:"<?php echo isset($recInfo['id'])?$recInfo['id']:"";?>",
                status:$("input[name='status']:checked").val(),
                type:$('#type').val(),
                start_time:$("input[name='start_time']").val(),
                end_time:$('input[name="end_time"]').val(),
                user_id:"<?php echo isset($recInfo['user_id'])?$recInfo['user_id']:"";?>"
            };
            msg = '已保存';
            setStatus(data,msg);
        })
        function setStatus(data,msg){
            formacc.ajax_post("http://localhost/nn2-new_master/admin/public/member/companyrec/recedit",data,function(){
                layer.msg(msg+"稍后自动跳转");
               /* setTimeout(function(){
                    window.location.href = "http://localhost/nn2-new_master/admin/public/balance/fundin/offlinelist";
                },1500);*/
            });
        }
    })

</script>

</body>
</html>
</body>
</html>