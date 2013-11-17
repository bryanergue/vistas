<?php

//Direccion
$arrayMenu1 = array(
            'items'=>array(
                array('label'=>'Solicitudes de compra',
                'items'=>array(
                    array('label'=>'Ver solicitudes de compra', 'url'=>array('/solicitudCompra/listado',)), 
                    array('label'=>'Ver solicitudes cerradas', 'url'=>array('/solicitudCompra/cerrado')),   
                  ),
                ),
                array('label'=>'Cotizaciones',
                'items'=>array(
                    array('label'=>'Ver listado de cotizaciones', 'url'=>array('/cotizacion/listacotizacion')),
                  ),
                ),
                array('label'=>'Ordenes de Compra',
                'items'=>array(
                    array('label'=>'Crear orden de compra sin cotizacion', 'url'=>array('/compra/inicial')),
                    array('label'=>'Ver listado de ordenes de compra', 'url'=>array('/compra/listado')),
                    array('label'=>'Validar orden de compra', 'url'=>array('/compra/pendiente')), 
                    array('label'=>'Ver ordenes de compra cerradas', 'url'=>array('/compra/validada')),
                    //array('label'=>'Ver ordenes de compra cerradas','url'=>Yii::app()->createUrl("compra/filtrarcompras",array("estados"=>"aprobada"))),
                    array('label'=>'Ver ordenes de compra rechazada','url'=>Yii::app()->createUrl("compra/filtrarcompras",array("estados"=>"rechazada"))),                    
                    //array('label'=>'Ver ordenes de compra rechazada', 'url'=>array('/compra/compraRechazada')),
                  ),
                ),
                          
                array('label'=>'Iniciar Sesion', 'url'=>Yii::app()->createUrl('/site/login',array('service'=>'enncloud')), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),  
            ),
            );
//Encargado de Adquisiciones

$arrayMenu2 = array(
            'items'=>array(
                array('label'=>'Solicitudes de compra',
                'items'=>array(
                    array('label'=>'Ver solicitudes de compra', 'url'=>array('/solicitudCompra/listado',)), 
                    array('label'=>'Ver solicitudes cerradas', 'url'=>array('/solicitudCompra/cerrado')),
                    array('label'=>'Crear cotizacion de solicitud de compra', 'url'=>array('/solicitudCompra/acotizar')),   
                    array('label'=>'Aceptar y rechazar cotizaciones de solicitud de compra', 'url'=>array('/solicitudCompra/cotizado')),
                    array('label'=>'Crear orden de compra a traves de solicitud de compra', 'url'=>array('/solicitudCompra/aprobado')),
                  ),
                ),
                array('label'=>'Cotizaciones',
                'items'=>array(
                    array('label'=>'Crear cotizacion ', 'url'=>array('/cotizacion/create')),
                    //array('label'=>'Aceptar y rechazar cotizaciones', 'url'=>array('/cotizacion/filtrarcotizacion',array('estados'=>'registrada') )),
                    array('label'=>'Aceptar y rechazar cotizaciones','url'=>Yii::app()->createUrl("cotizacion/filtrarcotizacion",array("estados"=>"registrada"))),
                    array('label'=>'Crear orden de compra a traves de una cotizacion','url'=>Yii::app()->createUrl("cotizacion/filtrarcotizacion",array("estados"=>"aprobada"))),
                    //array('label'=>'Crear orden de compra a traves de una cotizacion', 'url'=>array('/cotizacion/aprobada',array('estados'=>'aprobada')) ),
                    array('label'=>'Ver listado de cotizaciones', 'url'=>array('/cotizacion/listacotizacion')),
                  ),
                ),
                array('label'=>'Ordenes de Compra',
                'items'=>array(
                    array('label'=>'Ver listado de ordenes de compra', 'url'=>array('/compra/listado')),
                    array('label'=>'Revisar recepcion de productos, validacion y rechazo', 'url'=>array('/compra/validas')), 
                    array('label'=>'Ver ordenes de compra cerradas', 'url'=>array('/compra/validada')),
                    //array('label'=>'Ver ordenes de compra cerradas','url'=>Yii::app()->createUrl("compra/filtrarcompras",array("estados"=>"aprobada"))),
                    array('label'=>'Ver ordenes de compra rechazada','url'=>Yii::app()->createUrl("compra/filtrarcompras",array("estados"=>"rechazada"))),                    
                    //array('label'=>'Ver ordenes de compra rechazada', 'url'=>array('/compra/compraRechazada')),
                  ),
                ),
                          
                array('label'=>'Iniciar Sesion', 'url'=>Yii::app()->createUrl('/site/login',array('service'=>'enncloud')), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),  
            ),
            );
