<?php
$DOMOB_WEB_BASE_DIR = implode(DIRECTORY_SEPARATOR, array('', 'home', $_SERVER['USER'], 'htdocs', 'mis'));
$GLOBALS['THRIFT_ROOT'] = '/usr/local/domob/current/mis-lib/thirdparty/thrift/';

Yii::setPathOfAlias('lib',$DOMOB_WEB_BASE_DIR.'/lib');
Yii::setPathOfAlias('bootstrap', $DOMOB_WEB_BASE_DIR.'/lib/extensions/yii-bootstrap-2.1.0.r355');
Yii::setPathOfAlias('domob-thrift','/usr/local/domob/current/domob-thrift/php');
$db_config = require_once($DOMOB_WEB_BASE_DIR.'/conf/db_config.php');
$import_config = require_once($DOMOB_WEB_BASE_DIR.'/conf/import_config.php');
$components_config = require_once($DOMOB_WEB_BASE_DIR.'/conf/components_config.php');

$confDir = dirname(__FILE__);
$rtbLogDir = $DOMOB_WEB_BASE_DIR.'/log';

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'name'=>'RTB后台',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	// 'theme' => 'bootstrap',

	// 默认控制器
	// 'defaultController'=>'site',

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
			'application.models.campaign.*',
			'application.models.promotion.*',
			'application.models.template.*',
			'application.models.creative.*',
			'application.models.mediagroup.*',
			'application.models.common.*',
			'application.models.dsp.*',
			'application.models.misc.*',
			'application.models.search.*',
			'application.models.events.*',
        )
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'generatorPaths'=>array(
				'bootstrap.gii',
			),
			'password'=>'gii',
			'ipFilters' => array('127.0.0.1', '10.0.0.*'),
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
		'db' => $db_config['admin'],
		'offerwallDb' => $db_config['offerwall'],
		'statsDb' => $db_config['stats'],
		'dspDb' => $db_config['dsp'],
		'workflowDb' => $db_config['workflow'],
		'adminDb' => $db_config['admin'],
		'deviceDb' => $db_config['device'],
		'userDb' => $db_config['user'],
		'mediainfoDb' => $db_config['mediainfo'],
		'adinfoDb' => $db_config['adinfo'],
		'passportDb'=>$db_config['passport'],
        'dreportDb' => $db_config['dreport'],
        'rtbReportDb' => $db_config['rtbReport'],
        'biDb' => $db_config['bi'],
		'gameDb' => $db_config['game'],
		'gameReportDb' => $db_config['das_game_access'],
        'rtbDb' => $db_config['rtb'],

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
			'basePath' => $DOMOB_WEB_BASE_DIR . '/assets/',
			'baseUrl' => '/assets/',
		),

		'appsManager' => array(
			'class' => 'DspAppsManager',
		),

		'authManager'=>$components_config['authManager'],
		'excel' => array('class' => 'lib.extensions.ExcelBuilder',),

		'errorHandler'=>array(
			'class' => 'ConsoleErrorHandler',
        ),

		//'log'=>$components_config['log'], // nope
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'info',
					'logPath' => $rtbLogDir,
					'logFile' => 'rtb.info.log',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'warning',
					'logPath' => $rtbLogDir,
					'logFile' => 'rtb.warning.log',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error',
					'logPath' => $rtbLogDir,
					'logFile' => 'rtb.error.log',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'debug',
					'logPath' => $rtbLogDir,
					'logFile' => 'rtb.debug.log',
				),
			),
		),
		// 默认时间格式是'年/月/日', 如'2011/8/10'. But... 还是 '2011-8-10' 顺眼一点...
		'format'=>array('dateFormat'=>'Y-m-d'),
	),
    // 赞，这里merge了好多东西。
	'params'=> array_merge(
		require_once($DOMOB_WEB_BASE_DIR.'/conf/config_admin.php'),
        require_once($confDir.'/config_params.php')
	),
);
