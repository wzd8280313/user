<form name='form' action="<?php echo IUrl::creatUrl("/test/insert3");?>" method='post' enctype="multipart/form-data">
	<input name='name' type='text' />
	<input type='file' name='image[]' />
	<input type='file' name='image[]' />
	<input type='submit' value='tijiao' />
</form>