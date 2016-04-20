<?php
/* @var $this TestStationPropertyRecordController */
/* @var $model TestStationPropertyRecord */

$this->breadcrumbs=array(
	'Test Station Property Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TestStationPropertyRecord', 'url'=>array('index')),
	array('label'=>'Manage TestStationPropertyRecord', 'url'=>array('admin')),
);
?>

<h1>Create TestStationPropertyRecord</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>