<?php
$this->pageTitle= '成绩信息变更';
$this->breadcrumbs = array(
    $this->pageTitle,
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
                <div class="pull-left"><?php echo $this->pageTitle;?></div>
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
                            <label class="col-lg-2 control-label">班级</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getAllClassOption(true), array('class'=>'form-control', 'disabled'=>'disabled','separator'=>'　')); ?>
                                <?php echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">成绩</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'score', array('class'=>'form-control', 'placeholder'=>'成绩')); ?>
                                <?php echo $form->error($model,'score'); ?>
                            </div>
                        </div>
                    
                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <?php 
                                    echo CHtml::Button("删除", array(
                                        'confirm'=>'确定要删除吗？',
                                        'params'=>array('ID' => $model->ID),
                                        'submit' => array('delete'),
                                        'class'=>'btn',
                                        'encode'=>false,
                                    ));
                                ?>
                                <?php echo CHtml::submitButton('变更', array('class'=>'btn btn-primary ')); ?>
                            </div>
                        </div>
                    
                    <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>  

    </div>
</div>
