<?php
/* @var $this SolicitudCompraController */
/* @var $model SolicitudCompra */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'solicitud-compra-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_alta'); ?>
		<?php echo $form->textField($model,'fecha_alta'); ?>
		<?php echo $form->error($model,'fecha_alta'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usuario_solicitante'); ?>
		<?php echo $form->textField($model,'usuario_solicitante'); ?>
		<?php echo $form->error($model,'usuario_solicitante'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'codigo_solicitud'); ?>
		<?php echo $form->textField($model,'codigo_solicitud',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'codigo_solicitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->textField($model,'estado',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_compra_id'); ?>
		<?php echo $form->textField($model,'tipo_compra_id'); ?>
		<?php echo $form->error($model,'tipo_compra_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proveedor_id'); ?>
		<?php echo $form->textField($model,'proveedor_id'); ?>
		<?php echo $form->error($model,'proveedor_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->