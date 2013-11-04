
   
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
  


function totales(){

    
        var precios = new Array; 
        var cantidades = new Array; 
        var totales = new Array; 
        
        
        var aux = new Array;
        
        $('.precio').each(function(index) {
        if($(this).val() != '')
            precios[index] = $(this).val();
        else
            precios[index] = 0;
        });
        
        $('.cant').each(function(index) {
        if($(this).html() != '')
            cantidades[index] = $(this).html();
        else
            cantidades[index] = 0;
        });
       
        for(j=0;j<cantidades.length;j++){
              aux[j] = parseInt(precios[j]) * parseInt(cantidades[j]);
              alert(precios[j]);
        }
        
        
        $('.totales').each(function(index) {
            //
            //var aux = parseInt(precios[index]) * parseInt(cantidades[index]);
            //alert(aux);
             
            $(this).attr("value",aux[index]);
            $(this).text($(this).attr("value"));        
            
        });
       
                
}
              
  
 
function producto(){
    
    
    var precio_compra = new Array; 
        var cantidades = new Array; 
        var totales = new Array; 
        
        
        var aux = new Array;
        
        $('.precio').each(function(index) {
        if($(this).val() != '')
            precio_compra[index] = $(this).val();
        else
            precio_compra[index] = 0;
        });
        
        
        $('.cant').each(function(index) {
        if($(this).html() != '')
            cantidades[index] = $(this).html();
        else
            cantidades[index] = 0;
        });
     //se saca el precio de compra
    // var precio_compra = $('input[name^="precio_compra"]').map(function(){
      //     return $(this).attr("value"); }).get();
     //se saca la cantidad
     //var cantidad= $('input[name^="cant"]').map(function(){
       //    return $(this).attr("text"); }).get();
   
     var total = $('.total');
   
     var numCantidad;
     var numPrecio;
     var producto;
     //se calculan los nuevos totales y se los guardan en el gridview
     total.each(function(index){
        numCantidad=cantidades[index];
        numPrecio=precio_compra[index];
        producto=(numCantidad*numPrecio);
        $(this).attr("value",producto);
        $(this).text($(this).attr("value"));   
     });
}

function calculaComite(){

    var totales = new Array;
    var numeroComite = 0;
    $('.total').each(function(index) {
        if($(this).html() != '')
            totales[index] = $(this).html();
        else
            totales[index] = 0;
        }); 
     var mayorTotal = 0;
     for(i=0;i<totales.length;i++){
         //alert(totales[i]);
           if(parseFloat(totales[i]) > mayorTotal)
            mayorTotal=  totales[i];
         //alert(totales[i]);
        }
        
     //calcula numeros de miembros del  comite
     
     if(mayorTotal < 1000)
           numeroComite = 2;
     else
        if(mayorTotal < 50000)
            numeroComite = 3;
        else
            if(mayorTotal < 100000)
                numeroComite = 4;
            else
                numeroComite = 6;
                
     return numeroComite;
                
}
           
 
 
 function calculaMayorTotal(){

    var totales = new Array;
    var numeroComite = 0;
    $('.total').each(function(index) {
        if($(this).html() != '')
            totales[index] = $(this).html();
        else
            totales[index] = 0;
        }); 
     var mayorTotal = 0;
     for(i=0;i<totales.length;i++){
         //alert(totales[i]);
           if(parseFloat(totales[i]) > mayorTotal)
            mayorTotal=  totales[i];
         //alert(totales[i]);
        }
        
     //calcula numeros de miembros del  comite
     
     if(mayorTotal < 1000)
           numeroComite = 2;
     else
        if(mayorTotal < 50000)
            numeroComite = 3;
        else
            if(mayorTotal < 100000)
                numeroComite = 4;
            else
                numeroComite = 6;
                
     return mayorTotal;
                
}
  
