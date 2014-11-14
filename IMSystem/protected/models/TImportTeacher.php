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
class TImportTeacher extends CActiveRecord {
    
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

            array('filename, category', 'length', 'max' => 50, 'encoding'=>'UTF-8'),
            array('realpath', 'length', 'max' => 128),
            array('status', 'length', 'max' => 1),
            
            // safe
            array('ID, filename, realpath, category, status, create_user, create_time, update_user, update_time', 'safe'),
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
//            Yii::log(print_r($data, true));
        }
        return $data;
    }
    
    
    /**
     * 将文件中的数据导入到数据库中
     * @return boolean
     */
    public function importdata($data) {
        $result = true;
        
        foreach ($data as $value) {
            if (!TUsers::model()->importTeacher($value)) {
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
        
        // 数据条数稍微1行是，文件中没有数据
        if (is_array($data) && count($data) > 3) {
            $data = array_slice($data, 3);
        } else {
            return null;
        }
        
        $result = array();
        foreach ($data as $value) {
            if($value['A'] == ''){
                continue;
            }
            
            $temp = array();
            $temp['name']           = trim($value['B']);        // 姓名
            $temp['sex']            = $this->getSexCode(trim($value['C']));  // 性别
            $temp['nation']         = trim($value['D']);        // 民族
            $temp['birthplace']     = trim($value['E']);        // 籍贯
            $temp['id_card_no']     = strtoupper(trim($value['F'])); // 身份证号码
            $temp['birthday']       = trim($value['G']);        // 出生年月
            $temp['subjects']       = trim($value['H']);        // 任教科目
            $temp['working_date']   = trim($value['I']);        // 参加工作年月

            $result[] = $temp;
        }
        
        return $result;
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

        $id_card_nos = array();
        
        foreach ($array as $key => $value) {
            $error = array();

            if (empty($value['name'])) {
                $error[] = '姓名必须指定！';
            } 
            
            if(mb_strlen($value['name'], $encode) > 12) {
                $error[] = '姓名过长！';
            }
            
            if (empty($value['sex'])) {
                $error[] = '性别必须指定！';
            }
            
            if (empty($value['id_card_no'])) {
                $error[] = '身份证号必须指定！';
            } else {
                if(in_array($value['id_card_no'], $id_card_nos)) {
                    $error[] = '身份证号重复！';
                }
                
                if(strlen($value['id_card_no']) > 18 ) {
                    $error[] = '身份证号信息有误！';
                }
                
                $temp = TUsers::model()->exists("username=:username", array(':username' =>$value['id_card_no']));
                if($temp){
                    $error[] = '身份证号已经存在！';
                }
                
                $id_card_nos[] =$value['id_card_no'] ;
            }
            
            
            $value['birthday'] = date('Y-m-d', CDateTimeParser::parse($value['birthday'], 'yyyy/MM/dd'));
            
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
