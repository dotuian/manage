<?php
$this->pageTitle = Yii::app()->name . '课程信息变更';
$this->breadcrumbs = array(
    '课程信息变更',
);
?>
<script>
$(document).ready(function(){
    
});
</script>

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">课程信息变更</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>该页面，可以修改一个课程的信息。</h6>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'update-course-form',
                            'enableClientValidation'=>true,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'class_id',  TClasses::model()->getAllUsingClassOption(true), array('class'=>'form-control','disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">科目</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'subject_id', MSubjects::model()->getAllSubjectsOption(true), array('class'=>'form-control','disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'subject_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">任课教师</label>
                            <div class="col-lg-10">
                                <?php // echo $form->dropDownList($model,'teacher_id', TTeachers::model()->getTeachersBySubjectIdOption($model->subject_id, true), array('class'=>'form-control')); ?>
                                <?php echo $form->dropDownList($model,'teacher_id', TTeachers::model()->getAllTeacherWithPinYinOption(true), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'teacher_id'); ?>
                            </div>
                        </div>
                        
                        <hr>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <div class="pull-left">
                                    <?php 
                                        echo CHtml::Button("删除", array(
                                            'confirm'=>'确定要删除吗？',
                                            'params'=>array('ID' => $model->ID),
                                            'submit' => array('delete'),
                                            'class'=>'btn btn-delete',
                                            'encode'=>false,
                                        ));
                                    ?>
                                </div>
                                <div class="pull-right">
                                    <?php echo CHtml::submitButton('变更', array('class'=>'btn btn-update ')); ?>
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
