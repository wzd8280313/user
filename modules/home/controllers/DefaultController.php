<?php

namespace app\modules\home\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionTest(){
        echo 1;
    }
}
