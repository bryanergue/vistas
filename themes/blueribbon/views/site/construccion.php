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
	
  <?php
    echo CHtml::image(Yii::app()->request->baseUrl.'/images/construccion.png','Construccion',array('style'=>'width:714px'));
?>
   
    
</div><!-- END OF .dashIcons -->
                

</div>