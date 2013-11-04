/**
* author Daniel Aguilar
* 
*/
$(function()
{
	$( "#tabs" ).tabs();
	var aux=$("#aux").val();
	if(aux==0)
	{
		$("#tabs").tabs('select',1);    
	}	
	else
	{
		$("#tabs").tabs('select',0);
	}
});
		todos = new Array();
		function marcar(s) 
		{
			cual=s.selectedIndex;
			for(y=0;y<s.options.length;y++)
			{
				if(y==cual)
				{
					s.options[y].selected=(todos[y]==true)?false:true;
					todos[y]=(todos[y]==true)?false:true;
				}
				else
				{
					s.options[y].selected=todos[y];
				}
			}
		}
		
		// Solo permite ingresar numeros.
	    function soloNumeros(e)
		{
			var key = window.Event ? e.which : e.keyCode
			return (key >= 48 && key <= 57 || key==8 || key==46);
		}
		
		// Validacion de que los campos NO esten vacios
	    function validar(f) 
		{
			if (document.fa.cod.value   == '') 
			{ 
				alert ('INGRESE CODIFICACION'); 
				document.fa.cod.focus();return false;
			}
			if (document.fa.desc.value  == '') 
			{ 
				alert ('INGRESE DESCRIPCION');
				document.fa.desc.focus();return false;
			} 
			if (document.fa.tp.value  == '') 
			{ 
				alert ('INGRESE TIPO DE PRODUCTO');
				document.fa.tp.focus();return false;
			} 
			if (document.fa.pv.value  == '') 
			{ 
				alert ('INGRESE PRECIO VENTA');
				document.fa.pv.focus();return false;
			} 
			if (document.fa.cant.value  == '') 
			{ 
				alert ('INGRESE CANTIDAD MINIMA DESEADA');
				document.fa.cant.focus();return false; 
			}  
			return true;
		}
		
		function change()
		{
			if(document.fa.venta.value=='0')	
			{
				document.fa.pv.readOnly=true;
				document.fa.pv.value='0';
				document.fa.cant.focus();
			}
		else 
		{
			document.fa.pv.readOnly=false;
			document.fa.pv.value='';
			document.fa.pv.focus();
		}    
		
		}
		
/**
* AUTOR aNDRES cORDEIRO
* 
*/
	/*jquery ui para las fechas --> */
	$(function()
	{
	    $( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd" });
	});

	$(function()
	{
	    $( "#datepicker1" ).datepicker({dateFormat: "yy-mm-dd" });
	});

	
/*para controlar campos de las fechas	*/

	function validar(f1) {
			if (document.f1.Fecha_ini.value == '') { alert ('INGRESE FECHA DESDE');
													document.f1.Fecha_ini.focus();return false;}
			if (document.f1.Fecha_fin.value == '') { alert ('INGRESE FECHA HASTA');
													document.f1.Fecha_fin();return false;}										
			if (document.f1.Fecha_ini.value == 'Desde') { alert ('INGRESE FECHA DESDE');
													document.f1.Fecha_ini.focus();return false;}
			if (document.f1.Fecha_fin.value == 'Hasta') { alert ('INGRESE FECHA HASTA');
													document.f1.Fecha_fin.focus();return false;} 												
			if (document.f1.Fecha_fin.value < document.f1.Fecha_ini.value) { alert ('LA FECHA DESDE TIENE QUE SER MENOR A LA FECHA HASTA');
													document.f1.Fecha_fin.focus(); return false;} 										
			return true;
			}

		