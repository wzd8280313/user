<?php
/**
 * @date 2015-9-13 
 * @author zhengyin <zhengyin.name@gmail.com>
 * @blog http://izhengyin.com
 * 执行方式：
 *  	/opt/app/php-5.5/bin/php /data/webroot/yaf-demo/cli/cli.php request_uri="/cli/test/run/name/zhengyin"
 */
ini_set('display_errors',1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
define('APPLICATION_PATH', dirname(__DIR__));
$application = new Yaf\Application( APPLICATION_PATH . "/conf/application.ini");
$application->bootstrap();
$application->getDispatcher()->dispatch(new Yaf\Request\Simple());
$application->run();
