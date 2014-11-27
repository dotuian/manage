<?php

class MyClassForm extends CFormModel {
    public $class_id;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // 共同
            array('class_id', 'required'),
            
            array('class_id', 'safe'),
        );
    }
    
    public function afterValidate() {
        parent::afterValidate();
        
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'class_id' => '班级',
        );
    }

    
    
    
}
