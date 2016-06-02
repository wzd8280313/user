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
    <h1><img src="http://localhost/nn2-new_master/admin/public/views/pc/img/icons/dashboard.png" alt="" />报盘管理
    </h1>

    <div class="bloc">
        <div class="title">
            报盘信息
        </div>
        <div class="pd-20">
            <table class="table table-border table-bordered table-bg">
                <tr>

                    <th>当前状态</th>
                    <td><?php echo isset($reInfo['statusText'])?$reInfo['statusText']:"";?></td>
                    <th>用户名</th>
                    <td><?php echo isset($reInfo['username'])?$reInfo['username']:"";?></td>
                </tr>
                <tr>

                    <th>手机号</th>
                    <td><?php echo isset($reInfo['mobile'])?$reInfo['mobile']:"";?></td>
                    <th>支付方式</th>
                    <td>线下</td>
                </tr>
                <tr>

                    <th>订单号</th>
                    <td><?php echo isset($reInfo['order_no'])?$reInfo['order_no']:"";?></td>
                    <th>金额</th>
                    <td><?php echo isset($reInfo['amount'])?$reInfo['amount']:"";?></td>

                </tr>
                <tr>
                    <th>申请时间：</th>
                    <td><?php echo isset($reInfo['create_time'])?$reInfo['create_time']:"";?></td>
                    <th>凭证：</th>
                    <td><img src='<?php echo isset($reInfo['proot'])?$reInfo['proot']:"";?>'>  </td>

                </tr>
                <?php if($reInfo['first_time']!=null){?>
                <tr>

                    <th>初审时间</th>
                    <td><?php echo isset($reInfo['first_time'])?$reInfo['first_time']:"";?></td>
                    <th>初审意见</th>
                    <td><?php echo isset($reInfo['first_message'])?$reInfo['first_message']:"";?></td>

                </tr>
                <?php }?>
                <?php if($reInfo['final_time']!=null){?>
                    <tr>

                        <th>终审时间</th>
                        <td><?php echo isset($reInfo['final_time'])?$reInfo['final_time']:"";?></td>
                        <th>终审意见</th>
                        <td><?php echo isset($reInfo['final_message'])?$reInfo['final_message']:"";?></td>
                    </tr>
                <?php }?>
                <?php if($reInfo['action']!=null){?>
                <tr>
                    <th scope="col" colspan="6">
                        <a href="javascript:;" class="btn btn-danger radius pass"><i class="icon-ok"></i> 通过</a>
                        <a href="javascript:;" class="btn btn-primary radius ref"><i class="icon-remove"></i> 不通过</a>
                        <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>

                    </th>

                </tr>
                <tr>
                    <th scope="col" colspan="6">
                       意见: <textarea name="message" id="message" value="<?php echo isset($reInfo['action'])?$reInfo['action']:"";?>"><?php echo isset($reInfo['url'])?$reInfo['url']:"";?></textarea>
                    </th>

                </tr>
            <?php }?>

            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        var formacc = new nn_panduo.formacc();
        var status = '';
        var mess=$('#message').val();
        $('a.pass').click(function(){
            $(this).unbind('click');
            msg = '已通过';
            setStatus(1,msg,mess);
        })

        $('a.ref').click(function(){
            $(this).unbind('click');
            msg = '已驳回';
            setStatus(0,msg,mess);
        })

        function setStatus(status,msg,mess){
            formacc.ajax_post("<?php echo isset($reInfo['url'])?$reInfo['url']:"";?>",{re_id:"<?php echo isset($reInfo['id'])?$reInfo['id']:"";?>",status:status,message:mess},function(){
                layer.msg(msg+"稍后自动跳转");
                setTimeout(function(){
                    window.location.href = "http://localhost/nn2-new_master/admin/public/balance/fundin/offlinelist";,1500);
            });
        }
    })

</script>

</body>
</html>
</body>
</html>