<?php

class TeacherForm extends CFormModel {
    public $ID;
    public $code;
    public $name;
    public $status;
    public $sex;
    public $birthday;
    public $id_card_no;
    public $home_address;
    public $telephonoe;
    public $nation;
    public $birthplace;
    public $working_date;
    public $party_date;
    public $before_degree;
    public $before_graduate_date;
    public $before_graduate_school;
    public $before_graduate_major;
    public $current_degree;
    public $current_graduate_date;
    public $current_graduate_school;
    public $current_graduate_major;
    public $professional_technical_position;
    public $work_departments_postion;
    public $current_position_rank;
    public $current_position_date;
    public $current_level_date;
    public $basic_memo;
    public $continue_education_address;
    public $continue_education_date;
    public $continue_education_credit;
    public $continue_education_prove_people;
    public $moral_praise;
    public $moral_student_evaluation;
    public $moral_target_check;
    public $moral_memo;
    public $teach_grades;
    public $teach_subjects;
    public $teaching_research_postion;
    public $recruit_students;
    public $attendance;
    public $working_memo;
    public $tutorship_award;
    public $competition_award;
    public $paper_work;
    public $competition_item;
    public $business_memo;
    
    // 教师科目（检索用）
    public $subject_id;
    // 教师角色
    public $roles = array();
    // 担任科目
    public $subjects = array();

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('code, name, sex, birthday, roles', 'required'),
            array('continue_education_credit', 'numerical', 'integerOnly' => true),
            array('code, continue_education_date', 'length', 'max' => 20),
            array('name', 'length', 'max' => 12),
            array('status, sex', 'length', 'max' => 1),
            array('id_card_no', 'length', 'max' => 18),

            array('telephonoe', 'length', 'max' => 11),
            array('nation, birthplace, before_degree, current_degree', 'length', 'max' => 10),
            array('working_date, party_date, before_graduate_date, current_graduate_date, current_position_date, current_level_date', 'length', 'max' => 7),
            array('before_graduate_school, before_graduate_major, current_graduate_school, current_graduate_major, professional_technical_position, work_departments_postion, current_position_rank, continue_education_address, continue_education_prove_people, teach_grades, teach_subjects, teaching_research_postion', 'length', 'max' => 50),
            array('birthday, basic_memo, moral_praise, moral_student_evaluation, moral_target_check, moral_memo, recruit_students, attendance, working_memo, tutorship_award, competition_award, paper_work, competition_item, business_memo, update_time', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('code', 'length', 'max' => 20),
            array('name', 'length', 'max' => 12, 'encoding'=>'UTF-8'),
            array('status, sex', 'length', 'max' => 1),
            array('home_address', 'length', 'max' => 50, 'encoding' => 'UTF-8'),
            array('telephonoe', 'length', 'max' => 11),
            array('birthday', 'date', 'format' => 'yyyy-MM-dd', 'allowEmpty' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('subject_id, subjects, roles, ID, code, name, status, sex, birthday, id_card_no, home_address, telephonoe, nation, birthplace, working_date, party_date, before_degree, before_graduate_date, before_graduate_school, before_graduate_major, current_degree, current_graduate_date, current_graduate_school, current_graduate_major, professional_technical_position, work_departments_postion, current_position_rank, current_position_date, current_level_date, basic_memo, continue_education_address, continue_education_date, continue_education_credit, continue_education_prove_people, moral_praise, moral_student_evaluation, moral_target_check, moral_memo, teach_grades, teach_subjects, teaching_research_postion, recruit_students, attendance, working_memo, tutorship_award, competition_award, paper_work, competition_item, business_memo', 'safe'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'roles' => '角色',
            'subjects' => '担任科目',
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
        );
    }
    
    public function afterValidate() {
        parent::afterValidate();
        // 角色添加
        if ($this->scenario === 'create') {
            if (TTeachers::model()->exists("code=:code", array(':code' => $this->code))) {
                $this->addError('code', '教师编号已经存在，请重新指定！');
            }

        }
        
        // 角色变更
        if ($this->scenario === 'update') {

        }
    }

}
