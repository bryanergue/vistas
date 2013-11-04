<?php

/**
 * This is the model class for table "solicitud_ingreso_existencia".
 *
 * The followings are the available columns in table 'solicitud_ingreso_existencia':
 * @property integer $id
 * @property string $fecha_alta
 * @property integer $usuario_solicitante
 * @property string $codigo_solicitud
 * @property integer $proveedor_id
 *
 * The followings are the available model relations:
 * @property HistorialMovimientos[] $historialMovimientoses
 * @property Producto[] $productos
 * @property CrugeUser $usuarioSolicitante
 * @property Proveedor $proveedor
 */
class SolicitudIngresoExistencia extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SolicitudIngresoExistencia the static model class
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
		return 'solicitud_ingreso_existencia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_alta, usuario_solicitante, codigo_solicitud, proveedor_id', 'required'),
			array('usuario_solicitante, proveedor_id', 'numerical', 'integerOnly'=>true),
			array('codigo_solicitud', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fecha_alta, usuario_solicitante, codigo_solicitud, proveedor_id', 'safe', 'on'=>'search'),
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
			'historialMovimientoses' => array(self::HAS_MANY, 'HistorialMovimientos', 'solicitud_ingreso_existencia_id'),
			'productos' => array(self::MANY_MANY, 'Producto', 'ingreso_existencia_item(solicitud_id, producto_id)'),
			'usuarioSolicitante' => array(self::BELONGS_TO, 'CrugeUser', 'usuario_solicitante'),
			'proveedor' => array(self::BELONGS_TO, 'Proveedor', 'proveedor_id'),
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
		$criteria->compare('proveedor_id',$this->proveedor_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}