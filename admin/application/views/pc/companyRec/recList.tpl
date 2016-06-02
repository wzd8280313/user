
<!--
      CONTENT
                -->
<div id="content" class="white">
    <h1><img src="{views:img/icons/posts.png}" alt="" /> 推荐商户</h1>
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
                        {foreach:items=$recList}
                            <tr class="text-c">
                                <td><input type="checkbox" value="" name=""></td>
                                <td><u style="cursor:pointer" class="text-primary" >{$item['username']}</u></td>
                                <td>{$item['company_name']}</td>
                                <td>{echo: \nainai\companyRec::getRecType($item['type'])}</td>
                                <td>{$item['start_time']}</td>
                                <td>{$item['end_time']}</td>
                                <td>{if:$item['status']==1}开启{else:}关闭{/if}</td>
                                <td class="td-manage">
                                    <a title="审核" href="{url:/member/companyRec/recEdit}?id={$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>
                                    <a title="删除" href="javascript:void(0);" onclick="delRec({$item['id']},this)" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
                            </tr>
                        {/foreach}
                        </tbody>
                        <script type="text/javascript">
                            function delRec(id,obj){
                                var obj=$(obj);
                                var url="{url:/member/companyRec/del}";
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
                    {$pageBar}
                </div>
            </div>