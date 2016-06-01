<?php return array (
  //日志配置信息，
  'logs' => 
  array (
    //path日志存放的位置
    'path' => 'backup/logs/log',
    //存放日志的形式
    'type' => 'file',
  ),
  //配置数据，一主多从数据库
  'DB' => 
  array (
    'type' => 'mysqli',
    'tablePre' => 'shop_',
    'read' => 
    array (
      0 => 
      array (
        'host' => 'localhost:3306',
        'user' => 'root',
        'passwd' => '127890',
        'name' => 'zynshop',
      ),
    ),
    'write' => 
    array (
      'host' => 'localhost:3306',
      'user' => 'root',
      'passwd' => '127890',
      'name' => 'zynshop',
    ),
  ),
  //拦截器，在iWeb框架的各个环节可以进行调用绑定事件的函数
  'interceptor' => 
  array (
    0 => 'themeroute@onCreateController',
    1 => 'layoutroute@onCreateView',
    2 => 'hookCreateAction@onCreateAction',
    3 => 'hookFinishAction@onFinishAction',
  ),
  'langPath' => 'language',
  'viewPath' => 'views',
  'skinPath' => 'skin',
  //存放自定义类的路径,可以是string 也可以是数组
  'classes' => 'classes.*',
  //伪静态设置，url:非伪静态；pathinfo:伪静态
  'rewriteRule' => 'url',
  //主题和皮肤设置
  'theme' => 
  array (
  'pc' => 'scsg',
    'mobile' => 'mobile',

  ),
  'skin' => 
  array (
    'pc' => 'black',
    'mobile' => 'black',
  ),
  //系统默认时区
  'timezone' => 'Etc/GMT-8',
  //上传文件的目录
  'upload' => 'upload',
  'dbbackup' => 'backup/database',
  //存储会话变量的方式，session或者cookie
  'safe' => 'cookie',
  'lang' => 'zh_sc',
  //是否开启调试模式
  'debug' => true,
  //可扩展配置文件
  'configExt' => 
  array (
    'site_config' => 'config/site_config.php',
  ),
  //加密秘钥
  'encryptKey' => 'ca9a525ee353804d799e360af300d35f',
)?>