<?php
$this->pageTitle= '班级信息添加';
$this->breadcrumbs = array(
    $this->pageTitle,
);
?>
<script>

</script>



<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left"><?php echo $this->pageTitle;?></div>
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
                                <?php echo $form->textField($model,'class_code',array('class'=>'form-control','placeholder'=>'班级代号')); ?>
                                <?php echo $form->error($model,'class_code'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级名称</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'class_name', array('class'=>'form-control','placeholder'=>'班级名称')); ?>
                                <?php echo $form->error($model,'class_name'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">状态</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'status', ClassForm::getStatusOption(false), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'status'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">届</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'term_year', ClassForm::getTermYearOption(1, false), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'term_year'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">班主任</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'teacher_id', TTeachers::model()->getTeacherOption(true), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'teacher_id'); ?>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <input type="reset" class="btn btn-default" value='重置' />
                                <?php echo CHtml::submitButton('添加', array('class'=>'btn btn-primary ')); ?>
                            </div>
                        </div>
                    
                    <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>  

    </div>
</div>
