<?php
$WEB_BASE_DIR = $_SERVER['DOCUMENT_ROOT'];

Yii::setPathOfAlias('lib',$WEB_BASE_DIR.'/lib');
Yii::setPathOfAlias('bootstrap', $WEB_BASE_DIR.'/lib/extensions/yii-bootstrap-2.1.0.r355');
$db_config = require_once($WEB_BASE_DIR.'/protected/config/db_config.php');
$import_config = require_once($WEB_BASE_DIR.'/protected/config/import_config.php');
$components_config = require_once($WEB_BASE_DIR.'/protected/config/components_config.php');

if (!function_exists('dm_dump')) {
	function dm_dump($expr) {
		echo '<pre>';
		var_dump($expr);
		die();
	}
}

$confDir = dirname(__FILE__);
$logDir = $WEB_BASE_DIR.'/log';

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'name'=>'D.O.T.A.',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'theme' => 'bootstrap',

	// 默认控制器
	'defaultController'=>'index',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array_merge(
		$import_config,
		array(
			'lib.util.*',
			'lib.common.model.*',
			'lib.common.widgets.*',
			'application.models.*',
			'application.components.*',
			'application.models.record.*',
			'application.models.station.*',
		)
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'generatorPaths'=>array(
				'bootstrap.gii',
			),
			'password'=>'gii',
			'ipFilters' => array('127.0.0.1', '10.0.0.*', '*'),
		),
	),

	// application components
	'components'=>array(
		'bootstrap' => array(
			'class' => 'bootstrap.components.Bootstrap',
		),
		'user'=>$components_config['user'],
		'statePersister' => $components_config['statePersister'],
		'securityManager' => $components_config['securityManager'],
		'tokenSecurityManager' => $components_config['tokenSecurityManager'],
		'thriftEnumHelper' => $components_config['thriftEnumHelper'],
		'db' => $db_config['dota'],

		'urlManager' => array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array_merge(
				array(
					'docs/<id:\w+>.html'=>'docs/view',
					'<controller:\w+>/<id:\d+>'=>'<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
					'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				)
			),
		),

		'assetManager' => array(
			'basePath' => $WEB_BASE_DIR . '/assets/',
			'baseUrl' => '/assets/',
		),

		'appsManager' => array(
			'class' => 'DspAppsManager',
		),

		'authManager'=>$components_config['authManager'],
		'excel' => array('class' => 'lib.extensions.ExcelBuilder',),

		'errorHandler'=> (defined('YII_DEBUG') && YII_DEBUG) ? null : array(
			'errorAction'=> 'site/error',
		),

		//'log'=>$components_config['log'], // nope
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'info',
					'logPath' => $logDir,
					'logFile' => 'dota.info.log',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'warning',
					'logPath' => $logDir,
					'logFile' => 'dota.warning.log',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error',
					'logPath' => $logDir,
					'logFile' => 'dota.error.log',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'debug',
					'logPath' => $logDir,
					'logFile' => 'dota.debug.log',
				),
			),
		),
		// 默认时间格式是'年/月/日', 如'2011/8/10'. But... 还是 '2011-8-10' 顺眼一点...
		'format'=>array(
			'dateFormat'=>'Y-m-d',
			'numberFormat' => array(
				'decimals' => 1,
			),
		),
	),
	'params'=> require_once($WEB_BASE_DIR.'/protected/config/config_params.php'),
);
