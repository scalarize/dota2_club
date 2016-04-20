<?php
/* @var $this TestStationPropertyRecordController */
/* @var $model TestStationPropertyRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'test-station-property-record-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pipe_segment_id'); ?>
		<?php echo $form->textField($model,'pipe_segment_id'); ?>
		<?php echo $form->error($model,'pipe_segment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pipe_stage_id'); ?>
		<?php echo $form->textField($model,'pipe_stage_id'); ?>
		<?php echo $form->error($model,'pipe_stage_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'protect_object'); ?>
		<?php echo $form->textField($model,'protect_object',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'protect_object'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teststation_type'); ?>
		<?php echo $form->textField($model,'teststation_type',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'teststation_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'specification'); ?>
		<?php echo $form->textField($model,'specification',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'specification'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'teststation_num'); ?>
		<?php echo $form->textField($model,'teststation_num'); ?>
		<?php echo $form->error($model,'teststation_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gps'); ?>
		<?php echo $form->textField($model,'gps',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'gps'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location_des'); ?>
		<?php echo $form->textArea($model,'location_des',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'location_des'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'orographic'); ?>
		<?php echo $form->textField($model,'orographic',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'orographic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'administation'); ?>
		<?php echo $form->textField($model,'administation',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'administation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'material'); ?>
		<?php echo $form->textField($model,'material',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'material'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'picture'); ?>
		<?php echo $form->textField($model,'picture'); ?>
		<?php echo $form->error($model,'picture'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'output_number'); ?>
		<?php echo $form->textField($model,'output_number'); ?>
		<?php echo $form->error($model,'output_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sampling_interval_begin'); ?>
		<?php echo $form->textField($model,'sampling_interval_begin'); ?>
		<?php echo $form->error($model,'sampling_interval_begin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'munufactuter'); ?>
		<?php echo $form->textField($model,'munufactuter',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'munufactuter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'install_date'); ?>
		<?php echo $form->textField($model,'install_date',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'install_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mannagement_unit'); ?>
		<?php echo $form->textField($model,'mannagement_unit',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'mannagement_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'icon_show'); ?>
		<?php echo $form->textField($model,'icon_show'); ?>
		<?php echo $form->error($model,'icon_show'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->