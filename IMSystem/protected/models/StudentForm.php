<?php

class StudentForm extends CFormModel
{
    public $ID;
    public $code;
    public $name;
    public $status;
    public $sex = 'M';
    public $id_card_no;
    public $birthday;
    public $class_id;
    public $old_class_id;
    public $accommodation;
    public $payment1;
    public $payment2;
    public $payment3;
    public $payment4;
    public $payment5;
    public $payment6;
    public $bonus_penalty;
    public $address;
    public $parents_tel;
    public $parents_qq;
    public $school_of_graduation;
    public $senior_score;
    public $school_year;
    public $college_score;
    public $university;
    public $comment;
    
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, sex, class_id, id_card_no', 'required'),
			array('senior_score, school_year, college_score', 'numerical', 'integerOnly'=>true),
			array('code, id_card_no', 'length', 'max'=>20),
			array('name, class_id, old_class_id', 'length', 'max'=>10),
			array('status, sex', 'length', 'max'=>1),
			array('accommodation, payment1, payment2, payment3, payment4, payment5, payment6, bonus_penalty, school_of_graduation', 'length', 'max'=>50),
			array('address, university', 'length', 'max'=>100),
			array('parents_tel', 'length', 'max'=>11),
			array('parents_qq', 'length', 'max'=>15),
			array('birthday, comment', 'safe'),

			array('ID, code, name, status, sex, id_card_no, birthday, class_id, old_class_id, accommodation, payment1, payment2, payment3, payment4, payment5, payment6, bonus_penalty, address, parents_tel, parents_qq, school_of_graduation, senior_score, school_year, college_score, university, comment', 'safe'),
		);
	}

    public function afterValidate() {
        parent::afterValidate();
        
        $count = TStudents::model()->count("code=:code", array(':code' => $this->code));
        if($count > 0) {
            $this->addError("code", '已经存在相同的学号！');
        }
        
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
			'status' => '状态',
			'sex' => '性别',
			'id_card_no' => '身份证号码',
			'birthday' => '出生年月日',
			'class_id' => '班级',
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
		);
	}
    
    
    public static function getPaymentOption($flag) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }
        
        $result['1'] = '已缴';
        $result['2'] = '未缴';

        return $result;
    }
}
