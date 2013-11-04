<?php

/**
 * This is the model class for table "solicitud_comite".
 *
 * The followings are the available columns in table 'solicitud_comite':
 * @property integer $solicitud_id
 * @property integer $comite_id
 *
 * The followings are the available model relations:
 * @property CrugeUser $comite
 * @property SolicitudCompra $solicitud
 */
class SolicitudComite extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sol the static model class
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
		return 'solicitud_comite';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('solicitud_id, comite_id', 'required'),
			array('solicitud_id, comite_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('solicitud_id, comite_id', 'safe', 'on'=>'search'),
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
			'comite' => array(self::BELONGS_TO, 'CrugeUser', 'comite_id'),
			'solicitud' => array(self::BELONGS_TO, 'SolicitudCompra', 'solicitud_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'solicitud_id' => 'Solicitud',
			'comite_id' => 'Comite',
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

		$criteria->compare('solicitud_id',$this->solicitud_id);
		$criteria->compare('comite_id',$this->comite_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}