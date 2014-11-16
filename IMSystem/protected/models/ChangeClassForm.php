<?php

class ChangeClassForm extends CFormModel {
    public $old_class_id;
    public $new_class_id;
    
    public $student_ids;
    public $student_numbers;
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('old_class_id, new_class_id', 'required'),
            
            array('student_numbers', 'numerical'),
            array('student_numbers', 'length', 'max'=>10),
            
            array('old_class_id, new_class_id, student_ids, student_numbers', 'safe'),
        );
    }
    
    public function afterValidate() {
        parent::afterValidate();
        
        if($this->old_class_id == $this->new_class_id) {
            $this->addError('new_class_id', '变更前后班级不能一样！');
        }
        
//        if(is_array($this->student_ids) && is_array($this->student_numbers)){
//            foreach ($this->student_ids as $student_id => $value) {
//                if($value == '1') {
//                    if(trim($this->student_numbers[$student_id]) == '') {
//                        Yii::log("=============" . $student_id);
//                        $this->addError("student_numbers[$student_id]", '学号不能为空！');
//                    }
//                }
//            }
//        }
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'old_class_id' => '班级(变更前)',
            'new_class_id' => '班级(变更后)',
        );
    }

}
