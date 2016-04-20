<?php
$baseUrl = Yii::app()->baseUrl;
$homeLink = Yii::app()->homeUrl;
if (isset($user) && isset($user->profile) && isset($user->profile->dsp_default_url)) {
	$homeLink = $user->profile->dsp_default_url;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<?php
	$staticSite = Yii::app()->params['STATIC_LIBS_SITE'];
	Yii::app()->clientScript->registerCoreScript('jquery');

	Yii::app()->clientScript->registerScriptFile($staticSite.'/js/jqueryui/1.9.2/ui/jquery-ui.js');
	Yii::app()->clientScript->registerScriptFile($staticSite.'/js/highcharts/3.0.7/js/highcharts.js');
	Yii::app()->clientScript->registerScriptFile($staticSite.'/js/highcharts/3.0.7/js/modules/exporting.js');
	Yii::app()->clientScript->registerCssFile($staticSite.'/css/jqueryui/1.9.2/themes/smoothness/jquery-ui.css');

	Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/common.js?v=20151203');
	Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/plugin/pubsub/jquery.pubsub.js');
	Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/eventrouter.js');
	Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/jquery.cookie.js');
	Yii::app()->clientScript->registerCssFile($baseUrl.'/css/main.css?v=20150908');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/select2.css');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/select2.min.js');
	Yii::app()->clientScript->registerScript("select2", '$(function(){$(".select2").select2()});');
	Yii::app()->bootstrap->register();
	?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<script>
	var __domob_debug = <?php echo defined('YII_DEBUG') && YII_DEBUG ? 'true' : 'false'; ?>;
</script>

<?php
$this->widget('bootstrap.widgets.TbNavbar',array(
	'collapse' => true,
	'brandUrl' => $homeLink,
   	'items'=>array(
	   	array(
	   		'class'=>'bootstrap.widgets.TbMenu',
			'items'=> $this->menuItems,
	   	),
		array(
			'class'=>'bootstrap.widgets.TbMenu',
			'htmlOptions'=>array('class'=>'pull-right'),
			'items'=>array(
/*
				array('label' => '帮助文档', 
					'icon' => 'icon-question-sign', 
					'url' => '#', 
					'items' => $this->docItems,
					'htmlOptions' => array('target' => '_blank'),
				),
*/
				array(
					'icon'=>' icon-bell',
					'url'=>'/rtb/misc/inbox',
					'itemOptions'=>array('class'=>'inbox'),
				),
				array('label' => Yii::app()->user->name, 'icon' => 'icon-user', 'url'=>'#', 'items'=>array(
					array('label'=>'返回主系统', 'url'=>'/'),
					array('label'=>'广告CRM系统', 'url'=>'/adcrm'),
					array('label'=>'维度数据分析平台', 'url'=>'http://olap.domob-inc.cn'),
					'---',
					array('label'=>'退出登录', 'url'=>'/index.php/site/logout'),
				)),
			),
		),
)));
?>

<div class="container" id="content">
<div id="quickSearch">
	<?php
	if (is_array($this->searchConfig)) {
		$searchConfig = $this->searchConfig;
		$sform = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'action' => Yii::app()->createUrl($searchConfig['url']),
			'method' => 'get',
			'type' => 'search',
			'id' => 'quickSearchForm',
			'htmlOptions' => array(
				'class'=>'navbar-form pull-right',
			),
		));
	?>
	<div class="input-prepend">
	<span class="add-on"><i class="icon-search"></i></span>
	<?php
		echo CHtml::textField($searchConfig['key'], $searchConfig['value'],
			array(
				'class' => 'input-large',
				'placehoder' => 'search',
			)
		);
		echo "</div>";
		echo CHtml::hiddenField('category', $this->searchConfig['category']);
		echo "<br>\n";
		foreach ($searchConfig['buttons'] as $button) {
			$text = $button['text'];
			$button['class'] = 'btn';
			echo CHtml::submitButton($text, $button);
			echo " ";
		}
		$this->endWidget();
	}
	?>
</div>

<div>
	<?php $this->renderPartial('../common/flashes'); ?>
	<?php echo $content; ?>
</div>
<div> <!-- container -->
<div id="footer">
	&copy; 2013-<?php echo date('Y'); ?> domob.cn - RTB后台 __BUILD_VERSION__
</div>

</body>
</html>
