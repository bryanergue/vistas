	function EsNro(valor){
		var nro = new RegExp("^[0-9.]{1,12}$","g");
		return nro.test(valor)
	};
	
	function EsVacio(valor){
		if (valor == "") return true
		else return false;
	};
	
	function trim (myString)
	{
		return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
	}
	
	function decimales(e) { 
		tecla= (e.which) ? e.which : window.event.keyCode; 
		if ((tecla<48 || tecla>57) && tecla !=46 && tecla !=8)
		return false
		else
		return true
	}

	function isDiferencia() {  
	 
		var my_array = '<?php echo CJSON::encode($array);?>';
		  alert(my_array);
		var real = document.getElementById("real");
		var cantidad = document.getElementById("cantidad");
		var diferencia = document.getElementById("diferencia");	
		//alert("diferencia="+diferencia);  
		document.getElementById("diferencia").innerHTML = "algo";
	}
	
	$(document).ready(function(){
		calcularTotales();

		//Validate only numbers
		$('.cantidadEditable').keypress(function(event){	return decimales(event);	}) ;
		$('.cantidadEditable').keyup(function(){		return decimales(event);	}) ;
		
		//$('.cantidad_editar').keypress(function(){	diferenciaReal();  	}) ;
		$('.cantidad_editar').keyup(function(){		calcularTotales();	}) ;
		
		$('.cantidad_editar').focusout(function (){	calcularTotales(); 	});
		
		$("#validar1").click(function(){
			//alert("hola");
			var productosid = new Array;
			var cantidadProd = new Array;
			var precioTotal = new Array; 
			var validador = true;
			
			$('.cantidadEditable').each(function(index) {
				productosid[index] = $(this).attr('id');
			});
			
			$('.cantidadEditable').each(function(index) {
				cantidadProd[index] = $(this).attr("value");
				if(cantidadProd[index]=="")
				{validador=false;}
			});
			
			$('.precioUnitario').each(function(index) {
				precioTotal[index] = $(this).html();	
			});
			//alert(productosid);
			//alert(cantidadProd);
			//alert(precioTotal);
			
			//llamada ajax
			if (validador == true)
			{ 
				$.ajax({
				 url: $('#ruta').val(),
				 data:  {id: $('#idsol').val(),
					 productosid: productosid,
					 cantidadProd: cantidadProd,
					 precioTotal: precioTotal,  
					},
				 type: "POST",
				 success: function(data){
				     alert('Se ha validado la solicitud de manera correcta');
				     window.location.href = $('#ruta1').val();
				    
				     
				}
				});
			 
			//fin llamada ajax   
			}
			else
			{
			    alert("Por favor complete todos los campos");
			}
		});
		
		
		
		
		
	});
	
	function calcularTotales(){
		var cantidad = $('.cantidadEditable').map(function(){
				var cant=$(this).attr("value");
				return cant; }).get();
		
		var cantExistente = $('.cantExistente').map(function(){
					var valorArray=$(this).html();
					return valorArray; }).get();
		var diferencia = $('.diferencias');
		
		var numCantidad;
		var numReal;
		var resta;
		$.each(diferencia, function(key, value) { 
			numCantidad=parseInt(cantidad[key]);
			numDife=parseInt(cantExistente[key]);
			resta=(numDife+numCantidad);
			$(this).attr("value",(resta));
			$(this).text($(this).attr("value"));   
		});
		
		var precioUnitario = $('.precioUnitario').map(function(){
				var valorArray=$(this).html();
				return valorArray; }).get();;
		var total = $('.total');
		var producto;
		$.each(total, function(key, value) { 
			numCantidad=cantidad[key];
			numTotal=precioUnitario[key];
			producto=(numTotal*numCantidad);
			$(this).attr("value",(producto));
			$(this).text($(this).attr("value"));   
		});
	}
	
	
	
	