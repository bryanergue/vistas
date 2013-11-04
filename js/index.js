$(document).ready(function(){


alert("Cargado");
$(".logout").click(function(){   
alert("Clase logout");     
	$.ajax({	 
	  url: $('#logout').val(),
	  data:  {},
	  type: "POST",
	  success: function(data){
		  alert('Usted ha salido del sistema');
	  }
	 });
});

});
