<?php
/* @var $this TestStationPropertyRecordController */
/* @var $model TestStationPropertyRecord */

$this->breadcrumbs=array(
	'Test Station Property Records'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TestStationPropertyRecord', 'url'=>array('index')),
	array('label'=>'Create TestStationPropertyRecord', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#test-station-property-record-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Test Station Property Records</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'test-station-property-record-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'pipe_segment_id',
		'pipe_stage_id',
		'protect_object',
		'teststation_type',
		'specification',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
