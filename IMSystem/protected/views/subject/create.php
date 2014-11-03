<?php
$this->pageTitle = Yii::app()->name . '科目信息添加';
$this->breadcrumbs = array(
    '科目信息添加',
);
?>


<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">科目信息添加</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>该页面，可以添加一个科目的信息。</h6>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'add-subject-form',
                            'enableClientValidation'=>true,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">科目代号</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($model,'subject_code',array('class'=>'form-control','placeholder'=>'科目代号')); ?>
                                <?php echo $form->error($model,'subject_code'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">科目名称</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'subject_name', array('class'=>'form-control','placeholder'=>'科目名称')); ?>
                                <?php echo $form->error($model,'subject_name'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">科目名称(简称)</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'subject_short_name', array('class'=>'form-control', 'placeholder'=>'科目名称(简称)')); ?>
                                <?php echo $form->error($model,'subject_short_name'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">科目类型</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'subject_type', SubjectForm::getSubjectTypeOption(true), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'subject_type'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">总分</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'total_score', array('class'=>'form-control', 'placeholder'=>'总分')); ?>
                                <?php echo $form->error($model,'total_score'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">及格分数</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'pass_score', array('class'=>'form-control', 'placeholder'=>'及格分数')); ?>
                                <?php echo $form->error($model,'pass_score'); ?>
                            </div>
                        </div>
                    
                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <input type="reset" class="btn btn-reset" value='重置' />
                                <?php echo CHtml::submitButton('添加', array('class'=>'btn btn-primary')); ?>
                            </div>
                        </div>
                    
                    <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>  

    </div>
</div>


<script>

</script>