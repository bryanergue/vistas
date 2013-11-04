<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('proveedor-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'proveedor-grid',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'codigo', 
		'descripcion',
		
        
    ),
)); ?>