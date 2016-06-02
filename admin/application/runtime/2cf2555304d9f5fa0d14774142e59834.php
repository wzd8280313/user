<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>

	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/min.css" />
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="http://localhost/nn2/admin/public/views/pc/css/H-ui.min.css">
</head>
<body>
<script type="text/javascript" src="http://localhost/nn2/admin/public/js/area/Area.js" ></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/js/area/AreaData_min.js" ></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/js/upload/ajaxfileupload.js"></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/js/upload/upload.js"></script>
<div id="content" class="white">
<h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" />添加仓库
</h1>
                
<div class="bloc">
    <div class="title">
       添加仓库
    </div>
   <div class="pd-20">
  <form action="http://localhost/nn2/admin/public/store/store/storeadd" method="post" class="form form-horizontal" id="form-member-add" auto_submit redirect_url="http://localhost/nn2/admin/public/store/store/storelist">
      <input type="hidden" name="id" value="<?php if(isset($store)){?><?php echo isset($store['id'])?$store['id']:"";?><?php }?>" />
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>仓库名：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php if(isset($store)){?><?php echo isset($store['name'])?$store['name']:"";?><?php }?>" id="member-name" name="name" datatype="s2-50" nullmsg="仓库名不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库简称：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="<?php if(isset($store)){?><?php echo isset($store['short_name'])?$store['short_name']:"";?><?php }?>" placeholder="" datatype="s2-20" name="short_name" errormsg="请填写简称" >
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库地区：</label>
          <div class="formControls col-5">
              <?php if(isset($store)){?>
                                 <script type="text/javascript">
                 areaObj = new Area();

                  $(function () {
                     areaObj.initComplexArea('seachprov', 'seachcity', 'seachdistrict', '<?php echo $store['area'] ; ?>','area');
                  });
                </script>
			 <select  id="seachprov"  onchange=" areaObj.changeComplexProvince(this.value, 'seachcity', 'seachdistrict');">
              </select>&nbsp;&nbsp;
              <select  id="seachcity"  onchange=" areaObj.changeCity(this.value,'seachdistrict','seachdistrict');">
              </select>&nbsp;&nbsp;<span id='seachdistrict_div' >
               <select   id="seachdistrict"  onchange=" areaObj.changeDistrict(this.value);">
               </select></span>
               <input type="hidden"  name="area"  alt="" value='<?php echo $store['area'] ; ?>' />
                <span></span>
               <?php }else{?>
                                  <script type="text/javascript">
                 areaObj = new Area();

                  $(function () {
                     areaObj.initComplexArea('seachprov', 'seachcity', 'seachdistrict', '000000','area');
                  });
                </script>
			 <select  id="seachprov"  onchange=" areaObj.changeComplexProvince(this.value, 'seachcity', 'seachdistrict');">
              </select>&nbsp;&nbsp;
              <select  id="seachcity"  onchange=" areaObj.changeCity(this.value,'seachdistrict','seachdistrict');">
              </select>&nbsp;&nbsp;<span id='seachdistrict_div' >
               <select   id="seachdistrict"  onchange=" areaObj.changeDistrict(this.value);">
               </select></span>
               <input type="hidden"  name="area"  alt="" value='000000' />
                <span></span>
              <?php }?>
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库地址：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="<?php if(isset($store)){?><?php echo isset($store['address'])?$store['address']:"";?><?php }?>" placeholder="" datatype="s2-50" name="address" errormsg="请填写地址" name="address"  >
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库服务点电话：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="<?php if(isset($store)){?><?php echo isset($store['service_phone'])?$store['service_phone']:"";?><?php }?>" placeholder="" datatype="/\d{6,15}/" name="service_phone" errormsg="电话格式错误" >
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库服务点地址：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="<?php if(isset($store)){?><?php echo isset($store['service_address'])?$store['service_address']:"";?><?php }?>" placeholder="" datatype="s2-50" errormsg="请填写地址" name="service_address"  >
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库联系人：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="<?php if(isset($store)){?><?php echo isset($store['contact'])?$store['contact']:"";?><?php }?>" placeholder=""  datatype="s2-20" name="contact" errormsg="格式错误" >
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库联系人电话：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="<?php if(isset($store)){?><?php echo isset($store['contact_phone'])?$store['contact_phone']:"";?><?php }?>" datatype="/\d{6,15}/" placeholder="" errormsg="电话格式错误" name="contact_phone"  >
          </div>
          <div class="col-4"> </div>
      </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>类型：</label>
      <div class="formControls col-5 skin-minimal">
        <?php if(isset($store)){?>
          <?php foreach($alltype as $key => $item){?>
        <div class="radio-box">
          <input type="radio"  name="type"  value="<?php echo isset($key)?$key:"";?>" <?php if(isset($store['type']) && $key==$store['type']){?>checked<?php }?>>
          <label ><?php echo isset($item)?$item:"";?></label>

        </div>
          <?php }?>
          <?php }else{?>
            <?php foreach($alltype as $key => $item){?>
            <div class="radio-box">
                <input type="radio"  name="type"  value="<?php echo isset($key)?$key:"";?>" <?php if( $key==0){?>checked<?php }?>>
                <label ><?php echo isset($item)?$item:"";?></label>

            </div>
            <?php }?>
          <?php }?>


      </div>
      <div class="col-4"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>是否开启：</label>
          <div class="formControls col-5 skin-minimal">
              <div class="radio-box">
                  <input type="radio"  name="status"  value="1" <?php if(!isset($store) || $store['status']==1){?>checked<?php }?> >
                  <label >开启</label>

              </div>
              <div class="radio-box">
                  <input type="radio"  name="status"  value="0" <?php if(isset($store) && $store['status']==0){?>checked<?php }?>>
                  <label >关闭</label>
              </div>
          </div>
          <div class="col-4"> </div>
      </div>


    <div class="row cl">
      <label class="form-label col-3">上传图片：</label>
      <div class="formControls col-5">
          <span class="btn-upload form-group">
            <input type="file" name="file1" id="file1"  onchange="javascript:uploadImg(this,'http://localhost/nn2/admin/public/index/upload');" />
        </span>
          <div  class="up_img">
              <img name="file1" src="<?php if(isset($store)){?><?php echo isset($store['img'])?$store['img']:"";?><?php }?>"/>
              <input type="hidden"  name="imgfile1"   />
          </div>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3">备注：</label>
      <div class="formControls col-5">
        <textarea name="note" cols="" rows="" class="textarea"  onKeyUp="textarealength(this,1000)" ><?php if(isset($store)){?><?php echo isset($store['note'])?$store['note']:"";?><?php }?></textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/1000</p>
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

</body>
</html>