<?php
/* @var $this TestStationOperationRecordController */
/* @var $model TestStationOperationRecord */

$this->breadcrumbs=array(
	'Test Station Operation Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TestStationOperationRecord', 'url'=>array('index')),
	array('label'=>'Create TestStationOperationRecord', 'url'=>array('create')),
	array('label'=>'Update TestStationOperationRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TestStationOperationRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TestStationOperationRecord', 'url'=>array('admin')),
);
?>

<h1>View TestStationOperationRecord #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'dc_potential1',
		'ac_inter_potential1',
		'dc_potential2',
		'ac_inter_potential2',
		'current_input1',
		'current_input2',
		'current_input3',
		'current_input4',
		'battery',
		'sampling_interval',
		'testing_time',
		'property',
		'collected',
	),
)); ?>
