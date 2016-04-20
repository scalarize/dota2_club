<?php
/* @var $this TestStationOperationRecordController */
/* @var $model TestStationOperationRecord */

$this->breadcrumbs=array(
	'Test Station Operation Records'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TestStationOperationRecord', 'url'=>array('index')),
	array('label'=>'Create TestStationOperationRecord', 'url'=>array('create')),
	array('label'=>'View TestStationOperationRecord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TestStationOperationRecord', 'url'=>array('admin')),
);
?>

<h1>Update TestStationOperationRecord <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>