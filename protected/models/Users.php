<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $mail
 * @property string $name
 * @property string $lName
 * @property string $urlPic
 * @property string $password
 * @property integer $idRole
 * @property string $idCity
 * @property string $idSchool
 *
 * The followings are the available model relations:
 * @property Pops[] $pops
 * @property Posts[] $posts
 * @property Replies[] $replies
 * @property Unpops[] $unpops
 * @property School $idSchool0
 * @property Roles $idRole0
 * @property City $idCity0
 */
class Users extends CActiveRecord
{
	private $salt;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mail, name, lName, urlPic, password, idRole, idCity, idSchool', 'required'),
			array('idRole', 'numerical', 'integerOnly'=>true, "on"=>"update"),
			array('idRole', 'numerical', 'integerOnly'=>true, "on"=>"create"),
			array('mail, name, lName', 'length', 'max'=>40),
			array('urlPic', 'length', 'max'=>250),
			array('password, idCity, idSchool', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mail, name, lName, urlPic, password, idRole, idCity, idSchool', 'safe', 'on'=>'search'),
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
			'pops' => array(self::HAS_MANY, 'Pops', 'idUserPoped'),
			'posts' => array(self::HAS_MANY, 'Posts', 'idUser'),
			'replies' => array(self::HAS_MANY, 'Replies', 'idUserReplied'),
			'unpops' => array(self::HAS_MANY, 'Unpops', 'idUserUnpoped'),
			'idSchool0' => array(self::BELONGS_TO, 'School', 'idSchool'),
			'idRole0' => array(self::BELONGS_TO, 'Roles', 'idRole'),
			'idCity0' => array(self::BELONGS_TO, 'City', 'idCity'),
		);
	}
	
	/*
		password  hashed
	*/
	public function hashPassword($password, $salt)
	{
		$this->salt=$salt;
		return sha1($salt.$password);
	}
	
	/*
		password validated 
	*/
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt)===$this->password;
	}

	/*
	generate the salt 
	*/
	public function genSalt()
	{
		return uniqid('',true);
	}
	
	/*
	before validate 
	*/
	public function beforeValidate()
	{
		$this->salt = $this->genSalt();
	 	return parent::beforeValidate();
	}
	
	/*
	before save  
	*/
	public function beforeSave()
	{
	    $this->password = $this->hashPassword($this->password, $this->salt);
	    return parent::beforeSave();
	}
	
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mail' => 'Mail',
			'name' => 'Name',
			'lName' => 'L Name',
			'urlPic' => 'Url Pic',
			'password' => 'Password',
			'idRole' => 'Id Role',
			'idCity' => 'Id City',
			'idSchool' => 'Id School',
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

		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lName',$this->lName,true);
		$criteria->compare('urlPic',$this->urlPic,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('idRole',$this->idRole);
		$criteria->compare('idCity',$this->idCity,true);
		$criteria->compare('idSchool',$this->idSchool,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}