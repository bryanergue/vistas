    /*
     *	JS SOLICITUD DE INGRESO DE EXISTENCIAS
     *
     *	@Autor: Est. Daniel Luis Herrera Santander
     *  @version 1.0.8
     *  
     *	@description: Controla el aspecto visual y el manejo de eventos del index, validacion, envio de datos
     *	a ser guardados, recepcion de datos para autocomplete
     */
    
    /*
     *
     *	DECLARACION DE VARIBLES A UTILIZAR
     *
     */
    
    // VARIABLE PARA EL MANEJO DE TAB  
    var $tabs;
    
    // VARIABLE PARA PROVEEDOR 
    var $prove = "";
    var cant = "";
    //var precio = "";
    //var resultado ="";
    var dataProveedores; 	// VARIABLE JSON
    
    
    // VARIABLES PARA EL PRODUCTO
    var codigo;
    var existencias;
    var dataProductos; 		// VARIABLE JSON

    $(function() {
    
	var idprov = "";
     
	$( "#tabs" ).tabs({disabled: [0,1]});			//DESHABILITAR LA PRIMERA SOLAPA AL CARGAR
	$tabs = $('#tabs').tabs();				//ALMACENAR EL TAB SELECCIONADO EN LA VARIABLE
	$('#frmSolicitar').submit(detalle);			 // BOTON SUBMIT, ENVIAR A FUNCION DETALLE
	idprov = $("#idProv").val();			// ALMACENAR EL VALOR DEL ID DEL HIDDEN IDPROV
	
    
    //jQuery("#btnAgregar").click(function () {
	//    alert("hola");
	//});
    
    
    
	// AUTOCOMPLETE PARA EL BUSCADOR DE RPODUCTOS 
	
	$("#product").autocomplete({
			source: function(request, response) {                  
			$.ajax({
		    type: "POST",
		    url: URLSolicitudProducto,
		    dataType: "json",
		    data: {
		       term : request.term,
		       id : $("#idProv").val()
		    },
			beforeSend: function(html) { // this happens before actual call
			$("#product").html(''); 
			$("#product").show();
			//$(".product").html(searchString);
            },
		    success: function(data) {
			dataProductos = data;
			response(data);
		    }
		});
	      },
		  
	    
	    // ASIGNAR VALORES AL CAMPO PRECIO DEL PRODUCTO,ASIGNAR VALOR CANT =1 
	    
	    select: function(event, ui) {
		
			//ASIGNAMOS VALORES A LOS HIDDEN
			$('#product').val(ui.item.descrip);
			$('#precio').val(ui.item.precio_venta);
			$('#codigo').val(ui.item.codigo);
			$('#existencias').val(ui.item.existen);
			$('#cant').val("1");
			$('#disponibles').val(ui.item.existen);
			
			
			//$('#idPrecioCompra').val(ui.item.precio_compra);
			//alert("precio compra: "+ $('#idPrecioCompra').val());
			
			// CALCULO DEL TOTAL
			
			var cant = $("#cant").val();
			var precio = $("#precio").val();
			var resultado = parseFloat(cant) * parseFloat(precio);
			$('#total').val(resultado);
			//alert(arrayProductos);
		    },
	    min_length: 2,
	    delay:100
	});
	
	
	
	/*
	 *	EVENTOS JQUERY PARA EL FORMULARIO
	 *
	 */
	
	
	
	// VALIDAR NUMEROS
	
	jQuery("#cant").keyup(function () {
	    this.value = this.value.replace(/[^0-9]/g,'');
	});
	
	// CALCULO PARA UN NUEVO EN EL INPUT CANTIDAD, CAMBIO EN EL TOTAL
	
	$("#cant").keyup(function(){
	    var cant = $("#cant").val();
	    
	    // CONTROLAMOS EL CAMPO CANTIDAD, CUANDO ÉSTE SE ENCUENTRE VACIO
	    
	    if( ($("#cant").val()=="") || ($("#codigo").val() == "") ){
		$('#total').val("0");
	    }
	    else{
		var precio = $("#precio").val();
		var resultado = parseFloat(cant) * parseFloat(precio);
		$("#total").val(resultado);
	    }
	    
	});
	
	
	// BORRAMOS INPUTS, SI EL CAMPO PRODUCTO ESTA VACIO
	
	/*$("#product").keyup(function(){
	    if($("#product").val()==""){
		$('#cant').val("1");
		$('#disponibles').val("Disponibles");
		$('#precio').val("Cantidad x Precio");
		$('#total').val("Total");
	    }
	});*/
	
	// CONTROLAMOS LA CANTIDAD DE DIGITOS PARA EL CAMPO CANTIDAD SOLICITADA
	
	$("#cant").attr("maxlength", 6);
	
	//	VERIFICAMOS SI EL PRODUCTO INGRESADO ES VALIDO, CON EL EVENTO FOCUSOAUT
	
	//$("#product").focusout(function() {
	//    verificarProducto();
	//});
    });
    
    
    /*
     *
     *	FUNCIONES AL CARGAR EL DOCUMENTO
     *	
     */
    
    $(document).ready(function() {
	
	$("input#idProvee").focus();
	
	// SOLICITAMOS EL NUMERO DE REGISTRO QUE SE CREARÁ
	
	$.post(URLSolicitudContar,function(data){
            $("#nroPedido").val(data);
        })
	
	// RECEPCION DE LOS PROVEEDORES EXISTENTES
	
	//$.getJSON(URLSolicitudProveedor, function(data) {
	    //alert(data[0]['label']);
	    //dataProveedores=data;
	//})
    }); 
	
 
    
 
 
    /*
     *	FUNCION PARA AGREGAR LA SOLICITUD INGRESO EXISTENCIA VER TABLA BD
     *
    */
 
    function detalle(event) {
        
	var idSolicitud="";
        var idProveedor="";
	
	
        // PREGUNTAMOS SI EL CAMPO IDPROV SE ENCUENTRA LLENO
        
        if(!$("#idProvee").val()) {  
          alert("Por favor, introduzca el proveedor");  
          event.preventDefault();  
        }
        else{
            
	   // if(verificarProveedor() == 1){
		
		// CONTROLADOR DEL TABS
            
		$("#tabs").tabs({disabled: false });        // HABILITAR EL TAB
		$tabs.tabs('select', 1);                    // SELECCIONA EL TAB-2
		$prove=$("#idProv").val();                  // ASIGNAR EL VALOR DEL IDPROV A LA VARIABLE PROVE
		$( "#tabs" ).tabs({disabled: [0,1]});
		
		// EVIAMOS AL CONTROLADOR LOS DATOS PARA GUARDARLOS
		
		idSolicitud=$("#nroPedido").val();
		idProveedor=$("#idProv").val();
		$.post(URLSolicitudAdd, {idProveedor:idProveedor,IDUser:IDUser},function(data){
		    $("#idSolicitud").val(data);      	// RECUPERAMOS EL NUMERO DE SOLICITUD
		})
	      
	   // }
	  //  else{
	//	alert("El proveedor seleccionado, no es valido");
	  //  }
            
        }
        return false;
    }
 
 
    /*
     *	 FUNCION PARA CAMBIAR DE TAB-2
     *
     */
    
    function solicitar(){
        $("#tabs").tabs({disabled: false });        // HABILITAR EL TAB
        $tabs.tabs('select', 0);                    // SELECCIONA EL TAB-2
        $( "#tabs" ).tabs({disabled: [0,1]});
        $("#idProvee").val("");
        alert("Su solicitud, ha sido registrada");
    }
 
 
 
    /*
     *	FUNCION PARA AGREGAR LOS PRODUCTOS
     *
     */
    function agregarFila(obj){
	
	
	//alert("precio: " + $("#precio").val()+ "total: " +$("#total").val());
	
	//var band=0;
	var auxProduct="";
	var auxCant ="";
	var auxDisponible = "";    
	var floatDisponible = 0;
	var floatCant = 0;
	var oId = "";
	var codigo = "";
	var product = "";
	var cant = "";
	var precio = $("#precio").val();
	var total = $("#total").val();
	var existencias = "";
	var strHtml1 = "";
	var strHtml2 = "";
	var strHtml3 = "";
	var strHtml4 = "";
	var strHtml5 = "";
	var strHtml6 = "";
	var strHtml7 = "";
	var strHtmlTr = "";
	var strHtmlFinal = "";
	var idProducto="";
	var idSolicitud="";
	var idCantidad="";
	var idTotal="";
    
        // VALIDAMOS QUE SE HAYA SELECCIONADO UN ID DE UN PRODUCTO
	auxProduct=$("#product").val();
	if(auxProduct.length==0){
            alert("Por favor, introduzca el producto");  
            //event.preventDefault(); 
	}
        
        //SI SE SELECCIONO CORRECTAMENTE, GENERAMOS UNA FILA PARA EL DETALLE DEL PRODUCTO
        
        else{
	    //alert(1);
	    // CONTROLAMOS SI EL CAMPO CANTIDAD SE ENCUENTRA VACIO
	    
	    auxCant = $("#cant").val();	    
	    if( auxCant.length == 0 ){
		alert("El campo cantidad se encuentra vacio");
	    }
	    else{
		//alert(2);
		// VALIDAMOS QUE EL CAMPO CANTIDAD NO SEA 0
		
		if($("#cant").val() == "0"){
		    alert("La cantidad minima de productos solicitados es 1");
		}
		else{
		    //alert(3);
		    //auxDisponible = $("#disponibles").val();    
		    //floatDisponible = parseInt(auxDisponible);
		    //floatCant = parseInt(auxCant);
		    
		    // 	VALIDAMOS CON LA CANTIDAD DE EXISTENCIAS DISPONIBLES
		    
		    //if( floatCant > floatDisponible ) {
			//alert("La cantidad solicitada, es superior a la que se tiene disponible");
		    //}
		    
		    //else{
			//alert(4)
			//if(verificarProducto() == 1){
			    //alert(5);
			    $("#cant_campos").val(parseInt($("#cant_campos").val()) + 1);
			    oId = $("#cant_campos").val();
			    codigo = $("#codigo").val();
			    product = $("#product").val();
			    cant = $("#cant").val();
			    //precio = $("#precio").val();
			    //total = $("#total").val();
			    
			    
			    //alert(total);
			    
			    existencias = $("#existencias").val();
			    
			    strHtml1 = "<td style='text-align: right' >" + codigo + '<input type="hidden"  id="hdnCodigo_' + oId + '" name="hdnCodigo_' + oId + '" value="' + codigo + '" /></td>';
			    strHtml2 = "<td>" + product + '<input type="hidden" id="hdnProduct_' + oId + '" name="hdnProduct_' + oId + '" value="' + product + '" style="width:50px"/></td>';
			    strHtml3 = "<td style='text-align: right' >" + cant + '<input type="hidden" id="hdnCant_' + oId + '" name="hdnCant_' + oId + '" value="' + cant + '" /> u</td>' ;
			    strHtml4 = "<td style='text-align: right' > $" + precio + '<input type="hidden" id="hdnPrecio_' + oId + '" name="hdnPrecio_' + oId + '" value="' + precio + '" /></td>' ;
			    strHtml5 = "<td style='text-align: right' > $" + total + '<input type="hidden" id="hdnTotal_' + oId + '" name="hdnTotal_' + oId + '" value="' + total + '" /></td>' ;
			    strHtml6 = "<td style='text-align: right' >" + existencias + '<input type="hidden" id="hdnExistencias' + oId + '" name="hdnExistencias' + oId + '" value="' + existencias + '" /> u</td>' ;
			    strHtml7 = '<td> <a href="#" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(' + oId + ');}">Eliminar</a>  <a href="#" onclick="if(confirm(\'Realmente desea editar este detalle?\')){editarFila(' + oId + ');}"> Editar </a> </td>';
			    strHtml7 += '<input type="hidden" id="hdnIdCampos_' + oId +'" name="hdnIdCampos[]" value="' + oId + '" size="10"/></td>';
			    strHtmlTr = "<tr id='rowDetalle_" + oId + "'></tr>";
			    strHtmlFinal = strHtml1 + strHtml2 + strHtml3 + strHtml4 + strHtml5 + strHtml6 + strHtml7;
			    $("#tbDetalle").append(strHtmlTr);
			    $("#rowDetalle_" + oId).html(strHtmlFinal);
			
			    if (verificarFila(oId,codigo) == 1){
				$("#rowDetalle_" + oId).remove();
				alert("El producto ya se encuentra registrado, si desea puede editarlo");
				
			    }
			    else{
				 // ASIGNACION PARA LOS INPUTS DE SUMA TOTAL DE LA TABLA Y CANTIDAD
			    
				$("#Ttotal").val(parseFloat($("#Ttotal").val()) + parseFloat($("#hdnTotal_"+oId).val())); // SUMA TOTAL
				$("#unid").val(parseFloat($("#unid").val()) + parseFloat($("#hdnCant_"+oId).val()));  // SUMA CANTIDAD DE PRODUCTOS
				
				// ASIGNAMOS VALORES PARA EL ENVIO, HACIA LA OPCION GUaRDAR, LOS DATOS DE CADA FILA BD(INGRESO_EXISTENCIA_ITEM)
				
				idProducto=$("#hdnCodigo_"+oId).val();
				idSolicitud=$("#idSolicitud").val();
				idCantidad=$("#hdnCant_"+oId).val();
				idTotal=$("#hdnTotal_"+oId).val();
			 
				$.post(URLSolicitudAdd2,
				      {idProducto:idProducto,idSolicitud:idSolicitud,idCantidad:idCantidad,idTotal:idTotal},function(data){
				});
				
				// LIMPIAMOS LOS CAMPOS
				
				limpiarCampos();
				
			    }
			//}
			//else{
			//    alert("El producto ingresado no es valido");
			//    limpiarCampos();
			//}
		    //}
		}
            } 
        }
        return false;
    }
 
 
    /*
     *	FUNCION PARA LIMPIAR CAMPOS DEL FORMULARIO
     *	
     */
 
    function limpiarCampos(){
	$('#product').val("");
	$('#cant').val("1");
	$('#disponibles').val("Disponibles");
	$('#precio').val("Cantidad x Precio");
	$('#total').val("Total");
	$('#codigo').val("");
    }
 
 
    /*
     *	FUNCION PARA EDITAR FILA DEL TABLE
     */
 
    function editarFila(oId){
        
        //ASIGNAMOS LOS VALORES DE LA FILA A ACTUALIZAR
        $("#codigo").val($("#hdnCodigo_"+oId).val());
        $("#product").val($("#hdnProduct_"+oId).val());
        $("#cant").val($("#hdnCant_"+oId).val());
        $("#precio").val($("#hdnPrecio_"+oId).val());
        $("#total").val($("#hdnTotal_"+oId).val());
	$("#disponibles").val($("#hdnExistencias"+oId).val());
	
        // RESTA TOTALES DE LA TABLA
        
        $("#Ttotal").val(parseFloat($("#Ttotal").val()) - parseFloat($("#hdnTotal_"+oId).val())); // RESTA DEL TOTAL
        $("#unid").val(parseFloat($("#unid").val()) - parseFloat($("#hdnCant_"+oId).val()));  // RESTA DE LA CANTIDAD DE PRODUCTOS
        
        // ELIMINAMOS LA FILA SELECCIONADA, PARA SER EDITADA
        
        $("#rowDetalle_" + oId).remove();
        return false;
        
    }
    
    
    /*
     *	FUNCION PARA VERIFICAR SI LA FILA SE REPITE
     */
    
    function verificarFila(oId,codigo){
        var bandFila=0;
        var aux=oId;
        var aux2=oId-1;
        while(aux2>0)
        {
            if(codigo == $("#hdnCodigo_"+aux2).val() && aux2!=aux){
                
                bandFila=1;
            }
            aux2--;
        }
        return (bandFila);
    }
    
    /*
     *	FUNCION PARA ELIMINAR LA FILA SELECCIONADA DEL TABLE DE PRODUCTOS
     */
    
     function eliminarFila(oId){
        
            // RESTA DEL TOTAL EN LA TABLA
        alert(oId);
            $("#Ttotal").val(parseFloat($("#Ttotal").val()) - parseFloat($("#hdnTotal_"+oId).val())); // RESTA DEL TOTAL
            $("#unid").val(parseFloat($("#unid").val()) - parseFloat($("#hdnCant_"+oId).val()));  // RESTA DE LA CANTIDAD DE PRODUCTOS
            
            // ELIMINAR DE LA BASE DE DATOS
            
            var idProducto=$("#hdnCodigo_"+oId).val();
	    alert(idProducto);
            var idSolicitud=$("#idSolicitud").val();
            $.post(URLSolicitudDel,
                  {idProducto:idProducto,idSolicitud:idSolicitud},function(data){
            });  
            
        $("#rowDetalle_" + oId).remove();
        return false;
    }
    
    
    /*
     *	FUNCION PARA VERIFICAR SI EL PRODUCTO INGRESADO ES VALIDO
     */
    
    function verificarProducto(){
	var bandProducto=0;
	for(var i=0;i<dataProductos.length;i++){
	    //alert(dataProductos[i]['label']+ " + "+$("#product").val());
	    if(dataProductos[i]['label'] == $("#product").val()){
		$("#disponibles").val(dataProductos[i]['existen']);
		$("#precio").val(dataProductos[i]['precio_compra']);
		//$("#precio").val(dataProductos[i]['precio_venta']);
		$("#codigo").val(dataProductos[i]['codigo']);
		sumarTotal();
		bandProducto =1;
	    }
	}
	//alert("bandProducto + "+bandProducto);
	return bandProducto;
    }
    
    
    function verificarProveedor(){
	var bandProveedor=0;
	for(var i=0;i<dataProveedores.length;i++){
	    //alert(dataProveedores[i]['label']+" + "+$("#idProvee").val());
	    if(dataProveedores[i]['label'] == $("#idProvee").val()){
		$("#idProv").val(dataProveedores[i]['id']);
		bandProveedor=1;
	    }
	}
	return bandProveedor;
    }
    
    /*
     *	FUNCION PARA SUMAR EL TOTAL DEL PRODUCTO
     *
     */
    
    
    function sumarTotal(){
	var cant = $("#cant").val();
	var precio = $("#precio").val();
	var resultado = parseFloat(cant) * parseFloat(precio);
	$('#total').val(resultado);
    }
    
    /*
     *	FUNCION PARA ENVIAR Y TERMINAR LA SOLICITUD, REDIRECCIONAMIENTO HACIA EL INDEX
     *
     */
    
    function terminar(){
	alert("Su solicitud fue procesada exitosamente");
	location.reload();
    }