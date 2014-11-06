<?php

//array('contact','required','on'=>'edit','message'=>'联系人必须填写.'),
//array('contact','length','on'=>'edit','min'=>2,'max'=>10,'tooShort'=>'联系人长度请控制在2-10个字符.','tooLong'=>'联系人长度请控制在2-10个字符.'),
//
//array('tel', 'match','pattern' => '/^(\d{3}-|\d{4}-)(\d{8}|\d{7})?$/','message' => '请输入正确的电话号码.'),
//array('fax', 'match','pattern' => '/^(\d{3}-|\d{4}-)(\d{8}|\d{7})?$/','message' => '请输入正确的传真号码.'),
//array('mobile', 'match','pattern' => '/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/','message' => '请输入正确的手机号码.'),
//
//array('email','email','on'=>'edit','message'=>'邮箱输入有误.'),
//
//array('zipcode','required','on'=>'edit','message'=>'邮编必须填写.'),
//array('zipcode','numerical','on'=>'edit','message'=>'邮编是6位数字.'),
//array('zipcode','length','on'=>'edit','min'=>6,'max'=>6,'tooShort'=>'邮编长度为6位数.','tooLong'=>'邮编长度为6位数.'),
//
//array('website','url','on'=>'edit','message'=>'网址输入有误.'),
//array('qq', 'match','pattern' => '/^[1-9]{1}[0-9]{4,11}$/','message' => '请输入正确的QQ号码.'),
//array('msn','email','on'=>'edit','message'=>'MSN输入有误.'),


class StudentForm extends CFormModel {

    public $ID;
    public $province_code; //省内编号
    public $student_number; //学号
    public $name;
    public $status = '1'; // 默认在校
    public $sex = 'M'; // 默认男性
    public $id_card_no;
    public $birthday;
    public $class_id;
    public $old_class_id;
    public $accommodation;
    public $payment1 = '0'; // 默认费用未缴
    public $payment2 = '0'; // 默认费用未缴
    public $payment3 = '0'; // 默认费用未缴
    public $payment4 = '0'; // 默认费用未缴
    public $payment5 = '0'; // 默认费用未缴
    public $payment6 = '0'; // 默认费用未缴
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
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('student_number, name, sex, class_id, birthday, id_card_no', 'required'),
            array('id_card_no, school_year, student_number', 'numerical', 'integerOnly' => true),
            array('senior_score, college_score', 'numerical', 'integerOnly' => false),
            array('senior_score, college_score', 'length', 'max' => 5),
            array('id_card_no', 'length', 'max' => 18),
            array('class_id, old_class_id', 'length', 'max' => 10),
            
            array('sex, payment1, payment2, payment3, payment4, payment5, payment6', 'length', 'max' => 1),
            array('accommodation, school_of_graduation', 'length', 'max' => 50, 'encoding'=>'UTF-8'),
            array('bonus_penalty', 'length', 'max' => 200, 'encoding'=>'UTF-8'),
            array('address, university', 'length', 'max' => 100, 'encoding'=>'UTF-8'),
            
            // 学号
            array('province_code, student_number', 'length', 'max' => 10),
            // 姓名
            array('name', 'length', 'max' => '10', 'encoding' => 'UTF-8'),
            // 性别
            array('sex','in','range'=>array('F', 'M'),'allowEmpty'=>false),
            // 出生年月日
            array('birthday', 'date', 'format'=>'yyyy-M-d'),
            
            // 缴费情况(0: 未缴 1:已缴)
            array('payment1, payment2, payment3, payment4, payment5, payment6', 'length', 'max' => 1),
            array('payment1, payment2, payment3, payment4, payment5, payment6','in','range'=>array('0','1'),'allowEmpty'=>false),
            // 家庭住址
            array('address', 'length', 'max' => 80, 'encoding'=>'UTF-8'),
            // 电话号码
            array('parents_tel', 'numerical'),
            array('parents_tel', 'length', 'max' => 11),
            // QQ号码
            array('parents_qq', 'length', 'max' => 15),
            array('parents_qq', 'match','pattern' => '/^[1-9]{1}[0-9]{4,15}$/','message' => '请输入正确的QQ号码！'),
            // 毕业学校
            array('university', 'length', 'max' => 30, 'encoding'=>'UTF-8'),
            
            // 入学年份
            array('school_year', 'numerical'),
            array('school_year', 'length', 'max' => 4),
            
            array('ID, province_code,student_number, name, status, sex, id_card_no, birthday, class_id, old_class_id, accommodation, payment1, payment2, payment3, payment4, payment5, payment6, bonus_penalty, address, parents_tel, parents_qq, school_of_graduation, senior_score, school_year, college_score, university, comment', 'safe'),
        );
    }

    public function afterValidate() {
        parent::afterValidate();

        $count = TStudentClasses::model()->count("student_number=:student_number", array(':student_number' => $this->student_number));
        if ($count > 0) {
            $this->addError("student_number", '已经存在相同的学号！');
        }
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'province_code' => '省内编号',
            'student_number' => '学号',
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

    public static function getStudentStatusOption($flag = true) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $result['1'] = '在校';
        $result['2'] = '离校';

        return $result;
    }

    public static function getPaymentOption($flag = true) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $result['0'] = '未缴';
        $result['1'] = '已缴';

        return $result;
    }

    public static function getSexOption($flag = true) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $result['M'] = '男';
        $result['F'] = '女';

        return $result;
    }

}
