<?php

/**
 * This is the model class for table "t_classes".
 *
 * The followings are the available columns in table 't_classes':
 * @property string $ID
 * @property string $class_code
 * @property string $class_name
 * @property integer $grade
 * @property integer $entry_year
 * @property string $term_type
 * @property string $class_type
 * @property string $specialty_name
 * @property string $status
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
 * @property TStudentClasses[] $tStudentClasses
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
            // 共同
            array('class_code, class_name, class_type, entry_year, teacher_id, grade', 'required'),
            array('entry_year', 'numerical', 'integerOnly' => true),
            array('class_name, specialty_name, term_type', 'length', 'max' => 20, 'encoding' => 'UTF-8'),
            //========================================================================
            // 班级代号
            array('class_code', 'length', 'max' => 10, 'encoding' => 'UTF-8'),
            // 班级名称
            array('class_name', 'length', 'max' => 20, 'encoding' => 'UTF-8'),
            // 班级性质
            array('class_type', 'in', 'range' => array('0', '1'), 'allowEmpty' => false),
            // 专业名称
            array('class_code', 'length', 'max' => 20, 'encoding' => 'UTF-8'),
            // 年级
            array('grade', 'length', 'max' => 1),
            // 入学年份
            array('entry_year', 'length', 'max' => 4),
            // 班主任
            array('teacher_id', 'length', 'max' => 10),
            //========================================================================
            array('ID, class_code, class_name, class_type, grade, specialty_name, status, entry_year, term_type, teacher_id, create_user, create_time, update_user, update_time', 'safe'),
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
            'grade' => '年级',
            'entry_year' => '入学年份',
            'term_type' => '学期',
            'class_type' => '班级类型',
            'specialty_name' => '专业名称', // 班级类型(0:普通高中 1:技能专业)
            'status' => '状态', // (1:在校 2:毕业)
            'teacher_id' => '班主任',
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
        $criteria->compare('class_code', $this->class_code, true);
        $criteria->compare('class_name', $this->class_name, true);
        $criteria->compare('grade', $this->grade);
        $criteria->compare('entry_year', $this->entry_year);
        $criteria->compare('term_type', $this->term_type, true);
        $criteria->compare('class_type', $this->class_type, true);
        $criteria->compare('specialty_name', $this->specialty_name, true);
        $criteria->compare('status', $this->status, true);
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
     * 获取所有已经暂停班级信息
     * @param type $flag
     * @return type
     */
    public function getAllStopClassOption($flag = true) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $data = self::model()->findAll("status='2' order by create_time desc, grade asc, class_code asc");
        foreach ($data as $value) {
            $term_name = $value->term_type == '1' ? '上学期' : '下学期';
            $result[$value->ID] = "{$value->entry_year} | {$value->class_code} | {$value->class_name} | {$term_name}";
        }

        return $result;
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
            $term_name = $value->term_type == '1' ? '上学期' : '下学期';
            $result[$value->ID] = "{$value->class_code} | {$value->class_name} | {$term_name}";
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
            $result[$value->ID] = $value->class_code . ' | ' . $value->class_name;
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
                    $sql = "select a.ID as class_id from t_classes a where a.teacher_id=:teacher_id a.`status`='1' UNION select DISTINCT b.class_id from m_courses b where b.teacher_id=:teacher_id and b.`status`='1'";
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
    
    public function getClassDisplayName(){
        $str = $this->class_code;
        $str .= ' | ';
        $str .= $this->class_name;
        $str .= ' | ';
        if($this->term_type == 1){
            $str .= '上学期';
        } else {
            $str .= '下学期';
        }
        
        return $str;
    }
    
    /**
     * 获取该班级所修的所有科目信息
     */
    public function getClassAllSubjects() {
        $sql = "select c.* from ";
        $sql .= " t_classes a ";
        $sql .= " inner join m_courses b on a.ID=b.class_id and b.`status`='1' ";
        $sql .= " inner join m_subjects c on c.ID=b.subject_id and c.`status`='1' ";
        $sql .= "where a.ID=:class_id";

        $param = array(':class_id' => $this->ID);
        return MSubjects::model()->findAllBySql($sql, $param);
    }
    
    /**
     * 获取该班级所有学生
     */
    public function getClassAllStudents() {
        $sql = "select a.*, b.student_number from ";
        $sql .= "t_students a ";
        $sql .= "inner join t_student_classes b on a.ID=b.student_id ";
        $sql .= "inner join t_classes c on c.ID= b.class_id ";
        $sql .= "where ";
        $sql .= "a.`status`='1' and c.ID=:class_id";
        
        return TStudents::model()->findAllBySql($sql, array(':class_id' => $this->ID));
    }
    
    /**
     * 获取该班级所有学生为了登录学生成绩
     */
    public function getClassAllStudentsForInsertScore() {
        $sql = "select a.*, b.student_number from ";
        $sql .= "t_students a ";
        $sql .= "inner join t_student_classes b on a.ID=b.student_id ";
        $sql .= "inner join t_classes c on c.ID= b.class_id ";
        $sql .= "where ";
        $sql .= "a.`status`='1' and b.`status`='1' and c.ID=:class_id";
        
        return TStudents::model()->findAllBySql($sql, array(':class_id' => $this->ID));
    }
    
}















