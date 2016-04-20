<?php
/* @var $this TestStationOperationRecordController */
/* @var $model TestStationOperationRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'test-station-operation-record-form',
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
		<?php echo $form->labelEx($model,'dc_potential1'); ?>
		<?php echo $form->textField($model,'dc_potential1'); ?>
		<?php echo $form->error($model,'dc_potential1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ac_inter_potential1'); ?>
		<?php echo $form->textField($model,'ac_inter_potential1'); ?>
		<?php echo $form->error($model,'ac_inter_potential1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dc_potential2'); ?>
		<?php echo $form->textField($model,'dc_potential2'); ?>
		<?php echo $form->error($model,'dc_potential2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ac_inter_potential2'); ?>
		<?php echo $form->textField($model,'ac_inter_potential2'); ?>
		<?php echo $form->error($model,'ac_inter_potential2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'current_input1'); ?>
		<?php echo $form->textField($model,'current_input1'); ?>
		<?php echo $form->error($model,'current_input1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'current_input2'); ?>
		<?php echo $form->textField($model,'current_input2'); ?>
		<?php echo $form->error($model,'current_input2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'current_input3'); ?>
		<?php echo $form->textField($model,'current_input3'); ?>
		<?php echo $form->error($model,'current_input3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'current_input4'); ?>
		<?php echo $form->textField($model,'current_input4'); ?>
		<?php echo $form->error($model,'current_input4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'battery'); ?>
		<?php echo $form->textField($model,'battery'); ?>
		<?php echo $form->error($model,'battery'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sampling_interval'); ?>
		<?php echo $form->textField($model,'sampling_interval'); ?>
		<?php echo $form->error($model,'sampling_interval'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'testing_time'); ?>
		<?php echo $form->textArea($model,'testing_time',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'testing_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'property'); ?>
		<?php echo $form->textField($model,'property',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'property'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'collected'); ?>
		<?php echo $form->textField($model,'collected'); ?>
		<?php echo $form->error($model,'collected'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->