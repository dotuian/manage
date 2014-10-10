<?php

class TeacherForm extends CFormModel
{
    public $ID;
    public $code;
    public $name; 
    public $status;
    public $sex;
    public $birthday;
    public $address;
    public $telephonoe;
    // 教师科目（检索用）
    public $subject_id;
    // 教师角色
    public $roles = array();
    // 教师担任科目
    public $subjects = array();
    
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, sex, birthday, roles, address, telephonoe', 'required'),
			array('code', 'length', 'max'=>20),
			array('name', 'length', 'max'=>12),
			array('status, sex', 'length', 'max'=>1),
			array('address', 'length', 'max'=>100),
			array('telephonoe', 'length', 'max'=>11),
			array('birthday', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, code, name,subject_id, status, sex, birthday, address, telephonoe,roles,subjects', 'safe'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'code' => '教工号',
			'name' => '教师姓名',
			'status' => '状态',
			'sex' => '性别',
			'birthday' => '出生年月日',
			'address' => '地址',
			'telephonoe' => '电话号码',
		);
	}
    

}

