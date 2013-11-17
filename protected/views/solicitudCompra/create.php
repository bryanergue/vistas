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
               var URLcrear = "<?php echo Yii::app()->createUrl('cotizacion/add');?>";
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
                <li><a href="#tabs-1">NUEVA SOLICITUD</a></li>
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
                                    <label>Numero de solicitud:</label>
                                    <input value="" style="text-align: right" name="numSolicitud" id="numSolicitud" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                <div class="field bigF">
                                    <label>Solicitante:</label>
                                    <input value="1" style="text-align: right" name="solicitante" id="solicitante" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                <div class="field bigF">
                                    <label>Codigo de la solicitud:</label>
                                    <input value="" style="text-align: right" name="codSolicitud" id="codSolicitud" type="text" class="hastip" title="Saldo de la cuenta seleccionada" >
                                </div>
                                
                                <div class="field bigF">
                                    <label>Estado:</label>
                                    <input value="borrador" style="text-align: right" name="estado" id="estado" type="text" class="hastip" title="Saldo de la cuenta seleccionada" disabled="disabled">
                                </div>
                                
                                
                                <div class="field bigF">
                                    <label>Tipo de solicitud:</label>
                                    <select id="tipoSolicitud">
                                          <option value="1">Directa</option>
                                          <option value="2">Licitacion</option>
                                          
                                    </select>
                                </div>
                                
                                <div class="field bigF">
                                    <label>Proveedor:</label>
                                    <select id="proveedor">
                                        <?php
                                        foreach($proveedores as $pro)
                                           echo "<option value=".$pro->id.">".$pro->nombre."</option>";
                                        ?> 
                                    </select>
                                </div>
                                
                                 <div id="form3" class="form-horiz">
                    <table width="100%" id="tblDetalle" class="listado" border="2" >
                        <thead>
                        <tr>
                        <th>Codigo</th>
                        <th>Nombre Producto</th>
                        <th>Cantidad</th>
                        <th>Accion</th>
                        </tr>
                        </thead>
                        <tbody id="tbDetalle" >
                        </tbody>
                    </table>
                </div>
                          
                   <input class="button" id='btnNuevo' name="btnNuevo" type="button" value="Crear Solicitud" />
                                           
            </div>
        </div>
       </div>
    </body>
</html> 

