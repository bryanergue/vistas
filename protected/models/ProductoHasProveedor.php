<?php

/**
 * This is the model class for table "producto_has_proveedor".
 *
 * The followings are the available columns in table 'producto_has_proveedor':
 * @property integer $producto_id
 * @property integer $proveedor_id
 * @property double $precio_compra
 */
class ProductoHasProveedor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductoHasProveedor the static model class
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
		return 'producto_has_proveedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('producto_id, proveedor_id, precio_compra', 'required'),
			array('producto_id, proveedor_id', 'numerical', 'integerOnly'=>true),
			array('precio_compra', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('producto_id, proveedor_id, precio_compra', 'safe', 'on'=>'search'),
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
		//'producto'=>array(self::BELONGS_TO, 'Producto', 'producto_id')		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'producto_id' => 'Producto',
			'proveedor_id' => 'Proveedor',
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

		$criteria->compare('producto_id',$this->producto_id);
		$criteria->compare('proveedor_id',$this->proveedor_id);
		$criteria->compare('precio_compra',$this->precio_compra);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}