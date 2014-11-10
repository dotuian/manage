<?php

/**
 * This is the model class for table "m_roles".
 *
 * The followings are the available columns in table 'm_roles':
 * @property string $ID
 * @property string $role_name
 * @property string $status
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property MRoleAuthoritys[] $mRoleAuthoritys
 * @property TUserRoles[] $tUserRoles
 */
class MRoles extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_roles';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('role_name, create_time', 'required'),
            array('role_name', 'length', 'max' => 50, 'encoding'=>'UTF-8'),

            array('create_user, update_user', 'length', 'max' => 10),

            // safe
            array('ID, role_name, status, create_user, create_time, update_user, update_time', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'mRoleAuthoritys' => array(self::HAS_MANY, 'MRoleAuthoritys', 'role_id'),
            'tUserRoles' => array(self::HAS_MANY, 'TUserRoles', 'role_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'role_name' => '角色名',
            'status' => '状态', // (1:正常 2：删除)
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
        $criteria->compare('role_name', $this->role_name, true);
		$criteria->compare('status',$this->status,true);
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
     * @return MRoles the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getRoleAuthorityByCategory($category) {
        $result = array();

        // 
        $sql = "select a.ID, a.authority_name from m_authoritys a , m_role_authoritys b where a.category=:category and a.ID=b.authority_id and role_id=:role_id order by a.ID";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindValue(":role_id", $this->ID);
        $command->bindValue(":category", $category);
        $data = $command->query();

        foreach ($data as $value) {
            $result[$value['ID']] = $value['authority_name'];
        }
        
        return $result;
        
    }
    
    public function getAllRolesOption($flag = true) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }
        
        $data = self::model()->findAll("status='1' order by create_time");
        foreach ($data as $value) {
            $result[$value->ID] = $value->role_name;
        }
        
        return $result;
    }
    
}
