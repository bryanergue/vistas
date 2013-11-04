<?php

class CompraController extends Controller
{
    public $layout='//layouts/column1com';

    
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('create','nuevo','listado','addProveedor','confirmar','viewConfirmar',
                'confimarSolicitud','listadoAprobacion','aprobar','rechazar','aprobadas','viewAprobada','registrar'),
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
        $model = new Compra();

      //  Yii::app()->user->setFlash('success',"La solicitud fue rechazada");
         
        $this->render('create',array(
            'model'=>$model,
        ));    
	}
    
    public function actionNuevo($id)
    {
        $model = new Compra();
        $data = SolicitudCompra::model()->findByPk($id);
         
         
         $numero = Yii::app()->db->createCommand()
                                 ->select('count(numero_compra)')
                                 ->from('compra')
                                 //->where('date(fecha) = :fecha', array(':fecha'=>$fecha))
                                 ->queryScalar();
            $numero++;                                                       
         
        $this->render('_nuevo',array(
            'data'=>$data,
            'model'=>$model,
            'numero'=>$numero,
        ));    
    }
    
    public function actionRegistrar(){
        $id = $_POST{'idS'};
        $numFactura = $_POST{'numFactura'};
        $numero = $_POST{'numero'};
        
              
        $nuevaOrden = new Compra();

        $nuevaOrden->fecha = date('Y/m/d');
        $nuevaOrden->numero_compra = $numero;
        $nuevaOrden->estado = "pendiente";
        $nuevaOrden->nro_factura = $numFactura;
        $nuevaOrden->solicitud_compra_id = $id;
        $nuevaOrden->save(false);
        
        
        $sol = SolicitudCompra::model()->findByPk($id);
        $sol->estado = "cerrada";
        $sol->save(false);
        
        
        $productos = SolicitudCompraItem::model()->findAllByAttributes(array("solicitud_compra_id"=>$id));
        foreach($productos as $item){
            $compraitem = new CompraItem();
            $compraitem->producto_id = $item->producto_id;            
            $compraitem->compra_id = $nuevaOrden->id;            
            $compraitem->precio_compra = $item->precio;            
            $compraitem->cantidad = $item->cantidad; 
            $compraitem->save(false); 
        }
        
       // echo "orden creada";
        
    }

    
    public function actionListado(){
        $model = new Compra();
        
        $this->render('_listado',array(
            'model'=>$model,
        ));    
    }
    
    public function actionView($id)
    {
        $model = Compra::model()->findByPk($id);
        $this->render('_view',array(
            'model'=>$model,
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