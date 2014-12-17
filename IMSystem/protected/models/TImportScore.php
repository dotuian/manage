<?php

/**
 * This is the model class for table "t_file_upload".
 *
 * The followings are the available columns in table 't_file_upload':
 * @property string $ID
 * @property string $filename
 * @property string $realpath
 * @property string $category
 * @property string $status
 * @property integer $create_user
 * @property string $create_time
 * @property integer $update_user
 * @property string $update_time
 */
class TImportScore extends CActiveRecord {
    
    public $exam_id;
    public $class_id;  //导入学生成绩的班级
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 't_file_upload';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('exam_id, class_id, filename', 'required'),
            // 上传许可的文件类型
            array('filename', 'file', 'types' => 'xlsx,xls', 'maxSize' => 1024 * 1024 * 5, 'tooLarge' => '文件 "{file}" 太大. 文件大小不能超过5MB！', 'on' => 'validate'),
            array('class_id, filename', 'required', 'on' => 'validate'),
            
            array('filename, category', 'length', 'max' => 50, 'encoding'=>'UTF-8'),
            array('realpath', 'length', 'max' => 128),
            array('status', 'length', 'max' => 1),
            
            // safe
            array('ID, class_id, filename, realpath, category, status, create_user, create_time, update_user, update_time', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'class_id' => '班级',
            'filename' => '文件',
            'realpath' => '保存文件路径',
            'category' => '用途',
            'status' => '状态', // (0:未处理  1:处理正常  2:处理异常)
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
        $criteria->compare('filename', $this->filename, true);
        $criteria->compare('realpath', $this->realpath, true);
        $criteria->compare('category', $this->category, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('create_user', $this->create_user);
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_user', $this->update_user);
        $criteria->compare('update_time', $this->update_time, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TImportStudent the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


    public function afterValidate() {
        parent::afterValidate();
        
        if($this->scenario == 'validate' || $this->scenario == 'import') {
            $exam = MExams::model()->find("ID=:ID and status='1'", array(':ID'=>$this->exam_id));
            if (is_null($exam)) {
                $this->addError("exam_id", '考试信息不存在！');
            }
            
            $class = TClasses::model()->find("ID=:ID and status='1'", array(':ID'=>$this->class_id));
            if (is_null($class)) {
                $this->addError("class_id", '班级信息不存在！');
            }
        }
    }
    
    public function deletefile(){
        if (file_exists($this->realpath) && is_file($this->realpath)) {
            // 删除文件
            unlink($this->realpath);
        }
    }
    
    
    /**
     * 
     * @return type将Excel文件中的内容读取到数组中
     */
    public function readExcel2Array() {
        $data = array();
        if (file_exists($this->realpath) && is_file($this->realpath)) {
            $data = ExcelUtils::readExcel2Array($this->realpath);
        }
        return $data;
    }
    
    
    /**
     * 将文件中的数据导入到数据库中
     * @return boolean
     */
    public function importdata($data) {
        $result = true;

        // 用户获取科目的ID
        $subjects = $this->getSubjectInfo($this->class_id);

        foreach ($data as $value) {
            $student = TStudents::model()->getStudentInfoByCondition($value['学号'], $value['姓名'], $this->class_id);
            if(is_null($student)) {
                return false;
            }

            $student_id = $student->ID;
            $class_id = $this->class_id;
            $student_number = $value['学号'];

            // 
            foreach ($value as $k => $v) {
                if (!($k == 'No.' || $k == '学号' || $k == '姓名')) {
                    if (isset($subjects[$k])) {
                        $exam_id = $this->exam_id;
                        $subject_id = $subjects[$k]->ID;

                        $score = TScores::model()->find("exam_id=:exam_id and subject_id=:subject_id and class_id=:class_id and student_id=:student_id", 
                                    array(":exam_id" => $exam_id, ":subject_id" => $subject_id, ":class_id" => $class_id, ":student_id" => $student_id)
                                );
                        if (is_null($score)) {
                            $score = new TScores();
                            $score->exam_id = $exam_id;
                            $score->subject_id = $subject_id;
                            $score->class_id = $this->class_id;
                            $score->student_id = $student_id;
                            $score->student_number = $student_number;
                            $score->score = floatval($v);
                            $score->create_user = Yii::app()->user->getState('ID');
                            $score->create_time = new CDbExpression('NOW()');
                        } else {
                            $score->score = floatval($v);
                            $score->update_user = Yii::app()->user->getState('ID');
                            $score->update_time = new CDbExpression('NOW()');
                        }
                        $score->save(false);
                    }
                }
            }
        }
        
        return $result;
    }
    
    
    public function getTitleData($data){
        $title = array();
        
        if (is_array($data) && count($data) > 2) {
            // 第二行是标题
            $title = $data[2];
        }
        
        return $title;
    }
    
    /**
     * 将Excel文件中的数据进行转换，便于今后的维护
     * @param type $value
     * @return type
     */
    public function converdata($data) {

        // 第3行开始才是真实的数据
        if (is_array($data) && count($data) > 2) {
            // 第二行是标题
            $title = $data[2];
            // 第三行开始时数据
            $data = array_slice($data, 2);
        } else {
            return null;
        }

        $result = array();
        foreach ($data as $value) {
            // 如果学号为空，自动跳过该条数据
            if (empty($value['A']) || empty($value['B']) || empty($value['C'])) {
                continue;
            }

            $temp = array();

            // 根据标题来循环读取数据
            foreach ($title as $k => $t) {
                $temp[$t] = isset($value[$k]) && trim($value[$k]) != '' ? trim($value[$k]) : null;
            }

            $result[] = $temp;
        }

        return $result;
    }

    /**
     * 验证导入的学生信息
     * @param type $array
     * @return boolean
     */
    public function validatedata(&$array) {
        if (!is_array($array)) {
            return false;
        }
        
        $subjects = $this->getSubjectInfo($this->class_id);
        
        $result = true;
        
        foreach ($array as $key => $value) {
            $error = array();

            if(empty($value['学号']) || empty($value['姓名'])) {
                $error[] = '学号和姓名必须指定！';
            } else {
                // 检查学生是否存在
                $student = TStudents::model()->getStudentInfoByCondition($value['学号'], $value['姓名'], $this->class_id);
                if(is_null($student)) {
                    $error[] = "该班没有该学生！";
                }
            }            
            
            // 科目的数据验证
            foreach ($value as $k => $v) {
                if(!($k == 'No.' || $k == '学号' || $k == '姓名')) {
                    if(isset($subjects[$k])) {
                        if($v == '') {
                            $error[] = "{$k}的成绩必须指定！";
                        } else {
                            if(!is_numeric($v)) {
                                $error[] = "{$k}的成绩({$v})不正确！";
                            } elseif (floatval($v) < 0 || floatval($v) > $subjects[$k]->total_score) {
                                $error[] = "{$k}的成绩({$v})超出了范围！";
                            }
                        }
                    } else {
                        $error[] = "该班没有课程({$k})";
                    }
                }
            }
            
            // 错误信息的统计
            if (count($error) > 0) {
                $result = false;
                $value['error'] = $error;
            }

            $array[$key] = $value;
        }

        return $result;
    }
    
    
    private function getSubjectInfo($class_id){
        // 科目信息
        $subjects = array();
        $sql = "select a.* from m_subjects a ";
        $sql .= "inner join m_courses b on a.ID=b.subject_id and a.`status`='1' ";
        $sql .= "inner join t_classes c on c.ID=b.class_id and c.`status`='1' ";
        $sql .= "where c.ID=:class_id ";
        $data = MSubjects::model()->findAllBySql($sql, array(':class_id' => $class_id));
        foreach ($data as $value) {
            $subjects[$value->subject_name] = $value;
        }
        
        return $subjects;
    }
    
}
