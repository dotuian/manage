<?php

class GraduateForm extends CFormModel {

    public $class_ids;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('class_ids', 'required'),
            array('class_ids', 'safe'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'class_ids' => '班级',
        );
    }
    
    
    public function afterValidate() {
        parent::afterValidate();

    }

}
