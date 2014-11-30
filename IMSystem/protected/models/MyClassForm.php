<?php

class MyClassForm extends CFormModel {
    public $class_id;
    
    public $exam_id;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // 共同
            array('class_id', 'required'),
            
            array('exam_id', 'required', 'on'=>'score'), // 查看学生的成绩信息
            
            array('class_id, exam_id', 'safe'),
        );
    }
    
    public function afterValidate() {
        parent::afterValidate();
        
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'class_id' => '班级',
            'exam_id' => '考试名称',
        );
    }

    
    
    
}
