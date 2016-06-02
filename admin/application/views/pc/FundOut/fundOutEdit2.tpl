<script type="text/javascript" src="{views:content/settings/main.js}"></script>
<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/validform/validform.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src='{root:js/upload/ajaxfileupload.js}'></script>
<script type="text/javascript" src='{root:js/upload/upload.js}'></script>
<link rel="stylesheet" href="{views:content/settings/style.css}" />





<!--
      CONTENT
                -->
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 出金审核</h1>
<div class="bloc">
    <div class="title">
       申请详情
    </div>
    <div class="content">
        <div class="pd-20">
    <form action="{$outInfo['url']}" method="post"  class="form form-horizontal"
     id="offlineEidt" auto_submit redirect_url="{url:/balance/fundOut/fundOutList}">
        
        <div class="row cl">
            <label class="form-label col-2">当前状态：</label>
            <div class="formControls col-10">
                {$outInfo['statusText']}
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2">用户名：</label>
            <div class="formControls col-10">
                {$outInfo['username']}
            </div>
        </div>
         <div class="row cl">
            <label class="form-label col-2">手机号：</label>
            <div class="formControls col-10">
                {$outInfo['mobile']}
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2">开户名：</label>
            <div class="formControls col-10">
                {$outInfo['true_name']}
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-2">开户银行：</label>
             <div class="formControls col-10">
                {$outInfo['bank_name']}
            </div>
            
        </div>
        <div class="row cl">
            <label class="form-label col-2">银行卡号：</label>
            <div class="formControls col-10">
                {$outInfo['card_no']}
            </div>

        </div>
             <div class="row cl">
            <label class="form-label col-2">订单号：</label>
                     <div class="formControls col-10">
                         {$outInfo['request_no']}
                    </div>
            </div>
              <div class="row cl">
            <label class="form-label col-2">金额：</label>
                      <div class="formControls col-10">
                         {$outInfo['amount']}
                    </div>        
            </div>
        <div class="row cl">
            <label class="form-label col-2">开户凭证：</label>
            <div class="formControls col-10">
                <img id='image' src='{$outInfo["bank_proof"]}'>
            </div>
        </div>
            <div class="row cl">
                <label class="form-label col-2">提现说明： </label>
                <div class="formControls col-10">
                       {$outInfo['note']}
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">申请时间：</label>
                <div class="formControls col-10">
                     {$outInfo['create_time']}
                </div>
            </div>
            {if:$outInfo['first_time']!=null}
                <div class="row cl" >
                    <label class="form-label col-2">初审时间：</label>
                    <div class="formControls col-10">
                        {$outInfo['first_time']}
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-2">初审意见：</label>
                    <div class="formControls col-10">
                        {$outInfo['first_message']}
                    </div>
                </div>
            {/if}
            {if:$outInfo['final_time']!=null}
                <div class="row cl">
                    <label class="form-label col-2">终审时间：</label>
                    <div class="formControls col-10">
                        {$outInfo['final_time']}
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-2">终审意见：</label>
                    <div class="formControls col-10">
                        {$outInfo['final_message']}
                    </div>
                </div>
            {/if}
            {if:$outInfo['proot']!=null}
                    <div class="row cl">
                    <label class="form-label col-2">凭证：</label>
                    <div class="formControls col-10">
                       <img id='image' src='{$outInfo["proot"]}'>
                    </div>
                </div>
            {/if}

         {if:$outInfo['action']=='transfer'}
                <div class="">
                <label class="form-label col-2"><span class="c-red">*</span>打款凭证：</label>
                <div class="">
                    <input type="hidden" name="uploadUrl"  value="{url:balance/fundOut/upload@admin}" />
                        <input type='file' name="file2" id="file2"  onchange="javascript:uploadImg(this);" />
                </div>
                    <div>
                    <img name="file2" />
                    <input type="hidden" name="imgfile2"  />

                </div>

                    <div class="row cl">
                        <div class="col-10 col-offset-2">
                            <input id='out_id' name='out_id' type="hidden" value="{if:isset($outInfo['id'])}{$outInfo['id']}{/if}" />
                            <button type="submit" class="btn btn-success radius" id="offline-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
                        </div>
                    </div>
            </div>
        {/if}
        {if:$outInfo['action']!=''&&$outInfo['action']!='transfer'}
       
            <div class="row cl">
                <label class="form-label col-2"><span class="c-red">*</span>状态：</label>
                <div class="formControls col-10">
                    <input type="radio" class="input-text" value="1"   name="status" checked>通过
                    <input type="radio" class="input-text"  value="0" name="status" >驳回
            </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2"><span class="c-red">*</span>意见：</label>
                <div class="formControls col-10">
                    <textarea name="message"></textarea>
                </div>
            </div>

         
       
            <div class="row cl">
                <div class="col-10 col-offset-2">
                <input id='out_id' name='out_id' type="hidden" value="{if:isset($outInfo['id'])}{$outInfo['id']}{/if}" />
                    <button type="submit" class="btn btn-success radius" id="offline-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
                </div>
            </div>
        {/if}

        </div>

    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#btnOk').bind('click',function(){
            var out_id=$('#out_id').val();
            var data={
                out_id:out_id,
            }
            
            $.ajaxFileUpload({
                url:"{$outInfo['url']}",
                fileElementId:'proot',
                type:'post',
                 secureuri: false,
                data: data,
                dataType:'json',
                success:function(msg){
                   if(msg['code']==1){
                        alert(msg['info']);

                   }else{
                        alert(msg['info']);
                   }
                }
            });

        });

    });

</script>
