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
    public $role;
    
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name, sex, birthday, role, address, telephonoe', 'required'),
			array('code', 'length', 'max'=>20),
			array('name', 'length', 'max'=>12),
			array('status, sex', 'length', 'max'=>1),
			array('address', 'length', 'max'=>100),
			array('telephonoe', 'length', 'max'=>11),
			array('birthday', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, code, name, status, sex, birthday, address, telephonoe,role', 'safe'),
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
    
    public static function getTeacherRoleOption($flag){
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }
        
        $result['T'] = '普通教师';
        $result['T1'] = '教务处';
        $result['T2'] = '学生科';

        return $result;
    }
    
    
    public static function getStatusOption($flag){
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }
        
        return $result;
    }
    
}

