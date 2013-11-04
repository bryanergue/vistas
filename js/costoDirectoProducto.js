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

function info(){
    var x = 6342;
   return x;
}

function total(){
    var costos = new Array;
    var cantidades = new Array;
    var total = 0 ;
    var totalCant = 0 ;
    var costoDirecto = 0;
        
    $('.costos').each(function(index) {
        costos[index] = $(this).attr('id');
    });
        
    $('.cantidad').each(function(index) {
        cantidades[index] = $(this).attr('id');
    });
    
    for(j=0;j<costos.length;j++)
        total = total + parseFloat(costos[j]);
    
    for(j=0;j<cantidades.length;j++)
        totalCant = totalCant + parseFloat(cantidades[j]);
    
    
   // total = total.toFixed(2);
    
    $('.footerC').each(function(index){
        $(this).attr("value",(total));
        $(this).text($(this).attr("value"));   
    });
    
    
    $('.footerCant').each(function(index){
        $(this).attr("value",(totalCant));
        $(this).text($(this).attr("value"));   
    });
    
    if(total != 0 && totalCant != 0){
        costoDirecto = total / totalCant;
        costoDirecto = costoDirecto.toFixed(2);
        $('#total2').attr("value",(costoDirecto));
        $(this).text($(this).attr("value"));
        
    }
        
    else{
        $('#total2').attr("value",(0));
        $(this).text($(this).attr("value"));
        
    }
    
    $('#totalCostoDirecto').attr("value",(costoDirecto));
        $(this).text($(this).attr("value"));
    
  

}

function totalR(){
    var precio_compra =  $('#precio_compra').val();
    var cantidad = $('#cantidad').val();
    if(cantidad == '' || cantidad == 0){
        //alert('cantidad vacia');
        total = 0;
        $('#totalCostoDirectoR').attr("value",(total));
        $(this).text($(this).attr("value"));
        $('#precio_compra').attr("value",precio_compra);
        $(this).text($(this).attr("value"));
        $('#cantidad').attr("value",cantidad);
        $(this).text($(this).attr("value"));
        
        
    }
    else{
            
        var total = precio_compra/cantidad;
        total = total.toFixed(2);
        $('#totalCostoDirectoR').attr("value",(total));
        $(this).text($(this).attr("value"));  
        $('#precio_compra').attr("value",precio_compra);
        $(this).text($(this).attr("value"));
        $('#cantidad').attr("value",cantidad);
        $(this).text($(this).attr("value"));
          
    }        
    
}   
              
              
  
function selectMes(combo,val){
    for(var indice=0 ;indice<document.getElementById(combo).length;indice++)
    {
        if (document.getElementById(combo).options[indice].value == val )
            document.getElementById(combo).selectedIndex = indice;
    }
}

function selectAnio(combo,val){
    for(var indice=0 ;indice<document.getElementById(combo).length;indice++)
    {
        if (document.getElementById(combo).options[indice].value == val )
            document.getElementById(combo).selectedIndex = indice;
    }
}


 $(document).ready(function(){
     
     
     total();
     $("#mesImp").hide();
     $("#mesImpR").hide();
     $("#anioImp").hide();
     $("#anioImpR").hide();
     
     
     $('#precio_compra').keypress(function(){    
     totalR();  
     }) ;
     
     $('#precio_compra').keyup(function(){    
     totalR();
     }) ; 
         
     $('#cantidad').keypress(function(){    
     totalR();  
     }) ;
     
     $('#cantidad').keyup(function(){    
     totalR();
     }) ; 
    
     
     $("#btnBuscar").click(function(){    
        var mes = $('#mes').val();
        var anio= $('#anio').val();
        var producto = $('#producto_id').val();
        var validador = true;
      
        var costos = new Array;
        var total = 0 ;
        
         if(mes == 'null')     {
               validador = false;
         }
         if(anio== 'null') {
               validador = false;
         }
         if(producto == 'null' || producto == ''){
               validador = false;
         }
                      
         if(validador == true){
             
             $.post(URLbuscarproducto, {
                mes: mes,
                anio: anio,
                producto: producto,
            },function(data){ 
                    if (data == true) {
                        var r = confirm("No se encontro ningun producto en esa fecha, ¿Registrarlo ahora?");
                        if (r == true){
                                document.location.href=URLregistro+"?mes="+mes+"&anio="+anio+"&producto="+producto;
                        }          
                        else
                          {
                          //alert("sin registro");
                          }
                    }
                    else {
                        document.location.href=URLcarga+"?mes="+mes+"&anio="+anio+"&producto="+producto;                             
                    }
            }) 
         
         }
         else{
             alert('Debe seleecionar: mes,año y producto')
         }     
                       
    });
    
    $("#btnAlmacenar").click(function(){
        //$.fn.yiiGridView.update("producto-grid");
       var mes = $('#mes').val();
       var anio= $('#anio').val();
       var producto = $('#producto_id').val();
       var total = $('#totalCostoDirecto').val();
       
       $.post(URLalmacenar, {
                mes: mes,
                anio: anio,
                producto: producto,
                total: total,
       },function(data){ 
            alert(data);
            
       }); 
    
    
    });
    
    $("#btnAlmacenarR").click(function(){
        var mes = $('#mesR').val();
        var anio= $('#anioR').val();
        var producto = $('#producto_id').val();
        var precio_compra =  $('#precio_compra').val();
        var cantidad = $('#cantidad').val();        
        var validador = true;
      
        if(precio_compra == '')     {
               validador = false;
        }
        if(cantidad == '') {
               validador = false;
        }
                      
        if(validador == true){
             var total = precio_compra/cantidad;
             total = total.toFixed(2);
             $('#totalCostoDirectoR').attr("value",(total));
              $(this).text($(this).attr("value"));
             
             
              $.post(URLalmacenar, {
                mes: mes,
                anio: anio,
                producto: producto,
                total: total,
               },function(data){ 
                    alert("Costo directo total almacenado");
                    
               });  
                      
             
        }
        else{
           alert('Debe ingresar Precio de Compra y Cantidad') 
        }
        
    });
    
    $("#btnImprimir").click(function(){
        //alert("hola");
        $("#btnBuscar").hide();        
        $("#btnAlmacenar").hide();
        $("#btnImprimir").hide();
        $("#mes").hide();
        $("#anio").hide();
        $("#mesImp").show();
        $("#anioImp").show();
        
        var ventimp=window.open(' ','popimpr');
        ventimp.document.write($("#tabs-1").html());
        ventimp.document.close();
        ventimp.print();
        ventimp.close();
        $("#btnBuscar").show();        
        $("#btnAlmacenar").show();
        $("#btnImprimir").show();
        $("#mes").show();
        $("#anio").show();
        $("#mesImp").hide();
        $("#anioImp").hide();
      
    });
    
    $("#btnImprimirR").click(function(){
        $("#btnAlmacenarR").hide();
        $("#btnImprimirR").hide();
        $("#mesR").hide();
        $("#anioR").hide();
        $("#mesImpR").show();
        $("#anioImpR").show();
        
        var ventimp=window.open(' ','popimpr');
        ventimp.document.write($("#tabs-1").html());
        ventimp.document.close();
        ventimp.print();
        ventimp.close();
        $("#btnAlmacenar").show();
        $("#btnImprimir").show();
        $("#mesR").show();
        $("#anioR").show();
        $("#mesImpR").hide();
        $("#anioImpR").hide();
    
    });
     
     
})
 