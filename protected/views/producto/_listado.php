<!doctype html>
 
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Solicitud de existencias</title>
    <script>
      
      var $tabs;
      var $prove = "";
        
    $(function() {
        
        
        
        $( "#tabs" ).tabs({disabled: [0,1]});
        //$( "#tabs" ).tabs();
        $tabs = $('#tabs').tabs();
        $('#frmSolicitar').submit(detalle);
        //$('#frmSolicitar').submit(detalle);
    });
    
    function detalle(event) {  
        if(!$('#idProvee').val()) {  
          alert('Por favor, introduzca el proveedor');  
          event.preventDefault();  
        }
        else{
            $("#tabs").tabs({disabled: false });
            $tabs.tabs('select', 1);
            //$('#tabs-2').focus();
            $prove=$("#idInputTipoHidden").val();
            //alert($prove);
        }
        return false;
    }
    
    
    
    
      
    </script>
</head>
<body>
 
<form id="frmSolicitar" method="post">
<div id="tabs" >
    <ul>
        <li><a href="#tabs-1">Informacion de la solicitud</a></li>
        <li><a href="#tabs-2">Detalle de existencias solicitadas</a></li>
    </ul>
    <div id="tabs-1">
        <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name'=>'estado',                                             
            'model'=>$model,                                             
            'value'=>$value,                                              
            'sourceUrl'=>$this->createUrl('buscar'),       
            'options'=>array(
                'minLength'=>'2',                            
                'showAnim'=>'fold',                          
                      'select' => 'js:function(model, ui)
                      {
                        $("#idInputTipoHidden").val(ui.item.d)
                        $("#idProvee").val(ui.item.id);
                      }'              
                ),
                'htmlOptions'=>array(
                    'style'=>'height:20px;',
                    'size'=>80,
                    'id'=>'idProvee',
                    //'value'=>'proveedor',
                    'placeholder'=>'Proveedor (Buscador de proveedor)'
                    ),
                ));
        ?>
        <br>
        
        <input type="text" name="nroPedido" size=37 placeholder="Nro pedido" disabled=""/>
        <input type="text" name="referencia" size=37 placeholder="Referencia" />
        <input type="submit" value="Guardar"/> 
        
        <input id="idInputTipoHidden" type="hidden">
        
    </div>
    <div id="tabs-2">
        
        <?php 
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name'=>'estado',                                             
            'model'=>$model,                                             
            'value'=>$value,                                              
            'sourceUrl'=>$this->createUrl('buscarProduct'),       
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
                    'size'=>100,
                    'id'=>'idProduct',
                    //'value'=>'proveedor',
                    'placeholder'=>'Buscador de productos'
                    ),
                ));
        ?>
        
        
        
        
        
        <!-- <input type="text" name="busProd" size=80 placeholder="Buscador de Productos" /> -->
        
        <br>
            
            
        <input type="text" name="cant" size=20 placeholder="Cantidad" />
        <input type="text" name="precio" size=20 placeholder="Precio x Unidad" />
        <input type="text" name="total" size=20 placeholder="Total" />
        <input type="submit" value="OK" align="center" />
        <br><br>
        <input type="submit" value="Solicitar" align="center" />
    </div>
    
    <!--<input type="text" disabled="">-->
    
</div>
 
 
</body>
</html>












