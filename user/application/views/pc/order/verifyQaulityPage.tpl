<style type="text/css">
	form>div{width: 50%;height: 200px;margin:0 auto;padding: 50px;}
	form>div>input{display: block;margin-bottom: 30px;}
	form>div>textarea{width: 200px;height: 80px;margin-bottom: 30px;}
</style>

<form action="{url:/Order/verifyQaulity}" method="post">
	<div>
		<input type="text" name='amount' placeholder="扣减金额" />
		<textarea name="remark" placeholder="扣减原因"></textarea>
		<input type="hidden" name="order_id" value="{$order_id}"/>
		<input type="submit" value="提交"/>
	</div>
</form>