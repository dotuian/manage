<?php

class ClassUpgradeForm extends CFormModel {

    public $old_class_id;
    public $new_class_id;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('old_class_id, new_class_id', 'required'),
            array('old_class_id, new_class_id', 'length', 'max' => 10),
            array('old_class_id, new_class_id', 'safe'),
        );
    }

    public function afterValidate() {
        parent::afterValidate();

        if ($this->old_class_id === $this->new_class_id) {
            $this->addError('new_class_id', '不能和之前班级(旧)信息一致！');
        }

        $old_class = TClasses::model()->find("ID=:ID", array(":ID" => $this->old_class_id));
        if (is_null($old_class)) {
            $this->addError('old_class_id', '班级(旧)信息不存在！');
        } else {
            if ($old_class->status === '1') { // 使用中的班级
                $this->addError('old_class_id', '班级(旧)目前还在使用中，请先暂停该班级的状态！');
            }
        }

        $new_class = TClasses::model()->exists("ID=:ID and status='1'", array(":ID" => $this->new_class_id));
        if (!$new_class) {
            $this->addError('new_class_id', '班级(新)信息不存在！');
        }
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'old_class_id' => '班级(旧)',
            'new_class_id' => '班级(新)',
        );
    }

}
