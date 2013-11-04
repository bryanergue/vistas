function EsNro(valor){
var nro = new RegExp("^[0-9.]{1,12}$","g");
return nro.test(valor)
};

function EsVacio(valor){
if (valor == "") return true
else return false;
};

function trim (myString)
{
return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
}

function decimales(e) { 
tecla= (e.which) ? e.which : window.event.keyCode; 
if ((tecla<48 || tecla>57) && tecla !=46 && tecla !=8)
return false
else
return true
}

function isDiferencia() {  
 
	var my_array = '<?php echo CJSON::encode($array);?>';
	  alert(my_array);
	var real = document.getElementById("real");
	var cantidad = document.getElementById("cantidad");
	var diferencia = document.getElementById("diferencia");	
	alert("diferencia="+diferencia);  
	document.getElementById("diferencia").innerHTML = "algo";
} 
 $(document).ready(function(){

 function updateDataBase(){
 
 //alert("teststr: " + teststr);
 //$('.diferencia').text("teststr: " + teststr);
 
 //$.get('/index.php?r=inventario/create&activeTab=tab2',{} ,function(data){
 // alert(data);
 // }); 
 //$.GET('url',{option:option,id:1 }, function(data){ 
 //}); 
 }
 
 
 function DiferenciaReal(){
 
var real = $('input[name^="cantidad_real"]').map(function(){
		   return $(this).attr("value"); }).get();

var cantidad = $('.cantidad').map(function(){
                    var cant=$(this).html();
                    return cant; }).get();

var diferencia = $('.diferencia');

var productosIds = $('.id').map(function(){
                    var proId=$(this).html();
                    return proId; }).get();

var numCantidad;
var numReal;
var resta;
diferencia.each(function(indexDif){
    numCantidad=cantidad[indexDif];
    numReal=real[indexDif];
	resta=(numCantidad-numReal);
    $(this).attr("value",(resta));
    $(this).text($(this).attr("value"));   
  });
 }

 
 //Validate only numbers
 $('.qreal').keypress(function(event){    
     return decimales(event);
 }) ;
 
 $('.qreal').keyup(function(){ 
     return decimales(event);
 }) ;
 
 
 
 $('.cantidad_real').keypress(function(){	
 DiferenciaReal();  
 updateDataBase();}) ;
 
 $('.cantidad_real').keyup(function(){	
 DiferenciaReal();
updateDataBase() }) ;
 
 
$("#procesar").click(function(){    
    //alert($('#idinv').val());
    var productosid = new Array;
    var cantidadlog = new Array;
    var cantidadreal = new Array; 
    var validador = true;
    
    $('.qreal').each(function(index) {
    productosid[index] = $(this).attr('id');
    });
    
    $('.cantidad').each(function(index) {
    cantidadlog[index] = $(this).html();
    });    
    
    $('.qreal').each(function(index) {
    cantidadreal[index] = $(this).val();
    if(trim($(this).val())=="")
    {validador=false;}
    });   
 
 //llamada ajax
 if (validador == true)
 { 
 $.ajax({
  url: $('#ruta').val(),
  data:  {id: $('#idinv').val(),
          productosid: productosid,
          cantidadlog: cantidadlog,
          cantidadreal: cantidadreal,  
         },
  type: "POST",
  success: function(data){
      alert('Se ha procesado la solicitud de manera correcta');
      window.location.href = $('#ruta1').val();
     
      
  }
  });
  
 //fin llamada ajax   
 }
 else
 {
     alert("Por favor complete todos los campos");
 }
});

 
 });
 