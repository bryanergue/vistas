


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



 <?php
         
            //echo CHtml::dropDownList('idProd');
            
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name'=>'estado',                                             
            //'model'=>$model,                                             
            'value'=>$value,
            'source'=>$this->createUrl('buscarProduct',array('idProv'=>$model->idProv)),     
            'options'=>array(
                'minLength'=>'2',                            
                'showAnim'=>'fold',                          
                      'select' => 'js:function(model, ui)
                      {
                        $("#idProduct").val(ui.item.id);
                      }'              
                ),
                'htmlOptions'=>array(
                    'style'=>'height:20px;',
                    'size'=>80,
                    'id'=>'idProduct',
                    //'value'=>'proveedor',
                    'placeholder'=>'Buscador de productos'
                    ),
                ));
            
            
        ?>





 <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name'=>'estado',                                             
            'model'=>$model,                                             
            'value'=>$value,
            'source'=>$this->createUrl('buscarProduct',array('idProv'=>$model->idProv)),
            //'sourceUrl'=>$this->createUrl('producto/buscarProduct'),       
            'options'=>array(
                'minLength'=>'2',                            
                'showAnim'=>'fold',                          
                      'select' => 'js:function(model, ui)
                      {
                        $("#idProduct").val(ui.item.id);
                      }'              
                ),
                'htmlOptions'=>array(
                    'style'=>'height:20px;',
                    'size'=>80,
                    'id'=>'idProduct',
                    //'value'=>'proveedor',
                    'placeholder'=>'Buscador de productos'
                    ),
                ));
            
            
        ?>