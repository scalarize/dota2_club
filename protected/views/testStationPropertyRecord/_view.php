<?php
/* @var $this TestStationPropertyRecordController */
/* @var $data TestStationPropertyRecord */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pipe_segment_id')); ?>:</b>
	<?php echo CHtml::encode($data->pipe_segment_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pipe_stage_id')); ?>:</b>
	<?php echo CHtml::encode($data->pipe_stage_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('protect_object')); ?>:</b>
	<?php echo CHtml::encode($data->protect_object); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teststation_type')); ?>:</b>
	<?php echo CHtml::encode($data->teststation_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('specification')); ?>:</b>
	<?php echo CHtml::encode($data->specification); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teststation_num')); ?>:</b>
	<?php echo CHtml::encode($data->teststation_num); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('gps')); ?>:</b>
	<?php echo CHtml::encode($data->gps); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_des')); ?>:</b>
	<?php echo CHtml::encode($data->location_des); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orographic')); ?>:</b>
	<?php echo CHtml::encode($data->orographic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('administation')); ?>:</b>
	<?php echo CHtml::encode($data->administation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('material')); ?>:</b>
	<?php echo CHtml::encode($data->material); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('picture')); ?>:</b>
	<?php echo CHtml::encode($data->picture); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('output_number')); ?>:</b>
	<?php echo CHtml::encode($data->output_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampling_interval_begin')); ?>:</b>
	<?php echo CHtml::encode($data->sampling_interval_begin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('munufactuter')); ?>:</b>
	<?php echo CHtml::encode($data->munufactuter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('install_date')); ?>:</b>
	<?php echo CHtml::encode($data->install_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mannagement_unit')); ?>:</b>
	<?php echo CHtml::encode($data->mannagement_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('icon_show')); ?>:</b>
	<?php echo CHtml::encode($data->icon_show); ?>
	<br />

	*/ ?>

</div>