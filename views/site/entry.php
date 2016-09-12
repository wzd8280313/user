<?php  
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form=activeForm::begin();?>
	<?=$form->field($model,'name')?>
	<?=$form->field($model,'email')?>
	<!--  自定义名字 -->
	<?=$form->field($model,'name')->label('名字')?>
	<?=$form->field($model,'email')->label('邮箱')?>
	<div class='form-group'>
		<?=Html::submitButton('Submit',['class'=>'btn btn-primary'])?>

	</div>
<?php activeForm::end(); ?>