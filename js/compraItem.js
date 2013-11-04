function soloNumeros(e){
            var key = window.Event ? e.which : e.keyCode
            return (key >= 48 && key <= 57 || key==8 || key==46 )
}

function validar(f) {
            if (document.f.fecha.value  == '') { alert ('INGRESE FECHA');
            document.f.fecha.focus();return false;} 
            
            if (document.f.producto_id.value  == '') { alert ('INGRESE UN PRODUCTO PARA RELACIONAR');
            document.f.producto_id.focus();return false;} 
            
            return true;
}
   
function producto(){
     //se saca el precio de compra
     var precio_compra = $('input[name^="precio_compra"]').map(function(){
           return $(this).attr("value"); }).get();
     //se saca la cantidad
     var cantidad= $('input[name^="cantidad"]').map(function(){
           return $(this).attr("value"); }).get();
   
     var total = $('.total');
   
     var numCantidad;
     var numPrecio;
     var producto;
     //se calculan los nuevos totales y se los guardan en el gridview
     total.each(function(index){
        numCantidad=cantidad[index];
        numPrecio=precio_compra[index];
        producto=(numCantidad*numPrecio);
        $(this).attr("value",(producto));
        $(this).text($(this).attr("value"));   
     });
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
     
    $("#registrarCotizacion").click(function(){    
        //alert(" entro al js");
        var id = $('#id').val();
        var cantidades = new Array;
        var productosid = new Array;
        var validador = true;
        
        $('.cant').each(function(index) {
        productosid[index] = $(this).attr('id');
        cantidades[index] = $(this).val();
        });
        
        
        
        for(j=0;j<cantidades.length;j++){
            if(cantidades[j]=='0' )
                validador = false;
        }
        
        
        /*
        for(j=0;j<productosid.length;j++){
            alert("posicion: " + j + "id prod: "+ productosid[j] + "cantidad: "+ cantidades[j]);
        }
        */
         if(validador == true){
            $.post(URLfinalizar, {
                id: id,
                productosid: productosid,
                cantidades: cantidades,
            },function(data){
                    document.location.href=URLregistrada;
            })
         }
          else{
              alert("Las cantidades no pueden estar en 0");
          }          
              
      
        
    }); 
     
     $("#aprobarCompra").click(function(){    
        //alert(" entro al js");
        var id = $('#compra_id').val();
        var cantidades = new Array;
        var precios = new Array;
        var productosid = new Array;
        var validador = true;
        
        $('.cant').each(function(index) {
        productosid[index] = $(this).attr('id');
        cantidades[index] = $(this).val();
        });
        
        $('.precio').each(function(index) {
        precios[index] = $(this).val();
        });
        
        for(j=0;j<cantidades.length;j++){
            if(cantidades[j]=='0' )
                validador = false;
            if(cantidades[j]=='' )
                validador = false;
            if(precios[j]=='0' )
                validador = false;
            if(precios[j]=='' )
                validador = false;    
        }
        
        
        /*
        for(j=0;j<productosid.length;j++){
            alert("posicion: " + j + "id prod: "+ productosid[j] + "cantidad: "+ cantidades[j]);
        }
        */
        
         if(validador == true){
            $.post(URLaprobada, {
                id: id,
                productosid: productosid,
                cantidades: cantidades,
                precios: precios,
            },function(data){
                    document.location.href=URLlistado;
            })
         }
          else{
               alert("El precio de compra y las cantidades no pueden ser 0");
          }          
              
      
        
    }); 
    
    $("#rechazarCompra").click(function(){    
        //alert(" entro al js");
        var id = $('#compra_id').val();
        var cantidades = new Array;
        var productosid = new Array;
        var validador = true;
        
        $('.cant').each(function(index) {
        productosid[index] = $(this).attr('id');
        cantidades[index] = $(this).val();
        });
        
        
        
        for(j=0;j<cantidades.length;j++){
            if(cantidades[j]=='0' )
                validador = false;
        }
        
         if(validador == true){
            $.post(URLrechazada, {
                id: id,
                productosid: productosid,
                cantidades: cantidades,
            },function(data){
                    document.location.href=URLlistado;
            })
         }
          else{
               alert("El precio de compra y las cantidades no pueden ser 0");
          }          
              
      
        
    }); 
})
 