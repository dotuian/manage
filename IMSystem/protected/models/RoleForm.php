<?php
class RoleForm extends CFormModel
{
    public $role_id;
    public $role_code;
    public $role_name;
    public $level;
    public $authoritys = array();
    
    public $student_authoritys = array();
    public $teacher_authoritys = array();
    public $subject_authoritys = array();
    public $score_authoritys = array();
    public $class_authoritys = array();
    public $role_authoritys = array();
    public $other_authoritys = array();
    
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_name', 'required'),
			array('role_code', 'length', 'max'=>10),
			array('role_name', 'length', 'max'=>50),
			array('role_id, role_code, role_name, level， authoritys, student_authoritys, teacher_authoritys, subject_authoritys, score_authoritys, class_authoritys, role_authoritys, other_authoritys', 'safe'),
		);
	}

    public function afterValidate() {
        parent::afterValidate();
        // 角色添加
        if ($this->scenario === 'create') {
            if (MRoles::model()->exists("role_code=:role_code and status='1'", array(':role_code' => $this->role_code))) {
                $this->addError('role_code', '角色CODE已经存在，请重新指定！');
            }

            if (MRoles::model()->exists("role_name=:role_name and status='1'", array(':role_name' => $this->role_name))) {
                $this->addError('role_name', '角色名称已经存在，请重新指定！');
            }
        }
        
        // 角色变更
        if ($this->scenario === 'update') {
            if (MRoles::model()->exists("role_name=:role_name and status='1' and ID<>:ID", array(':role_name' => $this->role_name, ':ID'=>$this->role_id))) {
                $this->addError('role_name', '角色名称已经存在，请重新指定！');
            }
        }
    }
    
    
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'role_code' => '角色CODE',
			'role_name' => '角色名',
			'level' => '排序',
		);
	}
    
    public function autoRoleCode() {
        $count = MRoles::model()->count();
        return 'R' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
    }
    
}
