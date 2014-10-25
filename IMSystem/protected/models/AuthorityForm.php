<?php

class AuthorityForm extends CFormModel
{

    public $ID;
    public $authority_code;
    public $authority_name;
    public $category;
    public $access_path;
    public $level;

    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('authority_name, category, access_path', 'required'),
			array('level', 'numerical', 'integerOnly'=>true),
			array('authority_code, category', 'length', 'max'=>10),
			array('authority_name', 'length', 'max'=>50, 'encoding'=>'UTF-8'),
			array('access_path', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, authority_code, authority_name, category, level, access_path', 'safe'),
		);
	}

    public function afterValidate() {
        parent::afterValidate();
        // 角色添加
        if ($this->scenario === 'create') {
            if (MAuthoritys::model()->exists("authority_name=:authority_name", array(':authority_name' => $this->authority_name))) {
                $this->addError('authority_name', '权限名称已经存在，请重新指定！');
            }
        }
        
        // 角色变更
        if ($this->scenario === 'update') {
            if (MAuthoritys::model()->exists("authority_name=:authority_name and ID<>:ID", array(':authority_name' => $this->authority_name, ':ID'=>$this->ID))) {
                $this->addError('authority_name', '权限名称已经存在，请重新指定！');
            }
        }
    }
    
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'authority_code' => '权限CODE',
			'authority_name' => '权限名称',
			'category' => '权限分类',
			'level' => '排序用',
			'access_path' => '访问路径',
		);
	}

    
    public static function getCategoryOption($flag){
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }
        
        $result['TEACHER'] = '教师管理';
        $result['STUDENT'] = '学生管理';
        $result['SCORE'] = '成绩管理';
        $result['COURSE'] = '课程管理';
        $result['SUBJECT'] = '科目管理';
        $result['CLASS'] = '班级管理';
        $result['ROLE'] = '角色管理';
        $result['AUTHORITY'] = '权限管理';
        $result['OTHER'] = '其他选项';

        return $result;
    }
    
    
    public function autoAuthorityCode(){
        $count = MAuthoritys::model()->count('category=:category', array(':category' => $this->category));
        return substr($this->category, 0, 3) . str_pad($count + 1, 3, '0', STR_PAD_LEFT);   
    }
    
}
