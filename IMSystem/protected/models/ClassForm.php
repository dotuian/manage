<?php

class ClassForm extends CFormModel {
    public $ID;
    public $class_code;
    public $class_name;
    public $grade; // 年级
    public $entry_year; // 年度
    public $term_type;  // 学期类型
    public $class_type; // 
    public $specialty_name; // 专业名称
    public $status;
    public $teacher_id;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // 共同
            array('class_code, class_name, class_type, entry_year, term_type, teacher_id, grade', 'required'),
            array('entry_year', 'numerical', 'integerOnly' => true),
            array('class_name, specialty_name', 'length', 'max' => 20, 'encoding'=>'UTF-8'),
            
            //========================================================================
            // 班级代号
            array('class_code', 'length', 'max' => 10, 'encoding' => 'UTF-8'),
            // 班级名称
            array('class_code', 'length', 'max' => 20, 'encoding'=>'UTF-8'),
            // 班级性质
            array('class_type','in','range'=>array('0','1'),'allowEmpty'=>false),
            // 专业名称
            array('class_code', 'length', 'max' => 20, 'encoding'=>'UTF-8'),
            // 年级
            array('grade', 'length', 'max' => 1),
            // 入学年份
            array('entry_year', 'length', 'max' => 4),
            // 班主任
            array('teacher_id', 'length', 'max' => 10),
            //========================================================================
            
            array('ID, class_code, class_name, grade, class_type, specialty_name, status, entry_year, teacher_id', 'safe'),
        );
    }
    
    public function afterValidate() {
        parent::afterValidate();
        
        // 角色添加
        if ($this->scenario === 'create') {

//            $this->addError('role_code', '角色CODE已经存在，请重新指定！');
        }
        
        // 角色变更
        if ($this->scenario === 'update') {

        }
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'class_code' => '班级代号',
            'class_name' => '班级名称',
            'grade' => '年级',
            'class_type' => '班级性质',
            'term_type' => '学期',
            'specialty_name' => '专业名称',
            'status' => '状态',
            'entry_year' => '年度',
            'teacher_id' => '班主任',
        );
    }

    
    
    
}
