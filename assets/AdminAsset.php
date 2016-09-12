<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/31
 * Time: 17:32
 */
namespace app\assets;
use yii\web\AssetBundle;

class AdminAsset extends AssetBundle{
    public $basePath='@webroot';
    public $baseUrl='@web';
    public $js=[
        'js/admin/ajaxfileupload.js',
        'js/admin/jquery.min.js',
        'js/admin/public.js'
    ];
}