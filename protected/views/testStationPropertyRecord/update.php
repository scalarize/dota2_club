<?php
/* @var $this TestStationPropertyRecordController */
/* @var $model TestStationPropertyRecord */

$this->breadcrumbs=array(
	'Test Station Property Records'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TestStationPropertyRecord', 'url'=>array('index')),
	array('label'=>'Create TestStationPropertyRecord', 'url'=>array('create')),
	array('label'=>'View TestStationPropertyRecord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TestStationPropertyRecord', 'url'=>array('admin')),
);
?>

<h1>Update TestStationPropertyRecord <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>