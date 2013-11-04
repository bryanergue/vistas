$(document).ready(function(){
	
	$.post(URLContar,function(data){
        $("#ids").val(data);
    })


	$("#idbtng").click(function(){
		//alert("sssss")
		
		var salida=$("#b").val();
		var cod=$("#c").val();
		var ref=$("#refer").val();
		if(salida=="")
		{
			alert("Selecciones un Tipo de Salida.");
		}
		else
		{
			$.post(URLAdd, {cod:cod,salida:salida,ref:ref,IDUser:IDUser},function(data){
				//alert(data);			
				$("#idSol").val(data);
				$("#ids").val(data);
				$('#tabs').tabs('enable', 1);
				$("#tabs" ).tabs('select',1);
				$("#tabs").tabs({disabled: [0,1]});
				
			})
		}
	})
	
	
	
	$("#idbtng2").click(function(){
		$("#idbtng2").attr("disabled", true);
		var id=$("#idProd").val();
		var idsol=$("#idSol").val();
		var pro=$("#producto").val();
		var cant=$("#e").val();
		var preciou=$("#prePro").val();
		var total=$("#g").val();
		$("#producto").prop('disabled', false);
		
			
		
		if(pro!="")
		{
				
				$.post(URLCompara, {id:id,pro:pro},function(data){
				
				
				if(data=="true")
				{
						
						if(cant>0)
						{
						$.post(URLDiferencia, {id:id,cant:cant},function(data){
						if(data=="true")
						{
							
							$.post(URLAdd2, {id:id,idsol:idsol,pro:pro,cant:cant,preciou:preciou,total:total},function(data){
							
							if(data=="true")	
							{
								
								var xx=document.getElementById('cant_campos').value;
								$("#cant_campos").val(parseInt($("#cant_campos").val()) + 1);
								var oId = $("#cant_campos").val();		
								var id=$("#idProd").val();
								var idsol = $("#idSol").val();
								var pro =$("#producto").val();
								var cant=$("#e").val();
								var preciou=$("#prePro").val();
								var total=$("#g").val();
								var exist=$("#exist").val();
									
								//Busca si existe alguna fila en la tabla listada introducido para que sea eliminado y asi ingrese el nuevo valor.
								for(var i=1;i<=oId;i++)
								{
									if(id==$("#hdnIdpro_"+i).val())
									{
										
										//editarFila(i);
										eliminarFilaVista(i);
										break;
									
									//alert("ENCONTRADO");
									}
									//else
									//alert("no se encontro");
								
								}
								
					
								//var strHtml1 = "<td>" + idsol + '<input type="hidden" id="hdnIdsol_' + oId + '" name="hdnIdsol_' + oId + '" value="' + idsol + '"/></td>';
								var strHtml2 = "<td style='text-align: right'>" + id + '<input type="hidden" id="hdnIdpro_' + oId + '" name="hdnIdpro_' + oId + '" value="' + id + '"/></td>' ;
								var strHtml3 = "<td>" + pro + '<input type="hidden" id="hdnPro_' + oId + '" name="hdnPro_' + oId + '" value="' + pro + '"/></td>' ;
								var strHtml4 = "<td style='text-align: right'>u" + cant + '<input type="hidden" id="hdnCant_' + oId + '" name="hdnCant_' + oId + '" value="' + cant + '"/> </td>' ;
								var strHtml5 = "<td style='text-align: right'>$" + preciou + '<input type="hidden" id="hdnPreciou_' + oId + '" name="hdnPreciou_' + oId + '" value="' + preciou + '"/> </td>' ;
								var strHtml6 = "<td style='text-align: right'>$" + total+ '<input type="hidden" id="hdnTotal_' + oId + '" name="hdnTotal_' + oId + '" value="' + total + '"/> </td>';
								var strHtml7 = "<td style='text-align: right'>u" + exist + '<input type="hidden" id="hdnExist_' + oId + '" name="hdnExist_' + oId + '" value="' + exist + '"/> </td>';
								var strHtml8 = '<td><a href="#" onclick="if(confirm(\'\u00BF Realmente desea ELIMINAR esta fila?\')){eliminarFila(' + oId + ');}">Eliminar</a>-<br><a href="#" onclick="editarFila(' + oId + ');">Editar</a></td>';
								strHtml8 += '<input type="hidden" id="hdnIdCampos_' + oId +'" name="hdnIdCampos[]" value="' + oId + '" /></td>';
								var strHtmlTr = "<tr id='rowDetalle_" + oId + "'></tr>";
								var strHtmlFinal = strHtml2 + strHtml3 + strHtml4 + strHtml5 + strHtml6 + strHtml7 + strHtml8;
								//tambien se puede agregar todo el HTML de una sola vez.
								//var strHtmlTr = "<tr id='rowDetalle_" + oId + "'>" + strHtml1 + strHtml2 + strHtml3 + strHtml4 + strHtml5 + strHtml6 +"</tr>";
								$("#tbDetalle").append(strHtmlTr);
								//si se agrega el HTML de una sola vez se debe comentar la linea siguiente.
								$("#rowDetalle_" + oId).html(strHtmlFinal);
					
					
								//Suma de la columna items
								$("#itotal").val(parseInt($("#itotal").val())+parseInt($("#hdnCant_"+oId).val()));
								//Suma de la columna precios totales de cada producto
								$("#atotal").val(parseInt($("#atotal").val())+parseInt($("#hdnTotal_"+oId).val()));
								
								
								//Limpia todos los campos por defecto
								$("#producto").each(function(){	
								this.value = this.defaultValue;
								});
								$("#e").each(function(){	
								this.value = this.defaultValue;
								});								
								$("#prePro").each(function(){	
								this.value = this.defaultValue;
								});
								$("#g").each(function(){	
								$($(this)).val('Total');
								});
								$("#idProd").each(function(){	
								$($(this)).val('x');
								});
								
								$("#idbtng2").attr("disabled", false);
																
								return false;
							
							}
							
							else
							{
								alert("NO se pudo completar la operacion");
								$("#idbtng2").attr("disabled", false);
							}
					
							})
								
								
								
								
							//fin if
						}
						else
						{
							alert("La cantidad introducida excede la cantidad de existencias del producto; por favor, introdusca una cantidad menor o igual a: "+data);
							if(data>0)
                            $("#producto").prop('disabled', true);
                            else
                            $("#producto").prop('disabled', false);
							
							$("#idbtng2").attr("disabled", false);
						}
						})
						}
						else
						{
						alert("Introdusca un valor diferente a cero");
						$("#producto").prop('disabled', true);
						$("#idbtng2").attr("disabled", false);
						}
											
				}
				else
				{
					alert("El producto introducido NO es valido, por favor USE el buscador de productos.");
					$("#idbtng2").attr("disabled", false);
				}
				})
			
			    
        }  
		else
		{alert("Por favor introdusca un producto.");
		$("#idbtng2").attr("disabled", false);}
		
		
		
		
		
		
	})
	
	//Boton de terminado
	$("#idbtng3").click(function(){
		
		location.reload();
		
	})
	

})
