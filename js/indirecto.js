$('document').ready(function(){
    
    $('#idButtonBuscar').click(function(){
        
        var mes = $('#idInputMes').val();
        var ano = $('#idInputAno option:selected').text();
        
        var act = "S";
	    document.location=dir+"/mes/"+mes+"/ano/"+ano+"/act/"+act+"/idTipoNegocio/"+idTipoNegocio;
	
    });
	
    $('#idButtonAdd').click(function(){
        
        var mes = $('#idInputMes').val();
        var ano = $('#idInputAno option:selected').text();
        var id = $('#idInputIdHidden').val();
        var act = "A";
        var costo = $('#idInputCosto').val();
        var costoId = $('#idInputIdCostoHidden').val();
        var nombre = $('#idInputSeleccionarCosto').val();
	if(costoId.length !=0 && costo!= 0 && costoId.length!=null && costo!=null)
	    document.location=dir+"/mes/"+mes+"/ano/"+ano+"/act/"+act+"/costo/"+costo+"/costo_id/"+costoId+"/nombre/"+nombre+"/idTipoNegocio/"+idTipoNegocio;
	else
	    alert("Es necesario seleccionar el costo indirecto e indicar el costo");
    });
    
    $("#idInputCosto").numeric({ negative: false }, function() {this.value = ""; this.focus(); });
    $('#idInputMes').val(index);
    $('#idInputAno').val(indexget);
    $('#idInputIdCostoHidden').val(costo_id);
    $('#idInputSeleccionarCosto').val(costo_nombre)

	//$('#idInputMes option').eq(index).attr('selected', 'selected');
})