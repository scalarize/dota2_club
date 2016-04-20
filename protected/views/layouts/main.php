<?php
$baseUrl = Yii::app()->baseUrl;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<?php
	Yii::app()->clientScript->registerCoreScript('jquery');
	Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/common.js?v=20150925');

	Yii::app()->clientScript->registerCssFile($baseUrl.'/css/main.css?v=20150908');
	Yii::app()->clientScript->registerCssFile($baseUrl.'/css/md.css');
	Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/select2.css');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/select2.min.js');
	Yii::app()->clientScript->registerScript("select2", '$(function(){$(".select2").select2()});');

	Yii::app()->bootstrap->register();
	?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<script>
	var __debug = <?php echo defined('YII_DEBUG') && YII_DEBUG ? 'true' : 'false'; ?>;
</script>

<?php
$this->widget('bootstrap.widgets.TbNavbar',array(
	'collapse' => true,
   	'items'=>array(
	   	array(
	   		'class'=>'bootstrap.widgets.TbMenu',
			'items'=> $this->menuItems,
	   	),
		array(
			'class'=>'bootstrap.widgets.TbMenu',
			'htmlOptions'=>array('class'=>'pull-right'),
			'items'=>array(
				array('label' => '文档', 
					'icon' => 'icon-question-sign', 
					'url' => '#', 
					'items' => $this->docItems,
					'htmlOptions' => array('target' => '_blank'),
				),
				array('label' => Yii::app()->user->name, 'icon' => 'icon-user', 'url'=>'#', 'items'=>array(
					'---',
				)),
			),
		),
)));
?>

<div class="container" id="content">
<div>
	<?php
	$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
		'homeLink' => CHtml::link('D.O.T.A.', Yii::app()->homeUrl),
		'separator' => '&gt;',
		'links'=>$this->breadcrumbs,
	));
	?>
</div>

<div>
	<?php $this->renderPartial('../common/flashes'); ?>
	<?php echo $content; ?>
</div>
<div> <!-- container -->
<div id="footer">
	&copy; 2016-<?php echo date('Y'); ?> D.O.T.A. __BUILD_VERSION__
</div>

</body>
</html>

