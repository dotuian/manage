
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
 * @property string $id_card_no
 * @property string $home_address
 * @property string $telephonoe
 * @property string $nation
 * @property string $birthplace
 * @property string $working_date
 * @property string $party_date
 * @property string $before_degree
 * @property string $before_graduate_date
 * @property string $before_graduate_school
 * @property string $before_graduate_major
 * @property string $current_degree
 * @property string $current_graduate_date
 * @property string $current_graduate_school
 * @property string $current_graduate_major
 * @property string $professional_technical_position
 * @property string $work_departments_postion
 * @property string $current_position_rank
 * @property string $current_position_date
 * @property string $current_level_date
 * @property string $basic_memo
 * @property string $continue_education_address
 * @property string $continue_education_date
 * @property integer $continue_education_credit
 * @property string $continue_education_prove_people
 * @property string $moral_praise
 * @property string $moral_student_evaluation
 * @property string $moral_target_check
 * @property string $moral_memo
 * @property string $teach_grades
 * @property string $teach_subjects
 * @property string $teaching_research_postion
 * @property string $recruit_students
 * @property string $attendance
 * @property string $working_memo
 * @property string $tutorship_award
 * @property string $competition_award
 * @property string $paper_work
 * @property string $competition_item
 * @property string $business_memo
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property MCourses[] $mCourses
 * @property TClasses[] $tClasses
 * @property TTeacherSubjects[] $tTeacherSubjects
 * @property TUsers $iD
 */
class TTeachers extends CActiveRecord
{
    // 教师角色
    public $roles = array();
    // 担任科目
    public $subjects = array();

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 't_teachers';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('code, name, sex, birthday', 'required'),
            array('continue_education_credit', 'numerical', 'integerOnly' => true),
            array('code, continue_education_date', 'length', 'max' => 20),
            array('name', 'length', 'max' => 12),
            array('status, sex', 'length', 'max' => 1),
            array('id_card_no', 'length', 'max' => 18),

