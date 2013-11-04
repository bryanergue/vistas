<?php

/**
 * This is the model class for table "solicitud_compra".
 *
 * The followings are the available columns in table 'solicitud_compra':
 * @property integer $id
 * @property string $fecha_alta
 * @property integer $usuario_solicitante
 * @property string $codigo_solicitud
 * @property string $estado
 * @property integer $tipo_compra_id
 * @property integer $proveedor_id
 *
 * The followings are the available model relations:
 * @property Compra[] $compras
 * @property Cotizacion[] $cotizacions
 * @property SolicitudComite[] $solicitudComites
 * @property Proveedor $proveedor
 * @property CrugeUser $usuarioSolicitante
 * @property TipoCompra $tipoCompra
 * @property Producto[] $productos
 */
class SolicitudCompra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SolicitudCompra the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'solicitud_compra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_alta, usuario_solicitante, codigo_solicitud, estado, tipo_compra_id, proveedor_id', 'required'),
			array('usuario_solicitante, tipo_compra_id, proveedor_id', 'numerical', 'integerOnly'=>true),
			array('codigo_solicitud, estado', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fecha_alta, usuario_solicitante, codigo_solicitud, estado, tipo_compra_id, proveedor_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'compras' => array(self::HAS_MANY, 'Compra', 'solicitud_compra_id'),
			'cotizacions' => array(self::HAS_MANY, 'Cotizacion', 'solicitud_compra_id'),
			'solicitudComites' => array(self::HAS_MANY, 'SolicitudComite', 'solicitud_id'),
			'proveedors' => array(self::BELONGS_TO, 'Proveedor', 'proveedor_id'),
			'usuarioSolicitante' => array(self::BELONGS_TO, 'CrugeUser', 'usuario_solicitante'),
			'tipoCompra' => array(self::BELONGS_TO, 'TipoCompra', 'tipo_compra_id'),
			'productos' => array(self::MANY_MANY, 'Producto', 'solicitud_compra_item(solicitud_compra_id, producto_id)'),
		     'solicitudItem' => array(self::HAS_MANY,'SolicitudCompraItem','solicitud_compra_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha_alta' => 'Fecha Alta',
			'usuario_solicitante' => 'Usuario Solicitante',
			'codigo_solicitud' => 'Codigo Solicitud',
			'estado' => 'Estado',
			'tipo_compra_id' => 'Tipo Compra',
			'proveedor_id' => 'Proveedor',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('fecha_alta',$this->fecha_alta,true);
		$criteria->compare('usuario_solicitante',$this->usuario_solicitante);
		$criteria->compare('codigo_solicitud',$this->codigo_solicitud,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('tipo_compra_id',$this->tipo_compra_id);
		$criteria->compare('proveedor_id',$this->proveedor_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function searchBorradores()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('estado',"borrador");
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function searchConfirmadas()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('estado',"confirmada");
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function searchAprobadas()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('estado',"aprobada");
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function searchLicitaciones()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('tipo_compra_id',2);
        $criteria->compare('estado',"a cotizar");
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function searchCotizaciones($solicitud_compra_id)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('solicitud_compra_id',$solicitud_compra_id);
        return new CActiveDataProvider('Cotizacion', array(
            'criteria'=>$criteria,
        ));
    }
    
    
    public function searchProductos($solicitud_compra_id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
   
        
        $criteria=new CDbCriteria;
        //$criteria->with = array('solicitudCompra');
        //$criteria->together = true; 
        $criteria->compare('solicitud_compra_id',$solicitud_compra_id);
              
        return new CActiveDataProvider('SolicitudCompraItem' ,array(
            'criteria'=>$criteria,
        ));
    }
    
    public function cantidades($id){
        
        $total = 0;
        $productos = SolicitudCompraItem::model()->findAllByAttributes(array("solicitud_compra_id"=>$id));
        foreach($productos as $item){
            $total = $total + $item->cantidad;
        }
        return $total;
    }
    
    public function total($id){
        
        $total = 0;
        $productos = SolicitudCompraItem::model()->findAllByAttributes(array("solicitud_compra_id"=>$id));
        foreach($productos as $item){
            $total = $total + $item->precio;
        }
        return $total;
    }
}