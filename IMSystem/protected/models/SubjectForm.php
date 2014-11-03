<?php

class SubjectForm extends CFormModel {

    public $ID;
    public $subject_code;
    public $subject_name;
    public $subject_short_name;
    public $subject_type;
    public $status;
    public $level;
    public $total_score;
    public $pass_score;
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // 共同
            array('subject_code, subject_name, subject_short_name,subject_type, total_score, pass_score', 'required'),
            
            // 科目代号
            array('subject_code', 'length', 'max' => 10),
            // 科目名称
            array('subject_name', 'length', 'max' => 10, 'encoding' => 'UTF-8'),
            // 科目简称
            array('subject_short_name', 'length', 'max' => 4, 'encoding' => 'UTF-8'),
            // 科目类型(0:普高 1:技能)
            array('subject_type', 'length', 'max' => 1),
            array('subject_type','in','range'=>array('0','1'),'allowEmpty'=>false),

            array('total_score, pass_score', 'length', 'max' => 3),
            array('total_score, pass_score', 'numerical', 'integerOnly' => true),

            
            array('ID, subject_code, subject_name, subject_short_name, subject_type, status, level', 'safe'),
        );
    }

    public function afterValidate() {
        parent::afterValidate();

        if ($this->scenario === 'create') {
//                $this->addError('role_name', '角色名称已经存在，请重新指定！');
        }
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'subject_code' => '科目代号',
            'subject_name' => '科目名称',
            'subject_short_name' => '科目名称(简称)',
            'subject_type' => '科目类型',
            'status' => '状态',
            'level' => '显示排序用',
            'total_score' => '总分',
            'pass_score' => '及格分数',
        );
    }

    public static function getSubjectTypeOption($flag) {
        $result = array();
        if ($flag === true) {
            $result[''] = Yii::app()->params['EmptySelectOption'];
        }

        $result['0'] = '普通高中';
        $result['1'] = '技能专业';

        return $result;
    }

    public static function getSubjectStatusOption($flag) {
        $result = array();
        if ($flag === true) {
            $result[''] = Yii::app()->params['EmptySelectOption'];
        }

        $result['1'] = '使用中';
        $result['2'] = '停止中';

        return $result;
    }

}
