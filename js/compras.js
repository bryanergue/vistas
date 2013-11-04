
   
function expRegular(e){
    var tecla;
    tecla = (document.all) ? e.keyCode : e.which;
    if(tecla == 8)
        {return true;}
    var patron;
    patron = /[0-9.]/
    var te;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}


function sumarTotales(){
    
    var cantidades = new Array; 
    var precios = new Array; 
    var totales = new Array; 
    
    var totalC = 0;
    var totalP = 0;
    var totalT = 0;
            
   //Se suman todas las cantidades
   $('.cantidades').each(function(index) {
        if($(this).html() != '')
            cantidades[index] = $(this).html();
        else
            cantidades[index] = 0;
   });
            
   for(j=0;j<cantidades.length;j++)
        totalC = totalC + parseFloat(cantidades[j]);
                     
   $('#footerCantidad').text(totalC);
   //Fin suma cantidades
  
   //Se suman todas los precios
   $('.precios').each(function(index) {
        if($(this).html() != '')
            precios[index] = $(this).html();
        else
            precios[index] = 0;
   });
            
   for(j=0;j<precios.length;j++)
        totalP = totalP + parseFloat(precios[j]);
                     
   //$('#footerPrecio').text(totalP);
   //Fin suma precios
   
   //Se suman todas los totales
   $('.totales').each(function(index) {
        if($(this).html() != '')
            totales[index] = $(this).html();
        else
            totales[index] = 0;
   });
            
   for(j=0;j<totales.length;j++)
        totalT = totalT + parseFloat(totales[j]);
                     
   $('#footerTotal').text(totalT);
   //Fin suma totales

}

  

$(document).ready(function(){
   
      
    sumarTotales();  
   
      $('#btnNuevo').click(function(){
               var ids = $("#idSolicitud").val();
               var numFactura = $("#numFactura").val();
               var numero = $("#numero").val();
         
               $.post(URLnuevo,{
                    idS: ids,
                    numFactura: numFactura,
                    numero: numero,
                 },function(data){
                      //alert(data); 
                      window.location.href = URLredireccion; 
                 });
               
            });

})
 
 