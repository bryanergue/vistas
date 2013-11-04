function EsNro(valor){
var nro = new RegExp("^[0-9.]{1,12}$","g");
return nro.test(valor)
};

function EsVacio(valor){
if (valor == "") return true
else return false;
};

function isDiferencia() {  
    alert("Hola");  
	var my_array = '<?php echo CJSON::encode($array);?>';
	  alert(my_array);
	var real = document.getElementById("real");
	var cantidad = document.getElementById("cantidad");
	var diferencia = document.getElementById("diferencia");	
	alert("diferencia="+diferencia);  
	document.getElementById("diferencia").innerHTML = "algo";
} 
 $(document).ready(function(){
 
 
 function DiferenciaReal(id){
	            
 alert($(this).attr('id')) ;            
                
                 /*
  var real = $('input[name^="cantidad_real"]');
	   var cantidad =$('.cantidad');
	   var diferencia =$('.diferencia');
	   
		   cantidad.each(function(index) {
		     var numCantidad=$(this).html();
			 //FOR REAL
			  real.each(function(indexReal){			  
			    var numReal=$(this).attr("value");
			    if(indexReal==index){
				  //FOR DIF
				    diferencia.each(function(indexDif){	
					  var numdif=diferencia.html();					  
					  if(indexReal==indexDif){	
					   $(this).attr("value",(numCantidad-numReal));
					   $(this).text($(this).attr("value"));
					   return false}	
					});
					//FOR DIF END
				  return false}		      
			    });
			 //FOR REAL END
			});      */

 }//DiferenciaReal 

 $('.cantidad_real').click(function(){	
           alert($(this).val());
           alert($(this).attr['value']);

 }) ;
 
 $('.cantidad_real').keyup(function(){	
 //DiferenciaReal();  
 alert($(this).attr('value'));
 }) ;
 
 })
 
 
 