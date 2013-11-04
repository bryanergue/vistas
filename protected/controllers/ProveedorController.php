<?php

class ProveedorController extends Controller
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
				'actions'=>array('index','view','listado','buscar','autoCompletado','lista'),
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
		$model=new Proveedor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Proveedor']))
		{
			$model->attributes=$_POST['Proveedor'];
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

		if(isset($_POST['Proveedor']))
		{
			$model->attributes=$_POST['Proveedor'];
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
		$dataProvider=new CActiveDataProvider('Proveedor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Proveedor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Proveedor']))
			$model->attributes=$_GET['Proveedor'];

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
	 * Busqueda de proveedores, de la base de datos
	 * 
	 * @author Daniel Luis Herrera Santander
	 */
	
	
	public function actionBuscar()
	{
		$term=$_GET['term'];
		$criteria = new CDbCriteria;                                     
		$criteria->compare('nombre',$term,true);
		
		$criteria->limit = 10;                                         
		$models = Proveedor::model()->findAll($criteria);                   
		$arr = array();
		foreach ($models as $model) {
		    $arr[] = array(
			'label'=>$model->nombre,
			'value'=>$model->nombre,
			'd' => CHtml::encode((int)$model->id)                
		    );
		}
		echo json_encode($arr);
	}
	
	
	/**
	 * Busqueda de productos relacionados con el proveedor
	 * 
	 * @author Daniel Luis Herrera Santander
	 */
	
	public function actionAutoCompletado()
	{		
		$idProv=$_GET['id'];	
		$proveedor = Proveedor::model()->findByPk($idProv);
		$producto = $proveedor->productos;
		$arr = array();
		foreach ($producto as $model) {
		    if(($model->en_compra) == 's')
		    {
			$arr[] = array(
			    'label'=>$model->descripcion,
			    'value'=>$model->descripcion,
			    'precio_venta' => CHtml::encode((int)$model->precio_venta),
			    'codigo' => CHtml::encode((int)$model->id),
			    'existen' => CHtml::encode((double)$model->cant_existencias),
			    'cant'=>$model->cant_existencias=1,
			    
			);
		    }
		}
		echo json_encode($arr);
	}
	
	
	
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Proveedor::model()->findByPk($id);
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
	
	
	public function actionLista()
	{
		
		$sort = new CSort;
		$sort->attributes = array('codigo','descripcion');
		$criteria = new CDbCriteria();
		
		$dataProvider = new CActiveDataProvider('Producto', array(
                    'sort' => $sort,
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 30,
                    ),
         ));
		$this->render('lista',array(
            'dataProvider'=>$dataProvider,
        ));
	
	}
	
	
}