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
                <li><a href="#tabs-1">LISTADO DE SOLICITUDES</a></li>
                
            </ul>
            
            
                
            <div id="stylized">
                
                       <?php $this->widget('zii.widgets.grid.CGridView', array(
                            'id'=>'solicitud-compra-grid',
                            'dataProvider'=>$model->searchBorradores(),
                            'columns'=>array(
                                //'id',                                       
                                'fecha_alta',
                                
                                
                                /*
                                array(
                                        'class'=>'CDataColumn',
                                        'header' => "Usuario Solicitante",
                                        'name'=>'usuario',
                                        'value'=>'$data->usuarioSolicitante->username',
                                        'htmlOptions'=>array('style'=>'text-align: left;') 
                                ),
                                */
                                //'codigo_solicitud',
                                'estado',
                                array(
                                        'class'=>'CDataColumn',
                                        'header' => "Tipo de compra",
                                        'name'=>'tipo',
                                        'value'=>'$data->tipoCompra->tipo',
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
                                                     'url'=>'Yii::app()->createUrl("solicitudCompra/view",array("id"=>$data->id))',
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

