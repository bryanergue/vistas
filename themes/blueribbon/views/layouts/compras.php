<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tables.css" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu_iestyles.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/scroller.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/chosen.css" media="screen" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tooltipsy.min.js"></script>
   <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.scrollerota.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/chosen.jquery.min.js"></script>
    
    
</head>

<body>

  <script type="text/javascript">
  /*    
   $(document).ready(function() {  // Handler for .ready() called.
   
       $("#glos").click(function() {  
       
       $(function() {    $( "#dialog-modal" ).dialog({      height: 450, width:600,      modal: true    });  }); 
   
         });
         
          $("#help").click(function() {  
       
       $(function() {    $( "#scrollerota" ).dialog({      height: 480, width:640,      modal: true, resizable:false    });  }); 
   
         });
         
             $("#scrollerota").scrollerota({
            width: 640,
            height: 480,
            padding: 10,    
            speed: 2000,
            timer: 20000,
            slideshow: true,
            easing: 'easeInOutQuart'
        });

   
   $('.hastip').tooltipsy({
    offset: [0, 10],
    css: {
        'padding': '10px',
        'max-width': '200px',
        'color': '#303030',
        'background-color': '#f5f5b5',
        'border': '1px solid #deca7e',
        '-moz-box-shadow': '0 0 10px rgba(0, 0, 0, .5)',
        '-webkit-box-shadow': '0 0 10px rgba(0, 0, 0, .5)',
        'box-shadow': '0 0 10px rgba(0, 0, 0, .5)',
        'text-shadow': 'none'
    }
});
   });
      */
  </script>
  
  
<div class="container" id="page">
    <div id="topnav">
        <div class="topnav_text">
        <a href='/vistas/index.php'>Inicio</a> | 
        
        <?php if(Yii::app()->user->isGuest):?>
        <a href="<?php echo Yii::app()->createUrl('/cruge/ui/login')?>">Iniciar Sesion</a> 
        <?php else:?>
        <a class="logout" href="<?php echo Yii::app()->createUrl('/site/logout')?>">Salir</a>
        <?php endif;?>
        </div>
    </div>
    <div id="header">
        <div id="TitApp" class="titApp"><?php echo CHtml::link(CHtml::encode(Yii::app()->params['titulocom']),Yii::app()->createUrl("site/indexCompras")); ?></div>
        
        
        
    </div><!-- header -->
   
 
<?php 
include_once("listaMenucom.php");    
$rol=0;
if(Yii::app()->user->checkAccess('Usuario'))
{$rol=3;}
if(Yii::app()->user->checkAccess('Adquisiciones'))
{$rol=2;}
if(Yii::app()->user->checkAccess('Direccion'))
{$rol=1;}
if(Yii::app()->user->checkAccess('SuperUsuario'))
{$rol=4;}

switch($rol)
{
 case(1): {    //Direccion
     $this->widget('application.extensions.mbmenu.MbMenu',$arrayMenu1); 
     break;
 }
  case(2): {   //Almacen
     $this->widget('application.extensions.mbmenu.MbMenu',$arrayMenu2); 
     break;
 }
  case(3): {   //Solicitante
     $this->widget('application.extensions.mbmenu.MbMenu',$arrayMenu3); 
     break;
 }
 case(4): {   //SuperAdmin
     $this->widget('application.extensions.mbmenu.MbMenu',$arrayMenu4); 
     break;
 }
 default: {
     /*
     echo '<div class="flash-error">';
     echo "Usted no tiene asignado ningun rol, por favor contactese con su administrador";
     echo '</div>';
     */
     $this->widget('application.extensions.mbmenu.MbMenu',$arrayMenu4); 
     
     break;    
 }
     
}
     ?> 
 
    <!--
    <div id="mainmenu">
    </div>
    -->
     <!--mainmenu -->
    <div class="breadcrumbsCont">
    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif?>
    </div>

    <?php echo $content; ?>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by <?php echo CHtml::encode(Yii::app()->params['footer']); ?><br/>
        All Rights Reserved.<br/>
    </div><!-- footer -->
</div><!-- page -->

</body>
</html>