<?php
$baseUrl = Yii::app()->baseUrl;
$homeLink = Yii::app()->homeUrl;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<?php
	$staticSite = Yii::app()->params['STATIC_LIBS_SITE'];
	Yii::app()->clientScript->registerCoreScript('jquery');

	Yii::app()->clientScript->registerScriptFile($staticSite.'/js/jqueryui/1.9.2/ui/jquery-ui.js');
	Yii::app()->clientScript->registerCssFile($staticSite.'/css/jqueryui/1.9.2/themes/smoothness/jquery-ui.css');
	Yii::app()->clientScript->registerScriptFile($staticSite.'/js/highcharts/4.1.9/js/highcharts.js');
	Yii::app()->clientScript->registerScriptFile($staticSite.'/js/highcharts/4.1.9/js/highcharts-more.js');
	Yii::app()->clientScript->registerScriptFile($staticSite.'/js/highcharts/4.1.9/js/highcharts-3d.js');
	Yii::app()->clientScript->registerScriptFile($staticSite.'/js/highcharts/4.1.9/js/modules/exporting.js');

	Yii::app()->clientScript->registerScriptFile($baseUrl. '/js/jquery.parsepinyin.js');
	Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/common.js?v=20151203');
	Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/plugin/pubsub/jquery.pubsub.js');
	Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/eventrouter.js');
	Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/jquery.cookie.js');
	Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/jquery.customfileinput.js');
	Yii::app()->clientScript->registerCssFile($baseUrl.'/css/main.css?v=20151124');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/select2.css');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/select2.min.js');
	Yii::app()->clientScript->registerScript("select2", '$(function(){$(".select2").select2()});');
	Yii::app()->bootstrap->register();
	?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>

<?php echo $content; ?>
</body>
</html>
