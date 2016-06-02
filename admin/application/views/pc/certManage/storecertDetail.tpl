<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" /> 仓库管理员认证信息</h1>
                
<div class="bloc">
    <div class="title">
		仓库管理员认证信息
    </div>
 <div class="pd-20">
	 <form action="{url:member/certManage/doStoreCert}" method="post" class="form form-horizontal" id="form-admin-add" auto_submit redirect_url="{url:member/certManage/storeCert}">
		<div class="row cl">
			<label class="form-label col-3">申请时间：</label>
			<div class="formControls col-5">
				<span>{$cert['apply_time']}</span>
			</div>
			<div class="col-4"> </div>
		</div>
		 <div class="row cl">
			 <label class="form-label col-3">认证仓库：</label>
			 <div class="formControls col-5">
				 <span>{$store['name']}</span>
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">仓库地区：</label>
			 <div class="formControls col-5">
				 <span id="areatext1">{areatext:data=$store['area'] id=areatext1}</span>
			 </div>
			 <div class="col-4"> </div>
		 </div>
		<div class="row cl">
			<label class="form-label col-3">用户名：</label>
			<div class="formControls col-5">
				{$cert['username']}
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">手机号：</label>
			<div class="formControls col-5">
				{$cert['mobile']}
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">邮箱：</label>
			<div class="formControls col-5">
				{$cert['email']}
			</div>
			<div class="col-4"> </div>
		</div>
	 {if:$cert['type']==0}
		<div class="row cl">
			<label class="form-label col-3">真实姓名：</label>
			<div class="formControls col-5">
				{$cert['true_name']}
			</div>
			<div class="col-4"> </div>
		</div>

		<div class="row cl">
			<label class="form-label col-3">身份证号：</label>
			<div class="formControls col-5">
				{$cert['identify_no']}
			</div>
			<div class="col-4"> </div>
		</div>


	 {else:}
		 <div class="row cl">
			 <label class="form-label col-3">企业名称：</label>
			 <div class="formControls col-5">
				 {$cert['company_name']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">地址：</label>
			 <div class="formControls col-5" id="areatext">
				{areatext:data=$cert['area'] id=areatext}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">详细地址：</label>
			 <div class="formControls col-5">
				 {$cert['address']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">法人姓名：</label>
			 <div class="formControls col-5">
				 {$cert['legal_person']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">注册资金：</label>
			 <div class="formControls col-5">
				 {$cert['reg_fund']}
			 </div>万
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">联系人：</label>
			 <div class="formControls col-5">
				 {$cert['contact']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">联系人电话：</label>
			 <div class="formControls col-5">
				 {$cert['contact_phone']}
			 </div>
			 <div class="col-4"> </div>
		 </div>


	 {/if}
		<div class="row cl">
			<label class="form-label col-3">状态：</label>
			<div class="formControls col-5">
				<input type="hidden" name="user_id" value="{$cert['user_id']}" />
				<label><input name="result" type="radio" value="1" />通过 </label>
				<label><input name="result" type="radio" value="0" />不通过 </label>
			</div>
			<div class="col-4"> </div>
		</div>
		 <div class="row cl">
			 <label class="form-label col-3">说明：</label>
			 <div class="formControls col-5">
				 <textarea style="width:250px;height:100px;" name="info">

				 </textarea>
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

