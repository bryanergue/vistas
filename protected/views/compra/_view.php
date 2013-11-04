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
 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/solicitudCompra.js"></script>
 
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
            
            $('#btnEnviar').click(function(){
               alert("lalalalla"); 
            });
           </script>
           
            <script type="text/javascript" >
              var URLagregarproveedor= "<?php echo Yii::app()->createUrl('solicitudcompra/addProveedor');?>";
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
                <li><a href="#tabs-1">DETALLE DE LA ORDEN DE COMPRA</a></li>
                
            </ul>
            
            
                
            <div id="stylized">
                
                   
                            <div id="datosSol">
                                                       
                                    <?php
                                    // $client=new SoapClient('http://localhost/vistas/index.php/solicitudes/nueva'); 
                                    // echo $client->create('2013-05-29 00:00:00','1','1','si','1','1');
                                    ?>
                                                                 
                                <div class="field bigF">
                                    <label>Fecha :</label>
                                    <input value="<?php echo $model->fecha; ?>" style="text-align: right" name="fecha" id="fecha" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                <div class="field bigF">
                                    <label>Numero de compra:</label>
                                    <input value="<?php echo $model->numero_compra;?>" style="text-align: right" name="numCompra" id="numCompra" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                <div class="field bigF">
                                    <label>Numero de factura:</label>
                                    <input value="<?php echo $model->nro_factura; ?>" style="text-align: right" name="numFactura" id="numFactura" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                <div class="field bigF">
                                    <label>Solicitud de compra relacionada:</label>
                                    <input value="<?php echo $model->solicitudCompra->codigo_solicitud; ?>" style="text-align: right" name="codigoSolicitud" id="codigoSolicitud" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                     <input value="<?php echo $model->id; ?>" name="idCompra" id="idCompra" type="hidden" >
                                
                                
                             </div>            
                             <div id="productos">
                                <?php $this->widget('zii.widgets.grid.CGridView', array(
                                                        'id'=>'solicitud-compra-grid',
                                                        'dataProvider'=>$model->searchProductosCompra($model->id),
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
                                                            array(
                                                                    'class'=>'CDataColumn',
                                                                    'header' => "Cantidad",
                                                                    'name'=>'cantidad',
                                                                    'value'=>'$data->cantidad',
                                                                    'htmlOptions'=>array('style'=>'text-align: right;') 
                                                            ),
                                                            array(
                                                                    'class'=>'CDataColumn',
                                                                    'header' => "Precio",
                                                                    'name'=>'precio',
                                                                    'value'=>'$data->precio_compra',
                                                                    'htmlOptions'=>array('style'=>'text-align: right;') 
                                                            ),
                                                            
                                                            
                                                            /*
                                                            'proveedor_id',
                                                            */

                                                        ),
                                                    )); ?>
                             </div>
                                <input class="button" id='btnEnviar' name="btnEnviar" type="button" value="Imprimir Solicitud para Proveedor" />
                       
            </div>
        </div>
    </body>
</html> 

