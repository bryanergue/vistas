$(document).ready(function(){
  $("#idInputSeleccionar").focus();
  //$("input[placeholder]").placeholder();
  document.title = 'Modificacion de Existencias';
  $("#idInputCant").numeric({ negative: false }, function() {this.value = ""; this.focus(); });
  
  $("#idButtonCancel").click(function() {
    //$("#idDivForm").slideUp();
    $("#idInputSeleccionar").val("");
    $("#idInputTipo").val("");
    $("#idInputCant").val("");
    $("#idInputRef").val("");
    $("#idInputTipoHidden").val("");
    $("#idInputTipoHidden , #idInputTipo , #idInputCant , #idInputRef , #idInputSeleccionar").removeClass('errorMessage');
    $("#idInfo").html("");
      $("#idInfo").removeClass("error");
  });// End Event Click
  
  $("#idButtonSend").click(function() {
    $("#idInputTipoHidden , #idInputTipo , #idInputCant , #idInputRef , #idInputSeleccionar").removeClass('errorMessage');
    
    var mensaje=" * Por Favor complete el formulario: </br>"
    var nombre=$("#idInputSeleccionar").val();
    var codigo=$("#idInputSeleccionar").val();
    var tipo=$("#idInputTipo").val();
    var cant=$("#idInputCant").val();
    var ref=$("#idInputRef").val();
    var id =$("#idInputTipoHidden").val();
    var error=0;
    if(nombre.length==0){ error++; mensaje=mensaje+"- Producto. </br>" ; $("#idInputSeleccionar").addClass('errorMessage')};
    if(codigo.length==0){ error++ ; $("#idInputSeleccionar").addClass('errorMessage')};
    if(tipo=="Tipo(alta/baja)" || tipo.length==0){ error++ ; mensaje=mensaje+"- Tipo de modificacion. </br>"; $("#idInputTipo").addClass('errorMessage')};
    if(cant.length==0){ error++ ; mensaje=mensaje+"- Cantidad. </br>" ; $("#idInputCant").addClass('errorMessage')};
    if(ref.length==0){ error++ ; mensaje=mensaje+"- Referencia. </br>" ; $("#idInputRef").addClass('errorMessage')};
    //if(id.length==0){ error++ ; $("#idInputTipoHidden").addClass('errorMessage')};
    
    if(error==0){
      $.get( URLAct ,{id:id,codigo:codigo,tipo:tipo,cant:cant,ref:ref,nombre:nombre}, function(data) {
        $("#idInputSeleccionar").val("");
        $("#idInputSeleccionar").val("");
        $("#idInputTipo").val("");
        $("#idInputCant").val("");
        $("#idInputRef").val("");
        $("#idInputTipoHidden").val("");
        location.reload();
      });// End Event $.get()
    }//End if
    else{
      $("#idInfo").html(mensaje);
      $("#idInfo").addClass("error");
    }//End else
  });// End Event click
  
  function testAttribute(element, attribute)
        {
        var test = document.createElement(element);
        if (attribute in test) 
            return true;
        else 
            return false;
        }

        if (!testAttribute("input", "placeholder")) 
        {
          window.onload = function() 
          {
            //busca el input del formulario que necesite el placeholder
            var producto = document.getElementById("idInputSeleccionar");
            //string que se mostrara en el placeholder
            var text_content_p = "Buscador de productos";

            var precio = document.getElementById("idInputCant");
            var text_content_pr = "Cantidad";
			
			var ref = document.getElementById("idInputRef");
            var text_content_ref = "Referencia";

            //se agrega el string al input para que se muestre el string            
            producto.style.color = "gray";
            producto.value = text_content_p;

            precio.style.color = "gray";			
            precio.value = text_content_pr;
			
			ref.style.color = "gray";
            ref.value = text_content_ref;

            //onfocus se elimina el string
            producto.onfocus = function() {
            if (this.style.color == "gray")
            { this.value = ""; this.style.color = "black" }
            }

            precio.onfocus = function() {
            if (this.style.color == "gray")
            { this.value = ""; this.style.color = "black" }
            }
			
			ref.onfocus = function() {
            if (this.style.color == "gray")
            { this.value = ""; this.style.color = "black" }
            }

            //onblur, si es que no se ingreso nada se vuelve a mostrar el string            
            producto.onblur = function() {
            if (this.value == "")
            { this.style.color = "gray"; this.value = text_content_p; }
            }
            
            precio.onblur = function() {
            if (this.value == "")
            { this.style.color = "gray"; this.value = text_content_pr; }
            }
			
			ref.onblur = function() {
            if (this.value == "")
            { this.style.color = "gray"; this.value = text_content_ref; }
            }
          } 
        }  
});// End Event ready

function EsNro(evt)
{
  //var charCode = (evt.which) ? evt.which : event.keyCode;
  //if (charCode > 31 && (charCode < 48 || charCode > 57))
   // return false;
  return true;
};// End function EsNro