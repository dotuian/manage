<?php

/**
 * This is the model class for table "t_users".
 *
 * The followings are the available columns in table 't_users':
 * @property string $ID
 * @property string $username
 * @property string $password
 * @property string $status
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
            array('username, password, create_time, update_time', 'required'),
            array('username, password', 'length', 'max' => 20),
            array('status', 'length', 'max' => 1),
            array('create_user, update_user', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, username, password, status, create_user, create_time, update_user, update_time', 'safe', 'on' => 'search'),
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
            'status' => '状态(1:正常 2:异常)',
            'create_user' => 'Create User',
            'create_time' => 'Create Time',
            'update_user' => 'Update User',
            'update_time' => 'Update Time',
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
    
    
    public function importStudent($value) {
        $result = false;

        $login_id = Yii::app()->user->getState('ID');
        $code = trim($value['A']);
        $student = TStudents::model()->find('code=:code', array(':code' => $code));
        // 不存在的情况
        if (is_null($student)) {
            // 用户表
            $user = new TUsers();
            $user->username = $code;
            $user->password = "";
            $user->status = '1';
            $user->create_user = $login_id;
            $user->create_time = new CDbExpression('NOW()');
            $user->update_user = $login_id;
            $user->update_time = new CDbExpression('NOW()');
            if ($user->save()) {
                // 学生表
                $student = new TStudents();
                $student->code = trim($value['A']);
                $student->name = trim($value['B']);
                $student->status = '1';
                $student->id_card_no = trim($value['C']);
                $student->birthday = trim($value['B']);
                $student->class_id = trim($value['B']);
                $student->old_class_id = trim($value['B']);
                $student->payment1 = trim($value['B']);
                $student->payment2 = trim($value['B']);
                $student->payment3 = trim($value['B']);
                $student->payment4 = trim($value['B']);
                $student->payment5 = trim($value['B']);
                $student->payment6 = trim($value['B']);
                $student->bonus_penalty = trim($value['B']); // 奖惩情况
                $student->address = trim($value['B']);
                $student->parents_tel = trim($value['B']);
                $student->parents_qq = trim($value['B']);
                $student->school_of_graduation = trim($value['B']);
                $student->senior_score = trim($value['B']);
                $student->school_year = trim($value['B']);
                $student->college_score = trim($value['B']);
                $student->university = trim($value['B']);
                $student->comment = trim($value['B']);

                $student->create_user = Yii::app()->user->getState('ID');
                $student->create_time = new CDbExpression('NOW()');
                $student->update_user = Yii::app()->user->getState('ID');
                $student->update_time = new CDbExpression('NOW()');

                // 用户角色表
                $userRole = new TUserRoles();
                $userRole->role_id = '1';
                $userRole->user_id = $user->ID;
                $userRole->create_user = $login_id;
                $userRole->create_time = new CDbExpression('NOW()');
                $userRole->update_user = $login_id;
                $userRole->update_time = new CDbExpression('NOW()');

                if ($student->save(false) && $userRole->save(false)) {
                    $result = true;
                }
            }
        } else {
            // 存在的情况下，只需要更新学生表数据
            $student->name = trim($value['B']);
            $student->id_card_no = trim($value['C']);
            $student->birthday = trim($value['B']);
            $student->class_id = trim($value['B']);
            $student->old_class_id = trim($value['B']);
            $student->payment1 = trim($value['B']);
            $student->payment2 = trim($value['B']);
            $student->payment3 = trim($value['B']);
            $student->payment4 = trim($value['B']);
            $student->payment5 = trim($value['B']);
            $student->payment6 = trim($value['B']);
            $student->bonus_penalty = trim($value['B']); // 奖惩情况
            $student->address = trim($value['B']);
            $student->parents_tel = trim($value['B']);
            $student->parents_qq = trim($value['B']);
            $student->school_of_graduation = trim($value['B']);
            $student->senior_score = trim($value['B']);
            $student->school_year = trim($value['B']);
            $student->college_score = trim($value['B']);
            $student->university = trim($value['B']);
            $student->comment = trim($value['B']);

            $student->update_user = Yii::app()->user->getState('ID');
            $student->update_time = new CDbExpression('NOW()');

            if ($student->save(false)) {
                $result = true;
            }
        }

        return $result;
    }

}
