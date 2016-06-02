
<!--
      CONTENT
                -->
<div id="content" class="white">
    <h1><img src="{views:img/icons/posts.png}" alt="" /> 广告列表</h1>
    <div class="bloc">
        <div class="title">
            广告列表
        </div>
        <div class="content">
            <div class="pd-20">

                <div class="mt-20">
                    <table class="table table-border table-bordered table-hover table-bg table-sort">
                        <thead>
                        <tr class="text-c">
                            <th width="25"><input type="checkbox" name="" value=""></th>
                            <th width="100">广告名称</th>
                            <th width="90">广告位名称</th>
                            <th width="60">排序</th>
                            <th width="150">开始时间</th>
                            <th width="100">结束时间</th>
                            <th width='100'>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach:items=$adManageList}
                        <tr class="text-c">
                            <td><input type="checkbox" value="" name=""></td>
                            <td><u style="cursor:pointer" class="text-primary" >{$item['name']}</u></td>
                            <td>{$item['pname']}</td>
                            <td>{$item['order']}</td>
                            <td>{$item['start_time']}</td>
                            <td>{$item['end_time']}</td>
                            <td class="td-manage">
                                <a title="编辑" href="{url:tool/advert/adManageEdit}?id={$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>
                                <a title="删除" href="javascript:void(0);" onclick="deladManage({$item['id']},this)" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
                        </tr>
                        {/foreach}
                        </tbody>
                        <script type="text/javascript">
                            function deladManage(id,obj){
                                var obj=$(obj);
                                var url="{url:tool/advert/delManage}";
                                if(confirm("确定要删除吗?")){
                                    $.ajax({
                                        type:'post',
                                        cache:false,
                                        data:{id:id},
                                        url:url,
                                        dateType:'json',
                                        success:function(msg){
                                            if(msg.success==1){
                                                alert('删除成功');
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
                    {$reBar}
                </div>
            </div>

