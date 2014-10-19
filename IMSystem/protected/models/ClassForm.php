<?php

class ClassForm extends CFormModel {

    public $ID;
    public $class_code;
    public $class_name;
    public $class_type;
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
            array('term_year', 'numerical', 'integerOnly' => true),
            array('class_code', 'length', 'max' => 20),
            array('class_name', 'length', 'max' => 50),
            array('status', 'length', 'max' => 1),
            array('teacher_id', 'length', 'max' => 10),
            array('ID, class_code, class_name, class_type, status, term_year, teacher_id', 'safe'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'class_code' => '班级',
            'class_name' => '班级名称',
            'class_type' => '文理科',
            'status' => '状态',
            'term_year' => '届',
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

        $year = date('Y') - $range;

        for ($i = $year; $i <= $year + $range * 2; $i++) {
            $result[$i] = $i;
        }
        return $result;
    }

}
