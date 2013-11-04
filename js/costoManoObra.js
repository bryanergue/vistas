function buscarPorFecha()
{
	if ($("#mes").val()   == 0) 
	{alert ('SELECCIONE MES');
	return false;}

	if ($("#ano").val()   == 0) 
	{ alert ('SELECCIONE A&Ntilde;O'); 
	return false;}
	
	var mes=$("#mes").val().trim();
	var ano=$("#ano").val().trim();
	document.location=URLRecarga+"/mes/"+mes+"/ano/"+ano;
}

function agregarEmpleado()
{		
	if ($("#empleadoID").val()   == '') 
	{ alert ('INGRESE NOMBRE DE EMPLEADO'); 
	$("#empleadoID").focus();return false;}

	if ($("#horasMes").val()   == '') 
	{ alert ('INGRESE HORAS/MES'); 
	$("#horasMes").focus();return false;}

	if ($("#pagoMes").val()   == '') 
	{ alert ('INGRESE PAGO MENSUAL'); 
	$("#pagoMes").focus();return false;}
	
	if ($("#horasProdMes").val()   == '') 
	{ alert ('INGRESE HORAS PRODUCCION/MES'); 
	$("#horasProdMes").focus();return false;}

	var horas=$("#horasMes").val();
	var horasProd=$("#horasProdMes").val();
	var diferencia=horas-horasProd;
	if (diferencia<0)
	{
		alert("HORAS PRODUCCION="+horasProd+" NO PUEDE SER MAYOR A HORAS/MES="+horas); 
		$("#horasProdMes").focus();return false;
	}
	
	var idEmp=$("#empleadoID").val().trim();
	//var idProd=$("#productoID").val().trim();
	
	//if(idProd.length==0)
	//	idProd=indexProd;
	
	var horasMes=$("#horasMes").val().trim();
	var pagoMes=$("#pagoMes").val().trim();
	if(tipoNegocio=='1')
		var horasProdMes=$("#horasProdMes").val().trim();
	else
		var horasProdMes='0';
	$.get(URLRegistro ,{idPer:idEmp,mes:indexMes,ano:indexAno,horasMes:horasMes,pagoMes:pagoMes,horasProdMes:horasProdMes,tipoNegocio:tipoNegocio}, function(data)
	{
		if(data.length!=0)
			alert (data);
		//document.location=URLapr+"/"+ids;
		document.location=URLRecarga+"/mes/"+indexMes+"/ano/"+indexAno;
		//location.reload();
	});
	
	
}

function almacenar(directo,indirecto,totalHorasProd)
{
	$.get(URLAlmacenar ,{mes:indexMes,ano:indexAno,directo:directo,indirecto:indirecto,totalHorasProd:totalHorasProd}, function(data)
	{
		document.location=URLRecarga;
	});
}

function agregarEmpleado_()
{		
	if ($("#empleadoID").val()   == '') 
	{ alert ('INGRESE NOMBRE DE EMPLEADO'); 
	$("#empleadoID").focus();return false;}

	if ($("#horasMes").val()   == '') 
	{ alert ('INGRESE HORAS/MES'); 
	$("#horasMes").focus();return false;}

	if ($("#pagoMes").val()   == '') 
	{ alert ('INGRESE PAGO MENSUAL'); 
	$("#pagoMes").focus();return false;}
	
	if ($("#horasProdMes").val()   == '') 
	{ alert ('INGRESE HORAS PRODUCCION/MES'); 
	$("#horasProdMes").focus();return false;}

	var horasProd=0;
	var horas=$("#horasMes").val();
	if(tipoNegocio=='1')
		var horasProdMes=$("#horasProdMes").val().trim();
	else
		var horasProdMes=0;
	var diferencia=horas-horasProd;
	if (diferencia<0)
	{
		alert("HORAS PRODUCCION="+horasProd+" NO PUEDE SER MAYOR A HORAS/MES="+horas); 
		$("#horasProdMes").focus();return false;
	}
	
	var idEmp=$("#empleadoID").val().trim();	
	var horasMes=$("#horasMes").val().trim();
	var pagoMes=$("#pagoMes").val().trim();
	if(tipoNegocio=='1')
		var horasProdMes=$("#horasProdMes").val().trim();
	else
		var horasProdMes='0';
	var mes=$("#mes").val().trim();
	var ano=$("#ano").val().trim();
	$.get(URLEliminar ,{idPer:idEmp,horas:horas,pago:pagoMes,horasProd:horasProd,mes:mes,ano:ano,tipoNegocio:tipoNegocio}, function(data)
	{
		var idEmp=$("#empleadoID_").val().trim();
		var horasMes=$("#horasMes_").val().trim();
		var pagoMes=$("#pagoMes_").val().trim();
		if(tipoNegocio=='1')
			var horasProdMes=$("#horasProdMes").val().trim();
		else
			var horasProdMes='0';
		$.get(URLRegistro ,{idPer:idEmp,mes:indexMes,ano:indexAno,horasMes:horasMes,pagoMes:pagoMes,horasProdMes:horasProdMes,tipoNegocio:tipoNegocio}, function(data)
		{
			document.location=URLRecarga+"/mes/"+indexMes+"/ano/"+indexAno;
		});
	});
}
function almacenarConstoInderecto(pago)
{
	$.get(URLAlmacenar ,{mes:indexMes,ano:indexAno,pago:pago}, function(data)
	{
		document.location=URLRecarga;
	});
}

function imprimir(muestra)
{
	document.getElementById('btnAgregar').style.visibility='hidden';
	document.getElementById('btnBuscar').style.visibility='hidden';
	document.getElementById('btnAlmacenar').style.visibility='hidden';
	document.getElementById('btnImprimir').style.visibility='hidden';
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
}