            array('telephonoe', 'length', 'max' => 11),
            array('nation, birthplace, before_degree, current_degree, create_user, update_user', 'length', 'max' => 10),
            array('working_date, party_date, before_graduate_date, current_graduate_date, current_position_date, current_level_date', 'length', 'max' => 7),
            array('before_graduate_school, before_graduate_major, current_graduate_school, current_graduate_major, professional_technical_position, work_departments_postion, current_position_rank, continue_education_address, continue_education_prove_people, teach_grades, teach_subjects, teaching_research_postion', 'length', 'max' => 50),
            array('birthday, basic_memo, moral_praise, moral_student_evaluation, moral_target_check, moral_memo, recruit_students, attendance, working_memo, tutorship_award, competition_award, paper_work, competition_item, business_memo, update_time', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, code, name, status, sex, birthday, id_card_no, home_address, telephonoe, nation, birthplace, working_date, party_date, before_degree, before_graduate_date, before_graduate_school, before_graduate_major, current_degree, current_graduate_date, current_graduate_school, current_graduate_major, professional_technical_position, work_departments_postion, current_position_rank, current_position_date, current_level_date, basic_memo, continue_education_address, continue_education_date, continue_education_credit, continue_education_prove_people, moral_praise, moral_student_evaluation, moral_target_check, moral_memo, teach_grades, teach_subjects, teaching_research_postion, recruit_students, attendance, working_memo, tutorship_award, competition_award, paper_work, competition_item, business_memo, create_user, create_time, update_user, update_time', 'safe', 'on' => 'search'),

            array('code', 'length', 'max' => 20),
            array('name', 'length', 'max' => 12, 'encoding' => 'UTF-8'),
            array('create_user, update_user', 'length', 'max' => 10),
            array('status, sex', 'length', 'max' => 1),
            array('home_address', 'length', 'max' => 50, 'encoding' => 'UTF-8'),
            array('telephonoe', 'length', 'max' => 11),
            array('birthday', 'date', 'format' => 'yyyy-M-d', 'allowEmpty' => true),
            array('roles, subjects', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'mCourses' => array(self::HAS_MANY, 'MCourses', 'teacher_id'),
            'tClasses' => array(self::HAS_MANY, 'TClasses', 'teacher_id'),
            'tTeacherSubjects' => array(self::HAS_MANY, 'TTeacherSubjects', 'teacher_id'),
            'iD' => array(self::BELONGS_TO, 'TUsers', 'ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'code' => '教工编号',
            'name' => '教师姓名',
            'status' => '状态', // (1:正常 2:异常)
            'sex' => '性别', // (F: 女 M:男)
            'birthday' => '出生年月日',
            'id_card_no' => '身份证号码',
            'home_address' => '家庭住址',
            'telephonoe' => '电话号码',
            'nation' => '民族',
            'birthplace' => '籍贯',
            'working_date' => '工作年月',
            'party_date' => '入党年月',
            'before_degree' => '职前学历',
            'before_graduate_date' => '职前毕业时间',
            'before_graduate_school' => '职前毕业院校',
            'before_graduate_major' => '职前毕业专业',
            'current_degree' => '现学历',
            'current_graduate_date' => '现学历毕业时间',
            'current_graduate_school' => '现学历毕业院校',
            'current_graduate_major' => '现学历毕业专业',
            'professional_technical_position' => '专业技术职务',
            'work_departments_postion' => '工作科室及职务',
            'current_position_rank' => '现职级',
            'current_position_date' => '任现职年月',
            'current_level_date' => '任现级年月',
            'basic_memo' => '基本情况备注',
            'continue_education_address' => '继续教育地址',
            'continue_education_date' => '继续教育时间',
            'continue_education_credit' => '获得学分',
            'continue_education_prove_people' => '证明人',
            'moral_praise' => '表彰情况',
            'moral_student_evaluation' => '学生测评',
            'moral_target_check' => '目标考核',
            'moral_memo' => '师德备注',
            'teach_grades' => '任教年级',
            'teach_subjects' => '课程',
            'teaching_research_postion' => '教研职务',
            'recruit_students' => '招生情况',
            'attendance' => '考勤情况',
            'working_memo' => '履职备注',
            'tutorship_award' => '辅导获奖',
            'competition_award' => '参赛获奖',
            'paper_work' => '论文著作',
            'competition_item' => '参赛项目情况',
            'business_memo' => '业务备注',
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
        $criteria->compare('code', $this->code, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('sex', $this->sex, true);
        $criteria->compare('birthday', $this->birthday, true);
        $criteria->compare('id_card_no', $this->id_card_no, true);
        $criteria->compare('home_address', $this->home_address, true);
        $criteria->compare('telephonoe', $this->telephonoe, true);
        $criteria->compare('nation', $this->nation, true);
        $criteria->compare('birthplace', $this->birthplace, true);
        $criteria->compare('working_date', $this->working_date, true);
        $criteria->compare('party_date', $this->party_date, true);
        $criteria->compare('before_degree', $this->before_degree, true);
        $criteria->compare('before_graduate_date', $this->before_graduate_date, true);
        $criteria->compare('before_graduate_school', $this->before_graduate_school, true);
        $criteria->compare('before_graduate_major', $this->before_graduate_major, true);
        $criteria->compare('current_degree', $this->current_degree, true);
        $criteria->compare('current_graduate_date', $this->current_graduate_date, true);
        $criteria->compare('current_graduate_school', $this->current_graduate_school, true);
        $criteria->compare('current_graduate_major', $this->current_graduate_major, true);
        $criteria->compare('professional_technical_position', $this->professional_technical_position, true);
        $criteria->compare('work_departments_postion', $this->work_departments_postion, true);
        $criteria->compare('current_position_rank', $this->current_position_rank, true);
        $criteria->compare('current_position_date', $this->current_position_date, true);
        $criteria->compare('current_level_date', $this->current_level_date, true);
        $criteria->compare('basic_memo', $this->basic_memo, true);
        $criteria->compare('continue_education_address', $this->continue_education_address, true);
        $criteria->compare('continue_education_date', $this->continue_education_date, true);
        $criteria->compare('continue_education_credit', $this->continue_education_credit);
        $criteria->compare('continue_education_prove_people', $this->continue_education_prove_people, true);
        $criteria->compare('moral_praise', $this->moral_praise, true);
        $criteria->compare('moral_student_evaluation', $this->moral_student_evaluation, true);
        $criteria->compare('moral_target_check', $this->moral_target_check, true);
        $criteria->compare('moral_memo', $this->moral_memo, true);
        $criteria->compare('teach_grades', $this->teach_grades, true);
        $criteria->compare('teach_subjects', $this->teach_subjects, true);
        $criteria->compare('teaching_research_postion', $this->teaching_research_postion, true);
        $criteria->compare('recruit_students', $this->recruit_students, true);
        $criteria->compare('attendance', $this->attendance, true);
        $criteria->compare('working_memo', $this->working_memo, true);
        $criteria->compare('tutorship_award', $this->tutorship_award, true);
        $criteria->compare('competition_award', $this->competition_award, true);
        $criteria->compare('paper_work', $this->paper_work, true);
        $criteria->compare('competition_item', $this->competition_item, true);
        $criteria->compare('business_memo', $this->business_memo, true);
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
     * @return TTeachers the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * 获取所有教师的信息
     * @param type $flag
     * @return string
     */
    public function getAllTeacherGroupOption($flag = true, $subject_code=null){
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }
        
        $sql = "select c.subject_name, a.ID, a.code, a.name from t_teachers a , t_teacher_subjects b , m_subjects c ";
        $sql .= "where a.ID = b.teacher_id and b.subject_id=c.ID and a.`status`= '1' and c.`status`='1' ";
        
        $params = array();
        if (!is_null($subject_code)) {
            $sql .= " and c.subject_code=:subject_code";
            $params[':subject_code'] = trim($subject_code);
        }

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->query($params);
        
        foreach ($data as $value) {
            ///$result[$value['subject_name']][] = array($value['ID'] => $value['code'] .'|' . $value['name']);
            $result[$value['subject_name']][$value['ID']] = $value['code'] . '|' . $value['name'];
        }
        
        Yii::log(print_r($result, true));
        
        return $result;
    }
    
    /**
     * 
     * @param type $flag
     * @return string
     */
    public function getAllTeacherOption($flag){
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }
        
        $data = TTeachers::model()->findAll("status='1'");
        foreach ($data as $value) {
            $result[$value->ID] = $value->code . ' | ' . $value->name;
        }
        
        return $result;
    }
    
    /**
     * 获取所有班主任的信息
     * @param type $flag
     * @return string
     */
    public function getAllHeadTeacherOption($flag = true){
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $sql = "select DISTINCT b.* from t_classes a , t_teachers b where a.teacher_id=b.ID and a.status='1' and b.status='1'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->query();
        
        foreach ($data as $value) {
            $result[$value['ID']] = $value['code'] . ' | ' . $value['name'];
        }
        return $result;
    }
    

    /**
     * 获取指定科目的所有教师信息
     * @param type $flag
     * @return string
     */
    public function getTeachersBySubjectIdOption($subject_id, $flag = true){
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $sql = "select DISTINCT a.* from t_teachers a, t_teacher_subjects b, m_subjects c where a.ID=b.teacher_id and b.subject_id=c.ID and a.status='1' and c.status='1' and c.id=:subject_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindValue(":subject_id", $subject_id);
        $data = $command->query();
        
        foreach ($data as $value) {
            $result[$value['ID']] = $value['code'] . ' | ' . $value['name'];
        }
        return $result;
    }
    
    
    /**
     * 获取该教师担任的所有科目的ID
     * @return type
     */
    public function getTeacherSubjectIds(){
        $result = array();
        
        foreach ($this->tTeacherSubjects as $teacherSubject) {
            $result[] = $teacherSubject->subject_id;
        }
        
        return $result;
    }
    
}
