<?php
$this->pageTitle = Yii::app()->name . '学生成绩总表';
$this->breadcrumbs = array(
    '学生成绩总表',
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){


});
", CClientScript::POS_HEAD);
?>

<!-- 检索条件 -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">学生成绩总表</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'class-score-form',
                        'method' => 'post',
                        'enableClientValidation'=>false,
                        'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                    ));
                ?>
                <div class="padd">
                    <h6>
                        导出指定条件所对应学生的成绩信息到Excel文件中。<br/>
                    </h6>
                    <hr/>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">年度</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'entry_year', TClasses::model()->getEntryYearOption(true), array(
                                        'id'=>'entry_year',
                                        'class'=>'form-control required', 
                                        'ajax'=>array(
                                                'type'=>'POST',
                                                'data' => array(
                                                    'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken,
                                                    'grade'      => 'js:$("#grade").val()',
                                                    'entry_year' => 'js:$("#entry_year").val()',
                                                    'allowempty' => 'true'
                                                ),
                                                'url' => Yii::app()->createUrl('ajax/getClassOptionByGradeAndEntryYear'),
                                                'beforeSend'=>"function(){
                                                        $.blockUI({ message: null });
                                                    }",
                                                'success'=>"function(data){
                                                        $.unblockUI();
                                                        $('#class_id').html(data);
                                                    }",
                                            )
                                    )); ?>
                                <?php echo $form->error($model,'entry_year'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">年级</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'grade', ClassForm::getGradeOption(true), array(
                                        'id'=>'grade',
                                        'class'=>'form-control required',
                                        'ajax'=>array(
                                            'type'=>'POST',
                                            'data' => array(
                                                'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken,
                                                'grade'      => 'js:$("#grade").val()',
                                                'entry_year' => 'js:$("#entry_year").val()',
                                                'allowempty' => 'true'
                                            ),
                                            'url' => Yii::app()->createUrl('ajax/getClassOptionByGradeAndEntryYear'),
                                            'beforeSend'=>"function(){
                                                    $.blockUI({ message: null });
                                                }",
                                            'success'=>"function(data){
                                                    $.unblockUI();
                                                    $('#class_id').html(data);
                                                }",
                                        )
                                        )); ?>
                                <?php echo $form->error($model,'grade'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'class_id', array(''=>Yii::app()->params['EmptySelectOption']), array('id'=>'class_id', 'class'=>'form-control')); ?>
                                <?php echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">考试名称</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->checkBoxList($model,'exam_id', MExams::model()->getAllExamsOption(false), array('separator'=>'　')); ?>
                                <br/><?php echo $form->error($model,'exam_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">科目</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->checkBoxList($model,'subject_id', MSubjects::model()->getAllSubjectsOption(false), array('separator'=>'　')); ?>
                                <br/><?php echo $form->error($model,'subject_id'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="widget-foot">
                        <div class="pull-right">
                            <?php echo CHtml::submitButton('导出', array('class'=>'btn btn-search')); ?>
                        </div>
                        <div class="clearfix"></div> 
                    </div>
                    
                <?php $this->endWidget(); ?>
                    
            </div>
        </div>
    </div>  
</div>