$(document).ready(function(){
    
    $('#usuarios').hide();
    
    var numeroComite = calculaComite();
    var mayorTotal = calculaMayorTotal();
         
     $('#comite').append("<h1> El mayor total es : " + mayorTotal + "</h1>");
     $('#comite').append("<h1> El numero de miembros del comite debera ser de: " + numeroComite + "</h1>");
     
     var $options = $("#usuarios > option").clone();

     switch(numeroComite){
         
         case(2): $('#comite').append("<div class='field bigF'> <label>Miembro 1 (encargado de compras):</label> <select class ='miembroEncargado' id='usuarioEncargado'> </select> </div>");
                  $('#comite').append("<div class='field bigF'> <label>Miembro 2:</label> <select class ='miembros' id='usuario1'> </select> </div>");
                  break;
         case(3): $('#comite').append("<div class='field bigF'> <label>Miembro 1 (encargado de compras):</label> <select class ='miembroEncargado' id='usuarioEncargado'> </select> </div>");
                  $('#comite').append("<div class='field bigF'> <label>Miembro 2:</label> <select class ='miembros' id='usuario1'> </select> </div>");
                  $('#comite').append("<div class='field bigF'> <label>Miembro 3:</label> <select class ='miembros' id='usuario2'> </select> </div>");
                  break;
         case(4): $('#comite').append("<div class='field bigF'> <label>Miembro 1 (encargado de compras):</label> <select class ='miembroEncargado' id='usuarioEncargado'> </select> </div>");
                  $('#comite').append("<div class='field bigF'> <label>Miembro 2:</label> <select class ='miembros' id='usuario1'> </select> </div>");
                  $('#comite').append("<div class='field bigF'> <label>Miembro 3:</label> <select class ='miembros' id='usuario2'> </select> </div>");
                  $('#comite').append("<div class='field bigF'> <label>Miembro 4:</label> <select class ='miembros' id='usuario3'> </select> </div>");
                  break;
                  
         case(6): $('#comite').append("<div class='field bigF'> <label>Miembro 1 (encargado de compras):</label> <select class ='miembroEncargado' id='usuarioEncargado'> </select> </div>");
                  $('#comite').append("<div class='field bigF'> <label>Miembro 2 (gerente general):</label> <select class ='miembroGerente' id='usuarioGerente'> </select> </div>");
                  $('#comite').append("<div class='field bigF'> <label>Miembro 3:</label> <select class ='miembros' id='usuario1'> </select> </div>");
                  $('#comite').append("<div class='field bigF'> <label>Miembro 4:</label> <select class ='miembros' id='usuario2'> </select> </div>");
                  $('#comite').append("<div class='field bigF'> <label>Miembro 4:</label> <select class ='miembros' id='usuario3'> </select> </div>");
                  $('#comite').append("<div class='field bigF'> <label>Miembro 4:</label> <select class ='miembros' id='usuario4'> </select> </div>");
                  break;
                  
     }
     var en = $('#encargado').val();
     $('#usuarioEncargado').append("<option >Encargado de compras </option>");
     $('#usuarioEncargado').attr('disabled', 'disabled');
     $('#usuarioGerente').append("<option > Gerente General </option>");
     $('#usuarioGerente').attr('disabled', 'disabled');
     $('.miembros').append($options);
      
     $('.precio_compra').keypress(function(){    
     producto();  
     }) ;
     
     $('.precio_compra').keyup(function(){    
     producto();
     }) ;
     
      $('.cantidad').keypress(function(){    
     producto();  
     }) ;
     
     $('.cantidad').keyup(function(){    
     producto();
     }) ;
    
     
    
      
    $("#btnAsignar").click(function () {
        var numeroComite = calculaComite();
    
        var miembros = new Array;
        var aux = new Array;
        var validador  = true;
        var c=0;
        $('.miembros').each(function(index) {
            if($(this).val() != '')
                miembros[index] = $(this).val();
            else
                miembros[index] = 0;
            }); 
         
         for(i=0;i<miembros.length;i++){
             aux[i] = miembros[i];
         }
         
         for(i=0;i<aux.length;i++){
            for(j=0;j<miembros.length;j++)
                if(miembros[j] == aux[i])
                    c++;                     
         }
         
         if(c > miembros.length)
            validador = false;
         
         if(validador == true) {
                var n = 0;
              if(numeroComite == 6)
                n = numeroComite - 2;
              else
                n= numeroComite - 1;
              $.post(URLasignar, {
                   id: $('#idSolicitud').val(),
                   comite: miembros,
                   numero: n,
    
                     },function(data){ 
                        alert(data);  
                 });
         }
         else
            alert("Debe escoger miembros del comite distintos");
         
         
         //alert (solicitud +" "+proveedor);
         //alert(numCotizacion);
         
          
     });
     
     $("#btnCrear").click(function () {
        
        var id= $("#id").val();
 
        var precios = new Array; 
        var cantidades = new Array; 
        var totales = new Array; 
        
        $('.precio').each(function(index) {
        
         if($(this).val() != '')
            precios[index] = $(this).val();
        else
            precios[index] = 0;
        });
        
        $('.cant').each(function(index) {
        if($(this).html() != '')
            cantidades[index] = $(this).html();
        else
            cantidades[index] = 0;
        });
        
        
        $('.totales').each(function(index) {
        if($(this).html() != '')
            totales[index] = $(this).html();
        else
            totales[index] = 0;
        });
        
        for(i=0;i<cantidades.length;i++){
           // alert(precios[i]);
        }
         
         $.post(URLcrear, {
                id: id,
                precios: precios,
             },function(data){ 
                   alert(data);
                   
        //           window.location.href = URLredireccion+"/solicitud/"+solicitud+"/proveedor/"+proveedor+"/numCotizacion/"+numCotizacion;
                   /*
                   $("#tree").empty();
                   initTrees();
                     */
         });
          
     });
     

})
 
 