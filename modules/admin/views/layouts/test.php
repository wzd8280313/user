<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/31
 * Time: 14:19
 */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
AppAsset::register($this);
//\app\assets\DemoAsset::register($this);
?>
<?php  $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset   ?>">
        <meta name="viewport" content="width=device-width,initial-scale=1" >
        <title><?= Html::encode($this->title) ?></title>
        <?= $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody()?>
            <div class="wrap">
                <div class="container">
                  <?= $content ?>
                </div>
            </div>
        <footer class="footer">
            <div class="container">
                    <p class="pull-left">222</p>
                    <p class="pull-right"></p>
                </div>
        </footer>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>