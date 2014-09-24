<?php

/**
 * This is the model class for table "t_students".
 *
 * The followings are the available columns in table 't_students':
 * @property string $ID
 * @property string $code
 * @property string $name
 * @property string $status
 * @property string $sex
 * @property string $id_card_no
 * @property string $birthday
 * @property string $class_id
 * @property string $old_class_id
 * @property string $accommodation
 * @property string $payment1
 * @property string $payment2
 * @property string $payment3
 * @property string $payment4
 * @property string $payment5
 * @property string $payment6
 * @property string $bonus_penalty
 * @property string $address
 * @property string $parents_tel
 * @property string $parents_qq
 * @property string $school_of_graduation
 * @property integer $senior_score
 * @property integer $school_year
 * @property integer $college_score
 * @property string $university
 * @property string $comment
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property TScores[] $tScores
 * @property TClasses $class
 * @property TClasses $oldClass
 * @property TUsers $iD
 */
class TStudents extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_students';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, sex, class_id, create_time, update_time', 'required'),
			array('senior_score, school_year, college_score', 'numerical', 'integerOnly'=>true),
			array('code, id_card_no', 'length', 'max'=>20),
			array('name, class_id, old_class_id, create_user, update_user', 'length', 'max'=>10),
			array('status, sex', 'length', 'max'=>1),
			array('accommodation, payment1, payment2, payment3, payment4, payment5, payment6, bonus_penalty, school_of_graduation', 'length', 'max'=>50),
			array('address, university', 'length', 'max'=>100),
			array('parents_tel', 'length', 'max'=>11),
			array('parents_qq', 'length', 'max'=>15),
			array('birthday, comment', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, code, name, status, sex, id_card_no, birthday, class_id, old_class_id, accommodation, payment1, payment2, payment3, payment4, payment5, payment6, bonus_penalty, address, parents_tel, parents_qq, school_of_graduation, senior_score, school_year, college_score, university, comment, create_user, create_time, update_user, update_time', 'safe', 'on'=>'search'),
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
			'tScores' => array(self::HAS_MANY, 'TScores', 'student_id'),
			'class' => array(self::BELONGS_TO, 'TClasses', 'class_id'),
			'oldClass' => array(self::BELONGS_TO, 'TClasses', 'old_class_id'),
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
			'code' => '学号',
			'name' => '姓名',
			'status' => '状态(1:正常 2:异常)',
			'sex' => '性别(F: 女 M:男)',
			'id_card_no' => '身份证号码',
			'birthday' => '出生年月日',
			'class_id' => '现在所在班级ID',
			'old_class_id' => '原先所在班级ID',
			'accommodation' => '住宿情况',
			'payment1' => '缴费情况（第1学期）',
			'payment2' => '缴费情况（第2学期）',
			'payment3' => '缴费情况（第3学期）',
			'payment4' => '缴费情况（第4学期）',
			'payment5' => '缴费情况（第5学期）',
			'payment6' => '缴费情况（第6学期）',
			'bonus_penalty' => '奖惩情况',
			'address' => '家庭住址',
			'parents_tel' => '家长电话',
			'parents_qq' => '家长QQ',
			'school_of_graduation' => '毕业学校',
			'senior_score' => '中考总分',
			'school_year' => '入学年份',
			'college_score' => '高考总分',
			'university' => '录取学校',
			'comment' => '备注',
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
		$criteria->compare('id_card_no',$this->id_card_no,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('class_id',$this->class_id,true);
		$criteria->compare('old_class_id',$this->old_class_id,true);
		$criteria->compare('accommodation',$this->accommodation,true);
		$criteria->compare('payment1',$this->payment1,true);
		$criteria->compare('payment2',$this->payment2,true);
		$criteria->compare('payment3',$this->payment3,true);
		$criteria->compare('payment4',$this->payment4,true);
		$criteria->compare('payment5',$this->payment5,true);
		$criteria->compare('payment6',$this->payment6,true);
		$criteria->compare('bonus_penalty',$this->bonus_penalty,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('parents_tel',$this->parents_tel,true);
		$criteria->compare('parents_qq',$this->parents_qq,true);
		$criteria->compare('school_of_graduation',$this->school_of_graduation,true);
		$criteria->compare('senior_score',$this->senior_score);
		$criteria->compare('school_year',$this->school_year);
		$criteria->compare('college_score',$this->college_score);
		$criteria->compare('university',$this->university,true);
		$criteria->compare('comment',$this->comment,true);
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
	 * @return TStudents the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
