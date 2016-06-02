<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{root:js/area/Area.js}" ></script>

        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />添加代理商
</h1>
                
<div class="bloc">
    <div class="title">
       添加代理商
    </div>
   <div class="pd-20">
  <form action="{url:member/agent/addAgent}" method="post" class="form form-horizontal" id="form-member-add" auto_submit redirect_url="{url:member/agent/agentList}">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>用户名：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$agentData['username']}"  id="member-name" name="username" datatype="*2-16" nullmsg="用户名不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>手机：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$agentData['mobile']}" id="member-tel" name="mobile"  datatype="m" nullmsg="手机不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>邮箱：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$agentData['email']}" name="email" id="email" datatype="e" nullmsg="请输入邮箱！">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>公司名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$agentData['company_name']}" name="company" id="email" datatype="*2-16" nullmsg="请输入公司名称：！">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>地区：</label>
      <div class="formControls col-5">
        {if:isset($agentData['area'])}
        {area:data=$agentData['area']}
        {else:}
          {area:}
        {/if}
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>联系人名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$agentData['contact']}" name="contactName" id="email" datatype="*2-16" nullmsg="请输入联系人名称！">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>联系人电话：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$agentData['contact_phone']}"  name="contacttel" id="email" datatype="*2-16" nullmsg="请输入联系人电话！">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>详细地址：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$agentData['address']}" name="contactAddress" id="email" datatype="*2-16" nullmsg="请输入地址！">
        <input type="hidden" class="input-text" value="{$agentData['id']}" name="id" id="email"  nullmsg="请输入地址：！">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否开启：</label>
      <div class="formControls col-5">
        {if:isset($agentData)}
        <input type="radio" name="status" value='1' {if:$agentData['status'] == 1}checked='1'{/if} id="">是
        <input type="radio" name="status" value='0' {if:$agentData['status'] == 0}checked='1'{/if} id="">否
        {else:}
          <input type="radio" name="status" value='1' checked='1' id="">是
          <input type="radio" name="status" value='0' id="">否
        {/if}
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>
</div>

</div>
        
        
