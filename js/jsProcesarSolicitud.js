	$(document).ready(function(){
		calcularTotales();
	});	
	
	function calcularTotales(){
		var cantExistente = $('.cantExistente').map(function(){
					var valorArray=$(this).html();
					return valorArray; }).get();
		var cantidad = $('.cantidadSolicitada').map(function(){
				var cant=$(this).html();
				return cant; }).get();
		
		//alert(cantExistente+" + "+cantidad);
		var diferencia = $('.diferencias');
		
		var numCantidad;
		var numDife;
		var resta;
		$.each(diferencia, function(key, value) { 
			numCantidad=parseInt(cantidad[key]);
			numDife=parseInt(cantExistente[key]);
			resta=(numDife+numCantidad);
			$(this).attr("value",(resta));
			$(this).text($(this).attr("value"));   
		});
	}
	
	
	$("#procesar1").click(function(){    
		
		
		//alert($('#idsol').val());
		var productosid = new Array;
		var cantidadProd = new Array;
		var cantidadItem = new Array;
		var precioTotal = new Array; 
		
		
		$('.productoId').each(function(index) {
			productosid[index] = $(this).html();
		});
		
		$('.cantidadSolicitada').each(function(index) {
			cantidadProd[index] = $(this).html();
		});
		
		$('.diferencias').each(function(index) {
			cantidadItem[index] = $(this).attr("value");	
		});
		//alert(cantidadItem);
		$('.total').each(function(index) {
			precioTotal[index] = $(this).html();	
		});
		
			$.ajax({
			 url: $('#ruta').val(),
			 data:  {
				id: $('#idsol').val(),
				 productosid: productosid,
				 cantidadProd: cantidadProd,
				 cantidadItem: cantidadItem,
				 precioTotal: precioTotal,  
				},
			 type: "POST",
			 success: function(data){
			     alert('Se ha procesado la solicitud de manera correcta');
			     window.location.href = $('#ruta1').val();
    
			}
			});
		 
	});
	
	
	