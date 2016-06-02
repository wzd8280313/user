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
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/validform.js"></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 系统管理</h1>
<style type="text/css">
	.node_tree li {float: left;text-decoration: none;list-style: none;}
	.clearfix{clear: left;}
	.node_tree .v1{background-color: #14A8FF;border: 1px solid #ddd;padding: 3px 6px;color: #fff;border-radius: 3px;font-weight: border;margin-bottom: 5px;margin-top: 5px;}
	.node_tree .v2{text-indent: 2em;font-weight: bolder;}
	.node_tree .v3{padding-left: 50px;}
	.node_tree .ins{margin-left:-35px;}
</style>
<form action="http://localhost/nn2/admin/public/system/rbac/accessAdd/" method="post" class="form form-horizontal" id="form-access-add" no_redirect="1" auto_submit>
<div class="bloc" style="margin-top: 20px;">
    <div class="title">
        权限节点列表
    </div>
    <div class="content">
        <div class="pd-20">
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a class="btn btn-primary radius node-add" href="http://localhost/nn2/admin/public/system/rbac/nodeAdd/"><i class=" icon-plus"></i>添加节点 </a> </span>  
	 <div class=" cl">
      <!-- <label class="form-label col-3"><span class="c-red">*</span>模块名：</label> -->

      <div class="formControls col-5" style='margin-left: 20px;'>
        <select class='input-select roles' name='role_id' nullmsg = '请选择角色' dataType="/^[1-9]\d*$/">
          <option value='-1'>请选择角色</option>
            <?php foreach($admin_roles as $key => $item){?>
              <option value="<?php echo isset($item['id'])?$item['id']:"";?>" <?php if($role_id == $item['id']){?>selected<?php }?>><?php echo isset($item['name'])?$item['name']:"";?></option>
            <?php }?>
        </select>
      </div>
      <div class="col-4"> </div>
    </div>
	 </div>
		<div class="mt-20">
			<div class='node_tree'>
				<?php foreach($node_tree as $k => $item){?>
				<!-- 模块 -->
				<div class='root'>
					<div class='v1'><input type="checkbox" name="node_id[]" value="<?php echo isset($item['id'])?$item['id']:"";?>" <?php if(in_array($item['id'],$access_array)){?>checked='checked'<?php }?>/>&nbsp;<?php echo isset($item['title'])?$item['title']:"";?></div>
					<?php foreach($item['_child'] as $k1 => $v1){?>
					<!-- 控制器 -->
						<div class='controller'>
							<div class='v2'><span><input type="checkbox" name="node_id[]" value="<?php echo isset($v1['id'])?$v1['id']:"";?>" <?php if(in_array($v1['id'],$access_array)){?>checked='checked'<?php }?>/>&nbsp;<?php echo isset($v1['title'])?$v1['title']:"";?></span>
							</div>
							<div class='v3'>
								
								<?php foreach($v1['_child'] as $k2 => $v2){?>
								
									<ul>
									<div class='ins'><input type="checkbox"/>&nbsp;[<?php echo isset($k2)?$k2:"";?>]</div>
									<!-- action -->
									<?php foreach($v2 as $key => $v3){?>
										<li><input type="checkbox" name="node_id[]" value="<?php echo isset($v3['id'])?$v3['id']:"";?>" <?php if(in_array($v3['id'],$access_array)){?>checked='checked'<?php }?>/>&nbsp;<?php echo isset($v3['title'])?$v3['title']:"";?></li>
									<?php }?>
									</ul>	
									<div class='clearfix'></div>
								<?php }?>
								
							</div>
							<div class='clearfix'></div>
						</div>
					<?php }?>
				</div>
				<?php }?>
			</div>

			<div class="row cl">
		      <div class="col-9 col-offset-3">
		        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		      </div>

		    </div>
		</div>
	</div>
	</div>
</div>

</form>
<script type="text/javascript">
	;$(function(){
		$(".ins").each(function(){
			var _this = this;
			$(this).siblings("li").each(function(i){
				var bo = $(this).find(":checkbox").is(":checked");
				if(bo){
					$(_this).find(":checkbox").prop("checked",true);
				}
			});
		});


		$('.v1 :checkbox').unbind('click').click(function(){
			$(this).parent().siblings('.controller').find('.v3 :checkbox,.v2 :checkbox').prop("checked",this.checked);
		});

		$('.v2 :checkbox').click(function(){
			$(this).parents('.controller').find('.v3 :checkbox').prop("checked",this.checked);
			if($(this).is(":checked")){
				$(this).parents('.root').find('.v1 :checkbox').prop('checked',true);
			}
		});

		$('.v3 li :checkbox').click(function(){
			if($(this).is(":checked")){
				$(this).parents('.controller').find('.v2 :checkbox').prop('checked',true);
				$(this).parents('.root').find('.v1 :checkbox').prop('checked',true);
				$(this).parents('ul').find('.ins :checkbox').prop('checked',true);
			}
		});

		$('.ins :checkbox').click(function(){
			$(this).parents('ul').find(':checkbox').prop("checked",this.checked);
			if($(this).is(":checked")){
				$(this).parents('.root').find('.v1 :checkbox').prop('checked',true);
				$(this).parents('.v3').siblings('.v2').find(':checkbox').prop('checked',true);
			}
		});

		var url = "http://localhost/nn2/admin/public/system/rbac/accessList/";
		//切换角色
		$('.roles').change(function(){
			var role_id = $(this).val();
			var rec_url = url+'?role_id='+role_id;
			window.location.href=rec_url;
		});
	})

</script>







</body>
</html>