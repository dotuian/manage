<?php
$this->pageTitle = Yii::app()->name . '学生信息导出';
$this->breadcrumbs = array(
    '学生信息导出',
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
                <div class="pull-left">学生信息导出</div>
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
                        导出指定条件所对应学生的信息到Excel文件中。<br/>
                        <ul>
                            <li>指定年级和班级的条件，将对应的在校学生信息下载到Excel文件中。</li>
                            <li>在不指定任何条件的情况下，下载全部在校学生的信息。但是这样需要等待较长的时间。建议指定年级，班级后下载学生信息。</li>
                        </ul>
                    </h6>
                    <hr/>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">年级</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'grade', TClasses::model()->getGradeOption(true), array(
                                        'id'=>'grade',
                                        'class'=>'form-control',
                                        'ajax'=>array(
                                            'type'=>'POST',
                                            'data' => array(
                                                'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken,
                                                'grade'      => 'js:$("#grade").val()',
                                                'allowempty' => 'true'
                                            ),
                                            'url' => Yii::app()->createUrl('ajax/getClassOptionByGrade'),
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
