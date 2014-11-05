<?php

/**
 * This is the model class for table "t_student_classes".
 *
 * The followings are the available columns in table 't_student_classes':
 * @property string $ID
 * @property string $student_number
 * @property string $student_id
 * @property string $class_id
 * @property string $status
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property TClasses $class
 * @property TStudents $student
 */
class TStudentClasses extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_student_classes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_time', 'required'),
			array('student_number, student_id, class_id, create_user, update_user', 'length', 'max'=>10),
			array('status', 'length', 'max'=>1),
			array('update_time', 'safe'),
			
            // safe
			array('ID, student_number, student_id, class_id, status, create_user, create_time, update_user, update_time', 'safe'),
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
			'class' => array(self::BELONGS_TO, 'TClasses', 'class_id'),
			'student' => array(self::BELONGS_TO, 'TStudents', 'student_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'student_number' => '学号',
			'student_id' => '学生ID',
			'class_id' => '班级ID',
			'status' => '状态', // 0:暂停 1:正常
			'create_user' => '创建用户',
            'create_time' => '创建时间',
            'update_user' => '更新用户',
            'update_time' => '更新时间',
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
		$criteria->compare('student_number',$this->student_number,true);
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('class_id',$this->class_id,true);
		$criteria->compare('status',$this->status,true);
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
	 * @return TStudentClasses the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
