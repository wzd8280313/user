<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/validform/validform.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:content/settings/main.js}"></script>
<link rel="stylesheet" href="{views:content/settings/style.css}" />
<link rel="stylesheet" type="text/css" href="{views:css/H-ui.admin.css}">

<!--
      CONTENT
                -->
<div id="content" class="white">
    <h1><img src="{views:img/icons/dashboard.png}" alt="" />推荐管理
    </h1>

    <div class="bloc">
        <div class="title">
            推荐信息
        </div>
        <div class="pd-20">
            <table class="table table-border table-bordered table-bg">
                <tr>

                    <th>推荐类型</th>
                    {set: $type=\nainai\companyRec::getRecType()}
                    <td>
                        <select name="type" id="type">
                            {foreach:items=$type}
                                <option value="{$key}"
                                {if: $key=$recInfo['type']==$key}"selected"{/if}
                                >{$item}<option>
                            {/foreach}
                        </select>
                    </td>
                    <th>用户名</th>
                        <td>{$recInfo['username']}</td>
                </tr>
                <tr>
                    <th>企业名称</th>
                    <td>{$recInfo['company_name']}</td>
                    <th>手机号</th>
                    <td>{$recInfo['mobile']}</td>

                </tr>
                <tr>

                    <th>分类</th>
                    <td>{$recInfo['pname']}</td>
                    <th>状态</th>
                    <td>开启
                        <input type="radio" name="status"value="1" {if:$recInfo['status']==1}checked="checked"{/if}/>
                        关闭
                        <input type="radio" name="status" value="0"{if:$recInfo['status']==0}checked="checked"{/if}/>
                    </td>

                </tr>
                <tr>
                    <th>开始时间：</th>
                    <td>
                        <input type="text" name="start_time" value="{$recInfo['start_time']}" />
                    <th>结束：</th>
                    <td><input type="text" name='end_time' value="{$recInfo['end_time']}" /></td>

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
                id:"{$recInfo['id']}",
                status:$("input[name='status']:checked").val(),
                type:$('#type').val(),
                start_time:$("input[name='start_time']").val(),
                end_time:$('input[name="end_time"]').val(),
                user_id:"{$recInfo['user_id']}"
            };
            msg = '已保存';
            setStatus(data,msg);
        })
        function setStatus(data,msg){
            formacc.ajax_post("{url:member/companyRec/recEdit}",data,function(){
                layer.msg(msg+"稍后自动跳转");
               /* setTimeout(function(){
                    window.location.href = "{url:balance/fundIn/offlineList}";
                },1500);*/
            });
        }
    })

</script>

</body>
</html>