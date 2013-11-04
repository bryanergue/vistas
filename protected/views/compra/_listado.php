<?php
   $this->breadcrumbs=array(
    'Transacciones',
);
?>

<?php
    $relacionados=array();
        if (Yii::app()->user->checkAccess("action_personal_personal"))
        {$relacionados[]= array('label'=>'Costo Indirecto de Producto', 'url'=>array('/detalleIndirecto/indirecto',array('idTipoNegocio'=>'2')));}
        if (Yii::app()->user->checkAccess("action_materiaPrima_create"))
        {$relacionados[]= array('label'=>'Costo Total', 'url'=>array('/calculo/costoTotalComercio'));}
        
    $this->menu=$relacionados;
?>   
 
<html>

    <head>
        <meta charset="utf-8" />
        
           <script type="text/javascript">
            //funcion para la creacion de las tabs
            $(function()
                {
                    $( "#tabs" ).tabs();
                    
                }
            );
           </script>
           
            <script type="text/javascript" >
             var URLgetsaldo= "<?php echo Yii::app()->createUrl('transaccion/getSaldo');?>";
              var URLregistrar= "<?php echo Yii::app()->createUrl('transaccion/insert');?>";
              
            </script>
            
           <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
     
         
            
    </head>


    <body>
       
         <?php if(Yii::app()->user->hasFlash('success')):?>
            <div class="flash-success">
                <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
         <?php endif; ?>

          <?php if(Yii::app()->user->hasFlash('error')):?>
            <div class="flash-error">
                <?php echo Yii::app()->user->getFlash('error'); ?>
            </div>
         <?php endif; ?>
         
        <div id="tabs" class="shadowtabs ui-tabs-collapsible" >
            <ul>
                <li><a href="#tabs-1">LISTADO DE ORDENES DE COMPRA</a></li>
                
            </ul>
                
            <div id="stylized">
                
                       <?php $this->widget('zii.widgets.grid.CGridView', array(
                            'id'=>'solicitud-compra-grid',
                            'dataProvider'=>$model->searchCompras(),
                            'columns'=>array(
                                //'id',                                       
                              
                                array(
                                        'class'=>'CDataColumn',
                                        'header' => "Fecha",
                                        'name'=>'tipo',
                                        'value'=>'$data->fecha',
                                        'htmlOptions'=>array('style'=>'text-align: left;') 
                                ),
                                
                                 array(
                                        'class'=>'CDataColumn',
                                        'header' => "Numero de compra",
                                        'name'=>'numero_compra',
                                        'value'=>'$data->numero_compra',
                                        'htmlOptions'=>array('style'=>'text-align: left;') 
                                ),
                                
                                 array(
                                        'class'=>'CDataColumn',
                                        'header' => "Estado",
                                        'name'=>'estado',
                                        'value'=>'$data->estado',
                                        'htmlOptions'=>array('style'=>'text-align: left;') 
                                ),
                                
                                 array(
                                        'class'=>'CDataColumn',
                                        'header' => "Numero de factura",
                                        'name'=>'nro_factura',
                                        'value'=>'$data->nro_factura',
                                        'htmlOptions'=>array('style'=>'text-align: left;') 
                                ),
                                
                                /*
                                array(
                                        'class'=>'CDataColumn',
                                        'header' => "Proveedor",
                                        'name'=>'proveedor',
                                        'type'=>'html',
                                        'value'=>'( strval($data->proveedor_id) == "")?" ":"$data->proveedors->id"',
                                        'value'=>array($this,'gridDataColumn'), //metodo del controlador
                                        'htmlOptions'=>array('style'=>'text-align: left;') 
                                ),
                                   */
                                
                                array(
                                        'class'=>'CButtonColumn',
                                        'template'=>'{editar} ',
                                        'buttons'=>array
                                        (           
                                        'editar' => array(
                                                    'label'=>"Ver Detalle",
                                                     'url'=>'Yii::app()->createUrl("compra/view",array("id"=>$data->id))',
                                                    ),
                                                    /* 
                                        'delete' => array(
                                                    'label'=>"Eliminar",
                                                     'url'=>'Yii::app()->createUrl("cliente/delete")',
                                                     'imageUrl'=>false,
                                                    ), 
                                                    */
                                                ),
                                    ),
                            ),
                        )); ?>
                                           
                    
            </div>
        </div>
    </body>
</html> 

