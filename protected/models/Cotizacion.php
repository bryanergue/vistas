<?php

/**
 * This is the model class for table "cotizacion".
 *
 * The followings are the available columns in table 'cotizacion':
 * @property integer $id
 * @property string $fecha_alta
 * @property integer $solicitud_compra_id
 * @property string $nro_cotizacion
 * @property integer $proveedor_id
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property Compra[] $compras
 * @property Proveedor $proveedor
 * @property SolicitudCompra $solicitudCompra
 * @property Producto[] $productos
 */
class Cotizacion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cotizacion the static model class
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
		return 'cotizacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_alta, solicitud_compra_id, nro_cotizacion, proveedor_id, estado', 'required'),
			array('solicitud_compra_id, proveedor_id', 'numerical', 'integerOnly'=>true),
			array('nro_cotizacion, estado', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fecha_alta, solicitud_compra_id, nro_cotizacion, proveedor_id, estado', 'safe', 'on'=>'search'),
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
			'compras' => array(self::HAS_MANY, 'Compra', 'cotizacion_id'),
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'proveedor_id'),
			'solicitudCompra' => array(self::BELONGS_TO, 'SolicitudCompra', 'solicitud_compra_id'),
			'productos' => array(self::MANY_MANY, 'Producto', 'cotizacion_item(cotizacion_id, producto_id)'),
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
			'solicitud_compra_id' => 'Solicitud Compra',
			'nro_cotizacion' => 'Nro Cotizacion',
			'proveedor_id' => 'Proveedor',
			'estado' => 'Estado',
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
		$criteria->compare('solicitud_compra_id',$this->solicitud_compra_id);
		$criteria->compare('nro_cotizacion',$this->nro_cotizacion,true);
		$criteria->compare('proveedor_id',$this->proveedor_id);
		$criteria->compare('estado',$this->estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function total($id){
        $total = 0;
        
        $productos = CotizacionItem::model()->findAllByAttributes(array("cotizacion_id"=>$id));
        
        foreach($productos as $pro)
            $total = $total + ($pro->precio_compra * $pro->cantidad);
            
        return $total;
    }
}