//Usuario

$arrayMenu3 = array(
            'items'=>array(
                array('label'=>'Solicitudes de compra',
                'items'=>array(
                    array('label'=>'Crear solicitud de compra', 'url'=>array('/solicitudCompra/borrador')),
                    array('label'=>'Ver solicitudes de compra', 'url'=>array('/solicitudCompra/listado',)), 
                    array('label'=>'Ver solicitudes cerradas', 'url'=>array('/solicitudCompra/cerrado')),  
                  ),
                ),
                          
                array('label'=>'Iniciar Sesion', 'url'=>Yii::app()->createUrl('/site/login',array('service'=>'enncloud')), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),  
            ),
            );
//SuperAdmin

$arrayMenu4 = array(
            'items'=>array(
                array('label'=>'Solicitudes de compra',
                'items'=>array(
                    array('label'=>'Crear solicitud de compra', 'url'=>array('/solicitudCompra/nuevo')),
                    array('label'=>'Ver solicitudes de compra', 'url'=>array('/solicitudCompra/listado',)), 
                    array('label'=>'Confirmar solicitudes de compra', 'url'=>array('/solicitudCompra/confirmar',)), 
                    array('label'=>'Aprobar/rechazar solicitudes', 'url'=>array('/solicitudCompra/listadoAprobacion',)), 
                    array('label'=>'Ver solicitudes aprobadas', 'url'=>array('/solicitudCompra/aprobadas')),
                    array('label'=>'Asignar comite a solicitudes', 'url'=>array('/solicitudCompra/asignarComite')),
                    //array('label'=>'Aceptar y rechazar cotizaciones de solicitud de compra', 'url'=>array('/solicitudCompra/cotizado')),
                    //array('label'=>'Crear orden de compra a traves de solicitud de compra', 'url'=>array('/solicitudCompra/aprobado')),
                  ),
                ),
                array('label'=>'Cotizaciones',
                'items'=>array(
                    array('label'=>'Crear cotizacion ', 'url'=>array('/cotizacion/create')),
                    //array('label'=>'Aceptar y rechazar cotizaciones', 'url'=>array('/cotizacion/filtrarcotizacion',array('estados'=>'registrada') )),
                    array('label'=>'Aceptar y rechazar cotizaciones','url'=>Yii::app()->createUrl("cotizacion/filtrarcotizacion",array("estados"=>"registrada"))),
                    //array('label'=>'Crear orden de compra a traves de una cotizacion','url'=>Yii::app()->createUrl("cotizacion/filtrarcotizacion",array("estados"=>"aprobada"))),
                    //array('label'=>'Crear orden de compra a traves de una cotizacion', 'url'=>array('/cotizacion/aprobada',array('estados'=>'aprobada')) ),
                    array('label'=>'Ver listado de cotizaciones', 'url'=>array('/cotizacion/listado')),
                  ),
                ),
                array('label'=>'Ordenes de Compra',
                'items'=>array(
                    array('label'=>'Generar orden de compra', 'url'=>array('/compra/create')),
                    array('label'=>'Ver listado de ordenes de compra', 'url'=>array('/compra/listado')),
                    array('label'=>'Aprobarorden de compra', 'url'=>array('/compra/pendiente')),
                    //array('label'=>'Revisar recepcion de productos, validacion y rechazo', 'url'=>array('/compra/validas')), 
                    //array('label'=>'Ver ordenes de compra cerradas', 'url'=>array('/compra/validada')),
                    //array('label'=>'Ver ordenes de compra cerradas','url'=>Yii::app()->createUrl("compra/filtrarcompras",array("estados"=>"aprobada"))),
                    //array('label'=>'Ver ordenes de compra rechazada','url'=>Yii::app()->createUrl("compra/filtrarcompras",array("estados"=>"rechazada"))),                    
                    //array('label'=>'Ver ordenes de compra rechazada', 'url'=>array('/compra/compraRechazada')),
                  ),
                ),
                array('label'=>'Permisos a usuarios', 'url'=>array('/cruge/ui/rbacusersassignments')),          
                //array('label'=>'Iniciar Sesion', 'url'=>array('/cruge/ui/login')),
                array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),  
            ),
            );
            

?>