<?php

/**
 * This is the model class for table "m_exams".
 *
 * The followings are the available columns in table 'm_exams':
 * @property string $ID
 * @property string $exam_code
 * @property string $exam_name
 * @property string $status
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property TScores[] $tScores
 */
class MExams extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'm_exams';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('exam_code, exam_name, create_time', 'required'),
            array('exam_code', 'length', 'max' => 20),
            array('exam_name', 'length', 'max' => 50, 'encoding'=>'UTF-8'),
            array('status', 'length', 'max' => 1),
            array('create_user, update_user', 'length', 'max' => 10),
            
            // safe
            array('ID, exam_code, exam_name, status, create_user, create_time, update_user, update_time', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tScores' => array(self::HAS_MANY, 'TScores', 'exam_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'exam_code' => '考试CODE',
            'exam_name' => '考试名称',
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
        $criteria->compare('exam_code', $this->exam_code, true);
        $criteria->compare('exam_name', $this->exam_name, true);
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
     * @return MExams the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    /**
     * 获取学生所有参加过的考试
     */
    public function getStudentExamsOption($student_id, $flag = true){
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $data = MExams::model()->findAllBySql("select DISTINCT a.* from m_exams a ,t_scores b where a.ID=b.exam_id and b.student_id=:student_id order by b.create_time desc ", array(':student_id'=>$student_id));
        
        Yii::log(print_r($data, true));
        
        foreach ($data as $value) {
            $result[$value->ID] = $value->exam_name;
        }
        return $result;
        
    }
    
    public function getAllExamsOption($flag=true) {
        $result = array();
        if ($flag === true) {
            $result[''] = yii::app()->params['EmptySelectOption'];
        }

        $data = MExams::model()->findAll("status='1'");
        foreach ($data as $value) {
            $result[$value->ID] = $value->exam_name;
        }
        return $result;
    }
    
    public function getAllExamIds(){
        $data = MExams::model()->findAll();
        foreach ($data as $value) {
            $result[$value->ID] = $value->ID;
        }
        return $result;
    }
    
    /**
     * 获取指定班级的所有考试类型
     * @param type $class_id
     * @return type
     */
    public function getExamOptionByClassId($class_id, $flag = true) {
        $result = array();
        if ($flag === true) {
            $result[''] = Yii::app()->params['EmptySelectOption'];
        }

        $exams = MExams::model()->findAll('ID in (select DISTINCT a.exam_id from t_scores a where a.class_id=:class_id)', array(':class_id' => $class_id));
        foreach ($exams as $value) {
            $result[$value->ID] = $value->exam_name;
        }
        
        return $result;
    }

}
