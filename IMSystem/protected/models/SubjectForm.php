<?php

class SubjectForm extends CFormModel {

    public $ID;
    public $subject_code;
    public $subject_name;
    public $subject_short_name;
    public $subject_type;
    public $status;
    public $level;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('qq', 'match','pattern' => '/^[1-9]{1}[0-9]{4,11}$/','message' => '请输入正确的QQ号码.'),
            
            array('subject_code, subject_name, subject_short_name,subject_type', 'required'),
            array('subject_name', 'length', 'max' => 20),
            array('subject_code', 'length', 'max' => 10),
            array('subject_short_name', 'length', 'max' => 10),
            array('subject_type, status', 'length', 'max' => 1),
            array('level', 'length', 'max' => 2),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
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

}
