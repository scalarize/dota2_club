<?php

set_time_limit(0);

$yii = '/usr/local/yii/yii-1.1.13.e9e4a0/framework/yii.php';
$config = dirname(__FILE__).'/../../config/console.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
$app = Yii::createWebApplication($config);

Yii::import('application.models.dsp.*');

// continuously
while (true) {

	# find campaigns that not over yet
	$campaigns = DSPCampaignModel::model('DSPCampaignModel')
		->findAll('status != 2');

	foreach ($campaigns as $campaign) {

		DSPStatsDailyRecord::model()->deleteAll('campaign_id=?', array($campaign->id));

		// traverse RTBCampaignModel
		foreach ($campaign->rtbUnits as $id => $rtbCampaign) {
			$today = date('Ymd');
			$product_type = 3;
			$uid = $rtbCampaign->sponsor_id;
			$pid = $rtbCampaign->id;
			$stats = $rtbCampaign->currentStats;
			$record = new DSPStatsDailyRecord();
			$record->dt = $today;
			$record->campaign_id = $campaign->id;
			$record->product_type = $product_type;
			$record->product_uid = $uid;
			$record->product_pid = $pid;
			foreach (array('imp', 'clk', 'act', 'ad_price', 'media_price') as $field) {
				$record->$field = isset($stats->$field) ? $stats->$field : 0;
			}
			$record->save();
		}

		// traverse ADNCampaignModel
		foreach ($campaign->adnUnits as $id => $adnCampaign) {
			$today = date('Ymd');
			$product_type = 1;
			$uid = $adnCampaign->uid;
			$pid = $adnCampaign->id;
			$stats = $adnCampaign->currentStats;
			$record = new DSPStatsDailyRecord();
			$record->dt = $today;
			$record->campaign_id = $campaign->id;
			$record->product_type = $product_type;
			$record->product_uid = $uid;
			$record->product_pid = $pid;
			foreach (array('imp', 'clk', 'act', 'ad_price', 'media_price') as $field) {
				$record->$field = isset($stats->$field) ? $stats->$field : 0;
			}
			$record->save();
		}

		echo "campaign #{$campaign->id} stats updated, sleeping...\n";
		sleep(1);
	}

}

/** vim: set bg=dark noet ts=4 sw=4 st=4 fdm=indent: */



