<?php

/**
 * This is the model class for table "t_users".
 *
 * The followings are the available columns in table 't_users':
 * @property string $ID
 * @property string $username
 * @property string $password
 * @property string $status
 * @property string $last_login_time
 * @property string $last_password_time
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property TStudents $tStudents
 * @property TTeachers $tTeachers
 * @property TUserRoles[] $tUserRoles
 */
class TUsers extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 't_users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, create_time', 'required'),
            array('username, password', 'length', 'max' => 20),
            array('status', 'length', 'max' => 1),
            array('create_user, update_user', 'length', 'max' => 10),
            array('last_login_time, last_password_time, update_time', 'safe'),
            
            // safe
            array('ID, username, password, status, last_login_time, last_password_time, create_user, create_time, update_user, update_time', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tStudents' => array(self::HAS_ONE, 'TStudents', 'ID'),
            'tTeachers' => array(self::HAS_ONE, 'TTeachers', 'ID'),
            'tUserRoles' => array(self::HAS_MANY, 'TUserRoles', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'status' => '状态', // (1:正常 2:异常)
            'last_login_time' => '上次登录时间',
			'last_password_time' => '上次密码修改时间',
            'create_user' => '创建用户',
            'create_time' => '创建时间',
            'update_user' => '更新用户',
            'update_time' => '更新时间',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('last_password_time',$this->last_password_time,true);
        $criteria->compare('create_user', $this->create_user, true);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_user', $this->update_user, true);
        $criteria->compare('update_time', $this->update_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TUsers the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getAllUserAuthorityCategory(){
        $result = array();
        // 
        $sql = "select DISTINCT d.category from t_user_roles a, m_roles b, m_role_authoritys c, m_authoritys d where a.role_id=b.ID and b.ID=c.role_id and c.authority_id=d.ID and a.user_id=:user_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindValue(":user_id", $this->ID);
        $data = $command->query();

        foreach ($data as $value) {
            $result[] = $value['category'];
        }
        
        return $result;
    }
    
    
    /**
     * 获取用户的所有权限
     */
    public function getAllUserAuthoritys() {
        
        $result = array();
        // 
        $sql = "select d.ID, d.access_path from t_user_roles a, m_roles b, m_role_authoritys c, m_authoritys d where a.role_id=b.ID and b.ID=c.role_id and c.authority_id=d.ID and a.user_id=:user_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindValue(":user_id", $this->ID);
        $data = $command->query();

        foreach ($data as $value) {
            $result[$value['ID']] = $value['access_path'];
        }
        
        return $result;
    }
    
    
    public function getUserRoleIds(){
        $result = array();
        
        foreach ($this->tUserRoles as $userRole) {
            $result[] = $userRole->role_id;
        }
        
        return $result;
    }
    
    /**
     * 批量导入学生信息
     * @param type $data 学生信息
     * @param TStudentClasses $new_class 要导入的班级信息
     * @return $data
     */
    public function importStudent($data, $new_class) {
        $result = false;
        
        // 导入学生的信息的班级信息
        $data['new_class_id'] = $new_class->ID;
        $data['new_class_code'] = $new_class->class_code;
        $data['new_class_name'] = $new_class->class_name;
                
        
        // 旧班级为空，表示是新生，直接登录系统
        if(empty($data['old_class_code'])) {
            // 用户登录密码信息
            $data['password'] = substr($data['id_card_no'], 6, 8); // 身份证信息中的出生年月日
            if (strlen($data['password']) !== 8) {
                $data['password'] = '88888888';
            }

            // 用户表
            $user = new TUsers();
            $user->username = $data['code']; // 
            $user->password = $data['password'];  // 生日做密码
            $user->status = '1';
            $user->last_login_time = null;
            $user->last_password_time = null;
            $user->create_user = Yii::app()->user->getState('ID');
            $user->create_time = new CDbExpression('NOW()');

            if ($user->save()) {
                // 学生表
                $student = new TStudents();
                $student->ID = $user->ID;   // 关联ID
                
                //$student->province_code    = $data['student_number']; // 省内编号
                $student->name          = $data['name'];
                $student->status        = '1';
                $student->id_card_no    = $data['id_card_no'];
                //$student->birthday    = $data['code'];
                $student->payment1      = isset($data['payment1']) ? $data['payment1'] : null;
                $student->payment2      = isset($data['payment2']) ? $data['payment2'] : null;
                $student->payment3      = isset($data['payment3']) ? $data['payment3'] : null;
                $student->payment4      = isset($data['payment4']) ? $data['payment4'] : null;
                $student->payment5      = isset($data['payment5']) ? $data['payment5'] : null;
                $student->payment6      = isset($data['payment6']) ? $data['payment6'] : null;
                $student->bonus_penalty = isset($data['bonus_penalty']) ? $data['bonus_penalty'] : null ; // 奖惩情况
                $student->address       = isset($data['address']) ? $data['address'] : null;
                $student->parents_tel   = isset($data['parents_tel']) ? $data['parents_tel'] : null;
                $student->parents_qq    = isset($data['parents_qq']) ? $data['parents_qq'] : null;
                $student->school_of_graduation = isset($data['school_of_graduation']) ? $data['school_of_graduation'] : null;
                $student->senior_score  = isset($data['senior_score']) ? $data['senior_score'] : null;
                $student->school_year   = isset($data['school_year']) ? $data['school_year'] : null;
                $student->college_score = isset($data['college_score']) ? $data['college_score'] : null;
                $student->university    = isset($data['university']) ? $data['university'] : null;
                $student->comment       = isset($data['comment']) ? $data['comment'] : null;
                
                $student->create_user   = Yii::app()->user->getState('ID');
                $student->create_time   = new CDbExpression('NOW()');
                if($student->save(false)) {
                    // 用户角色表
                    $userRole = new TUserRoles();
                    $userRole->role_id = '1'; // 学生角色
                    $userRole->user_id = $user->ID;
                    $userRole->create_user = Yii::app()->user->getState('ID');
                    $userRole->create_time = new CDbExpression('NOW()');

                    // 用户班级表
                    $class = new TStudentClasses();
                    $class->student_number = $data['student_number'];
                    $class->student_id = $student->ID;
                    $class->class_id = $new_class->ID;
                    $class->status = '1';
                    $class->create_user = Yii::app()->user->getState('ID');
                    $class->create_time = new CDbExpression('NOW()');

                    if ($userRole->save(false) && $class->save(false)) {
                        $result = true;
                    }
                }
            }
        }
        
        // 旧班级信息不为空的情况下，表明是老生，更新系统中的信息
        if(!empty($data['old_class_code'])){
            // 根据旧班级信息和姓名，查询学生信息
            $sql = " select a.* from t_students a ";
            $sql .= " inner join t_student_classes b on a.ID=b.student_id and b.`status`='1'  ";
            $sql .= " inner join t_classes c on b.class_id=c.ID  "; 
            $sql .= "where c.class_code=:class_code and a.name=:name and a.b.`status`='1' ";
            
            $student = TStudents::model()->findBySql($sql, array(':name' => $data['name'], ':class_code' => $data['old_class_code']));
            // 不存在的情况
            if (!is_null($student)) {
                // 存在的情况下，只需要更新学生表数据
                //$student->province_code    = $data['student_number']; // 省内编号
                $student->status  = '1';
                $student->id_card_no = $data['id_card_no'];
                $student->payment1 = $data['payment1'];
                $student->payment2 = $data['payment2'];
                $student->payment3 = $data['payment3'];
                $student->payment4 = $data['payment4'];
                $student->payment5 = $data['payment5'];
                $student->payment6 = $data['payment6'];
                $student->bonus_penalty = $data['bonus_penalty'];; // 奖惩情况
                $student->address       = $data['address'];
                $student->parents_tel   = $data['parents_tel'];
                $student->parents_qq    = $data['parents_qq'];
                $student->school_of_graduation = $data['school_of_graduation'];
                $student->senior_score  = $data['senior_score'];
                $student->school_year   = $data['school_year'];
                $student->college_score = $data['college_score'];
                $student->university    = $data['university'];
                $student->comment       = $data['comment'];
                
                $student->update_user = Yii::app()->user->getState('ID');
                $student->update_time = new CDbExpression('NOW()');
                
                // 班级信息更新
                $sql = "select a.* from t_student_classes a ";
                $sql = "inner join t_classes b on a.class_id=b.ID ";
                $sql = "where a.`status`='1' and a.student_id=:student_id and b.class_code=:old_class_code ";
                
                // 旧班级信息的更新
                $old_class = TStudentClasses::model()->findBySql($sql, array(':student_id' => $student->ID, ':old_class_code' => $data['old_class_code']));
                if (!is_null($old_class)) {
                    $old_class->status = '0';
                    $old_class->update_user = Yii::app()->user->getState('ID');
                    $old_class->update_time = new CDbExpression('NOW()');
                    $old_class->save(false);
                }

                // 新的班级信息的添加
                $new_class = new TStudentClasses();
                $new_class->student_number = $data['student_number'];
                $new_class->student_id = $student->ID;
                $new_class->class_id = $new_class->ID;
                $new_class->status = '1';
                $new_class->create_user = Yii::app()->user->getState('ID');
                $new_class->create_time = new CDbExpression('NOW()');

                if ($student->save(false) && $new_class->save(false)) {
                    $result = true;
                }
            }
        }
        
        return $result;
    }


}
