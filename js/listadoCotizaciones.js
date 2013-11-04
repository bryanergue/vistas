/*
function enviarId()
{
	//alert("IdCotizacion= "+$("#idCotizacion").val());
	
	var idCotizacion=$("#idCotizacion").val();
	
	$.ajax({
	url: URLCotizacionListado,
	data:  {
		idCotizacion: idCotizacion
		},
	type: "POST",
	success: function(data){
	     //alert('Se ha procesado la solicitud de manera correcta');
	     window.location.href = URLCotizacionListado;
	}
	});
	
	
}*/

$(document).ready(function() {
  
  
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
    $("#btnEnviar").click(function()
    {
        if($("#correo").val() == '')
        {
            alert("Ingrese un email");
        }else if(validar_email($("#correo").val()))
        {
            alert("Email valido");
        }else
        {
            alert("El email no es valido");
        }
    });
  
  
  
});


