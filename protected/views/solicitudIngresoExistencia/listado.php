<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('solicitudIngresoExistencia-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'solicitudIngresoExistencia-grid',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
            'cantidad',
            'precio_compra',
            array(
            'class'=>'CDataColumn',
            'name' => 'producto.descripcion',
            'header' => "Descripcion",
            'sortable'=>true,
            'value'=>'$data->producto->descripcion',
            ),	
            ),
    
    )
);
?>