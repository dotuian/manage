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
            array('class_name, specialty_name', 'length', 'max' => 20, 'encoding' => 'UTF-8'),
            //========================================================================
            // 班级代号
            array('class_code', 'length', 'max' => 10, 'encoding' => 'UTF-8'),
            // 班级名称
            array('class_name', 'length', 'max' => 20, 'encoding' => 'UTF-8'),
            // 学期(0:整学年 1:上学期 2:下学期)
            array('term_type', 'in', 'range' => array('0', '1', '2'), 'allowEmpty' => false),
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
            'entry_year' => '年度',
            'term_type' => '学期', // 学期(0:整学年 1:上学期 2:下学期)
            'class_type' => '班级类型', // 班级类型(0:普通高中 1:技能专业)
            'specialty_name' => '专业名称',
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
    public function getStopClassesOption($flag = true) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $data = self::model()->findAll("status='2' order by create_time desc, grade asc, class_code asc");
        foreach ($data as $value) {
            $result[$value->ID] = $value->getClassDisplayName(true, true);
        }

        return $result;
    }
    
    /**
     * 获取所有使用中班级信息
     * @param type $flag
     * @return type
     */
    public function getAllUsingClassOption($flag = true) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $data = self::model()->findAll("status='1'");
        foreach ($data as $value) {
            $result[$value->ID] = $value->getClassDisplayName();
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

        //$data = self::model()->findAll("status='1'");
        $data = self::model()->findAll();
        foreach ($data as $value) {
            $result[$value->ID] = $value->getClassDisplayName();
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
            $result[$value->ID] = $value->getClassDisplayName();
        }
        
        return $result;
    }
    
    /**
     * 根据用户的角色，来获取具有访问权限的班级信息
     */
    public function getClassInfoByUserRole($user_id) {
        $user = TUsers::model()->find("ID=:ID and status='1'", array(':ID'=> $user_id));
        
        $classes = array();
        
        // 校长
        // 教务处
        if($user->isJiaoWuChu() || $user->isHeaderTeacher()) {
            // 可以获取所有班级的信息
            $classes = TClasses::model()->findAll("status='1'");
        }
        
        // 普通教师(班主任或者任课教师)
        elseif($user->isTeacher() && ($user->isBanZhuRen() || $user->isRenKeJiaoShi()) ) {
            // 班主任和任课教师的班级ID
            $sql = "select a.ID as class_id from t_classes a where a.teacher_id=:teacher_id and a.`status`='1' UNION select DISTINCT b.class_id from m_courses b where b.teacher_id=:teacher_id and b.`status`='1'";
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
            $criteria->addCondition(" status='1' ");
            $criteria->addInCondition("ID", $result);
            $classes = TClasses::model()->findAll($criteria);
        }
        
        // 学工科
        // 学生
        elseif($user->isXueGongKe() || $user->isStudent()) {
            $classes = array();
        }
        
        return $classes;
    }
    
    public function getClassDisplayName($show_class_code = true, $show_entry_year = false){
        $term_name = '';
        switch ($this->term_type) {
            case '0':
                $term_name = '整学年';
                break;
            case '1':
                $term_name = '上学期';
                break;
            case '2':
                $term_name = '下学期';
                break;
            default:
                break;
        }
        
        $str = '';
        if($show_entry_year){
            $str .= "【{$this->entry_year}】";
        }
        
        if($show_class_code) {
            $str .= "【{$this->class_code}】";
        }
        
        $str .= "{$this->class_name}({$term_name})";
        
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
     * 获取所有使用中的班级的CODE
     * 学生信息批量导入用
     */
    public function getAllClassCode() {
        $code = array();
        $classes = TClasses::model()->findAll("status='1'");
        foreach ($classes as $class) {
            $code[] = $class->class_code;
        }
        return $code;
    }
    /**
     * 获取所有使用中的班级的CODE
     * 学生信息批量导入用
     */
    public function getAllStopClassCode() {
        $code = array();
        $classes = TClasses::model()->findAll("status='2'");
        foreach ($classes as $class) {
            $code[] = $class->class_code;
        }
        return $code;
    }

    /**
     * 获取该班级所有学生
     */
    public function getClassAllStudents() {
        $sql = "select a.* , c.ID from m_subjects a ";
        $sql .= "inner join m_courses b on b.subject_id=a.ID and b.`status`='1' ";
        $sql .= "inner join t_classes c on c.ID=b.class_id ";
        $sql .= "where c.ID=:class_id ";
        
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
    
    /**
     * 获取班级学期类型的表示名
     * @param type $value
     * @return string
     */
    public function getTermTypeName($value=null) {
        if(is_null($value)){
            $value = $this->term_type;
        }
        
        $result = null;
        switch ($value) {
            case '0':
                $result = '整学年';
                break;
            case '1':
                $result = '上学期';
                break;
            case '2':
                $result = '下学期';
                break;
            default:
                break;
        }
        return $result;
    }
    
    /**
     * 获取班级类型的表示名
     * @param type $value
     * @return string
     */
    public function getClassTypeName($value=null) {
        if(is_null($value)){
            $value = $this->class_type;
        }

        $result = null;
        switch ($value) {
            case '0':
                $result = '普通高中(综合)';
                break;
            case '1':
                $result = '普通高中(文科)';
                break;
            case '2':
                $result = '普通高中(理科)';
                break;
            case '3':
                $result = '技能专业';
                break;
            default:
                break;
        }
        return $result;
    }
    
    /**
     * 获取班级状态的表示名
     * @param type $value
     * @return string
     */
    public function getClassStatusName($value=null) {
        if(is_null($value)){
            $value = $this->status;
        }

        $result = null;
        switch ($value) {
            case '1':
                $result = '正常';
                break;
            case '2':
                $result = '暂停';
                break;
            default:
                break;
        }
        return $result;
    }
    
    public function getEntryYearOption($flag=true) {
        $result = array();
        if ($flag === true) {
            $result[''] = Yii::app()->params['EmptySelectOption'];
        }

        $sql = "select DISTINCT entry_year from t_classes order by entry_year desc ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->query();

        foreach ($data as $value) {
            $result[$value['entry_year']] = $value['entry_year'] . '年度';
        }
        
        return $result;
    }
    
    public function getClassEntryYearOption($range = 1, $flag = true) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $year = date('Y');

        for ($i = $year - $range; $i <= $year ; $i++) {
            $result[$i] = $i;
        }
        return $result;
    }
    
    
    public function getGradeOption($flag){
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $result['1'] = '一年级';
        $result['2'] = '二年级';
        $result['3'] = '三年级';

        return $result;
    }
    
    
    public function getTermTypeOption($flag) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $result['0'] = '整学年';
        $result['1'] = '上学期';
        $result['2'] = '下学期';

        return $result;
    }
    
    public function getClassStatusOption($flag) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $result['1'] = '正常';
        $result['2'] = '暂停';

        return $result;
    }
    
    public function getClassStatusDisplayName($class_status){
        $status_name = '';
        switch ($class_status) {
            case '1':
                $term_name = '正常';
                break;
            case '2':
                $term_name = '暂停';
                break;
            default:
                break;
        }
        return $status_name;
    }
    

    public static function getClassTypeOption($flag) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $result['0'] = '普通高中(综合)';
        $result['1'] = '普通高中(文科)';
        $result['2'] = '普通高中(理科)';
        $result['3'] = '技能专业';
        
        return $result;
    }

    public function getClassTypeDisplayName($class_type) {
        $class_name = '';
        switch ($class_type) {
            case '0':
                $class_name = '普通高中(综合)';
                break;
            case '1':
                $class_name = '普通高中(文科)';
                break;
            case '2':
                $class_name = '普通高中(理科)';
                break;
            case '3':
                $class_name = '技能专业';
                break;
            default:
                break;
        }
        return $class_name;
    }
    
    public function getTermTypeDisplayName($term_type) {
        $term_name = '';
        switch ($term_type) {
            case '0':
                $term_name = '整学年';
                break;
            case '1':
                $term_name = '上学期';
                break;
            case '2':
                $term_name = '下学期';
                break;
            default:
                break;
        }
        return $term_name;
    }
    
    public function getEntryYearDisplayName($entry_year) {
        $str = '';
        switch ($entry_year) {
            case '1':
                $str = '一年级';
                break;
            case '2':
                $str = '二年级';
                break;
            case '3':
                $str = '三年级';
                break;
            default:
                break;
        }
        return $str;
    }
    
    /**
     * 指定的教师是否为当班的班主任
     * @param type $class_id
     * @param type $teacher_id
     * @return type
     */
    public function isClassTeacher($class_id, $teacher_id) {
        return TClasses::model()->exists("ID=:ID and teacher_id=:teacher_id", array(':ID' => $class_id, ':teacher_id' => $teacher_id));
    }
    
}

