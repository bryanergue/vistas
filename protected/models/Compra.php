<?php

/**
 * This is the model class for table "compra".
 *
 * The followings are the available columns in table 'compra':
 * @property integer $id
 * @property string $fecha
 * @property string $numero_compra
 * @property integer $tipo_moneda_id
 * @property integer $condiciones_pago_id
 * @property string $estado
 * @property string $nro_factura
 * @property integer $solicitud_compra_id
 * @property integer $cotizacion_id
 *
 * The followings are the available model relations:
 * @property CondicionesPago $condicionesPago
 * @property Cotizacion $cotizacion
 * @property SolicitudCompra $solicitudCompra
 * @property TipoMoneda $tipoMoneda
 * @property Producto[] $productos
 */
class Compra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Compra the static model class
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
		return 'compra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, numero_compra, tipo_moneda_id, condiciones_pago_id, estado', 'required'),
			array('tipo_moneda_id, condiciones_pago_id, solicitud_compra_id, cotizacion_id', 'numerical', 'integerOnly'=>true),
			array('numero_compra, estado, nro_factura', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fecha, numero_compra, tipo_moneda_id, condiciones_pago_id, estado, nro_factura, solicitud_compra_id, cotizacion_id', 'safe', 'on'=>'search'),
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
			'condicionesPago' => array(self::BELONGS_TO, 'CondicionesPago', 'condiciones_pago_id'),
			'cotizacion' => array(self::BELONGS_TO, 'Cotizacion', 'cotizacion_id'),
			'solicitudCompra' => array(self::BELONGS_TO, 'SolicitudCompra', 'solicitud_compra_id'),
			'tipoMoneda' => array(self::BELONGS_TO, 'TipoMoneda', 'tipo_moneda_id'),
			'productos' => array(self::MANY_MANY, 'Producto', 'compra_item(compra_id, producto_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha' => 'Fecha',
			'numero_compra' => 'Numero Compra',
			'estado' => 'Estado',
			'nro_factura' => 'Nro Factura',
			'solicitud_compra_id' => 'Solicitud Compra',
			'cotizacion_id' => 'Cotizacion',
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
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('numero_compra',$this->numero_compra,true);
		$criteria->compare('tipo_moneda_id',$this->tipo_moneda_id);
		$criteria->compare('condiciones_pago_id',$this->condiciones_pago_id);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('nro_factura',$this->nro_factura,true);
		$criteria->compare('solicitud_compra_id',$this->solicitud_compra_id);
		$criteria->compare('cotizacion_id',$this->cotizacion_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function searchSolicitudes()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('estado',"aprobada");
        return new CActiveDataProvider('SolicitudCompra', array(
            'criteria'=>$criteria,
        ));
    }
    
    
    public function searchProductos($solicitud_compra_id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
   
        
        $criteria=new CDbCriteria;
        $criteria->with = array('solicitudCompra');
        $criteria->together = true; 
        $criteria->compare('solicitud_compra_id',$solicitud_compra_id);
              
        return new CActiveDataProvider('SolicitudCompraItem' ,array(
            'criteria'=>$criteria,
        ));
    }
    
    
    public function searchProductosCompra($orden_compra_id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
   
        
        $criteria=new CDbCriteria;
        $criteria->with = array('ordenCompra');
        $criteria->together = true; 
        $criteria->compare('compra_id',$orden_compra_id);
              
        return new CActiveDataProvider('CompraItem' ,array(
            'criteria'=>$criteria,
        ));
    }
    
    public function searchCompras()
    {
        $criteria=new CDbCriteria;
        $criteria->compare('estado',"pendiente");
        return new CActiveDataProvider('Compra', array(
            'criteria'=>$criteria,
        ));
    }
}