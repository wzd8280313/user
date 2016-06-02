
<!--
      CONTENT
                -->
<div id="content" class="white">
    <h1><img src="{views:img/icons/posts.png}" alt="" /> 广告位列表</h1>
    <div class="bloc">
        <div class="title">
            广告位列表
        </div>
        <div class="content">
            <div class="pd-20">
                <div class="mt-20">
                    <table class="table table-border table-bordered table-hover table-bg table-sort">
                        <thead>
                        <tr class="text-c">
                            <th width="25"><input type="checkbox" name="" value=""></th>
                            <th width="100">广告位名称</th>
                            <th width="60">宽高</th>
                            <th width="80">开启状态 </th>

                            <th width='100'>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach:items=$adPositionList}
                        <tr class="text-c">
                            <td><input type="checkbox" value="" name=""></td>
                            <td><u style="cursor:pointer" class="text-primary" >{$item['name']}</u></td>
                            <td>{$item['width']}x{$item['height']}</td>
                            <td>
                                {if:$item['status']==1}
                                开启
                                {else:}
                                关闭
                                {/if}
                            </td>
                            <td class="td-manage">
                                <a title="编辑" href="{url:tool/advert/adPositionEdit}?id={$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>
                                <a title="删除" href="javascript:void(0);" onclick="delOnline({$item['id']},this)" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
                        </tr>
                        {/foreach}
                        </tbody>
                        <script type="text/javascript">
                            function delOnline(id,obj){
                                var obj=$(obj);
                                var url="{url:}";
                                if(confirm("确定要删除吗?")){
                                    $.ajax({
                                        type:'get',
                                        cache:false,
                                        data:{id:id},
                                        url:url,
                                        success:function(msg){
                                            if(msg==1){
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

