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

        // 旧班级必须处于暂停状态
        $old_class = TClasses::model()->find("ID=:ID and status='2'", array(":ID" => $this->old_class_id));
        if (is_null($old_class)) {
            $this->addError('old_class_id', '班级(旧)信息不存在，或没有被暂停！');
        }
        
        // 新班级必须处于正常状态
        $new_class = TClasses::model()->exists("ID=:ID and status='1'", array(":ID" => $this->new_class_id));
        if (is_null($new_class)) {
            $this->addError('new_class_id', '班级(新)信息不存在！');
        }
        
        if (!is_null($old_class) && !is_null($new_class)) {
            // 入学年份
            if($old_class->entry_year != $new_class->entry_year){
                $this->addError('new_class_id', '班级(新)与班级(旧)的入学年份不一致，迁移前后班级的学生入学年份信息不能变！');
            }

            // 同一年级上下学期的迁移
            if ($old_class->grade == $new_class->grade) {
                if($old_class->term_type > $new_class->term_type){
                    $this->addError('new_class_id', '不符合学生升学规则，不能将班级迁(旧)的学生移到班级(新)班级中去！');
                }
            }

            // 年级升级
            if($old_class->grade + 1 == $new_class->grade) {
                if($old_class->term_type >= $new_class->term_type){
                    $this->addError('new_class_id', '不符合学生升学规则，不能将班级迁(旧)的学生移到班级(新)班级中去！');
                }
            } else {
                $this->addError('new_class_id', '不符合学生升学规则，不能将班级迁(旧)的学生移到班级(新)班级中去！');
            }
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
