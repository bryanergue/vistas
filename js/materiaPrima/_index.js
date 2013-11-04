    /*
     *	JS SOLICITUD DE INGRESO DE EXISTENCIAS
     *
     *	@Autor: Est. Daniel Luis Herrera Santander
     *  @version 1.0
     *  
     *	@description: Controla el aspecto visual y el manejo de eventos del index, validacion, envio de datos
     *	a ser guardados, recepcion de datos para autocomplete
     */
    
    

    $(function() {
    
	// Validamos campos cantidad,precioUnitarioDeCompra
	
	jQuery("#cantidad").keyup(function () {
	    this.value = this.value.replace(/[^0-9]/g,'');
	});
	
	
	//number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	
	
	jQuery("#precioUnitario").keyup(function () {
	    this.value = this.value.replace(/[^0-9+\-Ee.]/g,'');
	});
	
	/*
	jQuery("#cantidad").each(function(){
	    $(this).val(parseFloat($(this).val()).toFixed(2));
	});
	
	$('.two-digits').keyup(function(){
	    if($(this).val().indexOf('.')!=-1){         
		if($(this).val().split(".")[1].length > 2){                
		    if( isNaN( parseFloat( this.value ) ) ) return;
		    this.value = parseFloat(this.value).toFixed(2);
		}  
	    }            
	    return this; //for chaining
	});
	
	; */
	
	
	
	// Validamos cantidad de digitos para los campos cantidad,precioUnitarioDeCompra
	
	$("#cantidad").attr("maxlength", 6);
	$("#precioUnitario").attr("maxlength", 6);
	
	// asignamos variables recibidas mediante URL
	
	$("#productoId").val(indexProdId);
	$("#idYear").val(indexYear);
	$("#idMonth").val(indexMonth);
	$("#idProducto").val(indexIdProduct);
	
	
	
	jQuery('#materiaPrima-grid a.class-editar').live('click',function()
	{
	    var idMateriaPrima=$("#idMateriaPrima").val($(this).parent().parent().children().html());
	    var materiaPrima=$("#materiaPrima").val($(this).parent().parent().children().next().html());
	    var precioUnitario=$("#precioUnitario").val($(this).parent().parent().children().next().next().html());
	    var cantidad=$("#cantidad").val($(this).parent().parent().children().next().next().next().html());
	    var productoId=$("#productoId").val();
	    var idMonth=$("#idMonth").val();
	    var idYear=$("#idYear").val();				
	});
	
	
	
	
	
	
	
	jQuery('#materiaPrima-grid a.class-eliminar').live('click',function()
	{
	    var idMateriaPrima = $(this).parent().parent().children().html();
	    var productoId=$("#productoId").val();
	    var idMonth=$("#idMonth").val();
	    var idYear=$("#idYear").val();
	    //alert(idMateriaPrima+"-"+productoId+"-"+idMonth+"-"+idYear);
	    
	    $.post(URLeliminar, {idMateriaPrima:idMateriaPrima,productoId:productoId,idMonth:idMonth,idYear:idYear},function(data)
	    {
		//alert(data);
		if(data=='true')
		{
		    alert("El producto fue eliminado correctamente");
		    window.location.reload(true);
		}
	    });
	    
	    //location.reload();
	});
	
	
    });
    
    
    /*
     *	FUNCIONES AL CARGAR EL DOCUMENTO
     */
    
    $(document).ready(function() {
	
	$("input#idProvee").focus();
	$( "#tabs" ).tabs();
	
	//$("#productoId").val(indexProdId);
	//$("#idYear").val(indexYear);
	//$("#idMonth").val(indexMonth);
	
	/*$("#buscar").click(function(){
	    
	    
	    var productoId=$("#productoId").val(indexProdId);
	    var idYear=$("#idYear").val(indexYear);
	    var idMonth=$("#idMonth").val(indexMonth);
	    document.location=dir+"/idMonth/"+idMonth+"/idYear/"+idYear+"/productoId/"+productoId;
	});*/
	
	
	$("#anadir").click(function(){
	    
	    
	    var idMateriaPrima = $("#idMateriaPrima").val();
	    var productoId = $("#productoId").val();
	    var idMonth = $("#idMonth").val();
	    var idYear = $("#idYear").val();
	    var precioUnitario = $("#precioUnitario").val();
	    var cantidad = $("#cantidad").val();
	
	    if(productoId == "")
	    {
		alert("Ingrese el producto");
	    }
	    else if((idMateriaPrima == "") )
	    {
		alert("Ingrese la materia prima");
	    }
	    else if((precioUnitario == "")) 
	    {
		alert ("Ingrese el precio unitario de la materia prima")
	    }
	    else if((precioUnitario == "0")) 
	    {
		alert ("El precio Unitario no puede ser 0")
	    }
	    else if((cantidad == ""))
	    {
		alert("Ingrese la cantidad de la materia prima");
	    }
	     else if((cantidad == "0"))
	    {
		alert("La cantidad no puede ser 0");
	    }
	    else
	    {
		$.post(URLagregar, {idMateriaPrima:idMateriaPrima,productoId:productoId,idMonth:idMonth,idYear:idYear,precioUnitario:precioUnitario,cantidad:cantidad},function(data)
		{
		    //alert(data);
			if (data=='true')
			{
			    alert("El producto fue agregado correctamente");
			    window.location.reload(true);
			}	
		});
		//location.reload();
		//window.location.reload(true);
	    }	
	    
	});
	
	$("#Almacenar").click(function(){
	    var elements = document.getElementsByTagName('tfoot');
	    var td= elements[0].getElementsByTagName('td');
	    var total=td[4].innerText;
	    var productoId = $("#productoId").val();
	    var idMonth = $("#idMonth").val();
	    var idYear = $("#idYear").val();
	    
	    $.post(URLalmacenar, {productoId:productoId,idMonth:idMonth,idYear:idYear,total:total},function(data)
	    {
		//alert(data);
		if(data=='true')
		{
		    alert("El costo total fue registrado correctamente");
		    window.location.reload(true);
		}
		//location.reload();
	    });
	    //window.location.reload(true);
	    //location.reload();
	    //location.reload();
	});
	
    }); 


    
    