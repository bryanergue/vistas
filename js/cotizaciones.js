
   
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
        var totalT = 0;
        
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
     
     total.each(function(index) {
        if($(this).html() != '')
            totales[index] = $(this).html();
        else
            totales[index] = 0;
            });
     
     for(j=0;j<totales.length;j++)
        totalT = totalT + parseFloat(totales[j]);
        
     $('#footerTotal').text(totalT);
   
}
           
  
$(document).ready(function(){
    
     
     
     
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
    
     
    var solicitud = $('#solicitud').val();
    $.getJSON(URLgetInfo+"/solicitud/"+solicitud, function(data){
                $.each(data, function(key, val){
                    $('#numCotizacion').attr("value",val.numCotizacion);
                   
                });
    });
    
   
    $("#solicitud").change(function () {
         var solicitud = $('#solicitud').val();
         $.getJSON(URLgetInfo+"/solicitud/"+solicitud, function(data){
                $.each(data, function(key, val){
                    $('#numCotizacion').attr("value",val.numCotizacion);
                   
                });
         });    
     });  
      
    $("#btnNuevo").click(function () {
         var solicitud = $("#solicitud").val();
         var proveedor = $("#proveedor").val();
         var numCotizacion = $("#numCotizacion").val();
         //alert (solicitud +" "+proveedor);
         //alert(numCotizacion);
         $.post(URLcrear, {
                solicitud: solicitud,
                proveedor: proveedor,
                numCotizacion: numCotizacion,
             },function(data){ 
                   //alert(data);
                   window.location.href = URLredireccion+"/solicitud/"+solicitud+"/proveedor/"+proveedor+"/numCotizacion/"+numCotizacion;
                   window.location.href = URLredireccion+"/id/"+data;
                   /*
                   $("#tree").empty();
                   initTrees();
                     */
         });
          
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
 
 