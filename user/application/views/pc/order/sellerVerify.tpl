<style type="text/css">
	div#verify{width: 50%;margin:0 auto;padding: 50px;height: 200px;border: 1px solid;}
	div#verify>p{width: 100%;line-height: 30px;}
	div#verify>a{display: block;margin:50px 0 0 50px;padding: 10px 20px;background-color: #ddd;color:black;width: 50px;text-align: center;text-decoration: none;border-radius: 4px;}
</style>

<div id='verify'>
	<p>扣减金额：&emsp;{$data['reduce_amount']}</p>
	<p>说明&emsp;&emsp;：&emsp;{$data['reduce_remark']}</p>

	<a href="{url:/Order/sellerVerify?order_id=$data['id']}">确认</a>	
</div>   