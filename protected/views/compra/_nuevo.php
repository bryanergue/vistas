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
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/compras.js"></script>

 
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
                <li><a href="#tabs-1"> NUEVA ORDEN DE COMPRA</a></li>
            </ul>
                
            <div id="stylized" >
                   
                   
                            <div id="datosSol">
                                                       
                                    <?php
                                    // $client=new SoapClient('http://localhost/vistas/index.php/solicitudes/nueva'); 
                                    // echo $client->create('2013-05-29 00:00:00','1','1','si','1','1');
                                    ?>
                                 <div class="field bigF">
                                    <label>Fecha:</label>
                                    <input value="<?php echo date('Y/m/d'); ?>" style="text-align: right" name="fecha" id="fecha" type="text" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>    
                                    
                                <div class="field bigF">
                                    <label>Numero de orden:</label>
                                    <input value="<?php echo $numero; ?>" style="text-align: right" name="numero" id="numero" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                <div class="field bigF">
                                    <label>Numero de factura:</label>
                                    <input value="" style="text-align: right" name="numFactura" id="numFactura" type="text" class="hastip" title="Saldo de la cuenta seleccionada" >
                                </div>
                                
                                <div class="field bigF">
                                    <label>Codigo de Solicitud:</label>
                                    <input value="<?php echo $data->codigo_solicitud; ?>" style="text-align: right" name="saldoCuenta" id="saldoCuenta" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                <div class="field bigF">
                                    <label>Tipo de compra:</label>
                                    <input value="<?php echo $data->tipoCompra->tipo; ?>" style="text-align: right" name="saldoCuenta" id="saldoCuenta" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                     <input value="<?php echo $data->id; ?>" name="idSolicitud" id="idSolicitud" type="hidden" >
                                
                                <?php if($data->proveedor_id != NULL):?>
                                    <div class="field bigF">
                                        <label>Proveedor:</label>
                                        <span>
                                            <input value="<?php echo $data->proveedors->nombre; ?>" style="text-align: right" name="proveedor" id="proveedor" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                               
                                        </span>
                                    </div>
                                <?php else:?>
                                     <div class="field bigF">
                                        <label>Proveedor:</label>
                                            <?php
                                                echo'<select id="proveedor">'; 
                                                foreach($proveedores as $p){ 
                                                    echo'<option value="'.$p->id.'">'.$p->nombre.'</option>'; 
                                                } 
                                                echo'</select>'; 
                                            ?>
                                    </div>
                                <?php endif; ?> 
                             </div>
                             
                             
                                         
                            <div id="productos">
                                <?php $this->widget('zii.widgets.grid.CGridView', array(
                                                        'id'=>'solicitud-compra-grid',
                                                        'dataProvider'=>$model->searchProductos($data->id),
                                                        'columns'=>array(
                                                            //'id',
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
                                                            
                                                            array(
                                                                    'class'=>'CDataColumn',
                                                                    'header' => "Codigo",
                                                                    'name'=>'Codigo',
                                                                    'value'=>'$data->producto->codigo',
                                                                    'htmlOptions'=>array('style'=>'text-align: left;') 
                                                            ),
                                                            
                                                            array(
                                                                    'class'=>'CDataColumn',
                                                                    'header' => "Producto",
                                                                    'name'=>'producto',
                                                                    'footer'=>'TOTAL',
                                                                    'footerHtmlOptions'=>array('id'=>'footerTitle','style' => 'text-align: right;font-weight: 400;font-size: 2ex;'), 
                                                                
                                                                    'value'=>'$data->producto->descripcion',
                                                                    'htmlOptions'=>array('style'=>'text-align: left;') 
                                                            ),
                                                            
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
                                                                    'class'=>'CDataColumn',
                                                                    'header' => "Precio",
                                                                    'name'=>'precio',
                                                                    'type'=>'html', 
                                                                
                                                                    'footer'=>'',
                                                                    'footerHtmlOptions'=>array('id'=>'footerPrecio','style' => 'text-align: right;font-weight: 400;font-size: 2ex;'), 
                                                                'value' => 'CHtml::label($data->precio ,false,array("class"=>"precios"))', 
                                                                'htmlOptions'=>array('style' => 'text-align: right;',"width"=>"50px",'class'=>'precios','value'=>'0'),  
                                                            ),
                                                            
                                                            
                                                            
                                                            array(        
                                                                'header' => "Total",
                                                                'name'=>'total',
                                                                'type'=>'html', 
                                                                'footer'=>'',
                                                                'footerHtmlOptions'=>array('id'=>'footerTotal','style' => 'text-align: right;font-weight: 400;font-size: 2ex;'), 
                                                                'value' => 'CHtml::label($data->precio * $data->cantidad,false,array("class"=>"totales"))', 
                                                                'htmlOptions'=>array('style' => 'text-align: right;',"width"=>"50px",'class'=>'totales','value'=>'0'),  
                                                            ),  
                                                                                    
                                                            /*
                                                            'proveedor_id',
                                                            */

                                                        ),
                                                    )); ?>
                             
                             </div>
                          
                   <input class="button" id='btnNuevo' name="btnNuevo" type="button" value="Crear orden de compra" />
                                           
            </div>
        </div>

    </body>
</html> 

