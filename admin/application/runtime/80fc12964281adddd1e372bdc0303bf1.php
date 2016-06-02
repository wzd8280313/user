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

        
        <!-- jQuery AND jQueryUI -->
        <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
        <script type="text/javascript" src="js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
        <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/validform.js"></script>
        <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
        <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
        <script type="text/javascript" src="http://localhost/nn2/admin/public/js/upload/ajaxfileupload.js"></script>
        <script type="text/javascript" src="http://localhost/nn2/admin/public/js/upload/upload.js"></script>


        <link rel="stylesheet" href="css/min.css" />
        <script type="text/javascript" src="js/min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/H-ui.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css" />   
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" /><?php echo isset($oper)?$oper:"";?>信誉值配置
</h1>

<div class="bloc">
    <div class="title">
       <?php echo isset($oper)?$oper:"";?>信誉值配置
    </div>
   <div class="pd-20">
  <form action="http://localhost/nn2/admin/public/system/confsystem/creditOper/" method="post" class="form form-horizontal" id="form-credit-add" auto_submit redirect_url = "http://localhost/nn2/admin/public/system/confsystem/creditList/">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>参数名：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo isset($info['name'])?$info['name']:"";?>" placeholder="" id="name" name="name" datatype="*2-16" nullmsg="参数名不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>中文名:</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo isset($info['name_zh'])?$info['name_zh']:"";?>" placeholder="" id="name_zh" name="name_zh"  datatype="/^[\u2E80-\uFE4F]{2,10}$/" nullmsg="中文名不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>参数类型：</label>
      <div class="formControls col-5">
        <select name="type" class='select' value="<?php echo isset($info['type'])?$info['type']:"";?>">
          <option value="0">数值</option>
          <option value="1">百分比</option>
        </select>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>处理方式：</label>
      <div class="formControls col-5">
        <select name="sign" class='select' value="<?php echo isset($info['sign'])?$info['sign']:"";?>">
          <option value="0">增加</option>
          <option value="1">减少</option>
        </select>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>参数值：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text"  value="<?php echo isset($info['value'])?$info['value']:"";?>" name="value" id="value" datatype="/^([1-9]{1,3}|0)([.][0-9]{1,5})?$/" nullmsg="请输入参数值！">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>排序：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo isset($info['sort'])?$info['sort']:"";?>" name="sort" id="sort" datatype="n" nullmsg="请输入参数值！">
      </div>
      <div class="col-4"> </div>
    </div>   

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>解释：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo isset($info['note'])?$info['note']:"";?>" name="note" id="note" >
      </div>
      <div class="col-4"> </div>
    </div>    
    
    
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <?php if($oper_type==2){?><input type="hidden" name="ori_name" value="<?php echo isset($info['name'])?$info['name']:"";?>" /><?php }?>
        <input type="hidden" name="oper_type" value="<?php echo isset($oper_type)?$oper_type:"";?>"/>
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
        &emsp;<a class="btn btn-primary radius" href="http://localhost/nn2/admin/public/system/confsystem/creditList/">&nbsp;&nbsp;返回&nbsp;&nbsp;</a>
      </div>
    </div>
  </form>
</div>
</div>
</div>

</div>
    </body>
</html>
</body>
</html>