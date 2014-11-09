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
class TFileUpload extends CActiveRecord {
    
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
     * @return TFileUpload the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


    public function afterValidate() {
        parent::afterValidate();

        $class = TClasses::model()->find("ID=:ID and status='1'", array(':ID'=>$this->class_id));
        if (is_null($class)) {
            $this->addError("class_id", '班级信息不存在！');
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
    public function readExcel2Array(){
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
        if (is_array($data) && count($data) > 4) {
            $data = array_slice($data, 4);
        } else {
            return null;
        }
        
        $result = array();
        foreach ($data as $value) {
            $temp = array();
            $temp['student_number'] = trim($value['A']);        // 学号
            $temp['code']           = trim($value['A']);                  // 用户名
            $temp['name']           = trim($value['B']);                  // 学生姓名
            $temp['sex']            = $this->getSexCode(trim($value['C']));  // 性别
            $temp['id_card_no']     = trim($value['D']);     // 身份证号
            $temp['old_class_code'] = trim($value['E']); // 旧班级代号
            $temp['new_class_code'] = trim($value['F']); // 新班级代号
            $temp['accommodation']  = trim($value['G']);  // 住宿情况
            $temp['payment1']       = trim($value['H']); // 缴费情况（第1学期）(0: 未缴  1:已缴)
            $temp['payment2']       = trim($value['I']); // 缴费情况（第2学期）
            $temp['payment3']       = trim($value['J']); // 缴费情况（第3学期）
            $temp['payment4']       = trim($value['K']); // 缴费情况（第4学期）
            $temp['payment5']       = trim($value['L']); // 缴费情况（第5学期）
            $temp['payment6']       = trim($value['M']); // 缴费情况（第6学期）
            $temp['bonus_penalty']  = trim($value['N']); // 奖惩情况
            $temp['address']        = trim($value['O']);       // 家庭住址
            $temp['parents_tel']    = trim($value['P']);   // 家长电话
            $temp['parents_qq']     = trim($value['Q']);    // 家长QQ
            $temp['school_of_graduation'] = trim($value['R']); // 毕业学校
            $temp['comment']        = trim($value['S']);   // 备注
    //        $temp['senior_score'] = trim($value['G']);  // 中考总分
    //        $temp['school_year'] = trim($value['G']);   // 入学年份
    //        $temp['college_score'] = trim($value['G']); // 高考总分
    //        $temp['university'] = trim($value['G']);    // 录取学校
            
            $result[] = $temp;
        }
        
        return $result;
    }
    
    public function getSexCode($sex){
        $data = array();
        $data['男'] = 'M';
        $data['女'] = 'F';
        return isset($data[$sex]) ? $data[$sex] : null; 
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
        
        foreach ($array as $key => $value) {
            $error = array();

            if (empty($value['student_number'])) {
                $error[] = '学号必须指定！';
            } else {
                // 如果原先班级为空的情况，表明是新添加新的数据
                if($value['old_class_code'] == '') {
                    // 学号当做登录用的用户名，检查用户名是否存在
                    if(TUsers::model()->exists("username=:username", array(':username'=>$value['student_number']))){
                        $error[] = '该学号已经存在，请指定其他的学号！';
                    }
                }
                
            }

            if ($value['name'] == '') {
                $error[] = '姓名必须指定！';
            }
            
            if(mb_strlen($value['name'], $encode) > 12) {
                $error[] = '姓名过长！';
            }

            if ($value['sex'] == '') {
                $error[] = '性别数据有误！';
            }
            
            if (strlen($value['id_card_no']) > 18) {
                $error[] = '身份证信息有误！';
            }
            
            if($value['old_class_code'] != '') {
                if (!in_array($value['old_class_code'], $old_class_codes)) {
                    $error[] = '班级(旧)信息不存在！';
                }
            }
            
            if (!in_array($value['new_class_code'], $class_codes)) {
                $error[] = '班级(现)信息不存在！';
            }
            
            if (mb_strlen($value['accommodation'], $encode) > 50) {
                $error[] = '住宿情况过长！';
            }
            
            if(strlen($value['parents_tel']) > 11) {
                $error[] = '电话号码过长！';
            }
            
            if(mb_strlen($value['school_of_graduation'], $encode) > 50) {
                $error[] = '毕业学号过长！';
            }
            
            
            
            
            
            if (count($error) > 0) {
                $result = false;
            }

            $value['error'] = $error;

            $array[$key] = $value;
        }

        return $result;
    }

}
