<?php

class ScoreForm extends CFormModel {

    public $ID;
    public $exam_id;
    public $exam_name;
    public $subject_id;
    public $subject_name;
    public $class_id;
    public $class_name;
    public $student_id;
    public $student_number;
    public $student_name;
    public $score;
    
    public $class_type; // 班级类型 普高还是中专
    public $grade; //年级

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('exam_id, subject_id, class_id', 'required',  'on'=>'create'),
            array('score', 'numerical', 'integerOnly' => true),
            array('exam_id, subject_id, class_id, student_id', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, exam_id, exam_name, subject_id, subject_name, class_id, class_name, student_id, student_number, student_name, score, grade', 'safe'),
            
            
            
            
            // 班级成绩查询时，班级信息必须输入
            array('class_id, exam_id', 'required', 'on'=>'class'),
            
            // 学生成绩分析
            array('exam_id, grade', 'required', 'on'=>'analysis'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'exam_id' => '考试名称',
            'exam_name' => '考试名称',
            'subject_id' => '科目',
            'subject_name' => '科目',
            'class_id' => '班级',
            'class_name' => '班级',
            'student_id' => '学生',
            'student_name' => '学生',
            'score' => '分数',
            'grade' => '年级',
        );
    }
    
    
    public function afterValidate() {
        parent::afterValidate();

        if ($this->scenario === 'class') {
            $class = TClasses::model()->find("ID=:ID", array(":ID" => $this->class_id));
            if (is_null($class)) {
                $this->addError('class_id', '所选班级信息不存在！');
            }

            $exam = MExams::model()->find("status='1' and ID=:ID", array(":ID" => $this->exam_id));
            if (is_null($class)) {
                $this->addError('exam_id', '所选考试信息不存在！');
            }
        }
    }
    


    
    
    

}
