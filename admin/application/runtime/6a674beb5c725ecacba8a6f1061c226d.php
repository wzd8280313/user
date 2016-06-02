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
<script type="text/javascript" src='http://localhost/nn2-new_master/admin/public/js/upload/ajaxfileupload.js'></script>
<script type="text/javascript" src='http://localhost/nn2-new_master/admin/public/js/upload/upload.js'></script>
<link rel="stylesheet" href="http://localhost/nn2-new_master/admin/public/views/pc/content/settings/style.css" />
<link rel="stylesheet" type="text/css" href="http://localhost/nn2-new_master/admin/public/views/pc/css/H-ui.admin.css">

<!--
      CONTENT
                -->
<div id="content" class="white">
    <h1><img src="http://localhost/nn2-new_master/admin/public/views/pc/img/icons/dashboard.png" alt="" />出金审核
    </h1>

    <div class="bloc">
        <div class="title">
            报盘详情
        </div>
        <div class="pd-20">
            <table class="table table-border table-bordered table-bg">
                <tr>

                    <th>当前状态</th>
                    <td> <?php echo isset($outInfo['statusText'])?$outInfo['statusText']:"";?></td>
                    <th>用户名</th>
                    <td> <?php echo isset($outInfo['username'])?$outInfo['username']:"";?></td>
                </tr>
                <tr>

                    <th>手机号</th>
                    <td><?php echo isset($outInfo['mobile'])?$outInfo['mobile']:"";?></td>
                    <th>开户名</th>
                    <td><?php echo isset($outInfo['true_name'])?$outInfo['true_name']:"";?></td>
                </tr>
                <tr>

                    <th>开户银行</th>
                    <td><?php echo isset($outInfo['bank_name'])?$outInfo['bank_name']:"";?></td>
                    <th>银行卡号</th>
                    <td><?php echo isset($outInfo['card_no'])?$outInfo['card_no']:"";?></td>

                </tr>
                <tr>
                    <th>订单号：</th>
                    <td><?php echo isset($outInfo['request_no'])?$outInfo['request_no']:"";?></td>
                    <th>金额：</th>
                    <td><?php echo isset($outInfo['amount'])?$outInfo['amount']:"";?> </td>

                </tr>
                <tr>

                    <th>提现说明：：</th>
                    <td><?php echo isset($outInfo['note'])?$outInfo['note']:"";?></td>
                    <th>申请时间：</th>
                    <td><?php echo isset($outInfo['create_time'])?$outInfo['create_time']:"";?></td>
                </tr>
                <tr>
                    <th>开户凭证：</th>
                    <td>  <img id='image1' src='<?php echo isset($outInfo["bank_proof"])?$outInfo["bank_proof"]:"";?>'></td>
                    <th></th>
                    <td></td>
                </tr>
                <?php if($outInfo['first_time']!=null){?>
                    <tr>

                        <th>初审时间</th>
                        <td><?php echo isset($reInfo['first_time'])?$reInfo['first_time']:"";?></td>
                        <th>初审意见</th>
                        <td><?php echo isset($reInfo['first_message'])?$reInfo['first_message']:"";?></td>

                    </tr>
                <?php }?>
                <?php if($outInfo['final_time']!=null){?>
                    <tr>

                        <th>终审时间</th>
                        <td><?php echo isset($reInfo['final_time'])?$reInfo['final_time']:"";?></td>
                        <th>终审意见</th>
                        <td><?php echo isset($reInfo['final_message'])?$reInfo['final_message']:"";?></td>
                    </tr>
                <?php }?>
                <?php if($outInfo['proot']!=null){?>
                    <tr>
                        <th>打款凭证/th>
                           <td> <img id='image2' src='<?php echo isset($outInfo["proot"])?$outInfo["proot"]:"";?>'></td>
                    </tr>
                <?php }?>
                <?php if($outInfo['action']=='transfer'){?>
                    <tr>
                        <th>上传打款凭证</th>
                        <td>  <input type="hidden" name="uploadUrl"             value="http://localhost/nn2-new_master/admin/public/balance/fundOut/upload" />
                            <input type='file' name="file2" id="file2"  onchange="javascript:uploadImg(this);" /></td>
                        <th></th>
                        <td>   <img name="file2" />
                            <input type="hidden" name="imgfile2" id="imgfile2" /></td>
                    </tr>
                    <tr>
                        <th scope="col" colspan="6">
                            <a href="javascript:;" class="btn btn-danger radius passProot"><i class="icon-ok"></i> 通过</a>
                            <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>

                        </th>

                    </tr>
                <?php }?>
                <?php if($outInfo['action']!=null&&$outInfo['action']!='transfer'){?>
                    <tr>
                        <th scope="col" colspan="6">
                            <a href="javascript:;" class="btn btn-danger radius pass"><i class="icon-ok"></i> 确定</a>
                            <a href="javascript:;" class="btn btn-primary radius ref"><i class="icon-remove"></i> 不通过</a>
                            <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>

                        </th>

                    </tr>
                    <tr>
                        <th scope="col" colspan="6">
                            意见: <textarea name="message" id="message" ><?php echo isset($outInfo['url'])?$outInfo['url']:"";?></textarea>
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
        $('a.passProot').click(function(){
            var proot=$('#imgfile2  ').val();


            setProot(proot);
        });
        $('a.ref').click(function(){
            $(this).unbind('click');
            msg = '已驳回';
            setStatus(0,msg,mess);
        })
        function setProot(imgfile2){
            if(imgfile2==null){
                lay.msg('请上传图片');
                return false;
            }
            formacc.ajax_post("<?php echo isset($outInfo['url'])?$outInfo['url']:"";?>",{out_id:"<?php echo isset($outInfo['id'])?$outInfo['id']:"";?>",imgfile2:imgfile2},function(){

                    layer.msg("上传成功稍后自动跳转");
                    setTimeout(function(){
                        window.location.href = "http://localhost/nn2-new_master/admin/public/balance/fundout/fundoutlist";
                    },1500);

            });
        }
        function setStatus(status,msg,mess){
            formacc.ajax_post("<?php echo isset($outInfo['url'])?$outInfo['url']:"";?>",{out_id:"<?php echo isset($outInfo['id'])?$outInfo['id']:"";?>",status:status,message:mess},function(){
                layer.msg(msg+"稍后自动跳转");
             setTimeout(function(){
                    window.location.href = "http://localhost/nn2-new_master/admin/public/balance/fundout/fundoutlist";
                },1500);
            });
        }
    })

</script>

</body>
</html>
</body>
</html>