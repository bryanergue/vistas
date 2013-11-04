<?php

class CotizacionController extends Controller
{
    
    public $layout='//layouts/column1com';

    
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('create','nuevo','listado','addProveedor','confirmar','viewConfirmar',
                'confimarSolicitud','listadoAprobacion','aprobar','rechazar','aprobadas','viewAprobada',
                'registrar','getNumero','add','registrar'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
	public function actionCreate()
	{
        $model = new Cotizacion();
        $solicitudes = SolicitudCompra::model()->findAllByAttributes(array("tipo_compra_id"=>2));
        $proveedores = Proveedor::model()->findAll();                                                   
        $this->render('create',array(
            'solicitudes'=>$solicitudes,
            'proveedores'=>$proveedores,
            'model'=>$model,
            //'numero'=>$numero,
        ));    
    }

    
    public function actionGetNumero(){
         $solicitud = $_GET['solicitud'];
            $sol = SolicitudCompra::model()->findByPk($solicitud);
            
             $numero = Yii::app()->db->createCommand()
                                 ->select('count(nro_cotizacion)')
                                 ->from('cotizacion')
                                 ->where('solicitud_compra_id = :id', array(':id'=>$sol->id))
                                 ->queryScalar();
            $numero++;   
                                                               
            $info = array();
            array_push($info, array('numCotizacion' => $numero));
       
            echo CJSON::encode($info);    
    }
    
    public function actionAdd(){
         $solicitud = $_POST['solicitud'];
         $proveedor= $_POST['proveedor'];
         $numCotizacion = $_POST['numCotizacion'];
         
         $nuevaCotizacion = new Cotizacion();
         
         $fecha = date('Y/m/d');;
         
         $nuevaCotizacion->fecha_alta = $fecha;
         $nuevaCotizacion->solicitud_compra_id = $solicitud;
         $nuevaCotizacion->nro_cotizacion = $numCotizacion;         
         $nuevaCotizacion->proveedor_id = $proveedor;        
         $nuevaCotizacion->estado = "borrador";
         $nuevaCotizacion->save(false);
         
         echo $nuevaCotizacion->id;
                 
    }
    
    public function actionRegistrar(){
        
        $precios = array();
        
        if(isset($_POST['precios']))
            $precios = $_POST['precios'];
        else
            $precios = "";
        
        if(isset($_POST['id']))
            $id= $_POST['id'];
        else
            $id= "";
        
        
         
        $cotizacion = Cotizacion::model()->findByPk($id);
        
        
        $solicitud = SolicitudCompra::model()->findByPk($cotizacion->solicitud_compra_id);
        $solicitud->estado = "a cotizar";
        $solicitud->save(false);        
         
        $productos = SolicitudCompraItem::model()->findAllByAttributes(array("solicitud_compra_id"=>$cotizacion->solicitud_compra_id));
        $i=0;
        foreach($productos as $item){
            $cotizacionItem = new CotizacionItem();
            $cotizacionItem -> cotizacion_id = $cotizacion->id;
            $cotizacionItem -> producto_id = $item->producto_id;
            $cotizacionItem -> cantidad = $item->cantidad;
            $cotizacionItem -> precio_compra = $precios[$i];
            
            $i++;
            $cotizacionItem -> save(false);
            
        }
        
        echo "se guardaron todos los datos";
        
    }
    
 
    public function actionNuevo(){
        $id = $_GET['id'];
       
        $model =  new SolicitudCompra();
        $cotizacion = Cotizacion::model()->findByPk($id);
        
        $model2  = new SolicitudCompra();
        $this->render('_nuevo',array(
            'model'=>$model,
            //'model2'=>$model2,
            //'proveedor'=>$proveedor,
            'cotizacion'=>$cotizacion,
            
            //'numero'=>$numero,
        ));
    }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}