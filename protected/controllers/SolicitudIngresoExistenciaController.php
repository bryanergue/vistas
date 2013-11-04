<?php

class SolicitudIngresoExistenciaController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','listado1','buscar','buscarProduct','add','add2','listado','del','contar'),
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
	
	
	/**
	 * Agregamos el producto seleccionado a la tabla solicitud_ingreso_existencia
	 * 
	 * @author Daniel Luis Herrera Santander
	 */
	
	
	public function actionAdd()
	{
		//die ("true");
		//$model=new SolicitudSalidaExistencia;
		$ingreso = new SolicitudIngresoExistencia;
		//$idSolicitud=$_GET['idSolicitud'];
		$fecha_actual = date("Y-m-d");
		$usuario = 1;
		$codigoSolicitud = '1234';
		$idProveedor=$_GET['idProveedor'];
		
		
			//$ingreso->id=$idSolicitud;
			$ingreso->fecha_alta=$fecha_actual;
			$ingreso->usuario_solicitante=$usuario;
			$ingreso->codigo_solicitud=$codigoSolicitud;
			$ingreso->proveedor_id=$idProveedor;
			if($ingreso->save(false))
				echo $ingreso->id;
			else
				echo "false";
		
		
				
	}
	
	
	/**
	 * Agremos el producto-solicitud a la tabla ingreso_existencia_item
	 * 
	 * @author Daniel Luis Herrera Santander
	 */
	
	
	
	public function actionAdd2()
	{
		
		$idProducto=$_POST['idProducto'];
		$idSolicitud=$_POST['idSolicitud'];
		$idCantidad=$_POST['idCantidad'];
		$idTotal=$_POST['idTotal'];
		$salida=IngresoExistenciaItem::model()->findByAttributes(array('producto_id'=>$idProducto,'solicitud_id'=>$idSolicitud));   
		
		if($salida == null)
		{
			$ingreso = new IngresoExistenciaItem;
			$ingreso->producto_id=$idProducto;
			$ingreso->solicitud_id=$idSolicitud;
			$ingreso->cantidad=$idCantidad;
			$ingreso->precio_compra=$idTotal;
			$ingreso->estado='Pendiente';
			if($ingreso->save(false))
				echo "true";
			else
				echo "false";
		}
		else
		{
			//$ingreso->producto_id=$idProducto;
			//$ingreso->solicitud_id=$idSolicitud;
			$ingreso=IngresoExistenciaItem::model()->findByAttributes(array('producto_id'=>$idProducto,'solicitud_id'=>$idSolicitud));   
			$ingreso->cantidad=$idCantidad;
			$ingreso->precio_compra=$idTotal;
			$ingreso->estado='Pendiente';
			if($ingreso->save(false))
				echo "true";
			else
				echo "false";
		}
		
		
	}
	
	
	/**
	 * Eliminamos el producto-solicitud de la tabla ingreso_existencia_item
	 * 
	 * @author Daniel Luis Herrera Santander
	 */
	
	public function actionDel()
	{
		$idProducto=$_POST['idProducto'];
		$idSolicitud=$_POST['idSolicitud'];
		$salida=IngresoExistenciaItem::model()->findByAttributes(array('producto_id'=>$idProducto,'solicitud_id'=>$idSolicitud));   
		$salida->delete();
	}
	
	
	
	
	
	
	public function actionListado()
	{
		
		//$idsol=$_GET['idsol'];
		
		$sort = new CSort;
		$sort->attributes = array('cantidad','precio_compra','producto.descripcion');
		$criteria = new CDbCriteria();	
		$criteria -> with = array('producto');
		$dataProvider = new CActiveDataProvider('IngresoExistenciaItem', array(
                    'sort' => $sort,
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 30,
                    ),
         ));
		$this->render('listado',array(
            'dataProvider'=>$dataProvider,
        ));
		
	
	}
	
	public function actionContar()
	{
		$sql = "SELECT COUNT(*) as id FROM solicitud_ingreso_existencia";
		$command = Yii::app()->db->createCommand($sql);
		$results = $command->queryAll();
		$numSolicitudes= (int)$results[0]["id"];
		echo json_encode($numSolicitudes+1);
	}
	
	
	
	
	
}