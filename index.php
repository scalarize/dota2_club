<?php
define('BUILD_VERSION', '__BUILD_VERSION__');
//phpinfo();

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Shanghai');
;
// change the following paths if necessary
$yii='/usr/local/yii/yii-1.1.16.bca042/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
$app = Yii::createWebApplication($config);
#$app->setRuntimePath($_SERVER['DOCUMENT_ROOT'] . '/protected/runtime/dota/');
$app->run();

