<?php
/* @var $this TStudentsController */
/* @var $model TStudents */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tstudents-student-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code'); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->textField($model,'sex'); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'class_id'); ?>
		<?php echo $form->textField($model,'class_id'); ?>
		<?php echo $form->error($model,'class_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
		<?php echo $form->error($model,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'senior_score'); ?>
		<?php echo $form->textField($model,'senior_score'); ?>
		<?php echo $form->error($model,'senior_score'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_year'); ?>
		<?php echo $form->textField($model,'school_year'); ?>
		<?php echo $form->error($model,'school_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'college_score'); ?>
		<?php echo $form->textField($model,'college_score'); ?>
		<?php echo $form->error($model,'college_score'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_card_no'); ?>
		<?php echo $form->textField($model,'id_card_no'); ?>
		<?php echo $form->error($model,'id_card_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'old_class_id'); ?>
		<?php echo $form->textField($model,'old_class_id'); ?>
		<?php echo $form->error($model,'old_class_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_user'); ?>
		<?php echo $form->textField($model,'create_user'); ?>
		<?php echo $form->error($model,'create_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_user'); ?>
		<?php echo $form->textField($model,'update_user'); ?>
		<?php echo $form->error($model,'update_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'accommodation'); ?>
		<?php echo $form->textField($model,'accommodation'); ?>
		<?php echo $form->error($model,'accommodation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment1'); ?>
		<?php echo $form->textField($model,'payment1'); ?>
		<?php echo $form->error($model,'payment1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment2'); ?>
		<?php echo $form->textField($model,'payment2'); ?>
		<?php echo $form->error($model,'payment2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment3'); ?>
		<?php echo $form->textField($model,'payment3'); ?>
		<?php echo $form->error($model,'payment3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment4'); ?>
		<?php echo $form->textField($model,'payment4'); ?>
		<?php echo $form->error($model,'payment4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment5'); ?>
		<?php echo $form->textField($model,'payment5'); ?>
		<?php echo $form->error($model,'payment5'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment6'); ?>
		<?php echo $form->textField($model,'payment6'); ?>
		<?php echo $form->error($model,'payment6'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bonus_penalty'); ?>
		<?php echo $form->textField($model,'bonus_penalty'); ?>
		<?php echo $form->error($model,'bonus_penalty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_of_graduation'); ?>
		<?php echo $form->textField($model,'school_of_graduation'); ?>
		<?php echo $form->error($model,'school_of_graduation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address'); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'university'); ?>
		<?php echo $form->textField($model,'university'); ?>
		<?php echo $form->error($model,'university'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parents_tel'); ?>
		<?php echo $form->textField($model,'parents_tel'); ?>
		<?php echo $form->error($model,'parents_tel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parents_qq'); ?>
		<?php echo $form->textField($model,'parents_qq'); ?>
		<?php echo $form->error($model,'parents_qq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday'); ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment'); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->