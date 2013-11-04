$(document).ready(function(){
	function producto(){
	
	var cant=$("#e").val();
	var preciou=$("#prePro").val();
	var total=$("#g").attr("value",(cant*preciou));
	
	$("#g").text($("#g").attr("value"));
	}
	$("#e").keypress(function(){
	producto();
	});

	$("#e").keyup(function(){
	producto();
	});


})