<?php

class ClassForm extends CFormModel {
    public $ID;
    public $class_code;
    public $class_name;
    public $class_type;
    public $specialty_name;
    public $status;
    public $term_year;
    public $teacher_id;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('class_code, class_name, class_type, term_year, teacher_id', 'required'),
            array('class_code, term_year', 'numerical', 'integerOnly' => true),
            array('class_name, specialty_name', 'length', 'max' => 50, 'encoding'=>'UTF-8'),
            
            array('ID, class_code, class_name, class_type, specialty_name, status, term_year, teacher_id', 'safe'),
            
            // 班级代号
            array('class_code', 'length', 'max' => 3, 'encoding'=>'UTF-8'),
            
            // 班级名称
            // 班级性质
            array('class_type','in','range'=>array('0','1'),'allowEmpty'=>false),
            
            // 专业名称
            
            // 入学年份
            
            // 班主任
            array('teacher_id', 'length', 'max' => 10),
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
            'class_type' => '班级性质',
            'specialty_name' => '专业名称',
            'status' => '状态',
            'term_year' => '入学年份',
            'teacher_id' => '班主任',
        );
    }

    public static function getClassStatusOption($flag) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $result['1'] = '正常';
        $result['2'] = '暂停';

        return $result;
    }

    public static function getClassTypeOption($flag) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $result['0'] = '普通高中';
        $result['1'] = '技能专业';
        
        return $result;
    }

    public static function getTermYearOption($range = 1, $flag = true) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $year = date('Y');

        for ($i = $year - $range; $i <= $year ; $i++) {
            $result[$i] = $i;
        }
        return $result;
    }

}
