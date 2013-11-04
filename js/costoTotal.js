$(document).ready(function(){     
     $("#mesImp").hide();
     $("#anioImp").hide();
})

	function mes(combo,val){
		for(var indice=0 ;indice<document.getElementById(combo).length;indice++)
		{
			if (document.getElementById(combo).options[indice].value == val )
				document.getElementById(combo).selectedIndex = indice;
		}	
	}
	function imprSelec(muestra)
	{
		$("#mes").hide();
        $("#ano").hide();
		$("#mesImp").show();
        $("#anioImp").show();
		var ficha=document.getElementById(muestra);
		var ventimp=window.open(' ','popimpr');
		ventimp.document.write(ficha.innerHTML);
		ventimp.document.close();
		ventimp.print();
		ventimp.close();
	}


	