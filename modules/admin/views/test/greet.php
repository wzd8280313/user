<?php
    use yii\helpers\Html;
    use app\assets\AdminAsset;
    AdminAsset::register($this);
    $this->title='关于我们';
    $this->params['breadcrumbs'][]=$this->title;
    $this->registerMetaTag(['name'=>'keywords','content'=>'yii,yii教程']);
    $this->registerMetaTag(['name'=>'description','content'=>'这是一个页面的描述'],'description');
?>
<div class="site-about">
    <h1><?= Html::encode($this->title)?></h1>
    <code><?= __FILE__ ?></code>
    </div>
