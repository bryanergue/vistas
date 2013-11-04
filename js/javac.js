$(document).ready(function(){
	$("#aprobar").click(function(){
		
		var idSol=$("#idSol").val();
		var idCot=$("#idCot").val();
		//alert(idSol);
		$.post(URLApro, {idSol:idSol,idCot:idCot},function(data){
			//alert(data);
			document.location.href=URLindex;
		})
		
		
	})
	$("#rechazar").click(function(){
	
		var idSol=$("#idSol").val();
		var idCot=$("#idCot").val();
		//alert(idSol);
		$.post(URLRech, {idSol:idSol,idCot:idCot},function(data){
			//alert(data);
			document.location.href=URLindex;
		})
		
	})
	
	$("#salir").click(function(){
		
		document.location.href=URLindex;
	})
	
	$("#gcompra").click(function(){
		
		document.location.href=URLCompra;
	})
	

	$("#finalizada").click(function(){
	
		var idSol=$("#idSol").val();
		var idCot=$("#idCot").val();
		//alert(idSol);
		$.post(URLFin, {idSol:idSol,idCot:idCot},function(data){
			//alert(data);
			document.location.href=URLindex;
		})
	})
	
	

})