<?php
/* @var $this TestStationOperationRecordController */
/* @var $model TestStationOperationRecord */

$this->breadcrumbs=array(
	'Test Station Operation Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TestStationOperationRecord', 'url'=>array('index')),
	array('label'=>'Manage TestStationOperationRecord', 'url'=>array('admin')),
);
?>

<h1>Create TestStationOperationRecord</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>