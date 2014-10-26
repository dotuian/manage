<?php

/**
 * This is the model class for table "m_subjects".
 *
 * The followings are the available columns in table 'm_subjects':
 * @property string $ID
 * @property string $subject_code
 * @property string $subject_name
 * @property string $subject_short_name
 * @property string $subject_type
 * @property string $status
 * @property string $level
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property MCourses[] $mCourses
 * @property TScores[] $tScores
 * @property TTeacherSubjects[] $tTeacherSubjects
 */
class MSubjects extends CActiveRecord
 {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_subjects';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // 共同
            array('subject_code, subject_name, subject_short_name, subject_type, level, create_time, update_time', 'required'),
            
            //========================================================================
            // 科目代号
            array('subject_code', 'length', 'max' => 10),
            // 科目名称
            array('subject_name', 'length', 'max' => 10, 'encoding' => 'UTF-8'),
            // 科目简称
            array('subject_short_name', 'length', 'max' => 4, 'encoding' => 'UTF-8'),
            // 科目类型(0:普高 1:技能)
            array('subject_type', 'length', 'max' => 1),
            array('subject_type','in','range'=>array('0','1'),'allowEmpty'=>false),
            //========================================================================

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, subject_code, subject_name, subject_short_name, subject_type, status, level, create_user, create_time, update_user, update_time', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'mCourses' => array(self::HAS_MANY, 'MCourses', 'subject_id'),
            'tScores' => array(self::HAS_MANY, 'TScores', 'subject_id'),
            'tTeacherSubjects' => array(self::HAS_MANY, 'TTeacherSubjects', 'subject_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'subject_code' => '科目代号',
            'subject_name' => '科目名称',
            'subject_short_name' => '科目名称(简称)',
            'subject_type' => '科目类型',
            'status' => '状态(1:正常 2:异常)',
            'level' => '显示排序用',
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
        $criteria->compare('subject_code', $this->subject_code, true);
        $criteria->compare('subject_name', $this->subject_name, true);
        $criteria->compare('subject_short_name', $this->subject_short_name, true);
        $criteria->compare('subject_type', $this->subject_type, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('level', $this->level, true);
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
     * @return MSubjects the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 获取所有的课程ID名称对
     * @param type $flag
     * @return type
     */
    public function getAllSubjectsOption($flag) {
        $result = array();
        if ($flag === true) {
            $result[''] = Yii::app()->params['EmptySelectOption'];
        }

        $data = MSubjects::model()->findAll("status='1'");
        foreach ($data as $value) {
            $result[$value->ID] = $value->subject_name;
        }
        return $result;
    }
    
    /**
     * 获取指定的用户，可以查看指定班级的科目信息
     * @param type $user_id
     * @param type $class_id
     */
    public function getSubjectInfoByUserIdAndClassId($user_id, $class_id){
        $subjects = array();
        
        // 班级信息
        $class = TClasses::model()->find('ID=:ID', array(':ID'=>$class_id));
        
        // 用户的角色
        $userRoles = TUserRoles::model()->findAll('user_id=:user_id', array(':user_id'=>$user_id));
        foreach ($userRoles as $userrole) {
            switch ($userrole->role_id) {
                case 0: // 系统管理员
                case 4: // 教务处
                case 5: // 校长
                    // 可以获取这个班级所有的课程
                    $subjects = MSubjects::model()->findAll('ID in (select DISTINCT a.subject_id from m_courses a where class_id=:class_id)', array(':class_id' => $class_id));
                    return $subjects;
                    break;
                case 2: // 教师
                    if($class->teacher_id == $user_id){
                        // 班主任
                        $subjects = MSubjects::model()->findAll('ID in (select DISTINCT a.subject_id from m_courses a where class_id=:class_id)', array(':class_id' => $class_id));
                        return $subjects;
                    } else {
                        
                        $subjects = MSubjects::model()->findAll("ID in (select a.subject_id from m_courses a where a.teacher_id=:teacher_id and a.class_id=:class_id and `status`='1')", 
                                    array(':class_id' => $class_id, ':teacher_id' => $user_id)
                                );
                        
                        // 任课教师
//                        $sql = "select DISTINCT subject_id from m_courses where class_id=:class_id and teacher_id=:teacher_id and `status`='1'";
//                        $connection = Yii::app()->db;
//                        $command = $connection->createCommand($sql);
//                        $command->bindValue(":teacher_id", $user_id);
//                        $command->bindValue(":class_id", $class_id);
//                        $data = $command->queryAll();
//                        $result = array();
//                        foreach ($data as $value) {
//                            $result[] = $value['subject_id'];
//                        }
//
//                        // 任课教师可以获取任课班级的信息
//                        $criteria = new CDbCriteria();
//                        $criteria->addInCondition("ID", $result);
//                        $subject = MSubjects::model()->findAll($criteria);
                    }
                    break;
                case 1: // 学生
                case 3: // 学工科
                    // 没有获取班级信息的权限
                    $subject = array();
                    break;
                default:
                    break;
            }
        }
        
        return $subjects;
    }

    /**
     * 学生成绩查询页面，考试科目用
     * 根据科目名称，获取对应的科目名称的数据集
     * @param type $array
     * @return type
     */
    public function getSubjectsBySubjectName($array) {
        $criteria = new CDbCriteria();
        $criteria->addInCondition('subject_name', $array);
        $criteria->addCondition("status='1'");
        $criteria->order = 'level';
        return MSubjects::model()->findAll($criteria);
    }

}
