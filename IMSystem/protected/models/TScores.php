<?php

/**
 * This is the model class for table "t_scores".
 *
 * The followings are the available columns in table 't_scores':
 * @property string $ID
 * @property string $exam_id
 * @property string $subject_id
 * @property string $class_id
 * @property string $student_id
 * @property integer $score
 * @property string $create_user
 * @property string $create_time
 * @property string $update_user
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property MExams $exam
 * @property MSubjects $subject
 * @property TClasses $class
 * @property TStudents $student
 */
class TScores extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 't_scores';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('exam_id, subject_id, class_id, student_id, score, create_time, update_time', 'required'),
            array('score', 'numerical'),
            array('score', 'length', 'max' => 5),
            array('exam_id, subject_id, class_id, student_id, create_user, update_user', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, exam_id, subject_id, class_id, student_id, score, create_user, create_time, update_user, update_time', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'exam' => array(self::BELONGS_TO, 'MExams', 'exam_id'),
            'subject' => array(self::BELONGS_TO, 'MSubjects', 'subject_id'),
            'class' => array(self::BELONGS_TO, 'TClasses', 'class_id'),
            'student' => array(self::BELONGS_TO, 'TStudents', 'student_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'exam_id' => '考试名称ID',
            'subject_id' => '科目ID',
            'class_id' => '班级ID',
            'student_id' => '学生ID',
            'score' => '分数',
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
        $criteria->compare('exam_id', $this->exam_id, true);
        $criteria->compare('subject_id', $this->subject_id, true);
        $criteria->compare('class_id', $this->class_id, true);
        $criteria->compare('student_id', $this->student_id, true);
        $criteria->compare('score', $this->score);
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
     * @return TScores the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function afterValidate() {
        parent::afterValidate();

        if ($this->score < 0 || $this->score > 150) {
            $this->addError('score', '请输入合理范围内的成绩！');
        }
    }
    

}
