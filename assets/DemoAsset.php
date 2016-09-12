<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/31
 * Time: 15:29
 */
namespace app\assets;

use yii\web\AssetBundle;
class DemoAsset extends AssetBundle{
    public $basePath='@webroot';
    public $baseUrl='@web';
    public $js=['js/demo.js'];
}