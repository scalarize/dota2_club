<?php
/* @var $this TestStationPropertyRecordController */
/* @var $model TestStationPropertyRecord */

$this->breadcrumbs=array(
	'Test Station Property Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TestStationPropertyRecord', 'url'=>array('index')),
	array('label'=>'Create TestStationPropertyRecord', 'url'=>array('create')),
	array('label'=>'Update TestStationPropertyRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TestStationPropertyRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TestStationPropertyRecord', 'url'=>array('admin')),
);
?>

<h1>View TestStationPropertyRecord #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'pipe_segment_id',
		'pipe_stage_id',
		'protect_object',
		'teststation_type',
		'specification',
		'teststation_num',
		'gps',
		'location_des',
		'orographic',
		'administation',
		'material',
		'picture',
		'output_number',
		'sampling_interval_begin',
		'munufactuter',
		'install_date',
		'mannagement_unit',
		'icon_show',
	),
)); ?>
