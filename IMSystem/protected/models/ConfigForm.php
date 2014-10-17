<?php

class ConfigForm extends CFormModel {

    // 班主任导入学生信息时间设置
    public $import_student_start_date;
    public $import_student_end_date;
    // 系统是否在运行中(维护用的字段)
    public $running = '1';

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // name, email, subject and body are required
            array('import_student_start_date, import_student_end_date, running', 'required'),
            
            
            
            array('import_student_start_date, import_student_end_date, running', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'import_student_start_date' => '开始日期',
            'import_student_end_date' => '结束日期',
            'running' => '系统是否运行中',
        );
    }

    
    public static function getRunningOption($flag) {
        $result = array();
        if ($flag === true) {
            $result[''] = Yii::app()->params['EmptySelectOption'];
        }

        $result['1'] = '运行中';
        $result['0'] = '维护中';
        
        return $result;
    }
    
}