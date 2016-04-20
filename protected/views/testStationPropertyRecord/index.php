<?php
/* @var $this TestStationPropertyRecordController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Test Station Property Records',
);

$this->menu=array(
	array('label'=>'Create TestStationPropertyRecord', 'url'=>array('create')),
	array('label'=>'Manage TestStationPropertyRecord', 'url'=>array('admin')),
);
?>

<h1>Test Station Property Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
