
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" /> 添加属性
</h1>
                
<div class="bloc">
    <div class="title">
     属性信息
    </div>
 <div class="pd-20">
  <form action="{url:trade/product/attributeAdd}" method="post" class="form form-horizontal" id="form-user-add" auto_submit redirect_url="{url:trade/product/attributeList}">
      <input type="hidden" name="id" value="{if:isset($attr)}{$attr['id']}{/if}" />
    <div class="row cl">
      <label class="form-label col-2"><span class="c-red">*</span>属性名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="{if:isset($attr)}{$attr['name']}{/if}" datatype="s1-20" errormsg="请正确填写属性名" placeholder="" name="name">
      </div>
      <div class="col-5"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>类型：</label>
          <div class="formControls col-5">
              <input type="radio" class="input-text" {if:!isset($attr) || $attr['type']==1}checked="checked"{/if} value="1" name="type">输入框
              <input type="radio" class="input-text" {if:isset($attr) && $attr['type']==2}checked="checked"{/if} value="2" name="type">单选
              <input type="radio" class="input-text" {if:isset($attr) && $attr['type']==3}checked="checked"{/if} value="3" name="type">多选
          </div>
          <div class="col-5"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>值：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" ignore="ignore" datatype="*1-20"  value="{if:isset($attr)}{$attr['value']}{/if}" placeholder="" name="value">
              输入框形式不用填，多个值以'，'相隔
          </div>
          <div class="col-5"> </div>
      </div>

      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>排序：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" datatype="n" value="{if:isset($attr)}{$attr['sort']}{/if}" placeholder="" name="sort">
          </div>
          <div class="col-5"> </div>
      </div>
    <div class="row cl">
      <label class="form-label col-2">备注：</label>
      <div class="formControls col-5">
        <textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么..." datatype="*0-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,100)">{if:isset($attr)}{$attr['note']}{/if}</textarea>
      </div>
      <div class="col-5"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-2">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>

</div>

</div>
