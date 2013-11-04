/**
* @author Daniel Aguilar
* 
*/
/*$(function()
{
	alert("1000");
	$( "#tabs" ).tabs();
	var aux=$("#aux").val();
	if(aux==0)
	{
		alert("1");
		$("#tabs").tabs('select',1);    
	}	
	else
	{
		alert("2");
		$("#tabs").tabs('select',0);
	}
});*/

$(function()
			{
				$( "#tabs" ).tabs();
				var xx=$("#idValueH").val();
				if(xx!=null)
				{
					$("#tabs").tabs('select',0);    
				}	
				else
				{
				$("#tabs").tabs('select',1);
				}
			}
		);
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
			if (document.f.cod.value   == '') 
			{ 
				alert ('INGRESE CODIFICACION'); 
				document.f.cod.focus();return false;
			}
			if (document.f.desc.value  == '') 
			{ 
				alert ('INGRESE DESCRIPCION');
				document.f.desc.focus();return false;
			} 
			if (document.f.tp.value  == '') 
			{ 
				alert ('INGRESE TIPO DE PRODUCTO');
				document.f.tp.focus();return false;
			} 
			if (document.f.pv.value  == '') 
			{ 
				alert ('INGRESE PRECIO VENTA');
				document.f.pv.focus();return false;
			} 
			if (document.f.cant.value  == '') 
			{ 
				alert ('INGRESE CANTIDAD MINIMA DESEADA');
				document.f.cant.focus();return false; 
			}  
			return true;
		}
		
		function cambia()
		{		
			if(document.f.venta.value=='0')	
			{
				document.f.pv.readOnly=true;
				document.f.pv.value='0';
				document.f.cant.focus();
			}
		else 
		{
			document.f.pv.readOnly=false;
			document.f.pv.value='';
			document.f.pv.focus();
		}    
		
		}
		
		