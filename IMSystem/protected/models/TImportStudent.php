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
class TImportStudent extends CActiveRecord {
    
    public $class_id; // 导入学生信息所指定的班级
    
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
            array('filename', 'required'),
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
            'filename' => '上传文件名',
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
    public function importdata($data, $class) {
        $result = true;
        
        foreach ($data as $value) {
            if (!TUsers::model()->importStudent($value, $class)) {
                $result = false;
                break;
            }
        }
        return $result;
    }
    
    
    /**
     * 将Excel文件中的数据进行转换，便于今后的维护
     * @param type $value
     * @return type
     */
    public function converdata($data) {
        
        // 数据条数稍微4行是，文件中没有数据
        if (is_array($data) && count($data) > 3) {
            $data = array_slice($data, 3);
        } else {
            return null;
        }
        
        $result = array();
        foreach ($data as $value) {
            // 如果学号为空，自动跳过该条数据
            if(trim($value['A']) == ''){
                continue;
            }
            
            $temp = array();
            $temp['student_number'] = trim($value['A']);        // 学号
            $temp['code']           = trim($value['A']);        // 用户名
            $temp['name']           = str_replace(' ', '', trim($value['B']));// 学生姓名
            $temp['sex']            = $this->getSexCode(trim($value['C']));   // 性别
            $temp['id_card_no']     = strtoupper(trim($value['D']));          // 身份证号
            $temp['old_class_code'] = trim($value['E']); // 旧班级代号
            $temp['new_class_code'] = trim($value['F']); // 新班级代号
            $temp['accommodation']  = trim($value['G']); // 住宿情况
            $temp['payment1']       = $this->getPaymentValue(trim($value['H'])); // 缴费情况（第1学期）(0: 未缴  1:已缴)
            $temp['payment2']       = $this->getPaymentValue(trim($value['I'])); // 缴费情况（第2学期）
            $temp['payment3']       = $this->getPaymentValue(trim($value['J'])); // 缴费情况（第3学期）
            $temp['payment4']       = $this->getPaymentValue(trim($value['K'])); // 缴费情况（第4学期）
            $temp['payment5']       = $this->getPaymentValue(trim($value['L'])); // 缴费情况（第5学期）
            $temp['payment6']       = $this->getPaymentValue(trim($value['M'])); // 缴费情况（第6学期）
            $temp['bonus_penalty']  = trim($value['N']); // 奖惩情况
            $temp['address']        = trim($value['O']); // 家庭住址
            $temp['parents_tel']    = trim($value['P']); // 家长电话
            $temp['parents_qq']     = trim($value['Q']); // 家长QQ
            $temp['school_of_graduation'] = trim($value['R']); // 毕业学校
            $temp['comment']        = trim($value['S']);   // 备注
    //        $temp['school_year']    = date('Y');           // 入学年份
    //        $temp['senior_score'] = trim($value['G']);   // 中考总分
    //        $temp['college_score'] = trim($value['G']);  // 高考总分
    //        $temp['university'] = trim($value['G']);     // 录取学校
            
            $result[] = $temp;
        }
        
        return $result;
    }
    
    public function getPaymentValue($value) {
        if($value == '') {
            return null;
        }
        
        if(trim($value) == '齐') {
            return '1';
        }
        
        return null;
    }
    
    
    public function getSexCode($sex) {
        switch (trim($sex)) {
            case '男':
                $type = 'M';
                break;
            case '女':
                $type = 'F';
                break;
            default:
                $type = $sex;
                break;
        }
        return $type;
    }
    
    /**
     * 验证导入的学生信息
     * @param type $array
     * @return boolean
     */
    public function validatedata(&$array) {
        $encode = 'utf-8';
        
        $result = true;

        // 获取所有班级的CODE
        $class_codes = TClasses::model()->getAllClassCode();
        
        // 获取所有旧班级CODE
        $old_class_codes = TClasses::model()->getAllStopClassCode();
        
        // 页面中选择的要导入的班级
        $class =  TClasses::model()->find('ID=:ID', array(':ID' => $this->class_id));
        
        //Excel文件中所有学生的学号
        $numbers = array();
        
        foreach ($array as $key => $value) {
            $error = array();

            if (empty($value['student_number'])) {
                $error[] = '学号必须指定！';
            } else {
                if(strlen($value['student_number']) !== 10) {
                    $error[] = '学号位数有误!';
                }
                
                // 文件中是否存在重复的学号
                if(in_array($value['student_number'], $numbers)){
                    $error[] = '存在重复的学号!';
                }
                $numbers[] = $value['student_number'];
                
                // 如果原先班级为空的情况，表明是新添加新的数据
                if($value['old_class_code'] == '') {
                    // 学号当做登录用的用户名，检查用户名是否存在
                    if(TUsers::model()->exists("username=:username", array(':username'=>$value['student_number']))){
                        $error[] = '学号已经存在！';
                    }
                }
            }

            if ($value['name'] == '') {
                $error[] = '姓名必须指定！';
            }
            
            if(mb_strlen($value['name'], $encode) > 12) {
                $error[] = '姓名过长！';
            }

            if ($value['sex'] != '') {
                if (!in_array($value['sex'], array('M', 'F'))) {
                    $error[] = '性别数据有误！';
                }
            }
            
            if (strlen($value['id_card_no']) > 20) {
                $error[] = '身份证信息有误！';
            }
            
            if($value['old_class_code'] != '') {
                if (!in_array($value['old_class_code'], $old_class_codes)) {
                    $error[] = '班级(旧)没有被暂停！';
                }
            }
            
            if (!in_array($value['new_class_code'], $class_codes)) {
                $error[] = '班级(现)信息不存在！';
            }
            
            // 页面上选择的导入班级和实际信息中的班级不一致
            if($value['new_class_code'] != $class->class_code) {
                $error[] = "不是{$class->class_code}班的学生！";
            }
            
            if (mb_strlen($value['accommodation'], $encode) > 50) {
                $error[] = '住宿情况过长！';
            }
            
            if(strlen($value['parents_tel']) > 11) {
                $error[] = '电话号码过长！';
            }
            
            
            if(strlen(trim($value['parents_qq'])) > 0 && !is_numeric(trim($value['parents_qq']))) {
                $error[] = 'QQ号码有误！';
            }
            
            if(strlen($value['parents_qq']) > 15) {
                $error[] = 'QQ号码过长！';
            }
            
            if(mb_strlen($value['school_of_graduation'], $encode) > 50) {
                $error[] = '毕业学校过长！';
            }
            
            // 旧班级不为空的情况下，说明是班级的调整
            // 检查学生的数据是否存在
            if($value['old_class_code'] != '') {
                // 根据旧班级信息和姓名，查询学生信息
                $sql =  "select a.* from t_students a ";
                $sql .= " inner join t_student_classes b on a.ID=b.student_id and b.`status`='1' ";
                $sql .= " inner join t_classes c on b.class_id=c.ID and c.`status`='2' "; // 暂停中的班级信息
                $sql .= "where c.class_code=:class_code and a.name=:name and a.sex=:sex and a.`status`='1' "; // 未离校的学生

                $student = TStudents::model()->findBySql($sql, array(':name' => $value['name'], ':sex' => $value['sex'], ':class_code' => $value['old_class_code']));
                if (is_null($student)) {
                    $error[] = '原班级中不存在该学生信息！';
                }
            }
            
            // 错误信息的统计
            if (count($error) > 0) {
                $result = false;
            }

            $value['error'] = $error;

            $array[$key] = $value;
        }

        return $result;
    }

}
