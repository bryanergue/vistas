
    /*
     *
     *	DECLARACION DE VARIBLES A UTILIZAR
     *
     */
    
    var cadenaDetalle = new Array();
    

    // VARIABLE PARA EL MANEJO DE TAB  
    var $tabs;
    
    // VARIABLE PARA PROVEEDOR 
    var $prove = "";
    var cant = "";
    var precio = "";
    var resultado ="";
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
	
    
	// AUTOCOMPLETE PARA EL BUSCADOR DE RPODUCTOS 
	
	$("#product").autocomplete({
       
	      
	      source: function(request, response) {                  
		alert ("hoak");
		$.ajax({
		    type: "POST",
		    url: URLSolicitudProducto,
		    dataType: "json",
		    data: {
		       term : request.term,
		       id : $("#idProv").val()
		    },
		    
		    success: function(data) {
			dataProductos = data;
			response(data);
			
		    }
		});
		alert ("hoakas");
	      },
	    
	    // ASIGNAR VALORES AL CAMPO PRECIO DEL PRODUCTO,ASIGNAR VALOR CANT =1 
	    
	    select: function(event, ui) {
		
			//ASIGNAMOS VALORES A LOS HIDDEN
			
			$('#precio').val(ui.item.precio_compra);
			$('#codigo').val(ui.item.codigo);
			$('#existencias').val(ui.item.existen);
			$('#cant').val("1");
			$('#disponibles').val(ui.item.existen);
			
			
			//$('#idPrecioCompra').val(ui.item.precio_compra);
			//alert("precio compra: "+ $('#idPrecioCompra').val());
			
			// CALCULO DEL TOTAL
			
			cant = $("#cant").val();
			precio = $("#precio").val();
			resultado = parseFloat(cant) * parseFloat(precio);
			$('#total').val(resultado);
			alert(arrayProductos);
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
	    cant = $("#cant").val();
	    
	    // CONTROLAMOS EL CAMPO CANTIDAD, CUANDO ÉSTE SE ENCUENTRE VACIO
	    
	    if( ($("#cant").val()=="") || ($("#codigo").val() == "") ){
		$('#total').val("0");
	    }
	    else{
		precio = $("#precio").val();
		resultado = parseFloat(cant) * parseFloat(precio);
		$('#total').val(resultado);
	    }
	    
	});
	
	
	// BORRAMOS INPUTS, SI EL CAMPO PRODUCTO ESTA VACIO
	
	$("#product").keyup(function(){
	    if($("#product").val()==""){
		$('#cant').val("1");
		$('#disponibles').val("Disponibles");
		$('#precio').val("Cantidad x Precio");
		$('#total').val("Total");
	    }
	});
	
	// CONTROLAMOS LA CANTIDAD DE DIGITOS PARA EL CAMPO CANTIDAD SOLICITADA
	
	$("#cant").attr("maxlength", 6);
	
	//	VERIFICAMOS SI EL PRODUCTO INGRESADO ES VALIDO, CON EL EVENTO FOCUSOAUT
	
	$("#product").focusout(function() {
	    verificarProducto();
	});
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
	
	
	//var band=0;
	//var auxProduct="";
	//var auxCant ="";
	//var auxDisponible = "";    
	//var floatDisponible = 0;
	//var floatCant = 0;
	var oId = "";
	//var codigo = "";
	//var product = "";;
	//var cant = "";;
	//var precio = "";
	//var total = "";
	//var existencias = "";
	var strHtml1 = "";
	var strHtml2 = "";
	var strHtml3 = "";
	var strHtml4 = "";
	var strHtml5 = "";
	//var strHtml6 = "";
	var strHtml7 = "";
	var strHtmlTr = "";
	var strHtmlFinal = "";
	//var idProducto="";
	//var idSolicitud="";
	//var idCantidad="";
	//var idTotal="";
	
	var cantidad=$("#cant").val();
	var id=$("#t").val();
    var cod=$("#cod").val();
    var precio=$("#precio").val();
    var total = cantidad * precio ;
	var des=$("#idInputSeleccionar").val();
	if(id == "")
    {alert('Debe seleccionar un producto');
    return false;
    }
    if(cantidad == "" || cantidad == 0)
    {alert('Debe seleccionar una cantidad');
    return false;
    }

	$("#cant_campos").val(parseInt($("#cant_campos").val()) + 1);
	oId = $("#cant_campos").val();
	/*codigo = $("#codigo").val();
	product = $("#product").val();
	cant = $("#cant").val();
	precio = $("#precio").val();
	total = $("#total").val();
	existencias = $("#existencias").val();*/
    
    strHtml1 = "<td style='text-align: right' >" + cod + '<input type="hidden"  id="hdnCod_' + oId + '" name="hdnCod_' + oId + '" value="' + cod + '"/>' + '<input type="hidden"  id="hdnId_' + oId + '" name="hdnId_' + oId + '" value="' + id + '" /></td>';
	strHtml2 = "<td>" + des + '<input type="hidden" id="hdnDes_' + oId + '" name="hdnDes_' + oId + '" value="' + des + '" style="width:50px"/></td>';
	strHtml3 = "<td style='text-align: right' >" + cantidad + '<input type="hidden" id="hdnCantidad_' + oId + '" name="hdnCantidad_' + oId + '" value="' + cantidad + '" /> u</td>' ;
	strHtml4 = "<td style='text-align: right' > $" + precio + '<input type="hidden" id="hdnPrecio_' + oId + '" name="hdnPrecio_' + oId + '" value="' + precio + '" /></td>' ;
	strHtml5 = "<td style='text-align: right' > $" + total + '<input type="hidden" id="hdnTotal_' + oId + '" name="hdnTotal_' + oId + '" value="' + total + '" /></td>' ;
	/*strHtml6 = "<td style='text-align: right' >" + existencias + '<input type="hidden" id="hdnExistencias' + oId + '" name="hdnExistencias' + oId + '" value="' + existencias + '" /> u</td>' ;*/
	strHtml7 = '<td> <a href="#" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(' + oId + ');}">Eliminar</a>  <a href="#" onclick="if(confirm(\'Realmente desea editar este detalle?\')){editarFila(' + oId + ');}"> Editar </a> </td>';
	strHtml7 += '<input type="hidden" id="hdnIdCampos_' + oId +'" name="hdnIdCampos[]" value="' + oId + '" size="10"/></td>';
	strHtmlTr = "<tr id='rowDetalle_" + oId + "'></tr>";
	strHtmlFinal =   strHtml1 + strHtml2 + strHtml3+ strHtml4 + strHtml5 + strHtml7;
	$("#tbDetalle").append(strHtmlTr);
	$("#rowDetalle_" + oId).html(strHtmlFinal);
			
	limpiarCampos();
	//var aux= new Array();
	//aux[oId]=["/",id,"|",cantidad];
	//detalle.push(aux[oId]);
	//cadenaDetalle[oId]=["/"+id+"|"+cantidad];
	cadenaDetalle.push("-"+oId+"-",id,cantidad,precio) ;
	//alert(cadenaDetalle.length);
	//alert(cadenaDetalle);
			
	//alert(oId);
        
        return false;
    }
 
 
    /*
     *	FUNCION PARA LIMPIAR CAMPOS DEL FORMULARIO
     *	
     */
 
    function limpiarCampos(){
	$('#t').val("");
	$('#cant').val("1");
	$('#idInputSeleccionar').val("");
	//$('#precio').val("Cantidad x Precio");
	//$('#total').val("Total");
	//$('#codigo').val("");
    }
 
 
    /*
     *	FUNCION PARA EDITAR FILA DEL TABLE
     */
 
    function editarFila(oId){
        
                    items = $("#cant_campos").val()-1;
            $("#cant_campos").val(items); 
        //ASIGNAMOS LOS VALORES DE LA FILA A ACTUALIZAR
	//alert("indice:  "+oId);
        cadenaDetalle.splice(cadenaDetalle.indexOf("-"+oId+"-"),4);
	//cadenaDetalle.splice("-"+oId+"-",3);
	//delete cadenaDetalle[oId];
        $("#t").val($("#hdnId_"+oId).val());
        $("#cant").val($("#hdnCantidad_"+oId).val());
        $("#idInputSeleccionar").val($("#hdnDes_"+oId).val());
        $("#cod").val($("#hdnCod_"+oId).val());
        $("#precio").val($("#hdnPrecio_"+oId).val());
        //$("#total").val($("#hdnTotal_"+oId).val());

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
        cadenaDetalle.splice(cadenaDetalle.indexOf("-"+oId+"-"),4);
            $("#Ttotal").val(parseFloat($("#Ttotal").val()) - parseFloat($("#hdnTotal_"+oId).val())); // RESTA DEL TOTAL
            $("#unid").val(parseFloat($("#unid").val()) - parseFloat($("#hdnCant_"+oId).val()));  // RESTA DE LA CANTIDAD DE PRODUCTOS
            items = $("#cant_campos").val()-1;
            $("#cant_campos").val(items);          
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
	cant = $("#cant").val();
	precio = $("#precio").val();
	resultado = parseFloat(cant) * parseFloat(precio);
	$('#total').val(resultado);
    }
    
    /*
     *	FUNCION PARA ENVIAR Y TERMINAR LA SOLICITUD, REDIRECCIONAMIENTO HACIA EL INDEX
     *
     */
    
    function terminar()
    {
    //Validacion javascript
    validador = true;
    
    //1.Verificar que exista al menos un producto
    if($("#cant_campos").val()<1)
    {alert('Debe existir al menos un producto relacionado');
    validador=false;}
    //2.Verificar que se haya seleccionado
    
    if(validador == true)
    {
	numSol = $("#ordenid").val();
    datepicker = $("#datepicker").val();
    moneda= $("#monedas").val();
    pago = $("#pagos").val();
    fact = $("#Compra_nro_factura").val(); 
	//alert(numSol+" "+datepicker+" "+moneda+" "+pago+" "+fact+" ");
	var det= new Array();
	for (x=0;x<cadenaDetalle.length;x=x+4)
	{
	    det.push(cadenaDetalle[x+1],cadenaDetalle[x+2],cadenaDetalle[x+3]);
	}
	//alert(det);
	$.get(URLAct ,{id:numSol,detalle:det,fecha:datepicker,tipomoneda:moneda,tipopago:pago,factura:fact}, function(data)
	{
	//alert (data);
    });
	alert('Se ha procesado la solicitud de manera correcta');
    window.location.href = $('#ruta').val();
    }
    else
    {return false;}
    
    }
 
    //Llena la tabla con los registros asociados a esa cotizacion en caso de existir
    function inicial()
    {         
         /*
         $(document).keydown( function(e){  
          if( e.which == 8 && ( document.activeElement.id == 'prueba') ){   
          e.preventDefault();  
          return false;   
            } 
         }); */ 

          $('#datepicker').keypress(function(){ 
          return false;
          }) ;  
          $('#datepicker').keyup(function(){ 
          return false;
          }) ;      
          $('#datepicker').keydown(function(){ 
          return false;
          }) ; 
 
        $('#cant').val("1"); 
        $.ajax({
         url: $('#ruta1').val(),
         data:  {id: $("#ordenid").val(),
         },
         type: "POST",
         success: function(data){
             
              $.each(data, function(key, data) {
               
               $('#t').val(data.id); //id producto
               $('#cod').val(data.cod); //codigo producto 
               $("#cant").val(data.cant);    //cantidad
               $("#precio").val(data.precio);    //precio      
               $("#idInputSeleccionar").val(data.desc);  //descripcion
               agregarFila(document.getElementById('cant_campos'));
         
         });
         //alert('Se ha procesado la solicitud de manera correcta');   
         }
        });
                                    
         
    }
   
    