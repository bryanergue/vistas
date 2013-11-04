<?php  
  $baseUrl = Yii::app()->theme->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile('http://www.google.com/jsapi');
  $cs->registerCoreScript('jquery');
  $cs->registerScriptFile($baseUrl.'/js/jquery.gvChart-1.0.1.min.js');
  $cs->registerScriptFile($baseUrl.'/js/pbs.init.js');
  $cs->registerCssFile($baseUrl.'/css/jquery.css');

?>

<?php $this->pageTitle=Yii::app()->name; ?>

<div class="span-23 showgrid">
<div class="dashboardIcons span-16">
    
    <div class="dashIcon span-3">
        <a href="/index.php/site/indexMercadeo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-cash2.png" alt="Modulo 4" /></a>
        <div class="dashIconText"><a href="/index.php/site/indexMercadeo">MODULO MERCADEO</a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="/index.php/site/indexExistencias"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-write.png" alt="Control de Existencias" /></a>
        <div class="dashIconText"><a href="/index.php/site/indexExistencias">MODULO CONTROL DE EXISTENCIAS</a></div>
    </div>
  
    
    <div class="dashIcon span-3">
        <a href="/index.php/site/indexCompras"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-shopping-cart4.png" alt="Compras" /></a>
        <div class="dashIconText"><a href="/index.php/site/indexCompras">MODULO COMPRAS</a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="/index.php/site/indexCosteo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-clipboard.png" alt="Costeo" /></a>
        <div class="dashIconText"><a href="/index.php/site/indexCosteo">MODULO COSTEO</a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="/index.php/site/indexContabilidad"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-books-stacked.png" alt="Modulo 4" /></a>
        <div class="dashIconText"><a href="/index.php/site/indexContabilidad">MODULO REGISTROS CONTABLES</a></div>
    </div>
    
    <div class="dashIcon span-3">
        <a href="/index.php/site/indexPlanificacion"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-chart.png" alt="Modulo 4" /></a>
        <div class="dashIconText"><a href="/index.php/site/indexPlanificacion">MODULO PLANIFICACION</a></div>
    </div>
    
   
</div><!-- END OF .dashIcons -->
<div class="span-7 last">
        <?php
        $helpme = CHtml::link('Ayuda Online','',array('onclick'=>'$("#help").click()','class'=>'cursorp'));
        $sample_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed turpis diam, facilisis nec egestas quis, pharetra eget diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed turpis diam, facilisis nec egestas quis, pharetra eget diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed turpis diam, facilisis nec egestas quis, pharetra eget diam.';
        $ayuda = 'El sistema integrado PYMES, proporciona soluciones integrales a las distintas actividades y controles que lleva a cabo una pequeña o mediana empresa, todas divididas en módulos independientes pero integrados' ;
        $this->widget('zii.widgets.jui.CJuiAccordion', array(
            'panels'=>array(
                'Ayuda Online'=>$ayuda.' '.$helpme,
                'Tour Virtual'=>$sample_content,
                'Proximas Funcionalidades'=>$sample_content,                 
            ),
            // additional javascript options for the accordion plugin
            'options'=>array(
                'animated'=>'bounceslide',
            ),
            'htmlOptions'=>array('class'=>'shadowaccordion'),
        ));
        ?>        
                
</div>
                

</div>
