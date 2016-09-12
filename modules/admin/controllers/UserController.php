<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/6
 * Time: 10:51
 */

namespace app\modules\admin\controllers;
use app\models\User;
use yii\web\Controller;

class UserController extends Controller
{
    public $layout=false;
    public $enableCsrfValidation = false;
    public function actionUser(){
       return  $this->renderPartial('user');
    }
    public function actionUseradd(){
        $model=new \app\modules\admin\models\user();
        return $this->render('useradd',['model'=>$model]);
    }
    public function actionInsert(){
        $req= \Yii::$app->request;
        if($req->isPost){
            $model=new \app\modules\admin\models\user();
           var_dump($_POST);
         /*   $model->adminname=$req->post('user')['adminname'];
            $model->password=$req->post('user')['password'];
            $model->lever=$req->post('user')['lever'];*/
           //$model->setAttributes($req->post('user'));
            //$model->attributes=$req->post('user');
            $res=$req->post('user');
            $model->username=$res['username'];
            $model->lever=$res['lever'];
            $model->password=$res['password'];
         /*   $model->username=$res['username'];
            $model->lever=$res['lever'];
            $model->password=$res['password'];*/
            //var_dump($model->attributes);
            echo "<pre>";
            print_r($model);
            $model->insert(false);
            die;
            if($model->validate()){
                //$model->load($req->post('user'));
                $model->save();
            }else{
                $error=$model->errors;
                var_dump($error);
            }

        }
    }
    public function actionTest(){
     //   \Yii::$app->user->setFlash('success', "Thinks saved success!");
    }
}