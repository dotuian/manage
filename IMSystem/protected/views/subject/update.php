<?php
$this->pageTitle=Yii::app()->name . '科目信息变更';
$this->breadcrumbs=array(
    "科目信息检索"  => $this->createUrl('search'),
    "科目信息变更",
);
?>
<script>

</script>


<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">科目信息变更</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>该页面，可以修改一个科目的信息。</h6>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'update-subject-form',
                            'enableClientValidation'=>true,
                            'method' => 'post',
                            'action' => $this->createUrl('update', array('ID' => $model->ID)),
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">科目代号</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($model,'subject_code',array('class'=>'form-control required','placeholder'=>'科目代号')); ?>
                                <?php echo $form->error($model,'subject_code'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">科目名称</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'subject_name', array('class'=>'form-control required','placeholder'=>'科目名称')); ?>
                                <?php echo $form->error($model,'subject_name'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">科目名称(简称)</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'subject_short_name', array('class'=>'form-control required', 'placeholder'=>'科目名称(简称)')); ?>
                                <?php echo $form->error($model,'subject_short_name'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">科目类型</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'subject_type', SubjectForm::getSubjectTypeOption(false), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'subject_type'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">总分</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'total_score', array('class'=>'form-control required', 'placeholder'=>'总分')); ?>
                                <?php echo $form->error($model,'total_score'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">及格分数</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'pass_score', array('class'=>'form-control required', 'placeholder'=>'及格分数')); ?>
                                <?php echo $form->error($model,'pass_score'); ?>
                            </div>
                        </div>
                    
                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <div class="pull-left">
                                    <?php 
                                        if($model->status == "1") {
                                            echo CHtml::Button("删除", array(
                                                'confirm'=>'确定要删除吗？',
                                                'params'=>array('ID' => $model->ID),
                                                'submit' => array('delete'),
                                                'class'=>'btn btn-delete',
                                                'encode'=>false,
                                            ));
                                        }
                                    ?>
                                </div>
                                <div class="pull-right">
                                    <?php 
                                        if($model->status == "1") {
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
