
$('document').ready(function(){
    
	$('#cotizacion-grid').on('click', '.btnEliminar', function() {
	
      var mes_full = $('#mes_full').val();
      var ano_full = $('#ano_full').val();
      var act = "S"; 
      var idTipoNegocio= $('#idTipoNegocio').val();
	  
	  var idDepreciable = $.fn.yiiGridView.getKey('cotizacion-grid',
        $(this).closest('tr').prevAll().length);	
		
	  /*alert(
	    "URLEliminar="+URLEliminar+"\n"+
		"mes_full="+mes_full+"\n"+
		"ano_full="+ano_full+"\n"+
		"idDepreciable="+idDepreciable+"\n"+
		"idTipoNegocio="+idTipoNegocio+"\n");*/
		
		$.post(URLEliminar, {
			idDepreciable: idDepreciable, 
			mes_full:mes_full,
			ano_full:ano_full,
			idTipoNegocio:idTipoNegocio
		})
        .success(function() { 
				alert("Datos guardados correctamente.");
				//$.fn.yiiGridView.update("cotizacion-grid");
				document.location=URLIndirecto+"/mes/"+mes_full+"/ano/"+ano_full+"/act/"+act+"/idTipoNegocio/"+idTipoNegocio; 
				})
		.error(function() { 
		     	alert("Error en la base de datos."); })			  
					  
       }); 	
		
    $('#AGREGAR').click(function(){   
        var vidaUtil = $('#vidaUtil').val();
        var costoInicial = $('#costoInicial').val();
        var detalleProducto = $('#detalleProducto').val();  
        var nombreProducto = $('#nombreProducto').val();  
        
        var mes_full = $('#mes_full').val();
        var ano_full = $('#ano_full').val();
        var act = "S"; 
		var idTipoNegocio= $('#idTipoNegocio').val();
        
		/*alert("vidaUtil="+vidaUtil+"\n"+
		"costoInicial="+costoInicial+"\n"+
		"productoDepreciableNom="+productoDepreciableNom+"\n"+
		"detalleProducto="+detalleProducto+"\n"+
		"nombreProducto="+nombreProducto+"\n"+
		"id_full="+id_full+"\n"+
		"mes_full="+mes_full+"\n"+
		"ano_full="+ano_full+"\n"+
		"idTipoNegocio="+idTipoNegocio+"\n");*/
		
        $.post(URLGuardar, {
           vidaUtil: vidaUtil,           
           costoInicial:costoInicial,
           nombreProducto:nombreProducto,
           detalleProducto:detalleProducto,   
           mes_full:mes_full,
           ano_full:ano_full,
           idTipoNegocio:idTipoNegocio
          })
          .success(function() { 
              alert("Datos guardados correctamente.");
			  //$.fn.yiiGridView.update("cotizacion-grid");
              document.location=URLIndirecto+"/mes/"+mes_full+"/ano/"+ano_full+"/act/"+act+"/idTipoNegocio/"+idTipoNegocio;
			  })
         .error(function() { 
              alert("Datos ya existen en la base de datos."); })
    });  

 //Para almacenar productos
  $('#ALMACENAR').click(function(){ 
   var superTotal = $('#superTotal').val();
   var mes_full = $('#mes_full').val();
   var ano_full = $('#ano_full').val();
   var act = "S";
   var manoObraIndirecto=$('#manoObraIndirecto').val();
   var idTipoNegocio= $('#idTipoNegocio').val();
   
   if(manoObraIndirecto!=0) {  
   
     $.post(URLCalculo, {
           superTotal:superTotal,
           mes_full:mes_full,
           ano_full:ano_full, 
		   idTipoNegocio:idTipoNegocio
          })
          .success(function() { 
              alert("Datos guardados correctamente.");
              document.location=URLIndirecto+"/mes/"+mes_full+"/ano/"+ano_full+"/act/"+act+"/idTipoNegocio/"+idTipoNegocio; })
         .error(function() { 
              alert("Error al guardar en la base de datos."); })
			  
    } else {alert("Debe seleccionar un producto y/o agregar mano de obra inidrecto");}
  
  }); 
    
})


function validate(evt) {
	  var theEvent = evt || window.event;
	  var key = theEvent.keyCode || theEvent.which;
	  key = String.fromCharCode( key );
	  var regex = /[0-9]|\./;
	  if( !regex.test(key) ) {
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	  }
    }