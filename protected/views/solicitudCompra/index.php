<?php
/* @var $this SolicitudCompraController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Solicitud Compras',
);

$this->menu=array(
	array('label'=>'Create SolicitudCompra', 'url'=>array('create')),
	array('label'=>'Manage SolicitudCompra', 'url'=>array('admin')),
);
?>

<h1>Solicitud Compras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
