<?php

/**
 * This is the model class for table "t_classes".
 *
 * The followings are the available columns in table 't_classes':
 * @property string $ID
 * @property string $class_code
 * @property string $class_name
 * @property string $class_type
 * @property string $specialty_name
 * @property string $status
 * @property integer $term_year
 * @property string $teacher_id
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property MCourses[] $mCourses
 * @property TTeachers $teacher
 * @property TScores[] $tScores
 * @property TStudents[] $tStudents
 * @property TStudents[] $tStudents1
 */
class TClasses extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 't_classes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('class_code, create_time, update_time', 'required'),
            array('term_year', 'numerical', 'integerOnly' => true),
            array('class_code', 'length', 'max' => 20),
            array('class_name, specialty_name', 'length', 'max' => 50, 'encoding'=>'UTF-8'),
            array('class_type, status', 'length', 'max' => 1),

            array('status', 'in', 'range'=>array('1','2'),'allowEmpty'=>false),

            array('teacher_id, create_user, update_user', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, class_code, class_name, class_type, specialty_name, status, term_year, teacher_id, create_user, create_time, update_user, update_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'mCourses' => array(self::HAS_MANY, 'MCourses', 'class_id'),
            'teacher' => array(self::BELONGS_TO, 'TTeachers', 'teacher_id'),
            'tScores' => array(self::HAS_MANY, 'TScores', 'class_id'),
            'tStudents' => array(self::HAS_MANY, 'TStudents', 'class_id'),
            'tStudents1' => array(self::HAS_MANY, 'TStudents', 'old_class_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'class_code' => '班级代号',
            'class_name' => '班级名称',
            'class_type' => '班级类型',
            'specialty_name' => '专业名称', // 班级类型(0:普通高中 1:技能专业)
            'status' => '状态', // (1:在校 2:毕业)
            'term_year' => '届',
            'teacher_id' => '班主任',
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
        $criteria->compare('class_code', $this->class_code, true);
        $criteria->compare('class_name', $this->class_name, true);
        $criteria->compare('class_type', $this->class_type, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('term_year', $this->term_year);
        $criteria->compare('teacher_id', $this->teacher_id, true);
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
     * @return TClasses the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 获取所有班级信息
     * @param type $flag
     * @return type
     */
    public function getAllClassOption($flag = true) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $data = self::model()->findAll("status='1'");
        foreach ($data as $value) {
            $result[$value->ID] = $value->class_name;
        }

        return $result;
    }
    
    /**
     * 班主任或者任课教师所能查看的班级
     * @param type $user_id
     * @param type $flag
     * @return string
     */
    public function getClassOptionByUserRole($user_id, $flag = true) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }
        
        $data = $this->getClassInfoByUserRole($user_id);

        foreach ($data as $value) {
            $result[$value->ID] = $value->class_code . '| ' . $value->class_name;
        }
        
        return $result;
    }
    
    /**
     * 根据用户的角色，来获取具有访问权限的班级信息
     */
    public function getClassInfoByUserRole($user_id) {
        $classes = array();
        
        $userRoles = TUserRoles::model()->findAll('user_id=:user_id', array(':user_id'=>$user_id));
        foreach ($userRoles as $userrole) {
            switch ($userrole->role_id) {
                case 6: // 系统管理员
                case 4: // 教务处
                case 5: // 校长
                    // 可以获取所有班级的信息
                    $classes = TClasses::model()->findAll();
                    return $classes;
                    break;
                case 2: // 教师
                    // 班主任和任课教师的班级ID
                    $sql = "select a.ID as class_id from t_classes a where a.teacher_id=:teacher_id UNION select DISTINCT b.class_id from m_courses b where b.teacher_id=:teacher_id and b.`status`='1'";
                    $connection = Yii::app()->db;
                    $command = $connection->createCommand($sql);
                    $command->bindValue(":teacher_id", $user_id);
                    $data = $command->queryAll();
                    
                    $result = array();
                    foreach ($data as $value) {
                        $result[] = $value['class_id'];
                    }

                    // 任课教师可以获取任课班级的信息
                    $criteria = new CDbCriteria();
                    $criteria->addInCondition("ID", $result);
                    $classes = TClasses::model()->findAll($criteria);

                    break;
                case 1: // 学生
                case 3: // 学工科
                    // 没有获取班级信息的权限
                    $classes = array();
                    break;
                default:
                    break;
            }
        }
        
        return $classes;
    }

}

