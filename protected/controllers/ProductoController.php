<?php

class ProductoController extends Controller
{
	public $game;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('index','view','listado','buscar','buscarProduct','add'),
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Producto;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Producto']))
		{
			$model->attributes=$_POST['Producto'];
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

		if(isset($_POST['Producto']))
		{
			$model->attributes=$_POST['Producto'];
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Producto');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Producto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Producto']))
			$model->attributes=$_GET['Producto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
    
    
    /**
    * Lista todas las existencias, todas las columnas son ordenables
    * @author Freddy Valda
    */
        public function actionListado()
	{
		$this->render('_listado');
	}
	
	
	
	/**
	 * Busqueda de productos, de la base de datos
	 * 
	 * @author Daniel Luis Herrera Santander
	 */
	
	public function actionBuscarProduct()
	{

		$term=$_GET['term'];
		$idProv=$_GET['idProv'];
		$criteria = new CDbCriteria;
		$criteria->limit = 10;	
		$criteria->compare('descripcion',$term,true);
		$criteria->with = array('productos','proveedors');
		$models = Producto::model()->findAll($criteria);                   
		$arr = array();
		foreach ($models as $model) {
		    $arr[] = array(
			'label'=>$model->descripcion,
			'value'=>$model->descripcion,
			'd' => CHtml::encode((int)$model->id)    // enviamos el id del producto al jquery            
		    );
		}
		echo json_encode($arr);
		
	}
	
	
	
	
	public function actionAdd()
	{
		//die ("true");
		//$model=new SolicitudSalidaExistencia;
		$ingreso = new IngresoExistenciaItem;
		$idProducto=$_GET['idproducto'];
		$idSolicitud=$_GET['idSolicitud'];
		$idCantidad=$_GET['idCantidad'];
		$idTotal=$_GET['idTotal'];
		
			$ingreso->producto_id=$idProducto;
			$ingreso->solicitud_id=$idSolicitud;
			$ingreso->cantidad=$idCantidad;
			$ingreso->precio_compra=$idTotal;
			$ingreso->estado='Pendiente';
			//$ingreso->proveedor_id='Pendiente';
			//$model->codigo_solicitud='32423';
			if($ingreso->save(false))
				echo "true";
			else
				echo "false";
		
		
				
	}
	
	
	
	
	
	
	
	
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Producto::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='proveedor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}