<?php

/**
 * This is the model class for table "posts".
 *
 * The followings are the available columns in table 'posts':
 * @property string $idUser
 * @property string $datePosted
 * @property string $textPost
 *
 * The followings are the available model relations:
 * @property ImagesPosts[] $imagesPosts
 * @property ImagesPosts[] $imagesPosts1
 * @property Pops[] $pops
 * @property Pops[] $pops1
 * @property Users $idUser0
 * @property Replies[] $replies
 * @property Replies[] $replies1
 * @property Unpops[] $unpops
 * @property Unpops[] $unpops1
 */
class Posts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Posts the static model class
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
		return 'posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('datePosted', 'required'),
			array('idUser', 'length', 'max'=>40),
			array('textPost', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idUser, datePosted, textPost', 'safe', 'on'=>'search'),
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
			'imagesPosts' => array(self::HAS_MANY, 'ImagesPosts', 'idUser'),
			'imagesPosts1' => array(self::HAS_MANY, 'ImagesPosts', 'datePosted'),
			'pops' => array(self::HAS_MANY, 'Pops', 'idUserPost'),
			'pops1' => array(self::HAS_MANY, 'Pops', 'datePosted'),
			'idUser0' => array(self::BELONGS_TO, 'Users', 'idUser'),
			'replies' => array(self::HAS_MANY, 'Replies', 'idUserPost'),
			'replies1' => array(self::HAS_MANY, 'Replies', 'datePosted'),
			'unpops' => array(self::HAS_MANY, 'Unpops', 'idUserPost'),
			'unpops1' => array(self::HAS_MANY, 'Unpops', 'datePosted'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idUser' => 'Id User',
			'datePosted' => 'Date Posted',
			'textPost' => 'Text Post',
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

		$criteria->compare('idUser',$this->idUser,true);
		$criteria->compare('datePosted',$this->datePosted,true);
		$criteria->compare('textPost',$this->textPost,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}