<?php echo  'IWEB';?>
<br/>
<?php echo IUrl::creatUrl("");?>
<br />
<?php echo  '1';?>
<br />
<?php echo IUrl::creatUrl(" /test/test");?>
<br />
<?php echo IUrl::creatUrl(" /1/arg/111");?>
<br />
<?php echo $this->getWebViewPath()."";?>
<br />
<?php echo IUrl::creatUrl("")."";?>
<br />
<?php echo $this->getWebSkinPath()."";?>
<br />
<!--  引入js文件validate进行表单验证 -->
<script type="text/javascript" charset="UTF-8" src="/iweb/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/iweb/runtime/_systemjs/autovalidate/style.css" />
<br />
<form callback='test("回调一下")'>
<input name="email" pattern='email' alt='请输入正确的email'/>
<input name='int' pattern='^\d{3,5}' alt="qingshu" />
<input type='submit' value='tijiao'>
</form>
<?php  $numbers=array(1,2,3,4,5,6)?>
<?php foreach($numbers as $k => $v){?>
key:<?php echo isset($k)?$k:"";?>--value:<?php echo isset($v)?$v:"";?><br />
<?php }?>
<script type="text/javascript">
	function test(msg){
		alert(msg);
		return true;
	}
</script>
<?php $query = new IQuery("test");$query->limit = "5";$items = $query->find(); foreach($items as $key => $item){?><?php echo isset($item['name'])?$item['name']:"";?><?php }?>
<?php $page=IReq::get('page')==null?1:IReq::get('page');?>
<?php $query = new IQuery("test");$query->page = "$page";$query->pagesize = "2";$items = $query->find(); foreach($items as $key => $item){?>
<?php echo isset($key)?$key:"";?>:<?php echo isset($item['name'])?$item['name']:"";?><br />
<?php }?>
<?php echo $query->getPageBar();?>