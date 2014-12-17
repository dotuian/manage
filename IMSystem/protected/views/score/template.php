<?php
$this->pageTitle = Yii::app()->name . '学生成绩导入模板';
$this->breadcrumbs = array(
    '学生成绩导入模板',
);
?>
<script>
$(document).ready(function(){

});

</script>


<!-- 检索条件 -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">条件指定</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'score-template-form',
                        'enableClientValidation'=>false,
                        'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                    ));
                ?>
                <div class="padd">
                    <h6>
                        该页面，可以下载学生成绩录入的Excel文件。<br/>
                    </h6>
                    <hr/>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">班级</label>
                        <div class="col-lg-10 inline-block">
                            <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getAllUsingClassOption(true), array('class'=>'form-control required')); ?>
                            <?php echo $form->error($model,'class_id'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">科目</label>
                        <div class="col-lg-10 inline-block">
                            <?php echo $form->checkBoxList($model,'subjects', MSubjects::model()->getAllSubjectsOption(false), array('separator'=>'　')); ?>
                            <br/><?php echo $form->error($model,'subjects'); ?>
                        </div>
                    </div>
                </div>

                <div class="widget-foot">
                    <div class="pull-right">
                        <?php echo CHtml::submitButton('下载', array('class'=>'btn btn-primary')); ?>
                    </div>
                    <div class="clearfix"></div> 
                </div>
                    
                <?php $this->endWidget(); ?>
                    
            </div>
        </div>
    </div>  
</div>
