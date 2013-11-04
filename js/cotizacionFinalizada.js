$(document).ready(function(){
 
    function validar_email(valor){
        // creamos nuestra regla con expresiones regulares.
        var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        // utilizamos test para comprobar si el parametro valor cumple la regla
        if(filter.test(valor)){
            return true;}
        else{
            return false;}
    }
	
    // cuando presionamos el boton verificar
    $("#enviar").click(function(){
        if($("#email").val() == ''){
            alert("Ingrese email");
        }
	else{
		if(validar_email($("#email").val())){
			var div=$('#muestra').html();
			var mail=$("#email").val();			
			$.post( URLAct ,{div:div, mail:mail ,subject:subject}, function(data) {
			alert(data);
			});
		}
		else{
			alert("El email no es valido");
		}
	 }
    });
    
    $( "#tabs" ).tabs();
    
 
});