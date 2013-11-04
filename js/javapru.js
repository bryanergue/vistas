function soloNumeros(e){
            var key = window.Event ? e.which : e.keyCode
            return (key >= 48 && key <= 57 || key==8 || key==46 )
}
function userClicks(aceptadoId) {
            return alert($.fn.yiiGridView.getSelection(aceptadoId));
}
$(document).ready(function(){
	//**********************************************************************
	function init()
    {
		$('.cant2').each(function(){ $(this).prop('disabled', true); });
		$('.total :input').each(function(){ 
			$(this).change(
				function () { 
					if(!$(this).hasClass("checked")) 
					{	var o = $(this).attr('id');
						$("[ssid=r"+o+"]").prop('disabled', true);
						$("[sid="+o+"]").prop('disabled', true);
						$("[id=r"+o+"]").prop('checked',false);
						$("[id=r"+o+"]").prop('disabled', true);						
						$(this).addClass("checked");
						return;
					}
					 	var o = $(this).attr('id');
						$("[sid="+o+"]").prop('disabled', false);
						$("[id=r"+o+"]").prop('disabled', false);
						$(this).removeClass('checked');
				}
			); 
		});
		
		$('.parcial :input').each(function(){ 
			$(this).change(
				function () { 
					if(!$(this).hasClass("checked")) 
					{	var o = $(this).attr('id');
						$("[ssid="+o+"]").prop('disabled', false);
						$(this).addClass("checked");
						return;
					}
					 	var o = $(this).attr('id');
						$("[ssid="+o+"]").prop('disabled', true);
						
						$("[ssid="+o+"]").each(function(){	
						this.value = this.defaultValue;
						});
						
						$(this).removeClass('checked');
				}
			); 
		});
		
		$('.chkbx1').empty();
		$('.chkbx1').append('Aceptar');
		$('.chkbx2').empty();
		$('.chkbx2').append('Rechazo Parcial');
	}
	init();
	
	//**********************************************************************
	$("#validar").click(function(){
		
		$("#validar").attr("disabled", true);
		var idchk = $.fn.yiiGridView.getChecked('compra-grid', 'aceptadoId'); 
		var idchk2 = $.fn.yiiGridView.getChecked('compra-grid', 'raceptadoId'); 
		//alert(idchk);
		//Cambia de estado a Validado
		
		//$.post(URLVal, {idchk:idchk},function(data){
			//alert(data);			
		//})
				
		
		//Para el primer contenedor de texto(motivo de rechazo)
		var cantidades = new Array;
        var productosid = new Array;
		
		$('.cant').each(function(index) {
        productosid[index] = $(this).attr('id');
        cantidades[index] = $(this).val();
        });
		
		//******************
		
		//Para el segundo contenedor de texto(cantidades rechazadas)
		var cantidad = new Array;
        var ids = new Array;
		//var ids = new Array;
		//var valaux= new Array;
		
		$('.cant2').each(function(index) {
        ids[index] =  $(this).attr('id');
        cantidad[index] = $(this).val();
        });
		//////////////Para el rechazo de productos
		var aux = new Array;
		var cant = new Array;
		for(j=0;j<productosid.length;j++)
		{			
			for(i=0;i<idchk2.length;i++)
			{
				if(productosid[j]==idchk2[i])
				{
				aux[i]=cantidades[j];
				
				}
				
			}
        }
		for(j=0;j<ids.length;j++)
		{			
			for(i=0;i<idchk2.length;i++)
			{
				if(ids[j]==idchk2[i])
				{
				cant[i]=cantidad[j];
				
				}
				
			}
        }
		///// para la comparacion de campos 
		var auxid = new Array;
		
		//var cant = new Array;
		for(j=0;j<productosid.length;j++)
		{			
			for(i=0;i<idchk.length;i++)
			{
				if(productosid[j]==idchk[i])
				{
				auxid[j]=idchk[i];
				
				}
				//else
				//{auxid[j]=0;}
			}
        }
		var auxid2 = new Array;
		for(j=0;j<productosid.length;j++)
		{			
			for(i=0;i<idchk2.length;i++)
			{
				if(productosid[j]==idchk2[i])
				{
				auxid2[j]=idchk2[i];
				
				}
				else
				{auxid2[j]=0;}
				
			}
        }
		///////Para la comparacion de cantidades parciales rechazadas
		var auxidchek = new Array;
		
		//var cant = new Array;
		for(j=0;j<ids.length;j++)
		{			
			for(i=0;i<idchk.length;i++)
			{
				if(ids[j]==idchk[i])
				{
				auxidchek[j]=idchk[i];
				
				}
				
			}
        }
		
		/*
		for(j=0;j<productosid.length;j++)
		{			
			for(i=0;i<idchk.length;i++)
			{
				if(productosid[j]==idchk[i])
				{
				cantidades[j]="ninguno";
				//valaux[j]="ninguno";
				cantidad[j]=0;
				
				}
				
			}
        }
		
		//Fin primer contenedor
		
		
		var aux = new Array;
		
		
		for(j=0;j<productosid.length;j++)
		{			
			for(i=0;i<idchk2.length;i++)
			{
				if(productosid[j]==idchk2[i])
				{
				aux[j]="Parcialmente Rechazado";
				}
				else
				{
				aux[j]="rechazado";
				}
				
			}
        }
		*/
		//Cambia de estado a Parcialmente Rechazado
		//$.post(URLRechp, {idchk2:idchk2,cantidad:cantidad,ids:ids},function(data){
			//alert(data);			
		//})
		
		//for(j=0;j<productosid.length;j++){
			
			//if(cantidad[j]=="")
			//alert("campo vacio en pos"+productosid[j]);
            //alert("posicion: " + j + "id prod: "+ productosid[j] + "cantidad: "+ cantidades[j]);
        //}
		
		$.post(URLComcamp, {productosid:productosid,cantidades:cantidades,aux:aux,idchk:auxid,idchk2:auxid2},function(data){
			
			//alert(data);
			//for(j=0;j<data.length;j++){
			  //alert("posicion: " + data[j]);
			//}
			if(data.length!=0)
			{
			alert("Debe especificar el motivo de rechazo en codigo-producto: \n"+data);
			$("#validar").attr("disabled", false);
			}
			else
			{
			
				$.post(URLComp, {cantidad:cantidad,ids:ids,auxidchek:auxidchek},function(data){
				//alert(data.length);
					if(data.length!=0)
					{
						alert("Las cantidades rechazadas introducidas exceden o son iguales a las cantidades solicitadas en codigo-producto: \n"+data);
						$("#validar").attr("disabled", false);
					}
					else
					{   fact = $("#Compra_nro_factura").val();
                        var idComp=$("#idComp").val();
						$.post(URLVal, {idchk:idchk,factura:fact,compra:idComp},function(data){
						//alert(data);			
		
							//$.post(URLRech,{productosid:productosid,cantidades:cantidades,aux:aux,cantidad:cantidad,idchk:idchk},function(data){
							$.post(URLRechParcial,{idchk2:idchk2,cantidades:cantidades,aux:aux,cantidad:cantidad,idchk:idchk,cant:cant},function(data){
								$.post(URLRechTotal,{idchk:idchk,idchk2:idchk2,productosid:productosid,cantidades:cantidades},function(data){
							
								//alert(data);			
									//$.post(URLNuevaOrden,function(data){
									//alert(data);			
									//})
									var idComp=$("#idComp").val();
									$.post(URLNuevaSolSalida, {idComp:idComp},function(data){
									
										var idComp=$("#idComp").val();
										$.post(URLNuevaOrdenCompra, {idComp:idComp},function(data){
									
											var idComp=$("#idComp").val();
											$.post(URLCambioEstado, {idComp:idComp},function(data){
												//alert(data);
												if(data=="true")
												{alert("Proceso terminado con exito.");
												$("#validar").attr("disabled", false);
												 document.location.href=URLList;}
											
											})
										})
									})
								})
							})
					
						})
					}
				})
			
			
			}
		})
		
		
		
		
		
		/*
		
		for(j=0;j<ids.length;j++){
			
			//if(cantidad[j]=="")
			//alert("campo vacio en pos"+productosid[j]);
            alert("posicion: " + j + "id prod: "+ ids[j] + "cantidad: "+ cantidad[j]);
        }
		*/
		//Fin segundo contenedor
		//location.reload();
	})
	$("#salir").click(function(){
		//$.post(URLValidas,{},function(data){
		document.location.href=URLList;
		//})
	})

})
