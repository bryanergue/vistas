


function agregarEmpleado()
{		
	
	if ($("#empleadoID").val()   == '') 
	{ alert ('INGRESE NOMBRE DE EMPLEADO'); 
	$("#empleadoID").focus();return false;}

	if ($("#actividad").val()   == '') 
	{ alert ('INGRESE ACTIVIDAD'); 
	$("#actividad").focus();return false;}

	if ($("#minutos").val()   == '') 
	{ alert ('INGRESE MINUTOS'); 
	$("#minutos").focus();return false;}

	var idEmp=$("#empleadoID").val().trim();
	var idProd=$("#productoID").val().trim();
	
	if(idProd.length==0)
		idProd=indexProd;
	var mes=$("#mes").val().trim();
	var ano=$("#ano").val().trim();
	var actividad=$("#actividad").val().trim();
	var minutos=$("#minutos").val().trim();

	$.get(URLRegistro ,{idPer:idEmp,idPro:idProd,mes:mes,ano:ano,act:actividad,min:minutos}, function(data)
	{
		//alert (data);
		//document.location=URLapr+"/"+ids;
		document.location=URLRecarga+"/prod/"+idProd+"/mes/"+mes+"/ano/"+ano;
		//location.reload();
	});
}
function agregarEmpleado_()
{		
	if ($("#empleadoID_").val()   == '') 
	{ alert ('INGRESE NOMBRE DE EMPLEADO'); 
	$("#empleadoID_").focus();return false;}

	if ($("#actividad_").val()   == '') 
	{ alert ('INGRESE ACTIVIDAD'); 
	$("#actividad_").focus();return false;}

	if ($("#minutos_").val()   == '') 
	{ alert ('INGRESE MINUTOS'); 
	$("#minutos_").focus();return false;}

	var idEmp=$("#empleadoID").val().trim();
	var idProd=$("#productoID").val().trim();
	if(idProd.length==0)
		idProd=indexProd;
	var mes=$("#mes").val().trim();
	var ano=$("#ano").val().trim();
	var actividad=$("#actividad").val().trim();
	var minutos=$("#minutos").val().trim();
	
	$.get(URLEliminar ,{idPer:idEmp,idPro:idProd,mes:mes,ano:ano,act:actividad,min:minutos}, function(data)
	{
		//alert (data);
		//document.location=URLapr+"/"+ids;
		//document.location=URLRecarga+"/prod/"+idProd+"/mes/"+mes+"/ano/"+ano;
		//location.reload();
		idEmp=$("#empleadoID_").val().trim();
		idProd=$("#productoID").val().trim();
		
		if(idProd.length==0)
			idProd=indexProd;
		//mes=$("#mes_").val().trim();
		//ano=$("#ano_").val().trim();
		actividad=$("#actividad_").val().trim();
		minutos=$("#minutos_").val().trim();

		$.get(URLRegistro ,{idPer:idEmp,idPro:idProd,mes:mes,ano:ano,act:actividad,min:minutos}, function(data)
		{
			//alert (data);
			//document.location=URLapr+"/"+ids;
			document.location=URLRecarga+"/prod/"+idProd+"/mes/"+mes+"/ano/"+ano;
			//location.reload();
		});
	});
	
}

function buscarPorProducto()
{
	var idProd=$("#productoID").val().trim();
	var mes=$("#mes").val().trim();
	var ano=$("#ano").val().trim();
	
	if ($("#productoID").val()   == '') 
	{ alert ('INGRESE PRODUCTO'); 
	$("#productoID").focus();return false;}
	
	document.location=URLRecarga+"/prod/"+idProd+"/mes/"+mes+"/ano/"+ano;
}
function link()
{
	var idProd=$("#productoID").val().trim();
	var mes=$("#mes").val().trim();
	var ano=$("#ano").val().trim();
	document.location=URLLink+"/prod/"+idProd+"/mes/"+mes+"/ano/"+ano;
}

function almacenar(total,costoManoObra)
{
	total=total/60;
	var mes=$("#mes").val().trim();
	var ano=$("#ano").val().trim();
	
	
	$.get(URLAlmacenar ,{idPro:indexProd,mes:mes,ano:ano,total:total,costoManoObra:costoManoObra}, function(data)
	{
		//alert (data);
		//document.location=URLapr+"/"+ids;
		document.location=URLRecarga;
		//location.reload();costoManoObra
	});
}

function imprimir(muestra)
{
	document.getElementById('btnAgregar').style.visibility='hidden';
	document.getElementById('btnBuscar').style.visibility='hidden';
	document.getElementById('btnAlmacenar').style.visibility='hidden';
	document.getElementById('btnImprimir').style.visibility='hidden';
	document.getElementById('link').style.visibility='hidden';
	$('#mes option[value='+indexMes+']').attr('selected', 'selected');
	$('#ano option[value='+indexAno+']').attr('selected', 'selected');
	var ficha=document.getElementById(muestra);
	var ventimp=window.open(' ','popimpr');
	ventimp.document.write(ficha.innerHTML);
	ventimp.document.close();
	ventimp.print();
	ventimp.close();
	document.getElementById('btnBuscar').style.visibility='visible';
	document.getElementById('btnAgregar').style.visibility='visible';
	document.getElementById('btnAlmacenar').style.visibility='visible';
	document.getElementById('btnImprimir').style.visibility='visible';
	document.getElementById('link').style.visibility='visible';
}
