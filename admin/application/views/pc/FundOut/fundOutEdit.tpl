<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/validform/validform.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:content/settings/main.js}"></script>
<script type="text/javascript" src='{root:js/upload/ajaxfileupload.js}'></script>
<script type="text/javascript" src='{root:js/upload/upload.js}'></script>
<link rel="stylesheet" href="{views:content/settings/style.css}" />
<link rel="stylesheet" type="text/css" href="{views:css/H-ui.admin.css}">

<!--
      CONTENT
                -->
<div id="content" class="white">
    <h1><img src="{views:img/icons/dashboard.png}" alt="" />出金审核
    </h1>

    <div class="bloc">
        <div class="title">
            报盘详情
        </div>
        <div class="pd-20">
            <table class="table table-border table-bordered table-bg">
                <tr>

                    <th>当前状态</th>
                    <td> {$outInfo['statusText']}</td>
                    <th>用户名</th>
                    <td> {$outInfo['username']}</td>
                </tr>
                <tr>

                    <th>手机号</th>
                    <td>{$outInfo['mobile']}</td>
                    <th>开户名</th>
                    <td>{$outInfo['true_name']}</td>
                </tr>
                <tr>

                    <th>开户银行</th>
                    <td>{$outInfo['bank_name']}</td>
                    <th>银行卡号</th>
                    <td>{$outInfo['card_no']}</td>

                </tr>
                <tr>
                    <th>订单号：</th>
                    <td>{$outInfo['request_no']}</td>
                    <th>金额：</th>
                    <td>{$outInfo['amount']} </td>

                </tr>
                <tr>

                    <th>提现说明：：</th>
                    <td>{$outInfo['note']}</td>
                    <th>申请时间：</th>
                    <td>{$outInfo['create_time']}</td>
                </tr>
                <tr>
                    <th>开户凭证：</th>
                    <td>  <img id='image1' src='{$outInfo["bank_proof"]}'></td>
                    <th></th>
                    <td></td>
                </tr>
                {if:$outInfo['first_time']!=null}
                    <tr>

                        <th>初审时间</th>
                        <td>{$reInfo['first_time']}</td>
                        <th>初审意见</th>
                        <td>{$reInfo['first_message']}</td>

                    </tr>
                {/if}
                {if:$outInfo['final_time']!=null}
                    <tr>

                        <th>终审时间</th>
                        <td>{$reInfo['final_time']}</td>
                        <th>终审意见</th>
                        <td>{$reInfo['final_message']}</td>
                    </tr>
                {/if}
                {if:$outInfo['proot']!=null}
                    <tr>
                        <th>打款凭证/th>
                           <td> <img id='image2' src='{$outInfo["proot"]}'></td>
                    </tr>
                {/if}
                {if:$outInfo['action']=='transfer'}
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
                {/if}
                {if:$outInfo['action']!=null&&$outInfo['action']!='transfer'}
                    <tr>
                        <th scope="col" colspan="6">
                            <a href="javascript:;" class="btn btn-danger radius pass"><i class="icon-ok"></i> 确定</a>
                            <a href="javascript:;" class="btn btn-primary radius ref"><i class="icon-remove"></i> 不通过</a>
                            <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>

                        </th>

                    </tr>
                    <tr>
                        <th scope="col" colspan="6">
                            意见: <textarea name="message" id="message" >{$outInfo['url']}</textarea>
                        </th>

                    </tr>
                {/if}

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
            formacc.ajax_post("{$outInfo['url']}",{out_id:"{$outInfo['id']}",imgfile2:imgfile2},function(){

                    layer.msg("上传成功稍后自动跳转");
                    setTimeout(function(){
                        window.location.href = "{url:balance/fundOut/fundOutList}";
                    },1500);

            });
        }
        function setStatus(status,msg,mess){
            formacc.ajax_post("{$outInfo['url']}",{out_id:"{$outInfo['id']}",status:status,message:mess},function(){
                layer.msg(msg+"稍后自动跳转");
             setTimeout(function(){
                    window.location.href = "{url:balance/fundOut/fundOutList}";
                },1500);
            });
        }
    })

</script>

</body>
</html>