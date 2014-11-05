<?php

/**
 * This is the model class for table "m_courses".
 *
 * The followings are the available columns in table 'm_courses':
 * @property string $ID
 * @property string $subject_id
 * @property string $teacher_id
 * @property string $class_id
 * @property string $status
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property MSubjects $subject
 * @property TClasses $class
 * @property TTeachers $teacher
 */
class MCourses extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_courses';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('subject_id, teacher_id, class_id, create_time', 'required'),
            array('subject_id, teacher_id, class_id, create_user, update_user', 'length', 'max' => 10),
            array('status', 'length', 'max' => 1),

            // safe
            array('ID, subject_id, teacher_id, class_id, status, create_user, create_time, update_user, update_time', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'subject' => array(self::BELONGS_TO, 'MSubjects', 'subject_id'),
            'class' => array(self::BELONGS_TO, 'TClasses', 'class_id'),
            'teacher' => array(self::BELONGS_TO, 'TTeachers', 'teacher_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'subject_id' => '科目名称',
            'teacher_id' => '任课教师',
            'class_id' => '上课班级',
            'status' => '状态(1:正常 2:异常)',
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
        $criteria->compare('subject_id', $this->subject_id, true);
        $criteria->compare('teacher_id', $this->teacher_id, true);
        $criteria->compare('class_id', $this->class_id, true);
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
     * @return MCourses the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    
    public function getCoursesByClassId($class_id) {
        $subject = MSubjects::model()->findAll("ID in (select a.subject_id from m_courses a where a.class_id=:class_id and a.`status`='1')", array(':class_id' => $class_id));
        return $subject;
    }
}
