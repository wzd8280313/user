<?php 
namespace app\models;

class EntryForm extends \yii\base\Model{
	public $name;
	public $email;
	public function rules(){
		return [
			[['name','email'],'required'],
			['email','email'],
		];


	}


}

?>