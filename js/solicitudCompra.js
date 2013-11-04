
   
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
  

$(document).ready(function(){
   
      
      
    $("#btnEnviar").click(function () {
         var proveedor = $("#proveedor").val();
         var ids = $("#idSolicitud").val();
         if(!isNaN(proveedor)){
             $.post(URLagregarproveedor,{
                    idP: proveedor,
                    idS: ids,
                 },function(data){
                        
                 });
         }
         
           var ficha=document.getElementById("productos");
           var ficha2=document.getElementById("datosSol");
           
                        var ventimp=window.open(' ','popimpr');
                        ventimp.document.write(ficha2.innerHTML);
                        ventimp.document.write(ficha.innerHTML);
                        ventimp.document.close();
                        ventimp.print();
                        ventimp.close();    
                        
                        location.reload();
     });
     
     $('#btnConfirmar').click(function(){
         var ids = $("#idSolicitud").val();
         
         //enviar precios totales
         $.post(URLconfirmar,{
                    idS: ids,
                 },function(data){
                    window.location.href = URLredireccion;  
                 });
        alert(ids); 
     });
    
    

})
 
 