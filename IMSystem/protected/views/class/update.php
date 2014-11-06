<?php
$this->pageTitle = Yii::app()->name . '班级信息变更';
$this->breadcrumbs = array(
    '班级信息变更',
);
?>
<script>
//$(document).ready(function(){
//    
//    $('#datetimepicker1').datetimepicker({
//        pickTime: false
//    });
//});
</script>



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
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级代号</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($model,'class_code',array('class'=>'form-control required')); ?>
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
                            <label class="col-lg-2 control-label">入学年份</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'entry_year', ClassForm::getEntryYearOption(3, false), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'entry_year'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">年级</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'grade', ClassForm::getGradeOption(3, false), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'grade'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">学期</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'term_type', ClassForm::getTermTypeOption(false), array('class'=>'form-')); ?>
                                <?php echo $form->error($model,'term_type'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级性质</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'class_type', ClassForm::getClassTypeOption(false), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'class_type'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">专业名称</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'specialty_name', array('class'=>'form-control','placeholder'=>'专业名称')); ?>
                                <?php echo $form->error($model,'specialty_name'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">班主任</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'teacher_id', TTeachers::model()->getAllTeacherOption(true), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'teacher_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">状态</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'status', ClassForm::getClassStatusOption(false), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'status'); ?>
                            </div>
                        </div>
                    
                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <input type="reset" class="btn btn-reset" value='重置' />
                                <?php echo CHtml::submitButton('变更', array('class'=>'btn btn-update ')); ?>
                            </div>
                        </div>
                    
                    <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>  

    </div>
</div>
