<?php

/**
 * This is the model class for table "m_authoritys".
 *
 * The followings are the available columns in table 'm_authoritys':
 * @property string $ID
 * @property string $authority_code
 * @property string $authority_name
 * @property string $category
 * @property integer $level
 * @property string $access_path
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property MRoleAuthoritys[] $mRoleAuthoritys
 */
class MAuthoritys extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_authoritys';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('authority_code, authority_name, create_time', 'required'),
            array('level', 'numerical', 'integerOnly' => true),
            array('authority_code, category, create_user, update_user', 'length', 'max' => 10),
            array('authority_name', 'length', 'max' => 50, 'encoding'=>'UTF-8'),
            array('access_path', 'length', 'max' => 100),

            // safe
            array('ID, authority_code, authority_name, category, level, access_path, create_user, create_time, update_user, update_time', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'mRoleAuthoritys' => array(self::HAS_MANY, 'MRoleAuthoritys', 'authority_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'authority_code' => '权限CODE',
            'authority_name' => '权限名称',
            'category' => '权限分类',
            'level' => '排序用',
            'access_path' => '访问路径',
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
        $criteria->compare('authority_code', $this->authority_code, true);
        $criteria->compare('authority_name', $this->authority_name, true);
        $criteria->compare('category', $this->category, true);
        $criteria->compare('level', $this->level);
        $criteria->compare('access_path', $this->access_path, true);
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
     * @return MAuthoritys the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getAllAuthorityOption($flag = true) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $data = self::model()->findAll('1=1 order by level');
        foreach ($data as $value) {
            $result[$value->ID] = $value->authority_name;
        }

        return $result;
    }

    public function getAuthorityByCategoryOption($category) {

        $result = array();

        $data = self::model()->findAll('category=:category order by level', array(':category' => $category));
        foreach ($data as $value) {
            $result[$value->ID] = $value->authority_name;
        }

        return $result;
    }

}
