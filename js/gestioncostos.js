$(document).ready(function(){

	if(tipoID!=1)
	{
	$("#vidaUtil").hide();
	$("#costoInicial").hide();
	$("#lab1").hide();
	$("#lab2").hide();
	}
	//alert(tipoID);
	$('#TipoDep option[value='+tipoID+']').attr('selected', 'selected');
	
	jQuery("#vidaUtil").keyup(function () {
        this.value = this.value.replace(/[^0-9]/g,'');
    });
	
	jQuery("#costoInicial").keyup(function () {
        this.value = this.value.replace(/[^0-9]/g,'');
    });
	$.post(URLContar,function(data){
        if($("#id").val()=="")
		{$("#id").val(data);}
    })
	
	
	
	$("#add").click(function(){
		
		var id=$("#id").val();
		var nombre=$("#nombre").val();
		var detalle=$("#detalle").val();
		
		var tipo=$("#TipoDep").val();
		var vidaUtil=$("#vidaUtil").val();
		var costoInicial=$("#costoInicial").val();
		
		//if(id=="")
		//{
			if(nombre=="")
			{
				alert("Debe introducir un nombre de item");
			}
			else if(detalle=="")
			{
				alert("Debe introducir un detalle para el item");
			}
			else if(tipo=="")
			{
				alert("Debe seleccionar un tipo de item");
			}
			else if(tipo==1)
			{
				if(vidaUtil=="")
				{
					alert("Debe introducir vida util de item depreciable");
				}
				else if(costoInicial=="")
				{
					alert("Debe introducir costo inicial de item depreciable");
				}
				else
				{
				$.post(URLAgregar, {id:id,nombre:nombre,detalle:detalle,tipo:tipo,vidaUtil:vidaUtil,costoInicial:costoInicial},function(data){
					if(data=="true")
					{
					 document.location.href=URLRedirect;
					}
				})
				}
			}
			else
			{
				$.post(URLAgregar, {id:id,nombre:nombre,detalle:detalle},function(data){
					if(data=="true")
					{
					 document.location.href=URLRedirect;
					}
				})
			}
		//}
		/*else
		{
			if(nombre=="")
			{
				alert("Debe introducir un nombre de item");
			}
			else if(detalle=="")
			{
			alert("Debe introducir un detalle para el item");
			}
			else
			{
				$.post(URLAgregar, {id:id,nombre:nombre,detalle:detalle},function(data){
					if(data=="true")
					{
					 document.location.href=URLRedirect;
					}
				})
			
			}
		
		}*/
	})
	$("#cancel").click(function(){
		
		$.post(URLContar,function(data){
			//if($("#id").val()=="")
			$("#id").val(data);
		})
		//$("#id").each(function(){	
		//	$($(this)).val('');
		//});
		$("#nombre").each(function(){	
			$($(this)).val('');
		});
		$("#detalle").each(function(){	
			$($(this)).val('');
		});
		
		$("#TipoDep").each(function(){	
			$($(this)).val('');
			
		});
		$("#vidaUtil").each(function(){	
			$($(this)).val('');
			$("#vidaUtil").hide();
			$("#lab1").hide();
	
		});
		$("#costoInicial").each(function(){	
			$($(this)).val('');
			$("#costoInicial").hide();
			$("#lab2").hide();
		});
		
	
	})


})