<?php
$this->pageTitle = Yii::app()->name . '班级信息变更';
$this->breadcrumbs=array(
    "班级信息检索"  => $this->createUrl('search'),
    "班级信息变更",
);
?>

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">班级信息变更</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>该页面，可以修改一个班级的信息。</h6>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'update-class-form',
                            'enableClientValidation'=>true,
                            'method' => 'post',
                            'action' => $this->createUrl('update', array('ID' => $model->ID)),
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级代号</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($model,'class_code',array('class'=>'form-control required', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'class_code'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级名称</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'class_name', array('class'=>'form-control required','placeholder'=>'班级名称')); ?>
                                <?php echo $form->error($model,'class_name'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">年级</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'grade', TClasses::model()->getGradeOption(false), array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'grade'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">年度</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'entry_year', array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'entry_year'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">学期</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'term_type', TClasses::model()->getTermTypeOption(false), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'term_type'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级性质</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'class_type', TClasses::model()->getClassTypeOption(false), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'class_type'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">专业名称</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'specialty_name', array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'specialty_name'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">班主任</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'teacher_id', TTeachers::model()->getAllTeacherWithPinYinOption(true), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'teacher_id'); ?>
                            </div>
                        </div>
                    
                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <div class="pull-left">
                                    <?php 
                                        // 暂停的状态下，不能修改变更班级信息
                                        if($model->status == '1') {
                                            echo CHtml::Button('暂停', array(
                                                'confirm'=>'确定要暂停该班级吗？',
                                                'params'=>array('ID' => $model->ID),
                                                'submit' => array('pause'),
                                                'class'=>'btn btn-delete',
                                                'encode'=>false,
                                            ));
                                        }
                                    ?>
                                </div>
                                <div class="pull-right">
                                    <?php 
                                        if($model->status == '1') {
                                            echo CHtml::submitButton('变更', array('class'=>'btn btn-update ')); 
                                        }
                                    ?>
                                </div>
                                <div class="clearfix"></div> 
                            </div>
                        </div>
                    
                    <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>  

    </div>
</div>
