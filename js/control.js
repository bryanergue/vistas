/**
* @author Daniel Aguilar
* 
*/

$(document).ready(function(){

    function init()
    {
        //colocar cursor al menu
        $("#mainmenu li").css('display', 'none');
        $("#mainmenu li").css('cursor', 'pointer');    
        
        //mostrar el primer nivel
        $("#nivel1 li").show(); 
                
        $("#mainmenu li").click(function(){
        
        //aumentar y disminuir tamaño del mainmenu 
        var h=42;
        var nivel = $("#mainmenu li[id="+this.id+"]").attr("class");
        nivel++;
        $("#mainmenu").css('height',h*nivel);
        
        //Ocultar y mostrar hijos
        $("#mainmenu li[name!=0]").hide();
        
        $("#mainmenu li[name="+$(this).attr('id')+"]").show();
        $("#mainmenu li[name="+$(this).attr('name')+"]").show();
        
        //mostrar padres
        var aux = $("#mainmenu li[id="+this.id+"]").attr("name");
        var aux2=$("#mainmenu li[id="+aux+"]").attr("name");
        if(aux!=0)
        {
            $("#mainmenu li[name="+aux2+"]").show();
        }
        //dar color al menu seleccionada
        $("#mainmenu li[id="+$(this).attr('id')+"]").css("background-image", "url(http://localhost/p01_erp_oit_02/themes/shadow_dancer/images/bg-lite.png)");
        $("#mainmenu li[id!="+$(this).attr('id')+"]").css("background-image", "url(http://localhost/p01_erp_oit_02/themes/shadow_dancer/images/el_bg.png)");
        });
}

init();
});