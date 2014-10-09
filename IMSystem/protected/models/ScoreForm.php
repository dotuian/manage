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
    public $student_code;
    public $student_name;
    public $score;

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
            array('ID, exam_id, exam_name, subject_id, subject_name, class_id, class_name, student_id, student_code, student_name, score, ', 'safe'),
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
        );
    }

}