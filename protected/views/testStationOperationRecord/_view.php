<?php
/* @var $this TestStationOperationRecordController */
/* @var $data TestStationOperationRecord */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_potential1')); ?>:</b>
	<?php echo CHtml::encode($data->dc_potential1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ac_inter_potential1')); ?>:</b>
	<?php echo CHtml::encode($data->ac_inter_potential1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_potential2')); ?>:</b>
	<?php echo CHtml::encode($data->dc_potential2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ac_inter_potential2')); ?>:</b>
	<?php echo CHtml::encode($data->ac_inter_potential2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('current_input1')); ?>:</b>
	<?php echo CHtml::encode($data->current_input1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('current_input2')); ?>:</b>
	<?php echo CHtml::encode($data->current_input2); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('current_input3')); ?>:</b>
	<?php echo CHtml::encode($data->current_input3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('current_input4')); ?>:</b>
	<?php echo CHtml::encode($data->current_input4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('battery')); ?>:</b>
	<?php echo CHtml::encode($data->battery); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampling_interval')); ?>:</b>
	<?php echo CHtml::encode($data->sampling_interval); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('testing_time')); ?>:</b>
	<?php echo CHtml::encode($data->testing_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property')); ?>:</b>
	<?php echo CHtml::encode($data->property); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('collected')); ?>:</b>
	<?php echo CHtml::encode($data->collected); ?>
	<br />

	*/ ?>

</div>