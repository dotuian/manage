<?php

/**
 * This is the model class for table "t_students".
 *
 * The followings are the available columns in table 't_students':
 * @property string $ID
 * @property string $province_code
 * @property string $name
 * @property string $status
 * @property string $sex
 * @property string $id_card_no
 * @property string $birthday
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
 * @property double $senior_score
 * @property integer $school_year
 * @property double $college_score
 * @property string $university
 * @property string $comment
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property TScores[] $tScores
 * @property TStudentClasses[] $tStudentClasses
 * @property TUsers $iD
 */
class TStudents extends CActiveRecord {
    
    // 学生信息更新时
    // 原先的班级
    public $old_class_id;
    // 原先的学号
    public $old_student_number;
    
    
    // 目前所在班级
    public $class_id;
    // 目前所在班级学号
    public $student_number;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 't_students';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, sex', 'required'),
            array('school_year, student_number', 'numerical', 'integerOnly' => true),
            array('senior_score, college_score', 'numerical'),
            array('province_code, id_card_no', 'length', 'max'=>18),
            array('name', 'length', 'max' => 12, 'encoding'=>'UTF-8'),
            array('status, sex, payment1, payment2, payment3, payment4, payment5, payment6', 'length', 'max' => 1),
            array('accommodation, school_of_graduation', 'length', 'max' => 50),
            array('bonus_penalty', 'length', 'max' => 200, 'encoding'=>'UTF-8'),
            array('address, university', 'length', 'max' => 100, 'encoding'=>'UTF-8'),
            array('parents_tel', 'numerical'),
            array('parents_tel', 'length', 'max' => 11),
            array('parents_qq', 'length', 'max' => 15),
            array('create_user, update_user, class_id, student_number', 'length', 'max' => 10),
            
            array('id_card_no', 'match','pattern' => "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/", 'message' => '请输入正确的身份证号码！', 'allowEmpty' => true),
            
            // ==============================================================================
            // 学生修改个人信息时(setting/profile)
            array('id_card_no, birthday', 'required', 'on' => 'profile'),
            array('birthday', 'date', 'format'=>'yyyy-MM-dd', 'on' => 'profile'),
            // QQ号码
            array('parents_qq', 'match','pattern' => '/^[1-9]{1}[0-9]{4,15}$/','message' => '请输入正确的QQ号码！', 'on' => 'profile'),
            // ==============================================================================
            
            // ==============================================================================
            // 学生信息更新时(student/update)
            array('id_card_no, class_id, student_number', 'required', 'on' => 'update'),
            array('birthday', 'date', 'format'=>'yyyy-MM-dd', 'on' => 'update'),
            // QQ号码
            array('parents_qq', 'match','pattern' => '/^[1-9]{1}[0-9]{4,15}$/','message' => '请输入正确的QQ号码！', 'on' => 'update'),
            
            array('old_class_id, old_student_number', 'safe', 'on' => 'update'),
            // ==============================================================================
            
            // safe
            array('ID, province_code, name, status, sex, id_card_no, birthday, accommodation, payment1, payment2, payment3, payment4, payment5, payment6, bonus_penalty, address, parents_tel, parents_qq, school_of_graduation, senior_score, school_year, college_score, university, comment, create_user, create_time, update_user, update_time', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tScores' => array(self::HAS_MANY, 'TScores', 'student_id'),
            'tStudentClasses' => array(self::HAS_MANY, 'TStudentClasses', 'student_id'),
            'iD' => array(self::BELONGS_TO, 'TUsers', 'ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'province_code' => '省内编号',
            'name' => '姓名',
            'status' => '状态', // (1:在校 2:离校)
            'sex' => '性别',
            'id_card_no' => '身份证号码',
            'birthday' => '出生年月日',
            'class_id' => '目前所在班级',
            'student_number' => '目前所在班级学号',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID, true);
        $criteria->compare('province_code', $this->province_code, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('sex', $this->sex, true);
        $criteria->compare('id_card_no', $this->id_card_no, true);
        $criteria->compare('birthday', $this->birthday, true);
        $criteria->compare('accommodation', $this->accommodation, true);
        $criteria->compare('payment1', $this->payment1, true);
        $criteria->compare('payment2', $this->payment2, true);
        $criteria->compare('payment3', $this->payment3, true);
        $criteria->compare('payment4', $this->payment4, true);
        $criteria->compare('payment5', $this->payment5, true);
        $criteria->compare('payment6', $this->payment6, true);
        $criteria->compare('bonus_penalty', $this->bonus_penalty, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('parents_tel', $this->parents_tel, true);
        $criteria->compare('parents_qq', $this->parents_qq, true);
        $criteria->compare('school_of_graduation', $this->school_of_graduation, true);
        $criteria->compare('senior_score', $this->senior_score);
        $criteria->compare('school_year', $this->school_year);
        $criteria->compare('college_score', $this->college_score);
        $criteria->compare('university', $this->university, true);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('create_user', $this->create_user, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_user', $this->update_user, true);
        $criteria->compare('update_time', $this->update_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TStudents the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function afterValidate() {
        parent::afterValidate();

        if ($this->scenario === 'update') {
            // 班级信息发生了修改
            if($this->old_class_id != $this->class_id) {
                if($this->old_student_number == $this->student_number) {
                    $this->addError('student_number', '班级发生了变更的同时，学号也必须变更！');
                }
            }
            
            // 学号发生了变化
            if($this->old_student_number != $this->student_number) {
                $count = TStudentClasses::model()->count("student_number=:student_number and student_id<>:student_id", array(':student_number' => $this->student_number, ':student_id'=>$this->ID));
                if ($count > 0) {
                    $this->addError("student_number", '已经存在相同的学号！');
                }
            }
            
            
        }
        
        // 学生个人信息修改
        if ($this->scenario === 'profile') {
            
            
        }
    }

    /**
     * 获取该学生的所有班级信息
     * @param type $student_id
     * @return type
     */
    public function getStudentAllClassInfo() {
        $sql = "SELECT a.*, b.student_number, c.code,c.name ";
        $sql .= "FROM t_classes a ";
        $sql .= "INNER JOIN t_student_classes b ON a.ID=b.class_id and b.student_id=:student_id ";
        $sql .= "left join t_teachers c on c.ID=a.teacher_id ";
        $sql .= "order by b.create_user asc  ";

        $params = array(':student_id' => $this->ID);
        $data = Yii::app()->db->createCommand($sql)->queryAll(true, $params);
        
        return $data;
    }
    
    
    public function getSexName($sex){
        $sexname = '';
        switch ($sex) {
            case 'M':
                $sexname = '女';
                break;
            case 'F':
                $sexname = '男';
                break;
            default:
                break;
        }
        
        return $sexname;
    }
    
    public function getPaymentName($payment){
        $result = '';
        switch ($payment) {
            case '0':
                $sexname = '未';
                break;
            case '1':
                $sexname = '缴';
                break;
            default:
                break;
        }
        return $result;
    }
    
}
