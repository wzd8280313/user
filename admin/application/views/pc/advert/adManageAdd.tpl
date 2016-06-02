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
    <h1><img src="{views:img/icons/posts.png}" alt="" />广告添加</h1>
    <div class="bloc">
        <div class="title">
            广告添加
        </div>
        <div class="content">
            <div class="pd-20">
                <form action="{url:/advert/advert/adManageAdd}" method="post"  class="form form-horizontal"
                      id="adPositionAdd" auto_submit redirect_url="{url:advert/advert/adManageList}">

                    <div class="row cl">
                        <label class="form-label col-2">名称：</label>
                        <div class="formControls col-10">
                            <input type="text" name="name" />
                        </div>
                    </div>
                    <script type="text/javascript" src="{views:js/time/WdatePicker.js}"></script>
                    <div class="row cl">
                        <label class="form-label col-2">图片：</label>
                        <div class="formControls col-10">
                            <input type="hidden" name="uploadUrl"  value="{url:advert/advert/upload@admin}" />
                            <input type='file' name="file2" id="file2"  onchange="javascript:uploadImg(this);" />
                        </div>
                        <div>
                            <img name="file2" />
                            <input type="hidden" name="imgfile2"  />

                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-2">广告位：</label>
                        <div class="formControls col-10">
                            <select name="position_id">
                                <option value=""></option>
                                {foreach: items=$adPoDate}
                                <option value="{$item['id']}">
                                    {$item['name']}
                                </option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-2">链接地址：</label>
                        <div class="formControls col-10">
                            <input type="text" name="link" />
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-2">排序：</label>
                        <div class="formControls col-10">
                            <input type="text" name="order" /> 数字越小，排列越靠前
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-2">开始时间：</label>
                        <div class="formControls col-10">
                            <input class="Wdate" onclick="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" name="start_time" />
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-2">结束时间：</label>
                        <div class="formControls col-10">
                            <input class="Wdate" onclick="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd HH:mm:ss'})"  type="text" name="end_time" />
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-2">描述：</label>
                        <div class="formControls col-10">
                            <input type="text" name="description" />
                        </div>
                    </div>
                    <div class="row cl">
                        <div class="col-10 col-offset-2">
                            <button type="submit" class="btn btn-success radius" id="offline-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
                        </div>
                    </div>


            </div>

            </form>
        </div>