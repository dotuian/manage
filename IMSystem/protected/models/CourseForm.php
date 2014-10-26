<?php

class CourseForm extends CFormModel {

    public $type;
    public $subject_id;
    public $teacher_id;
    public $class_id;
    public $status;
    public $teacher_name;
    
    // 需要添加的课程信息
    public $subjects = array();

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('class_id, subjects', 'required'),
            array('subject_id, teacher_id, class_id', 'length', 'max' => 10),
            array('status, type', 'length', 'max' => 1),
            array('type, subject_id, teacher_id, class_id, status, teacher_name, subjects', 'safe'),
            // 课程信息添加 create
            array('subject_id, teacher_id, class_id', 'required', 'on' => 'create'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'type' => '添加方式',
            'subject_id' => '科目',
            'teacher_id' => '任课教师',
            'teacher_name' => '任课教师',
            'class_id' => '班级',
            'status' => '状态',
            'subjects' => '科目',
        );
    }
    
    public function afterValidate() {
        parent::afterValidate();

        if ($this->scenario === 'create') {
            $result = MCourses::model()->exists("subject_id=:subject_id and teacher_id=:teacher_id and class_id=:class_id and status='1'",
                    array(':subject_id'=>$this->subject_id, ':teacher_id'=>$this->teacher_id, ':class_id'=>$this->class_id));
            if($result){
//                $this->addError('subject_id', '课程安排已经存在，请重新指定！');
            }
            
            if(empty($this->subjects) || count($this->subjects) == 0 ){
                $this->addError('subjects', '请指定要录入课程对应的科目信息！');
            }
            
            
            $class = TClasses::model()->find("status='1' and ID=:ID", array(":ID"=>$this->class_id));
            if(is_null($class)){
                $this->addError('class_id','该班级信息不存在！');
            }
            
        }
        
        
    }
    
    

}
