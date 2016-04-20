<?php
/* @var $this TestStationOperationRecordController */
/* @var $model TestStationOperationRecord */

$this->breadcrumbs=array(
	'Test Station Operation Records'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TestStationOperationRecord', 'url'=>array('index')),
	array('label'=>'Create TestStationOperationRecord', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#test-station-operation-record-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Test Station Operation Records</h1>

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
	'id'=>'test-station-operation-record-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'dc_potential1',
		'ac_inter_potential1',
		'dc_potential2',
		'ac_inter_potential2',
		'current_input1',
		/*
		'current_input2',
		'current_input3',
		'current_input4',
		'battery',
		'sampling_interval',
		'testing_time',
		'property',
		'collected',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
