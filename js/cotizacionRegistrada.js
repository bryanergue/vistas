$(document).ready(function(){

function imprSelec(muestra)
	{
		var ficha=document.getElementById(muestra);
		var ventimp=window.open(' ','popimpr');
		ventimp.document.write(ficha.innerHTML);
		ventimp.document.close();
		ventimp.print();
		ventimp.close();
	}

    function validar_email(valor)
    {
        // creamos nuestra regla con expresiones regulares.
        var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        // utilizamos test para comprobar si el parametro valor cumple la regla
        if(filter.test(valor))
            return true;
        else
            return false;
    }
    // cuando presionamos el boton verificar
    $("#enviar").click(function()
    {
        if($("#email").val() == '')
        {
            alert("Ingrese email");
        }
	else
	{
		if(validar_email($("#email").val()))
	        {
			//alert("Email valido");
			var div=$('#muestra').html();
			var mail=$("#email").val();			
			$.post( URLAct ,{div:div, mail:mail}, function(data) {
			alert(data);
			});
		}
		else
		{
			alert("El email no es valido");
		}
	}
    });
 
});