<?php
$this->pageTitle = Yii::app()->name . '成绩信息变更';
$this->breadcrumbs = array(
    '成绩信息变更',
);
?>


<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">成绩信息变更</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>该页面，可以修改一个成绩的信息。</h6>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'update-teacher-form',
                            'enableClientValidation'=>true,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级年份</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($class,'entry_year', array('class'=>'form-control','disabled'=>'disabled')); ?>
                                <?php echo $form->error($class,'entry_year'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级代号</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($class,'class_code', array('class'=>'form-control','disabled'=>'disabled')); ?>
                                <?php echo $form->error($class,'class_code'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级名称</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($class,'class_name', array('class'=>'form-control','disabled'=>'disabled')); ?>
                                <?php echo $form->error($class,'class_name'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">考试名称</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'exam_id', MExams::model()->getAllExamsOption(true), array('class'=>'form-control','disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'exam_id'); ?>
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
                            <label class="col-lg-2 control-label">学号</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'student_number', array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'student_number'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">姓名</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($student,'name', array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($student,'name'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">成绩</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'score', array('class'=>'form-control required', 'placeholder'=>'成绩')); ?>
                                <?php echo $form->error($model,'score'); ?>
                            </div>
                        </div>
                    
                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
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
