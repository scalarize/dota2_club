<?php

$yii = '/usr/local/yii/yii-1.1.13.e9e4a0/framework/yii.php';
$config = dirname(__FILE__).'/../../config/console.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
$app = Yii::createWebApplication($config);

Yii::import('application.models.dsp.*');

# find campaigns that not over yet
$campaigns = DSPCampaignOperationModel::model('DSPCampaignOperationModel')
	->findAll('status not in (2, 99)');

foreach ($campaigns as $campaign) {
	$campaign->doRoutine();
}

/** vim: set bg=dark noet ts=4 sw=4 st=4 fdm=marker: */


