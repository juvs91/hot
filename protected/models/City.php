<?php

/**
 * This is the model class for table "city".
 *
 * The followings are the available columns in table 'city':
 * @property string $id
 * @property string $urlCover1
 * @property string $urlCover2
 * @property string $urlCover3
 * @property string $urlCover4
 * @property string $cityName
 * @property string $stateName
 *
 * The followings are the available model relations:
 * @property School[] $schools
 * @property Users[] $users
 */
class City extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return City the static model class
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
		return 'city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('urlCover1, urlCover2, urlCover3, urlCover4, cityName, stateName', 'required'),
			array('urlCover1, urlCover2, urlCover3, urlCover4', 'length', 'max'=>250),
			array('cityName, stateName', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, urlCover1, urlCover2, urlCover3, urlCover4, cityName, stateName', 'safe', 'on'=>'search'),
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
			'schools' => array(self::HAS_MANY, 'School', 'idCity'),
			'users' => array(self::HAS_MANY, 'Users', 'idCity'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'urlCover1' => 'Url Cover1',
			'urlCover2' => 'Url Cover2',
			'urlCover3' => 'Url Cover3',
			'urlCover4' => 'Url Cover4',
			'cityName' => 'City Name',
			'stateName' => 'State Name',
		);
	}
	
	/*
	function return all cities
	*/
	public function getAllCities()
	{
		return self::model()->findAll();
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('urlCover1',$this->urlCover1,true);
		$criteria->compare('urlCover2',$this->urlCover2,true);
		$criteria->compare('urlCover3',$this->urlCover3,true);
		$criteria->compare('urlCover4',$this->urlCover4,true);
		$criteria->compare('cityName',$this->cityName,true);
		$criteria->compare('stateName',$this->stateName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}