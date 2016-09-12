<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>
<?php $this->beginBlock('test') ?>


$(function () {
	jQuery('#mybutton').on('click', function (e) {
var $form = $(this);
$.ajax({
url: $form.attr('action'),
type: 'post',
data: $form.serialize(),
success: function (data) {
// do something
}
});
})
})


<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['test'],\yii\web\View::POS_END) ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加用户-有点</title>
<link rel="stylesheet" type="text/css" href="<?=ADMIN_CSS_URL ?>css.css" />
<script type="text/javascript" src="<?=ADMIN_JS_URL?>jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="<?= ADMIN_IMG_URL?>coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
			</div>
		</div>
		<div class="page ">
			<!-- 会员注册页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>会员注册</span>
				</div>
				<div class="baBody">
					<?php $form=ActiveForm::begin(['id'=>'useradd','action'=>Url::to(['insert'])]) ?>
						<?= $form->field($model,'id')->hiddenInput(['valie'=>null]);?>

									<div class="bbD">
						&nbsp;&nbsp;&nbsp;<?= $form->field($model,'username')->label('用户名')->textInput(['class'=>'input1']) ?>
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $form->field($model,'password')->label('密码')->passwordInput(['class'=>'input2']); ?>

					</div>
					<div class="bbD">
						<?= $form->field($model,'lever')->label('用户等级')->textInput(['class'=>'input3'])?>

					</div>
					<div class="bbD">
						<p class="bbDP">
							<!--<button class="btn_ok btn_yes" href="#">提交</button>-->
							<?= Html::submitButton('提交',['class'=>'btn_ok btn_yes'])?>
							<a class="btn_ok btn_no" href="#">取消</a>
							<input type="button" id="mybutton" name="tijiao" value="ti" />
						</p>
					</div>
					<?php $form=ActiveForm::end(); ?>
				</div>

			</div>
<?php $this->registerJs("alert(1);",yii\web\View::POS_END,'my-test'); ?>
			<!-- 会员注册页面样式end -->
		</div>
	</div>
</body>
</html>