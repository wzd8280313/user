<?php
namespace app\controllers;
use \yii\base\Controller;
use \app\models\Article;
class HomeController extends Controller{
    public function actionIndex(){
        $request=\Yii::$app->request;
        $ip=$request->userIp;
        $id=$request->get('id',1);
        $name='王占德';
        $data=compact('ip','id','name');
       //return  $this->renderPartial('index',$data);
        return $this->render('index',$data);
    }
    public function actionSql(){
        $sql='select * from article';
        //装换成数组
        //$result=Article::findbysql($sql)->asArray()->all();
        //where条件查询单条数组
        $result=Article::find()->where(['id'=>1])->all();
        //where查血id>3
        $result=Article::find()->where(['>','id',3])->all();
        //where查询5>id>3
        $result=Article::find()->where(['between','id','3','5'])->all();
        //like查询
        $result=Article::find()->where(['like','title','图'])->all();
        //find查询单条数据
        $result=Article::find()->where(['id'=>5])->one();
        //查询多条数据
        $result=Article::findAll([3,4,5]);
        //装换成数组
        //$result=Article::findbysql($sql)->asArray()->all();
        //去大量数据,一次取两条
        $result=array();
        foreach(Article::find()->batch(2) as $v){
            $result[]=$v;
        }
        $result=Article::find([]);
        var_dump($result);
    }
    public function actionInsert(){
        $article=new Article();
        $article->title='hello php';
        $article->content=22;
        $res=$article->insert();
        $res=$article->save();
        //$res=$article->attributes['num'];
        var_dump($res);

    }

}
?>