$(document).ready(function(){
	
	jQuery("#e").keyup(function () {
        this.value = this.value.replace(/[^0-9]/g,'');
    });
	
	//Boton Editar
	$("#edit").click(function(){
		
		//Recupera Variables de Inputs
		var idSol=$("#idSol").val();
		var idProd=$("#idProd").val();
		var cant=$("#e").val();
		var descrip=$("#producto").val();
		//Verifica si descripcion no esta vacia
		if(descrip=="")
		{
			alert("Primero debe selecionar un producto a editar.");
		}
		else
		{
			$.post(URLDiferencia, {id:idProd,cant:cant},function(data){
				if(data=="true")
				{
					$.post(URLEdits, {idSol:idSol,idProd:idProd,cant:cant,},function(data){
					document.location.href=URLPendientes;
					})
				}
				else
				{
					alert("La cantidad introducida excede la cantidad de existencias del producto; por favor, introdusca una cantidad menor o igual a: "+data);
				}
			})
		}
	
	
	})
	//Boton Cancelar
	$("#cancel").click(function(){
	
		//Limpia los campos
		$("#producto").each(function(){	
			$($(this)).val('');
		});
		$("#e").each(function(){	
			$($(this)).val('');
		});								
		$("#prePro").each(function(){	
			$($(this)).val('');
		});
		$("#g").each(function(){	
		$($(this)).val('Total');
		});
		//alert($("#idProd").val());
		//alert($("#idSol").val());
		$("#idProd").each(function(){	
			$($(this)).val('x');
		});
		$("#idSol").each(function(){	
			$($(this)).val('y');
		});
								
		
	})

})