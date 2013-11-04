
  <?php
   $this->breadcrumbs=array(
    'Transacciones',
);

         $relacionados=array();
        if (Yii::app()->user->checkAccess("action_personal_personal"))
        {$relacionados[]= array('label'=>'Costo Indirecto de Producto', 'url'=>array('/detalleIndirecto/indirecto',array('idTipoNegocio'=>'2')));}
        if (Yii::app()->user->checkAccess("action_materiaPrima_create"))
        {$relacionados[]= array('label'=>'Costo Total', 'url'=>array('/calculo/costoTotalComercio'));}
        
    $this->menu=$relacionados;
?>   
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/cotizaciones.js"></script>

 
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
            
               var URLnuevo= "<?php echo Yii::app()->createUrl('compra/registrar');?>";
               var URLredireccion = "<?php echo Yii::app()->createUrl('compra/create');?>";
               var URLgetInfo = "<?php echo Yii::app()->createUrl('cotizacion/getNumero');?>";
               var URLcrear = "<?php echo Yii::app()->createUrl('cotizacion/registrar');?>";
               var URLredireccion = "<?php echo Yii::app()->createUrl('cotizacion/nuevo');?>";
            
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
                <li><a href="#tabs-1">NUEVA COTIZACION</a></li>
            </ul>
                
            <div id="stylized" >
                   
                   
                   <div id="datosSol">
                                                       
                                    <?php
                                    // $client=new SoapClient('http://localhost/vistas/index.php/solicitudes/nueva'); 
                                    // echo $client->create('2013-05-29 00:00:00','1','1','si','1','1');
                                    ?>
                                    <input value="<?php echo $cotizacion->id;?>" name"id" id="id" type="hidden" />
                                 <div class="field bigF">
                                    <label>Fecha:</label>
                                    <input value="<?php echo $cotizacion->fecha_alta; ?>" style="text-align: right" name="fecha" id="fecha" type="text" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>    
                                    
                                <div class="field bigF">
                                    <label>Numero de cotizacion:</label>
                                    <input value="<?php echo $cotizacion->nro_cotizacion; ?>" style="text-align: right" name="numCotizacion" id="numCotizacion" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                <div class="field bigF">
                                    <label>Solicitud de compra:</label>
                                    <input value="<?php echo $cotizacion->solicitudCompra->codigo_solicitud; ?>" style="text-align: right" name="numCotizacion" id="numCotizacion" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                <div class="field bigF">
                                    <label>Proveedor:</label>
                                    <input value="<?php echo $cotizacion->proveedor->nombre; ?>" style="text-align: right" name="numCotizacion" id="numCotizacion" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                 
                          
                                   
                  </div>
                  
                  <div id="productos">
                                <?php $this->widget('zii.widgets.grid.CGridView', array(
                                                        'id'=>'solicitud-compra-grid',
                                                        'dataProvider'=>$model->searchProductos($cotizacion->solicitud_compra_id),
                                                        'columns'=>array(
                                                            
                                                            array(
                                                                    'class'=>'CDataColumn',
                                                                    'header' => "Producto",
                                                                    'name'=>'producto',
                                                                    'value'=>'$data->producto->descripcion',
                                                                    'htmlOptions'=>array('style'=>'text-align: left;') 
                                                            ),
                                                            array(
                                                                    'class'=>'CDataColumn',
                                                                    'header' => "Codigo",
                                                                    'name'=>'Codigo',
                                                                    'value'=>'$data->producto->codigo',
                                                                    'htmlOptions'=>array('style'=>'text-align: left;') 
                                                            ),
                                                            
                                                            /*
                                                            array(
                                                                    'class'=>'CDataColumn',
                                                                    'header' => "Cantidad",
                                                                    'name'=>'cantidad',
                                                                    'type'=>'html', 
                                                                
                                                                    'footer'=>'',
                                                                    'footerHtmlOptions'=>array('id'=>'footerCantidad','style' => 'text-align: right;font-weight: 400;font-size: 2ex;'), 
                                                                'value' => 'CHtml::label($data->cantidad,false,array("class"=>"cantidades"))', 
                                                                'htmlOptions'=>array('style' => 'text-align: right;',"width"=>"50px",'class'=>'cantidades','value'=>'0'),  
                                                            ),
                                                            
                                                            array(
                                                            'name' => 'precio_compra',
                                                            'header' => "Precio unitario",
                                                            'type'=>'raw',         
                                                            'value'=>'CHtml::textField("precio_compra[]"," ",array("style"=>"width:90px;text-align: right","maxlength"=>"11", "class"=>"precios","id"=>$data->producto->id, "onKeyPress"=>"return expRegular(event)", ))',  
                                                            'htmlOptions'=>array("width"=>"50px",'class'=>'precio_compra',),
                                                            ),
                                                            
                                                              array(        
                                                                'header' => "Total",
                                                                'name'=>'total',
                                                                'type'=>'html',         
                                                                'value' => 'CHtml::label($data->producto->id ,false,array("class"=>"totales5"))', 
                                                                'htmlOptions'=>array('style' => 'text-align: right;',"width"=>"50px",'class'=>'totales','value'=>'0'),  
                                                            ),  
                                                             */
                                                             
                                                             array(
                                    'name' => 'precio_compra',
                                    'header' => "Precio de compra",
                                    'type'=>'raw',         
                                    'value'=>'CHtml::textField("precio_compra[]",$data->precio,array("style"=>"width:90px;text-align: right","maxlength"=>"11", "class"=>"precio","id"=>$data->producto->id, "onKeyPress"=>"return expRegular(event)", ))',  
                                    'htmlOptions'=>array("width"=>"50px",'class'=>'precio_compra',),
                                    ),
                                    
                                    array(
                                    'name' => 'cantidad',
                                    'header' => "Cantidad",
                                    'sortable'=>true,
                                    'type'=>'raw',
                                    'footer'=>'TOTAL:',
                                    'footerHtmlOptions'=>array('id'=>'footer','style' => 'text-align: right;font-weight: 400;font-size: 2ex;'), 
                                    'value' => 'CHtml::label($data->cantidad,false,array("class"=>"cant"))', 
                                                                        
                                    //'value'=>'CHtml::textField("cantidad[]",$data->cantidad,array("style"=>"width:90px;text-align: right","maxlength"=>"11", "class"=>"cant","id"=>$data->producto->id, "onKeyPress"=>"return expRegular(event)", ))',  
                                    'htmlOptions'=>array("width"=>"50px",'class'=>'cantidad',),
                                    ),
                                      
                                    array(        
                                    'header' => "Total",
                                    'name'=>'total',
                                    'type'=>'html',
                                    'footer'=>'',
                                    'footerHtmlOptions'=>array('id'=>'footerTotal','style' => 'text-align: right;font-weight: 400;font-size: 2ex;'), 
                                    'value' => 'CHtml::label($data->precio * $data->cantidad,false,array("class"=>"total"))', 
                                    'htmlOptions'=>array('style' => 'text-align: right;',"width"=>"50px",'class'=>'total','value'=>'0'),  
                                    ),  
                                                  
                                                        ),
                                                    )); 
                                                    ?>
                             </div>
                 <input class="button" id='btnCrear' name="btnCrear" type="button" value="Crear Cotizacion" />
                 
        </div>
       </div>
    </body>
</html> 



