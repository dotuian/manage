<?php

/**
 * This is the model class for table "m_role_authoritys".
 *
 * The followings are the available columns in table 'm_role_authoritys':
 * @property string $ID
 * @property string $role_id
 * @property string $authority_id
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property MAuthoritys $authority
 * @property MRoles $role
 */
class MRoleAuthoritys extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_role_authoritys';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('role_id, authority_id, create_time, update_time', 'required'),
            array('role_id, authority_id, create_user, update_user', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, role_id, authority_id, create_user, create_time, update_user, update_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'authority' => array(self::BELONGS_TO, 'MAuthoritys', 'authority_id'),
            'role' => array(self::BELONGS_TO, 'MRoles', 'role_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'role_id' => '角色ID',
            'authority_id' => '权限ID',
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
        $criteria->compare('role_id', $this->role_id, true);
        $criteria->compare('authority_id', $this->authority_id, true);
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
     * @return MRoleAuthoritys the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
