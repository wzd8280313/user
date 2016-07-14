<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
define('APP_PATH','./Application/');
define('SITE_URL','http://localhost/lianxi/');
define('CSS_URL',SITE_URL.'Public/Home/style/');
define('JS_URL',SITE_URL.'Public/Home/js/');
define('IMG_URL',SITE_URL.'Public/Home/images/');
define('AD_CSS_URL',SITE_URL.'Public/Admin/css/');
define('AD_JS_URL',SITE_URL.'Public/Admin/js/');
define('AD_IMG_URL',SITE_URL.'Public/Admin/images/');
//定义插件常量
define('PLUGIN_URL',SITE_URL.'Common/Plugin/Plugin/');
// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单