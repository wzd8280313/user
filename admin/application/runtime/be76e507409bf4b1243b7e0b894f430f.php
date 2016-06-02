<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>

	<link rel="stylesheet" href="http://localhost/nn2-new_master/admin/public/views/pc/css/min.css" />
	<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="http://localhost/nn2-new_master/admin/public/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="http://localhost/nn2-new_master/admin/public/views/pc/css/H-ui.min.css">
</head>
<body>
        <script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
        <script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/validform/validform.js"></script>
        <script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/validform/formacc.js"></script>
        <script type="text/javascript" src="http://localhost/nn2-new_master/admin/public/views/pc/js/layer/layer.js"></script>
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2-new_master/admin/public/views/pc/img/icons/dashboard.png" alt="" />报盘管理
</h1>

<div class="bloc">
    <div class="title">
       报盘信息
    </div>
     <div class="pd-20">
	 	 <table class="table table-border table-bordered table-bg">
	 		<tr>

	 			<th>委托方</th>
	 			<td><?php echo isset($info['user'])?$info['user']:"";?></td>
	 		</tr>
            <tr>
                <th>交易方式</th>
                <td><?php echo isset($info['type'])?$info['type']:"";?></td>
                <th>报盘类型</th>
                <td><?php echo isset($info['mode_txt'])?$info['mode_txt']:"";?></td>
                <th></th>
                <td></td>
            </tr>
      	 		<tr>
                    <th>商品大类</th>
                    <td><?php echo isset($info['topcate_name'])?$info['topcate_name']:"";?></td>
      	 			<th>商品种类</th>
      	 			<td><?php echo isset($info['parent_cates'])?$info['parent_cates']:"";?></td>
      	 			<th>可否拆分</th>
      	 			<td><?php if($info['divide'] == 0){?>可拆分<?php }else{?>否<?php }?></td>

      	 		</tr>
            <tr>
                <th>报盘数量</th>
                <td><?php echo isset($info['quantity'])?$info['quantity']:"";?></td>
              <th>计量单位</th>
              <td><?php echo isset($info['unit'])?$info['unit']:"";?></td>
                <th></th>
                <td></td>
              
            </tr>
            <tr>

              <th>挂牌价</th>
              <td><?php echo isset($info['price'])?$info['price']:"";?></td>
              <th>状态</th>
              <td><?php echo isset($info['status_txt'])?$info['status_txt']:"";?></td>
                <th></th>
                <td></td>
            </tr>


            <tr>
              <th scope="col" colspan="6">
                 <a href="javascript:;" class="btn btn-danger radius pass"><i class="icon-ok"></i> 通过</a> 
                 <a href="javascript:;" class="btn btn-primary radius ref"><i class="icon-remove"></i> 不通过</a>
                 <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>
              </th>
            </tr>
	 	</table>
 	</div>
</div>
</div>
      <script type="text/javascript">
        $(function(){
          var formacc = new nn_panduo.formacc();
          var status = '';
          $('a.pass').click(function(){
            $(this).unbind('click');
            msg = '已通过';
            setStatus(1,msg);
          })

          $('a.ref').click(function(){
            $(this).unbind('click');
            msg = '已驳回';
            setStatus(0,msg);
          })

          function setStatus(status,msg){
            formacc.ajax_post("http://localhost/nn2-new_master/admin/public/trade/offermanage/setstatus",{status:status,id:<?php echo isset($info['id'])?$info['id']:"";?>},function(){
              layer.msg(msg+"稍后自动跳转");
                  setTimeout(function(){
                      window.location.href = "http://localhost/nn2-new_master/admin/public/trade/offermanage/offerreview";
                  },1500);
            });
          }
        })

      </script>
        
    </body>
</html>
</body>
</html>