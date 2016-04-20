<?php
/* @var $this TestStationOperationRecordController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Test Station Operation Records',
);

$this->menu=array(
	array('label'=>'Create TestStationOperationRecord', 'url'=>array('create')),
	array('label'=>'Manage TestStationOperationRecord', 'url'=>array('admin')),
);
?>

<h1>Test Station Operation Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
