<?php

/**
 * This is the model class for table "solicitud_compra_item".
 *
 * The followings are the available columns in table 'solicitud_compra_item':
 * @property integer $solicitud_compra_id
 * @property integer $producto_id
 * @property double $cantidad
 * @property double $precio
 */
class SolicitudCompraItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SolicitudCompraItem the static model class
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
		return 'solicitud_compra_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('solicitud_compra_id, producto_id, cantidad', 'required'),
			array('solicitud_compra_id, producto_id', 'numerical', 'integerOnly'=>true),
			array('cantidad, precio', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('solicitud_compra_id, producto_id, cantidad, precio', 'safe', 'on'=>'search'),
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
        'solicitudCompra' => array(self::BELONGS_TO, 'SolicitudCompra', 'solicitud_compra_id'),
        'producto' => array(self::BELONGS_TO, 'Producto', 'producto_id')
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'solicitud_compra_id' => 'Solicitud Compra',
			'producto_id' => 'Producto',
			'cantidad' => 'Cantidad',
			'precio' => 'Precio',
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

		$criteria->compare('solicitud_compra_id',$this->solicitud_compra_id);
		$criteria->compare('producto_id',$this->producto_id);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('precio',$this->precio);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}