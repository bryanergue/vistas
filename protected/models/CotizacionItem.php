<?php

/**
 * This is the model class for table "cotizacion_item".
 *
 * The followings are the available columns in table 'cotizacion_item':
 * @property integer $cotizacion_id
 * @property integer $producto_id
 * @property double $cantidad
 * @property double $precio_compra
 */
class CotizacionItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CotizacionItem the static model class
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
		return 'cotizacion_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cotizacion_id, producto_id, cantidad, precio_compra', 'required'),
			array('cotizacion_id, producto_id', 'numerical', 'integerOnly'=>true),
			array('cantidad, precio_compra', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cotizacion_id, producto_id, cantidad, precio_compra', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cotizacion_id' => 'Cotizacion',
			'producto_id' => 'Producto',
			'cantidad' => 'Cantidad',
			'precio_compra' => 'Precio Compra',
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

		$criteria->compare('cotizacion_id',$this->cotizacion_id);
		$criteria->compare('producto_id',$this->producto_id);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('precio_compra',$this->precio_compra);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}