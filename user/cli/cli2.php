<?php
/**
 * @date 2015-9-13
 * @author zhengyin <zhengyin.name@gmail.com>
 * @blog http://izhengyin.com
 * 执行方式：
 *  	/opt/app/php-5.5/bin/php /data/webroot/yaf-demo/cli/cli2.php cli test run '{"name":"zhengyin"}'
 */
ini_set('display_errors',1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Shanghai');
define('APPLICATION_PATH', dirname(__DIR__));
$application = new Yaf\Application( APPLICATION_PATH . "/conf/application.ini");
$application->bootstrap();

$module =  isset($argv[1])?$argv[1]:exit("Lack params module!\n");

$controller = isset($argv[2])?$argv[2]:exit("Lack params controller!\n");

$action = isset($argv[3])?$argv[3]:exit("Lack params controller!\n");
$args = json_decode($argv[4],true);
$params = is_array($args)?$args:array();

$request = new Yaf\Request\Simple("CLI",$module,$controller,$action,$params);
$application->getDispatcher()->dispatch($request);
$application->run();
