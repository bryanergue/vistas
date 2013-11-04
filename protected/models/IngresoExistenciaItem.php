<?php

/**
 * This is the model class for table "ingreso_existencia_item".
 *
 * The followings are the available columns in table 'ingreso_existencia_item':
 * @property integer $producto_id
 * @property integer $solicitud_id
 * @property double $cantidad
 * @property double $precio_compra
 * @property string $estado
 */
class IngresoExistenciaItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IngresoExistenciaItem the static model class
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
		return 'ingreso_existencia_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('producto_id, solicitud_id, cantidad, precio_compra', 'required'),
			array('producto_id, solicitud_id', 'numerical', 'integerOnly'=>true),
			array('cantidad, precio_compra', 'numerical'),
			array('estado', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('producto_id, solicitud_id, cantidad, precio_compra, estado', 'safe', 'on'=>'search'),
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
			'producto_id' => 'Producto',
			'solicitud_id' => 'Solicitud',
			'cantidad' => 'Cantidad',
			'precio_compra' => 'Precio Compra',
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

		$criteria->compare('producto_id',$this->producto_id);
		$criteria->compare('solicitud_id',$this->solicitud_id);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('precio_compra',$this->precio_compra);
		$criteria->compare('estado',$this->estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}