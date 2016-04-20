<?php
/* @var $this TestStationOperationRecordController */
/* @var $model TestStationOperationRecord */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dc_potential1'); ?>
		<?php echo $form->textField($model,'dc_potential1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ac_inter_potential1'); ?>
		<?php echo $form->textField($model,'ac_inter_potential1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dc_potential2'); ?>
		<?php echo $form->textField($model,'dc_potential2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ac_inter_potential2'); ?>
		<?php echo $form->textField($model,'ac_inter_potential2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'current_input1'); ?>
		<?php echo $form->textField($model,'current_input1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'current_input2'); ?>
		<?php echo $form->textField($model,'current_input2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'current_input3'); ?>
		<?php echo $form->textField($model,'current_input3'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'current_input4'); ?>
		<?php echo $form->textField($model,'current_input4'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'battery'); ?>
		<?php echo $form->textField($model,'battery'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sampling_interval'); ?>
		<?php echo $form->textField($model,'sampling_interval'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'testing_time'); ?>
		<?php echo $form->textArea($model,'testing_time',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'property'); ?>
		<?php echo $form->textField($model,'property',array('size'=>9,'maxlength'=>9)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'collected'); ?>
		<?php echo $form->textField($model,'collected'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->