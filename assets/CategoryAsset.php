<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/7
 * Time: 17:27
 */

namespace app\assets;
use yii\web\AssetBundle;

class CategoryAsset extends AssetBundle
{
    public $basePath='@webroot';
    public $baseUrl='@web';
    public $css=[
        'css/admin/bootstrap.min.css',
        'css/admin/font-awesome.min.css',
        'css/admin/ionicons.min.css',
        'css/admin/AdminLTE.css'
    ];
    public $js=[
        'js/admin/bootstrap.min.js',
        'js/admin/app.js'
    ];
    public $depends=[
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}