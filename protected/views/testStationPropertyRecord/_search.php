<?php
/* @var $this TestStationPropertyRecordController */
/* @var $model TestStationPropertyRecord */
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
		<?php echo $form->label($model,'pipe_segment_id'); ?>
		<?php echo $form->textField($model,'pipe_segment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pipe_stage_id'); ?>
		<?php echo $form->textField($model,'pipe_stage_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'protect_object'); ?>
		<?php echo $form->textField($model,'protect_object',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'teststation_type'); ?>
		<?php echo $form->textField($model,'teststation_type',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'specification'); ?>
		<?php echo $form->textField($model,'specification',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'teststation_num'); ?>
		<?php echo $form->textField($model,'teststation_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gps'); ?>
		<?php echo $form->textField($model,'gps',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location_des'); ?>
		<?php echo $form->textArea($model,'location_des',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'orographic'); ?>
		<?php echo $form->textField($model,'orographic',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'administation'); ?>
		<?php echo $form->textField($model,'administation',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'material'); ?>
		<?php echo $form->textField($model,'material',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'picture'); ?>
		<?php echo $form->textField($model,'picture'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'output_number'); ?>
		<?php echo $form->textField($model,'output_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sampling_interval_begin'); ?>
		<?php echo $form->textField($model,'sampling_interval_begin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'munufactuter'); ?>
		<?php echo $form->textField($model,'munufactuter',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'install_date'); ?>
		<?php echo $form->textField($model,'install_date',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mannagement_unit'); ?>
		<?php echo $form->textField($model,'mannagement_unit',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'icon_show'); ?>
		<?php echo $form->textField($model,'icon_show'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->