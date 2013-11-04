<!doctype html>
 
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Solicitud de existencias</title> 
    
    <script>
      
      
        // VARIABLE PARA EL MANEJO DE TAB  
        var $tabs;
        
        // VARIABLE PARA PROVEEDOR 
        var $prove = "";
        var cant = "";
        var precio = "";
        var resultado ="";
        
        // VARIABLES PARA EL PRODUCTO
        var codigo;
        var existencias;
        
    $(function() {
        
        //DESHABILITAR LA PRIMERA SOLAPA AL CARGAR
    
        $( "#tabs" ).tabs({disabled: [0,1]});
        
        //ALMACENAR EL TAB SELECCIONADO EN LA VARIABLE
        
        $tabs = $('#tabs').tabs();
        
        // BOTON SUBMIT, ENVIAR A FUNCION DETALLE
        
        $('#frmSolicitar').submit(detalle);
        
        // ALMACENAR EL VALOR DEL ID DEL HIDDEN IDPROV 
        
        var idprov = $("#idProv").val();
        
       
        
        // AUTOCOMPLETE PARA EL BUSCADOR DE RPODUCTOS 
        
        $("#product").autocomplete({
            source: function(request, response) {          
                
                $.ajax({
                    url: "index.php?r=proveedor/buscarProduct",
                    dataType: "json",
                    data: {
                        term : request.term,
                        id : $("#idProv").val()
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            
            // ASIGNAR VALORES AL CAMPO PRECIO DEL PRODUCTO,ASIGNAR VALOR CANT =1 
            
            select: function(event, ui) {
                
                        //ASIGNAMOS VALORES A LOS HIDDEN
                        
                        $('#precio').val(ui.item.precio_venta);
                        $('#codigo').val(ui.item.codigo);
                        $('#existencias').val(ui.item.existen);
                        $('#cant').val("1");
                        
                        
                        // CALCULO DEL TOTAL
                        
                        cant = $("#cant").val();
                        precio = $("#precio").val();
                        resultado = parseFloat(cant) * parseFloat(precio);
                        $('#total').val(resultado);
                    },
            min_length: 1,
            delay:100
        });
        
        // VALIDAR NUMEROS
        
        jQuery("#cant").keyup(function () {
            this.value = this.value.replace(/[^0-9]/g,'');
        });
        
        // CALCULO PARA UN NUEVO EN EL INPUT CANTIDAD, CAMBIO EN EL TOTAL
        
        $("#cant").keyup(function(){
            cant = $("#cant").val();
            precio = $("#precio").val();
            resultado = parseFloat(cant) * parseFloat(precio);
            $('#total').val(resultado);
            
            
        });
        
        

    });
    
    
    //
    // FUNCIONES AL CARGAR EL DOCUMENTO
    //
    
    $(document).ready(function() {  
        $.get('index.php?r=solicitudIngresoExistencia/contar',function(data){
                $("#nroPedido").val(data);
            })
    }); 
    
    
    
    // FUNCION PARA CAMBIAR DE TAB-2
    
    function detalle(event) {
        
        // PREGUNTAMOS SI EL CAMPO IDPROV SE ENCUENTRA LLENO
        
        if(!$('#idProvee').val()) {  
          alert('Por favor, introduzca el proveedor');  
          event.preventDefault();  
        }
        else{
            
            // EVIAMOS AL CONTROLADOR LOS DATOS PARA GUARDARLOS
            
	    
            
            // CONTROLADOR DEL TABS
            
            $("#tabs").tabs({disabled: false });        // HABILITAR EL TAB
            $tabs.tabs('select', 1);                    // SELECCIONA EL TAB-2
            //$('#tabs-2').focus();
            $prove=$("#idProv").val();                  // ASIGNAR EL VALOR DEL IDPROV A LA VARIABLE PROVE 
            //alert($prove);
            
            var idSolicitud=$("#nroPedido").val();
            var idProveedor=$("#idProv").val();
            //alert(idSolicitud);
            $.get('index.php?r=solicitudIngresoExistencia/add', {idProveedor:idProveedor},function(data){
                //alert(data);
                $("#idSolicitud").val(data);
                //alert($("#idSolicitud").val());
            })
            
            
            
        }
        return false;
    }
    
    
    
    
    // FUNCION PARA AGREGAR LOS PRODUCTOS
    
   function agregarFila(obj){
    
    
        var band;
    
    
        // VALIDAMOS QUE SE HAYA SELECCIONADO UN ID DE UN PRODUCTO
           var cantaux=$('#product').val() 
        if(cantaux.length==0){
            alert('Por favor, introduzca el producto');  
            event.preventDefault(); 
        }
        
        //SI SE SELECCIONO CORRECTAMENTE, GENERAMOS UNA FILA PARA EL DETALLE DEL PRODUCTO
        
        else{
            $("#cant_campos").val(parseInt($("#cant_campos").val()) + 1);
            var oId = $("#cant_campos").val();
            
            var codigo = $("#codigo").val();
            var product = $("#product").val();
            var cant = $("#cant").val();
            var precio = $("#precio").val();
            var total = $("#total").val();
            var existencias = $("#existencias").val();
            var strHtml1 = "<td>" + codigo + '<input type="hidden" id="hdnCodigo_' + oId + '" name="hdnCodigo_' + oId + '" value="' + codigo + '"/></td>';
            var strHtml2 = "<td>" + product + '<input type="hidden" id="hdnProduct_' + oId + '" name="hdnProduct_' + oId + '" value="' + product + '"/></td>';
            var strHtml3 = "<td>" + cant + '<input type="hidden" id="hdnCant_' + oId + '" name="hdnCant_' + oId + '" value="' + cant + '"/></td>' ;
            var strHtml4 = "<td>" + precio + '<input type="hidden" id="hdnPrecio_' + oId + '" name="hdnPrecio_' + oId + '" value="' + precio + '"/></td>' ;
            var strHtml5 = "<td>" + total + '<input type="hidden" id="hdnTotal_' + oId + '" name="hdnTotal_' + oId + '" value="' + total + '"/></td>' ;
            var strHtml6 = "<td>" + existencias + '<input type="hidden" id="hdnExistencias' + oId + '" name="hdnExistencias' + oId + '" value="' + existencias + '"/></td>' ;
            var strHtml7 = '<td> <a href="#" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(' + oId + ');}">Eliminar</a>  <a href="#" onclick="if(confirm(\'Realmente desea editar este detalle?\')){editarFila(' + oId + ');}"> Editar </a> </td>';
            strHtml7 += '<input type="hidden" id="hdnIdCampos_' + oId +'" name="hdnIdCampos[]" value="' + oId + '" /></td>';
           
            var strHtmlTr = "<tr id='rowDetalle_" + oId + "'></tr>";
            
            var strHtmlFinal = strHtml1 + strHtml2 + strHtml3 + strHtml4 + strHtml5 + strHtml6 + strHtml7;
            $("#tbDetalle").append(strHtmlTr);
            $("#rowDetalle_" + oId).html(strHtmlFinal);
        
          
            if (verificarFila(oId,product) == 1){
                $("#rowDetalle_" + oId).remove();
                alert("El producto ya se encuentra registrado, si desea puede editarlo");
                
            }
            else{
                 // ASIGNACION PARA LOS INPUTS DE SUMA TOTAL DE LA TABLA Y CANTIDAD
            
                $("#Ttotal").val(parseFloat($("#Ttotal").val()) + parseFloat($("#hdnTotal_"+oId).val())); // SUMA TOTAL
                $("#unid").val(parseFloat($("#unid").val()) + parseFloat($("#hdnCant_"+oId).val()));  // SUMA CANTIDAD DE PRODUCTOS
                
                // ASIGNAMOS VALORES PARA EL ENVIO, HACIA LA OPCION GUaRDAR, LOS DATOS DE CADA FILA BD(INGRESO_EXISTENCIA_ITEM)
                
                var idProducto=$("#hdnCodigo_"+oId).val();
                var idSolicitud=$("#idSolicitud").val();
                var idCantidad=$("#hdnCant_"+oId).val();
                var idTotal=$("#hdnTotal_"+oId).val();
                //alert(idSolicitud);
                $.post('index.php?r=solicitudIngresoExistencia/add2',
                      {idProducto:idProducto,idSolicitud:idSolicitud,idCantidad:idCantidad,idTotal:idTotal},function(data){
                //alert(data);
                });  
            }
            
            
            
           
            
        }
        return false;
    }
    
    // VERIFICAMOS SI LA FILA INSERTADA SE REPITE
    
    function verificarFila(oId,product){
        //alert(oId);
        var band=0;
        var aux=oId;
        var aux2=oId-1;
        //alert (aux2)
        while(aux2>0)
        {
            //alert(2);
            //alert(product+" + "+ $("#hdnProduct_"+aux2).val());
            if(product == $("#hdnProduct_"+aux2).val() && aux2!=aux){
                
                band=1;
            }
            aux2--;
        }
        //alert(band);
        return (band);
    }
    
    
    // FUNCION PARA ELIMINAR LA FILA DE LA TABLA DE PRODUCTOS
    
    function eliminarFila(oId){
        
            // RESTA DEL TOTAL EN LA TABLA
        
            $("#Ttotal").val(parseFloat($("#Ttotal").val()) - parseFloat($("#hdnTotal_"+oId).val())); // RESTA DEL TOTAL
            $("#unid").val(parseFloat($("#unid").val()) - parseFloat($("#hdnCant_"+oId).val()));  // RESTA DE LA CANTIDAD DE PRODUCTOS
            
            // ELIMINAR DE LA BASE DE DATOS
            
            var idProducto=$("#hdnCodigo_"+oId).val();
            var idSolicitud=$("#idSolicitud").val();
            $.post('index.php?r=SolicitudIngresoExistencia/del',
                  {idProducto:idProducto,idSolicitud:idSolicitud},function(data){
            });  
            
	    $("#rowDetalle_" + oId).remove();
		return false;
	}

    function cancelar(){
        $("#tbDetalle").html("");	
            return false;
    }
    
    
    
    function solicitar(){
        $("#tabs").tabs({disabled: false });        // HABILITAR EL TAB
        $tabs.tabs('select', 0);                    // SELECCIONA EL TAB-2
        $( "#tabs" ).tabs({disabled: [0,1]});
        $("#idProvee").val("");
        alert("Su solicitud, ha sido registrada");
    }
    
    
    function editarFila(oId){
        
        //ASIGNAMOS LOS VALORES DE LA FILA A ACTUALIZAR
        
        $("#product").val($("#hdnProduct_"+oId).val());
        $("#cant").val($("#hdnCant_"+oId).val());
        $("#precio").val($("#hdnPrecio_"+oId).val());
        $("#total").val($("#hdnTotal_"+oId).val());

        // RESTA TOTALES DE LA TABLA
        
        $("#Ttotal").val(parseFloat($("#Ttotal").val()) - parseFloat($("#hdnTotal_"+oId).val())); // RESTA DEL TOTAL
        $("#unid").val(parseFloat($("#unid").val()) - parseFloat($("#hdnCant_"+oId).val()));  // RESTA DE LA CANTIDAD DE PRODUCTOS
        
        // ELIMINAMOS LA FILA SELECCIONADA, PARA SER EDITADA
        
        $("#rowDetalle_" + oId).remove();
		return false;
        
    }
    
    
    
    </script>
</head>
<body>
    
    
    
 
<form id="frmSolicitar" method="POST">
    
    <input type="hidden" id="idProv" />
    <input type="hidden" id="num_campos" name="num_campos" value="0" />
    <input type="hidden" id="cant_campos" name="cant_campos" value="0" />
    <input type="hidden" id="codigo" name="codigo"  />
    <input type="hidden" id="existencias" name="existencias"  />
    <input type="hidden" id="idSolicitud" name="idSolicitud" value="0" />
    
<div id="tabs" >
    <ul>
        <li><a href="#tabs-1">Informacion de la solicitud</a></li>
        <li><a href="#tabs-2">Detalle de existencias solicitadas</a></li>
    </ul>
    <div id="tabs-1">
        
        Borrador
        <br><br>
        
        Solicitado Por ADMIN
        
        <br><br>
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
                        $("#idProv").val(ui.item.d)
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
        
        <input type="text" id="nroPedido" name="nroPedido" size=37 placeholder="Nro pedido" disabled=""/>
        <input type="text" id="referencia" name="referencia" size=37 placeholder="Referencia" />
        <input type="submit" value="Guardar"/> 
        
    </div>
    
    <div id="tabs-2">        
                
        <input type="text" id="product" size=80 placeholder="Buscador de Productos" />     

        <br><br>
 
        <input class="target" type="text" id="cant" size=20 placeholder="Cantidad"/> 
        <input type="text" id ="precio" size=20 placeholder="Buscador de Productos" disabled=""/> 
        <input type="text" id="total" size=20 placeholder="Total" disabled=""/>
        
        <input type="button" id="btnAgregar" name="btnAgregar" value="ok" class="buttons_aplicar" onclick="agregarFila(document.getElementById('cant_campos'));" />
   
        <br><br>
 
                <legend class="legend">
                    Productos
                </legend>
                <div class="clear"></div>
                <div id="form3" class="form-horiz">
                    <table width="100%" id="tblDetalle" class="listado" border="2">
                            <thead>
                                    <tr>
                                            <th>Codigo</th>
                                            <th>Descripcion</th>
                                            <th>Items</th>
                                            <th>Unitario</th>
                                            <th>Total</th>
                                            <th>Existencias</th>
                                            <th>Accion</th>
                                    </tr>
                            </thead>
                            <tbody id="tbDetalle">
                            </tbody>
                            <thead>
                                    <tr>
                                            <th>TOTAL</th>
                                            <th></th>
                                            <th><input type="text" id="unid" disabled="" size="10" value="0"/></th>
                                            <th></th>
                                            <th><input type="text" id="Ttotal" disabled="" size="10" value="0"/></th>
                                            <th></th>
                                            <th></th>
                                    </tr>
                            </thead>
                    </table>
                    
                </div>     
  
    </div>
    
</div>
 
 
</body>
</html>












