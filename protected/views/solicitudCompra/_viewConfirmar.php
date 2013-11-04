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
              var URLconfirmar = "<?php echo Yii::app()->createUrl('solicitudcompra/confimarSolicitud');?>";
              var URLredireccion = "<?php echo Yii::app()->createUrl('solicitudcompra/confirmar');?>";
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
                <li><a href="#tabs-1">DETALLE DE LA SOLICITUD</a></li>
                
            </ul>
            
            
                
            <div id="stylized">
                
                            <div id="datosSol">
                                                       
                                    <?php
                                    // $client=new SoapClient('http://localhost/vistas/index.php/solicitudes/nueva'); 
                                    // echo $client->create('2013-05-29 00:00:00','1','1','si','1','1');
                                    ?>
                                                                 
                                <div class="field bigF">
                                    <label>Fecha de solicitud:</label>
                                    <input value="<?php echo $data->fecha_alta; ?>" style="text-align: right" name="saldoCuenta" id="saldoCuenta" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                <div class="field bigF">
                                    <label>Usuario Solicitante:</label>
                                    <input value="<?php echo $data->usuario_solicitante;?>" style="text-align: right" name="saldoCuenta" id="saldoCuenta" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                <div class="field bigF">
                                    <label>Codigo de Solicitud:</label>
                                    <input value="<?php echo $data->codigo_solicitud; ?>" style="text-align: right" name="saldoCuenta" id="saldoCuenta" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                <div class="field bigF">
                                    <label>Estado:</label>
                                    <input value="<?php echo $data->estado; ?>" style="text-align: right" name="saldoCuenta" id="saldoCuenta" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
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
                                                            'name' => 'precio_compra',
                                                            'header' => "Precio unitario",
                                                            'type'=>'raw',         
                                                            'value'=>'CHtml::textField("precio_compra[]"," ",array("style"=>"width:90px;text-align: right","maxlength"=>"11", "class"=>"precio","id"=>$data->producto->id, "onKeyPress"=>"return soloNumeros(event)", ))',  
                                                            'htmlOptions'=>array("width"=>"50px",'class'=>'precio_compra',),
                                                            ),
                                                            
                                                              array(        
                                                                'header' => "Total",
                                                                'name'=>'total',
                                                                'type'=>'html',         
                                                                'value' => 'CHtml::label(" ",false,array("class"=>"total"))', 
                                                                'htmlOptions'=>array('style' => 'text-align: right;',"width"=>"50px",'class'=>'total','value'=>'0'),  
                                                            ),  
                                                            
                                                            /*
                                                            'proveedor_id',
                                                            */

                                                        ),
                                                    )); ?>
                             </div>
                       
                            <input class="button" id='btnConfirmar' name="btnConfirmar" type="button" value="Confirmar Solicitud" />
                   
            </div>
        </div>
    </body>
</html> 

