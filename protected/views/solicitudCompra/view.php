

<h1>Detalles  Solicitud de Compra #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha_alta',
		'usuario_solicitante',
		'codigo_solicitud',
		'estado',
		'tipo_compra_id',
		'proveedor_id',
	),
)); ?>
