<?php

class SubjectForm extends CFormModel
{
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
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject_code, subject_name, subject_short_name', 'required'),
			array('subject_code, subject_name', 'length', 'max'=>10),
			array('subject_short_name', 'length', 'max'=>4),
			array('subject_type, status', 'length', 'max'=>1),
			array('level', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, subject_code, subject_name, subject_short_name, subject_type, status, level', 'safe'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
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

        $result['0'] = '综合';
        $result['1'] = '文科';
        $result['2'] = '理科';
        $result['3'] = '技能';
        
        return $result;
    }
}
