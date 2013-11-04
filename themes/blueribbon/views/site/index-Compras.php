<?php  
  $baseUrl = Yii::app()->theme->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile('http://www.google.com/jsapi');
  $cs->registerCoreScript('jquery');
  $cs->registerScriptFile($baseUrl.'/js/jquery.gvChart-1.0.1.min.js');
  $cs->registerScriptFile($baseUrl.'/js/pbs.init.js');
  $cs->registerCssFile($baseUrl.'/css/jquery.css');

?>

<?php $this->pageTitle=Yii::app()->params['titulocom']; ?>

<!-- <h1><i><?php //echo CHtml::encode(Yii::app()->params['titulocom']); ?></i></h1>  -->
<div class="span-23 showgrid">
<div class="dashboardIcons span-16">
	
    <div class="dashIcon span-3">
        <a href="/vistas/solicitudCompra/listado"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-shopping-cart.png" alt="Order History" /></a>
        <div class="dashIconText"><a href="/vistas/solicitudCompra/listado">VER SOLICITUDES DE COMPRA</a></div>
    </div>
  
    
    <div class="dashIcon span-3">
        <a href="/vistas/solicitudCompra/listado"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-list2.png" alt="Customers" /></a>
        <div class="dashIconText"><a href="/vistas/solicitudCompra/listado">APROBAR/RECHAZAR SOLICITUDES</a></div>
    </div>
	
	<div class="dashIcon span-3">
        <a href="/vistas/compra/inicial"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-clipboard.png" alt="Page" /></a>
        <div class="dashIconText"><a href="/vistas/compra/inicial">CREAR COTIZACION</a></div>
    </div>
	
	<div class="dashIcon span-3">
        <a href="/vistas/solicitudCompra/cotizado"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-write.png" alt="Contacts" /></a>
        <div class="dashIconText"><a href="/vistas/solicitudCompra/cotizado">ACEPTAR/RECHAZAR COTIZACIONES</a></div>
    </div>
	
	<div class="dashIcon span-3">
        <a href="/vistas/cotizacion/listacotizacion"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-list.png" alt="Contacts" /></a>
        <div class="dashIconText"><a href="/vistas/cotizacion/listacotizacion">CREAR ORDEN DE COMPRA</a></div>
    </div>        
    
     
    <div class="dashIcon span-3">
        <a href="/vistas/compra/listado"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-shopping-cart4.png" alt="Calendar" /></a>
        <div class="dashIconText"><a href="/vistas/compra/listado">VER ORDENES DE COMPRA</a></div>
    </div>
  
   
    
</div><!-- END OF .dashIcons -->

                

</div>