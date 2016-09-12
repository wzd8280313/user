<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/31
 * Time: 11:51
 */
namespace app\modules\admin\controllers;
use yii\web\Controller;
class TestController extends Controller
{
    public $layout="test";
    public function actionGreet(){
        //echo 1;
        return $this->render('greet');
    }
}