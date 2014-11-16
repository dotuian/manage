<?php

class ClassForm extends CFormModel {
    public $ID;
    public $class_code;
    public $class_name;
    public $grade; // 年级
    public $entry_year; // 入学年份
    public $term_type; // 学期类型
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
            'entry_year' => '入学年份',
            'teacher_id' => '班主任',
        );
    }
    
    public static function getGradeOption($flag){
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $result['1'] = '一年级';
        $result['2'] = '二年级';
        $result['3'] = '三年级';

        return $result;
    }
    
    
    public static function getTermTypeOption($flag) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $result['0'] = '整学年';
        $result['1'] = '上学期';
        $result['2'] = '下学期';

        return $result;
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

    public static function getEntryYearOption($range = 1, $flag = true) {
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
    
    public static function getTermTypeDisplayName($term_type) {
        $term_name = '';
        switch ($term_type) {
            case '0':
                $term_name = '整学年';
                break;
            case '1':
                $term_name = '上学期';
                break;
            case '2':
                $term_name = '下学期';
                break;
            default:
                break;
        }
        return $term_name;
    }
    
    public static function getEntryYearDisplayName($entry_year) {
        $str = '';
        switch ($entry_year) {
            case '1':
                $str = '一年级';
                break;
            case '2':
                $str = '二年级';
                break;
            case '3':
                $str = '三年级';
                break;
            default:
                break;
        }
        return $str;
    }
}
