$(document).ready(function(){
	
	$("#costoIndirectoLink").hide();
	$("#costoDirectoLink").hide();
	
	$("#buscar").click(function(){
		var idProd=$("#idProd").val();
		var desc =$("#producto").val();
		var mes=$("#mes").val();
		var anio=$("#anio").val();
		
		if(desc=="")
		{
			alert("Primero debe seleccionar un producto del buscador");
			
		}
		else if(mes=="")
		{
			alert("Debe seleccionar mes");
				
		}
		else if(anio=="")
		{
			alert("Debe seleccionar a\u00f1o");
		}
		else
		{
			
			$.post(URLcalcula, {idProd:idProd,desc:desc,mes:mes,anio:anio},function(data){
					var param=data;
					var valores = param.split('-');
					/*for(j=0;j<valores.length;j++)
					{//alert(valores[j]);
						
					}*/
					//$("#idProd").val(valores[0]);
					$("#costoDirecto").val(valores[4]);
					$("#costoIndirecto").val(valores[5]);
					$("#costoTotal").val(valores[6]);
					$("#costoDirectoTotal").val(valores[7]);
					//Si el Costo Directo Total de Material es 0 entonces el Costo Directo es Igual al Costo Total
					if($("#costoDirectoTotal").val()==0)
					{$("#costoTotal").val(valores[4]);}
					
					if($("#costoDirecto").val()!='No Calculado')
					{
						$("#costoDirectoLink").hide();
					}
					else
					{
						$("#costoDirectoLink").show();
					}
					if($("#costoIndirecto").val()!='No Calculado')
					{
						$("#costoIndirectoLink").hide();
					}
					else
					{
						$("#costoIndirectoLink").show();
					}
			})
		}
	})
	
	$("#costoDirectoLink").click(function(){
		var producto=$("#idProd").val();
		var mes=$("#mes").val();
		var anio=$("#anio").val();
		
		if(producto!="" && mes!="" && anio!="")
		{
			if($("#costoDirecto").val()=='No Calculado')
			{
			//document.location.href=URLDirect+"?id="+idProd;
			
			$.post(URLbuscarproducto, {
                mes: mes,
                anio: anio,
                producto: producto,
            },function(data){ 
                    if (data == true) {
                        var r = confirm("No se encontro ningun producto en esa fecha, ¿Registrarlo ahora?");
                        if (r == true){
                                document.location.href=URLregistro+"?mes="+mes+"&anio="+anio+"&producto="+producto;                             
                        }          
                        else
                          {
                          //alert("sin registro");
                          }
                    }
                    else {
                        document.location.href=URLcarga+"?mes="+mes+"&anio="+anio+"&producto="+producto;                             
                    }
            })
			
						
			
			}
		}
	})
	
	
	$("#costoIndirectoLink").click(function(){
		var idProd=$("#idProd").val();
		var mes=$("#mes").val();
		var anio=$("#anio").val();
		var act='S';
		var comercio=2;
		
		if(idProd!="" && mes!="" && anio!="")
		{
			if($("#costoIndirecto").val()=='No Calculado')
			{
			//document.location.href=URLIndirect+"?id="+idProd;
			 document.location=dir+"/mes/"+mes+"/ano/"+anio+"/id/"+idProd+"/act/"+act+"/idTipoNegocio/"+comercio;
			}
		}
	})
	
	$("#producto").click(function(){
		$("#mes").each(function(){	
			$($(this)).val('');
		});
		$("#anio").each(function(){	
			$($(this)).val('');
		});
	})
	
	$("#imprimir").click(function(){
        //alert("hola");
        $("#buscar").hide();        
        $("#almacenar").hide();
        $("#imprimir").hide();
        $("#mes").hide();
        $("#anio").hide();
        //$("#mesImp").show();
        //$("#anioImp").show();
		var mes=$("#mes").val();
		$('#mes').attr("value",mes);
        $(this).text($(this).attr("value"));
		        
        var ventimp=window.open(' ','popimpr');
        ventimp.document.write($("#tabs-1").html());
        ventimp.document.close();
        ventimp.print();
        ventimp.close();
      
        $("#buscar").show();        
        $("#almacenar").show();
        $("#imprimir").show();
        $("#mes").show();
        $("#anio").show();
		
		//$("#mesImp").hide();
        //$("#anioImp").hide();
      
    });
	
	$("#almacenar").click(function(){
	
		var total=$("#costoTotal").val();
		if(total=='No Calculado')
		{alert('Deben estar todos los costos calculados');}
		else
		{alert('Costo Total de Producto Almacenado');}
	})

})