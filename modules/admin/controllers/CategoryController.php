<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/7
 * Time: 11:15
 */

namespace app\modules\admin\controllers;



use app\assets\CategoryAsset;
use app\modules\admin\models\CategoryForm;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

class CategoryController extends \yii\web\Controller
{
    public $layout=false;
    public function actionEdit(){
        $model=new CategoryForm();
        $category=[
            'id'=>1,
            'title'=>'test',
            'intra'=>"hello world",
            'order_num'=>1
        ];
        return $this->render('edit',['model'=>$model,'category'=>$category]);
    }
    public function actionAdd(){
        $model=new CategoryForm();
        return $this->renderPartial('add',['model'=>$model]);
    }
    public function actionInsert(){
        $model=new CategoryForm();
        $request=\Yii::$app->request;
        if($model->load($request->post())&&$model->validate()){
            $model->insert();
           \Yii::$app->getSession()->setFlash('success','保存成功');
            // return $this->renderPartial('list',['model'=>$model]);
        }else{
            return $this->renderPartial('add',['model'=>$model]);
        }
        return $this->redirect(['list']);
    }
    public function actionUpdate(){
        $model=new CategoryForm();
        if($model->load(\Yii::$app->request->post())&&$model->validate()){
           // $model->attributes=\Yii::$app->request->post();
            $model->insert();
            return $this->render('list',['model'=>$model]);
        }else{
            $category=[
                'id'=>1,
                'title'=>'test',
                'intra'=>"hello world",
                'order_num'=>1
            ];
            return $this->render('edit',['model'=>$model,'category'=>$category]);
        }
    }
    public function actionList(){
  /*      $model=new CategoryForm();
        $query=$model::find();
        $count=$query->count();
        $pagination=new Pagination(['totalCount'=>$count,'defaultPageSize'=>2]);
        $models=$query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('list',['model'=>$models,'pagination'=>$pagination]);*/
        $model=new ActiveDataProvider([
            'query'=>CategoryForm::find(),
            'pagination'=>[
                'pageSize'=>2
            ]
        ]);
        return $this->render('list',['model'=>$model]);
    }
}