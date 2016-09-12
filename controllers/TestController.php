<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/26
 * Time: 16:29
 */
namespace app\controllers;
use \yii\base\Controller;
class TestController extends \yii\base\Controller{
    /**
     *
     */
    public function actionTest(){
        echo 'Hello World';
    }
    public function actionGet(){
        $result=\Yii::$app->request;
        $id=$result->get('id',1);
        var_dump($id);

        return false;

    }
    public function actionIp(){
        $ip=\Yii::$app->request->userIp;
        var_dump($ip);
    }
    public function actionRender(){
        $request=\Yii::$app->request;
        $id=$request->get('id',1);
        $ip=$request->userIp;
        $data=[
          'id'=>$id,
          'ip'=>$ip
        ];
       // $this->renderPartial('index',$data);
        $this->renderPartial('render',$data);

    }
    public function actionTest2(){
        $arr='null,2,false,4,false,6,4';
        $arr=explode(',',$arr);
        var_dump($arr);
        $arr=array_map('trim',$arr);
        var_dump($arr);
        $arr=array_filter($arr);
        var_dump($arr);

        //var_dump(explode(','$arr));
       // $arr=array_filter(array_map('trim',explode(',',$arr)));
        //var_dump($arr);

    }
    public function actionCeshi(){
        $arr=array(0=>'密码不正错');
        $arr2=array(1=>'用户名不正确');
        echo json_encode($arr,$arr2);


    }



}