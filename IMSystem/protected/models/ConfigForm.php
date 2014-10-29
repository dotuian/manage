<?php

class ConfigForm extends CFormModel {

    // 班主任导入学生信息时间设置
    public $import_student_start_date;
    public $import_student_end_date;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // name, email, subject and body are required
            array('import_student_start_date, import_student_end_date', 'required'),
            array('import_student_start_date, import_student_end_date', 'date', 'format'=>'yyyy-MM-dd'),

            array('import_student_start_date, import_student_end_date', 'safe'),
        );
    }

    public function afterValidate() {
        parent::afterValidate();
        
        // 开始日期和结束日期的前后范围检查
        $format = 'yyyy-MM-dd';
        $start = CDateTimeParser::parse($this->import_student_start_date, $format);
        $end = CDateTimeParser::parse($this->import_student_end_date, $format);
        if ($end < $start) {
            $this->addError('import_student_end_date', '结束日期不能早于开始日期！');
        }
        
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
        );
    }

}