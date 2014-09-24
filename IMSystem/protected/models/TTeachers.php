<?php

/**
 * This is the model class for table "t_teachers".
 *
 * The followings are the available columns in table 't_teachers':
 * @property string $ID
 * @property string $code
 * @property string $name
 * @property string $status
 * @property string $sex
 * @property string $birthday
 * @property string $address
 * @property string $telephonoe
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property MCourses[] $mCourses
 * @property TClasses[] $tClasses
 * @property TUsers $iD
 */
class TTeachers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_teachers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, sex, create_time, update_time', 'required'),
			array('code', 'length', 'max'=>20),
			array('name, create_user, update_user', 'length', 'max'=>10),
			array('status, sex', 'length', 'max'=>1),
			array('address', 'length', 'max'=>100),
			array('telephonoe', 'length', 'max'=>11),
			array('birthday', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, code, name, status, sex, birthday, address, telephonoe, create_user, create_time, update_user, update_time', 'safe', 'on'=>'search'),
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
			'mCourses' => array(self::HAS_MANY, 'MCourses', 'teacher_id'),
			'tClasses' => array(self::HAS_MANY, 'TClasses', 'teacher_id'),
			'iD' => array(self::BELONGS_TO, 'TUsers', 'ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'code' => '教师CODE',
			'name' => '教师姓名',
			'status' => '状态(1:正常 2:异常)',
			'sex' => '性别(F: 女 M:男)',
			'birthday' => '出生年月日',
			'address' => '地址',
			'telephonoe' => '电话号码',
			'create_user' => 'Create User',
			'create_time' => 'Create Time',
			'update_user' => 'Update User',
			'update_time' => 'Update Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('telephonoe',$this->telephonoe,true);
		$criteria->compare('create_user',$this->create_user,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_user',$this->update_user,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TTeachers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
