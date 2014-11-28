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
    public $score_authoritys = array();
    public $class_authoritys = array();
    public $subject_authoritys = array();
    public $course_authoritys = array();
    public $role_authoritys = array();
    public $authority_authoritys = array();
    public $other_authoritys = array();
    public $system_authoritys = array();
    public $myclass_authoritys = array();
    
	/**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('role_name', 'required'),
            array('role_code', 'length', 'max' => 10),
            array('role_name', 'length', 'max' => 50, 'encoding'=>'UTF-8'),
            array('role_id, role_code, role_name, level， authoritys, student_authoritys, teacher_authoritys, score_authoritys, class_authoritys, subject_authoritys, course_authoritys, role_authoritys, authority_authoritys, other_authoritys, system_authoritys, myclass_authoritys', 'safe'),
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
    public function attributeLabels() {
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

    
    public function initAuthoritys(){
        if (empty($this->authoritys)) {
            $this->authoritys = array();
        }
        
        if (is_array($this->class_authoritys)) {
            $this->authoritys = array_merge($this->authoritys, $this->class_authoritys);
        }
        if (is_array($this->subject_authoritys)) {
            $this->authoritys = array_merge($this->authoritys, $this->subject_authoritys);
        }
        if (is_array($this->course_authoritys)) {
            $this->authoritys = array_merge($this->authoritys, $this->course_authoritys);
        }
        if (is_array($this->student_authoritys)) {
            $this->authoritys = array_merge($this->authoritys, $this->student_authoritys);
        }
        if (is_array($this->teacher_authoritys)) {
            $this->authoritys = array_merge($this->authoritys, $this->teacher_authoritys);
        }
        if (is_array($this->score_authoritys)) {
            $this->authoritys = array_merge($this->authoritys, $this->score_authoritys);
        }
        if (is_array($this->role_authoritys)) {
            $this->authoritys = array_merge($this->authoritys, $this->role_authoritys);
        }
        if (is_array($this->authority_authoritys)) {
            $this->authoritys = array_merge($this->authoritys, $this->authority_authoritys);
        }
        if (is_array($this->other_authoritys)) {
            $this->authoritys = array_merge($this->authoritys, $this->other_authoritys);
        }
        if (is_array($this->system_authoritys)) {
            $this->authoritys = array_merge($this->authoritys, $this->system_authoritys);
        }
        if (is_array($this->myclass_authoritys)) {
            $this->authoritys = array_merge($this->authoritys, $this->myclass_authoritys);
        }
        
        return $this->authoritys;
    }
    
    
}
