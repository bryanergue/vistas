<?php
/* @var $this SolicitudCompraController */
/* @var $model SolicitudCompra */

$this->breadcrumbs=array(
	'Solicitud Compras'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SolicitudCompra', 'url'=>array('index')),
	array('label'=>'Manage SolicitudCompra', 'url'=>array('admin')),
);
?>

<h1>Create SolicitudCompra</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>