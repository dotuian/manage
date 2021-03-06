<?php
$this->pageTitle = Yii::app()->name . '班级信息添加';
$this->breadcrumbs = array(
    '班级信息添加',
);
?>
<script>

</script>



<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">班级信息添加</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>该页面，可以添加一个班级的信息。</h6>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'add-class-form',
                            'enableClientValidation'=>true,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级代号</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($model,'class_code',array('class'=>'form-control required','placeholder'=>'班级代号')); ?>
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
                                <?php echo $form->dropDownList($model,'grade', TClasses::model()->getGradeOption(true), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'grade'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">年度</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'entry_year', array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'entry_year'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">学期</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'term_type', TClasses::model()->getTermTypeOption(true), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'term_type'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级性质</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'class_type', TClasses::model()->getClassTypeOption(true), array('class'=>'form-control required')); ?>
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

                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <div class="pull-left">
                                    <input type="reset" class="btn btn-reset" value='重置' />
                                </div>
                                <div class="pull-right">
                                    <?php echo CHtml::submitButton('添加', array('class'=>'btn btn-primary')); ?>
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
