<?php

class SolicitudCompraController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1com';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','listado','addProveedor','confirmar','viewConfirmar',
                'confimarSolicitud','listadoAprobacion','aprobar','rechazar','aprobadas','viewAprobada',
                'asignarComite','viewComite','addComite'),
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
    
    public function actionListado(){
         $model=new SolicitudCompra;
         $this->render('_listado',array(
            'model'=>$model,
        ));
    }

    
    
    public function actionListadoAprobacion(){
         $model=new SolicitudCompra;
         $this->render('_listadoAprobacion',array(
            'model'=>$model,
        ));
    }
    
    public function actionAprobadas(){
         $model= new SolicitudCompra;
         $this->render('_listadoAprobadas',array(
            'model'=>$model,
        ));
    
    }
    
    public function actionAprobar($id){
         $solicitud = SolicitudCompra::model()->findByPk($id);
         $solicitud -> estado = "aprobada";
         $solicitud -> save(false);
         
         Yii::app()->user->setFlash('success',"La solicitud fue aprobada");
                    
         $model=new SolicitudCompra;
         $this->render('_listadoAprobacion',array(
            'model'=>$model,
        ));
         
        
    }
    
    public function actionRechazar($id){
         $solicitud = SolicitudCompra::model()->findByPk($id);
         $solicitud -> estado = "rechazada";
         $solicitud -> save(false);
         
         Yii::app()->user->setFlash('success',"La solicitud fue rechazada");
         
         $model=new SolicitudCompra;
         $this->render('_listadoAprobacion',array(
            'model'=>$model,
        ));
        
    }
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $model=new SolicitudCompra();
        $proveedores = Proveedor::model()->findAll();
        
        $this->render('_view',array(
		    'model'=>$model,
        	'data'=>$this->loadModel($id),
		    'proveedores'=>$proveedores,
        ));
	}   

    
    
    public function actionViewConfirmar($id)
    {
        $model=new SolicitudCompra();
        $proveedores = Proveedor::model()->findAll();
        
        $this->render('_viewConfirmar',array(
            'model'=>$model,
            'data'=>$this->loadModel($id),
            'proveedores'=>$proveedores,
        ));
    }
    
    public function actionViewAprobada($id)
    {
        $model=new SolicitudCompra();
        $proveedores = Proveedor::model()->findAll();
        
        $this->render('_viewAprobada',array(
            'model'=>$model,
            'data'=>$this->loadModel($id),
            'proveedores'=>$proveedores,
        ));
    }
    
    public function actionViewComite($id)
    {
        $model = $this->loadModel($id);
        //$proveedores = Proveedor::model()->findAll();
        $usuarios = CrugeUsera::model()->findAllByAttributes(array("email"=>NULL));
        $encargado = CrugeUsera::model()->findByAttributes(array("email"=>"compras@localhost.net"));
        $gerente= CrugeUsera::model()->findByAttributes(array("email"=>"gerentegeneral@localhost.net"));
        
        $this->render('_viewComite',array(
            'model'=>$model,
            'usuarios'=>$usuarios,
            'encargado'=>$encargado,
            'gerente'=>$gerente,
            
            //'data'=>$this->loadModel($id),
            //'proveedores'=>$proveedores,
        ));
    }
    
    public function actionConfimarSolicitud(){
        if(Yii::app()->request->isPostRequest){
           $id = $_POST['idS'];
           $solicitud = SolicitudCompra::model()->findByPk($id);
           $solicitud -> estado = "confirmada";
           $solicitud -> save(false);
           
           $productos = SolicitudCompraItem::model()->findAllByAttributes(array("solicitud_compra_id"=>$id));
           foreach($productos as $item)
           {
              $item->precio = 100;
              $item->save(false); 
           }
        }
        else
            throw new CHttpException(400,'Solicitud invalida. Por favor vuelva a la pagina de inicio.');
         
    }
    
    public function actionAddProveedor(){
        if(Yii::app()->request->isPostRequest){
           $proveedor = $_POST['idP'];
           $id = $_POST['idS'];
           $solicitud = SolicitudCompra::model()->findByPk($id);
           $solicitud -> proveedor_id = $proveedor;
           $solicitud -> save(false);
                                            
           
        }
        else
            throw new CHttpException(400,'Solicitud invalida. Por favor vuelva a la pagina de inicio.');
         
    }
    
    public function actionAddComite(){
        if(Yii::app()->request->isPostRequest){
           $comite = array();
           $id = $_POST['id'];
           $numero = $_POST['numero'];
           $comite = $_POST['comite'];
          
          
           $encargado = CrugeUsera::model()->findByAttributes(array("email"=>"compras@localhost.net"));
            $solicitudComite = new SolicitudComite();
            $solicitudComite->comite_id = $encargado->iduser;
            $solicitudComite->solicitud_id=$id;
            $solicitudComite->save(false);
            
            if($numero == 4){
                
                $gerente= CrugeUsera::model()->findByAttributes(array("email"=>"gerentegeneral@localhost.net"));
                $solicitudComite = new SolicitudComite();
                $solicitudComite->comite_id = $encargado->iduser;
                $solicitudComite->solicitud_id=$id;
                $solicitudComite->save(false);
            }
            
            for($i=0;$i<$numero;$i++){
                $solicitudComite = new SolicitudComite();
                $solicitudComite->comite_id = $comite[$i];
                $solicitudComite->solicitud_id=$id;
                $solicitudComite->save(false);
            }
           echo ("se guardo el comite");           
        }
        else
            throw new CHttpException(400,'Solicitud invalida. Por favor vuelva a la pagina de inicio.');
        
    }
    
    public function actionConfirmar(){
           $model=new SolicitudCompra;
             $this->render('_listadoConfirmar',array(
                'model'=>$model,
            ));                                 
           
         
    }
    
    public function actionAsignarComite(){
        $model=new SolicitudCompra;
        $this->render('_listadoComite',array(
            'model'=>$model,
        ));
        
    }
    
    
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SolicitudCompra;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SolicitudCompra']))
		{
			$model->attributes=$_POST['SolicitudCompra'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SolicitudCompra']))
		{
			$model->attributes=$_POST['SolicitudCompra'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SolicitudCompra');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SolicitudCompra('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SolicitudCompra']))
			$model->attributes=$_GET['SolicitudCompra'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=SolicitudCompra::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='solicitud-compra-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
